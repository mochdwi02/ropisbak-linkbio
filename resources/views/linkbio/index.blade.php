<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('linkbio.brand_name') }}</title>
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}">
    @php
        $theme = config('linkbio.theme');
        $brandName = config('linkbio.brand_name');
        $brandShort = config('linkbio.brand_short', 'LB');
        $featurePills = config('linkbio.feature_pills', []);
    @endphp
    <style>
        :root {
            --bg: {{ $theme['bg'] ?? '#dfc09e' }};
            --bg-soft: {{ $theme['bg_soft'] ?? '#f4e6d4' }};
            --card: {{ $theme['card'] ?? '#efd8bb' }};
            --surface: {{ $theme['surface'] ?? '#fffdf8' }};
            --surface-soft: {{ $theme['surface_soft'] ?? '#f9f0e5' }};
            --text: {{ $theme['text'] ?? '#2f1d11' }};
            --muted: {{ $theme['muted'] ?? '#73543b' }};
            --border: {{ $theme['border'] ?? '#8d6748' }};
            --shadow: {{ $theme['shadow'] ?? 'rgba(101,67,35,0.18)' }};
            --accent: {{ $theme['accent'] ?? '#c68a50' }};
            --accent-soft: {{ $theme['accent_soft'] ?? '#fbe2c6' }};
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, Helvetica, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top center, rgba(255,255,255,.35), transparent 25%),
                linear-gradient(180deg, var(--bg) 0%, var(--bg-soft) 100%);
        }

        .page-wrap {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 24px 14px 38px;
        }

        .mobile-shell {
            width: 100%;
            max-width: 480px;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(255,255,255,.18), rgba(255,255,255,.04)), var(--card);
            border-radius: 32px;
            padding: 26px 20px 22px;
            text-align: center;
            box-shadow: 0 28px 60px var(--shadow);
            margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,.25);
        }

        .hero-card::before,
        .hero-card::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            pointer-events: none;
        }

        .hero-card::before {
            width: 150px;
            height: 150px;
            top: -70px;
            right: -48px;
        }

        .hero-card::after {
            width: 96px;
            height: 96px;
            bottom: -32px;
            left: -12px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .46rem .86rem;
            border-radius: 999px;
            background: rgba(255,255,255,.45);
            color: var(--muted);
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .02em;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .logo-stack {
            width: 98px;
            height: 98px;
            margin: 0 auto 14px;
            position: relative;
            z-index: 1;
        }

        .logo-image,
        .logo-fallback {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,.86);
            box-shadow: 0 14px 30px rgba(0,0,0,.12);
        }

        .logo-image {
            object-fit: cover;
            display: block;
            background: #fff;
        }

        .logo-fallback {
            display: none;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--text), #4b2f1e);
            color: #fff8ef;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .brand-title {
            margin: 0 0 8px;
            font-size: 1.78rem;
            font-weight: 800;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .brand-desc,
        .brand-subdesc {
            margin: 0;
            color: var(--muted);
            position: relative;
            z-index: 1;
        }

        .brand-desc {
            font-size: .97rem;
            margin-bottom: .4rem;
        }

        .brand-subdesc {
            font-size: .88rem;
        }

        .pill-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: .5rem;
            margin-top: 1rem;
            position: relative;
            z-index: 1;
        }

        .pill-row span {
            display: inline-flex;
            align-items: center;
            gap: .32rem;
            padding: .46rem .82rem;
            border-radius: 999px;
            background: rgba(255,255,255,.42);
            color: var(--text);
            font-size: .76rem;
            font-weight: 700;
        }

        .group-block + .group-block {
            margin-top: 1.15rem;
        }

        .group-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            margin: 0 0 12px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-size: .76rem;
            font-weight: 800;
            color: #4d3825;
        }

        .group-label::before,
        .group-label::after {
            content: '';
            height: 1px;
            flex: 1;
            max-width: 76px;
            background: rgba(77,56,37,.22);
        }

        .link-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .bio-button {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            min-height: 68px;
            padding: 11px 16px;
            background: rgba(255,255,255,.97);
            border: 2px solid var(--border);
            border-radius: 999px;
            box-shadow: 0 8px 0 rgba(141, 103, 72, .28);
            text-decoration: none;
            color: #171717;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }

        .bio-button:hover {
            background: var(--surface);
            transform: translateY(2px);
            box-shadow: 0 5px 0 rgba(141, 103, 72, .28);
        }

        .bio-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--surface-soft);
            color: var(--border);
            flex-shrink: 0;
            font-size: 1.35rem;
        }

        .bio-text {
            flex: 1;
            text-align: center;
            font-size: .96rem;
            font-weight: 700;
            padding-right: 8px;
            line-height: 1.35;
        }

        .bio-arrow {
            color: var(--border);
            font-size: 1.18rem;
            line-height: 1;
            flex-shrink: 0;
        }

        .empty-state {
            background: rgba(255,255,255,.62);
            border: 1px dashed rgba(77,56,37,.24);
            color: var(--muted);
            border-radius: 24px;
            padding: 20px;
            text-align: center;
            font-size: .92rem;
        }

        .social-footer {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
        }

        .social-footer a {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.82);
            border: 1px solid rgba(75, 56, 34, .12);
            color: #3b2a1a;
            text-decoration: none;
            font-size: 1.35rem;
            box-shadow: 0 10px 22px rgba(94, 68, 41, .08);
        }

        .footer-note {
            text-align: center;
            font-size: .74rem;
            margin-top: 14px;
            color: #6d5742;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .page-wrap { padding: 18px 12px 30px; }
            .hero-card { border-radius: 28px; padding: 22px 16px 18px; }
            .brand-title { font-size: 1.52rem; }
            .bio-button { min-height: 64px; padding-inline: 14px; }
            .bio-text { font-size: .9rem; }
            .group-label::before,
            .group-label::after { max-width: 52px; }
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="mobile-shell">
            <div class="hero-card">
                <div class="hero-badge">
                    <i class='bx bx-star'></i>
                    <span>{{ config('linkbio.hero_badge') }}</span>
                </div>

                <div class="logo-stack">
                    <img src="{{ asset(config('linkbio.profile_image')) }}" alt="{{ $brandName }}" class="logo-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-fallback">{{ $brandShort }}</div>
                </div>

                <h1 class="brand-title">{{ $brandName }}</h1>
                <p class="brand-desc">{{ config('linkbio.brand_description') }}</p>
                <p class="brand-subdesc">{{ config('linkbio.brand_subdescription') }}</p>

                @if(!empty($featurePills))
                    <div class="pill-row">
                        @foreach($featurePills as $pill)
                            <span><i class='bx bx-check-circle'></i> {{ $pill }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            @forelse($groupedLinks as $category => $items)
                <section class="group-block">
                    <div class="group-label">{{ $category }}</div>

                    <div class="link-stack">
                        @foreach($items as $link)
                            <a href="{{ route('bio.go', $link) }}" class="bio-button" target="_blank" rel="noopener noreferrer">
                                <span class="bio-icon">
                                    <i class="{{ $link->icon ?: 'bx bx-link-alt' }}"></i>
                                </span>
                                <span class="bio-text">{{ $link->title }}</span>
                                <span class="bio-arrow"><i class='bx bx-chevron-right'></i></span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="empty-state">
                    Belum ada link aktif yang ditampilkan. Tambahkan link dari dashboard admin terlebih dahulu.
                </div>
            @endforelse

            <div class="social-footer">
                @foreach(config('linkbio.socials', []) as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] ?? 'Social' }}">
                        <i class="bx {{ $social['icon'] }}"></i>
                    </a>
                @endforeach
            </div>

            <div class="footer-note">
                © {{ date('Y') }} {{ $brandName }}<br>
                {{ config('linkbio.footer_note') }}
            </div>
        </div>
    </div>
</body>
</html>
