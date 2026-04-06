<!-- ══════════════════════════════
     LAPORAN BULANAN PAGE
══════════════════════════════ -->

<?php
$limitPerPage = $data['limitPerPage'] ?? 12;
$currentPage  = $data['currentPage'] ?? 1;
$no           = ($currentPage - 1) * $limitPerPage + 1;
$kelas        = $data['kelas'] ?? '?';
$nama_bulan   = $data['nama_bulan'] ?? date('F Y');
$bulan        = $data['bulan'] ?? date('Y-m');
$sesi_list    = $data['sesi_list'] ?? [];
$laporan      = $data['laporan'] ?? [];
$totalPages   = $data['totalPages'] ?? 1;
$totalRecords = $data['totalRecords'] ?? 0;
$error        = $data['error'] ?? null;

// Hitung statistik
$totalHadir = 0;
$totalIzin  = 0;
$totalSakit = 0;
$totalAlfa  = 0;
foreach ($laporan as $row) {
    foreach ($row['kehadiran'] as $status) {
        if ($status === 'H') $totalHadir++;
        elseif ($status === 'I') $totalIzin++;
        elseif ($status === 'S') $totalSakit++;
        else $totalAlfa++;
    }
}
$totalEntries = $totalHadir + $totalIzin + $totalSakit + $totalAlfa;
$persenHadir  = $totalEntries > 0 ? round(($totalHadir / $totalEntries) * 100) : 0;
?>

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Laporan Kehadiran</div>
        <h1 class="page-header-title">Kelas <?= htmlspecialchars($kelas) ?></h1>
        <p class="page-header-sub">
            <i class="bi bi-calendar3" style="color:var(--c-gold);"></i>
            Periode: <?= htmlspecialchars($nama_bulan) ?>
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= BASE_URL ?>/AdminController/exportLaporan?jenis=bulanan&bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&format=pdf"
           class="btn-export btn-export-pdf" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span>Export PDF</span>
        </a>
        <a href="<?= BASE_URL ?>/AdminController/exportLaporan?jenis=bulanan&bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&format=csv"
           class="btn-export btn-export-excel" target="_blank">
            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
            <span>Export Excel</span>
        </a>
        <a href="<?= BASE_URL ?>/AdminController/laporan" class="btn-scout-outline">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- Alerts -->
<?php if ($error): ?>
    <div class="alert-scout alert-scout-warning animate-in">
        <div class="alert-scout-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div>
            <div class="alert-scout-title">Perhatian</div>
            <div class="alert-scout-text"><?= htmlspecialchars($error) ?></div>
        </div>
    </div>

<?php elseif (empty($sesi_list) || empty($laporan)): ?>
    <div class="empty-state-full animate-in">
        <div class="card-scout" style="max-width:480px; margin:0 auto;">
            <div class="card-scout-body" style="padding:48px 32px; text-align:center;">
                <div class="empty-state-icon-lg">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <div class="empty-state-title" style="font-size:1.3rem;">
                    Belum Ada Data Laporan
                </div>
                <div class="empty-state-text" style="margin-top:8px;">
                    Tidak ditemukan data kehadiran untuk kelas
                    <strong><?= htmlspecialchars($kelas) ?></strong>
                    pada periode <strong><?= htmlspecialchars($nama_bulan) ?></strong>
                </div>
                <a href="<?= BASE_URL ?>/AdminController/laporan" class="btn-scout mt-4">
                    <i class="bi bi-arrow-left"></i> Kembali ke Laporan
                </a>
            </div>
        </div>
    </div>

<?php else: ?>

<!-- Stat Cards -->
<div class="row g-3 mb-4 animate-in">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $totalRecords ?></div>
                <div class="stat-label">Total Anggota</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="bi bi-calendar-event-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= count($sesi_list) ?></div>
                <div class="stat-label">Jumlah Sesi</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $totalHadir ?></div>
                <div class="stat-label">Total Hadir</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <div class="stat-value"><?= $persenHadir ?>%</div>
                <div class="stat-label">Kehadiran</div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Bar -->
