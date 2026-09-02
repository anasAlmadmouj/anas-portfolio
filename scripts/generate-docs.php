<?php

/**
 * Regenerates the /docs static mirror (served by GitHub Pages) from the
 * live Laravel app.
 *
 * It crawls every locale/page/project route from a running `php artisan
 * serve` instance and rewrites the HTML so it works as a plain static
 * file tree:
 *   - route URLs (e.g. /en/projects/tourstify) become their static-file
 *     equivalent (en/projects/tourstify.html)
 *   - canonical / hreflang alternate / og:url tags stay absolute,
 *     pointing at the production URL
 *   - every other reference to the app (nav links, assets, images)
 *     becomes a path relative to the output file, since GitHub Pages
 *     serves this repo from a /anas-portfolio/ sub-path
 *
 * Usage:
 *   php scripts/generate-docs.php <serve-base-url> <production-base-url> <docs-dir>
 *
 * Only crawls HTML pages + sitemap.xml. Static assets (build/, images/,
 * favicon.ico, robots.txt) are synced separately by the calling shell
 * script — copying files is simpler and more robust done there.
 */

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$serveBase = rtrim($argv[1] ?? 'http://127.0.0.1:8123', '/');
$prodBase = rtrim($argv[2] ?? 'https://anasalmadmouj.github.io/anas-portfolio', '/');
$docsDir = rtrim($argv[3] ?? dirname(__DIR__).'/docs', '/');

$locales = ['en', 'ar'];

$slugs = collect(config('portfolio.projects'))
    ->filter(fn ($project) => ! empty($project['is_public']) && empty($project['is_confidential']))
    ->pluck('slug')
    ->values()
    ->all();

if (empty($slugs)) {
    fwrite(STDERR, "No public projects found in config/portfolio.php — aborting.\n");
    exit(1);
}

fwrite(STDERR, 'Public project slugs: '.implode(', ', $slugs).PHP_EOL);

function fetch(string $url, array $allowedStatuses = [200]): string
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
    ]);
    $body = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($body === false) {
        fwrite(STDERR, "FAILED to fetch {$url}: {$error}\n");
        exit(1);
    }

    if (! in_array($status, $allowedStatuses, true)) {
        fwrite(STDERR, "FAILED to fetch {$url}: HTTP {$status}\n");
        exit(1);
    }

    return $body;
}

/**
 * Convert a Laravel route path (/en, /en/projects, /en/projects/slug) into
 * its static-file equivalent. Returns null for paths that aren't one of
 * this app's routes (e.g. asset paths), which are left untouched.
 */
function toStaticPath(string $path, string $fragment): ?string
{
    if (preg_match('#^/(en|ar)$#', $path, $m)) {
        return "/{$m[1]}/index.html{$fragment}";
    }

    if (preg_match('#^/(en|ar)/projects$#', $path, $m)) {
        return "/{$m[1]}/projects.html{$fragment}";
    }

    if (preg_match('#^/(en|ar)/projects/([a-z0-9-]+)$#', $path, $m)) {
        return "/{$m[1]}/projects/{$m[2]}.html{$fragment}";
    }

    return null;
}

/**
 * Compute the relative path from an output file's directory (given as
 * path segments under docs/, e.g. ['en', 'projects']) to a target path
 * (given as a docs-root-relative path, e.g. "/en/index.html#about").
 */
function relativePath(array $fromDir, string $targetPath): string
{
    $fragment = '';
    if (($hashPos = strpos($targetPath, '#')) !== false) {
        $fragment = substr($targetPath, $hashPos);
        $targetPath = substr($targetPath, 0, $hashPos);
    }

    $targetSegments = explode('/', ltrim($targetPath, '/'));
    $targetFile = array_pop($targetSegments);

    $i = 0;
    while ($i < count($fromDir) && $i < count($targetSegments) && $fromDir[$i] === $targetSegments[$i]) {
        $i++;
    }

    $up = count($fromDir) - $i;
    $down = array_slice($targetSegments, $i);

    $parts = array_merge(array_fill(0, $up, '..'), $down, [$targetFile]);

    return implode('/', $parts).$fragment;
}

/**
 * Rewrite raw HTML crawled from the local dev server into its final
 * static form. $fromDir is null for files that must stay fully absolute
 * (sitemap.xml); otherwise it's the output file's directory segments.
 */
