<!-- ══════════════════════════════
     LAPORAN TAHUNAN PAGE
══════════════════════════════ -->

<?php
$limitPerPage  = $data['limitPerPage'] ?? 12;
$currentPage   = $data['currentPage'] ?? 1;
$no            = ($currentPage - 1) * $limitPerPage + 1;
$kelas         = $data['kelas'] ?? '?';
$tahun         = $data['tahun'] ?? date('Y');
$laporan       = $data['laporan'] ?? [];
$totalPages    = $data['totalPages'] ?? 1;
$totalRecords  = $data['totalRecords'] ?? 0;

// Hitung statistik agregat
$sumHadir = 0; $sumIzin = 0; $sumSakit = 0; $sumAlpha = 0; $sumSesi = 0; $sumSkor = 0;
foreach ($laporan as $row) {
    $sumHadir += $row['hadir'];
    $sumIzin  += $row['izin'];
    $sumSakit += $row['sakit'];
    $sumAlpha += $row['alpha'];
    $sumSesi  += $row['total_sesi'];
    $sumSkor  += $row['skor'];
}
$avgSkor      = count($laporan) > 0 ? round($sumSkor / count($laporan)) : 0;
$totalEntries = $sumHadir + $sumIzin + $sumSakit + $sumAlpha;
$persenHadir  = $totalEntries > 0 ? round(($sumHadir / $totalEntries) * 100) : 0;

// Kategori skor
function getSkorClass($skor) {
    if ($skor >= 80) return 'skor-excellent';
    if ($skor >= 60) return 'skor-good';
    if ($skor >= 40) return 'skor-warning';
    return 'skor-danger';
}

function getSkorLabel($skor) {
    if ($skor >= 80) return 'Sangat Baik';
    if ($skor >= 60) return 'Baik';
    if ($skor >= 40) return 'Cukup';
    return 'Kurang';
}
?>

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Laporan Tahunan</div>
        <h1 class="page-header-title">Kelas <?= htmlspecialchars($kelas) ?></h1>
        <p class="page-header-sub">
            <i class="bi bi-calendar-range" style="color:var(--c-gold);"></i>
            Tahun Ajaran <?= htmlspecialchars($tahun) ?>
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= BASE_URL ?>/AdminController/exportLaporan?jenis=tahunan&tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&format=pdf"
           class="btn-export btn-export-pdf" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span>Export PDF</span>
        </a>
        <a href="<?= BASE_URL ?>/AdminController/exportLaporan?jenis=tahunan&tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&format=csv"
           class="btn-export btn-export-excel" target="_blank">
            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
            <span>Export Excel</span>
        </a>
        <a href="<?= BASE_URL ?>/AdminController/laporan" class="btn-scout-outline">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<?php if (empty($laporan)): ?>

<!-- Empty State -->
<div class="empty-state-full animate-in">
    <div class="card-scout" style="max-width:480px; margin:0 auto;">
        <div class="card-scout-body" style="padding:48px 32px; text-align:center;">
            <div class="empty-state-icon-lg">
                <i class="bi bi-graph-down"></i>
            </div>
            <div class="empty-state-title" style="font-size:1.3rem;">
                Belum Ada Data Laporan
            </div>
            <div class="empty-state-text" style="margin-top:8px;">
                Tidak ditemukan data anggota untuk kelas
                <strong><?= htmlspecialchars($kelas) ?></strong>
                pada tahun <strong><?= htmlspecialchars($tahun) ?></strong>
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
                <i class="bi bi-trophy-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $avgSkor ?>%</div>
                <div class="stat-label">Rata-rata Skor</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-check2-all"></i>
            </div>
            <div>
                <div class="stat-value"><?= $sumHadir ?></div>
                <div class="stat-label">Total Kehadiran</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div>
                <div class="stat-value"><?= $persenHadir ?>%</div>
                <div class="stat-label">Tingkat Hadir</div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Bar -->
