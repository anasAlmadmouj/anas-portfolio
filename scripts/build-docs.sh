#!/usr/bin/env bash
#
# Regenerates /docs (the GitHub Pages static mirror) from the Laravel app.
# Used both by .github/workflows/deploy-docs.yml and for local dry-runs.
#
# Requires: PHP + composer deps installed, Node + npm deps installed.
# Does NOT install dependencies itself — the caller (CI job or developer)
# is expected to have already run `composer install` / `npm ci`.

set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."

PORT="${DOCS_BUILD_PORT:-8123}"
SERVE_BASE="http://127.0.0.1:${PORT}"
PROD_BASE="${DOCS_PROD_BASE:-https://anasalmadmouj.github.io/anas-portfolio}"
DOCS_DIR="$(pwd)/docs"

echo "==> Building frontend assets"
npm run build

echo "==> Preparing database (sqlite; created only if missing, migrated non-destructively)"
export DB_CONNECTION=sqlite
DB_FILE="$(pwd)/database/database.sqlite"
[ -f "$DB_FILE" ] || : > "$DB_FILE"
php artisan migrate --force

echo "==> Starting php artisan serve on port ${PORT}"
php artisan serve --port="${PORT}" > /tmp/artisan-serve.log 2>&1 &
SERVE_PID=$!

cleanup() {
    kill "${SERVE_PID}" 2>/dev/null || true
    wait "${SERVE_PID}" 2>/dev/null || true
}
trap cleanup EXIT

echo "==> Waiting for the server to respond"
for i in $(seq 1 30); do
    if curl -s -o /dev/null "${SERVE_BASE}/en"; then
        break
    fi
    if [ "$i" -eq 30 ]; then
        echo "Server did not come up in time" >&2
        cat /tmp/artisan-serve.log >&2
        exit 1
    fi
    sleep 1
done

echo "==> Crawling routes and rewriting /docs"
php scripts/generate-docs.php "${SERVE_BASE}" "${PROD_BASE}" "${DOCS_DIR}"

echo "==> Syncing static assets"
rm -rf "${DOCS_DIR}/build" "${DOCS_DIR}/images"
cp -r public/build "${DOCS_DIR}/build"
cp -r public/images "${DOCS_DIR}/images"
cp public/favicon.ico "${DOCS_DIR}/favicon.ico"

sed "s#Sitemap: /sitemap.xml#Sitemap: ${PROD_BASE}/sitemap.xml#" public/robots.txt > "${DOCS_DIR}/robots.txt"

echo "==> /docs regenerated successfully"
