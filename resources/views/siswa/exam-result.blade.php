<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --red: #b3262d;
            --red-dark: #941e25;
            --red-soft: #f8ebec;
            --cream: #faf8f6;
            --white: #ffffff;
            --text: #292929;
            --muted: #777777;
            --line: #eadfe0;
            --green: #2e9b65;
            --wrong: #d75a5a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            background: #222;
        }

        .background-photo {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: -3;
            background-image: url("{{ asset('images/gerbang2.png') }}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            filter: blur(3px);
            transform: scale(1.03);
        }

        .background-overlay {
            position: fixed;
            inset: 0;
            z-index: -2;
            background:
                linear-gradient(
                    135deg,
                    rgba(250, 248, 246, 0.34),
                    rgba(250, 248, 246, 0.18)
                );
        }

        .navbar {
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid rgba(179, 38, 45, 0.10);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            position: relative;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
            border-radius: 0;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--red);
        }

        .page-label {
            padding: 8px 16px;
            border-radius: 999px;
            background: var(--red-soft);
            color: var(--red);
            font-size: 13px;
            font-weight: 600;
        }

        .container {
            width: 100%;
            max-width: 650px;
            margin: 48px auto 50px;
            padding: 0 18px;
            position: relative;
            z-index: 2;
        }

        .result-card {
            position: relative;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(179, 38, 45, 0.20);
            border-radius: 26px;
            overflow: hidden;
            box-shadow:
                0 25px 60px rgba(30, 20, 20, 0.25),
                0 6px 18px rgba(30, 20, 20, 0.10);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .result-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background:
                linear-gradient(
                    90deg,
                    var(--red-dark),
                    var(--red),
                    #ce565c
                );
        }

        .result-header {
            text-align: center;
            padding: 38px 28px 24px;
        }

        .check-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--red-soft);
            color: var(--red);
            font-size: 25px;
            font-weight: 700;
            border: 1px solid rgba(179, 38, 45, 0.10);
        }

        .result-header h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--red);
            margin-bottom: 6px;
        }

        .result-header p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        .exam-info {
            margin: 0 28px;
            padding: 18px;
            border-radius: 17px;
            background: var(--cream);
            border: 1px solid var(--line);
        }

        .exam-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .info-item {
            padding: 11px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.80);
            border: 1px solid rgba(234, 223, 224, 0.9);
        }

        .info-label {
            display: block;
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .info-value {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            word-break: break-word;
        }

        .score-section {
            text-align: center;
            padding: 27px 28px 23px;
        }

        .score-label {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .score {
            font-size: 58px;
            line-height: 1;
            font-weight: 800;
            color: var(--red);
            letter-spacing: -2px;
        }

        .score-status {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 13px;
            border-radius: 999px;
            background: var(--red-soft);
            color: var(--red);
            font-size: 11px;
            font-weight: 600;
        }

        .statistics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            padding: 0 28px 26px;
        }

        .stat-box {
            text-align: center;
            padding: 15px 10px;
            border-radius: 15px;
            border: 1px solid var(--line);
            background: rgba(250, 248, 246, 0.88);
        }

        .stat-number {
            display: block;
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .stat-name {
            font-size: 10px;
            color: var(--muted);
        }

        .correct .stat-number {
            color: var(--green);
        }

        .wrong .stat-number {
            color: var(--wrong);
        }

        .total .stat-number {
            color: var(--red);
        }

        .action {
            padding: 0 28px 30px;
        }

        .btn-dashboard {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 47px;
            border-radius: 13px;
            background: var(--red);
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow:
                0 8px 18px rgba(179, 38, 45, 0.18);
        }

        .btn-dashboard:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow:
                0 11px 22px rgba(179, 38, 45, 0.24);
        }

        @media (max-width: 600px) {
            .navbar {
                height: 64px;
                padding: 0 17px;
            }

            .brand-name {
                font-size: 18px;
            }

            .brand img {
                width: 35px;
                height: 35px;
            }

            .page-label {
                font-size: 11px;
                padding: 7px 12px;
            }

            .container {
                margin-top: 25px;
                padding: 0 12px;
                margin-bottom: 30px;
            }

            .result-card {
                border-radius: 21px;
            }

            .result-header {
                padding: 32px 20px 20px;
            }

            .result-header h1 {
                font-size: 21px;
            }

            .exam-info {
                margin: 0 18px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .score-section {
                padding: 25px 20px 20px;
            }

            .score {
                font-size: 52px;
            }

            .statistics {
                padding: 0 18px 22px;
                gap: 8px;
            }

            .stat-box {
                padding: 13px 7px;
            }

            .stat-number {
                font-size: 18px;
            }

            .stat-name {
                font-size: 9px;
            }

            .action {
                padding: 0 18px 24px;
            }

            .background-photo {
                filter: blur(3px);
                transform: scale(1.04);
                background-position: center center;
            }

            .background-overlay {
                background:
                    rgba(250, 248, 246, 0.30);
            }
        }
    </style>
</head>

<body>

    <div class="background-photo"></div>
    <div class="background-overlay"></div>

    <nav class="navbar">
        <div class="brand">
            <img
                src="{{ asset('images/logo.jpg') }}"
                alt="Logo SIPANDAI"
            >

            <span class="brand-name">
                SIPANDAI
            </span>
        </div>

        <div class="page-label">
            Hasil Ujian
        </div>
    </nav>

    <main class="container">
        <div class="result-card">

            <div class="result-header">
                <div class="check-icon">
                    ✓
                </div>

                <h1>
                    Ujian Selesai!
                </h1>

                <p>
                    Berikut adalah hasil ujian yang telah kamu kerjakan.
                </p>
            </div>

            <div class="exam-info">
                <div class="exam-title">
                    {{ $exam->nama_ujian }}
                </div>

                <div class="info-grid">

                    <div class="info-item">
                        <span class="info-label">
                            Mata Pelajaran
                        </span>

                        <span class="info-value">
                            {{ $exam->mata_pelajaran }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            Kelas
                        </span>

                        <span class="info-value">
                            {{ $exam->kelas }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            Status
                        </span>

                        <span class="info-value">
                            Selesai
                        </span>
                    </div>

                </div>
            </div>

            <div class="score-section">

                <div class="score-label">
                    Nilai Kamu
                </div>

                <div class="score">
                    {{ rtrim(rtrim(number_format($result->nilai, 2, '.', ''), '0'), '.') }}
                </div>

                <div class="score-status">
                    Ujian telah selesai dikerjakan
                </div>

            </div>

            <div class="statistics">

                <div class="stat-box correct">
                    <span class="stat-number">
                        {{ $result->jumlah_benar }}
                    </span>

                    <span class="stat-name">
                        Jawaban Benar
                    </span>
                </div>

                <div class="stat-box wrong">
                    <span class="stat-number">
                        {{ $result->jumlah_salah }}
                    </span>

                    <span class="stat-name">
                        Jawaban Salah
                    </span>
                </div>

                <div class="stat-box total">
                    <span class="stat-number">
                        {{ $jumlahSoal }}
                    </span>

                    <span class="stat-name">
                        Jumlah Soal
                    </span>
                </div>

            </div>

            <div class="action">
                <a
                    href="{{ route('siswa.dashboard') }}"
                    class="btn-dashboard"
                >
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </main>

</body>

</html>