<section id="home" class="section hero">
    <div class="container hero__grid">
        <div class="hero__content" data-reveal>
            <div class="hero__status">
                <span class="hero__status-pulse">
                    <span class="hero__status-ping"></span>
                    <span class="hero__status-dot"></span>
                </span>
                <span class="hero__status-text">{{ __('general.site_role') }} · {{ __('hero.location') }}</span>
                <span class="hero__status-badge meta">v3.24</span>
            </div>

            <h1 class="hero__title">{{ __('general.site_name') }}</h1>
            <p class="hero__lead">{{ __('hero.statement') }}</p>

            <div class="hero__actions">
                <a href="#projects" class="btn btn--primary btn--lg hero__btn-primary">
                    <span>{{ __('navigation.view_projects') }}</span>
                    <x-ui.icon name="arrow-right" size="18" class="icon--directional hero__btn-arrow" />
                </a>
                <a href="#contact" class="btn btn--ghost btn--lg">
                    <span>{{ __('navigation.contact_me') }}</span>
                </a>
                @if($hasCv)
                    <a href="{{ asset(config('portfolio.cv_path')) }}" class="hero__cv-link" download>
                        <x-ui.icon name="download" size="15" />
                        <span>{{ __('navigation.download_cv') }}</span>
                    </a>
                @endif
            </div>

            <div class="hero__stats" data-card-glow>
                <div class="hero__stat">
                    <span class="hero__stat-num">{{ __('hero.stats.years.value') }}</span>
                    <span class="hero__stat-label">{{ __('hero.stats.years.label') }}</span>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <span class="hero__stat-num">{{ __('hero.stats.apps.value') }}</span>
                    <span class="hero__stat-label">{{ __('hero.stats.apps.label') }}</span>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <span class="hero__stat-num">{{ __('hero.stats.quality.value') }}</span>
                    <span class="hero__stat-label">{{ __('hero.stats.quality.label') }}</span>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <span class="hero__stat-num">{{ __('hero.stats.focus.value') }}</span>
                    <span class="hero__stat-label">{{ __('hero.stats.focus.label') }}</span>
                </div>
            </div>
        </div>

        <div class="hero__visual" data-reveal>
            <div class="hero__console" data-tilt-card data-card-glow>
                <div class="hero__console-header">
                    <div class="hero__console-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="hero__console-meta">
                        <span class="meta-tag"><x-ui.icon name="git-branch" size="12" /> main</span>
                        <span class="meta-tag meta-tag--hash">7f3a9e2</span>
                    </div>
                    <div class="hero__console-tabs" role="tablist">
                        <button type="button" class="hero__console-tab is-active" data-tab-target="tab-arch" role="tab" aria-selected="true">
                            <x-ui.icon name="layers" size="13" />
                            <span>{{ __('hero.console.tabs.architecture') }}</span>
                        </button>
                        <button type="button" class="hero__console-tab" data-tab-target="tab-code" role="tab" aria-selected="false">
                            <x-ui.icon name="terminal" size="13" />
                            <span>{{ __('hero.console.tabs.code') }}</span>
                        </button>
                        <button type="button" class="hero__console-tab" data-tab-target="tab-perf" role="tab" aria-selected="false">
                            <x-ui.icon name="gauge" size="13" />
                            <span>{{ __('hero.console.tabs.metrics') }}</span>
                        </button>
                    </div>
                </div>

                <div class="hero__console-body">
                    <!-- Tab 1: Architecture with Animated Data-Flow -->
                    <div class="hero__tab-content is-active" id="tab-arch" role="tabpanel">
                        <div class="arch-diagram">
                            <div class="arch-layer arch-layer--presentation">
                                <div class="arch-layer__badge">
                                    <span class="arch-layer__pill">UI & State</span>
                                    <span class="arch-layer__title">Presentation Layer</span>
                                </div>
                                <div class="arch-layer__items">
                                    <span class="arch-chip">Flutter UI</span>
                                    <span class="arch-chip">BLoC / Cubit</span>
                                    <span class="arch-chip">Riverpod</span>
                                </div>
                            </div>

                            <div class="arch-connector">
                                <div class="arch-connector__track">
                                    <span class="arch-particle arch-particle--down"></span>
                                    <span class="arch-particle arch-particle--up"></span>
                                </div>
                            </div>

                            <div class="arch-layer arch-layer--domain">
                                <div class="arch-layer__badge">
                                    <span class="arch-layer__pill">Core Logic</span>
                                    <span class="arch-layer__title">Domain Layer</span>
                                </div>
                                <div class="arch-layer__items">
                                    <span class="arch-chip">Use Cases</span>
                                    <span class="arch-chip">Pure Entities</span>
                                    <span class="arch-chip">Repository Contracts</span>
                                </div>
                            </div>

                            <div class="arch-connector">
                                <div class="arch-connector__track">
                                    <span class="arch-particle arch-particle--down"></span>
                                    <span class="arch-particle arch-particle--up"></span>
                                </div>
                            </div>

                            <div class="arch-layer arch-layer--data">
                                <div class="arch-layer__badge">
                                    <span class="arch-layer__pill">Sources</span>
                                    <span class="arch-layer__title">Data Layer</span>
                                </div>
                                <div class="arch-layer__items">
                                    <span class="arch-chip">REST APIs / Dio</span>
                                    <span class="arch-chip">SQLite / Hive</span>
                                    <span class="arch-chip">Firebase</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Code Snippet & Interactive State Transition -->
                    <div class="hero__tab-content" id="tab-code" role="tabpanel" hidden>
                        <div class="code-interactive-bar">
                            <span class="code-state-label">{{ __('hero.console.state_machine_label') }}</span>
                            <div class="code-state-pills">
                                <button type="button" class="state-pill is-active" data-state="initial">{{ __('hero.console.states.initial') }}</button>
                                <button type="button" class="state-pill" data-state="loading">{{ __('hero.console.states.loading') }}</button>
                                <button type="button" class="state-pill" data-state="success">{{ __('hero.console.states.success') }}</button>
                            </div>
                            <span class="code-state-output" id="state-output">AuthState.initial()</span>
                        </div>

                        <pre class="code-preview"><code><span class="code-kw">class</span> <span class="code-class">AuthBloc</span> <span class="code-kw">extends</span> <span class="code-class">Bloc</span>&lt;<span class="code-type">AuthEvent</span>, <span class="code-type">AuthState</span>&gt; {
  <span class="code-kw">final</span> <span class="code-type">SignInUseCase</span> <span class="code-var">_signIn</span>;

  <span class="code-class">AuthBloc</span>({<span class="code-kw">required</span> <span class="code-type">SignInUseCase</span> signIn})
      : <span class="code-var">_signIn</span> = signIn,
        <span class="code-kw">super</span>(<span class="code-kw">const</span> <span class="code-class">AuthState</span>.<span class="code-fn">initial</span>()) {
    <span class="code-fn">on</span>&lt;<span class="code-class">SignInSubmitted</span>&gt;(_onSignInSubmitted);
  }

  <span class="code-type">Future</span>&lt;<span class="code-type">void</span>&gt; _onSignInSubmitted(
    <span class="code-class">SignInSubmitted</span> event,
    <span class="code-class">Emitter</span>&lt;<span class="code-type">AuthState</span>&gt; emit,
  ) <span class="code-kw">async</span> {
    <span class="code-fn">emit</span>(<span class="code-kw">const</span> <span class="code-class">AuthState</span>.<span class="code-fn">loading</span>());
    <span class="code-kw">final</span> result = <span class="code-kw">await</span> <span class="code-var">_signIn</span>(event.params);
    result.<span class="code-fn">fold</span>(
      (failure) =&gt; <span class="code-fn">emit</span>(<span class="code-class">AuthState</span>.<span class="code-fn">error</span>(failure.message)),
      (user) =&gt; <span class="code-fn">emit</span>(<span class="code-class">AuthState</span>.<span class="code-fn">authenticated</span>(user)),
    );
  }
}<span class="typing-caret"></span></code></pre>
                    </div>

                    <!-- Tab 3: Performance Metrics -->
                    <div class="hero__tab-content" id="tab-perf" role="tabpanel" hidden>
                        <div class="perf-metrics">
                            <div class="perf-card">
                                <div class="perf-card__header">
                                    <span class="perf-card__name">{{ __('hero.console.metrics.frame_rate.label') }}</span>
                                    <span class="perf-card__value">60.0 FPS</span>
                                </div>
                                <div class="perf-bar"><div class="perf-bar__fill" style="width: 100%;"></div></div>
                                <span class="perf-card__meta">{{ __('hero.console.metrics.frame_rate.meta') }}</span>
                            </div>

                            <div class="perf-card">
                                <div class="perf-card__header">
                                    <span class="perf-card__name">{{ __('hero.console.metrics.test_coverage.label') }}</span>
                                    <span class="perf-card__value">88.5%</span>
                                </div>
                                <div class="perf-bar"><div class="perf-bar__fill perf-bar__fill--cyan" style="width: 88.5%;"></div></div>
                                <span class="perf-card__meta">{{ __('hero.console.metrics.test_coverage.meta') }}</span>
                            </div>

                            <div class="perf-card">
                                <div class="perf-card__header">
                                    <span class="perf-card__name">{{ __('hero.console.metrics.cold_startup.label') }}</span>
                                    <span class="perf-card__value">&lt; 380 ms</span>
                                </div>
                                <div class="perf-bar"><div class="perf-bar__fill perf-bar__fill--emerald" style="width: 95%;"></div></div>
                                <span class="perf-card__meta">{{ __('hero.console.metrics.cold_startup.meta') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero__console-footer">
                    <div class="console-status">
                        <span class="console-status__dot"></span>
                        <span class="console-status__text">{{ __('hero.console.footer_status') }}</span>
                    </div>
                    <span class="console-version">{{ __('hero.console.footer_version') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
