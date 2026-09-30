<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Guru - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --red: #a64b50;
            --red-dark: #87373d;
            --cream: #f7efe5;
            --cream-light: #fffaf4;
            --text: #3d3431;
            --muted: #877b74;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            background:
                linear-gradient(
                    rgba(247, 239, 229, 0.52),
                    rgba(247, 239, 229, 0.52)
                ),
                url("{{ asset('images/gerbang2.png') }}") center / cover no-repeat;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: -10px;
            background:
                linear-gradient(
                    rgba(247, 239, 229, 0.32),
                    rgba(247, 239, 229, 0.32)
                ),
                url("{{ asset('images/gerbang2.png') }}") center / cover no-repeat;
            filter: blur(2px);
            transform: scale(1.02);
            z-index: -1;
        }

        .container {
            width: 1050px;
            max-width: 100%;
            min-height: 620px;
            background: var(--cream-light);
            border-radius: 28px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 52% 48%;
            box-shadow:
                0 25px 70px rgba(70, 45, 40, 0.20);
        }

        .photo-side {
            position: relative;
            min-height: 620px;
            background:
                linear-gradient(
                    rgba(135, 55, 61, 0.72),
                    rgba(166, 75, 80, 0.58)
                ),
                url("{{ asset('images/gerbang2.png') }}") center / cover no-repeat;
            display: flex;
            align-items: center;
            padding: 55px;
        }

        .photo-content {
            width: 100%;
            position: relative;
            z-index: 2;
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 220px;
            transform: translateY(-20px);
        }

        .brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            object-position: center;
            background: transparent;
            border-radius: 0;
            flex-shrink: 0;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-text span {
            font-size: 33px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .brand-text small {
            margin-top: 5px;
            font-size: 8px;
            font-weight: 400;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.78);
        }

        .hero {
            max-width: 450px;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -1.2px;
            margin-bottom: 22px;
        }

        .hero p {
            max-width: 385px;
            font-size: 14px;
            line-height: 1.85;
            color: rgba(255, 255, 255, 0.88);
        }

        .form-side {
            background: var(--cream);
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-content {
            width: 100%;
            max-width: 370px;
        }

        .form-content h2 {
            color: var(--text);
            font-size: 30px;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.6px;
            margin-bottom: 9px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            background: #f8dddd;
            color: #87373d;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            height: 51px;
            border: 1px solid #ded2c8;
            border-radius: 13px;
            padding: 0 16px;
            outline: none;
            background: var(--cream-light);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .form-group input::placeholder {
            color: #aaa09a;
        }

        .form-group input:focus {
            border-color: var(--red);
            box-shadow:
                0 0 0 3px rgba(166, 75, 80, 0.10);
        }

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            color: #9a8e87;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            transition: 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--red);
        }

        .toggle-password svg {
            width: 19px;
            height: 19px;
        }

        .button {
            width: 100%;
            height: 51px;
            border: none;
            border-radius: 13px;
            background: var(--red);
            color: white;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            box-shadow:
                0 8px 18px rgba(166, 75, 80, 0.15);
        }

        .button:hover {
            background: var(--red-dark);
            transform: translateY(-1px);
            box-shadow:
                0 10px 22px rgba(135, 55, 61, 0.18);
        }

        .button:active {
            transform: translateY(0);
        }

        .switch {
            text-align: center;
            margin-top: 23px;
            color: var(--muted);
            font-size: 13px;
        }

        .switch a {
            color: var(--red-dark);
            font-weight: 700;
            text-decoration: none;
            margin-left: 3px;
            transition: 0.2s ease;
        }

        .switch a:hover {
            color: var(--red);
        }

        .footer {
            text-align: center;
            margin-top: 27px;
            color: #9a8e87;
            font-size: 11px;
        }

        @media (max-width: 850px) {

            body {
                padding: 18px;
            }

            .container {
                grid-template-columns: 1fr;
            }

            .photo-side {
                min-height: 320px;
                padding: 35px;
            }

            .brand {
                margin-bottom: 50px;
            }

            .hero h1 {
                font-size: 39px;
            }

            .form-side {
                padding: 40px 28px;
            }
        }

        @media (max-width: 480px) {

            body {
                padding: 12px;
            }

            .container {
                border-radius: 22px;
            }

            .photo-side {
                min-height: 290px;
                padding: 28px;
            }

            .brand {
                margin-bottom: 40px;
            }

            .brand img {
                width: 43px;
                height: 43px;
            }

            .brand span {
                font-size: 17px;
            }

            .hero h1 {
                font-size: 33px;
                letter-spacing: -0.8px;
            }

            .hero p {
                font-size: 13px;
                line-height: 1.7;
            }

            .form-side {
                padding: 35px 24px;
            }

            .form-content h2 {
                font-size: 27px;
            }
        }

    </style>

</head>

<body>

    <div class="container">

        <div class="photo-side">

            <div class="photo-content">

                <div class="brand">

                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo SIPANDAI"
                    >

                    <div class="brand-text">

                        <span>SIPANDAI</span>

                        <small>
                            Sistem Penilaian dan Ulangan Digital
                        </small>

                    </div>

                </div>

                <div class="hero">

                    <h1>
                        Selamat<br>
                        Datang, Guru
                    </h1>

                    <p>
                        Kelola ujian, penilaian, dan hasil belajar
                        siswa dengan mudah melalui SIPANDAI
                    </p>

                </div>

            </div>

        </div>

        <div class="form-side">

            <div class="form-content">

                <h2>
                    Login Guru
                </h2>

                <p class="subtitle">
                    Silakan masuk untuk melanjutkan.
                </p>

                @if(session('success'))

                    <div class="alert">
                        {{ session('success') }}
                    </div>

                @endif

                @if(session('error'))

                    <div class="alert">
                        {{ session('error') }}
                    </div>

                @endif

                @if($errors->any())

                    <div class="alert">
                        {{ $errors->first() }}
                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('guru.login.process') }}"
                >

                    @csrf

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword"
                                aria-label="Tampilkan password"
                            >
                                <svg
                                    id="eyeIcon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />
                                </svg>
                            </button>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="button"
                    >
                        MASUK KE SIPANDAI
                    </button>

                </form>

                <div class="switch">

                    Masuk sebagai siswa?

                    <a href="{{ route('siswa.login') }}">
                        Login Siswa
                    </a>

                </div>

                <div class="footer">
                    © {{ date('Y') }} SIPANDAI
                </div>

            </div>

        </div>

    </div>

    <script>

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {

            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            togglePassword.setAttribute(
                'aria-label',
                isPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );

            if (isPassword) {

                eyeIcon.innerHTML = `
                    <path
                        d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />
                    <path
                        d="M4 4L20 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                `;

            } else {

                eyeIcon.innerHTML = `
                    <path
                        d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />
                `;

            }

        });

    </script>

</body>

</html>
