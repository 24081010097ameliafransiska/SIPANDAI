<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian - SIPANDAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
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
            --green-dark: #4b865c;
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
            font-family: "Inter", sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        button,
        a {
            font-family: inherit;
        }

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
            text-decoration: none;
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

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.22);
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

        .topbar-page .page-title {
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

        .main-content {
            padding: 102px 34px 25px;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .main-content .page-title small {
            display: block;
            color: var(--red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .main-content .page-title h1 {
            color: var(--dark);
            font-size: 27px;
            line-height: 1.15;
            letter-spacing: -.8px;
            font-weight: 800;
        }

        .main-content .page-title p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 7px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .back-button:hover {
            border-color: var(--red-soft);
            color: var(--red);
            transform: translateY(-1px);
        }

        .exam-card {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 15px;
            padding: 21px 23px;
            margin-bottom: 18px;
            box-shadow: 0 4px 18px rgba(0,0,0,.025);
        }

        .exam-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .exam-name {
            color: var(--dark);
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .exam-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 7px 17px;
            margin-top: 9px;
        }

        .exam-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
        }

        .exam-meta i {
            color: var(--red);
            font-size: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 20px;
            background: var(--red-light);
            color: var(--red);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 13px;
            margin-bottom: 18px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 14px;
            padding: 18px 19px;
            display: flex;
            align-items: center;
            gap: 13px;
            box-shadow: 0 4px 18px rgba(0,0,0,.025);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 11px;
            background: var(--red-light);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .stat-info span {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-info strong {
            display: block;
            color: var(--dark);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .result-card {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0,0,0,.025);
        }

        .result-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 21px;
            border-bottom: 1px solid var(--border-light);
        }

        .result-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .result-card-title-icon {
            width: 35px;
            height: 35px;
            border-radius: 9px;
            background: var(--red-light);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .result-card-title h2 {
            color: var(--dark);
            font-size: 14px;
            font-weight: 800;
        }

        .result-card-title p {
            color: var(--light-muted);
            font-size: 10px;
            margin-top: 2px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        thead th {
            padding: 13px 20px;
            background: #fafafa;
            border-bottom: 1px solid var(--border-light);
            color: #888;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
            text-align: left;
            white-space: nowrap;
        }

        tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0ee;
            color: var(--text);
            font-size: 11px;
            font-weight: 500;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr {
            transition: background .18s ease;
        }

        tbody tr:hover {
            background: #fcfbfb;
        }

        .number-cell {
            width: 60px;
            color: #aaa;
            font-size: 10px;
            font-weight: 700;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-avatar {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--red-light);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }

        .student-info strong {
            display: block;
            color: var(--dark);
            font-size: 11px;
            font-weight: 700;
        }

        .student-info span {
            display: block;
            color: #aaa;
            font-size: 9px;
            margin-top: 3px;
        }

        .score {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 49px;
            padding: 6px 9px;
            border-radius: 7px;
            background: var(--red-light);
            color: var(--red);
            font-size: 11px;
            font-weight: 800;
        }

        .count-benar {
            color: var(--green-dark);
            font-weight: 700;
        }

        .count-salah {
            color: var(--red);
            font-weight: 700;
        }

        .submit-time {
            color: var(--muted);
            font-size: 10.5px;
            white-space: nowrap;
        }

        .foto-absen-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 10px 5px 5px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: #fafafa;
            cursor: pointer;
            transition: .2s ease;
        }

        .foto-absen-btn:hover {
            border-color: var(--red-soft);
            background: var(--red-light);
            transform: translateY(-1px);
        }

        .foto-absen-btn img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .foto-absen-btn span {
            color: var(--red);
            font-size: 10px;
            font-weight: 800;
        }

        .foto-absen-kosong {
            color: #bbb;
            font-size: 10px;
            font-style: italic;
        }

        .foto-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(20,15,14,.72);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 5000;
            padding: 24px;
        }

        .foto-modal-overlay.show {
            display: flex;
        }

        .foto-modal-box {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            max-width: 460px;
            width: 100%;
            box-shadow: 0 30px 70px rgba(0,0,0,.35);
        }

        .foto-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-light);
        }

        .foto-modal-header strong {
            font-size: 13px;
            font-weight: 800;
            color: var(--dark);
        }

        .foto-modal-close {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: 8px;
            background: #f2f2f2;
            color: var(--text);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .foto-modal-close:hover {
            background: var(--red);
            color: #fff;
        }

        .foto-modal-body {
            background: #eee;
        }

        .foto-modal-body img {
            width: 100%;
            max-height: 520px;
            display: block;
            object-fit: contain;
            background: #eee;
        }

        .foto-modal-footer {
            padding: 12px 18px;
            color: var(--muted);
            font-size: 10px;
        }

        .action-cell {
            min-width: 210px;
        }

        .retake-btn {
            border: 0;
            background: var(--red-light);
            color: var(--red);
            min-height: 32px;
            padding: 0 11px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 9px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .retake-btn:hover {
            background: var(--red);
            color: #fff;
            transform: translateY(-1px);
        }

        .retake-approved {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 32px;
            padding: 0 11px;
            border-radius: 8px;
            background: #eaf4ed;
            color: var(--green-dark);
            font-size: 9px;
            font-weight: 800;
        }

        .retake-processing {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 32px;
            padding: 0 11px;
            border-radius: 8px;
            background: #fff5df;
            color: #a87818;
            font-size: 9px;
            font-weight: 800;
        }

        .empty-state {
            padding: 55px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 13px;
            border-radius: 15px;
            background: #f5f5f5;
            color: #aaa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .empty-state h3 {
            color: var(--dark);
            font-size: 14px;
            font-weight: 800;
        }

        .empty-state p {
            color: #999;
            font-size: 10px;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            color: #aaa;
            font-size: 9px;
            padding: 23px 0 5px;
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

            .stats {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .exam-card-top {
                flex-direction: column;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 270px;
            }

            .topbar {
                padding: 0 20px;
            }

            .topbar-logo,
            .topbar-logo img {
                width: 32px;
                height: 32px;
            }

            .breadcrumb-root {
                font-size: 13px;
            }

            .breadcrumb-current {
                font-size: 8.5px;
                letter-spacing: .8px;
            }

            .breadcrumb-current span {
                max-width: 150px;
            }

            .notification {
                width: 35px;
                height: 35px;
            }

            .main-content {
                padding: 90px 15px 30px;
            }
        }

        @media (max-width: 450px) {
            .topbar {
                padding: 0 14px;
            }

            .topbar-left {
                gap: 8px;
            }

            .topbar-logo,
            .topbar-logo img {
                width: 33px;
                height: 33px;
            }

            .topbar-page {
                display: none;
            }

            .main-content {
                padding: 88px 14px 18px;
            }

            .main-content .page-title h1 {
                font-size: 24px;
            }

            .main-content .page-title p {
                line-height: 1.6;
            }

            .exam-card {
                padding: 18px;
            }

            .result-card-header {
                padding: 16px;
            }
        }

        @media (max-width: 420px) {
            .sidebar {
                width: 280px;
            }

            .topbar {
                padding: 0 14px;
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

        @media (max-width: 600px) {
            .crumb-mid {
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

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-brand">

                <img src="{{ asset('images/logo.jpg') }}"
                     alt="Logo SMKN 2 Kota Kediri"
                     class="sidebar-logo">

                <div class="sidebar-brand-text">
                    <strong>SIPANDAI</strong>
                    <span>SMKN 2 KOTA KEDIRI</span>
                </div>

            </div>

            <button type="button"
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

                <a href="{{ route('guru.dashboard') }}"
                   class="menu-item">

                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>

                </a>

                <a href="{{ route('guru.exams.index') }}"
                   class="menu-item">

                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Kelola Ujian</span>

                </a>

                <a href="{{ route('guru.results.index') }}"
                   class="menu-item active">

                    <i class="fa-solid fa-chart-column"></i>
                    <span>Hasil Ujian</span>

                </a>

                <a href="{{ route('guru.data-siswa') }}"
                   class="menu-item">

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

                        <span>
                            Akun Guru
                        </span>

                    </div>

                </div>

                <form method="POST"
                      action="{{ route('logout') }}"
                      style="margin: 0;">

                    @csrf

                    <button type="submit"
                            class="logout-link">

                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>

                    </button>

                </form>

            </div>

        </div>

    </aside>

    <div class="sidebar-overlay"
         id="sidebarOverlay">
    </div>

    <header class="topbar">

        <div class="topbar-left">

            <button type="button"
                    class="page-icon"
                    id="navbarHomeBtn"
                    aria-label="Buka menu">

                <i class="fa-solid fa-bars"></i>

            </button>

            <a href="{{ route('guru.dashboard') }}"
               class="topbar-logo"
               aria-label="Ke Dashboard">

                <img src="{{ asset('images/logo.jpg') }}"
                     alt="Logo SMKN 2 Kota Kediri">

            </a>

            <div class="topbar-page">

                <nav class="breadcrumb"
                     aria-label="Breadcrumb">

                    <a href="{{ route('guru.dashboard') }}"
                       class="breadcrumb-root">

                        SIPANDAI

                    </a>

                    <span class="crumb crumb-mid">

                        <i class="fa-solid fa-chevron-right breadcrumb-sep"
                           aria-hidden="true"></i>

                        <a href="{{ route('guru.results.index') }}"
                           class="breadcrumb-link">

                            HASIL UJIAN

                        </a>

                    </span>

                    <span class="crumb">

                        <i class="fa-solid fa-chevron-right breadcrumb-sep"
                           aria-hidden="true"></i>

                        <span class="breadcrumb-current"
                              aria-current="page">

                            <span>DETAIL HASIL UJIAN</span>

                        </span>

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

    <main class="main">

        <div class="main-content">

            <div class="container">

                <div class="page-header">

                    <div class="page-title">

                        <small>
                            DETAIL HASIL UJIAN
                        </small>

                        <h1>
                            Daftar Hasil Ujian Siswa
                        </h1>

                        <p>
                            Pantau hasil pengerjaan siswa pada ujian ini
                        </p>

                    </div>

                    <a href="{{ route('guru.results.index') }}"
                       class="back-button">

                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

                <section class="exam-card">

                    <div class="exam-card-top">

                        <div>

                            <div class="exam-name">
                                {{ $exam->nama_ujian }}
                            </div>

                            <div class="exam-meta">

                                <span>
                                    <i class="fa-solid fa-book"></i>
                                    {{ $exam->mata_pelajaran ?? 'Mata Pelajaran' }}
                                </span>

                                <span>
                                    <i class="fa-solid fa-users"></i>
                                    {{ $exam->kelas ?? 'Semua Kelas' }}
                                </span>

                                <span>
                                    <i class="fa-regular fa-calendar"></i>

                                    {{ $exam->tanggal_ujian
                                        ? \Carbon\Carbon::parse($exam->tanggal_ujian)->translatedFormat('d F Y')
                                        : '-' }}

                                </span>

                            </div>

                        </div>

                        <div class="status-badge">

                            <span class="status-dot"></span>

                            {{ ucfirst($exam->status ?? 'Ujian') }}

                        </div>

                    </div>

                </section>

                <section class="stats">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                PESERTA SELESAI
                            </span>

                            <strong id="apiPesertaSelesai">
                                {{ $results->count() }}
                            </strong>

                        </div>

                    </div>

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                RATA-RATA NILAI
                            </span>

                            <strong id="apiRataRata">
                                {{ $results->count() > 0
                                    ? number_format($results->avg('nilai'), 2, ',', '.')
                                    : '0,00' }}
                            </strong>

                        </div>

                    </div>

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="fa-solid fa-medal"></i>
                        </div>

                        <div class="stat-info">

                            <span>
                                NILAI TERTINGGI
                            </span>

                            <strong id="apiNilaiTertinggi">
                                {{ $results->count() > 0
                                    ? number_format($results->max('nilai'), 2, ',', '.')
                                    : '0,00' }}
                            </strong>

                        </div>

                    </div>

                </section>

                <section class="result-card">

                    <div class="result-card-header">

                        <div class="result-card-title">

                            <div class="result-card-title-icon">
                                <i class="fa-solid fa-table-list"></i>
                            </div>

                            <div>

                                <h2>
                                    Daftar Hasil Siswa
                                </h2>

                                <p>
                                    Nilai siswa yang telah mengumpulkan ujian
                                </p>

                            </div>

                        </div>

                    </div>

                    @if($results->count() > 0)

                        <div class="table-wrap">

                            <table>

                                <thead>

                                    <tr>

                                        <th>No</th>
                                        <th>Siswa</th>
                                        <th>Foto Absen</th>
                                        <th>Nilai</th>
                                        <th>Benar</th>
                                        <th>Salah</th>
                                        <th>Submit</th>
                                        <th>Aksi</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($results as $index => $result)

                                        @php

                                            $namaSiswa = $result->siswa->name ?? 'Siswa';

                                            $inisial = strtoupper(
                                                substr($namaSiswa, 0, 1)
                                            );

                                            $attempt = null;

                                            if ($result->siswa) {
                                                $attempt = $latestAttempts->get(
                                                    $result->siswa->id
                                                );
                                            }

                                            $fotoAbsenPath = null;

                                            if ($attempt && $attempt->foto_absen) {
                                                $fotoAbsenPath = $attempt->foto_absen;
                                            } elseif (!empty($result->foto_absen)) {
                                                $fotoAbsenPath = $result->foto_absen;
                                            }

                                            $fotoAbsenUrl = null;

                                            if ($fotoAbsenPath) {
                                                $fotoAbsenUrl = asset(
                                                    'storage/' . ltrim($fotoAbsenPath, '/')
                                                );
                                            }

                                            $jumlahBenar = $result->jumlah_benar ?? null;

                                            $jumlahSalah = $result->jumlah_salah ?? null;

                                            $submitTime = null;

                                            if ($result->submitted_at) {
                                                $submitTime = \Carbon\Carbon::parse(
                                                    $result->submitted_at
                                                )->timezone('Asia/Jakarta');
                                            }

                                        @endphp

                                        <tr
                                            data-result-id="{{ $result->id }}"
                                            data-siswa-id="{{ $result->siswa_id }}"
                                        >

                                            <td class="number-cell">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>

                                                <div class="student-cell">

                                                    <div class="student-avatar">
                                                        {{ $inisial }}
                                                    </div>

                                                    <div class="student-info">

                                                        <strong>
                                                            {{ $namaSiswa }}
                                                        </strong>

                                                        <span>
                                                            {{ $result->siswa->nisn ?? 'NISN belum tersedia' }}
                                                        </span>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>

                                                @if($fotoAbsenUrl)

                                                    <button
                                                        type="button"
                                                        class="foto-absen-btn"
                                                        data-foto="{{ $fotoAbsenUrl }}"
                                                        data-nama="{{ $namaSiswa }}"
                                                        onclick="bukaFotoAbsenDariTombol(this)">

                                                        <img
                                                            src="{{ $fotoAbsenUrl }}"
                                                            alt="Foto absen">

                                                        <span>
                                                            Foto
                                                        </span>

                                                    </button>

                                                @else

                                                    <span class="foto-absen-kosong">
                                                        Belum absen
                                                    </span>

                                                @endif

                                            </td>

                                            <td>

                                                <span class="score api-score">

                                                    {{ number_format(
                                                        (float) $result->nilai,
                                                        2,
                                                        ',',
                                                        '.'
                                                    ) }}

                                                </span>

                                            </td>

                                            <td>

                                                @if(!is_null($jumlahBenar))

                                                    <span class="count-benar api-benar">
                                                        {{ $jumlahBenar }}
                                                    </span>

                                                @else

                                                    <span class="foto-absen-kosong api-benar">
                                                        -
                                                    </span>

                                                @endif

                                            </td>

                                            <td>

                                                @if(!is_null($jumlahSalah))

                                                    <span class="count-salah api-salah">
                                                        {{ $jumlahSalah }}
                                                    </span>

                                                @else

                                                    <span class="foto-absen-kosong api-salah">
                                                        -
                                                    </span>

                                                @endif

                                            </td>

                                            <td>

                                                <span class="submit-time api-submit">

                                                    @if($submitTime)

                                                        {{ $submitTime->format('H:i') }}

                                                    @else

                                                        -

                                                    @endif

                                                </span>

                                            </td>

                                            <td class="action-cell">

                                                @if($attempt && $attempt->status === 'active')

                                                    <span class="retake-processing">

                                                        <i class="fa-solid fa-pen-to-square"></i>

                                                        Sedang Mengerjakan

                                                    </span>

                                                @elseif($attempt && $attempt->status === 'approved')

                                                    <span class="retake-approved">

                                                        <i class="fa-solid fa-circle-check"></i>

                                                        Ujian Ulang Diizinkan

                                                    </span>

                                                @else

                                                    <form
                                                        method="POST"
                                                        action="{{ route('guru.results.approve-retake', [$exam, $result->siswa]) }}"
                                                        style="margin:0;">

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="retake-btn"
                                                            data-nama="{{ $namaSiswa }}"
                                                            onclick="return konfirmasiRetake(this);">

                                                            <i class="fa-solid fa-rotate-right"></i>

                                                            Izinkan Ujian Ulang

                                                        </button>

                                                    </form>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="empty-state">

                            <div class="empty-icon">

                                <i class="fa-solid fa-clipboard-list"></i>

                            </div>

                            <h3>
                                Belum ada hasil ujian
                            </h3>

                            <p>
                                Hasil siswa akan muncul otomatis setelah mereka mengumpulkan ujian
                            </p>

                        </div>

                    @endif

                </section>

                <div class="footer">

                    SIPANDAI &copy; {{ date('Y') }} SMKN 2 Kota Kediri

                </div>

            </div>

        </div>

    </main>

    <div
        class="foto-modal-overlay"
        id="fotoModalOverlay"
        onclick="tutupFotoAbsenJikaOverlay(event)">

        <div
            class="foto-modal-box"
            onclick="event.stopPropagation()">

            <div class="foto-modal-header">

                <strong id="fotoModalNama">
                    Foto Absen
                </strong>

                <button
                    type="button"
                    class="foto-modal-close"
                    onclick="tutupFotoAbsen()">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

            <div class="foto-modal-body">

                <img
                    id="fotoModalImg"
                    src=""
                    alt="Foto absen siswa">

            </div>

            <div class="foto-modal-footer">

                Foto diambil otomatis lewat kamera saat siswa absen masuk ujian.

            </div>

        </div>

    </div>

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

                    tutupFotoAbsen();

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

        function bukaFotoAbsenDariTombol(tombol) {

            const url =
                tombol.getAttribute("data-foto");

            const nama =
                tombol.getAttribute("data-nama") || "Siswa";

            bukaFotoAbsen(url, nama);

        }

        function bukaFotoAbsen(url, namaSiswa) {

            const modal =
                document.getElementById(
                    "fotoModalOverlay"
                );

            const gambar =
                document.getElementById(
                    "fotoModalImg"
                );

            const nama =
                document.getElementById(
                    "fotoModalNama"
                );

            if (!url) {
                return;
            }

            gambar.src = url;

            gambar.alt =
                "Foto absen " + namaSiswa;

            nama.textContent =
                "Foto Absen - " + namaSiswa;

            modal.classList.add("show");

            document.body.style.overflow = "hidden";

        }

        function tutupFotoAbsen() {

            const modal =
                document.getElementById(
                    "fotoModalOverlay"
                );

            const gambar =
                document.getElementById(
                    "fotoModalImg"
                );

            if (!modal || !gambar) {
                return;
            }

            modal.classList.remove("show");

            gambar.src = "";

            document.body.style.overflow = "";

        }

        function tutupFotoAbsenJikaOverlay(event) {

            if (
                event.target &&
                event.target.id === "fotoModalOverlay"
            ) {

                tutupFotoAbsen();

            }

        }

        function konfirmasiRetake(button) {

            const nama =
                button.getAttribute("data-nama") || "siswa ini";

            return confirm(
                "Izinkan " +
                nama +
                " untuk mengikuti ujian ulang?"
            );

        }

        let sedangMemuatAPI = false;

        async function updateHasilDariAPI() {

            if (sedangMemuatAPI) {
                return;
            }

            sedangMemuatAPI = true;

            try {

                const examId = "{{ $exam->id }}";

                const apiUrl =
                    "{{ url('/guru/hasil-ujian') }}/" +
                    encodeURIComponent(examId) +
                    "/api";

                const response =
                    await fetch(
                        apiUrl,
                        {
                            method: "GET",

                            headers: {
                                "Accept": "application/json"
                            },

                            credentials: "same-origin",

                            cache: "no-store"
                        }
                    );

                if (!response.ok) {
                    return;
                }

                const payload =
                    await response.json();

                const apiResults =
                    Array.isArray(payload.data)
                        ? payload.data
                        : [];

                const pesertaElement =
                    document.getElementById(
                        "apiPesertaSelesai"
                    );

                const rataRataElement =
                    document.getElementById(
                        "apiRataRata"
                    );

                const nilaiTertinggiElement =
                    document.getElementById(
                        "apiNilaiTertinggi"
                    );

                if (pesertaElement) {

                    pesertaElement.textContent =
                        apiResults.length;

                }

                if (apiResults.length > 0) {

                    const nilaiList =
                        apiResults
                            .map(function (item) {
                                return Number(item.nilai);
                            })
                            .filter(function (nilai) {
                                return Number.isFinite(nilai);
                            });

                    if (nilaiList.length > 0) {

                        const totalNilai =
                            nilaiList.reduce(
                                function (total, nilai) {
                                    return total + nilai;
                                },
                                0
                            );

                        const rataRata =
                            totalNilai / nilaiList.length;

                        const nilaiTertinggi =
                            Math.max(...nilaiList);

                        if (rataRataElement) {

                            rataRataElement.textContent =
                                rataRata.toLocaleString(
                                    "id-ID",
                                    {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }
                                );

                        }

                        if (nilaiTertinggiElement) {

                            nilaiTertinggiElement.textContent =
                                nilaiTertinggi.toLocaleString(
                                    "id-ID",
                                    {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }
                                );

                        }

                    }

                } else {

                    if (rataRataElement) {
                        rataRataElement.textContent = "0,00";
                    }

                    if (nilaiTertinggiElement) {
                        nilaiTertinggiElement.textContent = "0,00";
                    }

                }

                apiResults.forEach(
                    function (apiResult) {

                        const resultId =
                            String(apiResult.id);

                        const siswaId =
                            apiResult.siswa_id
                                ? String(apiResult.siswa_id)
                                : null;

                        let row =
                            document.querySelector(
                                'tr[data-result-id="' +
                                resultId +
                                '"]'
                            );

                        if (
                            !row &&
                            siswaId
                        ) {

                            row =
                                document.querySelector(
                                    'tr[data-siswa-id="' +
                                    siswaId +
                                    '"]'
                                );

                        }

                        if (!row) {
                            return;
                        }

                        const scoreElement =
                            row.querySelector(
                                ".api-score"
                            );

                        const benarElement =
                            row.querySelector(
                                ".api-benar"
                            );

                        const salahElement =
                            row.querySelector(
                                ".api-salah"
                            );

                        const submitElement =
                            row.querySelector(
                                ".api-submit"
                            );

                        if (scoreElement) {

                            const nilai =
                                Number(
                                    apiResult.nilai ?? 0
                                );

                            scoreElement.textContent =
                                nilai.toLocaleString(
                                    "id-ID",
                                    {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }
                                );

                        }

                        if (benarElement) {

                            if (
                                apiResult.jumlah_benar !== null &&
                                apiResult.jumlah_benar !== undefined
                            ) {

                                benarElement.textContent =
                                    apiResult.jumlah_benar;

                                benarElement.classList.remove(
                                    "foto-absen-kosong"
                                );

                                benarElement.classList.add(
                                    "count-benar"
                                );

                            } else {

                                benarElement.textContent = "-";

                            }

                        }

                        if (salahElement) {

                            if (
                                apiResult.jumlah_salah !== null &&
                                apiResult.jumlah_salah !== undefined
                            ) {

                                salahElement.textContent =
                                    apiResult.jumlah_salah;

                                salahElement.classList.remove(
                                    "foto-absen-kosong"
                                );

                                salahElement.classList.add(
                                    "count-salah"
                                );

                            } else {

                                salahElement.textContent = "-";

                            }

                        }

                        if (submitElement) {

                            if (apiResult.submitted_at) {

                                const submittedAt =
                                    new Date(
                                        apiResult.submitted_at
                                    );

                                if (
                                    !Number.isNaN(
                                        submittedAt.getTime()
                                    )
                                ) {

                                    submitElement.textContent =
                                        submittedAt.toLocaleTimeString(
                                            "id-ID",
                                            {
                                                hour: "2-digit",
                                                minute: "2-digit",
                                                hour12: false,
                                                timeZone:
                                                    "Asia/Jakarta"
                                            }
                                        );

                                }

                            } else {

                                submitElement.textContent = "-";

                            }

                        }

                    }
                );

            } catch (error) {

                return;

            } finally {

                sedangMemuatAPI = false;

            }

        }

        setTimeout(
            updateHasilDariAPI,
            700
        );

        setInterval(
            updateHasilDariAPI,
            5000
        );

        let sedangMemuatHasil = false;

        async function updateHasilUjian() {

            if (sedangMemuatHasil) {
                return;
            }

            sedangMemuatHasil = true;

            try {

                const currentUrl =
                    new URL(
                        window.location.href
                    );

                currentUrl.searchParams.set(
                    "_refresh",
                    Date.now()
                );

                const response =
                    await fetch(
                        currentUrl.toString(),
                        {
                            method: "GET",

                            headers: {
                                "X-Requested-With":
                                    "XMLHttpRequest",

                                "Accept":
                                    "text/html",

                                "Cache-Control":
                                    "no-cache",

                                "Pragma":
                                    "no-cache"
                            },

                            cache: "no-store",

                            credentials:
                                "same-origin"
                        }
                    );

                if (!response.ok) {
                    return;
                }

                const html =
                    await response.text();

                const parser =
                    new DOMParser();

                const doc =
                    parser.parseFromString(
                        html,
                        "text/html"
                    );

                const statistikBaru =
                    doc.querySelector(
                        ".stats"
                    );

                const resultCardBaru =
                    doc.querySelector(
                        ".result-card"
                    );

                const statistikLama =
                    document.querySelector(
                        ".stats"
                    );

                const resultCardLama =
                    document.querySelector(
                        ".result-card"
                    );

                if (
                    statistikBaru &&
                    statistikLama
                ) {

                    statistikLama.replaceWith(
                        statistikBaru
                    );

                }

                if (
                    resultCardBaru &&
                    resultCardLama
                ) {

                    resultCardLama.replaceWith(
                        resultCardBaru
                    );

                }

            } catch (error) {

                return;

            } finally {

                sedangMemuatHasil = false;

            }

        }

        setTimeout(
            updateHasilUjian,
            1000
        );

        setInterval(
            updateHasilUjian,
            3000
        );

    </script>

</body>

</html>