<div class="summary-bar animate-in">
    <div class="summary-bar-item">
        <div class="summary-dot dot-hadir"></div>
        <div class="summary-bar-label">Hadir</div>
        <div class="summary-bar-value"><?= $sumHadir ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-izin"></div>
        <div class="summary-bar-label">Izin</div>
        <div class="summary-bar-value"><?= $sumIzin ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-sakit"></div>
        <div class="summary-bar-label">Sakit</div>
        <div class="summary-bar-value"><?= $sumSakit ?></div>
    </div>
    <div class="summary-bar-divider"></div>
    <div class="summary-bar-item">
        <div class="summary-dot dot-alfa"></div>
        <div class="summary-bar-label">Alfa</div>
        <div class="summary-bar-value"><?= $sumAlpha ?></div>
    </div>

    <!-- Progress Bar -->
    <div class="summary-progress-wrap">
        <div class="summary-progress">
            <div class="summary-progress-fill fill-hadir" style="width:<?= $totalEntries > 0 ? ($sumHadir/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-izin"  style="width:<?= $totalEntries > 0 ? ($sumIzin/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-sakit" style="width:<?= $totalEntries > 0 ? ($sumSakit/$totalEntries*100) : 0 ?>%"></div>
            <div class="summary-progress-fill fill-alfa"  style="width:<?= $totalEntries > 0 ? ($sumAlpha/$totalEntries*100) : 0 ?>%"></div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card-scout animate-in">
    <div class="card-scout-header">
        <div class="card-scout-icon">
            <i class="bi bi-bar-chart-line-fill"></i>
        </div>
        <div style="flex:1;">
            <div class="card-scout-title">Rekap Tahunan</div>
            <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                Halaman <?= $currentPage ?> dari <?= $totalPages ?>
                &nbsp;·&nbsp; <?= $totalRecords ?> anggota
                &nbsp;·&nbsp; Tahun <?= htmlspecialchars($tahun) ?>
            </div>
        </div>
        <!-- Search Desktop -->
        <div class="d-none d-md-block">
            <div class="search-input-wrapper" style="min-width:180px;">
                <i class="bi bi-search search-input-icon"></i>
                <input type="text"
                       id="searchTahunan"
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
                       class="form-control search-input search-tahunan-mobile"
                       placeholder="Cari nama...">
            </div>
        </div>

        <!-- Legend -->
        <div class="table-legend">
            <span class="legend-item"><span class="legend-badge legend-hadir">H</span> Hadir</span>
            <span class="legend-item"><span class="legend-badge legend-izin">I</span> Izin</span>
            <span class="legend-item"><span class="legend-badge legend-sakit">S</span> Sakit</span>
            <span class="legend-item"><span class="legend-badge legend-alfa">A</span> Alfa</span>
            <span class="legend-divider"></span>
            <span class="legend-item"><span class="legend-skor skor-excellent"></span> ≥80%</span>
            <span class="legend-item"><span class="legend-skor skor-good"></span> ≥60%</span>
            <span class="legend-item"><span class="legend-skor skor-warning"></span> ≥40%</span>
            <span class="legend-item"><span class="legend-skor skor-danger"></span> &lt;40%</span>
        </div>

        <!-- Table -->
        <div class="table-responsive" id="tahunanTableView">
            <table class="table-scout table-tahunan" id="tahunanTable">
                <thead>
                    <tr>
                        <th class="th-sticky-left" style="width:50px; z-index:3;">No</th>
                        <th class="th-sticky-left th-nama" style="left:50px; z-index:3;">Nama Lengkap</th>
                        <th class="th-center">Total<br>Latihan</th>
                        <th class="th-center th-hadir">
                            <div class="th-status-dot dot-hadir"></div>
                            Hadir
                        </th>
                        <th class="th-center th-izin">
                            <div class="th-status-dot dot-izin"></div>
                            Izin
                        </th>
                        <th class="th-center th-sakit">
                            <div class="th-status-dot dot-sakit"></div>
                            Sakit
                        </th>
                        <th class="th-center th-alfa">
                            <div class="th-status-dot dot-alfa"></div>
                            Alfa
                        </th>
                        <th class="th-center th-skor">Skor<br>Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $row): ?>
                    <tr class="tahunan-row" data-nama="<?= strtolower(htmlspecialchars($row['nama'])) ?>">
                        <!-- No -->
                        <td class="td-sticky-left">
                            <span class="row-number"><?= $no++ ?></span>
                        </td>

                        <!-- Nama -->
                        <td class="td-sticky-left td-nama" style="left:50px;">
                            <div class="nama-cell">
                                <div class="nama-cell-avatar <?= getSkorClass($row['skor']) ?>-bg">
                                    <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="nama-cell-text"><?= htmlspecialchars($row['nama']) ?></div>
                                    <div class="nama-cell-sub"><?= getSkorLabel($row['skor']) ?></div>
                                </div>
                            </div>
                        </td>

                        <!-- Total Latihan -->
                        <td class="td-center">
                            <span class="value-pill value-pill-neutral">
                                <?= $row['total_sesi'] ?>
                            </span>
                        </td>

                        <!-- Hadir -->
                        <td class="td-center">
                            <span class="value-pill value-pill-hadir">
                                <?= $row['hadir'] ?>
                            </span>
                        </td>

                        <!-- Izin -->
                        <td class="td-center">
                            <span class="value-pill value-pill-izin">
                                <?= $row['izin'] ?>
                            </span>
                        </td>

                        <!-- Sakit -->
                        <td class="td-center">
                            <span class="value-pill value-pill-sakit">
                                <?= $row['sakit'] ?>
                            </span>
                        </td>

                        <!-- Alpha -->
                        <td class="td-center">
                            <span class="value-pill value-pill-alfa">
                                <?= $row['alpha'] ?>
                            </span>
                        </td>

                        <!-- Skor -->
                        <td class="td-center td-skor">
                            <div class="skor-cell">
                                <div class="skor-ring <?= getSkorClass($row['skor']) ?>">
                                    <svg viewBox="0 0 36 36" class="skor-svg">
                                        <path class="skor-bg-circle"
                                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <path class="skor-fill-circle"
                                              stroke-dasharray="<?= $row['skor'] ?>, 100"
                                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    </svg>
                                    <span class="skor-value"><?= $row['skor'] ?></span>
                                </div>
                                <div class="skor-label"><?= getSkorLabel($row['skor']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- No Search Result -->
        <div class="empty-state" id="noTahunanResult" style="display:none;">
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
        <a href="?tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $currentPage - 1 ?>"
           class="pagination-btn <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-left"></i>
        </a>

        <?php
        $start = max(1, $currentPage - 2);
        $end   = min($totalPages, $currentPage + 2);
        ?>

        <?php if ($start > 1): ?>
            <a href="?tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&page=1"
               class="pagination-btn">1</a>
            <?php if ($start > 2): ?>
                <span class="pagination-dots">···</span>
            <?php endif; ?>
        <?php endif; ?>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <a href="?tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $i ?>"
               class="pagination-btn <?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($end < $totalPages): ?>
            <?php if ($end < $totalPages - 1): ?>
                <span class="pagination-dots">···</span>
            <?php endif; ?>
            <a href="?tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $totalPages ?>"
               class="pagination-btn"><?= $totalPages ?></a>
        <?php endif; ?>

        <a href="?tahun=<?= urlencode($tahun) ?>&kelas=<?= urlencode($kelas) ?>&page=<?= $currentPage + 1 ?>"
           class="pagination-btn <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>
</div>
<?php endif; ?>

<!-- Footer Note -->
<div class="text-center mt-3 animate-in" style="font-size:.75rem; color:var(--c-muted);">
    <i class="bi bi-info-circle"></i>
    Skor dihitung berdasarkan persentase kehadiran selama tahun ajaran <?= htmlspecialchars($tahun) ?>
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

    .summary-progress-wrap { flex: 1; min-width: 120px; }

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
    .search-input-wrapper { position: relative; }

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
        align-items: center;
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

    .legend-divider {
        width: 1px;
        height: 18px;
        background: var(--c-border);
    }

    .legend-skor {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: inline-block;
    }

    .legend-skor.skor-excellent { background: var(--c-forest-mid); }
    .legend-skor.skor-good      { background: var(--c-gold); }
    .legend-skor.skor-warning   { background: #f59e0b; }
    .legend-skor.skor-danger    { background: #b93232; }

    /* ── Table ── */
    .table-tahunan { min-width: 700px; }

    .table-tahunan thead th {
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

    .th-sticky-left { background: var(--c-parchment); }

    .th-nama { min-width: 180px; }
    .td-nama { min-width: 180px; }

    .th-center {
        text-align: center;
        min-width: 70px;
    }

    /* Status dot in header */
    .th-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin: 0 auto 4px;
    }

    .th-skor {
        background: rgba(201,149,42,.06) !important;
        min-width: 90px;
    }

    .td-center { text-align: center; }

    .td-skor {
        background: rgba(201,149,42,.03);
        padding: 10px 8px !important;
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
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .9rem;
        flex-shrink: 0;
    }

    .skor-excellent-bg { background: rgba(46,94,71,.12); color: var(--c-forest-mid); }
    .skor-good-bg      { background: rgba(201,149,42,.12); color: #a07820; }
    .skor-warning-bg    { background: rgba(245,158,11,.1); color: #b45309; }
    .skor-danger-bg     { background: rgba(185,50,50,.08); color: #b93232; }

    .nama-cell-text {
        font-weight: 600;
        font-size: .85rem;
        color: var(--c-ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    .nama-cell-sub {
        font-size: .68rem;
        color: var(--c-muted);
        font-weight: 500;
    }

    /* ── Value Pills ── */
    .value-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 30px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: .82rem;
        font-weight: 700;
        font-family: var(--font-display);
    }

    .value-pill-neutral {
        background: var(--c-parchment);
        color: var(--c-ink);
    }

    .value-pill-hadir {
        background: rgba(46,94,71,.1);
        color: var(--c-forest-mid);
    }

    .value-pill-izin {
        background: rgba(201,149,42,.1);
        color: #a07820;
    }

    .value-pill-sakit {
        background: rgba(59,130,246,.08);
        color: #3b82f6;
    }

    .value-pill-alfa {
        background: rgba(185,50,50,.06);
        color: #b93232;
    }

    /* ── Skor Ring (SVG Circular) ── */
    .skor-cell {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .skor-ring {
        position: relative;
        width: 48px;
        height: 48px;
    }

    .skor-svg {
        width: 48px;
        height: 48px;
        transform: rotate(-90deg);
    }

    .skor-bg-circle {
        fill: none;
        stroke: var(--c-parchment);
        stroke-width: 3;
    }

    .skor-fill-circle {
        fill: none;
        stroke-width: 3;
        stroke-linecap: round;
        transition: stroke-dasharray .8s ease;
    }

    .skor-excellent .skor-fill-circle { stroke: var(--c-forest-mid); }
    .skor-good .skor-fill-circle      { stroke: var(--c-gold); }
    .skor-warning .skor-fill-circle    { stroke: #f59e0b; }
    .skor-danger .skor-fill-circle     { stroke: #b93232; }

    .skor-value {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: .85rem;
        font-weight: 700;
    }

    .skor-excellent .skor-value { color: var(--c-forest-mid); }
    .skor-good .skor-value      { color: #a07820; }
    .skor-warning .skor-value   { color: #b45309; }
    .skor-danger .skor-value    { color: #b93232; }

    .skor-label {
        font-size: .62rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--c-muted);
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
        .summary-bar { gap: 12px; padding: 14px 18px; }
    }

    @media (max-width: 767.98px) {
        .btn-export span { display: none; }
        .btn-export { padding: 9px 12px; }

        .table-legend { gap: 10px; padding: 10px 16px; }
        .legend-divider { display: none; }

        .nama-cell-avatar { width: 30px; height: 30px; font-size: .78rem; border-radius: 7px; }
        .nama-cell { gap: 7px; }
        .nama-cell-text { font-size: .78rem; max-width: 100px; }
        .nama-cell-sub { display: none; }

        .value-pill { min-width: 28px; height: 26px; font-size: .75rem; padding: 0 7px; }

        .skor-ring { width: 40px; height: 40px; }
        .skor-svg { width: 40px; height: 40px; }
        .skor-value { font-size: .75rem; }
        .skor-label { display: none; }

        .table-scout thead th,
        .table-scout tbody td {
            padding: 8px 6px;
            font-size: .78rem;
        }

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
        .table-legend,
        .summary-bar { display: none !important; }

        .main-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .card-scout {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .skor-ring { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        .value-pill { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    /**
     * Search Laporan Tahunan
     */
    function searchTahunan(query) {
        query = query.toLowerCase().trim();
        const rows      = document.querySelectorAll('.tahunan-row');
        const noResult  = document.getElementById('noTahunanResult');
        const tableView = document.getElementById('tahunanTableView');
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
    const searchDesktop = document.getElementById('searchTahunan');
    if (searchDesktop) {
        searchDesktop.addEventListener('input', function () {
            searchTahunan(this.value);
            document.querySelectorAll('.search-tahunan-mobile').forEach(el => el.value = this.value);
        });
    }

    // Mobile search
    document.querySelectorAll('.search-tahunan-mobile').forEach(el => {
        el.addEventListener('input', function () {
            searchTahunan(this.value);
            if (searchDesktop) searchDesktop.value = this.value;
        });
    });

    /**
     * Animate SVG circles + progress bars on scroll
     */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Animate summary progress
                entry.target.querySelectorAll('.summary-progress-fill').forEach(el => {
                    const w = el.style.width;
                    el.style.width = '0%';
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => { el.style.width = w; });
                    });
                });

                // Animate skor circles
                entry.target.querySelectorAll('.skor-fill-circle').forEach(el => {
                    const dash = el.getAttribute('stroke-dasharray');
                    el.setAttribute('stroke-dasharray', '0, 100');
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            el.setAttribute('stroke-dasharray', dash);
                        });
                    });
                });

                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.summary-bar, .table-tahunan').forEach(el => observer.observe(el));
</script>