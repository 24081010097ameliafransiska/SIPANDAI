<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - SIPANDAI</title>

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
            --bg-2: #ededed;

            --white: #fff;
            --border: #dadada;
            --border-light: #eeeeeb;

            --green: #5b9b6d;

            --sidebar-width: 245px;
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
            min-height: 100vh;
            background: #e9e9e9;
            color: var(--text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }


        /* =====================================================
           SIDEBAR — MASTER DASHBOARD GURU
        ====================================================== */

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

            border-bottom:
                1px solid rgba(255,255,255,.075);

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

            border:
                1px solid rgba(255,255,255,.08);

            border-radius: 9px;

            background:
                rgba(255,255,255,.055);

            color:
                rgba(255,255,255,.68);

            cursor: pointer;

            transition:
                .25s ease,
                transform .3s ease;
        }

        .close-sidebar:hover {
            background:
                rgba(143,38,53,.75);

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
            background:
                rgba(255,255,255,.12);

            border-radius: 10px;
        }

        .sidebar-label {
            margin: 0 10px 12px;

            color:
                rgba(255,255,255,.38);

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

            border:
                1px solid transparent;

            border-radius: 11px;

            color:
                rgba(255,255,255,.67);

            font-size: 13px;
            font-weight: 600;

            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }

        .menu-item i {
            width: 19px;

            display: flex;
            align-items: center;
            justify-content: center;

            color:
                rgba(255,255,255,.42);

            font-size: 14px;

            transition:
                color .25s ease;
        }

        .menu-item:hover {
            background:
                rgba(255,255,255,.065);

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
                    rgba(143,38,53,.74),
                    rgba(143,38,53,.37)
                );

            border-color:
                rgba(255,255,255,.08);

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

            border-radius:
                0 4px 4px 0;
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

            border:
                1px solid rgba(255,255,255,.08);

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

            box-shadow:
                0 5px 15px rgba(0,0,0,.18);
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
            color:
                rgba(255,255,255,.42);

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

            border:
                1px solid rgba(143,38,53,.32);

            border-radius: 8px;

            background:
                rgba(143,38,53,.12);

            color: #e7aab2;

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition: .25s ease;
        }

        .logout-link:hover {
            background:
                rgba(143,38,53,.78);

            border-color:
                rgba(143,38,53,.9);

            color: #fff;
        }


        /* =====================================================
           OVERLAY — MASTER
        ====================================================== */

        .sidebar-overlay {
            position: fixed;
            inset: 0;

            background:
                rgba(0,0,0,.22);

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


        /* =====================================================
           MAIN — MASTER
        ====================================================== */

        .main {
            position: relative;

            width: 100%;
            max-width: none;

            min-height: 100vh;

            margin-left: 0;
            margin-right: 0;

            padding: 0;

            overflow: hidden;

            transition:
                margin-left .45s cubic-bezier(.22,1,.36,1),
                width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .main {
            margin-left: var(--sidebar-width);
            width:
                calc(100% - var(--sidebar-width));
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


        

        /* =====================================================
           MAIN CONTENT
           TETAP DARI KODE KAMU
        ====================================================== */

        .main-content {
            min-height: 100vh;

            padding:
                104px 4.5vw 30px;

            position: relative;

            background:
                radial-gradient(
                    circle at 90% 5%,
                    rgba(143,38,53,.035),
                    transparent 27%
                ),
                linear-gradient(
                    180deg,
                    #f2f2f2 0%,
                    #eeeeee 100%
                );
        }

        .container {
            width: 100%;

            max-width: 1160px;

            margin: 0 auto;
        }


        /* =====================================================
           PAGE HEADER
        ====================================================== */

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;
        }

        .page-heading {
            min-width: 0;
        }

        .page-heading h1 {
            font-size: 24px;
            line-height: 1.25;

            font-weight: 800;

            color: var(--text);

            letter-spacing: -.5px;

            margin-bottom: 7px;
        }

        .page-heading p {
            font-size: 11px;
            line-height: 1.6;

            color: var(--muted);
        }

        .student-count {
            display: flex;
            align-items: center;

            gap: 8px;

            padding:
                9px 13px;

            border:
                1px solid var(--border);

            background: #ffffff;

            border-radius: 10px;

            color: #666;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;

            box-shadow:
                0 4px 14px rgba(0,0,0,.025);
        }

        .student-count i {
            color: var(--red);

            font-size: 12px;
        }


        /* =====================================================
           FILTER
        ====================================================== */

        .filter-card {
            background: #ffffff;

            border:
                1px solid var(--border);

            border-radius: 15px;

            padding: 17px;

            margin-bottom: 18px;

            box-shadow:
                0 7px 22px rgba(0,0,0,.035);
        }

        .filter-form {
            display: grid;

            grid-template-columns:
                minmax(250px,1fr)
                210px
                auto
                auto;

            align-items: end;

            gap: 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;

            gap: 7px;
        }

        .form-group label {
            font-size: 9px;

            color: #666;

            font-weight: 700;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;

            left: 12px;
            top: 50%;

            transform:
                translateY(-50%);

            color: #999;

            font-size: 12px;

            pointer-events: none;
        }

        .search-box input {
            width: 100%;
            height: 39px;

            padding:
                0 12px 0 34px;

            border:
                1px solid var(--border);

            border-radius: 9px;

            background: #fafaf8;

            outline: none;

            font-family: inherit;

            font-size: 10px;

            color: var(--text);

            transition: .2s ease;
        }

        .search-box input:focus {
            border-color: #c9959a;

            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(143,38,53,.07);
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper i {
            position: absolute;

            right: 12px;
            top: 50%;

            transform:
                translateY(-50%);

            font-size: 10px;

            color: #888;

            pointer-events: none;
        }

        .select-wrapper select {
            width: 100%;
            height: 39px;

            padding:
                0 32px 0 12px;

            border:
                1px solid var(--border);

            border-radius: 9px;

            background: #fafaf8;

            outline: none;

            appearance: none;
            -webkit-appearance: none;

            font-family: inherit;

            font-size: 10px;

            color: #555;

            cursor: pointer;
        }

        .select-wrapper select:focus {
            border-color: #c9959a;

            box-shadow:
                0 0 0 3px rgba(143,38,53,.07);
        }

        .filter-button,
        .reset-button {
            height: 39px;

            border-radius: 9px;

            padding:
                0 15px;

            font-family: inherit;

            font-size: 10px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            text-decoration: none;
        }

        .filter-button {
            border:
                1px solid var(--red);

            background: var(--red);

            color: #ffffff;
        }

        .filter-button:hover {
            background: var(--red-dark);

            border-color:
                var(--red-dark);

            transform:
                translateY(-1px);

            box-shadow:
                0 6px 15px rgba(143,38,53,.15);
        }

        .reset-button {
            border:
                1px solid var(--border);

            background: #ffffff;

            color: #666;
        }

        .reset-button:hover {
            background: #f4f4f2;

            color: var(--text);
        }


        /* =====================================================
           TABLE
        ====================================================== */

        .table-card {
            background: #ffffff;

            border:
                1px solid var(--border);

            border-radius: 15px;

            overflow: hidden;

            box-shadow:
                0 7px 22px rgba(0,0,0,.035);
        }

        .table-header {
            min-height: 60px;

            padding:
                0 19px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom:
                1px solid var(--border-light);
        }

        .table-header-title {
            display: flex;
            align-items: center;

            gap: 9px;
        }

        .table-header-title i {
            color: var(--red);

            font-size: 13px;
        }

        .table-header-title span {
            font-size: 11px;

            font-weight: 800;

            color: var(--text);
        }

        .table-info {
            font-size: 9px;

            color: #999;

            font-weight: 500;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }

        .student-table {
            width: 100%;

            border-collapse: collapse;
        }

        .student-table thead th {
            padding:
                12px 18px;

            background: #f7f7f5;

            border-bottom:
                1px solid var(--border-light);

            color: #858585;

            font-size: 8px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .5px;

            text-align: left;

            white-space: nowrap;
        }

        .student-table thead th:first-child {
            width: 55px;

            text-align: center;
        }

        .student-table tbody td {
            padding:
                13px 18px;

            border-bottom:
                1px solid #eeeeeb;

            font-size: 10px;

            color: #555;

            vertical-align: middle;
        }

        .student-table tbody tr:last-child td {
            border-bottom: none;
        }

        .student-table tbody tr {
            transition: .2s ease;
        }

        .student-table tbody tr:hover {
            background: #fcf8f8;
        }

        .student-table tbody td:first-child {
            text-align: center;

            color: #999;

            font-size: 9px;

            font-weight: 600;
        }

        .student-name {
            display: flex;
            align-items: center;

            gap: 10px;
        }

        .student-avatar {
            width: 34px;
            height: 34px;

            border-radius: 10px;

            background: var(--red-light);

            color: var(--red);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 11px;

            font-weight: 800;

            flex-shrink: 0;
        }

        .student-name-text {
            display: flex;
            flex-direction: column;

            gap: 3px;
        }

        .student-name-text strong {
            color: var(--text);

            font-size: 10px;

            font-weight: 700;
        }

        .student-name-text span {
            color: #a0a0a0;

            font-size: 8px;
        }

        .nis-value {
            font-weight: 600;

            color: #555;
        }

        .class-badge {
            display: inline-flex;

            align-items: center;

            padding:
                5px 8px;

            border-radius: 7px;

            background: #f1f1ef;

            color: #626262;

            font-size: 8px;

            font-weight: 700;
        }

        .absen-value {
            font-weight: 700;

            color: #5b5b5b;
        }


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        .empty-state {
            padding:
                65px 25px;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;

            border-radius: 16px;

            background: #f3f3f1;

            color: #999;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 15px;
        }

        .empty-icon i {
            font-size: 21px;
        }

        .empty-state h3 {
            font-size: 12px;

            color: var(--text);

            font-weight: 800;

            margin-bottom: 6px;
        }

        .empty-state p {
            max-width: 350px;

            font-size: 9px;

            line-height: 1.6;

            color: #999;
        }


        /* =====================================================
           FOOTER
        ====================================================== */

        .footer {
            padding:
                22px 0 5px;

            text-align: center;

            color: #999;

            font-size: 8px;

            font-weight: 500;
        }


        /* =====================================================
           RESPONSIVE — MASTER
        ====================================================== */

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
                padding:
                    0 20px;
            }

            .profile-info {
                display: none;
            }

            .main-content {
                padding:
                    94px
                    22px
                    30px;
            }
        }

        @media (max-width: 650px) {

            .sidebar {
                width: 270px;
            }

            .topbar {
                padding:
                    0 20px;
            }

            .navbar-logo {
                width: 32px;
                height: 32px;
            }

            .navbar-title strong {
                font-size: 13px;
            }

            .navbar-page {
                font-size: 10px;
            }

            .navbar-page-divider {
                font-size: 15px;
            }

            .navbar-title-sub {
                font-size: 7px;
            }

            .notification {
                width: 35px;
                height: 35px;
            }

            .main-content {
                padding:
                    90px
                    15px
                    30px;
            }

            .page-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-button,
            .reset-button {
                width: 100%;
            }

            .table-header {
                padding:
                    0 15px;
            }

            .student-table thead th,
            .student-table tbody td {
                padding-left: 13px;
                padding-right: 13px;
            }
        }

        @media (max-width: 420px) {

            .sidebar {
                width: 280px;
            }

            .navbar-title {
                display: none;
            }

            .topbar {
                padding:
                    0 14px;
            }

            .main-content {
                padding-left: 12px;
                padding-right: 12px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .student-count {
                font-size: 9px;
            }
        }

    
        /* =========================
           RESPONSIVE BREADCRUMB
        ========================= */

        @media (max-width: 700px) {

            .topbar {
                height: 64px;
                padding: 0 15px;
                gap: 10px;
            }

            .topbar-left {
                gap: 9px;
            }

            .navbar-home-btn,
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
        }

        @media (max-width: 450px) {

            .topbar {
                padding: 0 14px;
            }

            .topbar-left {
                gap: 8px;
            }

            .navbar-home-btn,
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
        }

        @media (max-width: 600px) {
            .crumb-mid {
                display: none;
            }
        }

        @media (max-width: 380px) {
            .topbar-logo {
                display: none;
            }
        }

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


    <!-- =====================================================
         SIDEBAR — SAMA PERSIS MASTER
    ====================================================== -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="sidebar-logo">

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
                class="close-sidebar"
                id="closeSidebar"
                aria-label="Tutup menu">

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
                    class="menu-item">

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


                <!-- HALAMAN AKTIF -->

                <a
                    href="{{ route('guru.data-siswa') }}"
                    class="menu-item active">

                    <i class="fa-solid fa-users"></i>

                    <span>
                        Data Siswa
                    </span>

                </a>

            </nav>


            <div class="sidebar-profile">

                <div class="sidebar-profile-top">

                    <div class="sidebar-avatar">

                        @auth

                            {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}

                        @else

                            G

                        @endauth

                    </div>


                    <div class="sidebar-profile-info">

                        <strong>

                            @auth

                                {{ auth()->user()->name ?? 'Guru' }}

                            @else

                                Guru

                            @endauth

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

                        <span>
                            Keluar
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </aside>


    <div
        class="sidebar-overlay"
        id="sidebarOverlay">
    </div>



    <!-- =====================================================
         MAIN
    ====================================================== -->

    <main class="main">


        <!-- =================================================
             TOPBAR — MASTER
        ================================================== -->

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



        <!-- =================================================
             MAIN CONTENT
             FUNGSI DAN FITUR ASLI KAMU TETAP
        ================================================== -->

        <section class="main-content">

            <div class="container">


                <!-- PAGE HEADER -->

                <div class="page-header">

                    <div class="page-heading">

                        <h1>
                            Data Siswa
                        </h1>

                        <p>
                            Daftar seluruh siswa yang terdaftar di SIPANDAI.
                        </p>

                    </div>


                    <div class="student-count">

                        <i class="fas fa-users"></i>

                        {{ $siswas->count() }} Siswa

                    </div>

                </div>



                <!-- FILTER -->

                <div class="filter-card">

                    <form
                        action="{{ route('guru.data-siswa') }}"
                        method="GET"
                        class="filter-form">


                        <!-- SEARCH -->

                        <div class="form-group">

                            <label for="search">
                                Cari Siswa
                            </label>

                            <div class="search-box">

                                <i class="fas fa-search"></i>

                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan nama atau NIS...">

                            </div>

                        </div>



                        <!-- KELAS -->

                        <div class="form-group">

                            <label for="kelas">
                                Kelas
                            </label>

                            <div class="select-wrapper">

                                <select
                                    name="kelas"
                                    id="kelas">

                                    <option value="">
                                        Semua Kelas
                                    </option>

                                    @foreach ($kelas as $item)

                                        <option
                                            value="{{ $item }}"
                                            {{ request('kelas') == $item ? 'selected' : '' }}>

                                            {{ $item }}

                                        </option>

                                    @endforeach

                                </select>

                                <i class="fas fa-chevron-down"></i>

                            </div>

                        </div>



                        <!-- FILTER -->

                        <button
                            type="submit"
                            class="filter-button">

                            <i class="fas fa-filter"></i>

                            Filter

                        </button>



                        <!-- RESET -->

                        <a
                            href="{{ route('guru.data-siswa') }}"
                            class="reset-button">

                            <i class="fas fa-rotate-left"></i>

                            Reset

                        </a>

                    </form>

                </div>



                <!-- TABLE -->

                <div class="table-card">

                    <div class="table-header">

                        <div class="table-header-title">

                            <i class="fas fa-users"></i>

                            <span>
                                Daftar Siswa
                            </span>

                        </div>


                        <div class="table-info">

                            Menampilkan
                            {{ $siswas->count() }}
                            data

                        </div>

                    </div>



                    @if ($siswas->count() > 0)

                        <div class="table-wrapper">

                            <table class="student-table">

                                <thead>

                                    <tr>

                                        <th>
                                            No
                                        </th>

                                        <th>
                                            Nama Siswa
                                        </th>

                                        <th>
                                            NIS
                                        </th>

                                        <th>
                                            Kelas
                                        </th>

                                        <th>
                                            No. Absen
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($siswas as $index => $siswa)

                                        <tr>


                                            <!-- NO -->

                                            <td>

                                                {{ $index + 1 }}

                                            </td>



                                            <!-- NAMA -->

                                            <td>

                                                <div class="student-name">

                                                    <div class="student-avatar">

                                                        {{ strtoupper(substr($siswa->name ?? 'S', 0, 1)) }}

                                                    </div>


                                                    <div class="student-name-text">

                                                        <strong>

                                                            {{ $siswa->name }}

                                                        </strong>

                                                        <span>

                                                            Siswa SIPANDAI

                                                        </span>

                                                    </div>

                                                </div>

                                            </td>



                                            <!-- NIS -->

                                            <td>

                                                <span class="nis-value">

                                                    {{ $siswa->nis ?? '-' }}

                                                </span>

                                            </td>



                                            <!-- KELAS -->

                                            <td>

                                                <span class="class-badge">

                                                    {{ $siswa->kelas ?? '-' }}

                                                </span>

                                            </td>



                                            <!-- NO ABSEN -->

                                            <td>

                                                <span class="absen-value">

                                                    {{ $siswa->no_absen ?? '-' }}

                                                </span>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else


                        <!-- EMPTY STATE -->

                        <div class="empty-state">

                            <div class="empty-icon">

                                <i class="fas fa-users-slash"></i>

                            </div>

                            <h3>
                                Data siswa tidak ditemukan
                            </h3>

                            <p>
                                Belum ada siswa yang sesuai dengan pencarian
                                atau filter yang dipilih.
                            </p>

                        </div>

                    @endif

                </div>



                <!-- FOOTER -->

                <div class="footer">

                    SIPANDAI &copy; {{ date('Y') }}

                </div>

            </div>

        </section>

    </main>



    <!-- =====================================================
         JAVASCRIPT
         FUNGSI SIDEBAR MASTER
    ====================================================== -->

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

                if (sidebar.classList.contains("show")) {

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


        const sidebarLinks =
            document.querySelectorAll(
                ".sidebar-menu .menu-item"
            );


        sidebarLinks.forEach(
            function (link) {

                link.addEventListener(
                    "click",
                    function () {

                        if (window.innerWidth <= 900) {

                            closeSidebarMenu();

                        }

                    }
                );

            }
        );

    </script>

</body>

</html>