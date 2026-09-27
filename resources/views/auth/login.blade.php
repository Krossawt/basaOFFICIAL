<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BASA School Management System — Sign in to your account">
    <title>Sign In — BASA</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ─── Reset & Base ─────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:       #0F172A;
            --navy-800:   #1E293B;
            --navy-700:   #334155;
            --navy-600:   #475569;
            --gold:       #F59E0B;
            --gold-dark:  #D97706;
            --gold-light: #FDE68A;
            --white:      #FFFFFF;
            --gray-100:   #F1F5F9;
            --gray-300:   #CBD5E1;
            --gray-400:   #94A3B8;
            --error:      #EF4444;
            --success:    #10B981;
            --radius-sm:  6px;
            --radius-md:  12px;
            --radius-lg:  20px;
            --shadow-card: 0 25px 60px rgba(0,0,0,0.45);
            --shadow-input: 0 0 0 3px rgba(245,158,11,0.25);
            --transition: 0.22s cubic-bezier(0.4,0,0.2,1);
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ─── Background ────────────────────────────────────── */
        body {
            background: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Animated gradient orbs */
        body::before {
            content: '';
            position: fixed;
            top: -30%;
            left: -20%;
            width: 65vw;
            height: 65vw;
            background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: orb1 12s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            right: -20%;
            width: 55vw;
            height: 55vw;
            background: radial-gradient(circle, rgba(99,102,241,0.10) 0%, transparent 70%);
            border-radius: 50%;
            animation: orb2 15s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        /* Grid lines overlay */
        .grid-overlay {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes orb1 {
            0%   { transform: translate(0,0) scale(1); }
            100% { transform: translate(8%,6%) scale(1.12); }
        }
        @keyframes orb2 {
            0%   { transform: translate(0,0) scale(1); }
            100% { transform: translate(-6%,-8%) scale(1.08); }
        }

        /* ─── Card ──────────────────────────────────────────── */
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 16px;
            animation: slideUp 0.55s cubic-bezier(0.16,1,0.3,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            background: rgba(30, 41, 59, 0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius-lg);
            padding: 44px 40px;
            box-shadow: var(--shadow-card);
        }

        /* ─── Logo & Header ─────────────────────────────────── */
        .logo-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-ring {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid rgba(245,158,11,0.35);
            padding: 5px;
            margin-bottom: 20px;
            position: relative;
            animation: rotateBorder 8s linear infinite;
            background: radial-gradient(circle at 50% 0%, rgba(245,158,11,0.08) 0%, transparent 70%);
        }

        @keyframes rotateBorder {
            0%   { box-shadow: 0 0 0 0 rgba(245,158,11,0.1),  0 0 20px rgba(245,158,11,0.05); }
            50%  { box-shadow: 0 0 0 6px rgba(245,158,11,0.06), 0 0 30px rgba(245,158,11,0.10); }
            100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.1),  0 0 20px rgba(245,158,11,0.05); }
        }

        .logo-ring img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--white);
            text-transform: uppercase;
        }

        .brand-name span {
            color: var(--gold);
        }

        .brand-tagline {
            font-size: 12px;
            font-weight: 400;
            color: var(--gray-400);
            letter-spacing: 0.06em;
            margin-top: 4px;
            text-transform: uppercase;
        }

        /* ─── Divider ───────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }
        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }
        .divider-text {
            font-size: 11px;
            font-weight: 500;
            color: var(--gray-400);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ─── Form ──────────────────────────────────────────── */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--gray-300);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            width: 16px;
            height: 16px;
            pointer-events: none;
            transition: color var(--transition);
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px 14px 12px 40px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: var(--white);
            background: rgba(15,23,42,0.6);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
            -webkit-appearance: none;
        }

        input::placeholder { color: var(--gray-400); }

        input:focus {
            border-color: var(--gold);
            box-shadow: var(--shadow-input);
        }

        input:focus + .focus-label,
        .input-wrap:focus-within .input-icon {
            color: var(--gold);
        }

        /* Password toggle */
        .pwd-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray-400);
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color var(--transition);
        }
        .pwd-toggle:hover { color: var(--gold); }

        /* ─── Error / Validation messages ───────────────────── */
        .field-error {
            font-size: 12px;
            color: var(--error);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: fadeIn 0.2s ease;
        }

        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #FCA5A5;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── Options row ───────────────────────────────────── */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-wrap input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--gold);
            cursor: pointer;
            padding: 0;
            border-radius: 3px;
        }

        .remember-label {
            font-size: 12.5px;
            color: var(--gray-300);
            font-weight: 400;
            cursor: pointer;
            user-select: none;
        }

        /* ─── Submit Button ─────────────────────────────────── */
        .btn-login {
            width: 100%;
            padding: 13px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--navy);
            background: linear-gradient(135deg, var(--gold) 0%, #FBBF24 50%, var(--gold-dark) 100%);
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform var(--transition), box-shadow var(--transition), filter var(--transition);
            box-shadow: 0 4px 20px rgba(245,158,11,0.35);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, transparent 60%);
            opacity: 0;
            transition: opacity var(--transition);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(245,158,11,0.50);
            filter: brightness(1.05);
        }
        .btn-login:hover::before { opacity: 1; }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 3px 12px rgba(245,158,11,0.35);
        }

        /* Loading state */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }
        .btn-login .btn-text { display: inline-flex; align-items: center; gap: 8px; }
        .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(15,23,42,0.3);
            border-top-color: var(--navy);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── Footer ────────────────────────────────────────── */
        .card-footer {
            margin-top: 28px;
            text-align: center;
        }

        .footer-divider {
            height: 1px;
            background: rgba(255,255,255,0.07);
            margin-bottom: 20px;
        }

        .school-name {
            font-size: 11px;
            color: var(--gray-400);
            letter-spacing: 0.05em;
        }

        .copyright {
            font-size: 10px;
            color: var(--navy-600);
            margin-top: 6px;
        }

        /* ─── Floating particles ─────────────────────────────── */
        .particles {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(245,158,11,0.4);
            border-radius: 50%;
            animation: floatUp linear infinite;
        }
        @keyframes floatUp {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.4; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        /* ─── Responsive ─────────────────────────────────────── */
        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <!-- Background decorations -->
    <div class="grid-overlay"></div>

    <div class="particles" id="particles"></div>

    <!-- Login Card -->
    <div class="login-wrapper">
        <div class="login-card">

            <!-- Logo & Branding -->
            <div class="logo-section">
                <div class="logo-ring">
                    <img src="{{ asset('basa-logo.jpg') }}" alt="BASA Logo">
                </div>
                <div class="brand-name">B<span>A</span>SA</div>
                <div class="brand-tagline">School Management System</div>
            </div>

            <!-- Alert: general error -->
            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="alert-error" role="alert">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Credential error -->
            @if ($errors->has('email') && str_contains($errors->first('email'), 'credentials'))
                <div class="alert-error" role="alert">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    Invalid email or password. Please try again.
                </div>
            @endif

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">Sign in to continue</span>
                <div class="divider-line"></div>
            </div>

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@basa.edu.ph"
                            autocomplete="email"
                            autofocus
                            required
                        >
                    </div>
                    @error('email')
                        @if (!str_contains($message, 'credentials'))
                            <div class="field-error">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </div>
                        @endif
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••••"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="pwd-toggle" id="pwdToggle" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Options -->
                <div class="options-row">
                    <label class="remember-wrap" for="remember">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="remember-label">Remember me</span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-text">
                        <span id="btnLabel">Sign In</span>
                        <span class="spinner" id="btnSpinner"></span>
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="card-footer">
                <div class="footer-divider"></div>
                <div class="school-name">BASA School Management System</div>
                <div class="copyright">&copy; {{ date('Y') }} BASA. All rights reserved.</div>
            </div>

        </div>
    </div>

    <script>
        // ── Password toggle ───────────────────────────────────
        const pwdInput  = document.getElementById('password');
        const pwdToggle = document.getElementById('pwdToggle');
        const eyeIcon   = document.getElementById('eyeIcon');

        const eyeOpenPath  = 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z';
        const eyeClosedSVG = `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;

        let pwdVisible = false;
        pwdToggle.addEventListener('click', () => {
            pwdVisible = !pwdVisible;
            pwdInput.type = pwdVisible ? 'text' : 'password';
            eyeIcon.innerHTML = pwdVisible
                ? eyeClosedSVG
                : `<path stroke-linecap="round" stroke-linejoin="round" d="${eyeOpenPath}"/>`;
        });

        // ── Loading state on submit ───────────────────────────
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn     = document.getElementById('loginBtn');
            const label   = document.getElementById('btnLabel');
            const spinner = document.getElementById('btnSpinner');
            btn.classList.add('loading');
            label.textContent = 'Signing in…';
            spinner.style.display = 'block';
        });

        // ── Floating particles ────────────────────────────────
        const container = document.getElementById('particles');
        const count = 18;

        for (let i = 0; i < count; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const size = Math.random() * 3 + 1;
            p.style.cssText = `
                left: ${Math.random() * 100}%;
                width: ${size}px;
                height: ${size}px;
                opacity: ${Math.random() * 0.5 + 0.1};
                animation-duration: ${Math.random() * 18 + 12}s;
                animation-delay: ${Math.random() * 12}s;
            `;
            container.appendChild(p);
        }
    </script>
</body>
</html>
