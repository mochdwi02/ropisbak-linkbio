<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin Link Bio')</title>

    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />

    @php
        $theme = config('linkbio.theme');
        $brandName = config('linkbio.brand_name');
        $brandShort = config('linkbio.brand_short', 'LB');
    @endphp

    <style>
        :root {
            --brand-primary: {{ $theme['border'] ?? '#8d6748' }};
            --brand-accent: {{ $theme['accent'] ?? '#c68a50' }};
            --brand-soft: {{ $theme['surface_soft'] ?? '#f9f0e5' }};
            --brand-bg: #f7f2ec;
            --brand-text: {{ $theme['text'] ?? '#2f1d11' }};
            --brand-muted: {{ $theme['muted'] ?? '#73543b' }};
            --brand-border: rgba(141, 103, 72, .16);
            --brand-shadow: 0 20px 45px rgba(94, 68, 41, .08);
            --brand-radius: 1.25rem;
        }

        body {
            background: linear-gradient(180deg, #f8f4ef 0%, #f4efe8 100%);
        }

        .layout-navbar {
            border-radius: 1.1rem;
            box-shadow: var(--brand-shadow);
        }

        .app-brand-shell {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .app-brand-logo-mini,
        .app-brand-logo-fallback {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.68);
            box-shadow: 0 8px 18px rgba(0,0,0,.08);
        }

        .app-brand-logo-mini {
            object-fit: cover;
            background: #fff;
            display: block;
        }

        .app-brand-logo-fallback {
            display: none;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--brand-primary), #4c3020);
            color: #fff8ef;
            font-size: .85rem;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .app-brand-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .app-brand-title {
            font-weight: 700;
            color: var(--brand-text);
        }

        .app-brand-note {
            font-size: .72rem;
            color: var(--brand-muted);
            margin-top: .18rem;
        }

        .page-subtitle {
            color: var(--brand-muted);
            font-size: .86rem;
        }

        .card,
        .navbar-detached,
        .bg-navbar-theme {
            border: 1px solid var(--brand-border);
            box-shadow: var(--brand-shadow);
        }

        .content-card {
            border-radius: var(--brand-radius);
        }

        .metric-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.1rem;
        }

        .metric-card::after {
            content: '';
            position: absolute;
            inset: auto -28px -28px auto;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: rgba(141, 103, 72, .08);
        }

        .metric-card .metric-label {
            font-size: .8rem;
            color: #7c6b58;
            margin-bottom: .35rem;
        }

        .metric-card .metric-value {
            font-size: 1.7rem;
            font-weight: 700;
            line-height: 1.1;
            color: var(--brand-text);
        }

        .metric-card .metric-meta {
            font-size: .78rem;
            color: #8a7763;
            margin-top: .5rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--brand-text);
        }

        .section-note {
            color: var(--brand-muted);
            font-size: .85rem;
        }

        .table-actions {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .mobile-list-card {
            border: 1px solid var(--brand-border);
            border-radius: 1rem;
            padding: 1rem;
            background: #fff;
            box-shadow: 0 12px 30px rgba(94, 68, 41, .06);
        }

        .mobile-row {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: .5rem;
            font-size: .86rem;
            padding: .2rem 0;
        }

        .mobile-row .label {
            color: #8a7663;
        }

        .rank-pill {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--brand-soft);
            color: var(--brand-primary);
            font-weight: 700;
            flex-shrink: 0;
        }

        .soft-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .35rem .65rem;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand-primary);
            font-size: .78rem;
            font-weight: 600;
        }

        .search-card,
        .highlight-card {
            border-radius: var(--brand-radius);
        }

        .progress-thin {
            height: .45rem;
            border-radius: 999px;
            background: #f1e7dd;
        }

        .progress-thin .progress-bar {
            background: var(--brand-primary);
            border-radius: 999px;
        }

        .desktop-only { display: block; }
        .mobile-only { display: none; }

        @media (max-width: 991.98px) {
            .layout-navbar .btn {
                padding-inline: .8rem;
            }

            .desktop-only { display: none !important; }
            .mobile-only { display: block !important; }

            .layout-page .container-xxl {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .mobile-row {
                grid-template-columns: 92px 1fr;
            }

            .layout-navbar {
                padding: .9rem 1rem;
            }

            .page-header-stack {
                align-items: flex-start !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('admin.dashboard') }}" class="app-brand-link app-brand-shell">
                        <img src="{{ asset(config('linkbio.profile_image')) }}" alt="logo" class="app-brand-logo-mini" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="app-brand-logo-fallback">{{ $brandShort }}</div>
                        <div class="app-brand-meta">
                            <span class="app-brand-title">{{ $brandName }}</span>
                            <span class="app-brand-note">Admin link bio</span>
                        </div>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Main Menu</span>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.links.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.links.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-link"></i>
                            <div>Kelola Link</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                        <a href="{{ route('admin.analytics') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-line-chart"></i>
                            <div>Analytics</div>
                        </a>
                    </li>
                </ul>
            </aside>

            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center w-100 justify-content-between gap-3 page-header-stack">
                        <div class="d-flex align-items-center gap-2">
                            <a class="layout-menu-toggle navbar-nav align-items-xl-center me-2 d-xl-none text-body" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                            <div>
                                <h5 class="mb-1">@yield('page_title', 'Admin Link Bio')</h5>
                                <div class="page-subtitle">Kelola tampilan publik, susunan link, dan histori klik {{ $brandName }} dalam satu panel.</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-end">
                            <a href="{{ route('bio.home') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-show-alt me-1"></i> Preview
                            </a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bx bx-log-out me-1"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <div class="fw-semibold mb-1">Ada data yang perlu diperbaiki.</div>
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
