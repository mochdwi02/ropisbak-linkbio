<!DOCTYPE html>
<html lang="id" class="light-style customizer-hide">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>

    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" />

    @php
        $theme = config('linkbio.theme');
        $brandName = config('linkbio.brand_name');
        $brandShort = config('linkbio.brand_short', 'LB');
    @endphp

    <style>
        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,.28), transparent 35%),
                linear-gradient(180deg, {{ $theme['bg'] ?? '#dfc09e' }} 0%, {{ $theme['bg_soft'] ?? '#f4e6d4' }} 100%);
        }

        .auth-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            border-radius: 1.45rem;
            border: 1px solid rgba(141,103,72,.18);
            box-shadow: 0 26px 60px rgba(78, 57, 35, .14);
            overflow: hidden;
        }

        .auth-top {
            padding: 1.75rem 1.5rem 1rem;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,255,255,.24), rgba(255,255,255,0));
        }

        .auth-logo-wrap {
            width: 88px;
            height: 88px;
            margin: 0 auto 1rem;
            position: relative;
        }

        .auth-brand-logo,
        .auth-brand-fallback {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,.86);
            box-shadow: 0 14px 30px rgba(0,0,0,.10);
        }

        .auth-brand-logo {
            object-fit: cover;
            display: block;
            background: #fff;
        }

        .auth-brand-fallback {
            display: none;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, {{ $theme['border'] ?? '#8d6748' }}, #493022);
            color: #fff8ef;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .auth-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: {{ $theme['text'] ?? '#2f1d11' }};
            margin-bottom: .35rem;
        }

        .auth-subtitle {
            color: {{ $theme['muted'] ?? '#73543b' }};
            font-size: .92rem;
            line-height: 1.55;
        }

        .auth-body {
            padding: 1.4rem 1.5rem 1.6rem;
            background: #fff;
        }

        .btn-brand {
            background: {{ $theme['border'] ?? '#8d6748' }};
            border-color: {{ $theme['border'] ?? '#8d6748' }};
        }

        .btn-brand:hover,
        .btn-brand:focus {
            background: #745239;
            border-color: #745239;
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="card auth-card">
            <div class="auth-top">
                <div class="auth-logo-wrap">
                    <img src="{{ asset(config('linkbio.profile_image')) }}" alt="{{ $brandName }}" class="auth-brand-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="auth-brand-fallback">{{ $brandShort }}</div>
                </div>
                <div class="auth-title">{{ $brandName }}</div>
                <div class="auth-subtitle">Masuk ke dashboard untuk mengatur landing page, tombol link, dan melihat analytics klik pengunjung.</div>
            </div>

            <div class="auth-body">
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-brand text-white d-grid w-100">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