<div class="summary-bar animate-in">
    <div class="summary-bar-item">
        <div class="summary-dot dot-hadir"></div>
        <div class="summary-bar-label">Hadir</div>
        <div class="summary-bar-value"><?= $totalHadir ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-izin"></div>
        <div class="summary-bar-label">Izin</div>
        <div class="summary-bar-value"><?= $totalIzin ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-sakit"></div>
        <div class="summary-bar-label">Sakit</div>
        <div class="summary-bar-value"><?= $totalSakit ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-alfa"></div>
        <div class="summary-bar-label">Alfa</div>
        <div class="summary-bar-value"><?= $totalAlfa ?></div>
    </div>

    <!-- Progress Bar -->
    <div class="summary-progress-wrap">
        <div class="summary-progress">
            <div class="summary-progress-fill fill-hadir" style="width:<?= $totalEntries > 0 ? ($totalHadir/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-izin"  style="width:<?= $totalEntries > 0 ? ($totalIzin/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-sakit" style="width:<?= $totalEntries > 0 ? ($totalSakit/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-alfa"  style="width:<?= $totalEntries > 0 ? ($totalAlfa/$totalEntries*100) : 0 ?>%"></div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card-scout animate-in">
    <div class="card-scout-header">
        <div class="card-scout-icon">
            <i class="bi bi-table"></i>
        </div>
        <div style="flex:1;">
            <div class="card-scout-title">Rekap Kehadiran</div>
            <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                Halaman <?= $currentPage ?> dari <?= $totalPages ?>
                &nbsp;·&nbsp; <?= $totalRecords ?> anggota
            </div>
        </div>
        <!-- Search -->
        <div class="d-none d-md-block">
            <div class="search-input-wrapper" style="min-width:180px;">
                <i class="bi bi-search search-input-icon"></i>
                <input type="text"
                       id="searchLaporan"
                       class="form-control search-input"
                       placeholder="Cari nama...">
            </div>
        </div>
    </div>

    <div class="card-scout-body" style="padding:0;">

        <!-- Mobile Search -->
        <div class="d-md-none" style="padding:14px 20px 0;">
            <div class="search-input-wrapper">
                <i class="bi bi-search search-input-icon"></i>
                <input type="text"
                       class="form-control search-input search-laporan-mobile"
                       placeholder="Cari nama...">
            </div>
        </div>

        <!-- Legend (mobile friendly) -->
        <div class="table-legend">
            <span class="legend-item"><span class="legend-badge legend-hadir">H</span> Hadir</span>
            <span class="legend-item"><span class="legend-badge legend-izin">I</span> Izin</span>
            <span class="legend-item"><span class="legend-badge legend-sakit">S</span> Sakit</span>
            <span class="legend-item"><span class="legend-badge legend-alfa">A</span> Alfa</span>
        </div>

        <div class="table-responsive" id="laporanTableView">
            <table class="table-scout table-laporan" id="laporanTable">
                <thead>
                    <tr>
                        <th class="th-sticky-left" style="width:50px; z-index:3;">No</th>
                        <th class="th-sticky-left th-nama" style="left:50px; z-index:3;">Nama Lengkap</th>
                        <?php foreach ($sesi_list as $sesi):
                            $tanggalSesi   = date('d/m', strtotime($sesi['tanggal']));
                            $hariSesi      = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'][date('w', strtotime($sesi['tanggal']))];
                        ?>
                        <th class="th-sesi" title="<?= htmlspecialchars($sesi['nama_sesi'] ?? '') ?> — <?= $sesi['tanggal'] ?>">
                            <div class="th-sesi-day"><?= $hariSesi ?></div>
                            <div class="th-sesi-date"><?= $tanggalSesi ?></div>
                        </th>
                        <?php endforeach; ?>
                        <th class="th-total">Total<br>Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $row): ?>
                    <tr class="laporan-row" data-nama="<?= strtolower(htmlspecialchars($row['nama'])) ?>">
                        <td class="td-sticky-left">
                            <span class="row-number"><?= $no++ ?></span>
                        </td>
                        <td class="td-sticky-left td-nama" style="left:50px;">
                            <div class="nama-cell">
                                <div class="nama-cell-avatar">
                                    <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                                </div>
                                <div class="nama-cell-text">
                                    <?= htmlspecialchars($row['nama']) ?>
                                </div>
                            </div>
                        </td>
                        <?php foreach ($row['kehadiran'] as $status): ?>
                        <td class="td-status">
                            <?php if ($status === 'H'): ?>
                                <span class="status-dot status-hadir" title="Hadir">H</span>
                            <?php elseif ($status === 'I'): ?>
                                <span class="status-dot status-izin" title="Izin">I</span>
                            <?php elseif ($status === 'S'): ?>
                                <span class="status-dot status-sakit" title="Sakit">S</span>
                            <?php else: ?>
                                <span class="status-dot status-alfa" title="Alfa">A</span>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                        <td class="td-total">
                            <div class="total-cell">
                                <span class="total-value"><?= $row['total_hadir'] ?></span>
                                <span class="total-of">/<?= count($sesi_list) ?></span>
                            </div>
                            <div class="total-bar">
                                <div class="total-bar-fill"
                                     style="width:<?= count($sesi_list) > 0 ? ($row['total_hadir']/count($sesi_list)*100) : 0 ?>%">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- No Search Result -->
        <div class="empty-state" id="noLaporanResult" style="display:none;">
            <div class="empty-state-icon"><i class="bi bi-search"></i></div>
            <div class="empty-state-title">Tidak Ditemukan</div>
            <div class="empty-state-text">Tidak ada anggota yang sesuai pencarian</div>
        </div>
    </div>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<div class="pagination-scout animate-in">
    <div class="pagination-info">
        Menampilkan halaman <strong><?= $currentPage ?></strong>
        dari <strong><?= $totalPages ?></strong>
        &nbsp;·&nbsp; Total <strong><?= $totalRecords ?></strong> anggota
    </div>
    <div class="pagination-buttons">
        <a href="?bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $currentPage - 1 ?>"
           class="pagination-btn <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-left"></i>
        </a>

        <?php
        $start = max(1, $currentPage - 2);
        $end   = min($totalPages, $currentPage + 2);
        ?>

        <?php if ($start > 1): ?>
            <a href="?bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&page=1"
               class="pagination-btn">1</a>
            <?php if ($start > 2): ?>
                <span class="pagination-dots">···</span>
            <?php endif; ?>
        <?php endif; ?>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <a href="?bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $i ?>"
               class="pagination-btn <?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($end < $totalPages): ?>
            <?php if ($end < $totalPages - 1): ?>
                <span class="pagination-dots">···</span>
            <?php endif; ?>
            <a href="?bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $totalPages ?>"
               class="pagination-btn"><?= $totalPages ?></a>
        <?php endif; ?>

        <a href="?bulan=<?= urlencode($bulan) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $currentPage + 1 ?>"
           class="pagination-btn <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>
