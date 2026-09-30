<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Ujian - SIPANDAI</title>

    <!-- Font -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        :root {
            --red: #8f2635;
            --red-dark: #741c29;
            --red-light: #f7e9eb;
            --red-soft: #edd4d8;
            --dark: #292929;
            --text: #383838;
            --muted: #777;
            --light-muted: #999;
            --bg: #f2f2f2;
            --white: #fff;
            --border: #dadada;
            --border-light: #eeeeeb;

            /* HIJAU UNTUK TOMBOL SIMPAN */
            --green: #5b9b6d;
            --green-dark: #438153;
            --green-light: #e8f4eb;

            --sidebar-width: 245px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(143, 38, 53, .045),
                    transparent 32%
                ),
                var(--bg);
            color: var(--text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }

        a {
            text-decoration: none;
            color: inherit;
        }


        /* =========================================================
           SIDEBAR
        ========================================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            display: flex;
            flex-direction: column;
            background:
                linear-gradient(
                    145deg,
                    rgba(48, 27, 32, .97),
                    rgba(29, 27, 29, .97)
                );
            backdrop-filter: blur(24px) saturate(135%);
            -webkit-backdrop-filter: blur(24px) saturate(135%);
            border-right: 1px solid rgba(255, 255, 255, .09);
            z-index: 1200;
            transform: translateX(calc(-100% - 2px));
            transition:
                transform .45s cubic-bezier(.22, 1, .36, 1),
                box-shadow .45s ease;
            overflow: hidden;
            box-shadow:
                inset -1px 0 rgba(255,255,255,.025);
        }

        .sidebar::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            top: -120px;
            left: -120px;
            background:
                radial-gradient(
                    circle,
                    rgba(143, 38, 53, .42),
                    transparent 68%
                );
            pointer-events: none;
        }

        .sidebar::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background:
                linear-gradient(
                    to bottom,
                    transparent,
                    rgba(255,255,255,.12),
                    transparent
                );
            pointer-events: none;
        }

        .sidebar.show {
            transform: translateX(0);
            box-shadow:
                18px 0 45px rgba(0,0,0,.18),
                inset -1px 0 rgba(255,255,255,.025);
        }

        .sidebar-header {
            position: relative;
            height: 88px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,.075);
            flex-shrink: 0;
            z-index: 2;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            background: transparent;
            border: none;
            border-radius: 0;
            filter:
                drop-shadow(0 5px 12px rgba(0,0,0,.22));
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-brand-text strong {
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .sidebar-brand-text span {
            color: rgba(255,255,255,.42);
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .close-sidebar {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 9px;
            background: rgba(255,255,255,.055);
            color: rgba(255,255,255,.68);
            cursor: pointer;
            transition:
                .25s ease,
                transform .3s ease;
        }

        .close-sidebar:hover {
            background: rgba(143,38,53,.75);
            color: #fff;
            transform: rotate(90deg);
        }

        .sidebar-content {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 25px 15px 15px;
            overflow-y: auto;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.12);
            border-radius: 10px;
        }

        .sidebar-label {
            margin: 0 10px 12px;
            color: rgba(255,255,255,.38);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu-item {
            position: relative;
            min-height: 46px;
            padding: 0 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid transparent;
            border-radius: 11px;
            color: rgba(255,255,255,.67);
            font-size: 13px;
            font-weight: 600;
            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease;
        }

        .menu-item i {
            width: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.42);
            font-size: 14px;
            transition: color .25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.065);
            color: #fff;
            transform: translateX(2px);
        }

        .menu-item:hover i {
            color: #e7aab2;
        }

        .menu-item.active {
            background:
                linear-gradient(
                    90deg,
                    rgba(143,38,53,.74),
                    rgba(143,38,53,.37)
                );
            border-color: rgba(255,255,255,.08);
            color: #fff;
            box-shadow:
                0 8px 20px rgba(0,0,0,.12),
                inset 0 1px rgba(255,255,255,.06);
        }

        .menu-item.active::before {
            content: "";
            position: absolute;
            left: -1px;
            top: 9px;
            bottom: 9px;
            width: 3px;
            background: #e7aab2;
            border-radius: 0 4px 4px 0;
        }

        .menu-item.active i {
            color: #fff;
        }

        .sidebar-profile {
            margin-top: auto;
            padding: 15px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.065),
                    rgba(255,255,255,.025)
                );
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 13px;
        }

        .sidebar-profile-top {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background:
                linear-gradient(
                    145deg,
                    #a73a49,
                    #741c29
                );
            color: #fff;
            font-size: 13px;
            font-weight: 800;
        }

        .sidebar-profile-info {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-profile-info strong {
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-profile-info span {
            color: rgba(255,255,255,.42);
            font-size: 9px;
            font-weight: 500;
        }

        .logout-link {
            width: 100%;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid rgba(143,38,53,.32);
            border-radius: 8px;
            background: rgba(143,38,53,.12);
            color: #e7aab2;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .25s ease;
        }

        .logout-link:hover {
            background: rgba(143,38,53,.78);
            border-color: rgba(143,38,53,.9);
            color: #fff;
        }


        /* =========================================================
           OVERLAY
        ========================================================== */

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.42);
            opacity: 0;
            visibility: hidden;
            transition: .25s ease;
            z-index: 1150;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }


        /* =========================================================
           MAIN
        ========================================================== */

        .main {
            position: relative;
            width: 100%;
            min-height: 100vh;
            margin-left: 0;
            transition:
                margin-left .45s cubic-bezier(.22,1,.36,1),
                width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }


        /* =========================================================
           TOPBAR
        ========================================================== */

        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 64px;
            padding: 0 4.5vw;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background:
                linear-gradient(
                    180deg,
                    rgba(27,26,26,.88),
                    rgba(27,26,26,.72)
                );
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,.08);
            box-shadow:
                0 7px 25px rgba(0,0,0,.12);
            z-index: 1050;
            transition:
                left .45s cubic-bezier(.22,1,.36,1),
                width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .topbar {
            left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0;
        }

        .navbar-home-btn {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 10px;
            background: rgba(255,255,255,.065);
            color: rgba(255,255,255,.82);
            cursor: pointer;
            transition: .25s ease;
        }

        .navbar-home-btn:hover {
            background: var(--red);
            border-color: rgba(255,255,255,.15);
            color: #fff;
            transform: translateY(-1px);
        }

        .navbar-logo {
            width: 35px;
            height: 35px;
            object-fit: contain;
            flex-shrink: 0;
            background: transparent;
            border: none;
            border-radius: 0;
            filter:
                drop-shadow(0 4px 10px rgba(0,0,0,.18));
        }

        .navbar-title {
            display: flex;
            flex-direction: column;
            gap: 3px;
            min-width: 0;
        }

        .navbar-title-main {
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 0;
            white-space: nowrap;
        }

        .navbar-title strong {
            color: #fff;
            font-size: 14px;
            line-height: 1;
            font-weight: 800;
        }

        .navbar-page-divider {
            color: rgba(255,255,255,.30);
            font-size: 13px;
        }

        .navbar-page {
            color: rgba(255,255,255,.54);
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .navbar-page.current {
            color: rgba(255,255,255,.92);
        }

        .navbar-title-sub {
            color: rgba(255,255,255,.48);
            font-size: 8px;
            font-weight: 600;
            letter-spacing: 1.4px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .notification {
            width: 37px;
            height: 37px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            background: rgba(255,255,255,.055);
            color: rgba(255,255,255,.72);
            cursor: pointer;
            transition: .25s ease;
        }

        .notification:hover {
            background: rgba(143,38,53,.65);
            color: #fff;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background:
                linear-gradient(
                    145deg,
                    #a73a49,
                    #741c29
                );
            color: #fff;
            font-size: 11px;
            font-weight: 800;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .profile-info strong {
            color: #fff;
            font-size: 11px;
            font-weight: 700;
        }

        .profile-info span {
            color: rgba(255,255,255,.42);
            font-size: 9px;
        }


        /* =========================================================
           CONTENT
        ========================================================== */

        .content {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 96px 28px 45px;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-title {
            color: var(--dark);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -.7px;
            margin-bottom: 7px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================================================
           FORM CARD
        ========================================================== */

        .form-card {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 17px;
            box-shadow:
                0 12px 32px rgba(36,32,33,.055);
            overflow: hidden;
        }

        .form-header {
            padding: 23px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-light);
        }

        .form-header-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--red-light);
            color: var(--red);
            font-size: 14px;
        }

        .form-header-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .form-header-text strong {
            color: var(--dark);
            font-size: 14px;
            font-weight: 800;
        }

        .form-header-text span {
            color: var(--muted);
            font-size: 10px;
        }

        .form-body {
            padding: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
            gap: 20px 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            color: var(--dark);
            font-size: 11px;
            font-weight: 750;
        }

        .required {
            color: var(--red);
        }

        .form-control {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            border: 1px solid #dcdcdc;
            border-radius: 9px;
            background: #fff;
            color: var(--dark);
            font-size: 12px;
            font-weight: 500;
            outline: none;
            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        textarea.form-control {
            height: auto;
            min-height: 100px;
            padding: 12px 13px;
            resize: vertical;
        }

        .form-control:hover {
            border-color: #c9c9c9;
        }

        .form-control:focus {
            border-color: var(--red);
            background: #fff;
            box-shadow:
                0 0 0 3px rgba(143,38,53,.08);
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-hint {
            color: #999;
            font-size: 9px;
            line-height: 1.5;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon .form-control {
            padding-right: 40px;
        }

        .input-with-icon i {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 12px;
            pointer-events: none;
        }

        .error-text {
            color: #a03945;
            font-size: 9px;
            font-weight: 600;
        }

        .form-control.is-error {
            border-color: #c86b76;
            background: #fffafa;
        }


        /* =========================================================
           FORM FOOTER
        ========================================================== */

        .form-footer {
            padding: 18px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-top: 1px solid var(--border-light);
            background: #fcfcfc;
        }

        .footer-note {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #999;
            font-size: 9px;
            line-height: 1.5;
        }

        .footer-note i {
            color: var(--red);
            font-size: 10px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .25s ease;
        }

        .btn-cancel {
            border: 1px solid #d8d8d8;
            background: #fff;
            color: #666;
        }

        .btn-cancel:hover {
            border-color: var(--red);
            background: var(--red);
            color: #fff;
            transform: translateY(-1px);
        }

        /* =========================================================
           TOMBOL SIMPAN - HIJAU
        ========================================================== */

        .btn-save {
            border: 1px solid var(--green);
            background: var(--green);
            color: #fff;
            box-shadow:
                0 6px 15px rgba(91,155,109,.18);
        }

        .btn-save:hover {
            border-color: var(--green-dark);
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow:
                0 8px 20px rgba(91,155,109,.24);
        }

        .btn-save:active {
            transform: translateY(0);
        }

        .btn-save:disabled {
            cursor: wait;
            opacity: .78;
            transform: none;
        }


        /* =========================================================
           ALERT
        ========================================================== */

        .alert {
            margin-bottom: 18px;
            padding: 13px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .alert-success {
            color: #386c49;
            background: #eaf4ed;
            border: 1px solid #cce5d4;
        }

        .alert-error {
            color: #8a3038;
            background: #fae9eb;
            border: 1px solid #edc8cd;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .footer {
            padding: 25px 0 0;
            text-align: center;
            color: #aaa;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: .4px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 900px) {

            body.sidebar-open .main {
                margin-left: 0;
                width: 100%;
            }

            body.sidebar-open .topbar {
                left: 0;
                width: 100%;
            }

            .topbar {
                padding: 0 20px;
            }

            .profile-info {
                display: none;
            }

            .content {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 700px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .footer-note {
                justify-content: center;
            }

            .form-actions {
                width: 100%;
            }

            .form-actions .btn {
                flex: 1;
            }
        }

        @media (max-width: 550px) {

            .sidebar {
                width: 270px;
            }

            .topbar {
                padding: 0 15px;
            }

            .navbar-logo {
                display: none;
            }

            .navbar-title {
                max-width: calc(100vw - 130px);
            }

            .navbar-title-main {
                overflow: hidden;
            }

            .navbar-page {
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .content {
                padding:
                    86px 15px 30px;
            }

            .page-title {
                font-size: 23px;
            }

            .form-header,
            .form-body {
                padding: 19px;
            }

            .form-footer {
                padding: 17px 19px;
            }
        }

        @media (max-width: 400px) {

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }

            .sidebar {
                width: 280px;
            }
        }

    </style>

</head>

<body>

    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="sidebar-logo">

                <div class="sidebar-brand-text">

                    <strong>SIPANDAI</strong>

                    <span>
                        SMKN 2 KOTA KEDIRI
                    </span>

                </div>

            </div>

            <button
                type="button"
                class="close-sidebar"
                id="closeSidebar">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        <div class="sidebar-content">

            <div class="sidebar-label">
                MENU UTAMA
            </div>

            <nav class="sidebar-menu">

                <a
                    href="{{ route('guru.dashboard') }}"
                    class="menu-item">

                    <i class="fa-solid fa-house"></i>

                    <span>
                        Dashboard
                    </span>

                </a>


                <a
                    href="{{ route('guru.exams.index') }}"
                    class="menu-item active">

                    <i class="fa-solid fa-clipboard-list"></i>

                    <span>
                        Kelola Ujian
                    </span>

                </a>


                <a
                    href="{{ route('guru.results.index') }}"
                    class="menu-item">

                    <i class="fa-solid fa-chart-column"></i>

                    <span>
                        Hasil Ujian
                    </span>

                </a>


                <a
                    href="{{ route('guru.data-siswa') }}"
                    class="menu-item">

                    <i class="fa-solid fa-users"></i>

                    <span>
                        Data Siswa
                    </span>

                </a>

            </nav>


            <div class="sidebar-profile">

                <div class="sidebar-profile-top">

                    <div class="sidebar-avatar">

                        {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}

                    </div>

                    <div class="sidebar-profile-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Guru' }}
                        </strong>

                        <span>
                            Akun Guru
                        </span>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    style="margin: 0;">

                    @csrf

                    <button
                        type="submit"
                        class="logout-link">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        Keluar

                    </button>

                </form>

            </div>

        </div>

    </aside>


    <div
        class="sidebar-overlay"
        id="sidebarOverlay">
    </div>


    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main class="main">


        <!-- =====================================================
             TOPBAR
        ====================================================== -->

        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="navbar-home-btn"
                    id="navbarHomeBtn">

                    <i class="fa-solid fa-bars"></i>

                </button>


                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="navbar-logo">


                <div class="navbar-title">

                    <div class="navbar-title-main">

                        <strong>
                            SIPANDAI
                        </strong>

                        <span class="navbar-page-divider">
                            >
                        </span>

                        <span class="navbar-page">
                            KELOLA UJIAN
                        </span>

                        <span class="navbar-page-divider">
                            >
                        </span>

                        <span class="navbar-page current">
                            EDIT UJIAN
                        </span>

                    </div>


                    <div class="navbar-title-sub">
                        SISTEM UJIAN DIGITAL
                    </div>

                </div>

            </div>


            <div class="topbar-right">

                <button
                    type="button"
                    class="notification">

                    <i class="fa-regular fa-bell"></i>

                </button>


                <div class="profile">

                    <div class="profile-avatar">

                        {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}

                    </div>


                    <div class="profile-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Guru' }}
                        </strong>

                        <span>
                            Guru
                        </span>

                    </div>

                </div>

            </div>

        </header>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div class="content">


            <div class="page-header">

                <h1 class="page-title">
                    Edit Ujian
                </h1>

                <p class="page-subtitle">
                    Perbarui informasi ujian yang masih dalam tahap draft.
                </p>

            </div>


            <!-- ALERT -->

            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            <!-- =================================================
                 FORM EDIT
            ================================================== -->

            <form
                action="{{ route('guru.exams.update', $exam->id) }}"
                method="POST"
                id="examForm">

                @csrf

                @method('PUT')

                <!-- TAMBAHAN: STATUS UJIAN -->
                <input
                    type="hidden"
                    name="status"
                    value="{{ $exam->status }}">


                <section class="form-card">


                    <!-- FORM HEADER -->

                    <div class="form-header">

                        <div class="form-header-icon">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </div>


                        <div class="form-header-text">

                            <strong>
                                Informasi Ujian
                            </strong>

                            <span>
                                Data draft ujian kamu tetap tersimpan di halaman ini.
                            </span>

                        </div>

                    </div>


                    <!-- FORM BODY -->

                    <div class="form-body">

                        <div class="form-grid">


                            <!-- NAMA UJIAN -->

                            <div class="form-group full">

                                <label
                                    for="nama_ujian"
                                    class="form-label">

                                    Nama Ujian

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="text"
                                    id="nama_ujian"
                                    name="nama_ujian"
                                    class="form-control @error('nama_ujian') is-error @enderror"
                                    value="{{ old('nama_ujian', $exam->nama_ujian) }}"
                                    placeholder="Contoh: Ujian Informatika Kelas X"
                                    required>


                                @error('nama_ujian')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- MATA PELAJARAN -->

                            <div class="form-group">

                                <label
                                    for="mata_pelajaran"
                                    class="form-label">

                                    Mata Pelajaran

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="text"
                                    id="mata_pelajaran"
                                    name="mata_pelajaran"
                                    class="form-control @error('mata_pelajaran') is-error @enderror"
                                    value="{{ old('mata_pelajaran', $exam->mata_pelajaran) }}"
                                    placeholder="Contoh: Informatika"
                                    required>


                                @error('mata_pelajaran')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- KELAS -->

                            <div class="form-group">

                                <label
                                    for="kelas"
                                    class="form-label">

                                    Kelas

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="text"
                                    id="kelas"
                                    name="kelas"
                                    class="form-control @error('kelas') is-error @enderror"
                                    value="{{ old('kelas', $exam->kelas) }}"
                                    placeholder="Contoh: X TKJ 1"
                                    required>


                                @error('kelas')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- TANGGAL -->

                            <div class="form-group">

                                <label
                                    for="tanggal_ujian"
                                    class="form-label">

                                    Tanggal Ujian

                                    <span class="required">*</span>

                                </label>


                                <div class="input-with-icon">

                                    <input
                                        type="date"
                                        id="tanggal_ujian"
                                        name="tanggal_ujian"
                                        class="form-control @error('tanggal_ujian') is-error @enderror"
                                        value="{{ old('tanggal_ujian', $exam->tanggal_ujian ? $exam->tanggal_ujian->format('Y-m-d') : '') }}"
                                        required>

                                </div>


                                @error('tanggal_ujian')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- DURASI -->

                            <div class="form-group">

                                <label
                                    for="durasi"
                                    class="form-label">

                                    Durasi

                                    <span class="required">*</span>

                                </label>


                                <div class="input-with-icon">

                                    <input
                                        type="number"
                                        id="durasi"
                                        name="durasi"
                                        min="1"
                                        class="form-control @error('durasi') is-error @enderror"
                                        value="{{ old('durasi', $exam->durasi) }}"
                                        placeholder="Contoh: 90"
                                        required>

                                    <i class="fa-regular fa-clock"></i>

                                </div>


                                <span class="form-hint">
                                    Masukkan durasi dalam menit.
                                </span>


                                @error('durasi')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- JAM MULAI -->

                            <div class="form-group">

                                <label
                                    for="jam_mulai"
                                    class="form-label">

                                    Jam Mulai

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="time"
                                    id="jam_mulai"
                                    name="jam_mulai"
                                    class="form-control @error('jam_mulai') is-error @enderror"
                                    value="{{ old('jam_mulai', $exam->jam_mulai ? substr($exam->jam_mulai, 0, 5) : '') }}"
                                    required>


                                @error('jam_mulai')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- JAM SELESAI -->

                            <div class="form-group">

                                <label
                                    for="jam_selesai"
                                    class="form-label">

                                    Jam Selesai

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="time"
                                    id="jam_selesai"
                                    name="jam_selesai"
                                    class="form-control @error('jam_selesai') is-error @enderror"
                                    value="{{ old('jam_selesai', $exam->jam_selesai ? substr($exam->jam_selesai, 0, 5) : '') }}"
                                    required>


                                @error('jam_selesai')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            <!-- KODE UJIAN -->

                            <div class="form-group full">

                                <label
                                    for="kode_ujian"
                                    class="form-label">

                                    Kode Ujian

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="text"
                                    id="kode_ujian"
                                    name="kode_ujian"
                                    class="form-control @error('kode_ujian') is-error @enderror"
                                    value="{{ old('kode_ujian', $exam->kode_ujian) }}"
                                    placeholder="Contoh: INF2026"
                                    required>


                                <span class="form-hint">
                                    Kode ini digunakan siswa untuk masuk ke ujian.
                                </span>


                                @error('kode_ujian')

                                    <span class="error-text">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                        </div>

                    </div>


                    <!-- FORM FOOTER -->

                    <div class="form-footer">

                        <div class="footer-note">

                            <i class="fa-solid fa-circle-info"></i>

                            <span>
                                Perubahan akan disimpan pada ujian yang sama.
                            </span>

                        </div>


                        <div class="form-actions">

                            <a
                                href="{{ route('guru.exams.show', $exam->id) }}"
                                class="btn btn-cancel">

                                <i class="fa-solid fa-arrow-left"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-save"
                                id="saveButton">

                                <i class="fa-solid fa-floppy-disk"></i>

                                <span id="saveButtonText">
                                    Simpan Perubahan
                                </span>

                            </button>

                        </div>

                    </div>

                </section>

            </form>


            <footer class="footer">
                SIPANDAI © {{ date('Y') }} · Sistem Ujian Digital
            </footer>

        </div>

    </main>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        const sidebar =
            document.getElementById("sidebar");

        const sidebarOverlay =
            document.getElementById("sidebarOverlay");

        const navbarHomeBtn =
            document.getElementById("navbarHomeBtn");

        const closeSidebar =
            document.getElementById("closeSidebar");


        function openSidebar() {

            sidebar.classList.add("show");

            sidebarOverlay.classList.add("show");

            document.body.classList.add("sidebar-open");

        }


        function closeSidebarMenu() {

            sidebar.classList.remove("show");

            sidebarOverlay.classList.remove("show");

            document.body.classList.remove("sidebar-open");

        }


        navbarHomeBtn.addEventListener(
            "click",
            function () {

                if (
                    sidebar.classList.contains("show")
                ) {

                    closeSidebarMenu();

                } else {

                    openSidebar();

                }

            }
        );


        closeSidebar.addEventListener(
            "click",
            closeSidebarMenu
        );


        sidebarOverlay.addEventListener(
            "click",
            closeSidebarMenu
        );


        document.addEventListener(
            "keydown",
            function (event) {

                if (event.key === "Escape") {

                    closeSidebarMenu();

                }

            }
        );


        document
            .querySelectorAll(".sidebar-menu .menu-item")
            .forEach(function (link) {

                link.addEventListener(
                    "click",
                    function () {

                        if (window.innerWidth <= 900) {

                            closeSidebarMenu();

                        }

                    }
                );

            });


        /*
         * TOMBOL SIMPAN
         * Form tetap dikirim normal ke route update.
         * JS hanya mengubah tampilan tombol setelah diklik.
         */

        const examForm =
            document.getElementById("examForm");

        const saveButton =
            document.getElementById("saveButton");

        const saveButtonText =
            document.getElementById("saveButtonText");


        examForm.addEventListener(
            "submit",
            function () {

                saveButton.disabled = true;

                saveButtonText.textContent =
                    "Menyimpan...";

                saveButton.querySelector("i").className =
                    "fa-solid fa-circle-notch fa-spin";

            }
        );

    </script>

</body>

</html>