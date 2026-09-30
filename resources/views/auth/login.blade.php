<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPANDAI - Login</title>

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
                linear-gradient(rgba(247, 239, 229, 0.58), rgba(247, 239, 229, 0.58)),
                url("{{ asset('images/gerbang2.png') }}") center / cover no-repeat;

            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: -10px;

            background:
                linear-gradient(rgba(247, 239, 229, 0.40), rgba(247, 239, 229, 0.40)),
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

            box-shadow: 0 25px 70px rgba(70, 45, 40, 0.20);
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
            justify-content: center;
            padding: 55px;
        }

        .photo-content {
            width: 100%;
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 80px;
        }

        .brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            object-position: center;
            border-radius: 0;
            background: transparent;
            padding: 0;
        }

        .brand span {
            font-size: 19px;
            font-weight: 700;
        }

        .hero h1 {
            font-size: 53px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .hero p {
            max-width: 420px;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.88);
        }

        .login-side {
            padding: 50px;
            background: var(--cream);

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-content {
            width: 100%;
            max-width: 420px;
        }

        .logo {
            width: 58px;
            height: 58px;
            object-fit: contain;
            object-position: center;
            border-radius: 0;
            background: transparent;
            padding: 0;
            margin-bottom: 25px;
        }

        .login-content h2 {
            color: var(--text);
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .roles {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .role {
            width: 100%;
            min-height: 92px;

            display: flex;
            align-items: center;
            gap: 17px;

            padding: 18px 20px;

            text-decoration: none;

            background: var(--cream-light);
            border: 1px solid #e1d6cc;
            border-radius: 17px;

            transition: 0.2s ease;
        }

        .role:hover {
            border-color: var(--red);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(70, 45, 40, 0.08);
        }

        .role-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: #ead6d1;
            color: var(--red-dark);

            font-size: 18px;
            font-weight: 800;
        }

        .role-info {
            flex: 1;
        }

        .role-info strong {
            display: block;
            color: var(--text);
            font-size: 15px;
            margin-bottom: 4px;
        }

        .role-info span {
            display: block;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
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
                margin-bottom: 45px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .login-side {
                padding: 40px 28px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="photo-side">
            <div class="photo-content">

                <div class="brand">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo SIPANDAI">
                    <span>SIPANDAI</span>
                </div>

                <div class="hero">
                    <h1>Selamat<br>Datang.</h1>

                    <p>
                        Sistem Penilaian dan Ulangan Digital
                        untuk mendukung proses pembelajaran
                        yang lebih mudah dan terarah.
                    </p>
                </div>

            </div>
        </div>

        <div class="login-side">
            <div class="login-content">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SIPANDAI"
                    class="logo"
                >

                <h2>Selamat datang</h2>

                <p class="subtitle">
                    Silakan pilih akses untuk melanjutkan.
                </p>

                <div class="roles">

                    <a href="{{ route('siswa.login') }}" class="role">
                        <div class="role-icon">S</div>

                        <div class="role-info">
                            <strong>Login sebagai Siswa</strong>
                            <span>
                                Masuk untuk mengikuti ujian dan melihat hasil.
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('guru.login') }}" class="role">
                        <div class="role-icon">G</div>

                        <div class="role-info">
                            <strong>Login sebagai Guru</strong>
                            <span>
                                Masuk untuk mengelola ujian dan penilaian.
                            </span>
                        </div>
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