function rewriteHtml(string $html, string $serveBase, string $prodBase, ?array $fromDir): string
{
    $html = str_replace($serveBase, $prodBase, $html);

    $protected = [];

    // canonical / hreflang alternate / og:url / the ld+json Person "url" must
    // stay absolute production URLs — everything else becomes relative.
    $html = preg_replace_callback(
        '#(<link rel="canonical" href="|<link rel="alternate" hreflang="[^"]*" href="|<meta property="og:url" content="|"url":")'
            .preg_quote($prodBase, '#').'(/[^"]*)(")#',
        function ($m) use (&$protected, $prodBase) {
            $static = resolveTarget($m[2], $prodBase);
            $token = '@@PROTECTED_'.count($protected).'@@';
            $protected[$token] = $static;

            return $m[1].$token.$m[3];
        },
        $html
    );

    if ($fromDir === null) {
        // sitemap.xml: every reference stays absolute too.
        $html = preg_replace_callback(
            '#'.preg_quote($prodBase, '#').'(/[^"\'\s)<]*)#',
            fn ($m) => resolveTarget($m[1], $prodBase),
            $html
        );
    } else {
        // Everything else (nav links, assets, images) becomes a relative path.
        $html = preg_replace_callback(
            '#'.preg_quote($prodBase, '#').'(/[^"\'\s)<]*)#',
            function ($m) use ($fromDir, $prodBase) {
                $static = resolveTarget($m[1], $prodBase, absolute: false);

                return relativePath($fromDir, $static);
            },
            $html
        );
    }

    foreach ($protected as $token => $value) {
        $html = str_replace($token, $value, $html);
    }

    return $html;
}

function resolveTarget(string $path, string $prodBase, bool $absolute = true): string
{
    $fragment = '';
    if (($hashPos = strpos($path, '#')) !== false) {
        $fragment = substr($path, $hashPos);
        $path = substr($path, 0, $hashPos);
    }

    $static = toStaticPath($path, $fragment) ?? ($path.$fragment);

    return $absolute ? $prodBase.$static : $static;
}

function writeFile(string $path, string $content): void
{
    @mkdir(dirname($path), 0777, true);
    file_put_contents($path, $content);
    fwrite(STDERR, "wrote {$path} (".strlen($content)." bytes)\n");
}

// Portable recursive delete (works on Windows and Linux, unlike `rm -rf`
// via exec(), which isn't guaranteed to be on PATH on Windows).
function recursiveDelete(string $dir): void
{
    if (! is_dir($dir)) {
        return;
    }

    foreach (scandir($dir) as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }

        $path = $dir.DIRECTORY_SEPARATOR.$entry;
        if (is_dir($path)) {
            recursiveDelete($path);
        } else {
            @unlink($path);
        }
    }

    @rmdir($dir);
}

// Start clean: wipe generated locale trees, sitemap and root 404 so
// removed/renamed pages don't linger as stale files.
foreach ($locales as $locale) {
    recursiveDelete("{$docsDir}/{$locale}");
}
@unlink("{$docsDir}/sitemap.xml");
@unlink("{$docsDir}/404.html");

foreach ($locales as $locale) {
    $pages = [
        ['url' => "{$serveBase}/{$locale}", 'out' => "{$docsDir}/{$locale}/index.html", 'dir' => [$locale]],
        ['url' => "{$serveBase}/{$locale}/projects", 'out' => "{$docsDir}/{$locale}/projects.html", 'dir' => [$locale]],
    ];

    foreach ($slugs as $slug) {
        $pages[] = [
            'url' => "{$serveBase}/{$locale}/projects/{$slug}",
            'out' => "{$docsDir}/{$locale}/projects/{$slug}.html",
            'dir' => [$locale, 'projects'],
        ];
    }

    $pages[] = [
        'url' => "{$serveBase}/{$locale}/__not_found_probe__",
        'out' => "{$docsDir}/{$locale}/404.html",
        'dir' => [$locale],
        'statuses' => [404],
    ];

    foreach ($pages as $page) {
        $html = fetch($page['url'], $page['statuses'] ?? [200]);
        $html = rewriteHtml($html, $serveBase, $prodBase, $page['dir']);
        writeFile($page['out'], $html);
    }
}

// The GitHub Pages root 404.html mirrors the English 404 page verbatim
// (this is the existing, intentional convention in this repo).
copy("{$docsDir}/en/404.html", "{$docsDir}/404.html");
fwrite(STDERR, "wrote {$docsDir}/404.html (copy of en/404.html)\n");

// sitemap.xml stays fully absolute — it's not part of the relative link graph.
$sitemap = fetch("{$serveBase}/sitemap.xml");
$sitemap = rewriteHtml($sitemap, $serveBase, $prodBase, null);
writeFile("{$docsDir}/sitemap.xml", $sitemap);

fwrite(STDERR, "Done.\n");
