

<!-- ── Action Cards ── -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="action-card h-100">
            <div class="action-icon-wrap">
                <i class="bi bi-qr-code-scan"></i>
            </div>
            <h5 class="action-title">Absen Hadir</h5>
            <p class="action-desc">Scan QR code yang disediakan petugas untuk mencatat kehadiran kamu</p>
            <a href="<?= BASE_URL ?>/UserController/absen" class="action-btn">
                <i class="bi bi-arrow-right-circle-fill"></i> Absen Sekarang
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="action-card h-100">
            <div class="action-icon-wrap action-icon-forest">
                <i class="bi bi-envelope-paper-fill"></i>
            </div>
            <h5 class="action-title">Izin / Sakit</h5>
            <p class="action-desc">Ajukan izin atau sakit jika kamu tidak dapat hadir pada latihan</p>
            <a href="<?= BASE_URL ?>/UserController/izin" class="action-btn action-btn-outline">
                <i class="bi bi-send-fill"></i> Ajukan Izin
            </a>
        </div>
    </div>
</div>

<!-- ── Riwayat Absensi ── -->
<div class="scout-panel">
    <div class="scout-panel-header">
        <i class="bi bi-list-check"></i>
        <span>Riwayat Absensi Terbaru</span>
    </div>
    <div class="scout-panel-body">
        <div class="table-responsive">
            <table class="scout-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Sesi Latihan</th>
                        <th>Waktu Absen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['recent_absensi'] as $absen): ?>
                    <tr>
                        <td>
                            <span class="table-date">
                                <i class="bi bi-calendar3"></i>
                                <?= date('d M Y', strtotime($absen['tanggal'])) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($absen['nama_sesi']) ?></td>
                        <td>
                            <span class="table-time">
                                <?php if($absen['waktu_absen']): ?>
                                    <i class="bi bi-clock"></i> <?= $absen['waktu_absen'] ?>
                                <?php else: ?>
                                    <span class="text-muted">–</span>
                                <?php endif; ?>
                            </span>
                        </td>
                        <td>
                            <?php
                                $status = strtolower($absen['status']);
                                $badgeClass = match($status) {
                                    'hadir'  => 'badge-hadir',
                                    'izin'   => 'badge-izin',
                                    'sakit'  => 'badge-sakit',
                                    'alpha'  => 'badge-alpha',
                                    default  => 'badge-default',
                                };
                            ?>
                            <span class="scout-badge <?= $badgeClass ?>">
                                <?= ucfirst($absen['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($data['recent_absensi'])): ?>
                    <tr>
                        <td colspan="4" class="table-empty">
                            <i class="bi bi-inbox"></i>
                            Belum ada riwayat absensi
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* ══════════════════════════════════════
       DASHBOARD USER — scoped styles
       Menggunakan CSS vars dari layout.php
    ══════════════════════════════════════ */

    /* ── Action Cards ── */
    .action-card {
        background: #fff;
        border: 1.5px solid rgba(27,58,45,.1);
        border-radius: 18px;
        padding: 28px 22px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: box-shadow .2s, transform .2s, border-color .2s;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }

    .action-card:hover {
        box-shadow: 0 10px 32px rgba(27,58,45,.12);
        transform: translateY(-3px);
        border-color: var(--c-gold, #C9952A);
    }

    .action-icon-wrap {
        width: 62px; height: 62px;
        border-radius: 50%;
        background: rgba(201,149,42,.1);
        border: 2px solid rgba(201,149,42,.22);
        display: grid; place-items: center;
        margin-bottom: 16px;
        font-size: 1.7rem;
        color: var(--c-gold, #C9952A);
        transition: background .2s;
    }

    .action-card:hover .action-icon-wrap {
        background: rgba(201,149,42,.18);
    }

    .action-icon-forest {
        background: rgba(27,58,45,.07);
        border-color: rgba(27,58,45,.15);
        color: var(--c-forest, #1B3A2D);
    }

    .action-card:hover .action-icon-forest {
        background: rgba(27,58,45,.13);
    }

    .action-title {
        font-family: var(--font-display, 'Playfair Display', serif);
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--c-forest, #1B3A2D);
        margin-bottom: 8px;
    }

    .action-desc {
        font-size: .82rem;
        color: #7a8a80;
        line-height: 1.6;
        margin-bottom: 18px;
        flex: 1;
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
        border-color: var(--c-forest, #1B3A2D);
        box-shadow: 0 6px 16px rgba(27,58,45,.2);
    }

    /* ── Scout Panel ── */
    .scout-panel {
        background: #fff;
        border: 1.5px solid rgba(27,58,45,.1);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }

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

    /* ── Scout Table ── */
    .scout-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }

    .scout-table thead tr {
        background: #F8F5F0;
        border-bottom: 1.5px solid rgba(27,58,45,.1);
    }

    .scout-table thead th {
        padding: 12px 20px;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--c-forest, #1B3A2D);
        white-space: nowrap;
    }

    .scout-table tbody tr {
        border-bottom: 1px solid rgba(27,58,45,.055);
        transition: background .15s;
    }

    .scout-table tbody tr:last-child { border-bottom: none; }
    .scout-table tbody tr:hover { background: rgba(201,149,42,.04); }

    .scout-table tbody td {
        padding: 13px 20px;
        color: #1a1a2e;
        vertical-align: middle;
    }

    .table-date, .table-time {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .82rem;
    }

    .table-date i { color: var(--c-gold, #C9952A); }
    .table-time i { color: #2E5E47; }

    .table-empty {
        text-align: center;
        padding: 40px 20px !important;
        color: #7a8a80;
        font-size: .85rem;
    }

    .table-empty i {
        display: block;
        font-size: 2rem;
        margin-bottom: 10px;
        opacity: .25;
    }

    /* ── Scout Badges ── */
    .scout-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 11px;
        border-radius: 999px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .badge-hadir  { background: rgba(34,139,34,.1);  color: #1a6b1a; border: 1px solid rgba(34,139,34,.2); }
    .badge-izin   { background: rgba(201,149,42,.1); color: #8a6010; border: 1px solid rgba(201,149,42,.25); }
    .badge-sakit  { background: rgba(70,130,180,.1); color: #2a6090; border: 1px solid rgba(70,130,180,.2); }
    .badge-alpha  { background: rgba(185,50,50,.08); color: #b93232; border: 1px solid rgba(185,50,50,.18); }
    .badge-default{ background: rgba(27,58,45,.07);  color: #1B3A2D; border: 1px solid rgba(27,58,45,.15); }
</style>