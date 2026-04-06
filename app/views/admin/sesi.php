<!-- ══════════════════════════════
     KELOLA SESI LATIHAN PAGE
══════════════════════════════ -->

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Manajemen Latihan</div>
        <h1 class="page-header-title">Kelola Sesi Latihan</h1>
        <p class="page-header-sub">Buat jadwal latihan, kelola sesi, dan pantau kehadiran anggota</p>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4 animate-in">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['totalSesi'] ?></div>
                <div class="stat-label">Total Sesi</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="bi bi-calendar-week"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['totalPages'] ?></div>
                <div class="stat-label">Halaman</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-qr-code"></i>
            </div>
            <div>
                <div class="stat-value"><?= count($data['sesi_list']) ?></div>
                <div class="stat-label">Sesi Ditampilkan</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['currentPage'] ?></div>
                <div class="stat-label">Halaman Aktif</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <!-- ═══════════════════════════
         LEFT: BUAT SESI BARU
    ═══════════════════════════ -->
    <div class="col-lg-5 animate-in">
        <div class="card-scout card-scout-form">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-plus-circle-fill"></i>
                </div>
                <div>
                    <div class="card-scout-title">Buat Sesi Baru</div>
                    <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                        Isi detail untuk membuat jadwal latihan baru
                    </div>
                </div>
            </div>

            <div class="card-scout-body">

                <!-- Alert -->
                <?php if (isset($data['success'])): ?>
                    <div class="alert-scout alert-scout-success animate-in">
                        <div class="alert-scout-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div class="alert-scout-title">Berhasil!</div>
                            <div class="alert-scout-text"><?= htmlspecialchars($data['success']) ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($data['error'])): ?>
                    <div class="alert-scout alert-scout-danger animate-in">
                        <div class="alert-scout-icon">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <div class="alert-scout-title">Gagal!</div>
                            <div class="alert-scout-text"><?= htmlspecialchars($data['error']) ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="POST" class="form-scout" id="formSesi">

                    <!-- Nama Sesi -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-bookmark" style="color:var(--c-gold); margin-right:4px;"></i>
                            Nama Sesi
                        </label>
                        <input type="text"
                               name="nama_sesi"
                               class="form-control"
                               placeholder="Contoh: Latihan Tali Temali"
                               required>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar3" style="color:var(--c-gold); margin-right:4px;"></i>
                            Tanggal Latihan
                        </label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               id="inputTanggal"
                               required>
                        <div class="form-hint" id="hariHint"></div>
                    </div>

                    <!-- Divider -->
                    <div class="form-divider">
                        <span>Waktu Pelaksanaan</span>
                    </div>

                    <!-- Waktu Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">
                                <i class="bi bi-play-circle" style="color:var(--c-gold); margin-right:4px;"></i>
                                Mulai
                            </label>
                            <input type="time"
                                   name="waktu_mulai"
                                   class="form-control"
                                   id="inputMulai"
                                   required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                <i class="bi bi-stop-circle" style="color:var(--c-gold); margin-right:4px;"></i>
                                Selesai
                            </label>
                            <input type="time"
                                   name="waktu_selesai"
                                   class="form-control"
                                   id="inputSelesai"
                                   required>
                        </div>
                    </div>

                    <!-- Duration Preview -->
                    <div class="duration-preview" id="durationPreview" style="display:none;">
                        <i class="bi bi-hourglass-split"></i>
                        <span id="durationText"></span>
                    </div>

                    <!-- Preview Card -->
                    <div class="sesi-preview" id="sesiPreview" style="display:none;">
                        <div class="sesi-preview-title">
                            <i class="bi bi-eye"></i> Preview Sesi
                        </div>
                        <div class="sesi-preview-content">
                            <div class="sesi-preview-row">
                                <span class="sesi-preview-label">Sesi</span>
                                <span class="sesi-preview-value" id="prevNama">—</span>
                            </div>
                            <div class="sesi-preview-row">
                                <span class="sesi-preview-label">Tanggal</span>
                                <span class="sesi-preview-value" id="prevTanggal">—</span>
                            </div>
                            <div class="sesi-preview-row">
                                <span class="sesi-preview-label">Waktu</span>
                                <span class="sesi-preview-value" id="prevWaktu">—</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-scout w-100 mt-3">
                        <i class="bi bi-plus-lg"></i> Buat Sesi Latihan
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Tips -->
        <div class="tips-card mt-3 animate-in">
            <div class="tips-card-title">
                <i class="bi bi-lightbulb-fill"></i> Tips Cepat
            </div>
            <ul>
                <li>Sesi yang sudah dibuat akan otomatis menghasilkan QR Code</li>
                <li>Anggota dapat melakukan absensi melalui scan QR Code</li>
                <li>Klik <strong>Rekap</strong> untuk melihat detail kehadiran</li>
            </ul>
        </div>
    </div>

    <!-- ═══════════════════════════
         RIGHT: DAFTAR SESI
    ═══════════════════════════ -->
    <div class="col-lg-7 animate-in">
        <div class="card-scout">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>
                <div style="flex:1;">
                    <div class="card-scout-title">Daftar Sesi Latihan</div>
                    <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                        Halaman <?= $data['currentPage'] ?> dari <?= $data['totalPages'] ?>
                        &nbsp;·&nbsp; <?= $data['totalSesi'] ?> sesi total
                    </div>
                </div>
                <!-- Search -->
                <div class="sesi-search-wrap d-none d-md-block">
                    <div class="search-input-wrapper" style="min-width:180px;">
                        <i class="bi bi-search search-input-icon"></i>
                        <input type="text"
                               id="searchSesi"
                               class="form-control search-input"
                               placeholder="Cari sesi...">
                    </div>
                </div>
            </div>

            <div class="card-scout-body" style="padding:0;">

                <!-- Mobile Search -->
                <div class="d-md-none" style="padding:14px 20px 0;">
                    <div class="search-input-wrapper">
                        <i class="bi bi-search search-input-icon"></i>
                        <input type="text"
                               class="form-control search-input search-sesi-input"
                               placeholder="Cari sesi...">
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive" id="sesiTableView">
                    <table class="table-scout" id="sesiTable">
                        <thead>
                            <tr>
                                <th style="width:48px;">No</th>
                                <th>Nama Sesi</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th style="width:200px; text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = ($data['currentPage'] - 1) * 12 + 1;
                            foreach ($data['sesi_list'] as $sesi):
                                // Format hari
                                $days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                                $dayIndex = date('w', strtotime($sesi['tanggal']));
                                $hariNama = $days[$dayIndex];
                                $tanggalFormatted = date('d M Y', strtotime($sesi['tanggal']));
                            ?>
                            <tr class="sesi-row"
                                data-nama="<?= strtolower(htmlspecialchars($sesi['nama_sesi'])) ?>"
                                data-tanggal="<?= $sesi['tanggal'] ?>">
                                <td>
                                    <span class="row-number"><?= $no++ ?></span>
                                </td>
                                <td>
                                    <div class="sesi-cell">
                                        <div class="sesi-cell-icon">
                                            <i class="bi bi-journal-bookmark-fill"></i>
                                        </div>
                                        <div>
                                            <div class="sesi-cell-name"><?= htmlspecialchars($sesi['nama_sesi']) ?></div>
                                            <div class="sesi-cell-id">ID: #<?= $sesi['id'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="tanggal-cell">
                                        <div class="tanggal-day"><?= $hariNama ?></div>
                                        <div class="tanggal-date"><?= $tanggalFormatted ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="waktu-cell">
                                        <span class="waktu-badge">
                                            <i class="bi bi-clock"></i>
                                            <?= substr($sesi['waktu_mulai'], 0, 5) ?>
                                        </span>
                                        <span class="waktu-separator">→</span>
                                        <span class="waktu-badge">
                                            <i class="bi bi-clock-fill"></i>
                                            <?= substr($sesi['waktu_selesai'], 0, 5) ?>
                                        </span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <div class="action-buttons">
                                        <a href="<?= BASE_URL ?>/AdminController/rekap/<?= $sesi['id'] ?>"
                                           class="btn-action btn-action-rekap"
                                           title="Lihat Rekap Kehadiran">
                                            <i class="bi bi-clipboard-data"></i>
                                            <span>Rekap</span>
                                        </a>
                                        <a href="<?= BASE_URL ?>/AbsensiController/qr/<?= $sesi['id'] ?>"
                                           class="btn-action btn-action-qr"
                                           title="Lihat QR Code"
                                           target="_blank">
                                            <i class="bi bi-qr-code"></i>
                                            <span>QR Code</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <?php if (empty($data['sesi_list'])): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="bi bi-calendar-x"></i>
                                        </div>
                                        <div class="empty-state-title">Belum Ada Sesi Latihan</div>
                                        <div class="empty-state-text">
                                            Buat sesi latihan pertama menggunakan form di samping
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- No Search Result -->
                <div class="empty-state" id="noSesiResult" style="display:none;">
                    <div class="empty-state-icon"><i class="bi bi-search"></i></div>
                    <div class="empty-state-title">Tidak Ditemukan</div>
                    <div class="empty-state-text">Coba ubah kata kunci pencarian</div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($data['totalPages'] > 1): ?>
        <div class="pagination-scout animate-in">
            <div class="pagination-info">
                Menampilkan halaman <strong><?= $data['currentPage'] ?></strong>
                dari <strong><?= $data['totalPages'] ?></strong>
            </div>
            <div class="pagination-buttons">
                <a href="?page=<?= $data['currentPage'] - 1 ?>"
                   class="pagination-btn <?= $data['currentPage'] == 1 ? 'disabled' : '' ?>">
                    <i class="bi bi-chevron-left"></i>
                </a>

                <?php
                $start = max(1, $data['currentPage'] - 2);
                $end   = min($data['totalPages'], $data['currentPage'] + 2);
                ?>

                <?php if ($start > 1): ?>
                    <a href="?page=1" class="pagination-btn">1</a>
                    <?php if ($start > 2): ?>
                        <span class="pagination-dots">···</span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <a href="?page=<?= $i ?>"
                       class="pagination-btn <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($end < $data['totalPages']): ?>
                    <?php if ($end < $data['totalPages'] - 1): ?>
                        <span class="pagination-dots">···</span>
                    <?php endif; ?>
                    <a href="?page=<?= $data['totalPages'] ?>" class="pagination-btn">
                        <?= $data['totalPages'] ?>
                    </a>
                <?php endif; ?>

                <a href="?page=<?= $data['currentPage'] + 1 ?>"
                   class="pagination-btn <?= $data['currentPage'] == $data['totalPages'] ? 'disabled' : '' ?>">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer Note -->
        <div class="text-center mt-3 animate-in" style="font-size:.75rem; color:var(--c-muted);">
            <i class="bi bi-info-circle"></i>
            QR Code akan terbuka di tab baru. Tampilkan di layar agar anggota dapat melakukan scan.
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
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

    .alert-scout-success {
        background: rgba(46,94,71,.06);
        border-color: rgba(46,94,71,.15);
    }

    .alert-scout-success .alert-scout-icon {
        color: var(--c-forest-mid);
        font-size: 1.3rem;
        margin-top: 1px;
    }

    .alert-scout-danger {
        background: rgba(185,50,50,.05);
        border-color: rgba(185,50,50,.12);
    }

    .alert-scout-danger .alert-scout-icon {
        color: #b93232;
        font-size: 1.3rem;
        margin-top: 1px;
    }

    .alert-scout-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .95rem;
        margin-bottom: 2px;
    }

    .alert-scout-success .alert-scout-title { color: var(--c-forest); }
    .alert-scout-danger .alert-scout-title  { color: #8b1a1a; }

    .alert-scout-text {
        font-size: .84rem;
        color: var(--c-muted);
        line-height: 1.5;
    }

    /* ── Form Divider ── */
    .form-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 20px 0 16px;
    }

    .form-divider::before,
    .form-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--c-border);
    }

    .form-divider span {
        font-size: .7rem;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--c-muted);
        white-space: nowrap;
    }

    /* ── Form Hint ── */
    .form-hint {
        font-size: .72rem;
        color: var(--c-gold);
        font-weight: 500;
        margin-top: 5px;
        min-height: 18px;
    }

    /* ── Duration Preview ── */
    .duration-preview {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: rgba(46,94,71,.05);
        border: 1px solid rgba(46,94,71,.1);
        border-radius: var(--radius-sm);
        font-size: .82rem;
        font-weight: 500;
        color: var(--c-forest-mid);
        margin-bottom: 12px;
    }

    .duration-preview i {
        color: var(--c-gold);
    }

    /* ── Session Preview Card ── */
    .sesi-preview {
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        padding: 16px;
        margin-top: 16px;
    }

    .sesi-preview-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .82rem;
        color: var(--c-forest);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sesi-preview-title i { color: var(--c-gold); }

    .sesi-preview-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px dashed rgba(27,58,45,.08);
    }

    .sesi-preview-row:last-child { border-bottom: none; }

    .sesi-preview-label {
        font-size: .75rem;
        color: var(--c-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .sesi-preview-value {
        font-size: .85rem;
        font-weight: 600;
        color: var(--c-ink);
    }

    /* ── Card Form no-hover ── */
    .card-scout-form:hover {
        transform: none;
    }

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

    /* ── Sesi Cell ── */
    .sesi-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sesi-cell-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(201,149,42,.1);
        display: grid;
        place-items: center;
        color: var(--c-gold);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .sesi-cell-name {
        font-weight: 600;
        font-size: .9rem;
        color: var(--c-ink);
        line-height: 1.3;
    }

    .sesi-cell-id {
        font-size: .7rem;
        color: var(--c-muted);
        letter-spacing: .04em;
    }

    /* ── Tanggal Cell ── */
    .tanggal-cell {
        line-height: 1.4;
    }

    .tanggal-day {
        font-size: .72rem;
        font-weight: 600;
        color: var(--c-gold);
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .tanggal-date {
        font-size: .85rem;
        color: var(--c-ink);
        font-weight: 500;
    }

    /* ── Waktu Cell ── */
    .waktu-cell {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .waktu-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-pill);
        font-size: .75rem;
        font-weight: 600;
        color: var(--c-forest-mid);
        white-space: nowrap;
    }

    .waktu-badge i {
        font-size: .7rem;
        color: var(--c-gold);
    }

    .waktu-separator {
        font-size: .75rem;
        color: var(--c-muted);
        font-weight: 500;
    }

    /* ── Action Buttons ── */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: var(--radius-pill);
        font-size: .75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        border: 1.5px solid transparent;
        cursor: pointer;
    }

    .btn-action i { font-size: .85rem; }
    .btn-action span { white-space: nowrap; }

    .btn-action-rekap {
        background: rgba(46,94,71,.08);
        color: var(--c-forest-mid);
        border-color: rgba(46,94,71,.15);
    }

    .btn-action-rekap:hover {
        background: var(--c-forest);
        color: var(--c-white);
        border-color: var(--c-forest);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(27,58,45,.2);
    }

    .btn-action-qr {
        background: rgba(201,149,42,.08);
        color: #a07820;
        border-color: rgba(201,149,42,.15);
    }

    .btn-action-qr:hover {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
        border-color: var(--c-gold);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(201,149,42,.3);
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }

    .empty-state-icon {
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

    /* ── Tips Card ── */
    .tips-card {
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        padding: 18px 22px;
    }

    .tips-card-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .85rem;
        color: var(--c-forest);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tips-card-title i { color: var(--c-gold); }

    .tips-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tips-card ul li {
        font-size: .78rem;
        color: var(--c-muted);
        padding: 3px 0 3px 20px;
        position: relative;
        line-height: 1.6;
    }

    .tips-card ul li::before {
        content: '✦';
        position: absolute;
        left: 0;
        color: var(--c-gold);
        font-size: .6rem;
        top: 6px;
    }

    /* ── Row Transition ── */
    .table-scout tbody tr {
        transition: opacity .3s, transform .3s;
    }

    .table-scout tbody tr.hiding {
        opacity: 0;
        transform: scale(.97);
    }

    /* ── Responsive ── */
    @media (max-width: 767.98px) {
        .action-buttons { flex-direction: column; gap: 4px; }
        .btn-action span { display: none; }
        .btn-action { padding: 8px 10px; border-radius: 8px; }
        .waktu-cell { flex-direction: column; gap: 3px; }
        .waktu-separator { display: none; }

        .table-scout thead th,
        .table-scout tbody td {
            padding: 10px;
            font-size: .8rem;
        }

        .sesi-cell-icon { width: 32px; height: 32px; font-size: .85rem; border-radius: 8px; }
        .sesi-cell { gap: 8px; }

        .pagination-scout { justify-content: center; }
        .pagination-info { width: 100%; text-align: center; }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    /**
     * Date → Hari Helper
     */
    const hariNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    const inputTanggal = document.getElementById('inputTanggal');
    const inputMulai   = document.getElementById('inputMulai');
    const inputSelesai = document.getElementById('inputSelesai');
    const hariHint     = document.getElementById('hariHint');

    inputTanggal.addEventListener('change', function () {
        if (this.value) {
            const d = new Date(this.value + 'T00:00:00');
            const hari = hariNames[d.getDay()];
            hariHint.innerHTML = '<i class="bi bi-calendar2-check"></i> ' + hari + ', ' +
                d.getDate() + ' ' + bulanNames[d.getMonth()] + ' ' + d.getFullYear();
        } else {
            hariHint.textContent = '';
        }
        updatePreview();
    });

    /**
     * Duration Calculator
     */
    function calcDuration() {
        const mulai   = inputMulai.value;
        const selesai = inputSelesai.value;
        const preview = document.getElementById('durationPreview');
        const text    = document.getElementById('durationText');

        if (mulai && selesai) {
            const [mH, mM] = mulai.split(':').map(Number);
            const [sH, sM] = selesai.split(':').map(Number);
            let diff = (sH * 60 + sM) - (mH * 60 + mM);

            if (diff > 0) {
                const jam = Math.floor(diff / 60);
                const menit = diff % 60;
                let durStr = '';
                if (jam > 0) durStr += jam + ' jam ';
                if (menit > 0) durStr += menit + ' menit';
                text.textContent = 'Durasi: ' + durStr.trim();
                preview.style.display = 'flex';
            } else {
                preview.style.display = 'none';
            }
        } else {
            preview.style.display = 'none';
        }
        updatePreview();
    }

    inputMulai.addEventListener('change', calcDuration);
    inputSelesai.addEventListener('change', calcDuration);

    /**
     * Live Preview
     */
    function updatePreview() {
        const namaInput = document.querySelector('input[name="nama_sesi"]');
        const nama    = namaInput ? namaInput.value.trim() : '';
        const tanggal = inputTanggal.value;
        const mulai   = inputMulai.value;
        const selesai = inputSelesai.value;
        const preview = document.getElementById('sesiPreview');

        if (nama || tanggal || mulai || selesai) {
            preview.style.display = 'block';

            document.getElementById('prevNama').textContent = nama || '—';

            if (tanggal) {
                const d = new Date(tanggal + 'T00:00:00');
                document.getElementById('prevTanggal').textContent =
                    hariNames[d.getDay()] + ', ' + d.getDate() + ' ' +
                    bulanNames[d.getMonth()] + ' ' + d.getFullYear();
            } else {
                document.getElementById('prevTanggal').textContent = '—';
            }

            if (mulai && selesai) {
                document.getElementById('prevWaktu').textContent = mulai + ' — ' + selesai;
            } else {
                document.getElementById('prevWaktu').textContent = '—';
            }
        } else {
            preview.style.display = 'none';
        }
    }

    // Listen to nama_sesi input
    const namaInput = document.querySelector('input[name="nama_sesi"]');
    if (namaInput) {
        namaInput.addEventListener('input', updatePreview);
    }

    /**
     * Search Sesi
     */
    function searchSesi(query) {
        query = query.toLowerCase().trim();
        const rows = document.querySelectorAll('.sesi-row');
        const noResult = document.getElementById('noSesiResult');
        const tableView = document.getElementById('sesiTableView');
        let visible = 0;

        rows.forEach(row => {
            const nama    = row.dataset.nama || '';
            const tanggal = row.dataset.tanggal || '';

            if (nama.includes(query) || tanggal.includes(query)) {
                row.style.display = '';
                row.classList.remove('hiding');
                visible++;
            } else {
                row.classList.add('hiding');
                setTimeout(() => { row.style.display = 'none'; }, 200);
            }
        });

        if (visible === 0 && query) {
            noResult.style.display = 'block';
            tableView.style.display = 'none';
        } else {
            noResult.style.display = 'none';
            tableView.style.display = '';
        }
    }

    // Desktop search
    const searchDesktop = document.getElementById('searchSesi');
    if (searchDesktop) {
        searchDesktop.addEventListener('input', function () {
            searchSesi(this.value);
        });
    }

    // Mobile search
    document.querySelectorAll('.search-sesi-input').forEach(el => {
        el.addEventListener('input', function () {
            searchSesi(this.value);
            // Sync
            if (searchDesktop) searchDesktop.value = this.value;
        });
    });
</script>