<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Absensi Pramuka – SMPN 1 Plumbon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* =============================================
           DESIGN SYSTEM — PRAMUKA SMPN 1 PLUMBON
        ============================================= */
        :root {
            --c-forest:      #1B3A2D;
            --c-forest-mid:  #2E5E47;
            --c-forest-soft: #3D7A5C;
            --c-gold:        #C9952A;
            --c-gold-light:  #F0BD5B;
            --c-cream:       #FAF7F2;
            --c-parchment:   #F2EDE3;
            --c-ink:         #1C1C1E;
            --c-muted:       #6B7280;
            --c-border:      rgba(27,58,45,0.12);
            --c-white:       #FFFFFF;

            --sidebar-w:     260px;
            --navbar-h:      64px;

            --radius-sm:     10px;
            --radius-md:     18px;
            --radius-lg:     28px;
            --radius-pill:   999px;

            --shadow-sm:  0 2px 8px rgba(0,0,0,.06);
            --shadow-md:  0 8px 24px rgba(0,0,0,.08);
            --shadow-lg:  0 20px 50px rgba(0,0,0,.12);

            --font-display: 'Cormorant Garamond', serif;
            --font-body:    'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--c-cream);
            font-family: var(--font-body);
            color: var(--c-ink);
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Typography ── */
        h1, h2, h3, h4, h5, h6, .serif {
            font-family: var(--font-display);
            font-weight: 600;
            letter-spacing: .02em;
        }

        /* =======================================
           TOP NAVBAR
        ======================================= */
        .navbar-top {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--navbar-h);
            background: var(--c-forest);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1040;
            box-shadow: 0 2px 16px rgba(0,0,0,.18);
        }

        /* decorative gold line at bottom of navbar */
        .navbar-top::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--c-gold-light), var(--c-gold), var(--c-gold-light));
        }

        .navbar-brand-text {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--c-white);
            letter-spacing: .04em;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 auto;
        }

        .navbar-brand-text .brand-icon {
            width: 34px; height: 34px;
            background: var(--c-gold);
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: var(--c-forest);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .navbar-user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            padding: 6px 14px;
            border-radius: var(--radius-pill);
            color: var(--c-white);
            font-size: .82rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .navbar-user-pill i { color: var(--c-gold-light); }

        .mobile-menu-btn {
            background: none;
            border: none;
            color: var(--c-white);
            font-size: 1.6rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            transition: background .2s;
        }
        .mobile-menu-btn:hover { background: rgba(255,255,255,.1); }

        /* =======================================
           SIDEBAR — DESKTOP
        ======================================= */
        .sidebar-desktop {
            position: fixed;
            top: var(--navbar-h);
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: var(--c-forest);
            overflow-y: auto;
            z-index: 1030;
            padding: 28px 16px 24px;
            display: flex;
            flex-direction: column;
        }

        /* Subtle diagonal texture overlay */
        .sidebar-desktop::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(
                    45deg,
                    rgba(255,255,255,.012) 0px,
                    rgba(255,255,255,.012) 1px,
                    transparent 1px,
                    transparent 12px
                );
            pointer-events: none;
        }

        .sidebar-identity {
            text-align: center;
            padding: 12px 0 24px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 20px;
        }

        .sidebar-logo-ring {
            width: 62px; height: 62px;
            border-radius: 50%;
            border: 2px solid var(--c-gold);
            background: rgba(201,149,42,.12);
            display: grid;
            place-items: center;
            margin: 0 auto 10px;
            color: var(--c-gold-light);
            font-size: 1.8rem;
        }

        .sidebar-gudep {
            color: rgba(255,255,255,.5);
            font-size: .72rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .sidebar-school {
            color: var(--c-white);
            font-family: var(--font-display);
            font-size: .95rem;
            margin-top: 3px;
        }

        /* Nav section labels */
        .sidebar-section-label {
            font-size: .65rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: rgba(255,255,255,.35);
            padding: 16px 12px 6px;
            font-weight: 600;
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: var(--radius-md);
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 3px;
            position: relative;
        }

        .sidebar-nav-link i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-nav-link:hover {
            background: rgba(255,255,255,.07);
            color: var(--c-white);
            transform: translateX(2px);
        }

        .sidebar-nav-link.active {
            background: linear-gradient(135deg, var(--c-gold), #D4A840);
            color: var(--c-forest);
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(201,149,42,.35);
        }

        .sidebar-nav-link.active i { color: var(--c-forest); }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,.1);
            margin: 12px 0;
        }

        .sidebar-logout {
            color: rgba(255,100,100,.7);
        }
        .sidebar-logout:hover {
            background: rgba(255,80,80,.08);
            color: #ff8080;
        }

        /* =======================================
           MAIN CONTENT
        ======================================= */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            padding-top: calc(var(--navbar-h) + 28px);
            padding-right: 32px;
            padding-bottom: 40px;
            padding-left: 32px;
            min-height: 100vh;
        }

        /* =======================================
           REUSABLE COMPONENTS
        ======================================= */

        /* Card */
        .card-scout {
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow .25s, transform .25s;
        }
        .card-scout:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .card-scout-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-scout-icon {
            width: 40px; height: 40px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
            display: grid;
            place-items: center;
            color: var(--c-forest);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .card-scout-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--c-forest);
        }

        .card-scout-body {
            padding: 24px;
        }

        /* Stat Card */
        .stat-card {
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-md);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow .2s, transform .2s;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 50px; height: 50px;
            border-radius: var(--radius-sm);
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-icon.green  { background: rgba(46,94,71,.1);  color: var(--c-forest-mid); }
        .stat-icon.gold   { background: rgba(201,149,42,.12); color: var(--c-gold); }
        .stat-icon.red    { background: rgba(185,50,50,.08);  color: #b93232; }
        .stat-icon.blue   { background: rgba(59,130,246,.08); color: #3b82f6; }

        .stat-value {
            font-family: var(--font-display);
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--c-forest);
            line-height: 1;
        }

        .stat-label {
            font-size: .78rem;
            color: var(--c-muted);
            font-weight: 500;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* Identity / Info Bar */
        .info-bar {
            background: linear-gradient(135deg, var(--c-forest) 0%, var(--c-forest-mid) 100%);
            border-radius: var(--radius-md);
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            color: var(--c-white);
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .info-bar::after {
            content: '\F591'; /* bi-tree-fill */
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 24px;
            font-size: 5rem;
            color: rgba(255,255,255,.06);
            top: 50%;
            transform: translateY(-50%);
        }

        .info-bar-avatar {
            width: 46px; height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            border: 2px solid var(--c-gold-light);
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            color: var(--c-gold-light);
        }

        .info-bar-name {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 600;
        }

        .info-bar-meta {
            font-size: .78rem;
            color: rgba(255,255,255,.6);
        }

        /* Buttons */
        .btn-scout {
            background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
            color: var(--c-forest);
            font-weight: 600;
            border-radius: var(--radius-pill);
            padding: 10px 26px;
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
            font-size: .875rem;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(201,149,42,.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }
        .btn-scout:hover {
            background: linear-gradient(135deg, #f5c95e, #c9952a);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(201,149,42,.38);
            color: var(--c-forest);
        }

        .btn-scout-outline {
            background: transparent;
            border: 1.5px solid var(--c-forest-soft);
            color: var(--c-forest);
            border-radius: var(--radius-pill);
            padding: 9px 24px;
            font-weight: 500;
            font-size: .875rem;
            cursor: pointer;
            font-family: var(--font-body);
            transition: all .2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }
        .btn-scout-outline:hover {
            background: var(--c-forest);
            color: var(--c-white);
            border-color: var(--c-forest);
        }

        /* Badge-style status */
        .badge-hadir   { background: rgba(46,94,71,.1);    color: var(--c-forest-mid); }
        .badge-izin    { background: rgba(201,149,42,.12); color: #a07820; }
        .badge-alfa    { background: rgba(185,50,50,.08);  color: #b93232; }

        .status-badge {
            padding: 3px 12px;
            border-radius: var(--radius-pill);
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .04em;
        }

        /* Table */
        .table-scout {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-scout thead th {
            background: var(--c-parchment);
            color: var(--c-forest);
            font-family: var(--font-display);
            font-size: .85rem;
            font-weight: 700;
            letter-spacing: .04em;
            padding: 12px 16px;
            border-bottom: 2px solid var(--c-border);
        }

        .table-scout thead th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        .table-scout thead th:last-child  { border-radius: 0 var(--radius-sm) 0 0; }

        .table-scout tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid rgba(27,58,45,.06);
            color: var(--c-ink);
            vertical-align: middle;
        }

        .table-scout tbody tr:hover td {
            background: rgba(27,58,45,.025);
        }

        .table-scout tbody tr:last-child td { border-bottom: none; }

        /* Form controls */
        .form-scout .form-label {
            font-weight: 600;
            font-size: .82rem;
            color: var(--c-forest);
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .form-scout .form-control,
        .form-scout .form-select {
            border: 1.5px solid var(--c-border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-family: var(--font-body);
            font-size: .875rem;
            background: var(--c-white);
            color: var(--c-ink);
            transition: border-color .2s, box-shadow .2s;
        }

        .form-scout .form-control:focus,
        .form-scout .form-select:focus {
            border-color: var(--c-gold);
            box-shadow: 0 0 0 3px rgba(201,149,42,.15);
            outline: none;
        }

        /* Page header */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header-eyebrow {
            font-size: .72rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--c-gold);
            font-weight: 600;
        }

        .page-header-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--c-forest);
            line-height: 1.15;
        }

        .page-header-sub {
            color: var(--c-muted);
            font-size: .875rem;
            margin-top: 4px;
        }

        /* =======================================
           FOOTER
        ======================================= */
        .footer-scout {
            background: var(--c-parchment);
            border-top: 1px solid var(--c-border);
            padding: 20px 32px;
            margin-top: 40px;
            font-size: .75rem;
            color: var(--c-muted);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .footer-scout .footer-brand {
            font-family: var(--font-display);
            font-weight: 600;
            color: var(--c-forest);
            font-size: .85rem;
        }

        /* =======================================
           MOBILE BOTTOM NAV
        ======================================= */
        .mobile-bottom-nav {
            display: none;
        }

        /* =======================================
           RESPONSIVE
        ======================================= */
        @media (max-width: 991.98px) {
            .sidebar-desktop { display: none; }
            .main-wrapper {
                margin-left: 0;
                padding: calc(var(--navbar-h) + 20px) 16px 80px;
            }
            .navbar-user-pill { display: none; }
            .page-header-title { font-size: 1.5rem; }
            .stat-value { font-size: 1.5rem; }

            .mobile-bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0; left: 0; right: 0;
                background: var(--c-white);
                border-top: 1px solid var(--c-border);
                z-index: 1040;
                box-shadow: 0 -4px 20px rgba(0,0,0,.08);
            }

            .mobile-nav-item {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                padding: 10px 4px 12px;
                color: var(--c-muted);
                text-decoration: none;
                font-size: .65rem;
                font-weight: 500;
                transition: color .2s;
            }

            .mobile-nav-item i { font-size: 1.35rem; }

            .mobile-nav-item.active {
                color: var(--c-forest);
                font-weight: 600;
            }

            .mobile-nav-item.active i {
                color: var(--c-gold);
            }
        }

        /* =======================================
           OFFCANVAS MOBILE MENU
        ======================================= */
        .offcanvas-scout {
            max-width: 280px;
            background: var(--c-forest);
        }

        .offcanvas-scout .offcanvas-header {
            border-bottom: 1px solid rgba(255,255,255,.1);
            padding: 18px 20px;
        }

        .offcanvas-scout .offcanvas-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            color: var(--c-white);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .offcanvas-scout .offcanvas-body {
            padding: 16px;
        }

        /* Page load animation */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeSlideUp .45s ease both;
        }

        .animate-in:nth-child(1) { animation-delay: .05s; }
        .animate-in:nth-child(2) { animation-delay: .12s; }
        .animate-in:nth-child(3) { animation-delay: .19s; }
        .animate-in:nth-child(4) { animation-delay: .26s; }
        .animate-in:nth-child(5) { animation-delay: .33s; }

    </style>
</head>
<body>

<?php if(isset($_SESSION['user_id']) && isset($_SESSION['nama_lengkap'])): ?>

<!-- ══════════════════════════════
     TOP NAVBAR
══════════════════════════════ -->
<nav class="navbar-top">
    <!-- Mobile menu button (hidden on desktop) -->
    <button class="mobile-menu-btn d-lg-none"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasMenu"
            aria-label="Buka menu">
        <i class="bi bi-list"></i>
    </button>

    <!-- Brand -->
    <a href="#" class="navbar-brand-text">
        <span class="brand-icon"><i class="bi bi-tree-fill"></i></span>
        Pramuka SMPN 1 Plumbon
    </a>

    <!-- User pill (desktop) -->
    <div class="navbar-user-pill">
        <i class="bi bi-person-circle"></i>
        <?= htmlspecialchars($_SESSION['nama_lengkap']) ?>
    </div>
</nav>

<!-- ══════════════════════════════
     OFFCANVAS — MOBILE SIDEBAR
══════════════════════════════ -->
<div class="offcanvas offcanvas-start offcanvas-scout"
     tabindex="-1"
     id="offcanvasMenu">
    <div class="offcanvas-header">
        <span class="offcanvas-title">
            <i class="bi bi-compass" style="color:var(--c-gold-light)"></i>
            Menu Navigasi
        </span>
        <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"
                aria-label="Tutup"></button>
    </div>
    <div class="offcanvas-body">

        <?php if($_SESSION['role'] == 'admin'): ?>
            <div class="sidebar-section-label">Admin</div>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/dashboard">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/users">
                <i class="bi bi-people"></i> Kelola User
            </a>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/sesi">
                <i class="bi bi-calendar-event"></i> Kelola Sesi
            </a>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/laporan">
                <i class="bi bi-bar-chart-steps"></i> Laporan Pertemuan
            </a>
        <?php else: ?>
            <div class="sidebar-section-label">Anggota</div>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/dashboard">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/absen">
                <i class="bi bi-qr-code-scan"></i> Absen QR
            </a>
            <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/izin">
                <i class="bi bi-envelope-paper"></i> Izin / Sakit
            </a>
        <?php endif; ?>

        <hr class="sidebar-divider">

        <div class="sidebar-section-label">Akun</div>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AuthController/gantiPassword">
            <i class="bi bi-key"></i> Ganti Password
        </a>
        <a class="sidebar-nav-link sidebar-logout" href="<?= BASE_URL ?>/AuthController/logout">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>
</div>

<!-- ══════════════════════════════
     DESKTOP SIDEBAR
══════════════════════════════ -->
<aside class="sidebar-desktop d-none d-lg-flex flex-column">

    <div class="sidebar-identity">
        <div class="sidebar-logo-ring">
            <i class="bi bi-tree-fill"></i>
        </div>
        <div class="sidebar-gudep">Gudep 31.079–31.080</div>
        <div class="sidebar-school">SMPN 1 Plumbon</div>
    </div>

    <?php if($_SESSION['role'] == 'admin'): ?>
        <div class="sidebar-section-label">Admin</div>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/dashboard">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/users">
            <i class="bi bi-people"></i> Kelola User
        </a>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/sesi">
            <i class="bi bi-calendar-event"></i> Kelola Sesi
        </a>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AdminController/laporan">
            <i class="bi bi-bar-chart-steps"></i> Laporan Pertemuan
        </a>
    <?php else: ?>
        <div class="sidebar-section-label">Anggota</div>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/dashboard">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/absen">
            <i class="bi bi-qr-code-scan"></i> Absen QR
        </a>
        <a class="sidebar-nav-link" href="<?= BASE_URL ?>/UserController/izin">
            <i class="bi bi-envelope-paper"></i> Izin / Sakit
        </a>
    <?php endif; ?>

    <hr class="sidebar-divider">

    <div class="sidebar-section-label">Akun</div>
    <a class="sidebar-nav-link" href="<?= BASE_URL ?>/AuthController/gantiPassword">
        <i class="bi bi-key"></i> Ganti Password
    </a>

    <div class="mt-auto pt-4">
        <a class="sidebar-nav-link sidebar-logout" href="<?= BASE_URL ?>/AuthController/logout">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>
</aside>

<!-- ══════════════════════════════
     MAIN CONTENT WRAPPER
══════════════════════════════ -->
<main class="main-wrapper">

    <!-- User identity bar (shows at top of content) -->
    <div class="info-bar animate-in">
        <div class="info-bar-avatar">
            <i class="bi bi-person-fill"></i>
        </div>
        <div>
            <div class="info-bar-name"><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></div>
            <div class="info-bar-meta">
                <?= $_SESSION['role'] == 'admin' ? 'Administrator' : 'Anggota Pramuka' ?>
                &nbsp;·&nbsp; Gudep 31.079–31.080
            </div>
        </div>
    </div>

    <!-- ↓ Page-specific content injected here ↓ -->

<?php else: ?>

<!-- ══════════════════════════════
     LOGIN PAGE WRAPPER
══════════════════════════════ -->
<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background: linear-gradient(135deg, var(--c-forest) 0%, var(--c-forest-mid) 60%, #1e4a38 100%); padding: 20px;">
    <div class="w-100" style="max-width: 420px;">

        <!-- Logo area -->
        <div class="text-center mb-4">
            <div style="
                width: 72px; height: 72px;
                border-radius: 50%;
                background: rgba(255,255,255,.1);
                border: 2px solid var(--c-gold-light);
                display: grid; place-items: center;
                margin: 0 auto 14px;
                font-size: 2rem;
                color: var(--c-gold-light);
            ">
                <i class="bi bi-tree-fill"></i>
            </div>
            <h1 style="font-family: var(--font-display); font-size: 1.6rem; color: white; font-weight: 700;">
                Pramuka SMPN 1 Plumbon
            </h1>
            <p style="color: rgba(255,255,255,.5); font-size: .8rem; letter-spacing: .12em; text-transform: uppercase; margin-top: 6px;">
                Gudep 31.079–31.080
            </p>
        </div>

        <!-- Login Card -->
        <div class="card-scout p-4" style="border-radius: var(--radius-lg);">

<?php endif; ?>

<!-- ══════════════════════════════
     MOBILE BOTTOM NAV
══════════════════════════════ -->
<?php if(isset($_SESSION['user_id'])): ?>
<nav class="mobile-bottom-nav d-lg-none">
    <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="<?= BASE_URL ?>/AdminController/dashboard"  class="mobile-nav-item active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="<?= BASE_URL ?>/AdminController/users"       class="mobile-nav-item">
            <i class="bi bi-people"></i> Users
        </a>
        <a href="<?= BASE_URL ?>/AdminController/sesi"        class="mobile-nav-item">
            <i class="bi bi-calendar-event"></i> Sesi
        </a>
        <a href="<?= BASE_URL ?>/AdminController/laporan"     class="mobile-nav-item">
            <i class="bi bi-bar-chart-steps"></i> Laporan
        </a>
    <?php else: ?>
        <a href="<?= BASE_URL ?>/UserController/dashboard"   class="mobile-nav-item active">
            <i class="bi bi-house-door"></i> Beranda
        </a>
        <a href="<?= BASE_URL ?>/UserController/absen"        class="mobile-nav-item">
            <i class="bi bi-qr-code-scan"></i> Absen
        </a>
        <a href="<?= BASE_URL ?>/UserController/izin"         class="mobile-nav-item">
            <i class="bi bi-envelope-paper"></i> Izin
        </a>
        <a href="<?= BASE_URL ?>/AuthController/logout"       class="mobile-nav-item">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    <?php endif; ?>
</nav>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* Auto-mark active nav link based on current URL */
document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;

    document.querySelectorAll('.sidebar-nav-link, .mobile-nav-item').forEach(el => {
        const href = el.getAttribute('href') || '';
        if (href && path.includes(href.split('/').slice(-2).join('/'))) {
            el.classList.add('active');
        } else {
            el.classList.remove('active');
        }
    });
});
</script>

</body>
</html>