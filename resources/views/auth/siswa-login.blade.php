<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SIPANDAI</title>
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

        /* =========================
           CONTAINER
        ========================== */

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

        /* =========================
           LEFT SIDE
        ========================== */

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

        /* BRAND */

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

        /* HERO */

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

        /* =========================
           RIGHT SIDE
        ========================== */

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

        /* TITLE */

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

        /* ALERT */

        .alert {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            background: #f8dddd;
            color: #87373d;
        }

        /* FORM */

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

        /* BUTTON */

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

        /* SWITCH */

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

        /* FOOTER */

        .footer {
            text-align: center;
            margin-top: 27px;
            color: #9a8e87;
            font-size: 11px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

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

            .brand-text span {
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

        <!-- =========================
             BAGIAN KIRI
        ========================== -->

        <div class="photo-side">
            <div class="photo-content">

                <div class="brand">
                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo SIPANDAI"
                    >
                    <div class="brand-text">
                        <span>SIPANDAI</span>
                        <small>Sistem Penilaian dan Ulangan Digital</small>
                    </div>
                </div>

                <div class="hero">
                    <h1>
                        Selamat<br>
                        Datang, Siswa
                    </h1>

                    <p>
                        Akses ujian dan lihat hasil belajar
                        dengan mudah melalui SIPANDAI
                    </p>
                </div>

            </div>
        </div>

        <!-- =========================
             BAGIAN KANAN
        ========================== -->

        <div class="form-side">
            <div class="form-content">

                <h2>
                    Login Siswa
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
                    action="{{ route('siswa.login.process') }}"
                >
                    @csrf

                    <div class="form-group">
                        <label for="nisn">
                            NISN
                        </label>

                        <input
                            type="text"
                            id="nisn"
                            name="nisn"
                            value="{{ old('nisn') }}"
                            placeholder="Masukkan NISN"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="tanggal_lahir"
                            name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="button"
                    >
                        MASUK KE SIPANDAI
                    </button>
                </form>

                <div class="switch">
                    Masuk sebagai guru?
                    <a href="{{ route('guru.login') }}">
                        Login Guru
                    </a>
                </div>

                <div class="footer">
                    © {{ date('Y') }} SIPANDAI
                </div>

            </div>
        </div>

    </div>
</body>
</html>