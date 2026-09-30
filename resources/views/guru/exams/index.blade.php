<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ujian Guru - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        /* =========================
           RESET
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =========================
           ROOT
        ========================= */

        :root {
            --primary: #a9232a;
            --primary-dark: #8f1d24;
            --primary-soft: #f7e4e5;

            --text: #292929;
            --muted: #777;
            --light-muted: #999;

            --border: #e4e4e1;
            --bg: #f4f4f2;
            --white: #ffffff;

            --sidebar-width: 245px;

            --red: #8f2635;
            --red-dark: #741c29;
            --red-light: #f7e9eb;
        }


        /* =========================
           BODY
        ========================= */

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        body.sidebar-open {
            overflow: hidden;
        }


        /* =========================
           SIDEBAR
        ========================= */

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

            border-right:
                1px solid rgba(255, 255, 255, .09);

            z-index: 1200;

            transform:
                translateX(calc(-100% - 2px));

            transition:
                transform .45s cubic-bezier(.22, 1, .36, 1),
                box-shadow .45s ease;

            overflow: hidden;

            box-shadow:
                inset -1px 0 rgba(255, 255, 255, .025);
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
                    rgba(255, 255, 255, .12),
                    transparent
                );

            pointer-events: none;
        }

        .sidebar.show {
            transform: translateX(0);

            box-shadow:
                18px 0 45px rgba(0, 0, 0, .18),
                inset -1px 0 rgba(255, 255, 255, .025);
        }


        /* =========================
           SIDEBAR HEADER
        ========================= */

        .sidebar-header {
            position: relative;

            height: 88px;
            min-height: 88px;

            padding: 0 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom:
                1px solid rgba(255, 255, 255, .075);

            flex-shrink: 0;

            z-index: 2;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;

            min-width: 0;
        }

        .sidebar-logo {
            width: 42px;
            height: 42px;

            object-fit: contain;

            background: transparent;
            border: none;
            border-radius: 0;

            filter:
                drop-shadow(0 5px 12px rgba(0, 0, 0, .22));

            flex-shrink: 0;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            gap: 3px;

            min-width: 0;
        }

        .sidebar-brand-text strong {
            color: #fff;

            font-size: 15px;
            font-weight: 800;

            letter-spacing: -.3px;
        }

        .sidebar-brand-text span {
            color:
                rgba(255, 255, 255, .42);

            font-size: 9px;
            font-weight: 600;

            letter-spacing: 1px;

            white-space: nowrap;
        }


        /* =========================
           CLOSE SIDEBAR
        ========================= */

        .sidebar-close {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255, 255, 255, .08);

            border-radius: 9px;

            background:
                rgba(255, 255, 255, .055);

            color:
                rgba(255, 255, 255, .68);

            cursor: pointer;

            transition:
                background .25s ease,
                color .25s ease,
                transform .3s ease;

            flex-shrink: 0;
        }

        .sidebar-close:hover {
            background:
                rgba(143, 38, 53, .75);

            color: #fff;

            transform: rotate(90deg);
        }


        /* =========================
           SIDEBAR MENU
        ========================= */

        .sidebar-menu {
            position: relative;

            z-index: 2;

            flex: 1;

            display: flex;
            flex-direction: column;

            padding: 25px 15px 15px;

            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background:
                rgba(255, 255, 255, .12);

            border-radius: 10px;
        }

        .menu-label {
            margin: 0 10px 12px;

            color:
                rgba(255, 255, 255, .38);

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1.5px;
        }

        .menu-list {
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

            border:
                1px solid transparent;

            border-radius: 11px;

            color:
                rgba(255, 255, 255, .67);

            font-size: 13px;
            font-weight: 600;

            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;

            text-decoration: none;
        }

        .menu-item i {
            width: 19px;

            display: flex;
            align-items: center;
            justify-content: center;

            color:
                rgba(255, 255, 255, .42);

            font-size: 14px;

            transition:
                color .25s ease;
        }

        .menu-item:hover {
            background:
                rgba(255, 255, 255, .065);

            color: #fff;

            transform:
                translateX(2px);
        }

        .menu-item:hover i {
            color: #e7aab2;
        }

        .menu-item.active {
            background:
                linear-gradient(
                    90deg,
                    rgba(143, 38, 53, .74),
                    rgba(143, 38, 53, .37)
                );

            border-color:
                rgba(255, 255, 255, .08);

            color: #fff;

            box-shadow:
                0 8px 20px rgba(0, 0, 0, .12),
                inset 0 1px rgba(255, 255, 255, .06);
        }

        .menu-item.active::before {
            content: "";

            position: absolute;

            left: -1px;
            top: 9px;
            bottom: 9px;

            width: 3px;

            background: #e7aab2;

            border-radius:
                0 4px 4px 0;
        }

        .menu-item.active i {
            color: #fff;
        }


        /* =========================
           SIDEBAR PROFILE
           SAMA DENGAN DASHBOARD GURU
        ========================= */

        .sidebar-profile {
            position: relative;

            z-index: 2;

            margin: 0 15px 15px;

            padding: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.075),
                    rgba(255,255,255,.035)
                );

            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);

            border:
                1px solid rgba(255,255,255,.08);

            border-radius: 13px;

            box-shadow:
                0 10px 25px rgba(0,0,0,.10);
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

            flex-shrink: 0;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    #a93a4b,
                    #741c29
                );

            color: #fff;

            font-size: 13px;
            font-weight: 800;

            box-shadow:
                0 5px 14px rgba(116,28,41,.28);
        }

        .sidebar-profile-info {
            min-width: 0;
            flex: 1;
        }

        .sidebar-profile-name {
            color: #fff;

            font-size: 11px;
            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-profile-role {
            color:
                rgba(255,255,255,.48);

            font-size: 9px;
            font-weight: 500;

            margin-top: 3px;
        }

        .logout-form {
            margin: 0;
            width: 100%;
        }

        .logout-btn {
            width: 100%;
            height: 36px;

            border:
                1px solid rgba(231,170,178,.18);

            background:
                rgba(143,38,53,.14);

            color:
                rgba(255,255,255,.72);

            border-radius: 8px;

            cursor: pointer;

            font-family: 'Inter', sans-serif;

            font-size: 11px;
            font-weight: 600;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            transition:
                background .25s ease,
                color .25s ease,
                border-color .25s ease;
        }

        .logout-btn:hover {
            background:
                rgba(143,38,53,.34);

            border-color:
                rgba(231,170,178,.32);

            color: #fff;
        }


        /* =========================
           OVERLAY
           TANPA BLUR
        ========================= */

        .sidebar-overlay {
            position: fixed;

            inset: 0;

            background:
                rgba(0, 0, 0, .22);

            opacity: 0;
            visibility: hidden;

            transition:
                opacity .35s ease,
                visibility .35s ease;

            z-index: 1100;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }


        /* =========================
           MAIN
        ========================= */

        .main {
            width: 100%;

            min-height: 100vh;

            margin-left: 0;

            transition:
                margin-left .45s cubic-bezier(.22, 1, .36, 1),
                width .45s cubic-bezier(.22, 1, .36, 1);
        }

        @media (min-width: 901px) {

            body.sidebar-open .main {
                margin-left: var(--sidebar-width);

                width:
                    calc(100% - var(--sidebar-width));
            }

        }


        /* =========================
           TOPBAR / NAVBAR
        ========================= */

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
                    rgba(27, 26, 26, .88),
                    rgba(27, 26, 26, .72)
                );

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            border-bottom:
                1px solid rgba(255,255,255,.08);

            box-shadow:
                0 7px 25px rgba(0,0,0,.12);

            z-index: 1050;

            transition:
                left .45s cubic-bezier(.22,1,.36,1),
                width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .topbar {
            left: var(--sidebar-width);

            width:
                calc(100% - var(--sidebar-width));
        }

        .topbar-left {
            display: flex;
            align-items: center;

            gap: 15px;

            min-width: 0;
        }


        /* =========================
           HAMBURGER
        ========================= */

        .page-icon {
            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border:
                1px solid rgba(255,255,255,.12);

            border-radius: 10px;

            background:
                rgba(255,255,255,.065);

            color:
                rgba(255,255,255,.82);

            cursor: pointer;

            transition:
                background .25s ease,
                border-color .25s ease,
                color .25s ease,
                transform .25s ease;
        }

        .page-icon i {
            font-size: 13px;
        }

        .page-icon:hover {
            background: var(--red);

            border-color:
                rgba(255,255,255,.15);

            color: #fff;

            transform:
                translateY(-1px);
        }


        /* =========================
           TOPBAR LOGO
           (BISA DIKLIK -> DASHBOARD)
        ========================= */

        .topbar-logo {
            width: 35px;
            height: 35px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            text-decoration: none;

            border-radius: 10px;

            transition:
                transform .25s ease;
        }

        .topbar-logo:hover {
            transform:
                scale(1.06);
        }

        .topbar-logo img {
            width: 35px;
            height: 35px;

            object-fit: contain;

            display: block;

            background: transparent;

            border: none;

            filter:
                drop-shadow(0 4px 10px rgba(0,0,0,.18));
        }


        /* =========================
           TOPBAR TITLE + BREADCRUMB
        ========================= */

        .topbar-page {
            display: flex;
            flex-direction: column;

            gap: 5px;

            min-width: 0;
        }

        .breadcrumb {
            display: flex;
            align-items: center;

            gap: 9px;

            min-width: 0;

            line-height: 1;
        }

        .crumb {
            display: flex;
            align-items: center;

            gap: 9px;

            min-width: 0;
        }


        /* ROOT: SIPANDAI (KLIK -> DASHBOARD) */

        .breadcrumb-root {
            position: relative;

            flex-shrink: 0;

            color: #fff;

            font-size: 14px;
            font-weight: 800;

            letter-spacing: -.2px;

            text-decoration: none;

            white-space: nowrap;
        }

        .breadcrumb-root::after {
            content: "";

            position: absolute;

            left: 0;
            bottom: -4px;

            width: 100%;
            height: 1.5px;

            background:
                rgba(255, 255, 255, .85);

            border-radius: 2px;

            transform: scaleX(0);
            transform-origin: left;

            transition:
                transform .3s cubic-bezier(.22, 1, .36, 1);
        }

        .breadcrumb-root:hover::after {
            transform: scaleX(1);
        }


        /* PEMISAH  > */

        .breadcrumb-sep {
            flex-shrink: 0;

            color:
                rgba(255, 255, 255, .38);

            font-size: 8px;

            transition:
                color .25s ease,
                transform .25s ease;
        }

        .breadcrumb:hover .breadcrumb-sep {
            color:
                rgba(255, 255, 255, .7);

            transform:
                translateX(1px);
        }


        /* LEVEL TENGAH (BUKAN HALAMAN AKTIF) */

        .breadcrumb-link {
            position: relative;

            padding: 5px 1px;

            color:
                rgba(255, 255, 255, .6);

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1px;

            text-decoration: none;

            white-space: nowrap;

            transition:
                color .25s ease;
        }

        .breadcrumb-link:hover {
            color: #fff;
        }


        /* HALAMAN AKTIF (PILL PUTIH SOFT) */

        .breadcrumb-current {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            min-width: 0;

            padding: 5px 11px 5px 9px;

            border:
                1px solid rgba(255, 255, 255, .16);

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, .16),
                    rgba(255, 255, 255, .06)
                );

            color: #fff;

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1px;

            text-decoration: none;

            box-shadow:
                inset 0 1px rgba(255, 255, 255, .08);

            transition:
                background .25s ease,
                border-color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }

        .breadcrumb-current::before {
            content: "";

            flex-shrink: 0;

            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #fff;

            box-shadow:
                0 0 8px rgba(255, 255, 255, .6);
        }

        .breadcrumb-current span {
            max-width: 220px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .breadcrumb-current:hover {
            background:
                linear-gradient(
                    135deg,
                    rgba(255, 255, 255, .26),
                    rgba(255, 255, 255, .11)
                );

            border-color:
                rgba(255, 255, 255, .32);

            transform:
                translateY(-1px);

            box-shadow:
                0 6px 16px rgba(0, 0, 0, .25),
                inset 0 1px rgba(255, 255, 255, .1);
        }

        .breadcrumb-root:focus-visible,
        .breadcrumb-link:focus-visible,
        .breadcrumb-current:focus-visible,
        .topbar-logo:focus-visible {
            outline:
                2px solid rgba(255, 255, 255, .8);

            outline-offset: 3px;
        }

        .page-title {
            color:
                rgba(255,255,255,.48);

            font-size: 8px;

            line-height: 1;

            font-weight: 600;

            letter-spacing: 1.4px;

            white-space: nowrap;
        }


        /* =========================
           TOPBAR RIGHT
        ========================= */

        .topbar-right {
            display: flex;
            align-items: center;

            gap: 12px;

            flex-shrink: 0;
        }


        /* =========================
           SYSTEM STATUS
        ========================= */

        .system-status {
            display: none;
        }


        /* =========================
           NOTIFICATION
        ========================= */

        .notification {
            width: 37px;
            height: 37px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255,255,255,.08);

            border-radius: 50%;

            background:
                rgba(255,255,255,.055);

            color:
                rgba(255,255,255,.72);

            font-size: 13px;

            cursor: pointer;

            transition:
                background .25s ease,
                color .25s ease,
                border-color .25s ease;
        }

        .notification:hover {
            background:
                rgba(143,38,53,.65);

            color: #fff;
        }

        .notification-badge {
            display: none;
        }


        /* =========================
           PROFILE
        ========================= */

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

            border-radius: 10px;

            background:
                linear-gradient(
                    145deg,
                    #a73a49,
                    #741c29
                );

            color: #fff;

            font-size: 11px;
            font-weight: 800;

            box-shadow:
                0 5px 14px rgba(0,0,0,.18);
        }

        .profile-info {
            display: flex;
            flex-direction: column;

            gap: 2px;
        }

        .profile-info strong {
            max-width: 125px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            color: #fff;

            font-size: 11px;
            font-weight: 700;
        }

        .profile-info span {
            color:
                rgba(255,255,255,.42);

            font-size: 9px;
            font-weight: 500;
        }


        /* =========================
           MAIN CONTAINER
        ========================= */

        .container {
            width: 100%;

            max-width: 1050px;

            margin: 0 auto;

            padding:
                104px
                25px
                50px;

            min-width: 0;
        }


        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;
            align-items: center;

            gap: 20px;

            margin-bottom: 30px;
        }

        .page-header h1 {
            font-family: 'Inter', sans-serif;

            font-size: 28px;
            font-weight: 700;

            color: #292929;

            margin-bottom: 7px;

            letter-spacing: -.6px;
        }

        .page-header p {
            color: #7b7b78;

            font-family: 'Inter', sans-serif;

            font-size: 13px;
            font-weight: 400;
        }

        .btn-add {
            display: inline-block;

            text-decoration: none;

            background: var(--primary);

            color: white;

            padding: 12px 17px;

            border-radius: 9px;

            font-family: 'Inter', sans-serif;

            font-size: 12px;
            font-weight: 600;

            transition: all .2s ease;
        }

        .btn-add:hover {
            background: var(--primary-dark);

            transform:
                translateY(-1px);

            box-shadow:
                0 6px 15px rgba(169,35,42,.15);
        }


        /* =========================
           ALERT
        ========================= */

        .alert {
            padding: 13px 16px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-family: 'Inter', sans-serif;

            font-size: 13px;
            font-weight: 500;
        }

        .alert-success {
            background: #eaf7ef;
            color: #287a45;
        }

        .alert-error {
            background: #fbeded;
            color: #b3262d;
        }


        /* =========================
           EMPTY
        ========================= */

        .empty {
            background: white;

            border-radius: 17px;

            padding: 50px 25px;

            text-align: center;

            border:
                1px solid #e7e7e4;

            box-shadow:
                0 5px 18px rgba(50,50,50,.045);
        }

        .empty-icon {
            font-size: 43px;

            margin-bottom: 12px;
        }

        .empty h2 {
            font-family: 'Inter', sans-serif;

            font-size: 20px;
            font-weight: 700;

            color: #292929;

            margin-bottom: 8px;
        }

        .empty p {
            color: #7b7b78;

            font-family: 'Inter', sans-serif;

            font-size: 13px;

            margin-bottom: 20px;
        }


        /* =========================
           EXAM GRID
        ========================= */

        .exam-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 20px;

            min-width: 0;
        }


        /* =========================
           EXAM CARD
        ========================= */

        .exam-card {
            background: white;

            border-radius: 17px;

            padding: 23px;

            border:
                1px solid #e7e7e4;

            box-shadow:
                0 5px 18px rgba(50,50,50,.045);

            transition: all .2s ease;

            min-width: 0;
        }

        .exam-card:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 9px 25px rgba(50,50,50,.07);
        }

        .exam-top {
            display: flex;

            justify-content: space-between;
            align-items: flex-start;

            gap: 15px;

            margin-bottom: 15px;

            min-width: 0;
        }

        .exam-top > div:first-child {
            min-width: 0;
        }

        .exam-title {
            font-family: 'Inter', sans-serif;

            font-size: 18px;
            font-weight: 700;

            color: #292929;

            margin-bottom: 6px;

            letter-spacing: -.3px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }

        .exam-subtitle {
            color: #81817e;

            font-family: 'Inter', sans-serif;

            font-size: 12px;
            font-weight: 400;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================
           STATUS
        ========================= */

        .status {
            padding: 6px 10px;

            border-radius: 20px;

            font-family: 'Inter', sans-serif;

            font-size: 9px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .3px;

            white-space: nowrap;

            flex-shrink: 0;
        }

        .status-draft {
            background: #eeeeec;
            color: #666;
        }

        .status-aktif {
            background: #eaf7ef;
            color: #198754;
        }

        .status-selesai {
            background: #f7e4e5;
            color: var(--primary);
        }


        /* =========================
           EXAM INFO
        ========================= */

        .exam-info {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 9px;

            margin: 20px 0;
        }

        .info-item {
            background: #f7f7f5;

            border:
                1px solid #e9e9e6;

            border-radius: 9px;

            padding: 11px;

            min-width: 0;
        }

        .info-label {
            color: #999;

            font-family: 'Inter', sans-serif;

            font-size: 10px;
            font-weight: 500;

            margin-bottom: 5px;
        }

        .info-value {
            font-family: 'Inter', sans-serif;

            font-size: 12px;
            font-weight: 600;

            color: #353535;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================
           CODE
        ========================= */

        .code-box {
            background: #f8e9ea;

            border:
                1px solid #f0d6d8;

            border-radius: 9px;

            padding: 11px 13px;

            margin-bottom: 18px;
        }

        .code-label {
            color: #999;

            font-family: 'Inter', sans-serif;

            font-size: 9px;
            font-weight: 600;

            margin-bottom: 4px;

            letter-spacing: .2px;
        }

        .code {
            color: var(--primary);

            font-family: 'Inter', sans-serif;

            font-size: 15px;
            font-weight: 700;

            letter-spacing: 2px;
        }


        /* =========================
           ACTION
        ========================= */

        .actions {
            display: flex;

            flex-wrap: wrap;

            gap: 7px;

            padding-top: 17px;

            border-top:
                1px solid #ededeb;
        }

        .btn {
            border: none;

            text-decoration: none;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-height: 36px;

            padding: 9px 14px;

            border-radius: 8px;

            font-family: 'Inter', sans-serif;

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: all .2s ease;
        }


        /* =========================
           KELOLA
        ========================= */

        .btn-detail {
            background: #f8e9ea;

            color: var(--primary);

            border:
                1px solid #efd5d7;
        }

        .btn-detail:hover {
            background: #f4dfe0;

            border-color: #e7c3c5;

            transform:
                translateY(-1px);
        }


        /* =========================
           EDIT
        ========================= */

        .btn-edit {
            background: #eeeeec;

            color: #666;

            border:
                1px solid #e3e3e0;
        }

        .btn-edit:hover {
            background: #e4e4e1;

            border-color: #d9d9d6;

            transform:
                translateY(-1px);
        }


        /* =========================
           AKHIRI UJIAN
        ========================= */

        .btn-finish {
            background: #fff0f0;

            color: #c53030;

            border:
                1px solid #f4d2d2;
        }

        .btn-finish:hover {
            background: #ffe3e3;

            border-color: #ecc0c0;

            transform:
                translateY(-1px);
        }


        /* =========================
           HAPUS
        ========================= */

        .btn-delete {
            background: #fff0f0;

            color: #c53030;

            border:
                1px solid #f4d2d2;
        }

        .btn-delete:hover {
            background: #ffe3e3;

            border-color: #ecc0c0;

            transform:
                translateY(-1px);
        }

        .action-form {
            margin: 0;
        }


        /* =========================
           RESPONSIVE 1100
        ========================= */

        @media (max-width: 1100px) {

            .topbar {
                padding: 0 24px;
            }

            .topbar-right {
                gap: 14px;
            }

        }


        /* =========================
           RESPONSIVE 900
        ========================= */

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

            .system-status {
                display: none;
            }

        }


        /* =========================
           RESPONSIVE 800
        ========================= */

        @media (max-width: 800px) {

            .exam-grid {
                grid-template-columns: 1fr;
            }

        }


        /* =========================
           RESPONSIVE 700
        ========================= */

        @media (max-width: 700px) {

            .topbar {
                height: 64px;

                padding:
                    0 15px;

                gap: 10px;
            }

            .topbar-left {
                gap: 9px;
            }

            .page-icon {
                width: 36px;
                height: 36px;
            }

            .topbar-logo,
            .topbar-logo img {
                width: 34px;
                height: 34px;
            }

            .page-title {
                font-size: 8px;
            }

            .notification {
                display: none;
            }

            .profile-info {
                display: none;
            }

            .topbar-right {
                gap: 7px;
            }

            .profile-avatar {
                width: 34px;
                height: 34px;
            }

            .container {
                padding-top: 94px;

                margin-top: 0;
            }

        }


        /* =========================
           RESPONSIVE 600
        ========================= */

        @media (max-width: 600px) {

            .container {
                padding-left: 17px;
                padding-right: 17px;
            }

            .page-header {
                flex-direction: column;

                align-items: stretch;
            }

            .page-header h1 {
                font-size: 25px;
            }

            .btn-add {
                text-align: center;
            }

            .exam-info {
                grid-template-columns: 1fr;
            }

            .exam-top {
                flex-direction: column;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;

                text-align: center;
            }

        }


        /* =========================
           RESPONSIVE DASHBOARD
           650
        ========================= */

        @media (max-width: 650px) {

            .sidebar {
                width: 270px;
            }

            .topbar {
                padding: 0 20px;
            }

            .navbar-profile-info {
                display: none;
            }

            .topbar-logo,
            .topbar-logo img {
                width: 32px;
                height: 32px;
            }

        }


        /* =========================
           RESPONSIVE 450
        ========================= */

        @media (max-width: 450px) {

            .topbar {
                padding:
                    0 14px;
            }

            .topbar-left {
                gap: 8px;
            }

            .page-icon {
                width: 35px;
                height: 35px;
            }

            .topbar-logo,
            .topbar-logo img {
                width: 33px;
                height: 33px;
            }

            .page-title {
                display: none;
            }

            .breadcrumb,
            .crumb {
                gap: 7px;
            }

            .breadcrumb-root {
                font-size: 13px;
            }

            .breadcrumb-current {
                padding: 5px 9px 5px 8px;

                font-size: 8.5px;

                letter-spacing: .8px;
            }

            .breadcrumb-current span {
                max-width: 150px;
            }

            .sidebar {
                width: 280px;
            }

        }


        /* =========================
           RESPONSIVE 600
           LEVEL TENGAH BREADCRUMB DISEMBUNYIKAN
           (ROOT + HALAMAN AKTIF TETAP TAMPIL)
        ========================= */

        @media (max-width: 600px) {

            .crumb-mid {
                display: none;
            }

        }


        /* =========================
           RESPONSIVE 380
           HP KECIL: LOGO DISEMBUNYIKAN
           SUPAYA BREADCRUMB TETAP MUAT
        ========================= */

        @media (max-width: 380px) {

            .topbar-logo {
                display: none;
            }

        }


        /* =========================
           REDUCED MOTION
        ========================= */

        @media (prefers-reduced-motion: reduce) {

            .breadcrumb-root::after,
            .breadcrumb-sep,
            .breadcrumb-link,
            .breadcrumb-current,
            .topbar-logo {
                transition: none;
            }

        }

    </style>

</head>


<body>


    <!-- =========================
         SIDEBAR
    ========================= -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="sidebar-logo"
                >

                <div class="sidebar-brand-text">

                    <strong>
                        SIPANDAI
                    </strong>

                    <span>
                        SMKN 2 KOTA KEDIRI
                    </span>

                </div>

            </div>


            <button
                type="button"
                class="sidebar-close"
                id="sidebarClose"
                aria-label="Tutup menu"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <div class="sidebar-menu">

            <div class="menu-label">
                MENU UTAMA
            </div>


            <div class="menu-list">

                <a
                    href="{{ route('guru.dashboard') }}"
                    class="menu-item"
                >
                    <i class="fa-solid fa-house"></i>

                    <span>
                        Dashboard
                    </span>
                </a>


                <a
                    href="{{ route('guru.exams.index') }}"
                    class="menu-item active"
                >
                    <i class="fa-solid fa-clipboard-list"></i>

                    <span>
                        Kelola Ujian
                    </span>
                </a>


                <a
                    href="{{ route('guru.results.index') }}"
                    class="menu-item"
                >
                    <i class="fa-solid fa-chart-column"></i>

                    <span>
                        Hasil Ujian
                    </span>
                </a>


                <a
                    href="{{ route('guru.data-siswa') }}"
                    class="menu-item"
                >
                    <i class="fa-solid fa-users"></i>

                    <span>
                        Data Siswa
                    </span>
                </a>

            </div>

        </div>


        <!-- PROFILE GURU -->

        @php
            $guru = auth()->user();
            $guruName = $guru->name ?? 'Guru';
            $guruInitial = strtoupper(substr($guruName, 0, 1));
        @endphp

        <div class="sidebar-profile">

            <div class="sidebar-profile-top">

                <div class="sidebar-avatar">
                    {{ $guruInitial }}
                </div>

                <div class="sidebar-profile-info">

                    <div class="sidebar-profile-name">
                        {{ $guruName }}
                    </div>

                    <div class="sidebar-profile-role">
                        Akun Guru
                    </div>

                </div>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span>
                        Keluar
                    </span>

                </button>

            </form>

        </div>

    </aside>


    <!-- =========================
         OVERLAY
    ========================= -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    <!-- =========================
         MAIN
    ========================= -->

    <main class="main">


        <!-- =========================
             TOPBAR
        ========================= -->

        <header class="topbar">

            <div class="topbar-left">


                <button
                    type="button"
                    class="page-icon"
                    id="navbarHomeBtn"
                    aria-label="Buka menu"
                >
                    <i class="fa-solid fa-bars"></i>
                </button>


                <!-- LOGO (KLIK -> DASHBOARD) -->

                <a
                    href="{{ route('guru.dashboard') }}"
                    class="topbar-logo"
                    aria-label="Ke Dashboard"
                >

                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo SMKN 2 Kota Kediri"
                    >

                </a>


                <div class="topbar-page">

                    <!-- BREADCRUMB: SIPANDAI > KELOLA UJIAN -->

                    <nav
                        class="breadcrumb"
                        aria-label="Breadcrumb"
                    >

                        <a
                            href="{{ route('guru.dashboard') }}"
                            class="breadcrumb-root"
                        >
                            SIPANDAI
                        </a>


                        {{--
                            CONTOH KALAU ADA LEVEL LAGI (misal halaman Detail Ujian):
                            level tengah pakai class "crumb crumb-mid" + "breadcrumb-link",
                            level terakhir (halaman aktif) pakai "breadcrumb-current".

                            <span class="crumb crumb-mid">
                                <i class="fa-solid fa-chevron-right breadcrumb-sep" aria-hidden="true"></i>
                                <a href="{{ route('guru.exams.index') }}" class="breadcrumb-link">
                                    KELOLA UJIAN
                                </a>
                            </span>

                            <span class="crumb">
                                <i class="fa-solid fa-chevron-right breadcrumb-sep" aria-hidden="true"></i>
                                <a href="{{ route('guru.exams.show', $exam) }}" class="breadcrumb-current" aria-current="page">
                                    <span>{{ $exam->nama_ujian }}</span>
                                </a>
                            </span>
                        --}}


                        <span class="crumb">

                            <i
                                class="fa-solid fa-chevron-right breadcrumb-sep"
                                aria-hidden="true"
                            ></i>

                            <a
                                href="{{ route('guru.exams.index') }}"
                                class="breadcrumb-current"
                                aria-current="page"
                            >
                                <span>KELOLA UJIAN</span>
                            </a>

                        </span>

                    </nav>


                    <div class="page-title">
                        SISTEM UJIAN DIGITAL
                    </div>

                </div>

            </div>


            <div class="topbar-right">


                <div class="notification">

                    <i class="fa-regular fa-bell"></i>

                </div>


                <div class="profile">

                    <div class="profile-avatar">

                        @auth

                            {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}

                        @else

                            G

                        @endauth

                    </div>


                    <div class="profile-info">

                        <strong>

                            @auth

                                {{ auth()->user()->name ?? 'Guru' }}

                            @else

                                Guru

                            @endauth

                        </strong>


                        <span>
                            Guru
                        </span>

                    </div>

                </div>

            </div>

        </header>


        <!-- =========================
             CONTENT
        ========================= -->

        <section class="container">


            <!-- HEADER -->

            <div class="page-header">

                <div>

                    <h1>
                        Daftar Ujian
                    </h1>

                    <p>
                        Kelola ujian dan pelaksanaan ujian siswa.
                    </p>

                </div>


                <a
                    href="{{ route('guru.exams.create') }}"
                    class="btn-add"
                >
                    + Buat Ujian
                </a>

            </div>


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="alert alert-success">

                    ✓ {{ session('success') }}

                </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

                <div class="alert alert-error">

                    ✕ {{ session('error') }}

                </div>

            @endif


            <!-- DAFTAR UJIAN -->

            @if($exams->count() === 0)

                <div class="empty">

                    <div class="empty-icon">
                        📝
                    </div>

                    <h2>
                        Belum Ada Ujian
                    </h2>

                    <p>
                        Silakan buat ujian terlebih dahulu.
                    </p>

                    <a
                        href="{{ route('guru.exams.create') }}"
                        class="btn btn-detail"
                    >
                        + Buat Ujian
                    </a>

                </div>

            @else

                <div class="exam-grid">

                    @foreach($exams as $exam)

                        <div class="exam-card">


                            <!-- TOP -->

                            <div class="exam-top">

                                <div>

                                    <div class="exam-title">
                                        {{ $exam->nama_ujian }}
                                    </div>

                                    <div class="exam-subtitle">

                                        {{ $exam->mata_pelajaran }}

                                        •

                                        {{ $exam->kelas }}

                                    </div>

                                </div>


                                <div
                                    class="status status-{{ $exam->status }}"
                                >
                                    {{ $exam->status }}
                                </div>

                            </div>


                            <!-- INFO -->

                            <div class="exam-info">


                                <div class="info-item">

                                    <div class="info-label">
                                        Tanggal
                                    </div>

                                    <div class="info-value">
                                        {{ $exam->tanggal_ujian->format('d M Y') }}
                                    </div>

                                </div>


                                <div class="info-item">

                                    <div class="info-label">
                                        Waktu
                                    </div>

                                    <div class="info-value">

                                        {{ substr($exam->jam_mulai, 0, 5) }}

                                        -

                                        {{ substr($exam->jam_selesai, 0, 5) }}

                                    </div>

                                </div>


                                <div class="info-item">

                                    <div class="info-label">
                                        Durasi
                                    </div>

                                    <div class="info-value">
                                        {{ $exam->durasi }} menit
                                    </div>

                                </div>


                                <div class="info-item">

                                    <div class="info-label">
                                        Jumlah Soal
                                    </div>

                                    <div class="info-value">
                                        {{ $exam->questions->count() }}
                                    </div>

                                </div>


                            </div>


                            <!-- KODE UJIAN -->

                            <div class="code-box">

                                <div class="code-label">
                                    KODE UJIAN SISWA
                                </div>

                                <div class="code">
                                    {{ $exam->kode_ujian }}
                                </div>

                            </div>


                            <!-- ACTION -->

                            <div class="actions">


                                <!-- KELOLA -->

                                <a
                                    href="{{ route('guru.exams.show', $exam) }}"
                                    class="btn btn-detail"
                                >
                                    Kelola
                                </a>


                                <!-- EDIT -->

                                @if($exam->status === 'draft')

                                    <a
                                        href="{{ route('guru.exams.edit', $exam) }}"
                                        class="btn btn-edit"
                                    >
                                        Edit
                                    </a>

                                @endif


                                <!-- AKHIRI UJIAN -->

                                @if($exam->status === 'aktif')

                                    <form
                                        action="{{ route('guru.exams.finish', $exam) }}"
                                        method="POST"
                                        class="action-form"
                                        onsubmit="return confirm('Yakin ingin mengakhiri ujian ini?\n\nSetelah diakhiri, siswa tidak dapat mengikuti ujian lagi.')"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-finish"
                                        >
                                            Akhiri Ujian
                                        </button>

                                    </form>

                                @endif


                                <!-- HAPUS -->

                                @if($exam->status !== 'aktif')

                                    <form
                                        action="{{ route('guru.exams.destroy', $exam) }}"
                                        method="POST"
                                        class="action-form"
                                        onsubmit="return confirm('Yakin ingin menghapus ujian ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                @endif


                            </div>

                        </div>

                    @endforeach

                </div>

            @endif


        </section>

    </main>


    <!-- =========================
         SIDEBAR JAVASCRIPT
    ========================= -->

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const sidebar =
                    document.getElementById('sidebar');

                const sidebarClose =
                    document.getElementById('sidebarClose');

                const sidebarOverlay =
                    document.getElementById('sidebarOverlay');

                const navbarHomeBtn =
                    document.getElementById('navbarHomeBtn');


                function openSidebar() {

                    sidebar.classList.add('show');

                    sidebarOverlay.classList.add('show');

                    document.body.classList.add('sidebar-open');

                }


                function closeSidebar() {

                    sidebar.classList.remove('show');

                    sidebarOverlay.classList.remove('show');

                    document.body.classList.remove('sidebar-open');

                }


                if (navbarHomeBtn) {

                    navbarHomeBtn.addEventListener(
                        'click',
                        function () {

                            if (
                                sidebar.classList.contains('show')
                            ) {

                                closeSidebar();

                            } else {

                                openSidebar();

                            }

                        }
                    );

                }


                if (sidebarClose) {

                    sidebarClose.addEventListener(
                        'click',
                        function () {

                            closeSidebar();

                        }
                    );

                }


                if (sidebarOverlay) {

                    sidebarOverlay.addEventListener(
                        'click',
                        function () {

                            closeSidebar();

                        }
                    );

                }


                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (event.key === 'Escape') {

                            closeSidebar();

                        }

                    }
                );


                const sidebarLinks =
                    document.querySelectorAll(
                        '.sidebar-menu .menu-item'
                    );


                sidebarLinks.forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                if (
                                    window.innerWidth <= 900
                                ) {

                                    closeSidebar();

                                }

                            }
                        );

                    }
                );


                window.addEventListener(
                    'resize',
                    function () {

                        if (window.innerWidth > 900) {

                            sidebarOverlay.classList.remove('show');

                        }

                    }
                );

            }
        );

    </script>


</body>

</html>