<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $exam->nama_ujian }} - SIPANDAI</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
            --green-dark: #438153;
            --green-light: #e8f4eb;

            --sidebar-width: 245px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(143, 38, 53, .045), transparent 32%),
                var(--bg);
            color: var(--text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        body.sidebar-open,
        body.bulk-open { overflow: hidden; }

        button, input, textarea, select { font-family: inherit; }

        a {
            text-decoration: none;
            color: inherit;
            -webkit-tap-highlight-color: transparent;
        }


        

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(145deg, rgba(48, 27, 32, .97), rgba(29, 27, 29, .97));
            backdrop-filter: blur(24px) saturate(135%);
            -webkit-backdrop-filter: blur(24px) saturate(135%);
            border-right: 1px solid rgba(255,255,255,.09);
            z-index: 1200;
            transform: translateX(calc(-100% - 2px));
            transition: transform .45s cubic-bezier(.22,1,.36,1), box-shadow .45s ease;
            overflow: hidden;
            box-shadow: inset -1px 0 rgba(255,255,255,.025);
        }

        .sidebar::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            top: -120px;
            left: -120px;
            background: radial-gradient(circle, rgba(143,38,53,.42), transparent 68%);
            pointer-events: none;
        }

        .sidebar::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(255,255,255,.12), transparent);
            pointer-events: none;
        }

        .sidebar.show {
            transform: translateX(0);
            box-shadow: 18px 0 45px rgba(0,0,0,.18), inset -1px 0 rgba(255,255,255,.025);
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

        .sidebar-brand { display: flex; align-items: center; gap: 12px; }

        .sidebar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            background: transparent;
            border: none;
            border-radius: 0;
            filter: drop-shadow(0 5px 12px rgba(0,0,0,.22));
        }

        .sidebar-brand-text { display: flex; flex-direction: column; gap: 3px; }

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
            -webkit-tap-highlight-color: transparent;
            transition: .25s ease, transform .3s ease;
        }

        .close-sidebar:active {
            background: rgba(255,255,255,.16);
            color: #fff;
        }

        @media (hover: hover) {
            .close-sidebar:hover {
                background: rgba(255,255,255,.16);
                color: #fff;
                transform: rotate(90deg);
            }
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

        .sidebar-content::-webkit-scrollbar { width: 4px; }

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

        .sidebar-menu { display: flex; flex-direction: column; gap: 5px; }

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
            transition: background .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
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

        .menu-item:active {
            background: rgba(255,255,255,.065);
            color: #fff;
        }

        .menu-item:active i { color: #fff; }

        @media (hover: hover) {
            .menu-item:hover {
                background: rgba(255,255,255,.065);
                color: #fff;
                transform: translateX(2px);
            }

            .menu-item:hover i { color: #fff; }
        }

        .menu-item.active {
            background: linear-gradient(90deg, rgba(143,38,53,.74), rgba(143,38,53,.37));
            border-color: rgba(255,255,255,.08);
            color: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,.12), inset 0 1px rgba(255,255,255,.06);
        }

        .menu-item.active::before {
            content: "";
            position: absolute;
            left: -1px;
            top: 9px;
            bottom: 9px;
            width: 3px;
            background: #fff;
            border-radius: 0 4px 4px 0;
        }

        .menu-item.active i { color: #fff; }


        

        .sidebar-profile {
            margin-top: auto;
            padding: 15px;
            background: linear-gradient(145deg, rgba(255,255,255,.065), rgba(255,255,255,.025));
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
            background: linear-gradient(145deg, #a73a49, #741c29);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 5px 15px rgba(0,0,0,.18);
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
            -webkit-tap-highlight-color: transparent;
            transition: .25s ease;
        }

        .logout-link:active {
            background: rgba(143,38,53,.78);
            border-color: rgba(143,38,53,.9);
            color: #fff;
        }

        @media (hover: hover) {
            .logout-link:hover {
                background: rgba(143,38,53,.78);
                border-color: rgba(143,38,53,.9);
                color: #fff;
            }
        }


        

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.42);
            opacity: 0;
            visibility: hidden;
            transition: .25s ease;
            z-index: 1150;
        }

        .sidebar-overlay.show { opacity: 1; visibility: visible; }


        

        .main {
            position: relative;
            width: 100%;
            max-width: none;
            min-height: 100vh;
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            overflow: hidden;
            transition: margin-left .45s cubic-bezier(.22,1,.36,1), width .45s cubic-bezier(.22,1,.36,1);
        }

        body.sidebar-open .main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
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
            background: linear-gradient(180deg, rgba(27,26,26,.88), rgba(27,26,26,.72));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 7px 25px rgba(0,0,0,.12);
            z-index: 1050;
            transition: left .45s cubic-bezier(.22,1,.36,1), width .45s cubic-bezier(.22,1,.36,1);
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
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            transition: .25s ease;
        }

        .navbar-home-btn:active {
            background: rgba(255,255,255,.18);
            border-color: rgba(255,255,255,.2);
            color: #fff;
        }

        @media (hover: hover) {
            .navbar-home-btn:hover {
                background: rgba(255,255,255,.16);
                border-color: rgba(255,255,255,.2);
                color: #fff;
                transform: translateY(-1px);
            }
        }


        

        .navbar-logo-link {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            transition: transform .25s ease, opacity .2s ease;
        }

        .navbar-logo-link:active { opacity: .65; }

        @media (hover: hover) {
            .navbar-logo-link:hover { transform: scale(1.06); }
        }

        .navbar-logo {
            width: 35px;
            height: 35px;
            display: block;
            object-fit: contain;
            background: transparent;
            border: none;
            border-radius: 0;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,.18));
        }

        .navbar-title {
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
            
            padding: 8px 2px;
            margin: -8px -2px;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: -.2px;
            white-space: nowrap;
            cursor: pointer;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            transition: opacity .2s ease;
        }

        .breadcrumb-root::after {
            content: "";
            position: absolute;
            left: 2px;
            right: 2px;
            bottom: 5px;
            height: 1.5px;
            background: rgba(255,255,255,.85);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s cubic-bezier(.22,1,.36,1);
        }

        .breadcrumb-root:active { opacity: .65; }


        

        .breadcrumb-sep {
            flex-shrink: 0;
            color: rgba(255,255,255,.38);
            font-size: 8px;
            transition: color .25s ease, transform .25s ease;
        }


        

        .breadcrumb-link {
            position: relative;
            flex-shrink: 0;
            padding: 8px 2px;
            margin: -8px -2px;
            color: rgba(255,255,255,.6);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            white-space: nowrap;
            cursor: pointer;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            transition: color .25s ease, opacity .2s ease;
        }

        .breadcrumb-link:active {
            color: #fff;
            opacity: .65;
        }


        

        .breadcrumb-current {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-width: 0;
            padding: 5px 11px 5px 9px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(255,255,255,.16), rgba(255,255,255,.06));
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: inset 0 1px rgba(255,255,255,.08);
            cursor: pointer;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            transition: background .25s ease, border-color .25s ease, transform .25s ease, box-shadow .25s ease;
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
            min-width: 0;
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .breadcrumb-current:active {
            background: linear-gradient(135deg, rgba(255,255,255,.28), rgba(255,255,255,.12));
            border-color: rgba(255,255,255,.32);
        }

        @media (hover: hover) {

            .breadcrumb-root:hover::after { transform: scaleX(1); }

            .breadcrumb-link:hover { color: #fff; }

            .breadcrumb:hover .breadcrumb-sep {
                color: rgba(255,255,255,.7);
                transform: translateX(1px);
            }

            .breadcrumb-current:hover {
                background: linear-gradient(135deg, rgba(255,255,255,.26), rgba(255,255,255,.11));
                border-color: rgba(255,255,255,.32);
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(0,0,0,.25), inset 0 1px rgba(255,255,255,.1);
            }

        }

        .breadcrumb-root:focus-visible,
        .breadcrumb-link:focus-visible,
        .breadcrumb-current:focus-visible,
        .navbar-logo-link:focus-visible {
            outline: 2px solid rgba(255,255,255,.8);
            outline-offset: 3px;
        }

        .navbar-title-sub {
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
            gap: 17px;
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
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            transition: .25s ease;
        }

        .notification:active {
            background: rgba(255,255,255,.18);
            color: #fff;
        }

        @media (hover: hover) {
            .notification:hover {
                background: rgba(255,255,255,.16);
                color: #fff;
            }
        }

        .profile { display: flex; align-items: center; gap: 9px; }

        .profile-avatar {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(145deg, #a73a49, #741c29);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
        }

        .profile-info { display: flex; flex-direction: column; gap: 2px; }

        .profile-info strong { color: #fff; font-size: 11px; font-weight: 700; }

        .profile-info span {
            color: rgba(255,255,255,.42);
            font-size: 9px;
            font-weight: 500;
        }


        

        .content {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 96px 28px 40px;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-header-left { min-width: 0; }

        .page-title {
            color: var(--dark);
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -.7px;
            margin-bottom: 7px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            font-weight: 500;
        }


        

        .alert {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            margin-bottom: 18px;
            border-radius: 11px;
            font-size: 12px;
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


        

        .exam-card {
            position: relative;
            overflow: hidden;
            margin-bottom: 18px;
            padding: 25px 26px 18px;
            background: linear-gradient(135deg, #fff, #faf8f8);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(36,32,33,.055);
        }

        .exam-card::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            top: -95px;
            right: -65px;
            background: radial-gradient(circle, rgba(143,38,53,.08), transparent 70%);
            pointer-events: none;
        }

        .exam-card-top {
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .exam-name {
            color: var(--dark);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -.4px;
            margin-bottom: 7px;
        }

        .exam-meta {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-draft,
        .status-menunggu,
        .status-revisi { color: #8a6a20; background: #fbf3da; }

        .status-aktif,
        .status-active { color: #39724b; background: #e7f3ea; }

        .status-selesai { color: #676767; background: #eeeeee; }

        .status-ditolak { color: #8a3038; background: #fae9eb; }


        

        .info-grid {
            position: relative;
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            margin-top: 24px;
            border-top: 1px solid var(--border-light);
        }

        .info-item { padding: 17px 18px 4px 0; min-width: 0; }

        .info-item + .info-item {
            padding-left: 18px;
            border-left: 1px solid var(--border-light);
        }

        .info-label {
            color: var(--light-muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .info-value { color: var(--dark); font-size: 13px; font-weight: 700; }

        .info-value.code {
            color: var(--red);
            font-family: monospace;
            font-size: 14px;
            letter-spacing: .4px;
        }


        

        .exam-actions {
            position: relative;
            margin-top: 18px;
            padding-top: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-top: 1px solid var(--border-light);
        }

        .exam-action-right { display: flex; align-items: center; gap: 8px; }

        .exam-action-right form { margin: 0; }

        .exam-action-back,
        .exam-action-activate,
        .exam-action-finish {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .exam-action-back {
            border: 1px solid #dededa;
            background: transparent;
            color: #777;
        }

        .exam-action-back:hover {
            background: #f7f7f5;
            border-color: #d2d2cf;
            color: var(--dark);
            transform: translateY(-1px);
        }

        .exam-action-activate {
            border: 1px solid #cfe3d4;
            background: #eef7f0;
            color: #4e835d;
        }

        .exam-action-activate:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(67,129,83,.14);
        }

        .exam-action-finish {
            border: 1px solid var(--red);
            background: var(--red);
            color: #fff;
        }

        .exam-action-finish:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(143,38,53,.17);
        }


        

        .section-card {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(36,32,33,.045);
            margin-bottom: 18px;
        }

        .section-head {
            min-height: 74px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            border-bottom: 1px solid var(--border-light);
            background: #fff;
        }

        .section-title-wrap { display: flex; align-items: center; gap: 11px; min-width: 0; }

        .section-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: var(--red-light);
            color: var(--red);
            font-size: 12px;
        }

        .section-title {
            color: var(--dark);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: -.1px;
        }

        .section-count {
            color: #a0a0a0;
            font-size: 9px;
            font-weight: 600;
            margin-top: 3px;
        }


        

        .question-add-btn {
            min-height: 38px;
            padding: 0 12px 0 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid #e2d0d3;
            border-radius: 10px;
            background: #fff;
            color: var(--red);
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            transition: background .25s ease, border-color .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
            box-shadow: 0 3px 10px rgba(50,40,40,.035);
        }

        .question-add-icon {
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: var(--red-light);
            color: var(--red);
            font-size: 10px;
            transition: background .25s ease, color .25s ease;
        }

        .question-add-btn:hover {
            background: #fffafb;
            border-color: #d8b8bd;
            color: var(--red-dark);
            transform: translateY(-1px);
            box-shadow: 0 7px 17px rgba(50,40,40,.07);
        }

        .question-add-btn:hover .question-add-icon {
            background: var(--red);
            color: #fff;
        }


        

        .question-list { display: flex; flex-direction: column; }

        .question-item {
            padding: 21px 22px;
            border-bottom: 1px solid var(--border-light);
            transition: background .2s ease;
        }

        .question-item:hover { background: #fdfcfb; }

        .question-item:last-child { border-bottom: none; }

        .question-top { display: flex; align-items: flex-start; gap: 13px; }

        .question-number {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 9px;
            background: #f8ebed;
            color: var(--red);
            font-size: 10px;
            font-weight: 800;
        }

        .question-content { min-width: 0; flex: 1; }

        .question-text {
            color: var(--dark);
            font-size: 12px;
            line-height: 1.7;
            font-weight: 650;
            margin-bottom: 13px;
        }

        .question-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            padding-top: 1px;
        }

        .btn-icon {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 10px;
            transition: .2s ease;
        }

        .question-actions .btn-edit {
            border: 1px solid #dce9df;
            background: #f1f7f2;
            color: #538461;
        }

        .question-actions .btn-edit:hover {
            background: #538461;
            border-color: #538461;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(83,132,97,.12);
        }

        .question-actions .btn-delete {
            border: 1px solid #efdadd;
            background: #faf0f1;
            color: #9b3b47;
            cursor: pointer;
        }

        .question-actions .btn-delete:hover {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(143,38,53,.12);
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
            margin-left: 0;
        }

        .option {
            min-height: 39px;
            padding: 9px 11px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            border: 1px solid #ececea;
            border-radius: 8px;
            background: #fafaf9;
            color: #636363;
            font-size: 10px;
            line-height: 1.5;
        }

        .option-letter { color: #aaa; font-weight: 800; flex-shrink: 0; }

        .option.correct {
            border-color: #cfe4d4;
            background: #f1f8f3;
            color: #4c7357;
        }

        .option.correct .option-letter { color: #4d875e; }

        .empty-state { padding: 45px 25px; text-align: center; }

        .empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #f3f3f3;
            color: #aaa;
            font-size: 20px;
        }

        .empty-state strong {
            display: block;
            color: var(--dark);
            font-size: 13px;
            margin-bottom: 5px;
        }

        .empty-state p { color: var(--muted); font-size: 11px; }


        

        .footer {
            padding: 26px 0 5px;
            text-align: center;
            color: #aaa;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: .4px;
        }


        

        .bulk-modal {
            position: fixed;
            inset: 0;
            z-index: 5000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(20,18,19,.55);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity .25s ease, visibility .25s ease;
        }

        .bulk-modal.show { opacity: 1; visibility: visible; pointer-events: auto; }

        .bulk-modal-card {
            width: 100%;
            max-width: 960px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1px solid #e4e4e1;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 30px 85px rgba(0,0,0,.24);
            transform: translateY(16px) scale(.98);
            transition: transform .3s cubic-bezier(.22,1,.36,1);
        }

        .bulk-modal.show .bulk-modal-card { transform: translateY(0) scale(1); }

        .bulk-header {
            min-height: 76px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-light);
            flex-shrink: 0;
        }

        .bulk-header-left { display: flex; align-items: center; gap: 11px; }

        .bulk-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--red-light);
            color: var(--red);
            font-size: 13px;
        }

        .bulk-heading { display: flex; flex-direction: column; gap: 3px; }

        .bulk-heading strong { color: var(--dark); font-size: 13px; font-weight: 800; }

        .bulk-heading span { color: var(--muted); font-size: 9px; font-weight: 500; }

        .bulk-close {
            width: 33px;
            height: 33px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e4e4e1;
            border-radius: 9px;
            background: #fafaf8;
            color: #888;
            cursor: pointer;
            transition: .2s ease;
        }

        .bulk-close:hover {
            background: var(--red-light);
            color: var(--red);
            border-color: #e6c6cc;
        }

        .bulk-toolbar {
            min-height: 65px;
            padding: 13px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: #fafaf8;
            border-bottom: 1px solid var(--border-light);
            flex-shrink: 0;
        }

        .bulk-toolbar-left { display: flex; align-items: center; gap: 9px; flex-wrap: wrap; }

        .bulk-toolbar-label { color: var(--dark); font-size: 10px; font-weight: 800; }

        .bulk-count-input {
            width: 72px;
            height: 36px;
            padding: 0 9px;
            text-align: center;
            border: 1px solid #dcdcd9;
            border-radius: 8px;
            background: #fff;
            color: var(--dark);
            outline: none;
            font-size: 10px;
            font-weight: 700;
        }

        .bulk-count-input:focus {
            border-color: #c9959a;
            box-shadow: 0 0 0 3px rgba(143,38,53,.06);
        }

        .bulk-generate {
            height: 36px;
            padding: 0 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 1px solid var(--red);
            border-radius: 8px;
            background: var(--red);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .bulk-generate:hover { background: var(--red-dark); transform: translateY(-1px); }

        .bulk-note { color: #999; font-size: 9px; line-height: 1.4; }

        .bulk-body {
            flex: 1;
            min-height: 0;
            padding: 18px 22px;
            overflow-y: auto;
            background: #f6f6f4;
        }

        .bulk-body::-webkit-scrollbar { width: 5px; }

        .bulk-body::-webkit-scrollbar-thumb { background: #cfcfcb; border-radius: 10px; }

        .bulk-list { display: flex; flex-direction: column; gap: 13px; }

        .bulk-question {
            padding: 17px;
            background: #fff;
            border: 1px solid #e5e5e2;
            border-radius: 13px;
        }

        .bulk-question-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 9px;
            margin-bottom: 13px;
        }

        .bulk-question-head-left { display: flex; align-items: center; gap: 9px; }

        .bulk-question-number {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--red-light);
            color: var(--red);
            font-size: 10px;
            font-weight: 800;
        }

        .bulk-question-title { color: var(--dark); font-size: 11px; font-weight: 800; }

        .bulk-question-remove {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #efdadd;
            border-radius: 8px;
            background: #faf0f1;
            color: #9b3b47;
            font-size: 10px;
            cursor: pointer;
            transition: .2s ease;
        }

        .bulk-question-remove:hover {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .bulk-grid {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 10px;
        }

        .bulk-field { display: flex; flex-direction: column; gap: 6px; }

        .bulk-field.full { grid-column: 1 / -1; }

        .bulk-field label { color: #777; font-size: 8px; font-weight: 700; }

        .bulk-input,
        .bulk-textarea,
        .bulk-select {
            width: 100%;
            border: 1px solid #dededb;
            border-radius: 8px;
            background: #fafaf8;
            color: var(--dark);
            outline: none;
            font-family: inherit;
            font-size: 10px;
            transition: .2s ease;
        }

        .bulk-input,
        .bulk-select { height: 38px; padding: 0 10px; }

        .bulk-textarea {
            min-height: 72px;
            padding: 10px;
            resize: vertical;
            line-height: 1.5;
        }

        .bulk-input:focus,
        .bulk-textarea:focus,
        .bulk-select:focus {
            background: #fff;
            border-color: #c9959a;
            box-shadow: 0 0 0 3px rgba(143,38,53,.06);
        }

        .option-input-list { display: flex; flex-direction: column; gap: 8px; }

        .option-input-row { display: flex; align-items: center; gap: 10px; }

        .option-input-letter {
            width: 16px;
            flex-shrink: 0;
            color: var(--light-muted);
            font-size: 11px;
            font-weight: 800;
            text-align: left;
        }

        .answer-choice-group { display: flex; gap: 8px; }

        .answer-choice-btn {
            flex: none;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dededb;
            border-radius: 8px;
            background: #fafaf8;
            color: var(--dark);
            font-family: inherit;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .answer-choice-btn:hover { background: #fff; border-color: #c9959a; }

        .answer-choice-btn.selected {
            background: var(--green-dark);
            border-color: var(--green-dark);
            color: #fff;
        }

        .bulk-footer {
            min-height: 68px;
            padding: 14px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            background: #fff;
            border-top: 1px solid var(--border-light);
            flex-shrink: 0;
        }

        .bulk-footer-count { color: var(--muted); font-size: 10px; font-weight: 700; }

        .bulk-footer-right { display: flex; align-items: center; gap: 8px; }

        .bulk-btn-cancel,
        .bulk-btn-save {
            min-height: 38px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .bulk-btn-cancel { border: 1px solid #d9d9d6; background: #fff; color: #666; }

        .bulk-btn-cancel:hover { background: #f5f5f3; }

        .bulk-btn-save {
            border: 1px solid var(--red);
            background: var(--red);
            color: #fff;
            box-shadow: 0 5px 14px rgba(143,38,53,.14);
        }

        .bulk-btn-save:hover { background: var(--red-dark); transform: translateY(-1px); }

        .bulk-btn-save:disabled { opacity: .65; cursor: wait; transform: none; }


        

        
        @media (max-width: 1200px) {

            body.sidebar-open .profile-info { display: none; }

        }


        @media (max-width: 1100px) {

            .content { max-width: 100%; }

            .info-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }

            .info-item:nth-child(3) {
                padding-left: 0;
                border-left: none;
                border-top: 1px solid var(--border-light);
            }

            .info-item:nth-child(4) { border-top: 1px solid var(--border-light); }

        }


        @media (max-width: 900px) {

            body.sidebar-open .main { margin-left: 0; width: 100%; }

            body.sidebar-open .topbar { left: 0; width: 100%; }

            .topbar { padding: 0 20px; }

            .profile-info { display: none; }

            .content { padding-left: 20px; padding-right: 20px; }

        }


        
        @media (max-width: 700px) {

            .navbar-logo-link { display: none; }

        }


        
        @media (max-width: 640px) {

            .crumb-mid { display: none; }

        }


        @media (max-width: 760px) {

            .page-header { flex-direction: column; }

            .exam-card-top { flex-direction: column; }

            .options-grid { grid-template-columns: 1fr; }

            .question-top { position: relative; }

            .question-actions { margin-left: auto; }

            .section-head {
                align-items: flex-start;
                flex-direction: column;
                padding: 16px;
            }

            .question-add-btn { width: 100%; }

            .exam-actions { align-items: stretch; flex-direction: column; }

            .exam-action-right { width: 100%; }

            .exam-action-right form { width: 100%; }

            .exam-action-back,
            .exam-action-activate,
            .exam-action-finish { width: 100%; }

            .bulk-grid { grid-template-columns: 1fr; }

            .bulk-field.full { grid-column: auto; }

            .bulk-toolbar { align-items: flex-start; flex-direction: column; }

            .bulk-footer { flex-direction: column; align-items: stretch; }

        }


        @media (max-width: 650px) {

            .sidebar { width: 270px; }

            .topbar { padding: 0 20px; }

            .navbar-logo { width: 32px; height: 32px; }

            .navbar-title-sub { font-size: 7px; }

            .notification { width: 35px; height: 35px; }

            .content { padding: 86px 16px 30px; }

            .page-title { font-size: 23px; }

            .exam-card { padding: 20px; }

            .info-grid { grid-template-columns: 1fr; }

            .info-item,
            .info-item + .info-item {
                padding-left: 0;
                border-left: none;
                border-top: 1px solid var(--border-light);
            }

            .info-item:first-child { border-top: none; }

            .section-head { padding: 16px; }

            .question-item { padding: 17px; }

            .bulk-modal { padding: 10px; }

            .bulk-modal-card { max-height: 94vh; border-radius: 15px; }

            .bulk-header,
            .bulk-toolbar,
            .bulk-body,
            .bulk-footer { padding-left: 16px; padding-right: 16px; }

            .bulk-btn-cancel,
            .bulk-btn-save { width: 100%; }

        }


        @media (max-width: 500px) {

            .topbar-left { gap: 9px; }

            .navbar-home-btn { width: 36px; height: 36px; }

            .topbar-right { gap: 8px; }

            .profile { display: none; }

            .breadcrumb,
            .crumb { gap: 7px; }

            .breadcrumb-root { font-size: 13px; }

            .breadcrumb-current {
                padding: 5px 9px 5px 8px;
                font-size: 8.5px;
                letter-spacing: .8px;
            }

            .breadcrumb-current span { max-width: 150px; }

        }


        @media (max-width: 420px) {

            .sidebar { width: 280px; }

            .breadcrumb-root { font-size: 12px; }

            .navbar-title-sub { font-size: 6px; }

            .topbar { padding: 0 14px; }

        }


        @media (prefers-reduced-motion: reduce) {

            .breadcrumb-root::after,
            .breadcrumb-sep,
            .breadcrumb-link,
            .breadcrumb-current,
            .navbar-logo-link { transition: none; }

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

                <a href="{{ route('guru.dashboard') }}" class="menu-item">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('guru.exams.index') }}" class="menu-item active">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Kelola Ujian</span>
                </a>

                <a href="{{ route('guru.results.index') }}" class="menu-item">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Hasil Ujian</span>
                </a>

                <a href="{{ route('guru.data-siswa') }}" class="menu-item">
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

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">

                    @csrf

                    <button type="submit" class="logout-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </button>

                </form>

            </div>

        </div>

    </aside>


    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    

    <main class="main">


        

        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="navbar-home-btn"
                    id="navbarHomeBtn"
                    aria-label="Buka menu">

                    <i class="fa-solid fa-bars"></i>

                </button>


                

                <a
                    href="{{ route('guru.dashboard') }}"
                    class="navbar-logo-link"
                    aria-label="Ke Dashboard">

                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo SMKN 2 Kota Kediri"
                        class="navbar-logo">

                </a>


                <div class="navbar-title">

                    

                    <nav class="breadcrumb" aria-label="Breadcrumb">

                        <a
                            href="{{ route('guru.dashboard') }}"
                            class="breadcrumb-root">
                            SIPANDAI
                        </a>


                        <span class="crumb crumb-mid">

                            <i class="fa-solid fa-chevron-right breadcrumb-sep" aria-hidden="true"></i>

                            <a
                                href="{{ route('guru.exams.index') }}"
                                class="breadcrumb-link">
                                KELOLA UJIAN
                            </a>

                        </span>


                        <span class="crumb crumb-mid">

                            <i class="fa-solid fa-chevron-right breadcrumb-sep" aria-hidden="true"></i>

                            <a
                                href="{{ route('guru.exams.create') }}"
                                class="breadcrumb-link">
                                BUAT UJIAN
                            </a>

                        </span>


                        <span class="crumb">

                            <i class="fa-solid fa-chevron-right breadcrumb-sep" aria-hidden="true"></i>

                            <a
                                href="{{ route('guru.exams.index') }}"
                                class="breadcrumb-current"
                                aria-current="page">
                                <span>DETAIL UJIAN</span>
                            </a>

                        </span>

                    </nav>


                    <div class="navbar-title-sub">
                        SISTEM UJIAN DIGITAL
                    </div>

                </div>

            </div>


            <div class="topbar-right">

                <button
                    type="button"
                    class="notification"
                    aria-label="Notifikasi">

                    <i class="fa-regular fa-bell"></i>

                </button>

                <div class="profile">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                    </div>

                    <div class="profile-info">
                        <strong>{{ auth()->user()->name ?? 'Guru' }}</strong>
                        <span>Guru</span>
                    </div>

                </div>

            </div>

        </header>


        

        <div class="content">


            

            <div class="page-header">

                <div class="page-header-left">

                    <h1 class="page-title">
                        Detail Ujian
                    </h1>

                    <p class="page-subtitle">
                        Kelola informasi dan soal pada ujian yang telah dibuat.
                    </p>

                </div>

            </div>


            

            @if(session('success'))

                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>

            @endif


            

            @if(session('error'))

                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>

            @endif


            

            <section class="exam-card">

                <div class="exam-card-top">

                    <div>

                        <h2 class="exam-name">
                            {{ $exam->nama_ujian }}
                        </h2>

                        <p class="exam-meta">
                            {{ $exam->mata_pelajaran }}
                            <span>•</span>
                            {{ $exam->kelas }}
                        </p>

                    </div>


                    @php
                        $statusClass = strtolower(str_replace(' ', '-', $exam->status));
                    @endphp

                    <span class="status-badge status-{{ $statusClass }}">
                        {{ $exam->status }}
                    </span>

                </div>


                <div class="info-grid">

                    <div class="info-item">
                        <div class="info-label">Tanggal</div>
                        <div class="info-value">
                            {{ $exam->tanggal_ujian->format('d M Y') }}
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Waktu</div>
                        <div class="info-value">
                            {{ substr($exam->jam_mulai, 0, 5) }}
                            -
                            {{ substr($exam->jam_selesai, 0, 5) }}
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Durasi</div>
                        <div class="info-value">
                            {{ $exam->durasi }} menit
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Kode Ujian</div>
                        <div class="info-value code">
                            {{ $exam->kode_ujian }}
                        </div>
                    </div>

                </div>


                

                <div class="exam-actions">

                    <a
                        href="{{ route('guru.exams.edit', $exam->id) }}"
                        class="exam-action-back">

                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali

                    </a>


                    <div class="exam-action-right">

                        @if(strtolower($exam->status) === 'draft')

                            <form
                                action="{{ route('guru.exams.activate', $exam->id) }}"
                                method="POST"
                                onsubmit="return confirm('Aktifkan ujian ini sekarang?');">

                                @csrf

                                <button type="submit" class="exam-action-activate">
                                    <i class="fa-solid fa-play"></i>
                                    Aktifkan Ujian
                                </button>

                            </form>

                        @elseif(strtolower($exam->status) === 'aktif')

                            <form
                                action="{{ route('guru.exams.finish', $exam->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menyelesaikan ujian ini?');">

                                @csrf

                                <button type="submit" class="exam-action-finish">
                                    <i class="fa-solid fa-flag-checkered"></i>
                                    Selesaikan Ujian
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </section>


            

            <section class="section-card">

                <div class="section-head">

                    <div class="section-title-wrap">

                        <div class="section-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>

                        <div>
                            <div class="section-title">Daftar Soal</div>
                            <div class="section-count">
                                {{ $exam->questions->count() }} soal
                            </div>
                        </div>

                    </div>


                    

                    <button
                        type="button"
                        class="question-add-btn"
                        onclick="openBulkQuestionModal()">

                        <span class="question-add-icon">
                            <i class="fa-solid fa-plus"></i>
                        </span>

                        <span>Tambah Soal</span>

                    </button>

                </div>


                @if($exam->questions->count() > 0)

                    <div class="question-list">

                        @foreach($exam->questions as $index => $question)

                            <div class="question-item">

                                <div class="question-top">

                                    <div class="question-number">
                                        {{ $index + 1 }}
                                    </div>

                                    <div class="question-content">

                                        <div class="question-text">
                                            {{ $question->pertanyaan }}
                                        </div>

                                        <div class="options-grid">

                                            <div class="option {{ $question->jawaban_benar === 'A' ? 'correct' : '' }}">
                                                <span class="option-letter">A.</span>
                                                <span>{{ $question->pilihan_a }}</span>
                                            </div>

                                            <div class="option {{ $question->jawaban_benar === 'B' ? 'correct' : '' }}">
                                                <span class="option-letter">B.</span>
                                                <span>{{ $question->pilihan_b }}</span>
                                            </div>

                                            <div class="option {{ $question->jawaban_benar === 'C' ? 'correct' : '' }}">
                                                <span class="option-letter">C.</span>
                                                <span>{{ $question->pilihan_c }}</span>
                                            </div>

                                            <div class="option {{ $question->jawaban_benar === 'D' ? 'correct' : '' }}">
                                                <span class="option-letter">D.</span>
                                                <span>{{ $question->pilihan_d }}</span>
                                            </div>

                                        </div>

                                    </div>


                                    

                                    <div class="question-actions">

                                        <a
                                            href="{{ route('guru.questions.edit', [$exam->id, $question->id]) }}"
                                            class="btn-icon btn-edit"
                                            title="Edit soal">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <form
                                            action="{{ route('guru.questions.destroy', [$exam->id, $question->id]) }}"
                                            method="POST"
                                            style="margin: 0;"
                                            onsubmit="return confirm('Yakin ingin menghapus soal ini?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-icon btn-delete"
                                                title="Hapus soal">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="fa-regular fa-file-lines"></i>
                        </div>

                        <strong>Belum ada soal</strong>

                        <p>Tambahkan soal untuk mulai melengkapi ujian ini.</p>

                    </div>

                @endif

            </section>


            

            <footer class="footer">
                SIPANDAI © {{ date('Y') }} · Sistem Ujian Digital
            </footer>

        </div>

    </main>


    

    <div
        class="bulk-modal"
        id="bulkQuestionModal"
        data-existing-count="{{ $exam->questions->count() }}"
        data-store-url="{{ route('guru.questions.store', $exam->id, false) }}"
        data-redirect-url="{{ route('guru.exams.show', $exam->id, false) }}">

        <div class="bulk-modal-card">

            <div class="bulk-header">

                <div class="bulk-header-left">

                    <div class="bulk-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <div class="bulk-heading">
                        <strong>Tambah Banyak Soal</strong>
                        <span>Isi beberapa soal sekaligus</span>
                    </div>

                </div>

                <button
                    type="button"
                    class="bulk-close"
                    onclick="closeBulkQuestionModal()">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            <div class="bulk-toolbar">

                <div class="bulk-toolbar-left">

                    <span class="bulk-toolbar-label">
                        Tambah sekaligus
                    </span>

                    <input
                        type="number"
                        id="bulkCount"
                        class="bulk-count-input"
                        placeholder="Jumlah"
                        min="1"
                        max="100">

                    <button
                        type="button"
                        class="bulk-generate"
                        onclick="generateBulkQuestions()">

                        <i class="fa-solid fa-layer-group"></i>
                        Buat Form

                    </button>

                </div>

                <div class="bulk-note">
                    Isi jumlah soal yang diinginkan (misal 20), lalu klik "Buat Form". Maksimal 100 soal per sesi. Klik ikon hapus di tiap soal untuk membatalkannya.
                </div>

            </div>


            <div class="bulk-body">

                <div class="bulk-list" id="bulkQuestionList">

                    <div class="empty-state" id="bulkEmptyState">

                        <div class="empty-icon">
                            <i class="fa-regular fa-file-lines"></i>
                        </div>

                        <strong>Belum ada form soal</strong>

                        <p>
                            Masukkan jumlah lalu klik "Tambah Banyak", atau klik "Tambah 1 Soal" untuk menambah satu per satu.
                        </p>

                    </div>

                </div>

            </div>


            <div class="bulk-footer">

                <span class="bulk-footer-count" id="bulkFooterCount">
                    0 soal siap disimpan
                </span>

                <div class="bulk-footer-right">

                    <button
                        type="button"
                        class="bulk-btn-cancel"
                        onclick="closeBulkQuestionModal()">

                        Batal

                    </button>

                    <button
                        type="button"
                        class="bulk-btn-save"
                        id="bulkSaveButton"
                        onclick="saveAllBulkQuestions()">

                        <i class="fa-solid fa-check"></i>
                        <span>Simpan Semua Soal</span>

                    </button>

                </div>

            </div>

        </div>

    </div>


    

    <script>

        

        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");
        const navbarHomeBtn = document.getElementById("navbarHomeBtn");
        const closeSidebar = document.getElementById("closeSidebar");


        function openSidebar() {

            if (!sidebar || !sidebarOverlay) {
                return;
            }

            sidebar.classList.add("show");
            sidebarOverlay.classList.add("show");
            document.body.classList.add("sidebar-open");

        }


        function closeSidebarMenu() {

            if (!sidebar || !sidebarOverlay) {
                return;
            }

            sidebar.classList.remove("show");
            sidebarOverlay.classList.remove("show");
            document.body.classList.remove("sidebar-open");

        }


        if (navbarHomeBtn) {

            navbarHomeBtn.addEventListener("click", function () {

                if (sidebar && sidebar.classList.contains("show")) {
                    closeSidebarMenu();
                } else {
                    openSidebar();
                }

            });

        }


        if (closeSidebar) {
            closeSidebar.addEventListener("click", closeSidebarMenu);
        }


        if (sidebarOverlay) {
            sidebarOverlay.addEventListener("click", closeSidebarMenu);
        }


        document.addEventListener("keydown", function (event) {

            if (event.key === "Escape") {

                closeSidebarMenu();

                const modal = document.getElementById("bulkQuestionModal");

                if (modal && modal.classList.contains("show")) {
                    closeBulkQuestionModal();
                }

            }

        });


        document
            .querySelectorAll(".sidebar-menu .menu-item")
            .forEach(function (link) {

                link.addEventListener("click", function () {

                    if (window.innerWidth <= 900) {
                        closeSidebarMenu();
                    }

                });

            });


        window.addEventListener("resize", function () {

            if (window.innerWidth > 900 && sidebarOverlay) {
                sidebarOverlay.classList.remove("show");
            }

        });


        

        let bulkQuestionSeq = 0;


        function openBulkQuestionModal() {

            const modal = document.getElementById("bulkQuestionModal");

            if (!modal) {
                return;
            }

            modal.classList.add("show");
            document.body.classList.add("bulk-open");
            const list = document.getElementById("bulkQuestionList");

            if (list) {

                list.innerHTML = "";
                bulkQuestionSeq = 0;

                renderBulkEmptyState();
                updateBulkFooterCount();

            }

        }


        function closeBulkQuestionModal() {

            const modal = document.getElementById("bulkQuestionModal");

            if (!modal) {
                return;
            }

            modal.classList.remove("show");
            document.body.classList.remove("bulk-open");

        }


        function renderBulkEmptyState() {

            const list = document.getElementById("bulkQuestionList");

            if (!list) {
                return;
            }

            if (list.children.length > 0) {
                return;
            }

            const empty = document.createElement("div");

            empty.className = "empty-state";
            empty.id = "bulkEmptyState";

            empty.innerHTML = `

                <div class="empty-icon">
                    <i class="fa-regular fa-file-lines"></i>
                </div>

                <strong>
                    Belum ada form soal
                </strong>

                <p>
                    Masukkan jumlah lalu klik "Tambah Banyak", atau klik "Tambah 1 Soal" untuk menambah satu per satu.
                </p>

            `;

            list.appendChild(empty);

        }


        function removeBulkEmptyState() {

            const empty = document.getElementById("bulkEmptyState");

            if (empty) {
                empty.remove();
            }

        }


        

        function buildBulkQuestionCard() {

            bulkQuestionSeq += 1;

            const localId = bulkQuestionSeq;

            const card = document.createElement("div");

            card.className = "bulk-question";
            card.dataset.localId = localId;

            card.innerHTML = `

                <div class="bulk-question-head">

                    <div class="bulk-question-head-left">

                        <div class="bulk-question-number">
                            #
                        </div>

                        <div class="bulk-question-title">
                            Soal
                        </div>

                    </div>

                    <button
                        type="button"
                        class="bulk-question-remove"
                        title="Hapus soal ini"
                        onclick="removeBulkQuestion(${localId})">

                        <i class="fa-solid fa-trash"></i>

                    </button>

                </div>


                <div class="bulk-grid">


                    <div class="bulk-field full">

                        <label>
                            Pertanyaan
                        </label>

                        <textarea
                            class="bulk-textarea"
                            data-field="pertanyaan"
                            placeholder="Tuliskan pertanyaan..."
                            required></textarea>

                    </div>


                    <div class="bulk-field full">

                        <label>
                            Pilihan Jawaban
                        </label>

                        <div class="option-input-list">

                            <div class="option-input-row">

                                <span class="option-input-letter">a.</span>

                                <input
                                    type="text"
                                    class="bulk-input"
                                    data-field="pilihan_a"
                                    placeholder="Jawaban A"
                                    required>

                            </div>


                            <div class="option-input-row">

                                <span class="option-input-letter">b.</span>

                                <input
                                    type="text"
                                    class="bulk-input"
                                    data-field="pilihan_b"
                                    placeholder="Jawaban B"
                                    required>

                            </div>


                            <div class="option-input-row">

                                <span class="option-input-letter">c.</span>

                                <input
                                    type="text"
                                    class="bulk-input"
                                    data-field="pilihan_c"
                                    placeholder="Jawaban C"
                                    required>

                            </div>


                            <div class="option-input-row">

                                <span class="option-input-letter">d.</span>

                                <input
                                    type="text"
                                    class="bulk-input"
                                    data-field="pilihan_d"
                                    placeholder="Jawaban D"
                                    required>

                            </div>

                        </div>

                    </div>


                    <div class="bulk-field full">

                        <label>
                            Jawaban Benar
                        </label>

                        <div class="answer-choice-group" data-field="jawaban_benar">

                            <button type="button" class="answer-choice-btn" data-value="A">A</button>
                            <button type="button" class="answer-choice-btn" data-value="B">B</button>
                            <button type="button" class="answer-choice-btn" data-value="C">C</button>
                            <button type="button" class="answer-choice-btn" data-value="D">D</button>

                        </div>

                    </div>

                </div>

            `;

            return card;

        }


        

        document.addEventListener("click", function (e) {

            const btn = e.target.closest(".answer-choice-btn");

            if (!btn) {
                return;
            }

            const group = btn.closest(".answer-choice-group");

            if (!group) {
                return;
            }

            group.querySelectorAll(".answer-choice-btn")
                .forEach(b => b.classList.remove("selected"));

            btn.classList.add("selected");

            group.dataset.value = btn.dataset.value;

        });


        

        function generateBulkQuestions() {

            const countInput = document.getElementById("bulkCount");
            const list = document.getElementById("bulkQuestionList");

            if (!countInput || !list) {
                return;
            }

            let count = parseInt(countInput.value, 10);

            if (isNaN(count) || count < 1) {

                alert("Masukkan jumlah soal yang ingin dibuat (minimal 1).");

                countInput.focus();

                return;

            }

            if (count > 100) {

                count = 100;

                countInput.value = count;

            }

            removeBulkEmptyState();

            for (let i = 0; i < count; i++) {

                const card = buildBulkQuestionCard();

                list.appendChild(card);

            }

            renumberBulkQuestions();
            updateBulkFooterCount();

        }


        

        function removeBulkQuestion(localId) {

            const list = document.getElementById("bulkQuestionList");

            if (!list) {
                return;
            }

            const card = list.querySelector(
                `.bulk-question[data-local-id="${localId}"]`
            );

            if (card) {
                card.remove();
            }

            if (list.children.length === 0) {
                renderBulkEmptyState();
            }

            renumberBulkQuestions();
            updateBulkFooterCount();

        }


        

        function renumberBulkQuestions() {

            const modalEl = document.getElementById("bulkQuestionModal");

            const existingCount = modalEl
                ? (parseInt(modalEl.dataset.existingCount, 10) || 0)
                : 0;

            const cards = document.querySelectorAll(
                "#bulkQuestionList .bulk-question"
            );

            cards.forEach(function (card, i) {

                const displayNumber = existingCount + i + 1;

                const numberEl = card.querySelector(".bulk-question-number");
                const titleEl = card.querySelector(".bulk-question-title");
                const textareaEl = card.querySelector('[data-field="pertanyaan"]');

                if (numberEl) {
                    numberEl.textContent = displayNumber;
                }

                if (titleEl) {
                    titleEl.textContent = "Soal " + displayNumber;
                }

                if (textareaEl && !textareaEl.value) {
                    textareaEl.placeholder =
                        "Tuliskan pertanyaan soal " + displayNumber + "...";
                }

            });

        }


        

        function updateBulkFooterCount() {

            const footerCount = document.getElementById("bulkFooterCount");

            if (!footerCount) {
                return;
            }

            const total = document.querySelectorAll(
                "#bulkQuestionList .bulk-question"
            ).length;

            footerCount.textContent = total + " soal siap disimpan";

        }


        

        function getQuestionData(card) {

            const pertanyaan = card.querySelector('[data-field="pertanyaan"]');
            const opsiA = card.querySelector('[data-field="pilihan_a"]');
            const opsiB = card.querySelector('[data-field="pilihan_b"]');
            const opsiC = card.querySelector('[data-field="pilihan_c"]');
            const opsiD = card.querySelector('[data-field="pilihan_d"]');
            const jawabanBenarGroup = card.querySelector('[data-field="jawaban_benar"]');

            if (
                !pertanyaan ||
                !opsiA ||
                !opsiB ||
                !opsiC ||
                !opsiD ||
                !jawabanBenarGroup
            ) {
                return null;
            }

            return {
                pertanyaan: pertanyaan.value.trim(),
                pilihan_a: opsiA.value.trim(),
                pilihan_b: opsiB.value.trim(),
                pilihan_c: opsiC.value.trim(),
                pilihan_d: opsiD.value.trim(),
                jawaban_benar: jawabanBenarGroup.dataset.value || ""
            };

        }


        

        async function saveAllBulkQuestions() {

            const cards = document.querySelectorAll(
                "#bulkQuestionList .bulk-question"
            );

            if (!cards.length) {
                alert("Silakan tambah minimal 1 form soal terlebih dahulu.");
                return;
            }

            const questions = [];

            for (let i = 0; i < cards.length; i++) {

                const data = getQuestionData(cards[i]);

                if (!data) {
                    alert("Form soal nomor " + (i + 1) + " tidak ditemukan.");
                    return;
                }

                if (
                    !data.pertanyaan ||
                    !data.pilihan_a ||
                    !data.pilihan_b ||
                    !data.pilihan_c ||
                    !data.pilihan_d ||
                    !data.jawaban_benar
                ) {
                    alert("Soal nomor " + (i + 1) + " belum lengkap.");
                    return;
                }

                questions.push(data);
            }

            const saveButton = document.getElementById("bulkSaveButton");

            if (saveButton) {
                saveButton.disabled = true;
                saveButton.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i>' +
                    '<span>Menyimpan ' + questions.length + ' soal...</span>';
            }

            const csrfMeta = document.querySelector(
                'meta[name="csrf-token"]'
            );

            if (!csrfMeta) {
                alert("CSRF token tidak ditemukan.");
                resetBulkSaveButton();
                return;
            }

            const csrfToken = csrfMeta.getAttribute("content");
            const bulkModalEl = document.getElementById("bulkQuestionModal");
            const storeUrl = bulkModalEl
                ? bulkModalEl.dataset.storeUrl
                : "";
            const redirectUrl = bulkModalEl
                ? bulkModalEl.dataset.redirectUrl
                : "";

            if (!storeUrl) {
                alert("URL simpan soal tidak ditemukan.");
                resetBulkSaveButton();
                return;
            }

            try {

                
                const response = await fetch(storeUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        _token: csrfToken,
                        questions: questions
                    })
                });

                if (!response.ok) {

                    let message = "Gagal menyimpan soal.";

                    try {
                        const result = await response.json();
                        if (result.message) {
                            message = result.message;
                        }
                        if (result.errors) {
                            const firstError = Object.values(result.errors)
                                .flat()[0];
                            if (firstError) {
                                message = firstError;
                            }
                        }
                    } catch (e) {
                    }

                    throw new Error(message);
                }

                
                window.location.href =
                    redirectUrl || window.location.href;

            } catch (error) {

                console.error("Bulk Question Error:", error);

                alert(
                    error.message ||
                    "Terjadi kesalahan saat menyimpan soal."
                );

                resetBulkSaveButton();
            }
        }


        

        function resetBulkSaveButton() {

            const saveButton = document.getElementById("bulkSaveButton");

            if (!saveButton) {
                return;
            }

            saveButton.disabled = false;

            saveButton.innerHTML =
                '<i class="fa-solid fa-check"></i>' +
                '<span>Simpan Semua Soal</span>';

        }


        

        const bulkQuestionModal = document.getElementById("bulkQuestionModal");

        if (bulkQuestionModal) {

            bulkQuestionModal.addEventListener("click", function (event) {

                if (event.target === bulkQuestionModal) {
                    closeBulkQuestionModal();
                }

            });

        }


        

        const bulkCount = document.getElementById("bulkCount");

        if (bulkCount) {

            bulkCount.addEventListener("input", function () {
                if (this.value === "") {
                    return;
                }

                let value = parseInt(this.value, 10);

                if (!isNaN(value) && value > 100) {
                    this.value = 100;
                }

            });

        }

    </script>

</body>

</html>