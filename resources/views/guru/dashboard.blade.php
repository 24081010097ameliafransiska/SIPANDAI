<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Guru - SIPANDAI</title>

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

        :root {
            --red: #8f2635;
            --red-dark: #741c29;
            --red-light: #f7e9eb;
            --dark: #292929;
            --text: #383838;
            --muted: #777;
            --bg: #e9e9e9;
            --white: #fff;
            --mint: #4fae7c;
            --amber: #d99a3d;
            --sidebar-width: 245px;
            --hero-image: url('{{ asset('images/gerbang2.png') }}');
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
            background: var(--bg);
            color: var(--text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
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
                    rgba(48,27,32,.97),
                    rgba(29,27,29,.97)
                );

            backdrop-filter: blur(24px) saturate(135%);
            -webkit-backdrop-filter: blur(24px) saturate(135%);

            border-right: 1px solid rgba(255,255,255,.09);

            z-index: 1200;

            transform: translateX(calc(-100% - 2px));

            transition:
                transform .45s cubic-bezier(.22,1,.36,1),
                box-shadow .45s ease;

            overflow: hidden;

            box-shadow:
                inset -1px 0 rgba(255,255,255,.025);
        }

        .sidebar::before {
            content: "";

            position: absolute;
            top: -150px;
            left: -120px;

            width: 350px;
            height: 350px;

            background:
                radial-gradient(
                    circle,
                    rgba(143,38,53,.25),
                    rgba(143,38,53,.10) 35%,
                    transparent 70%
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
                20px 0 55px rgba(0,0,0,.24),
                inset -1px 0 rgba(255,255,255,.04);
        }

        .sidebar-header {
            position: relative;
            z-index: 2;

            height: 88px;
            min-height: 88px;

            display: flex;
            align-items: center;

            padding: 0 22px;

            border-bottom: 1px solid rgba(255,255,255,.08);
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

            border-radius: 0;
            background: transparent;
            border: none;

            filter:
                drop-shadow(0 4px 10px rgba(0,0,0,.18));
        }

        .sidebar-brand-text {
            line-height: 1.1;
        }

        .sidebar-brand-text strong {
            display: block;

            font-size: 15px;
            font-weight: 800;

            color: #fff;

            letter-spacing: -.3px;
        }

        .sidebar-brand-text span {
            display: block;

            margin-top: 4px;

            font-size: 9px;
            font-weight: 600;

            color: rgba(255,255,255,.42);

            letter-spacing: 1px;
        }

        .close-sidebar {
            position: absolute;

            top: 22px;
            right: 18px;

            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(255,255,255,.08);

            background: rgba(255,255,255,.045);

            color: rgba(255,255,255,.55);

            border-radius: 9px;

            font-size: 15px;

            cursor: pointer;

            transition: .25s ease;
        }

        .close-sidebar:hover {
            color: #fff;

            background:
                rgba(143,38,53,.58);

            border-color:
                rgba(255,255,255,.12);

            transform: rotate(90deg);
        }

        .sidebar-content {
            position: relative;
            z-index: 2;

            flex: 1;

            display: flex;
            flex-direction: column;

            padding: 25px 15px 15px;

            min-height: 0;

            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.12);
            border-radius: 10px;
        }

        .sidebar-label {
            padding: 0 12px 10px;

            font-size: 9px;
            font-weight: 700;

            color: rgba(255,255,255,.35);

            letter-spacing: 1.5px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu-item {
            position: relative;

            display: flex;
            align-items: center;

            gap: 13px;

            min-height: 46px;

            padding: 0 14px;

            border-radius: 11px;

            color: rgba(255,255,255,.58);

            font-size: 13px;
            font-weight: 600;

            border: 1px solid transparent;

            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                border-color .25s ease;
        }

        .menu-item i {
            width: 19px;

            text-align: center;

            font-size: 14px;

            color: rgba(255,255,255,.38);

            transition: .25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.065);

            border-color:
                rgba(255,255,255,.065);

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

            border:
                1px solid rgba(255,255,255,.08);

            color: #fff;

            box-shadow:
                0 8px 22px rgba(0,0,0,.12),
                inset 0 1px rgba(255,255,255,.07);
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
                0 5px 5px 0;

            box-shadow:
                0 0 10px rgba(231,170,178,.35);
        }

        .menu-item.active i {
            color: #fff;
        }

        /* =========================================================
           PROFILE
        ========================================================= */

        .sidebar-profile {
            margin-top: auto;

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
                1px solid rgba(255,255,255,.085);

            border-radius: 13px;

            flex-shrink: 0;

            box-shadow:
                inset 0 1px rgba(255,255,255,.06),
                0 10px 25px rgba(0,0,0,.10);
        }

        .sidebar-profile-top {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .sidebar-avatar,
        .profile-avatar {
            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    #a63847,
                    #7e202e
                );

            color: #fff;

            border:
                1px solid rgba(255,255,255,.14);

            border-radius: 50%;

            font-weight: 800;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            font-size: 13px;

            box-shadow:
                0 5px 15px rgba(0,0,0,.20);
        }

        .avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .status-dot {
            position: absolute;

            right: -1px;
            bottom: -1px;

            width: 10px;
            height: 10px;

            border-radius: 50%;

            background: var(--mint);

            border: 2px solid rgba(29,27,29,.97);

            box-shadow:
                0 0 0 0 rgba(79,174,124,.55);

            animation:
                statusPulse 2.4s ease-out infinite;
        }

        @keyframes statusPulse {
            0% {
                box-shadow:
                    0 0 0 0 rgba(79,174,124,.45);
            }

            70% {
                box-shadow:
                    0 0 0 6px rgba(79,174,124,0);
            }

            100% {
                box-shadow:
                    0 0 0 0 rgba(79,174,124,0);
            }
        }

        .sidebar-profile-info {
            min-width: 0;
        }

        .sidebar-profile-info strong {
            display: block;

            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;

            font-size: 12px;
            font-weight: 700;

            color: #fff;
        }

        .sidebar-profile-info span {
            display: block;

            margin-top: 3px;

            font-size: 9px;

            color: rgba(255,255,255,.42);
        }

        .logout-link {
            margin-top: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            width: 100%;
            height: 36px;

            border:
                1px solid rgba(231,170,178,.20);

            border-radius: 8px;

            background:
                rgba(255,255,255,.035);

            color: #e7aab2;

            font-size: 11px;
            font-weight: 700;

            transition: .25s ease;

            cursor: pointer;
        }

        .logout-link:hover {
            background:
                rgba(143,38,53,.72);

            border-color:
                rgba(231,170,178,.25);

            color: #fff;

            transform: translateY(-1px);
        }

        /* =========================================================
           OVERLAY
        ========================================================= */

        .sidebar-overlay {
            position: fixed;

            inset: 0;

            background:
                rgba(0,0,0,.22);

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
           TOPBAR
        ========================================================= */

        .topbar {
            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 64px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 4.5vw;

            z-index: 1050;

            color: #fff;

            background:
                linear-gradient(
                    180deg,
                    rgba(27,26,26,.88),
                    rgba(27,26,26,.72)
                );

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            border-bottom:
                1px solid rgba(255,255,255,.09);

            box-shadow:
                0 4px 20px rgba(0,0,0,.10);

            transition:
                left .45s cubic-bezier(.22,1,.36,1),
                width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .topbar {
            left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }

        .topbar-left,
        .topbar-right,
        .profile {
            display: flex;
            align-items: center;
        }

        .topbar-left {
            gap: 15px;
        }

        .navbar-home-btn {
            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255,255,255,.13);

            border-radius: 10px;

            background:
                rgba(255,255,255,.06);

            color:
                rgba(255,255,255,.85);

            font-size: 15px;

            cursor: pointer;

            transition: .25s ease;
        }

        .navbar-home-btn:hover {
            background:
                rgba(143,38,53,.72);

            border-color:
                rgba(255,255,255,.18);

            color: #fff;

            transform: translateY(-1px);
        }

        .navbar-logo {
            width: 35px;
            height: 35px;

            object-fit: contain;

            background: transparent;
            border: none;
            border-radius: 0;

            flex-shrink: 0;

            filter:
                drop-shadow(0 3px 8px rgba(0,0,0,.18));
        }

        .navbar-title {
            line-height: 1.05;
        }

        .navbar-title strong {
            display: block;

            font-size: 14px;
            font-weight: 800;

            letter-spacing: -.2px;
        }

        .navbar-title span {
            display: block;

            margin-top: 4px;

            font-size: 8px;
            font-weight: 600;

            color:
                rgba(255,255,255,.48);

            letter-spacing: 1.4px;
        }

        .topbar-right {
            gap: 18px;
        }

        .notification-wrap {
            position: relative;
        }

        .notification {
            position: relative;

            width: 37px;
            height: 37px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color:
                rgba(255,255,255,.75);

            background:
                rgba(255,255,255,.055);

            border:
                1px solid rgba(255,255,255,.08);

            font-size: 14px;

            cursor: pointer;

            transition: .25s ease;
        }

        .notification:hover,
        .notification.active {
            background:
                rgba(143,38,53,.62);

            color: #fff;
        }

        .notification-panel {
            position: absolute;

            top: 50px;
            right: 0;

            width: 300px;

            max-height: 360px;

            overflow-y: auto;

            background: #fff;

            border-radius: 14px;

            border: 1px solid rgba(0,0,0,.06);

            box-shadow:
                0 20px 45px rgba(0,0,0,.18);

            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);

            transition:
                opacity .22s ease,
                transform .22s ease,
                visibility .22s ease;

            z-index: 1400;
        }

        .notification-panel.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notification-panel-head {
            padding: 14px 16px;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: .5px;

            color: #292929;

            border-bottom: 1px solid rgba(0,0,0,.06);
        }

        .notification-panel-item {
            display: flex;
            align-items: flex-start;

            gap: 10px;

            padding: 12px 16px;

            border-bottom: 1px solid rgba(0,0,0,.045);

            transition: background .2s ease;
        }

        .notification-panel-item:last-child {
            border-bottom: none;
        }

        .notification-panel-item:hover {
            background: rgba(143,38,53,.05);
        }

        .notification-panel-item i {
            margin-top: 2px;

            color: var(--red);

            font-size: 12px;
        }

        .notification-panel-item strong {
            display: block;

            font-size: 11.5px;

            font-weight: 700;

            color: #292929;
        }

        .notification-panel-item span {
            display: block;

            margin-top: 2px;

            font-size: 10px;

            color: var(--muted);
        }

        .notification-panel-empty {
            padding: 24px 16px;

            text-align: center;

            font-size: 11px;

            color: var(--muted);
        }

        .profile {
            gap: 10px;

            cursor: pointer;

            border-radius: 10px;

            padding: 4px 6px;

            transition: background .2s ease;
        }

        .profile:hover {
            background: rgba(255,255,255,.07);
        }

        .profile-avatar {
            width: 34px;
            height: 34px;

            font-size: 12px;
        }

        .profile-info strong {
            display: block;

            font-size: 11px;
            font-weight: 700;

            color: #fff;
        }

        .profile-info span {
            display: block;

            margin-top: 2px;

            font-size: 9px;

            color:
                rgba(255,255,255,.45);
        }

        /* =========================================================
           HERO
        ========================================================= */

        .welcome-hero {
            position: relative;

            min-height: 620px;

            display: flex;
            align-items: center;

            padding: 110px 7vw 80px;

            overflow: hidden;

            background:
                linear-gradient(
                    180deg,
                    rgba(24,23,23,.42),
                    rgba(24,23,23,.24) 20%,
                    rgba(24,23,23,.10) 55%,
                    rgba(24,23,23,.14)
                ),

                linear-gradient(
                    90deg,
                    rgba(25,24,24,.42),
                    rgba(25,24,24,.24) 38%,
                    rgba(25,24,24,.08) 70%,
                    rgba(25,24,24,.04)
                ),

                var(--hero-image);

            background-size: cover;
            background-position: center;
        }

        .welcome-hero::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 105px;

            background:
                linear-gradient(
                    180deg,
                    rgba(25,24,24,.22),
                    transparent
                );

            pointer-events: none;

            z-index: 1;
        }

        .welcome-hero::after {
            content: "";

            position: absolute;

            left: 0;
            right: 0;
            bottom: 0;

            height: 150px;

            background:
                linear-gradient(
                    to bottom,
                    transparent,
                    #e9e9e9
                );

            pointer-events: none;

            z-index: 1;
        }

        .welcome-content {
            position: relative;

            z-index: 2;

            max-width: 650px;

            color: #fff;
        }

        .welcome-eyebrow {
            display: inline-flex;
            align-items: center;

            gap: 9px;

            margin-bottom: 21px;

            padding: 8px 12px;

            border-radius: 50px;

            background:
                rgba(255,255,255,.09);

            border:
                1px solid rgba(255,255,255,.15);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1.5px;

            color:
                rgba(255,255,255,.80);
        }

        .welcome-eyebrow i {
            color: #e7aab2;
        }

        .welcome-title {
            font-size:
                clamp(42px,5.4vw,76px);

            line-height: .98;

            font-weight: 800;

            letter-spacing: -3.5px;

            margin-bottom: 22px;

            text-shadow:
                0 8px 30px rgba(0,0,0,.18);
        }

        .welcome-title span {
            color: #e7aab2;
        }

        .welcome-description {
            max-width: 470px;

            font-size: 14px;

            line-height: 1.8;

            color:
                rgba(255,255,255,.75);

            margin-bottom: 28px;
        }

        .welcome-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 145px;
            height: 43px;

            padding: 0 20px;

            border-radius: 9px;

            background: #8f2635;

            color: #fff;

            font-size: 11px;
            font-weight: 700;

            box-shadow:
                0 10px 25px rgba(0,0,0,.20);

            transition: .25s ease;
        }

        .welcome-button:hover {
            background: #a12c3d;

            transform: translateY(-2px);

            box-shadow:
                0 14px 28px rgba(0,0,0,.24);
        }

        .welcome-actions {
            display: flex;
            flex-wrap: wrap;

            align-items: center;

            gap: 12px;
        }

        .welcome-button-ghost {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            min-width: 145px;
            height: 43px;

            padding: 0 20px;

            border-radius: 9px;

            background:
                rgba(255,255,255,.08);

            border:
                1px solid rgba(255,255,255,.28);

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            color: #fff;

            font-size: 11px;
            font-weight: 700;

            transition: .25s ease;
        }

        .welcome-button-ghost i {
            font-size: 10px;

            transition: transform .25s ease;
        }

        .welcome-button-ghost:hover {
            background:
                rgba(255,255,255,.16);

            border-color:
                rgba(255,255,255,.45);

            transform: translateY(-2px);
        }

        .welcome-button-ghost:hover i {
            transform: translateY(2px);
        }

        /* =========================================================
           STATS
        ========================================================= */

        .stats-section {
            position: relative;

            z-index: 3;

            margin: -68px 7vw 0;

            scroll-margin-top: 90px;
        }

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            max-width: 1280px;

            margin: 0 auto;
        }

        .stat-card {
            position: relative;

            display: flex;
            align-items: center;

            gap: 13px;

            padding: 18px 19px;

            border-radius: 17px;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.85),
                    rgba(255,255,255,.55)
                );

            border:
                1px solid rgba(255,255,255,.85);

            backdrop-filter:
                blur(22px)
                saturate(115%);

            -webkit-backdrop-filter:
                blur(22px)
                saturate(115%);

            box-shadow:
                0 16px 34px rgba(35,25,25,.13),
                inset 0 1px 0 rgba(255,255,255,.92);

            cursor: pointer;

            transition:
                transform .4s cubic-bezier(.22,1,.36,1),
                box-shadow .4s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 22px 42px rgba(35,25,25,.16),
                inset 0 1px 0 rgba(255,255,255,.96);
        }

        .stat-card:active {
            transform: translateY(-1px) scale(.99);
        }

        .stat-icon {
            flex-shrink: 0;

            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(143,38,53,.09);

            color: var(--red);

            font-size: 13px;
        }

        .stat-body strong {
            display: block;

            font-size: 22px;

            line-height: 1.1;

            font-weight: 800;

            color: #292929;

            letter-spacing: -.5px;
        }

        .stat-body span {
            display: block;

            margin-top: 3px;

            font-size: 10px;

            font-weight: 600;

            color: var(--muted);
        }

        /* =========================================================
           SECTION
        ========================================================= */

        .about-section {
            position: relative;

            padding: 78px 5vw 105px;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(143,38,53,.045),
                    transparent 28%
                ),

                radial-gradient(
                    circle at 85% 80%,
                    rgba(255,255,255,.70),
                    transparent 30%
                ),

                #e9e9e9;

            overflow: hidden;
        }

        .about-section::before {
            content: "";

            position: absolute;

            width: 400px;
            height: 400px;

            top: 100px;
            right: -250px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(143,38,53,.045),
                    transparent 68%
                );

            pointer-events: none;
        }

        .about-container {
            position: relative;

            max-width: 1280px;

            margin: 0 auto;

            z-index: 2;
        }

        .about-intro {
            position: relative;

            text-align: center;

            max-width: 1100px;

            margin: 0 auto 45px;
        }

        .about-intro > * {
            position: relative;
            z-index: 1;
        }

        .about-decor {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .about-decor i {
            position: absolute;
            color: var(--red);
            opacity: .10;
            animation: aboutFloat 5.5s ease-in-out infinite;
        }

        .about-decor i:nth-child(1) {
            top: -6px;
            left: 4%;
            font-size: 38px;
            transform: rotate(-12deg);
        }

        .about-decor i:nth-child(2) {
            top: 26px;
            right: 6%;
            font-size: 28px;
            color: var(--amber);
            opacity: .12;
            animation-delay: .6s;
        }

        .about-decor i:nth-child(3) {
            bottom: -4px;
            left: 13%;
            font-size: 24px;
            opacity: .08;
            animation-delay: 1.2s;
        }

        .about-decor i:nth-child(4) {
            bottom: 8px;
            right: 15%;
            font-size: 32px;
            color: var(--amber);
            opacity: .10;
            animation-delay: 1.8s;
        }

        @keyframes aboutFloat {
            0%, 100% { transform: translateY(0) rotate(var(--r, 0deg)); }
            50% { transform: translateY(-9px) rotate(var(--r, 0deg)); }
        }

        @media (max-width:650px) {
            .about-decor { display: none; }
        }

        .feature-label {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 16px;

            padding: 8px 15px;

            border-radius: 8px;

            background:
                rgba(143,38,53,.08);

            color: var(--red);

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 1.4px;
        }

        .about-heading {
            font-family:
                "Times New Roman",
                Times,
                serif;

            font-size:
                clamp(31px,3.5vw,49px);

            line-height: 1.12;

            letter-spacing: -.8px;

            color: #292929;

            font-weight: 700;

            white-space: nowrap;
        }

        .about-heading span {
            color: var(--red);
        }

        /* Heading khusus di dalam "Ruang Kerja Guru" — font disamakan
           dengan gaya brand SIPANDAI (Inter, bold, tegas), diberi
           aksen gradient + garis bawah supaya tidak terasa polos */

        .about-intro .about-heading {
            font-family: "Inter", sans-serif;
            font-weight: 800;
            letter-spacing: -1.3px;
            font-size: clamp(28px, 3.8vw, 46px);
            white-space: normal;
        }

        .about-intro .about-heading span {
            position: relative;
            display: inline-block;
            background: linear-gradient(120deg, var(--red) 0%, #c0485a 55%, var(--amber) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .about-subtitle {
            max-width: 540px;
            margin: 16px auto 0;
            font-size: 12.5px;
            line-height: 1.85;
            color: var(--muted);
        }

        .about-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 24px;
        }

        .about-divider span {
            width: 38px;
            height: 1px;
            background: rgba(70,60,60,.18);
        }

        .about-divider i {
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(143,38,53,.08);
            color: var(--red);
            font-size: 10px;
        }

        @media (max-width:650px) {
            .about-intro .about-heading {
                font-size: clamp(24px, 6vw, 34px);
                letter-spacing: -.6px;
            }

            .about-subtitle {
                font-size: 12px;
                padding: 0 6px;
            }
        }

        /* =========================================================
           FEATURE
        ========================================================= */

        .feature-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

            width: 100%;
        }

        .feature-card {
            position: relative;

            min-height: 290px;

            display: flex;
            flex-direction: column;

            padding: 26px 27px 23px;

            border-radius: 21px;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.78),
                    rgba(255,255,255,.43)
                );

            border:
                1px solid rgba(255,255,255,.82);

            backdrop-filter:
                blur(20px)
                saturate(115%);

            -webkit-backdrop-filter:
                blur(20px)
                saturate(115%);

            box-shadow:
                0 14px 35px rgba(55,40,40,.075),
                inset 0 1px 0 rgba(255,255,255,.90),
                inset 0 -1px 0 rgba(255,255,255,.28);

            transition:
                transform .45s cubic-bezier(.22,1,.36,1),
                box-shadow .45s ease,
                border-color .35s ease;
        }

        .feature-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 25px;
            right: 25px;

            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.95),
                    transparent
                );

            opacity: .9;

            pointer-events: none;
        }

        .feature-card::after {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            right: -100px;
            bottom: -105px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(143,38,53,.055),
                    transparent 70%
                );

            pointer-events: none;
        }

        .feature-card:hover {
            transform: translateY(-6px);

            border-color:
                rgba(255,255,255,.98);

            box-shadow:
                0 22px 45px rgba(55,40,40,.11),
                inset 0 1px 0 rgba(255,255,255,.96);
        }

        .feature-card-top {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: space-between;

            z-index: 3;

            margin-bottom: auto;
        }

        .feature-icon {
            width: 43px;
            height: 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                rgba(255,255,255,.58);

            border:
                1px solid rgba(255,255,255,.80);

            color:
                var(--red);

            font-size: 13px;

            box-shadow:
                0 7px 18px rgba(50,35,35,.06),
                inset 0 1px rgba(255,255,255,.9);

            transition: .35s ease;
        }

        .feature-arrow {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                rgba(255,255,255,.35);

            border:
                1px solid rgba(255,255,255,.60);

            color:
                rgba(70,60,60,.48);

            font-size: 9px;

            transition: .35s ease;
        }

        .feature-card:hover .feature-icon {
            background:
                rgba(143,38,53,.09);

            border-color:
                rgba(143,38,53,.12);

            transform:
                translateY(-2px);
        }

        .feature-card:hover .feature-arrow {
            background:
                var(--red);

            border-color:
                var(--red);

            color: #fff;

            transform:
                translate(2px,-2px);
        }

        .feature-card-content {
            position: relative;

            z-index: 3;

            margin-top: 45px;
        }

        .feature-number {
            display: block;

            margin-bottom: 10px;

            color:
                rgba(90,75,78,.52);

            font-size: 8px;
            font-weight: 800;

            letter-spacing: 1.5px;
        }

        .feature-card h3 {
            margin-bottom: 8px;

            color: #292929;

            font-family:
                "Times New Roman",
                Times,
                serif;

            font-size: 28px;

            line-height: 1;

            font-weight: 700;

            letter-spacing: -.4px;
        }

        .feature-card p {
            max-width: 285px;

            color: #777;

            font-size: 11px;

            line-height: 1.75;
        }

        .feature-card-bottom {
            position: relative;

            z-index: 3;

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 25px;
            padding-top: 15px;

            border-top:
                1px solid rgba(70,60,60,.075);
        }

        .feature-card-bottom span {
            font-size: 8px;
            font-weight: 700;

            color:
                rgba(70,60,60,.43);

            letter-spacing: 1.3px;
        }

        .feature-card-bottom i {
            font-size: 9px;

            color:
                rgba(143,38,53,.52);

            transition: .3s ease;
        }

        .feature-card:hover .feature-card-bottom i {
            color: var(--red);

            transform:
                translateX(4px);
        }

        /* =========================================================
           AKTIVITAS
        ========================================================= */

        .activity-section {
            position: relative;

            padding: 0 5vw 100px;

            background: #e9e9e9;
        }

        .activity-container {
            max-width: 1280px;

            margin: 0 auto;
        }

        .activity-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            flex-wrap: wrap;

            gap: 14px;

            margin-bottom: 24px;
        }

        .activity-head .about-heading {
            white-space: normal;

            font-size:
                clamp(24px,2.6vw,34px);
        }

        .activity-filter {
            display: flex;
            align-items: center;

            gap: 6px;

            margin-bottom: 18px;
        }

        .activity-filter button {
            padding: 7px 14px;

            border-radius: 50px;

            border: 1px solid rgba(70,60,60,.12);

            background: rgba(255,255,255,.55);

            color: var(--muted);

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .3px;

            cursor: pointer;

            transition: .2s ease;
        }

        .activity-filter button:hover {
            border-color: rgba(143,38,53,.3);

            color: var(--red);
        }

        .activity-filter button.active {
            background: var(--red);

            border-color: var(--red);

            color: #fff;
        }

        .activity-list {
            display: flex;
            flex-direction: column;

            gap: 10px;
        }

        .activity-row {
            display: flex;
            align-items: center;

            gap: 15px;

            padding: 16px 20px;

            border-radius: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.75),
                    rgba(255,255,255,.42)
                );

            border:
                1px solid rgba(255,255,255,.8);

            border-left: 3px solid var(--red);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            cursor: default;

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .activity-row:hover {
            transform: translateX(4px);

            box-shadow:
                0 10px 26px rgba(55,40,40,.08);
        }

        .activity-row .activity-icon {
            flex-shrink: 0;

            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background:
                rgba(143,38,53,.09);

            color: var(--red);

            font-size: 12px;
        }

        .activity-row .activity-text {
            flex: 1;

            min-width: 0;
        }

        .activity-row .activity-text strong {
            display: block;

            font-size: 12.5px;

            font-weight: 700;

            color: #292929;
        }

        .activity-row .activity-text span {
            display: block;

            margin-top: 3px;

            font-size: 10.5px;

            color: var(--muted);
        }

        .activity-row .activity-time {
            flex-shrink: 0;

            font-size: 9px;

            font-weight: 700;

            color: rgba(70,60,60,.45);

            letter-spacing: .5px;

            white-space: nowrap;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .site-footer {
            padding: 26px 5vw 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            flex-wrap: wrap;

            gap: 10px;

            background: #e9e9e9;

            border-top:
                1px solid rgba(70,60,60,.09);
        }

        .site-footer p {
            font-size: 10.5px;

            color: var(--muted);
        }

        .site-footer .footer-brand {
            display: flex;
            align-items: center;

            gap: 8px;

            font-size: 10.5px;

            font-weight: 700;

            color: var(--red);
        }

        .site-footer .footer-brand i {
            font-size: 11px;
        }

        /* =========================================================
           BACK TO TOP
        ========================================================= */

        .back-to-top {
            position: fixed;

            right: 26px;
            bottom: 26px;

            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--red);

            color: #fff;

            font-size: 14px;

            border: none;

            cursor: pointer;

            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);

            box-shadow: 0 12px 28px rgba(143,38,53,.30);

            transition:
                opacity .3s ease,
                transform .3s ease,
                visibility .3s ease,
                background .2s ease;

            z-index: 1000;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            background: var(--red-dark);
        }

        /* =========================================================
           ANIMATION
        ========================================================= */

        .reveal {
            opacity: 0;

            transform:
                translateY(22px);

            transition:
                opacity .8s ease,
                transform .8s cubic-bezier(.22,1,.36,1);
        }

        .reveal.active {
            opacity: 1;

            transform:
                translateY(0);
        }

        .feature-card:nth-child(2) {
            transition-delay: .08s;
        }

        .feature-card:nth-child(3) {
            transition-delay: .16s;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width:1100px) {

            .welcome-hero {
                padding-left: 6vw;
                padding-right: 6vw;
            }

            .about-section {
                padding-left: 5vw;
                padding-right: 5vw;
            }

            .feature-card {
                min-height: 280px;
            }
        }

        @media (max-width:900px) {

            body.sidebar-open .main {
                margin-left: 0;
                width: 100%;
            }

            body.sidebar-open .topbar {
                left: 0;
                width: 100%;
            }

            .welcome-hero {
                min-height: 600px;

                padding:
                    105px 7vw 90px;
            }

            .about-section {
                padding:
                    70px 7vw 90px;
            }

            .about-intro {
                margin-bottom: 38px;
            }

            .about-heading {
                font-size: 40px;

                white-space: normal;
            }

            .feature-grid {
                grid-template-columns:
                    1fr 1fr;

                gap: 14px;
            }

            .feature-card {
                min-height: 280px;
            }

            .feature-card:last-child {
                grid-column: 1 / -1;

                min-height: 270px;
            }

            .stats-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }
        }

        @media (max-width:650px) {

            :root {
                --sidebar-width: 270px;
            }

            .topbar {
                padding: 0 20px;
            }

            .profile-info {
                display: none;
            }

            .topbar-right {
                gap: 8px;
            }

            .navbar-logo {
                width: 32px;
                height: 32px;
            }

            .welcome-hero {
                min-height: 620px;

                padding:
                    105px 25px 100px;

                background-position:
                    62% center;
            }

            .welcome-hero::before {
                inset: 0;

                height: auto;

                background:
                    linear-gradient(
                        180deg,
                        rgba(25,24,24,.30),
                        transparent 25%
                    ),

                    linear-gradient(
                        90deg,
                        rgba(25,24,24,.38),
                        rgba(25,24,24,.12)
                    );
            }

            .welcome-title {
                font-size: 43px;

                letter-spacing: -2.4px;
            }

            .welcome-description {
                font-size: 13px;

                max-width: 350px;
            }

            .about-section {
                padding:
                    60px 20px 75px;
            }

            .about-intro {
                margin-bottom: 32px;
            }

            .feature-label {
                margin-bottom: 13px;
            }

            .about-heading {
                font-size: 32px;

                letter-spacing: -.4px;

                white-space: normal;
            }

            .feature-grid {
                grid-template-columns: 1fr;

                gap: 13px;
            }

            .feature-card,
            .feature-card:last-child {
                grid-column: auto;

                min-height: 285px;
            }

            .feature-card {
                padding:
                    24px 24px 21px;

                border-radius: 19px;
            }

            .feature-card-content {
                margin-top: 38px;
            }

            .feature-card h3 {
                font-size: 25px;
            }

            .stats-section {
                margin: -50px 20px 0;
            }

            .stats-grid {
                gap: 10px;
            }

            .stat-card {
                padding: 14px 15px;
            }

            .stat-body strong {
                font-size: 18px;
            }

            .activity-section {
                padding: 0 20px 80px;
            }

            .activity-row {
                flex-wrap: wrap;

                padding: 14px 15px;
            }

            .activity-row .activity-time {
                margin-top: 2px;
                margin-left: 51px;
            }

            .notification-panel {
                width: 260px;

                right: -60px;
            }

            .site-footer {
                padding: 22px 20px 26px;

                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width:420px) {

            .sidebar {
                width: 280px;
            }

            .welcome-title {
                font-size: 39px;
            }

            .navbar-title {
                display: none;
            }

            .welcome-hero {
                padding-left: 22px;
                padding-right: 22px;
            }

            .about-heading {
                font-size: 30px;
            }

            .feature-card,
            .feature-card:last-child {
                min-height: 280px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .notification-panel {
                width: 230px;

                right: -90px;
            }
        }

        @media (prefers-reduced-motion:reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }

            .reveal {
                opacity: 1;
                transform: none;
            }
        }

    </style>
</head>


<body>

@php
    /*
    |--------------------------------------------------------------------------
    | DATA DASHBOARD SIPANDAI
    |--------------------------------------------------------------------------
    | Semua angka di bawah mengambil data dari sistem sekarang:
    |
    | Exam  = data ujian
    | User  = akun siswa/guru
    | Result = hasil ujian
    |
    | Semua data ujian dan hasil dibatasi berdasarkan guru yang sedang login.
    */

    $guruLogin = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | QUERY DATA UTAMA
    |--------------------------------------------------------------------------
    */

    $ujianGuru = \App\Models\Exam::where('guru_id', $guruLogin->id);

    /*
    |--------------------------------------------------------------------------
    | UJIAN AKTIF
    |--------------------------------------------------------------------------
    */

    $statUjianAktif = (clone $ujianGuru)
        ->where('status', 'aktif')
        ->count();

    /*
    |--------------------------------------------------------------------------
    | SISWA TERDAFTAR
    |--------------------------------------------------------------------------
    | Siswa adalah seluruh User dengan role siswa.
    */

    $statSiswa = \App\Models\User::where('role', 'siswa')->count();

    /*
    |--------------------------------------------------------------------------
    | UJIAN SELESAI
    |--------------------------------------------------------------------------
    */

    $statSelesai = (clone $ujianGuru)
        ->where('status', 'selesai')
        ->count();

    /*
    |--------------------------------------------------------------------------
    | RATA-RATA NILAI
    |--------------------------------------------------------------------------
    | Hanya Result yang berasal dari ujian milik guru yang sedang login.
    */

    $statRata = \App\Models\Result::whereHas('exam', function ($query) use ($guruLogin) {
            $query->where('guru_id', $guruLogin->id);
        })
        ->avg('nilai');

    $statRata = $statRata !== null
        ? round((float) $statRata, 2)
        : 0;

    /*
    |--------------------------------------------------------------------------
    | AKTIVITAS TERBARU
    |--------------------------------------------------------------------------
    | Mengambil aktivitas nyata:
    | 1. Hasil siswa yang baru masuk
    | 2. Ujian yang baru dibuat
    |
    | Tidak ada lagi data dummy/fallback palsu.
    */

    $aktivitasHasil = \App\Models\Result::with(['exam', 'siswa'])
        ->whereHas('exam', function ($query) use ($guruLogin) {
            $query->where('guru_id', $guruLogin->id);
        })
        ->latest('submitted_at')
        ->take(6)
        ->get();

    $aktivitasUjian = \App\Models\Exam::where('guru_id', $guruLogin->id)
        ->latest()
        ->take(6)
        ->get();

    $activities = collect();

    foreach ($aktivitasHasil as $hasil) {

        $namaSiswa = $hasil->siswa->name ?? 'Siswa';

        $namaUjian = $hasil->exam->nama_ujian ?? 'Ujian';

        $nilai = number_format(
            (float) ($hasil->nilai ?? 0),
            2,
            ',',
            '.'
        );

        $activities->push([
            'created_at' => $hasil->submitted_at ?? $hasil->created_at,
            'icon' => 'fa-solid fa-clipboard-check',
            'title' => $namaSiswa . ' menyelesaikan ujian',
            'desc' => $namaUjian . ' • Nilai ' . $nilai,
            'time' => $hasil->submitted_at
                ? \Carbon\Carbon::parse($hasil->submitted_at)->locale('id')->diffForHumans()
                : 'Baru saja',
        ]);
    }

    foreach ($aktivitasUjian as $ujian) {

        $statusUjian = strtolower((string) $ujian->status);

        if ($statusUjian === 'aktif') {
            $iconUjian = 'fa-solid fa-circle-play';
            $deskripsiUjian = 'Ujian sedang aktif dan dapat dikerjakan siswa.';
        } elseif ($statusUjian === 'selesai') {
            $iconUjian = 'fa-solid fa-circle-check';
            $deskripsiUjian = 'Ujian telah selesai.';
        } else {
            $iconUjian = 'fa-solid fa-calendar-check';
            $deskripsiUjian = 'Ujian berhasil dibuat di SIPANDAI.';
        }

        $activities->push([
            'created_at' => $ujian->created_at,
            'icon' => $iconUjian,
            'title' => 'Ujian "' . ($ujian->nama_ujian ?? 'Ujian') . '"',
            'desc' => $deskripsiUjian,
            'time' => $ujian->created_at
                ? $ujian->created_at->locale('id')->diffForHumans()
                : 'Baru saja',
        ]);
    }

    $activities = $activities
        ->sortByDesc(function ($item) {
            return $item['created_at']
                ? \Carbon\Carbon::parse($item['created_at'])->timestamp
                : 0;
        })
        ->take(5)
        ->values();

@endphp


<!-- =========================================================
     SIDEBAR
========================================================= -->

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
                class="menu-item active"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <a
                href="{{ route('guru.exams.index') }}"
                class="menu-item"
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

        </nav>


        <div class="sidebar-profile">

            <div class="sidebar-profile-top">

                <div class="avatar-wrap">

                    <div class="sidebar-avatar">

                        {{ strtoupper(substr($guruLogin->name ?? 'G', 0, 1)) }}

                    </div>

                    <span class="status-dot"></span>

                </div>


                <div class="sidebar-profile-info">

                    <strong>
                        {{ $guruLogin->name ?? 'Guru' }}
                    </strong>

                    <span>
                        Akun Guru
                    </span>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
                style="margin:0;"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-link"
                >

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span>
                        Keluar
                    </span>

                </button>

            </form>

        </div>

    </div>

</aside>


<!-- OVERLAY -->

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>


<!-- =========================================================
     MAIN
========================================================= -->

<main class="main">


    <!-- =====================================================
         TOPBAR
    ====================================================== -->

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

                <strong>
                    SIPANDAI
                </strong>

                <span>
                    SISTEM UJIAN DIGITAL
                </span>

            </div>

        </div>


        <div class="topbar-right">

            <div class="notification-wrap">

                <div class="notification" id="notificationBtn">

                    <i class="fa-regular fa-bell"></i>

                </div>


                <div class="notification-panel" id="notificationPanel">

                    <div class="notification-panel-head">
                        NOTIFIKASI TERBARU
                    </div>

                    @forelse($activities as $item)

                        <div class="notification-panel-item">

                            <i class="{{ $item['icon'] ?? 'fa-solid fa-bell' }}"></i>

                            <div>

                                <strong>
                                    {{ $item['title'] ?? '' }}
                                </strong>

                                <span>
                                    {{ $item['desc'] ?? '' }} &middot; {{ $item['time'] ?? '' }}
                                </span>

                            </div>

                        </div>

                    @empty

                        <div class="notification-panel-empty">
                            Belum ada notifikasi baru.
                        </div>

                    @endforelse

                </div>

            </div>


            <div class="profile" id="profileMenu">

                <div class="profile-avatar">

                    {{ strtoupper(substr($guruLogin->name ?? 'G', 0, 1)) }}

                </div>


                <div class="profile-info">

                    <strong>
                        {{ $guruLogin->name ?? 'Guru' }}
                    </strong>

                    <span>
                        Guru
                    </span>

                </div>

            </div>

        </div>

    </header>


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="welcome-hero">

        <div class="welcome-content reveal">

            <div class="welcome-eyebrow">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    SISTEM INFORMASI GURU
                </span>

            </div>


            <h1 class="welcome-title">

                Selamat Datang
                <br>

                di <span>SIPANDAI</span>

            </h1>


            <p class="welcome-description">

                Kelola ujian dan penilaian siswa
                dalam satu ruang digital.

            </p>


            <div class="welcome-actions">

                <a
                    href="{{ route('guru.exams.index') }}"
                    class="welcome-button"
                >

                    Kelola Ujian

                </a>

            </div>

        </div>

    </section>


    <!-- =====================================================
         RINGKASAN CEPAT
    ====================================================== -->

    <section
        class="stats-section reveal"
        id="ringkasan"
    >

        <div class="stats-grid">

            <!-- UJIAN AKTIF -->

            <a
                href="{{ route('guru.exams.index') }}"
                class="stat-card"
            >

                <div class="stat-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <div class="stat-body">

                    <strong
                        class="stat-number"
                        data-target="{{ $statUjianAktif }}"
                    >
                        0
                    </strong>

                    <span>
                        Ujian Aktif
                    </span>

                </div>

            </a>


            <!-- SISWA TERDAFTAR -->

            <a
                href="{{ route('guru.data-siswa') }}"
                class="stat-card"
            >

                <div class="stat-icon">
                    <i class="fa-solid fa-user-group"></i>
                </div>

                <div class="stat-body">

                    <strong
                        class="stat-number"
                        data-target="{{ $statSiswa }}"
                    >
                        0
                    </strong>

                    <span>
                        Siswa Terdaftar
                    </span>

                </div>

            </a>


            <!-- UJIAN SELESAI -->

            <a
                href="{{ route('guru.results.index') }}"
                class="stat-card"
            >

                <div class="stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="stat-body">

                    <strong
                        class="stat-number"
                        data-target="{{ $statSelesai }}"
                    >
                        0
                    </strong>

                    <span>
                        Ujian Selesai
                    </span>

                </div>

            </a>


            <!-- RATA-RATA NILAI -->

            <a
                href="{{ route('guru.results.index') }}"
                class="stat-card"
            >

                <div class="stat-icon">
                    <i class="fa-solid fa-star"></i>
                </div>

                <div class="stat-body">

                    <strong
                        class="stat-number"
                        data-target="{{ $statRata }}"
                    >
                        0
                    </strong>

                    <span>
                        Rata-rata Nilai
                    </span>

                </div>

            </a>

        </div>

    </section>


    <!-- =====================================================
         RUANG KERJA GURU
    ====================================================== -->

    <section class="about-section">

        <div class="about-container">


            <div class="about-intro reveal">

                <div class="about-decor" aria-hidden="true">

                    <i class="fa-solid fa-graduation-cap"></i>
                    <i class="fa-solid fa-chart-pie"></i>
                    <i class="fa-solid fa-user-group"></i>
                    <i class="fa-solid fa-clipboard-list"></i>

                </div>


                <div class="feature-label">

                    RUANG KERJA GURU

                </div>


                <h2 class="about-heading">

                    Mari Mulai Hari Ini
                    <br>

                    Kelola ujian dengan mudah melalui
                    <span>SIPANDAI</span>

                </h2>


                <p class="about-subtitle">

                    Satu ruang kerja digital untuk membuat ujian, memantau
                    hasil pengerjaan, dan mengelola data siswa — semua
                    tanpa ribet.

                </p>


                <div class="about-divider">

                    <span></span>

                    <i class="fa-solid fa-graduation-cap"></i>

                    <span></span>

                </div>

            </div>


            <div class="feature-grid">


                <!-- KELOLA UJIAN -->

                <a
                    href="{{ route('guru.exams.index') }}"
                    class="feature-card reveal"
                >

                    <div class="feature-card-top">

                        <div class="feature-icon">

                            <i class="fa-solid fa-wand-magic-sparkles"></i>

                        </div>


                        <div class="feature-arrow">

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                        </div>

                    </div>


                    <div class="feature-card-content">

                        <span class="feature-number">
                            UJIAN DIGITAL
                        </span>


                        <h3>
                            Kelola Ujian
                        </h3>


                        <p>

                            Buat dan kelola ujian digital
                            dengan lebih praktis.

                        </p>

                    </div>


                    <div class="feature-card-bottom">

                        <span>
                            BUKA MENU
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </div>

                </a>


                <!-- HASIL UJIAN -->

                <a
                    href="{{ route('guru.results.index') }}"
                    class="feature-card reveal"
                >

                    <div class="feature-card-top">

                        <div class="feature-icon">

                            <i class="fa-solid fa-chart-pie"></i>

                        </div>


                        <div class="feature-arrow">

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                        </div>

                    </div>


                    <div class="feature-card-content">

                        <span class="feature-number">
                            PENILAIAN
                        </span>


                        <h3>
                            Hasil Ujian
                        </h3>


                        <p>

                            Pantau hasil pengerjaan dan
                            nilai siswa dengan mudah.

                        </p>

                    </div>


                    <div class="feature-card-bottom">

                        <span>
                            LIHAT HASIL
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </div>

                </a>


                <!-- DATA SISWA -->

                <a
                    href="{{ route('guru.data-siswa') }}"
                    class="feature-card reveal"
                >

                    <div class="feature-card-top">

                        <div class="feature-icon">

                            <i class="fa-solid fa-user-group"></i>

                        </div>


                        <div class="feature-arrow">

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                        </div>

                    </div>


                    <div class="feature-card-content">

                        <span class="feature-number">
                            DATA SISWA
                        </span>


                        <h3>
                            Data Siswa
                        </h3>


                        <p>

                            Akses data siswa yang
                            terdaftar di SIPANDAI.

                        </p>

                    </div>


                    <div class="feature-card-bottom">

                        <span>
                            LIHAT DATA
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </div>

                </a>

            </div>

        </div>

    </section>


    <!-- =====================================================
         AKTIVITAS TERBARU
    ====================================================== -->

    <section class="activity-section reveal">

        <div class="activity-container">

            <div class="activity-head">

                <div>

                    <div class="feature-label">
                        RIWAYAT TERKINI
                    </div>

                    <h2 class="about-heading">
                        Aktivitas Terbaru
                    </h2>

                </div>


                <!--
                    Tombol diarahkan ke hasil ujian,
                    karena bagian aktivitas berisi riwayat
                    pengerjaan dan ujian.
                -->

                <a
                    href="{{ route('guru.results.index') }}"
                    class="welcome-button"
                    style="
                        background: var(--red);
                        color:#fff;
                        box-shadow:0 8px 20px rgba(143,38,53,.18);
                    "
                >
                    Lihat Aktivitas
                </a>

            </div>


            <div class="activity-filter" id="activityFilter">

                <button type="button" class="active" data-filter="all">Semua</button>
                <button type="button" data-filter="ujian">Ujian</button>
                <button type="button" data-filter="hasil">Hasil</button>

            </div>


            <div class="activity-list" id="activityList">

                @forelse($activities as $item)

                    <div
                        class="activity-row"
                        data-type="{{ str_contains($item['icon'] ?? '', 'clipboard-check') ? 'hasil' : 'ujian' }}"
                    >

                        <div class="activity-icon">

                            <i class="{{ $item['icon'] ?? 'fa-solid fa-bell' }}"></i>

                        </div>


                        <div class="activity-text">

                            <strong>
                                {{ $item['title'] ?? '' }}
                            </strong>

                            <span>
                                {{ $item['desc'] ?? '' }}
                            </span>

                        </div>


                        <div class="activity-time">

                            {{ $item['time'] ?? '' }}

                        </div>

                    </div>

                @empty

                    <div class="activity-row">

                        <div class="activity-icon">

                            <i class="fa-solid fa-mug-hot"></i>

                        </div>


                        <div class="activity-text">

                            <strong>
                                Belum ada aktivitas terbaru
                            </strong>

                            <span>
                                Aktivitas akan muncul setelah ada ujian atau siswa yang menyelesaikan ujian.
                            </span>

                        </div>


                        <div class="activity-time">
                            —
                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="site-footer">

        <p>

            &copy; {{ date('Y') }}
            SIPANDAI &mdash;
            SMKN 2 Kota Kediri.
            Seluruh hak cipta dilindungi.

        </p>


        <div class="footer-brand">

            <i class="fa-solid fa-graduation-cap"></i>

            <span>
                Sistem Ujian Digital
            </span>

        </div>

    </footer>

</main>


<!-- BACK TO TOP -->

<button
    type="button"
    class="back-to-top"
    id="backToTop"
    aria-label="Kembali ke atas"
>
    <i class="fa-solid fa-arrow-up"></i>
</button>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

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
                closeNotificationPanel();

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


    /* =========================================================
       PANEL NOTIFIKASI
    ========================================================= */

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationPanel =
        document.getElementById("notificationPanel");


    function openNotificationPanel() {

        notificationPanel.classList.add("show");
        notificationBtn.classList.add("active");

    }


    function closeNotificationPanel() {

        notificationPanel.classList.remove("show");
        notificationBtn.classList.remove("active");

    }


    notificationBtn.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

            if (
                notificationPanel.classList.contains("show")
            ) {

                closeNotificationPanel();

            } else {

                openNotificationPanel();

            }

        }
    );


    document.addEventListener(
        "click",
        function (event) {

            if (
                !notificationPanel.contains(event.target) &&
                !notificationBtn.contains(event.target)
            ) {

                closeNotificationPanel();

            }

        }
    );


    /* =========================================================
       FILTER AKTIVITAS
    ========================================================= */

    const activityFilterButtons =
        document.querySelectorAll(
            "#activityFilter button"
        );

    const activityRows =
        document.querySelectorAll(
            "#activityList .activity-row"
        );


    activityFilterButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    activityFilterButtons.forEach(
                        function (btn) {
                            btn.classList.remove("active");
                        }
                    );

                    button.classList.add("active");

                    const filter =
                        button.dataset.filter;

                    activityRows.forEach(
                        function (row) {

                            const type =
                                row.dataset.type;

                            if (
                                filter === "all" ||
                                !type ||
                                type === filter
                            ) {

                                row.style.display = "";

                            } else {

                                row.style.display = "none";

                            }

                        }
                    );

                }
            );

        }
    );


    /* =========================================================
       REVEAL ANIMATION
    ========================================================= */

    const revealElements =
        document.querySelectorAll(".reveal");


    if ("IntersectionObserver" in window) {

        const revealObserver =
            new IntersectionObserver(

                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target.classList.add(
                                    "active"
                                );

                                revealObserver.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },

                {
                    threshold: 0.12
                }

            );


        revealElements.forEach(
            function (element) {

                revealObserver.observe(
                    element
                );

            }
        );

    } else {

        revealElements.forEach(
            function (element) {

                element.classList.add(
                    "active"
                );

            }
        );

    }


    /* =========================================================
       RESIZE SIDEBAR
    ========================================================= */

    window.addEventListener(
        "resize",
        function () {

            if (
                window.innerWidth > 900
            ) {

                sidebarOverlay.classList.remove(
                    "show"
                );

            }

        }
    );


    /* =========================================================
       TOMBOL KEMBALI KE ATAS
    ========================================================= */

    const backToTop =
        document.getElementById("backToTop");


    window.addEventListener(
        "scroll",
        function () {

            if (
                window.scrollY > 500
            ) {

                backToTop.classList.add("show");

            } else {

                backToTop.classList.remove("show");

            }

        }
    );


    backToTop.addEventListener(
        "click",
        function () {

            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });

        }
    );


    /* =========================================================
       ANIMASI ANGKA STATISTIK
    ========================================================= */

    const prefersReducedMotion =
        window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;


    const statNumbers =
        document.querySelectorAll(
            ".stat-number"
        );


    function animateCount(element) {

        const target =
            parseFloat(
                element.dataset.target || "0"
            );


        if (
            prefersReducedMotion ||
            !target
        ) {

            element.textContent =
                target;

            return;

        }


        const duration = 1100;

        const start =
            performance.now();


        function tick(now) {

            const progress =
                Math.min(
                    (now - start) / duration,
                    1
                );


            const eased =
                1 -
                Math.pow(
                    1 - progress,
                    3
                );


            /*
             * Nilai rata-rata boleh memiliki desimal,
             * sedangkan jumlah ujian/siswa tetap angka bulat.
             */

            const isDecimal =
                target % 1 !== 0;


            if (isDecimal) {

                element.textContent =
                    (target * eased)
                        .toFixed(2)
                        .replace(".", ",");

            } else {

                element.textContent =
                    Math.round(
                        target * eased
                    );

            }


            if (
                progress < 1
            ) {

                requestAnimationFrame(
                    tick
                );

            } else {

                if (isDecimal) {

                    element.textContent =
                        target
                            .toFixed(2)
                            .replace(".", ",");

                } else {

                    element.textContent =
                        target;

                }

            }

        }


        requestAnimationFrame(tick);

    }


    if (
        statNumbers.length &&
        "IntersectionObserver" in window
    ) {

        const statObserver =
            new IntersectionObserver(

                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                animateCount(
                                    entry.target
                                );

                                statObserver.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },

                {
                    threshold: 0.4
                }

            );


        statNumbers.forEach(
            function (element) {

                statObserver.observe(
                    element
                );

            }
        );

    } else {

        statNumbers.forEach(
            animateCount
        );

    }

    /* =========================================================
       AUTO-REFRESH DATA DASHBOARD (tanpa reload)
    ========================================================= */

    const API_BASE_URL = "{{ url('/api') }}";
    const REFRESH_INTERVAL_MS = 30000;

    async function fetchDashboardApi(endpoint) {

        const res = await fetch(API_BASE_URL + endpoint, {
            method: "GET",
            credentials: "same-origin",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });

        if (!res.ok) {
            throw new Error("API " + endpoint + " gagal dengan status " + res.status);
        }

        return await res.json();

    }

    async function refreshDashboardData() {

        try {

            const [statsPayload, activitiesPayload] = await Promise.all([
                fetchDashboardApi("/dashboard/stats"),
                fetchDashboardApi("/dashboard/activities")
            ]);

            const stats = statsPayload.stats ?? statsPayload.data ?? statsPayload;
            const activities = activitiesPayload.activities ?? activitiesPayload.data ?? activitiesPayload;

            updateStatCards(stats);
            updateActivityList(Array.isArray(activities) ? activities : []);
            updateNotificationPanel(Array.isArray(activities) ? activities : []);

        } catch (err) {

            console.error("Gagal memuat data dashboard dari API:", err);

        }

    }

    function updateStatCards(stats) {

        if (!stats) return;

        const map = {
            ujian_aktif: document.querySelector('.stat-card:nth-child(1) .stat-number'),
            siswa_terdaftar: document.querySelector('.stat-card:nth-child(2) .stat-number'),
            ujian_selesai: document.querySelector('.stat-card:nth-child(3) .stat-number'),
            rata_rata_nilai: document.querySelector('.stat-card:nth-child(4) .stat-number'),
        };

        Object.entries(map).forEach(function ([key, el]) {

            if (!el || stats[key] === undefined) return;

            el.dataset.target = stats[key];

            animateCount(el);

        });

    }

    function updateActivityList(activities) {

        const list = document.getElementById("activityList");

        if (!list || !activities) return;

        if (!activities.length) {

            list.innerHTML = `
                <div class="activity-row">
                    <div class="activity-icon"><i class="fa-solid fa-mug-hot"></i></div>
                    <div class="activity-text">
                        <strong>Belum ada aktivitas terbaru</strong>
                        <span>Aktivitas akan muncul setelah ada ujian atau siswa yang menyelesaikan ujian.</span>
                    </div>
                    <div class="activity-time">&mdash;</div>
                </div>
            `;

            return;

        }

        list.innerHTML = activities.map(function (item) {

            const type = item.type === "hasil" ? "hasil" : "ujian";

            return `
                <div class="activity-row" data-type="${type}">
                    <div class="activity-icon"><i class="${item.icon}"></i></div>
                    <div class="activity-text">
                        <strong>${item.title}</strong>
                        <span>${item.desc}</span>
                    </div>
                    <div class="activity-time">${item.time_human ?? ''}</div>
                </div>
            `;

        }).join("");

        const activeFilterBtn = document.querySelector('#activityFilter button.active');

        if (activeFilterBtn) activeFilterBtn.click();

    }

    function updateNotificationPanel(activities) {

        const panel = document.getElementById("notificationPanel");

        if (!panel || !activities) return;

        const headHtml = '<div class="notification-panel-head">NOTIFIKASI TERBARU</div>';

        if (!activities.length) {

            panel.innerHTML = headHtml + '<div class="notification-panel-empty">Belum ada notifikasi baru.</div>';

            return;

        }

        panel.innerHTML = headHtml + activities.map(function (item) {

            return `
                <div class="notification-panel-item">
                    <i class="${item.icon}"></i>
                    <div>
                        <strong>${item.title}</strong>
                        <span>${item.desc} &middot; ${item.time_human ?? ''}</span>
                    </div>
                </div>
            `;

        }).join("");

    }

    setInterval(refreshDashboardData, REFRESH_INTERVAL_MS);

</script>

</body>

</html>