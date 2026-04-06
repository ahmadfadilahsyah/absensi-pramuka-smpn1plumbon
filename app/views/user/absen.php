<!-- ── Page Title ── -->
<div class="scout-panel-header mb-4" style="border-radius:18px; padding: 14px 22px; display:flex; align-items:center; gap:9px;">
    <i class="bi bi-qr-code-scan"></i>
    <span>Absensi Latihan Hari Ini</span>
</div>

<?php if(isset($error)): ?>
<div class="login-alert mb-3">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<?php if(isset($success)): ?>
<div class="absen-alert-success mb-3">
    <i class="bi bi-check-circle-fill"></i>
    <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if(isset($sesi)): ?>

    <!-- ── Info Sesi ── -->
    <div class="sesi-info-card mb-4">
        <div class="sesi-info-header">
            <i class="bi bi-calendar2-check-fill"></i>
            <span><?= htmlspecialchars($sesi['nama_sesi']) ?></span>
        </div>
        <div class="sesi-info-body">
            <div class="sesi-info-item">
                <i class="bi bi-calendar3"></i>
                <span><?= date('d M Y', strtotime($sesi['tanggal'])) ?></span>
            </div>
            <div class="sesi-info-item">
                <i class="bi bi-clock"></i>
                <span><?= $sesi['waktu_mulai'] ?> – <?= $sesi['waktu_selesai'] ?></span>
            </div>
        </div>
    </div>

    <!-- ── QR Scanner ── -->
    <div class="scout-panel mb-4">
        <div class="qr-scanner-wrap">
            <p class="qr-hint">Arahkan kamera ke QR Code yang disediakan petugas</p>
            <div class="qr-reader-box">
                <div id="reader"></div>
                <div class="qr-corner tl"></div>
                <div class="qr-corner tr"></div>
                <div class="qr-corner bl"></div>
                <div class="qr-corner br"></div>
            </div>
            <p class="qr-sub-hint">
                <i class="bi bi-lightbulb"></i>
                Pastikan lampu ruangan cukup terang
            </p>

            <form method="POST" id="absenForm">
                <input type="hidden" name="qr_code" id="qr_code">
                <div class="qr-btn-row">
                    <button type="button" class="action-btn action-btn-outline" onclick="startScanner()">
                        <i class="bi bi-camera-video-fill"></i> Mulai Scan
                    </button>
                    <button type="submit" class="action-btn" id="submitBtn" disabled>
                        <i class="bi bi-check2-circle"></i> Absen Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php else: ?>

    <!-- ── Tidak Ada Sesi ── -->
    <div class="scout-panel">
        <div class="no-sesi-wrap">
            <i class="bi bi-calendar-x"></i>
            <p>Tidak ada sesi latihan untuk hari ini.</p>
        </div>
    </div>

<?php endif; ?>

<!-- QR Script -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    let html5QrCode;
    function startScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => { startScanning(); }).catch(err => console.log(err));
        } else {
            startScanning();
        }
    }
    function startScanning() {
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 220 },
            (decodedText) => {
                document.getElementById('qr_code').value = decodedText;
                html5QrCode.stop();
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('submitBtn').click();
            },
            (error) => { console.log(error); }
        );
    }
    window.onload = function() { startScanner(); };
</script>

