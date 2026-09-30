<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Ujian - SIPANDAI</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        body.sidebar-open {
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input,
        select {
            font-family: inherit;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

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
            border-right: 1px solid rgba(255,255,255,.09);
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
                    rgba(143,38,53,.28),
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
                    rgba(255,255,255,.08),
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
            height: 88px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom:
                1px solid rgba(255,255,255,.075);
            flex-shrink: 0;
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
            flex-shrink: 0;
            display: block;
            background: transparent;
            border: none;
            border-radius: 0;
            filter:
                drop-shadow(0 5px 12px rgba(0,0,0,.2));
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
            color: rgba(255,255,255,.42);
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
            white-space: nowrap;
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
            transition: .25s ease;
            flex-shrink: 0;
        }

        .close-sidebar:hover {
            background: rgba(143,38,53,.75);
            color: #fff;
            border-color: rgba(255,255,255,.12);
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
                transform .25s ease,
                border-color .25s ease;
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
            color: #fff;
            background: rgba(255,255,255,.065);
            transform: translateX(2px);
        }

        .menu-item:hover i {
            color: #e7aab2;
        }

        .menu-item.active {
            color: #fff;
            background:
                linear-gradient(
                    90deg,
                    rgba(143,38,53,.74),
                    rgba(143,38,53,.37)
                );
            border: 1px solid rgba(255,255,255,.08);
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
            border-radius: 0 4px 4px 0;
            background: #e7aab2;
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
            -webkit-backdrop-filter: blur(12px);
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
            box-shadow: 0 5px 14px rgba(0,0,0,.18);
        }

        .sidebar-profile-info {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-profile-info strong {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
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
            border-color: rgba(255,255,255,.9);
            color: #fff;
        }

        .logout-link i {
            font-size: 11px;
        }


        /* =========================================================
           OVERLAY
        ========================================================= */

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15,15,15,.35);
            opacity: 0;
            visibility: hidden;
            z-index: 1100;
            transition:
                opacity .35s ease,
                visibility .35s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }


        /* =========================================================
           MAIN
        ========================================================= */

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
            width: calc(100% - var(--sidebar-width));
        }


        /* =========================================================
           TOPBAR MASTER
        ========================================================= */

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
            box-shadow: 0 7px 25px rgba(0,0,0,.12);
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

        .page-icon {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 10px;
            background: rgba(255,255,255,.065);
            color: rgba(255,255,255,.82);
            cursor: pointer;
            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                border-color .25s ease;
            flex-shrink: 0;
        }

        .page-icon i {
            font-size: 13px;
        }

        .page-icon:hover {
            background: rgba(143,38,53,.65);
            color: #fff;
            transform: translateY(-1px);
        }

        .topbar-logo {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            text-decoration: none;
            border-radius: 10px;
            transition: transform .25s ease;
        }

        .topbar-logo:hover {
            transform: scale(1.06);
        }

        .topbar-logo img {
            width: 35px;
            height: 35px;
            object-fit: contain;
            display: block;
            background: transparent;
            border: none;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,.18));
        }

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
            background: rgba(255,255,255,.85);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s cubic-bezier(.22,1,.36,1);
        }

        .breadcrumb-root:hover::after {
            transform: scaleX(1);
        }

        .breadcrumb-sep {
            flex-shrink: 0;
            color: rgba(255,255,255,.38);
            font-size: 8px;
            transition: color .25s ease, transform .25s ease;
        }

        .breadcrumb:hover .breadcrumb-sep {
            color: rgba(255,255,255,.7);
            transform: translateX(1px);
        }

        .breadcrumb-link {
            position: relative;
            padding: 5px 1px;
            color: rgba(255,255,255,.6);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            text-decoration: none;
            white-space: nowrap;
            transition: color .25s ease;
        }

        .breadcrumb-link:hover {
            color: #fff;
        }

        .breadcrumb-current {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-width: 0;
            padding: 5px 11px 5px 9px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 999px;
            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,.16),
                    rgba(255,255,255,.06)
                );
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            text-decoration: none;
            box-shadow: inset 0 1px rgba(255,255,255,.08);
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
            box-shadow: 0 0 8px rgba(255,255,255,.6);
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
                    rgba(255,255,255,.26),
                    rgba(255,255,255,.11)
                );
            border-color: rgba(255,255,255,.32);
            transform: translateY(-1px);
            box-shadow:
                0 6px 16px rgba(0,0,0,.25),
                inset 0 1px rgba(255,255,255,.1);
        }

        .breadcrumb-root:focus-visible,
        .breadcrumb-link:focus-visible,
        .breadcrumb-current:focus-visible,
        .topbar-logo:focus-visible {
            outline: 2px solid rgba(255,255,255,.8);
            outline-offset: 3px;
        }

        .page-title {
            color: rgba(255,255,255,.48);
            font-size: 8px;
            line-height: 1;
            font-weight: 600;
            letter-spacing: 1.4px;
            white-space: nowrap;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
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
            font-size: 13px;
            cursor: pointer;
            transition:
                background .25s ease,
                color .25s ease,
                border-color .25s ease;
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
            box-shadow: 0 5px 14px rgba(0,0,0,.18);
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
            color: rgba(255,255,255,.42);
            font-size: 9px;
            font-weight: 500;
        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .main-content {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            padding: 104px 34px 45px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 26px;
        }

        .heading-left {
            min-width: 0;
        }

        .eyebrow {
            margin-bottom: 8px;
            color: var(--red);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .page-heading h1 {
            color: var(--dark);
            font-size: 27px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .page-heading p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
            font-weight: 500;
        }

        .back-btn {
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 14px;
            flex-shrink: 0;
            border: 1px solid #dededb;
            border-radius: 9px;
            background: rgba(255,255,255,.72);
            color: #666;
            font-size: 10px;
            font-weight: 700;
            transition: .25s ease;
        }

        .back-btn i {
            font-size: 10px;
        }

        .back-btn:hover {
            border-color: var(--red-soft);
            background: #fff;
            color: var(--red);
            transform: translateY(-1px);
        }


        /* =========================================================
           FORM CARD
        ========================================================= */

        .form-card {
            background: rgba(255,255,255,.94);
            border: 1px solid #e4e4e1;
            border-radius: 15px;
            box-shadow: 0 14px 35px rgba(40,40,40,.055);
            overflow: hidden;
        }

        .form-card-header {
            padding: 21px 24px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid var(--border-light);
        }

        .form-title {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .form-title-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--red-light);
            color: var(--red);
            font-size: 13px;
        }

        .form-title-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .form-title-text strong {
            color: var(--dark);
            font-size: 13px;
            font-weight: 800;
        }

        .form-title-text span {
            color: #a0a0a0;
            font-size: 8px;
            font-weight: 500;
        }

        .status-draft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 9px;
            border-radius: 7px;
            background: #f5f5f3;
            color: #888;
            font-size: 8px;
            font-weight: 700;
        }

        .status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #aaa;
        }

        .form-body {
            padding: 24px;
        }

        .info-alert {
            margin-bottom: 23px;
            padding: 11px 13px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border: 1px solid #eee2e3;
            border-radius: 9px;
            background: #fcf7f7;
        }

        .info-alert i {
            margin-top: 1px;
            color: var(--red);
            font-size: 11px;
        }

        .info-alert span {
            color: #777;
            font-size: 9px;
            line-height: 1.5;
            font-weight: 500;
        }


        /* =========================================================
           FORM GRID
        ========================================================= */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 19px 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
            min-width: 0;
        }

        .form-group.span-2 {
            grid-column: span 2;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 3px;
            color: #555;
            font-size: 9px;
            font-weight: 800;
        }

        .required {
            color: var(--red);
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 13px;
            transform: translateY(-50%);
            color: #c3aeb1;
            font-size: 11px;
            pointer-events: none;
            transition: color .2s ease;
        }

        .input-wrap:focus-within .input-icon {
            color: var(--red);
        }

        .form-input,
        .form-select {
            width: 100%;
            height: 43px;
            padding: 0 12px 0 35px;
            border: 1.5px solid #ebe3e4;
            border-radius: 13px;
            outline: none;
            background: #fcfafa;
            color: #454545;
            font-size: 10px;
            font-weight: 600;
            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                transform .2s ease;
        }

        .form-input::placeholder {
            color: #bcb3b4;
            font-weight: 500;
        }

        .form-input:hover,
        .form-select:hover {
            border-color: #ddc9cc;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--red);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(143,38,53,.07);
        }

        .form-select {
            cursor: pointer;
        }

        .field-hint {
            color: #aaa;
            font-size: 8px;
            line-height: 1.4;
        }


        /* =========================================================
           PERKIRAAN JAM SELESAI
        ========================================================= */

        .finish-preview {
            margin-top: 22px;
            width: fit-content;
            max-width: 100%;
            min-height: 50px;
            padding: 8px 8px 8px 10px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1.5px dashed #dfc6ca;
            border-radius: 16px;
            background:
                linear-gradient(
                    135deg,
                    #fdf8f8 0%,
                    #f9f0f1 100%
                );
            transition:
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .finish-preview:hover {
            border-color: #cfa5ab;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(143,38,53,.07);
        }

        .finish-preview-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .finish-icon {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fff;
            color: var(--red);
            font-size: 12px;
            box-shadow: 0 4px 10px rgba(143,38,53,.08);
        }

        .finish-text {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .finish-text strong {
            color: #555;
            font-size: 9px;
            line-height: 1.2;
            font-weight: 800;
        }

        .finish-text span {
            color: #aaa;
            font-size: 7.5px;
            line-height: 1.3;
            font-weight: 500;
        }

        .finish-result {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            padding: 8px 12px;
            border-radius: 11px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(143,38,53,.07);
        }

        .finish-result-label {
            color: #b09a9d;
            font-size: 7px;
            font-weight: 700;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        #finishTime {
            display: block;
            min-width: 50px;
            color: var(--red);
            font-size: 16px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -.5px;
            text-align: right;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .form-actions {
            margin-top: 24px;
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            border-top: 1px solid var(--border-light);
        }

        .btn {
            height: 38px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: 800;
            cursor: pointer;
            transition: .25s ease;
        }

        .btn-cancel {
            border: 1px solid #dededb;
            background: #fff;
            color: #777;
        }

        .btn-cancel:hover {
            border-color: #ccc;
            color: #555;
            background: #fafafa;
        }

        .btn-primary {
            border: 1px solid var(--red);
            background:
                linear-gradient(
                    135deg,
                    #9a2c3b,
                    #7f202f
                );
            color: #fff;
            box-shadow: 0 6px 15px rgba(143,38,53,.16);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(143,38,53,.22);
        }

        .btn i {
            font-size: 9px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .page-footer {
            padding: 22px 0 4px;
            text-align: center;
            color: #aaa;
            font-size: 8px;
            font-weight: 500;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1000px) {
            .form-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .form-group.span-2 {
                grid-column: 1 / -1;
            }
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
                padding: 94px 22px 30px;
            }
        }

        @media (max-width: 700px) {
            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-card-header {
                padding: 19px;
            }

            .form-body {
                padding: 19px;
            }

            .finish-preview {
                width: 100%;
                justify-content: space-between;
            }

            .topbar {
                height: 64px;
                padding: 0 15px;
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
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 270px;
            }

            .topbar {
                padding: 0 20px;
            }

            .main-content {
                padding: 90px 15px 30px;
            }

            .page-heading h1 {
                font-size: 23px;
            }
        }

        @media (max-width: 600px) {
            .crumb-mid {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .finish-text span {
                display: none;
            }

            .finish-result {
                gap: 6px;
            }

            .finish-result-label {
                font-size: 6px;
            }

            #finishTime {
                font-size: 15px;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 450px) {
            .topbar {
                padding: 0 14px;
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
        }

        @media (max-width: 420px) {
            .sidebar {
                width: 280px;
            }

            .topbar-logo {
                display: none;
            }

            .main-content {
                padding-left: 12px;
                padding-right: 12px;
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

    <!-- =========================================================
         SIDEBAR MASTER
    ========================================================= -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img
                    src="{{ asset('images/logo.jpg') }}"
                    alt="Logo SMKN 2 Kota Kediri"
                    class="sidebar-logo">

                <div class="sidebar-brand-text">
                    <strong>SIPANDAI</strong>
                    <span>SMKN 2 KOTA KEDIRI</span>
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


    <!-- =========================================================
         MAIN
    ========================================================= -->

    <div class="main">


        <!-- =====================================================
             TOPBAR MASTER
        ===================================================== -->

        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="page-icon"
                    id="navbarHomeBtn"
                    aria-label="Buka menu">

                    <i class="fa-solid fa-bars"></i>

                </button>


                <a
                    href="{{ route('guru.dashboard') }}"
                    class="topbar-logo"
                    aria-label="Ke Dashboard">

                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo SMKN 2 Kota Kediri">

                </a>


                <div class="topbar-page">

                    <nav
                        class="breadcrumb"
                        aria-label="Breadcrumb">

                        <a
                            href="{{ route('guru.dashboard') }}"
                            class="breadcrumb-root">

                            SIPANDAI

                        </a>


                        <span class="crumb">

                            <i
                                class="fa-solid fa-chevron-right breadcrumb-sep"
                                aria-hidden="true">
                            </i>


                            <a
                                href="{{ route('guru.exams.index') }}"
                                class="breadcrumb-link">

                                KELOLA UJIAN

                            </a>


                            <i
                                class="fa-solid fa-chevron-right breadcrumb-sep"
                                aria-hidden="true">
                            </i>


                            <a
                                href="{{ route('guru.exams.create') }}"
                                class="breadcrumb-current"
                                aria-current="page">

                                <span>
                                    BUAT UJIAN
                                </span>

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


        <!-- =====================================================
             CONTENT
        ===================================================== -->

        <main class="main-content">


            <!-- PAGE HEADING -->

            <section class="page-heading">

                <div class="heading-left">

                    <div class="eyebrow">
                        Kelola Ujian
                    </div>

                    <h1>
                        Buat Ujian
                    </h1>

                    <p>
                        Buat dan atur ujian baru untuk siswa SIPANDAI.
                    </p>

                </div>


                <a
                    href="{{ route('guru.exams.index') }}"
                    class="back-btn">

                    <i class="fa-solid fa-arrow-left"></i>

                    <span>
                        Kembali
                    </span>

                </a>

            </section>


            <!-- FORM CARD -->

            <section class="form-card">


                <!-- CARD HEADER -->

                <div class="form-card-header">

                    <div class="form-title">

                        <div class="form-title-icon">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <div class="form-title-text">

                            <strong>
                                Informasi Ujian
                            </strong>

                            <span>
                                Lengkapi informasi sebelum menyimpan ujian.
                            </span>

                        </div>

                    </div>


                    <div class="status-draft">

                        <span class="status-dot"></span>

                        Draft

                    </div>

                </div>


                <!-- FORM BODY -->

                <div class="form-body">


                    <!-- INFO -->

                    <div class="info-alert">

                        <i class="fa-solid fa-circle-info"></i>

                        <span>

                            Ujian yang disimpan akan berstatus
                            <strong>Draft</strong>
                            sampai siap diberikan kepada siswa.

                        </span>

                    </div>


                    <!-- FORM -->

                    <form
                        action="{{ route('guru.exams.store') }}"
                        method="POST">

                        @csrf


                        <div class="form-grid">


                            <!-- NAMA UJIAN -->

                            <div class="form-group span-2">

                                <label
                                    for="nama_ujian"
                                    class="form-label">

                                    Nama Ujian

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-solid fa-file-pen input-icon"></i>

                                    <input
                                        type="text"
                                        id="nama_ujian"
                                        name="nama_ujian"
                                        class="form-input"
                                        placeholder="Contoh: Penilaian Tengah Semester"
                                        value="{{ old('nama_ujian') }}"
                                        required>

                                </div>

                            </div>


                            <!-- MATA PELAJARAN -->

                            <div class="form-group">

                                <label
                                    for="mata_pelajaran"
                                    class="form-label">

                                    Mata Pelajaran

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-solid fa-book-open input-icon"></i>

                                    <input
                                        type="text"
                                        id="mata_pelajaran"
                                        name="mata_pelajaran"
                                        class="form-input"
                                        placeholder="Contoh: Informatika"
                                        value="{{ old('mata_pelajaran') }}"
                                        required>

                                </div>

                            </div>


                            <!-- KELAS -->

                            <div class="form-group">

                                <label
                                    for="kelas"
                                    class="form-label">

                                    Kelas

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-solid fa-users-rectangle input-icon"></i>

                                    <input
                                        type="text"
                                        id="kelas"
                                        name="kelas"
                                        class="form-input"
                                        placeholder="Contoh: XI TKJ 1"
                                        value="{{ old('kelas') }}"
                                        required>

                                </div>

                            </div>


                            <!-- TANGGAL -->

                            <div class="form-group">

                                <label
                                    for="tanggal_ujian"
                                    class="form-label">

                                    Tanggal Ujian

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-regular fa-calendar input-icon"></i>

                                    <input
                                        type="date"
                                        id="tanggal_ujian"
                                        name="tanggal_ujian"
                                        class="form-input"
                                        value="{{ old('tanggal_ujian') }}"
                                        required>

                                </div>

                            </div>


                            <!-- JAM MULAI -->

                            <div class="form-group">

                                <label
                                    for="jam_mulai"
                                    class="form-label">

                                    Jam Mulai

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-regular fa-clock input-icon"></i>

                                    <input
                                        type="time"
                                        id="jam_mulai"
                                        name="jam_mulai"
                                        class="form-input"
                                        value="{{ old('jam_mulai') }}"
                                        required>

                                </div>

                            </div>


                            <!-- DURASI -->

                            <div class="form-group">

                                <label
                                    for="durasi"
                                    class="form-label">

                                    Durasi

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-solid fa-hourglass-half input-icon"></i>

                                    <input
                                        type="number"
                                        id="durasi"
                                        name="durasi"
                                        class="form-input"
                                        placeholder="Contoh: 90"
                                        min="1"
                                        value="{{ old('durasi') }}"
                                        required>

                                </div>


                                <span class="field-hint">
                                    Masukkan durasi dalam menit.
                                </span>

                            </div>


                            <!-- KODE UJIAN -->

                            <div class="form-group">

                                <label
                                    for="kode_ujian"
                                    class="form-label">

                                    Kode Ujian

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="input-wrap">

                                    <i class="fa-solid fa-key input-icon"></i>

                                    <input
                                        type="text"
                                        id="kode_ujian"
                                        name="kode_ujian"
                                        class="form-input"
                                        placeholder="Contoh: INF2026"
                                        value="{{ old('kode_ujian') }}"
                                        required>

                                </div>


                                <span class="field-hint">
                                    Kode digunakan siswa untuk masuk ke ujian.
                                </span>

                            </div>

                        </div>


                        <!-- =================================================
                             PERKIRAAN JAM SELESAI
                        ================================================== -->

                        <div class="finish-preview">

                            <div class="finish-preview-left">

                                <div class="finish-icon">

                                    <i class="fa-regular fa-clock"></i>

                                </div>


                                <div class="finish-text">

                                    <strong>
                                        Perkiraan Jam Selesai
                                    </strong>

                                    <span>
                                        Otomatis berdasarkan jam mulai dan durasi ujian
                                    </span>

                                </div>

                            </div>


                            <div class="finish-result">

                                <span class="finish-result-label">
                                    Selesai
                                </span>

                                <span id="finishTime">
                                    — : —
                                </span>

                            </div>

                        </div>


                        <!-- ACTION -->

                        <div class="form-actions">

                            <a
                                href="{{ route('guru.exams.index') }}"
                                class="btn btn-cancel">

                                <i class="fa-solid fa-xmark"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="fa-solid fa-check"></i>

                                Simpan Ujian

                            </button>

                        </div>

                    </form>

                </div>

            </section>


            <!-- FOOTER -->

            <footer class="page-footer">
                SIPANDAI &copy; {{ date('Y') }}
            </footer>

        </main>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->

    <script>

        /* =====================================================
           SIDEBAR MASTER
        ===================================================== */

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


        /* =====================================================
           PERKIRAAN JAM SELESAI
        ===================================================== */

        const jamMulai =
            document.getElementById(
                "jam_mulai"
            );

        const durasi =
            document.getElementById(
                "durasi"
            );

        const finishTime =
            document.getElementById(
                "finishTime"
            );


        function hitungJamSelesai() {

            if (
                !jamMulai.value ||
                !durasi.value
            ) {

                finishTime.textContent =
                    "— : —";

                return;

            }


            const [jam, menit] =
                jamMulai.value
                    .split(":")
                    .map(Number);


            const totalMenit =
                (jam * 60) +
                menit +
                Number(durasi.value);


            const jamSelesai =
                Math.floor(
                    totalMenit / 60
                ) % 24;


            const menitSelesai =
                totalMenit % 60;


            finishTime.textContent =
                String(jamSelesai)
                    .padStart(2, "0") +
                ":" +
                String(menitSelesai)
                    .padStart(2, "0");

        }


        jamMulai.addEventListener(
            "change",
            hitungJamSelesai
        );


        durasi.addEventListener(
            "input",
            hitungJamSelesai
        );


        hitungJamSelesai();

    </script>

</body>

</html>