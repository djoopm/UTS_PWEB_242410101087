<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — UPA Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-wrapper {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 8px 40px rgba(80, 100, 200, 0.1);
        }

        /* Responsive padding mobile */
        @media (max-width: 480px) {
            .login-wrapper {
                padding: 2rem 1.4rem;
                border-radius: 14px;
            }
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2d3047;
            text-align: center;
            line-height: 1.2;
        }

        @media (max-width: 480px) {
            .login-title { font-size: 1.5rem; }
        }

        .login-subtitle {
            font-size: 1.8rem;
            font-weight: 700;
            color: #3d5af1;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 1.4rem;
        }

        @media (max-width: 480px) {
            .login-subtitle { font-size: 1.5rem; }
        }

        .info-box {
            background: #e8f0fe;
            border-radius: 10px;
            padding: 0.9rem 1.1rem;
            font-size: 0.87rem;
            color: #3d5af1;
            margin-bottom: 1.6rem;
            line-height: 1.5;
        }

        .input-group-custom {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #d0d7f5;
            margin-bottom: 1.4rem;
            padding-bottom: 0.4rem;
            transition: border-color 0.2s;
        }

        .input-group-custom:focus-within {
            border-bottom-color: #3d5af1;
        }

        .input-group-custom i {
            color: #a0aad0;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .input-group-custom input {
            border: none;
            outline: none;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: #2d3047;
            background: transparent;
        }

        .input-group-custom input::placeholder { color: #b0bbd5; }

        /* Error message */
        .error-box {
            background: #fff0f0;
            border: 1.5px solid #ffcccc;
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
            font-size: 0.82rem;
            color: #e53e3e;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .bottom-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .show-password {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.87rem;
            font-weight: 500;
            color: #2d3047;
        }

        .toggle { position: relative; width: 38px; height: 22px; flex-shrink: 0; }
        .toggle input { display: none; }
        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #d0d7f5;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 16px; height: 16px;
            background: #fff;
            border-radius: 50%;
            top: 3px; left: 3px;
            transition: transform 0.2s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }
        .toggle input:checked + .toggle-slider { background: #3d5af1; }
        .toggle input:checked + .toggle-slider::before { transform: translateX(16px); }

        .btn-login {
            background: #3d5af1;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.6rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            white-space: nowrap;
        }

        .btn-login:hover { background: #2a44d4; transform: translateY(-1px); }

        /* Di mobile tombol login full width */
        @media (max-width: 400px) {
            .bottom-row { flex-direction: column; align-items: stretch; }
            .btn-login { width: 100%; text-align: center; }
        }

        .back-link {
            font-size: 0.84rem;
            color: #6b7aaa;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: color 0.2s;
        }

        .back-link:hover { color: #3d5af1; }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.78rem;
            color: #b0bbd5;
        }

        .footer-text span { color: #3d5af1; font-weight: 500; }
    </style>
</head>
<body>
    <div class="login-wrapper">

        <div class="login-title">Laman Login</div>
        <div class="login-subtitle">UPA Perpustakaan</div>

        <div class="info-box">
            Silahkan login dengan Username kamu untuk masuk ke sistem perpustakaan digital.
        </div>

        <!-- err validation -->
        @if(session('error'))
        <div class="error-box">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="input-group-custom">
                <i class="bi bi-person"></i>
                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                    autocomplete="off"
                >
            </div>
            @error('username')
                <div class="error-box" style="margin-top:-1rem; margin-bottom:1rem;">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                </div>
            @enderror

            <div class="input-group-custom">
                <i class="bi bi-lock"></i>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    id="passwordInput"
                >
            </div>

            <div class="bottom-row">
                <div class="show-password">
                    <label class="toggle">
                        <input type="checkbox" id="togglePassword">
                        <span class="toggle-slider"></span>
                    </label>
                    Show Password
                </div>
                <button type="submit" class="btn-login">Log In</button>
            </div>

        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Home page
        </a>

        <div class="footer-text">
            &copy; {{ date('Y') }} by <span>UPA Perpustakaan</span>
        </div>

    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('change', function() {
            const pw = document.getElementById('passwordInput');
            pw.type = this.checked ? 'text' : 'password';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>