<style>
    /* ── Page Title Header ── */
    .scout-panel-header {
        background: var(--c-forest, #1B3A2D);
        padding: 14px 22px;
        display: flex;
        align-items: center;
        gap: 9px;
        font-family: var(--font-display, 'Playfair Display', serif);
        font-size: .95rem;
        font-weight: 600;
        color: #fff;
        letter-spacing: .02em;
        position: relative;
    }
    .scout-panel-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--c-gold, #C9952A), #E8B84B, var(--c-gold, #C9952A), transparent);
    }
    .scout-panel-header i { color: #E8B84B; font-size: 1.05rem; }

    /* ── Alert Success ── */
    .absen-alert-success {
        background: rgba(34,139,34,.07);
        border: 1px solid rgba(34,139,34,.2);
        border-radius: 10px;
        padding: 10px 14px;
        color: #1a6b1a;
        font-size: .82rem;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    /* ── Alert Error ── */
    .login-alert {
        background: rgba(185,50,50,.07);
        border: 1px solid rgba(185,50,50,.18);
        border-radius: 10px;
        padding: 10px 14px;
        color: #b93232;
        font-size: .82rem;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    /* ── Sesi Info Card ── */
    .sesi-info-card {
        background: #fff;
        border: 1.5px solid rgba(27,58,45,.1);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }
    .sesi-info-header {
        background: var(--c-forest, #1B3A2D);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 9px;
        font-family: var(--font-display, 'Playfair Display', serif);
        font-size: .9rem;
        font-weight: 600;
        color: #fff;
        position: relative;
    }
    .sesi-info-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--c-gold, #C9952A), #E8B84B, var(--c-gold, #C9952A), transparent);
    }
    .sesi-info-header i { color: #E8B84B; }
    .sesi-info-body {
        padding: 14px 20px;
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }
    .sesi-info-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: .85rem;
        color: var(--c-forest, #1B3A2D);
    }
    .sesi-info-item i { color: var(--c-gold, #C9952A); font-size: .85rem; }

    /* ── Scout Panel ── */
    .scout-panel {
        background: #fff;
        border: 1.5px solid rgba(27,58,45,.1);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }

    /* ── QR Scanner Wrap ── */
    .qr-scanner-wrap {
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }
    .qr-hint {
        font-size: .85rem;
        color: var(--c-forest, #1B3A2D);
        font-weight: 500;
        margin: 0;
        text-align: center;
    }
    .qr-reader-box {
        position: relative;
        width: 280px;
        height: 280px;
        border-radius: 16px;
        overflow: hidden;
        background: #F8F5F0;
        border: 2px solid rgba(27,58,45,.12);
    }
    .qr-reader-box #reader {
        width: 100% !important;
        height: 100% !important;
    }

    /* corner accents */
    .qr-corner {
        position: absolute;
        width: 22px; height: 22px;
        border-color: var(--c-gold, #C9952A);
        border-style: solid;
        z-index: 10;
    }
    .qr-corner.tl { top: 8px;  left: 8px;  border-width: 3px 0 0 3px; border-radius: 4px 0 0 0; }
    .qr-corner.tr { top: 8px;  right: 8px; border-width: 3px 3px 0 0; border-radius: 0 4px 0 0; }
    .qr-corner.bl { bottom: 8px; left: 8px;  border-width: 0 0 3px 3px; border-radius: 0 0 0 4px; }
    .qr-corner.br { bottom: 8px; right: 8px; border-width: 0 3px 3px 0; border-radius: 0 0 4px 0; }

    .qr-sub-hint {
        font-size: .75rem;
        color: #7a8a80;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .qr-sub-hint i { color: var(--c-gold, #C9952A); }

    /* ── QR Buttons ── */
    .qr-btn-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 4px;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #E8B84B, #C9952A);
        color: var(--c-forest, #1B3A2D);
        font-weight: 700;
        font-size: .83rem;
        letter-spacing: .03em;
        border: none;
        border-radius: 999px;
        padding: 9px 20px;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(201,149,42,.28);
        transition: all .2s;
    }
    .action-btn:hover:not(:disabled) {
        background: linear-gradient(135deg, #f5c95e, #b8841e);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(201,149,42,.38);
    }
    .action-btn:disabled {
        opacity: .45;
        cursor: not-allowed;
        box-shadow: none;
    }
    .action-btn-outline {
        background: transparent;
        color: var(--c-forest, #1B3A2D);
        border: 2px solid var(--c-forest, #1B3A2D);
        box-shadow: none;
    }
    .action-btn-outline:hover {
        background: var(--c-forest, #1B3A2D);
        color: #fff;
        box-shadow: 0 6px 16px rgba(27,58,45,.2);
    }

    /* ── No Sesi State ── */
    .no-sesi-wrap {
        text-align: center;
        padding: 48px 24px;
        color: #7a8a80;
    }
    .no-sesi-wrap i {
        display: block;
        font-size: 2.8rem;
        margin-bottom: 12px;
        color: rgba(27,58,45,.2);
    }
    .no-sesi-wrap p {
        font-size: .88rem;
        margin: 0;
    }
</style>