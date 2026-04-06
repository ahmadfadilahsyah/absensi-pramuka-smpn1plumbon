<!-- ── Page Title ── -->
<div class="scout-panel-header mb-4" style="border-radius:18px;">
    <i class="bi bi-envelope-paper-fill"></i>
    <span>Form Izin / Sakit</span>
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
        </div>
    </div>

    <!-- ── Form Izin ── -->
    <div class="scout-panel">
        <div class="izin-form-wrap">
            <form method="POST">

                <!-- Status -->
                <div class="izin-field">
                    <label class="izin-label">
                        <i class="bi bi-tag-fill"></i> Status
                    </label>
                    <div class="izin-select-wrap">
                        <select name="status" class="izin-input izin-select" required>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                        <i class="bi bi-chevron-down izin-select-icon"></i>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="izin-field">
                    <label class="izin-label">
                        <i class="bi bi-chat-left-text-fill"></i> Keterangan
                    </label>
                    <textarea name="keterangan"
                              class="izin-input izin-textarea"
                              rows="4"
                              placeholder="Tuliskan alasan tidak hadir..."
                              required></textarea>
                </div>

                <!-- Buttons -->
                <div class="izin-btn-row">
                    <button type="submit" class="action-btn">
                        <i class="bi bi-send-fill"></i> Kirim Izin
                    </button>
                    <a href="<?= BASE_URL ?>/UserController/dashboard" class="action-btn action-btn-outline">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
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

    /* ── Alerts ── */
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

    /* ── Form Wrap ── */
    .izin-form-wrap {
        padding: 28px 28px 24px;
    }

    /* ── Form Field ── */
    .izin-field {
        margin-bottom: 20px;
    }
    .izin-label {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--c-forest, #1B3A2D);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
    }
    .izin-label i { color: var(--c-gold, #C9952A); font-size: .8rem; }

    .izin-input {
        width: 100%;
        border: 1.5px solid rgba(27,58,45,.15);
        border-radius: 10px;
        padding: 11px 14px;
        font-family: var(--font-body, 'Inter', sans-serif);
        font-size: .9rem;
        background: #F8F5F0;
        color: #1a1a2e;
        transition: border-color .2s, box-shadow .2s;
        outline: none;
        box-sizing: border-box;
    }
    .izin-input:focus {
        border-color: var(--c-gold, #C9952A);
        box-shadow: 0 0 0 3px rgba(201,149,42,.15);
        background: #fff;
    }
    .izin-input::placeholder { color: #aaa; }

    /* ── Select ── */
    .izin-select-wrap {
        position: relative;
    }
    .izin-select {
        appearance: none;
        -webkit-appearance: none;
        padding-right: 36px;
        cursor: pointer;
    }
    .izin-select-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--c-gold, #C9952A);
        font-size: .8rem;
        pointer-events: none;
    }

    /* ── Textarea ── */
    .izin-textarea {
        resize: vertical;
        min-height: 110px;
        line-height: 1.6;
    }

    /* ── Buttons ── */
    .izin-btn-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
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
        padding: 10px 22px;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(201,149,42,.28);
        transition: all .2s;
    }
    .action-btn:hover {
        background: linear-gradient(135deg, #f5c95e, #b8841e);
        color: var(--c-forest, #1B3A2D);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(201,149,42,.38);
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

    @media (max-width: 480px) {
        .izin-form-wrap { padding: 20px 16px; }
        .izin-btn-row { flex-direction: column; }
        .action-btn { justify-content: center; }
    }
</style>