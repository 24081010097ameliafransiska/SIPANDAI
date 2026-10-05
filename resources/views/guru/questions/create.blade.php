<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Soal - SIPANDAI</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

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
            --green-dark: #4b865c;
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
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        textarea {
            font-family: inherit;
        }


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
                1px solid rgba(255, 255, 255, .08);

            box-shadow:
                0 7px 25px rgba(0, 0, 0, .12);

            z-index: 1050;

            transition:
                left .45s cubic-bezier(.22, 1, .36, 1),
                width .45s cubic-bezier(.22, 1, .36, 1);
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

            border:
                1px solid rgba(255, 255, 255, .12);

            border-radius: 10px;

            background:
                rgba(255, 255, 255, .065);

            color:
                rgba(255, 255, 255, .82);

            cursor: pointer;

            transition: .25s ease;
        }

        .navbar-home-btn:hover {
            background: var(--red);

            border-color:
                rgba(255, 255, 255, .15);

            color: #fff;

            transform:
                translateY(-1px);
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
                drop-shadow(0 4px 10px rgba(0, 0, 0, .18));
        }

        .navbar-title {
            display: flex;
            flex-direction: column;
            gap: 4px;

            min-width: 0;
        }

        .navbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;

            min-width: 0;

            white-space: nowrap;
            overflow: hidden;
        }

        .breadcrumb-brand {
            color: #fff;

            font-size: 14px;
            line-height: 1;

            font-weight: 800;
            letter-spacing: -.2px;

            flex-shrink: 0;
        }

        .breadcrumb-item {
            color:
                rgba(255, 255, 255, .48);

            font-size: 10px;
            line-height: 1;

            font-weight: 600;

            flex-shrink: 0;
        }

        .breadcrumb-current {
            color:
                rgba(255, 255, 255, .9);

            font-size: 10px;
            line-height: 1;

            font-weight: 700;

            flex-shrink: 0;
        }

        .breadcrumb-arrow {
            color:
                rgba(255, 255, 255, .25);

            font-size: 7px;

            flex-shrink: 0;
        }

        .navbar-title-sub {
            color:
                rgba(255, 255, 255, .48);

            font-size: 8px;
            line-height: 1;

            font-weight: 600;

            letter-spacing: 1.4px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 17px;

            flex-shrink: 0;
        }

        .notification {
            width: 37px;
            height: 37px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255, 255, 255, .08);

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .055);

            color:
                rgba(255, 255, 255, .72);

            font-size: 13px;

            cursor: pointer;

            transition: .25s ease;
        }

        .notification:hover {
            background:
                rgba(143, 38, 53, .65);

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
            color:
                rgba(255, 255, 255, .42);

            font-size: 9px;
            font-weight: 500;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

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

        .sidebar-header {
            position: relative;

            height: 88px;

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
            color:
                rgba(255, 255, 255, .42);

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
                1px solid rgba(255, 255, 255, .08);

            border-radius: 9px;

            background:
                rgba(255, 255, 255, .055);

            color:
                rgba(255, 255, 255, .68);

            cursor: pointer;

            transition:
                .25s ease,
                transform .3s ease;
        }

        .close-sidebar:hover {
            background:
                rgba(143, 38, 53, .75);

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
                rgba(255, 255, 255, .12);

            border-radius: 10px;
        }

        .sidebar-label {
            margin: 0 10px 12px;

            color:
                rgba(255, 255, 255, .38);

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
                rgba(255, 255, 255, .67);

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

        .sidebar-profile {
            margin-top: auto;

            padding: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, .065),
                    rgba(255, 255, 255, .025)
                );

            backdrop-filter: blur(12px);

            border:
                1px solid rgba(255, 255, 255, .08);

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
                0 5px 15px rgba(0, 0, 0, .18);
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
                rgba(255, 255, 255, .42);

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
                1px solid rgba(143, 38, 53, .32);

            border-radius: 8px;

            background:
                rgba(143, 38, 53, .12);

            color: #e7aab2;

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition: .25s ease;
        }

        .logout-link:hover {
            background:
                rgba(143, 38, 53, .78);

            border-color:
                rgba(143, 38, 53, .9);

            color: #fff;
        }

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


        /* =========================================
           MAIN
        ========================================= */

        .main {
            width: 100%;
            min-height: 100vh;

            margin: 0;
            padding: 0;

            overflow: hidden;

            transition:
                margin-left .45s cubic-bezier(.22, 1, .36, 1),
                width .45s cubic-bezier(.22, 1, .36, 1);
        }

        body.sidebar-open .main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }

        .main-content {
            min-height: 100vh;

            padding:
                104px
                4.5vw
                40px;

            background:
                linear-gradient(
                    180deg,
                    #f2f2f2 0%,
                    #eeeeec 100%
                );
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            color: #292929;

            font-size: 29px;
            line-height: 1.2;

            font-weight: 800;

            letter-spacing: -.7px;

            margin-bottom: 8px;
        }

        .page-header p {
            color: #777;

            font-size: 13px;
            line-height: 1.7;
        }


        /* =========================================
           ALERT
        ========================================= */

        .alert {
            width: 100%;

            padding: 13px 15px;

            margin-bottom: 18px;

            border-radius: 10px;

            font-size: 12px;
            line-height: 1.6;
        }

        .alert-danger {
            background: #f9e6e8;

            border:
                1px solid #e7bfc4;

            color: #8f2635;
        }

        .alert-info {
            background: #f4f1eb;

            border:
                1px solid #ddd5c9;

            color: #625b51;
        }

        .alert ul {
            margin: 7px 0 0 18px;
        }


        /* =========================================
           FORM CARD
        ========================================= */

        .form-card {
            width: 100%;

            background: #fff;

            border:
                1px solid var(--border-light);

            border-radius: 15px;

            box-shadow:
                0 8px 30px rgba(35, 35, 35, .055);

            overflow: hidden;
        }

        .form-card-header {
            padding: 20px 24px;

            border-bottom:
                1px solid #eeeeeb;

            background: #fff;
        }

        .form-card-header h2 {
            color: #303030;

            font-size: 15px;
            font-weight: 800;
        }

        .form-card-body {
            padding: 25px 24px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color: #3d3d3d;

            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: var(--red);
        }

        .form-control {
            width: 100%;
            min-height: 45px;

            padding: 11px 13px;

            border:
                1px solid #d9d9d7;

            border-radius: 9px;

            background: #fff;

            color: #383838;

            font-size: 12px;

            outline: none;

            transition: .2s ease;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus {
            border-color: var(--red);

            box-shadow:
                0 0 0 3px rgba(143, 38, 53, .08);
        }

        textarea.form-control {
            min-height: 115px;

            resize: vertical;

            line-height: 1.6;
        }


        /* =========================================
           PILIHAN JAWABAN
           HANYA BAGIAN INI YANG DIPERSEMPIT
        ========================================= */

        .option-group {
            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .option-item {
            display: grid;

            grid-template-columns: 70px minmax(0, 1fr);

            align-items: center;

            gap: 8px;
        }

        .option-label {
            margin: 0;

            color: #555;

            font-size: 10px;
            font-weight: 700;

            white-space: nowrap;
        }

        .option-item .form-control {
            min-height: 40px;
        }


        /* =========================================
           JAWABAN BENAR
           KOTAK SEMPURNA
        ========================================= */

        .answer-section {
            margin-top: 24px;

            padding-top: 21px;

            border-top:
                1px solid #eeeeeb;
        }

        .answer-options {
            display: flex;
            align-items: center;

            gap: 9px;
        }

        .answer-option {
            position: relative;
        }

        .answer-option input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .answer-option label {
            width: 42px;
            height: 42px;

            padding: 0;

            border:
                1px solid #d9d9d7;

            border-radius: 8px;

            background: #fff;

            color: #666;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            font-size: 11px;
            font-weight: 700;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .answer-option label:hover {
            border-color: var(--red);

            color: var(--red);

            transform:
                translateY(-1px);
        }

        .answer-option input:checked + label {
            background: var(--red-light);

            border-color: var(--red);

            color: var(--red);
        }


        .form-actions {
            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid #eeeeeb;

            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 10px;
        }

        .btn {
            min-height: 40px;

            padding: 0 17px;

            border-radius: 8px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-secondary {
            border:
                1px solid #b3262d;

            background: #b3262d;

            color: #fff;
        }

        .btn-secondary:hover {
            border-color: #911d24;

            background: #911d24;

            color: #fff;
        }

        .btn-primary {
            border:
                1px solid #5b9b6d !important;

            background:
                #5b9b6d !important;

            color: #fff !important;

            opacity: 1 !important;

            filter: none !important;

            box-shadow:
                0 5px 12px rgba(91, 155, 109, .18);
        }

        .btn-primary:hover {
            border-color:
                #4d895e !important;

            background:
                #4d895e !important;

            color: #fff !important;

            opacity: 1 !important;
        }

        .btn-primary:focus,
        .btn-primary:focus-visible {
            border-color:
                #5b9b6d !important;

            background:
                #5b9b6d !important;

            color: #fff !important;

            opacity: 1 !important;

            outline: none !important;
        }

        .btn-primary:active {
            border-color:
                #427950 !important;

            background:
                #427950 !important;

            color: #fff !important;
        }

        .btn-primary:disabled {
            border-color:
                #5b9b6d !important;

            background:
                #5b9b6d !important;

            color: #fff !important;

            opacity: 1 !important;
        }



        .footer {
            padding: 25px 0 5px;

            color: #999;

            text-align: center;

            font-size: 10px;
        }


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
                padding: 0 20px;
            }

            .navbar-logo {
                width: 32px;
                height: 32px;
            }

            .breadcrumb-brand {
                font-size: 13px;
            }

            .breadcrumb-item,
            .breadcrumb-current {
                font-size: 9px;
            }

            .breadcrumb-arrow {
                font-size: 6px;
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

            .page-header h1 {
                font-size: 21px;
            }

            .form-card-header {
                padding: 18px;
            }

            .form-card-body {
                padding: 18px;
            }

            .choice-row {
                grid-template-columns: 75px 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 520px) {

            .navbar-breadcrumb {
                gap: 5px;
            }

            .breadcrumb-item:nth-of-type(1),
            .breadcrumb-item:nth-of-type(2) {
                display: none;
            }

            .breadcrumb-arrow:nth-of-type(2),
            .breadcrumb-arrow:nth-of-type(3) {
                display: none;
            }

            .option-item {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .option-label {
                margin-bottom: 0;
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
                padding: 0 14px;
            }

            .main-content {
                padding-left: 12px;
                padding-right: 12px;
            }

            .page-header h1 {
                font-size: 20px;
            }

            .choice-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="sidebar-logo"
                >

                <div class="sidebar-brand-text">
                    <strong>SIPANDAI</strong>
                    <span>SMKN 2 KOTA KEDIRI</span>
                </div>

            </div>

            <button
                type="button"
                class="close-sidebar"
                id="closeSidebar"
                aria-label="Tutup menu"
            >
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
                    class="menu-item"
                >
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a
                    href="{{ route('guru.exams.index') }}"
                    class="menu-item active"
                >
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Kelola Ujian</span>
                </a>

                <a
                    href="{{ route('guru.results.index') }}"
                    class="menu-item"
                >
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Hasil Ujian</span>
                </a>

                <a
                    href="{{ route('guru.data-siswa') }}"
                    class="menu-item"
                >
                    <i class="fa-solid fa-users"></i>
                    <span>Data Siswa</span>
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

                        <span>Akun Guru</span>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    style="margin: 0;"
                >
                    @csrf

                    <button
                        type="submit"
                        class="logout-link"
                    >
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </button>

                </form>

            </div>

        </div>

    </aside>


    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    <!-- =========================================
         TOPBAR
    ========================================= -->

    <header class="topbar">

        <div class="topbar-left">

            <button
                type="button"
                class="navbar-home-btn"
                id="navbarHomeBtn"
                aria-label="Buka menu"
            >
                <i class="fa-solid fa-bars"></i>
            </button>


            <img
                src="{{ asset('images/logo.jpg') }}"
                alt="Logo SMKN 2 Kota Kediri"
                class="navbar-logo"
            >


            <div class="navbar-title">

                <div class="navbar-breadcrumb">

                    <span class="breadcrumb-brand">
                        SIPANDAI
                    </span>

                    <i class="fa-solid fa-chevron-right breadcrumb-arrow"></i>

                    <span class="breadcrumb-item">
                        KELOLA UJIAN
                    </span>

                    <i class="fa-solid fa-chevron-right breadcrumb-arrow"></i>

                    <span class="breadcrumb-item">
                        BUAT UJIAN
                    </span>

                    <i class="fa-solid fa-chevron-right breadcrumb-arrow"></i>

                    <span class="breadcrumb-item">
                        DETAIL UJIAN
                    </span>

                    <i class="fa-solid fa-chevron-right breadcrumb-arrow"></i>

                    <span class="breadcrumb-current">
                        TAMBAH SOAL
                    </span>

                </div>


                <span class="navbar-title-sub">
                    SISTEM UJIAN DIGITAL
                </span>

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


    <!-- =========================================
         MAIN
    ========================================= -->

    <main class="main">

        <div class="main-content">

            <div class="page-header">

                <h1>
                    Tambah Soal
                </h1>

                <p>
                    Tambahkan soal dan pilihan jawaban untuk ujian
                    {{ $exam->nama_ujian }}.
                </p>

            </div>


            <!-- ERROR -->
            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Terdapat kesalahan:
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- INFO -->

            <div class="alert alert-info">

                Pastikan pertanyaan, pilihan jawaban, dan jawaban benar
                sudah sesuai sebelum menyimpan soal.

            </div>


            <!-- FORM CARD -->

            <div class="form-card">

                <div class="form-card-header">

                    <h2>
                        Detail Soal
                    </h2>

                </div>


                <div class="form-card-body">

                    <form
                        action="{{ route('guru.questions.store', $exam) }}"
                        method="POST"
                    >

                        @csrf


                        <!-- PERTANYAAN -->

                        <div class="form-group">

                            <label
                                for="pertanyaan"
                                class="form-label"
                            >
                                Pertanyaan
                                <span class="required">*</span>
                            </label>


                            <textarea
                                name="pertanyaan"
                                id="pertanyaan"
                                class="form-control"
                                placeholder="Tuliskan pertanyaan..."
                                required
                            >{{ old('pertanyaan') }}</textarea>

                        </div>


                        <!-- PILIHAN JAWABAN -->

                        <div class="form-group">

                            <label class="form-label">

                                Pilihan Jawaban
                                <span class="required">*</span>

                            </label>


                            <div class="option-group">

                                <div class="option-item">

                                    <label
                                        for="pilihan_a"
                                        class="option-label"
                                    >
                                        Pilihan A
                                    </label>

                                    <input
                                        type="text"
                                        name="pilihan_a"
                                        id="pilihan_a"
                                        class="form-control"
                                        value="{{ old('pilihan_a') }}"
                                        placeholder="Masukkan pilihan A"
                                        required
                                    >

                                </div>


                                <div class="option-item">

                                    <label
                                        for="pilihan_b"
                                        class="option-label"
                                    >
                                        Pilihan B
                                    </label>

                                    <input
                                        type="text"
                                        name="pilihan_b"
                                        id="pilihan_b"
                                        class="form-control"
                                        value="{{ old('pilihan_b') }}"
                                        placeholder="Masukkan pilihan B"
                                        required
                                    >

                                </div>


                                <div class="option-item">

                                    <label
                                        for="pilihan_c"
                                        class="option-label"
                                    >
                                        Pilihan C
                                    </label>

                                    <input
                                        type="text"
                                        name="pilihan_c"
                                        id="pilihan_c"
                                        class="form-control"
                                        value="{{ old('pilihan_c') }}"
                                        placeholder="Masukkan pilihan C"
                                        required
                                    >

                                </div>


                                <div class="option-item">

                                    <label
                                        for="pilihan_d"
                                        class="option-label"
                                    >
                                        Pilihan D
                                    </label>

                                    <input
                                        type="text"
                                        name="pilihan_d"
                                        id="pilihan_d"
                                        class="form-control"
                                        value="{{ old('pilihan_d') }}"
                                        placeholder="Masukkan pilihan D"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        <!-- JAWABAN BENAR -->

                        <div class="answer-section">

                            <label class="form-label">

                                Jawaban Benar
                                <span class="required">*</span>

                            </label>


                            <div class="answer-options">

                                <div class="answer-option">

                                    <input
                                        type="radio"
                                        name="jawaban_benar"
                                        id="jawaban_a"
                                        value="A"
                                        {{ old('jawaban_benar') == 'A' ? 'checked' : '' }}
                                        required
                                    >

                                    <label for="jawaban_a">
                                        A
                                    </label>

                                </div>


                                <div class="answer-option">

                                    <input
                                        type="radio"
                                        name="jawaban_benar"
                                        id="jawaban_b"
                                        value="B"
                                        {{ old('jawaban_benar') == 'B' ? 'checked' : '' }}
                                    >

                                    <label for="jawaban_b">
                                        B
                                    </label>

                                </div>


                                <div class="answer-option">

                                    <input
                                        type="radio"
                                        name="jawaban_benar"
                                        id="jawaban_c"
                                        value="C"
                                        {{ old('jawaban_benar') == 'C' ? 'checked' : '' }}
                                    >

                                    <label for="jawaban_c">
                                        C
                                    </label>

                                </div>


                                <div class="answer-option">

                                    <input
                                        type="radio"
                                        name="jawaban_benar"
                                        id="jawaban_d"
                                        value="D"
                                        {{ old('jawaban_benar') == 'D' ? 'checked' : '' }}
                                    >

                                    <label for="jawaban_d">
                                        D
                                    </label>

                                </div>

                            </div>

                        </div>


                        <!-- ACTION -->

                        <div class="form-actions">

                            <a
                                href="{{ route('guru.exams.show', $exam) }}"
                                class="btn btn-secondary"
                            >
                                Batal
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-save"></i>
                                Simpan Soal
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            <!-- FOOTER -->

            <div class="footer">
                SIPANDAI © {{ date('Y') }}
            </div>

        </div>

    </main>


    <!-- =========================================
         JAVASCRIPT SIDEBAR
    ========================================= -->

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


        const sidebarLinks =
            document.querySelectorAll(
                ".sidebar-menu .menu-item"
            );


        sidebarLinks.forEach(
            function (link) {

                link.addEventListener(
                    "click",
                    function () {

                        if (
                            window.innerWidth <= 900
                        ) {

                            closeSidebarMenu();

                        }

                    }
                );

            }
        );

    </script>

</body>

</html>