</div>
<?php endif; ?>

<!-- Footer Note -->
<div class="text-center mt-3 animate-in" style="font-size:.75rem; color:var(--c-muted);">
    <i class="bi bi-printer"></i>
    Gunakan tombol export untuk mencetak laporan dalam format PDF atau Excel
</div>

<?php endif; ?>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
    /* ── Export Buttons ── */
    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: var(--radius-pill);
        font-size: .82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        border: 1.5px solid transparent;
    }

    .btn-export i { font-size: 1rem; }

    .btn-export-pdf {
        background: rgba(185,50,50,.08);
        color: #b93232;
        border-color: rgba(185,50,50,.15);
    }

    .btn-export-pdf:hover {
        background: #b93232;
        color: var(--c-white);
        border-color: #b93232;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(185,50,50,.25);
    }

    .btn-export-excel {
        background: rgba(46,94,71,.08);
        color: var(--c-forest-mid);
        border-color: rgba(46,94,71,.15);
    }

    .btn-export-excel:hover {
        background: var(--c-forest);
        color: var(--c-white);
        border-color: var(--c-forest);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(27,58,45,.25);
    }

    /* ── Alert Scout ── */
    .alert-scout {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 20px;
        border: 1px solid;
    }

    .alert-scout-warning {
        background: rgba(201,149,42,.06);
        border-color: rgba(201,149,42,.18);
    }

    .alert-scout-warning .alert-scout-icon {
        color: var(--c-gold);
        font-size: 1.3rem;
        margin-top: 1px;
    }

    .alert-scout-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .95rem;
        margin-bottom: 2px;
    }

    .alert-scout-warning .alert-scout-title { color: #856404; }

    .alert-scout-text {
        font-size: .84rem;
        color: var(--c-muted);
        line-height: 1.5;
    }

    /* ── Summary Bar ── */
    .summary-bar {
        background: var(--c-white);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .summary-bar-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot-hadir { background: var(--c-forest-mid); }
    .dot-izin  { background: var(--c-gold); }
    .dot-sakit { background: #3b82f6; }
    .dot-alfa  { background: #b93232; }

    .summary-bar-label {
        font-size: .75rem;
        color: var(--c-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .summary-bar-value {
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--c-ink);
    }

    .summary-bar-divider {
        width: 1px;
        height: 28px;
        background: var(--c-border);
    }

    .summary-progress-wrap {
        flex: 1;
        min-width: 120px;
    }

    .summary-progress {
        height: 8px;
        background: var(--c-parchment);
        border-radius: 8px;
        overflow: hidden;
        display: flex;
    }

    .summary-progress-fill {
        height: 100%;
        transition: width .6s ease;
    }

    .fill-hadir { background: var(--c-forest-mid); }
    .fill-izin  { background: var(--c-gold); }
    .fill-sakit { background: #3b82f6; }
    .fill-alfa  { background: #b93232; }

    /* ── Search Input ── */
    .search-input-wrapper {
        position: relative;
    }

    .search-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--c-muted);
        font-size: .95rem;
        pointer-events: none;
    }

    .search-input {
        padding-left: 40px !important;
        border: 1.5px solid var(--c-border) !important;
        border-radius: var(--radius-pill) !important;
        font-size: .85rem;
        background: var(--c-cream) !important;
        transition: all .25s;
    }

    .search-input:focus {
        background: var(--c-white) !important;
        border-color: var(--c-gold) !important;
        box-shadow: 0 0 0 3px rgba(201,149,42,.12) !important;
    }

    /* ── Table Legend ── */
    .table-legend {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        padding: 14px 24px;
        border-bottom: 1px solid var(--c-border);
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .75rem;
        color: var(--c-muted);
        font-weight: 500;
    }

    .legend-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 6px;
        font-size: .65rem;
        font-weight: 700;
    }

    .legend-hadir { background: rgba(46,94,71,.12); color: var(--c-forest-mid); }
    .legend-izin  { background: rgba(201,149,42,.12); color: #a07820; }
    .legend-sakit { background: rgba(59,130,246,.1); color: #3b82f6; }
    .legend-alfa  { background: rgba(185,50,50,.08); color: #b93232; }

    /* ── Laporan Table ── */
    .table-laporan { min-width: 600px; }

    .table-laporan thead th {
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .th-sticky-left,
    .td-sticky-left {
        position: sticky;
        left: 0;
        z-index: 2;
        background: var(--c-white);
    }

    .th-sticky-left {
        background: var(--c-parchment);
    }

    .th-nama {
        min-width: 160px;
    }

    .td-nama {
        min-width: 160px;
    }

    /* Sesi header */
    .th-sesi {
        text-align: center;
        min-width: 52px;
        padding: 8px 6px !important;
    }

    .th-sesi-day {
        font-size: .6rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--c-gold);
        font-weight: 700;
        font-family: var(--font-body);
    }

    .th-sesi-date {
        font-size: .78rem;
        color: var(--c-forest);
        font-weight: 700;
    }

    .th-total {
        text-align: center;
        min-width: 80px;
        background: rgba(201,149,42,.06) !important;
    }

    /* ── Row Number ── */
    .row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        background: var(--c-parchment);
        border-radius: 8px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--c-muted);
    }

    /* ── Nama Cell ── */
    .nama-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nama-cell-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(46,94,71,.08);
        color: var(--c-forest-mid);
        display: grid;
        place-items: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .85rem;
        flex-shrink: 0;
    }

    .nama-cell-text {
        font-weight: 600;
        font-size: .85rem;
        color: var(--c-ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    /* ── Status Dot ── */
    .td-status {
        text-align: center;
        padding: 10px 4px !important;
    }

    .status-dot {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .02em;
        transition: transform .15s, box-shadow .15s;
        cursor: default;
    }

    .status-dot:hover {
        transform: scale(1.15);
        box-shadow: 0 3px 10px rgba(0,0,0,.12);
    }

    .status-hadir {
        background: rgba(46,94,71,.12);
        color: var(--c-forest-mid);
    }

    .status-izin {
        background: rgba(201,149,42,.12);
        color: #a07820;
    }

    .status-sakit {
        background: rgba(59,130,246,.1);
        color: #3b82f6;
    }

    .status-alfa {
        background: rgba(185,50,50,.08);
        color: #b93232;
    }

    /* ── Total Cell ── */
    .td-total {
        text-align: center;
        padding: 10px 12px !important;
        background: rgba(201,149,42,.03);
    }

    .total-cell {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 2px;
    }

    .total-value {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--c-forest);
    }

    .total-of {
        font-size: .72rem;
        color: var(--c-muted);
        font-weight: 500;
    }

    .total-bar {
        height: 4px;
        background: rgba(27,58,45,.06);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 6px;
        max-width: 60px;
        margin-left: auto;
        margin-right: auto;
    }

    .total-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--c-forest-mid), var(--c-gold));
        border-radius: 4px;
        transition: width .6s ease;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }

    .empty-state-icon,
    .empty-state-icon-lg {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--c-parchment);
        display: grid;
        place-items: center;
        margin: 0 auto 16px;
        font-size: 2rem;
        color: var(--c-muted);
    }

    .empty-state-icon-lg {
        width: 90px;
        height: 90px;
        font-size: 2.5rem;
    }

    .empty-state-title {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--c-forest);
        margin-bottom: 4px;
    }

    .empty-state-text {
        font-size: .85rem;
        color: var(--c-muted);
    }

    /* ── Pagination ── */
    .pagination-scout {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination-info {
        font-size: .82rem;
        color: var(--c-muted);
    }

    .pagination-info strong {
        color: var(--c-forest);
        font-family: var(--font-display);
    }

    .pagination-buttons {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        border-radius: var(--radius-sm);
        background: var(--c-white);
        border: 1.5px solid var(--c-border);
        color: var(--c-ink);
        font-size: .85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all .2s;
    }

    .pagination-btn:hover:not(.disabled):not(.active) {
        border-color: var(--c-forest-soft);
        color: var(--c-forest);
        background: var(--c-parchment);
        transform: translateY(-1px);
    }

    .pagination-btn.active {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
        border-color: var(--c-gold);
        font-weight: 700;
        font-family: var(--font-display);
        font-size: .95rem;
        box-shadow: 0 4px 12px rgba(201,149,42,.3);
    }

    .pagination-btn.disabled {
        opacity: .35;
        pointer-events: none;
    }

    .pagination-dots {
        color: var(--c-muted);
        font-size: .85rem;
        padding: 0 4px;
        user-select: none;
    }

    /* ── Row Transitions ── */
    .table-scout tbody tr {
        transition: opacity .3s, transform .3s;
    }

    .table-scout tbody tr.hiding {
        opacity: 0;
        transform: scale(.97);
    }

    /* ── Responsive ── */
    @media (max-width: 991.98px) {
        .summary-bar-divider { display: none; }
        .summary-bar {
            gap: 12px;
            padding: 14px 18px;
        }
        .summary-bar-item { min-width: 60px; }
    }

    @media (max-width: 767.98px) {
        .btn-export span { display: none; }
        .btn-export { padding: 9px 12px; }

        .table-legend {
            gap: 10px;
            padding: 10px 16px;
        }

        .nama-cell-avatar { width: 28px; height: 28px; font-size: .75rem; border-radius: 6px; }
        .nama-cell { gap: 7px; }
        .nama-cell-text { font-size: .78rem; max-width: 100px; }

        .status-dot { width: 26px; height: 26px; font-size: .65rem; border-radius: 6px; }

        .pagination-scout { justify-content: center; }
        .pagination-info { width: 100%; text-align: center; }
    }

    /* ── Print Styles ── */
    @media print {
        .navbar-top,
        .sidebar-desktop,
        .info-bar,
        .page-header .btn-scout-outline,
        .btn-export,
        .search-input-wrapper,
        .mobile-bottom-nav,
        .pagination-scout,
        .table-legend { display: none !important; }

        .main-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .card-scout {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .status-dot {
            border: 1px solid #999;
        }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    /**
     * Search Laporan
     */
    function searchLaporan(query) {
        query = query.toLowerCase().trim();
        const rows      = document.querySelectorAll('.laporan-row');
        const noResult  = document.getElementById('noLaporanResult');
        const tableView = document.getElementById('laporanTableView');
        let visible = 0;

        rows.forEach(row => {
            const nama = row.dataset.nama || '';
            if (nama.includes(query)) {
                row.style.display = '';
                row.classList.remove('hiding');
                visible++;
            } else {
                row.classList.add('hiding');
                setTimeout(() => { row.style.display = 'none'; }, 200);
            }
        });

        if (visible === 0 && query) {
            noResult.style.display  = 'block';
            tableView.style.display = 'none';
        } else {
            noResult.style.display  = 'none';
            tableView.style.display = '';
        }
    }

    // Desktop search
    const searchDesktop = document.getElementById('searchLaporan');
    if (searchDesktop) {
        searchDesktop.addEventListener('input', function () {
            searchLaporan(this.value);
            // Sync mobile
            document.querySelectorAll('.search-laporan-mobile').forEach(el => el.value = this.value);
        });
    }

    // Mobile search
    document.querySelectorAll('.search-laporan-mobile').forEach(el => {
        el.addEventListener('input', function () {
            searchLaporan(this.value);
            if (searchDesktop) searchDesktop.value = this.value;
        });
    });

    /**
     * Animate progress bars on scroll into view
     */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.summary-progress-fill, .total-bar-fill').forEach(el => {
                    const w = el.style.width;
                    el.style.width = '0%';
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            el.style.width = w;
                        });
                    });
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('.summary-bar, .table-laporan').forEach(el => observer.observe(el));
</script>