<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary: #b3262d;
            --primary-dark: #911d24;
            --primary-light: #f9e7e8;
            --text: #292624;
            --muted: #817b75;
            --cream: #f4f1ed;
            --border: #e5dfd8;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            min-height: 100vh;
            color: var(--text);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 24px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: -20px;
            background:
                linear-gradient(rgba(40, 30, 28, .42), rgba(40, 30, 28, .48)),
                url("{{ asset('images/gerbang2.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(6px);
            transform: scale(1.04);
            z-index: -2;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 20% 15%, rgba(255,255,255,.13), transparent 32%),
                rgba(70, 47, 40, .08);
            z-index: -1;
            pointer-events: none;
        }

        .dashboard {
            width: 100%;
            max-width: 780px;
            background: rgba(255, 255, 255, .965);
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 26px;
            box-shadow:
                0 35px 90px rgba(0,0,0,.24),
                0 8px 24px rgba(0,0,0,.08);
            overflow: hidden;
            position: relative;
        }

        .topbar {
            min-height: 82px;
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid rgba(229,223,216,.8);
            background:
                linear-gradient(135deg, rgba(255,255,255,.98), rgba(250,248,246,.94));
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-logo img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .brand-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .brand-info strong {
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .brand-info span {
            color: #96908a;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        .profile-wrapper {
            position: relative;
        }

        .student-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px 7px 8px;
            background: rgba(250,248,246,.9);
            border: 1px solid var(--border);
            border-radius: 13px;
            min-width: 165px;
            cursor: pointer;
            transition: .22s ease;
            box-shadow: 0 3px 10px rgba(50,35,30,.04);
        }

        .student-profile:hover {
            border-color: #d5cbc2;
            background: #fff;
            transform: translateY(-1px);
            box-shadow: 0 7px 18px rgba(50,35,30,.08);
        }

        .student-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(145deg, #fae5e7, #f5d5d8);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .student-avatar i {
            font-size: 14px;
        }

        .student-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
            line-height: 1.25;
            flex: 1;
        }

        .student-info span {
            color: #aaa29a;
            font-size: 9px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .student-info strong {
            color: var(--text);
            font-size: 11px;
            font-weight: 800;
            max-width: 125px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-arrow {
            color: #aaa29a;
            font-size: 10px;
            transition: .2s ease;
        }

        .profile-wrapper:hover .profile-arrow {
            color: var(--primary);
            transform: rotate(180deg);
        }

        .profile-menu {
            position: absolute;
            top: calc(100% + 9px);
            right: 0;
            width: 190px;
            padding: 7px;
            background: rgba(255,255,255,.98);
            border: 1px solid rgba(229,223,216,.95);
            border-radius: 14px;
            box-shadow:
                0 18px 40px rgba(35,25,20,.14),
                0 5px 15px rgba(35,25,20,.06);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: .2s ease;
            z-index: 20;
        }

        .profile-wrapper:hover .profile-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-menu-label {
            padding: 7px 9px 8px;
            color: #aaa29a;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: transparent;
            border-radius: 9px;
            padding: 10px 9px;
            display: flex;
            align-items: center;
            gap: 9px;
            color: #b3262d;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-align: left;
            transition: .2s ease;
        }

        .logout-btn i {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9e7e8;
            font-size: 10px;
        }

        .logout-btn:hover {
            background: #fff1f2;
        }

        .content {
            padding: 38px 42px 30px;
            background:
                radial-gradient(circle at 95% 0%, rgba(179,38,45,.035), transparent 28%),
                #fff;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome small {
            display: block;
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .welcome h1 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1.2px;
            line-height: 1.25;
            margin-bottom: 10px;
        }

        .welcome h1 span {
            color: var(--primary);
        }

        .welcome p {
            max-width: 520px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 13px 15px;
            border-radius: 11px;
            margin-bottom: 16px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.6;
        }

        .alert i {
            font-size: 14px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .alert-success {
            background: #eaf8ef;
            border: 1px solid #c8ecd6;
            color: #198754;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #ffd2d2;
            color: #c72d2d;
        }

        .alert ul {
            padding-left: 16px;
        }

        .exam-form {
            width: 100%;
            padding: 30px 32px;
            background: linear-gradient(145deg, #ffffff, #fcfaf8);
            border: 1px solid #e4ddd6;
            border-radius: 17px;
            box-shadow:
                0 12px 30px rgba(55,38,30,.06),
                inset 0 1px 0 rgba(255,255,255,.9);
            position: relative;
            overflow: hidden;
        }

        /* GARIS MERAH MENGELILINGI CARD */
        .exam-form::before {
            content: "";
            position: absolute;
            inset: 0;
            border: 2px solid var(--primary);
            border-radius: 17px;
            pointer-events: none;
        }

        .form-heading {
            margin-bottom: 24px;
        }

        .form-heading h3 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.4px;
            margin-bottom: 7px;
        }

        .form-heading p {
            color: #96908a;
            font-size: 11px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 9px;
        }

        .code-input {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            border: 1px solid #dcd6d0;
            border-radius: 10px;
            background: #faf9f7;
            outline: none;
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: .2s ease;
        }

        .code-input:hover {
            border-color: #c9c1ba;
            background: #fff;
        }

        .code-input:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow:
                0 0 0 4px rgba(179,38,45,.08),
                0 5px 15px rgba(179,38,45,.05);
        }

        .code-input::placeholder {
            color: #aaa39d;
            font-weight: 400;
            letter-spacing: .5px;
            text-transform: none;
        }

        .hint {
            display: block;
            margin-top: 9px;
            color: #a39b94;
            font-size: 10px;
        }

        /* ===== WEBCAM ABSEN ===== */
        .webcam-box {
            border: 1px solid #dcd6d0;
            border-radius: 12px;
            background: #faf9f7;
            padding: 16px;
            margin-bottom: 8px;
        }

        .webcam-frame {
            position: relative;
            width: 100%;
            max-width: 340px;
            aspect-ratio: 4 / 3;
            margin: 0 auto 14px;
            border-radius: 10px;
            overflow: hidden;
            background: #1c1a19;
            border: 2px solid var(--border);
        }

        .webcam-frame.is-verified {
            border-color: #34a853;
        }

        .webcam-video,
        .webcam-canvas,
        .webcam-preview {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .webcam-canvas {
            display: none;
        }

        .webcam-preview {
            display: none;
        }

        .webcam-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #cfc9c2;
            text-align: center;
            padding: 12px;
        }

        .webcam-placeholder i {
            font-size: 26px;
        }

        .webcam-placeholder span {
            font-size: 10.5px;
            font-weight: 600;
            color: #d8d2cb;
            max-width: 220px;
            line-height: 1.5;
        }

        .webcam-status-badge {
            position: absolute;
            top: 9px;
            left: 9px;
            display: none;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background: rgba(52,168,83,.95);
            color: #fff;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: .3px;
            border-radius: 20px;
            z-index: 5;
        }

        .webcam-status-badge.show {
            display: inline-flex;
        }

        .webcam-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .webcam-btn {
            border: none;
            border-radius: 9px;
            padding: 10px 16px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .2s ease;
        }

        .webcam-btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 6px 16px rgba(179,38,45,.16);
        }

        .webcam-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 9px 20px rgba(179,38,45,.22);
        }

        .webcam-btn-secondary {
            background: #efebe6;
            color: var(--text);
        }

        .webcam-btn-secondary:hover {
            background: #e6e0d9;
        }

        .webcam-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
            transform: none !important;
        }

        .webcam-note {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            margin-top: 12px;
            color: #a39b94;
            font-size: 10px;
            line-height: 1.6;
        }

        .webcam-note i {
            margin-top: 1px;
            color: var(--primary);
            flex-shrink: 0;
        }

        .webcam-error-msg {
            display: none;
            align-items: flex-start;
            gap: 8px;
            margin-top: 12px;
            padding: 10px 12px;
            background: #fff0f0;
            border: 1px solid #ffd2d2;
            color: #c72d2d;
            border-radius: 9px;
            font-size: 10.5px;
            font-weight: 600;
            line-height: 1.6;
        }

        .webcam-error-msg.show {
            display: flex;
        }
        /* ===== END WEBCAM ===== */

        .btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: .22s ease;
            box-shadow: 0 7px 18px rgba(179,38,45,.16);
        }

        .btn:hover {
            background: linear-gradient(135deg, #c12d35, #801a21);
            transform: translateY(-2px);
            box-shadow: 0 11px 24px rgba(179,38,45,.23);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:disabled {
            opacity: .5;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn i {
            font-size: 13px;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            color: #aaa29a;
            font-size: 10px;
            font-weight: 500;
        }

        @media (max-width: 720px) {
            body {
                padding: 20px 14px;
                align-items: flex-start;
            }

            .dashboard {
                margin-top: 10px;
                border-radius: 20px;
            }

            .topbar {
                padding: 19px 22px;
            }

            .content {
                padding: 29px 25px 25px;
            }

            .welcome h1 {
                font-size: 28px;
            }

            .exam-form {
                padding: 25px;
            }

            .student-profile {
                min-width: 150px;
            }

            .student-info strong {
                max-width: 105px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 12px;
            }

            .topbar {
                padding: 17px 18px;
            }

            .brand {
                gap: 10px;
            }

            .brand-logo,
            .brand-logo img {
                width: 40px;
                height: 40px;
            }

            .brand-info strong {
                font-size: 17px;
            }

            .brand-info span {
                font-size: 9px;
            }

            .student-profile {
                min-width: auto;
                padding: 6px;
                border-radius: 10px;
            }

            .student-info,
            .profile-arrow {
                display: none;
            }

            .student-avatar {
                width: 34px;
                height: 34px;
            }

            .profile-menu {
                right: -3px;
                width: 175px;
            }

            .content {
                padding: 26px 20px 22px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .welcome p {
                font-size: 11px;
            }

            .exam-form {
                padding: 22px 20px;
            }

            .form-heading h3 {
                font-size: 17px;
            }

            .code-input,
            .btn {
                height: 50px;
            }
        }
    </style>
</head>

<body>

    <div class="dashboard">

        <div class="topbar">

            <div class="brand">

                <div class="brand-logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMK">
                </div>

                <div class="brand-info">
                    <strong>SIPANDAI</strong>
                    <span>Sistem Ujian Digital</span>
                </div>

            </div>

            <div class="profile-wrapper">

                <div class="student-profile">

                    <div class="student-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <div class="student-info">
                        <span>Siswa</span>

                        <strong title="{{ auth()->user()->name }}">
                            {{ auth()->user()->name }}
                        </strong>
                    </div>

                    <i class="fa-solid fa-chevron-down profile-arrow"></i>

                </div>

                <div class="profile-menu">

                    <div class="profile-menu-label">
                        Akun Siswa
                    </div>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="logout-form">

                        @csrf

                        <button type="submit" class="logout-btn">

                            <i class="fa-solid fa-arrow-right-from-bracket"></i>

                            <span>Keluar dari Akun</span>

                        </button>

                    </form>

                </div>

            </div>

        </div>


        <div class="content">

            <div class="welcome">

                <small>Dashboard Siswa</small>

                <h1>
                    Selamat Datang,
                    <span>{{ auth()->user()->name }}</span>
                </h1>

                <p>
                    Masukkan kode ujian untuk mulai mengerjakan. Sebelum masuk, kamu perlu mengambil foto absen lewat kamera.
                </p>

            </div>


            @if(session('error'))

                <div class="alert alert-error">

                    <i class="fa-solid fa-circle-xmark"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="exam-form">

                <div class="form-heading">

                    <h3>
                        Masukkan Kode Ujian
                    </h3>

                    <p>
                        Ambil foto absen terlebih dahulu, lalu masukkan kode ujian yang diberikan oleh guru.
                    </p>

                </div>


                <form
                    id="examForm"
                    action="{{ url('/siswa/ujian/masuk') }}"
                    method="POST">

                    @csrf

                    {{-- Foto absen dikirim sebagai base64 (data URL) --}}
                    <input type="hidden" name="foto_absen" id="fotoAbsenInput" value="{{ old('foto_absen') }}">

                    <div class="form-group">

                        <label>
                            <i class="fa-solid fa-camera" style="color:var(--primary); margin-right:6px;"></i>
                            Foto Absen
                        </label>

                        <div class="webcam-box">

                            <div class="webcam-frame" id="webcamFrame">

                                <div class="webcam-status-badge" id="webcamBadge">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Terverifikasi
                                </div>

                                <div class="webcam-placeholder" id="webcamPlaceholder">
                                    <i class="fa-solid fa-camera"></i>
                                    <span>Klik "Nyalakan Kamera" lalu ambil foto untuk absen sebelum masuk ujian</span>
                                </div>

                                <video class="webcam-video" id="webcamVideo" autoplay playsinline muted></video>
                                <canvas class="webcam-canvas" id="webcamCanvas"></canvas>
                                <img class="webcam-preview" id="webcamPreview" alt="Foto absen">

                            </div>

                            <div class="webcam-actions">

                                <button type="button" class="webcam-btn webcam-btn-primary" id="btnStartCamera">
                                    <i class="fa-solid fa-video"></i>
                                    Nyalakan Kamera
                                </button>

                                <button type="button" class="webcam-btn webcam-btn-primary" id="btnCapture" style="display:none;">
                                    <i class="fa-solid fa-camera"></i>
                                    Ambil Foto
                                </button>

                                <button type="button" class="webcam-btn webcam-btn-secondary" id="btnRetake" style="display:none;">
                                    <i class="fa-solid fa-rotate-left"></i>
                                    Ambil Ulang
                                </button>

                            </div>

                            <div class="webcam-error-msg" id="webcamError">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span id="webcamErrorText"></span>
                            </div>

                            <div class="webcam-note">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Foto hanya digunakan untuk absensi ujian dan tidak dibagikan ke pihak lain.</span>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="kode_ujian">
                            Kode Ujian
                        </label>

                        <input
                            type="text"
                            id="kode_ujian"
                            name="kode_ujian"
                            class="code-input"
                            value="{{ old('kode_ujian') }}"
                            placeholder="Contoh: AML2026"
                            maxlength="50"
                            autocomplete="off"
                            required>

                        <small class="hint">
                            Pastikan kode yang dimasukkan sudah benar.
                        </small>

                    </div>


                    <button
                        type="submit"
                        class="btn"
                        id="btnSubmit"
                        disabled>

                        <i class="fa-solid fa-arrow-right-to-bracket"></i>

                        Masuk Ujian

                    </button>

                </form>

            </div>


            <div class="footer">
                SIPANDAI © {{ date('Y') }}
                · Sistem Ujian Digital
            </div>

        </div>

    </div>

    <script>
        (function () {
            const btnStart = document.getElementById('btnStartCamera');
            const btnCapture = document.getElementById('btnCapture');
            const btnRetake = document.getElementById('btnRetake');
            const btnSubmit = document.getElementById('btnSubmit');

            const video = document.getElementById('webcamVideo');
            const canvas = document.getElementById('webcamCanvas');
            const preview = document.getElementById('webcamPreview');
            const placeholder = document.getElementById('webcamPlaceholder');
            const frame = document.getElementById('webcamFrame');
            const badge = document.getElementById('webcamBadge');

            const errorBox = document.getElementById('webcamError');
            const errorText = document.getElementById('webcamErrorText');
            const fotoInput = document.getElementById('fotoAbsenInput');

            let stream = null;
            const FLIP = true; // true = balikin mirror, false = tanpa flip

            function showError(msg) {
                errorText.textContent = msg;
                errorBox.classList.add('show');
            }

            function hideError() {
                errorBox.classList.remove('show');
            }

            async function startCamera() {
                hideError();

                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    showError('Browser ini tidak mendukung akses kamera. Gunakan browser lain atau perangkat dengan kamera.');
                    return;
                }

                try {
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 480 } },
                        audio: false
                    });

                    video.srcObject = stream;
                    video.style.transform = FLIP ? 'scaleX(-1)' : 'none';
                    video.style.display = 'block';
                    placeholder.style.display = 'none';
                    preview.style.display = 'none';
                    badge.classList.remove('show');

                    btnStart.style.display = 'none';
                    btnCapture.style.display = 'inline-flex';
                    btnRetake.style.display = 'none';
                } catch (err) {
                    if (err && err.name === 'NotAllowedError') {
                        showError('Akses kamera ditolak. Izinkan akses kamera pada browser untuk melanjutkan absen.');
                    } else if (err && err.name === 'NotFoundError') {
                        showError('Kamera tidak ditemukan pada perangkat ini.');
                    } else {
                        showError('Gagal mengaktifkan kamera. Coba lagi.');
                    }
                }
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
            }

            function capturePhoto() {
                const w = video.videoWidth || 640;
                const h = video.videoHeight || 480;

                canvas.width = w;
                canvas.height = h;

                const ctx = canvas.getContext('2d');
                if (FLIP) {
                    ctx.translate(w, 0);
                    ctx.scale(-1, 1);
                }
                ctx.drawImage(video, 0, 0, w, h);

                const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
                fotoInput.value = dataUrl;

                preview.src = dataUrl;
                preview.style.display = 'block';
                video.style.display = 'none';

                stopCamera();

                frame.classList.add('is-verified');
                badge.classList.add('show');

                btnCapture.style.display = 'none';
                btnRetake.style.display = 'inline-flex';

                btnSubmit.disabled = false;
            }

            function retakePhoto() {
                fotoInput.value = '';
                preview.style.display = 'none';
                frame.classList.remove('is-verified');
                badge.classList.remove('show');

                btnRetake.style.display = 'none';
                btnSubmit.disabled = true;

                startCamera();
            }

            btnStart.addEventListener('click', startCamera);
            btnCapture.addEventListener('click', capturePhoto);
            btnRetake.addEventListener('click', retakePhoto);

            window.addEventListener('beforeunload', stopCamera);

            // Kalau ada old('foto_absen') dari validasi gagal sebelumnya, tampilkan lagi previewnya
            if (fotoInput.value) {
                preview.src = fotoInput.value;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
                frame.classList.add('is-verified');
                badge.classList.add('show');
                btnStart.style.display = 'none';
                btnSubmit.disabled = false;
            }
        })();
    </script>

</body>
</html>