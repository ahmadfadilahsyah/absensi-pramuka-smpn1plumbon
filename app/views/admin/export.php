<!-- ══════════════════════════════
     EKSPOR DATA ABSENSI PAGE
══════════════════════════════ -->

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Data & Ekspor</div>
        <h1 class="page-header-title">Ekspor Data Absensi</h1>
        <p class="page-header-sub">Unduh rekap kehadiran dalam format PDF atau Excel sesuai periode</p>
    </div>
    <a href="<?= BASE_URL ?>/AdminController/dashboard" class="btn-scout-outline">
        <i class="bi bi-arrow-left"></i> Dashboard
    </a>
</div>

<div class="row g-4">

    <!-- ═══════════════════════════
         LEFT: FORM EKSPOR
    ═══════════════════════════ -->
    <div class="col-lg-7 animate-in">
        <div class="card-scout card-scout-form">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-download"></i>
                </div>
                <div>
                    <div class="card-scout-title">Konfigurasi Ekspor</div>
                    <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                        Pilih periode dan format file yang diinginkan
                    </div>
                </div>
            </div>

            <div class="card-scout-body">
                <form method="GET" action="" id="exportForm" target="_blank" class="form-scout">

                    <!-- Step 1: Periode -->
                    <div class="export-step">
                        <div class="export-step-number">1</div>
                        <div class="export-step-content">
                            <label class="form-label">
                                <i class="bi bi-calendar-range" style="color:var(--c-gold); margin-right:4px;"></i>
                                Pilih Periode
                            </label>
                            <div class="periode-selector">
                                <label class="periode-option active" data-value="hari">
                                    <input type="radio" name="periode_radio" value="hari" checked>
                                    <div class="periode-option-inner">
                                        <i class="bi bi-calendar-day"></i>
                                        <span class="periode-option-label">Harian</span>
                                        <span class="periode-option-desc">1 hari</span>
                                    </div>
                                </label>
                                <label class="periode-option" data-value="minggu">
                                    <input type="radio" name="periode_radio" value="minggu">
                                    <div class="periode-option-inner">
                                        <i class="bi bi-calendar-week"></i>
                                        <span class="periode-option-label">Mingguan</span>
                                        <span class="periode-option-desc">7 hari</span>
                                    </div>
                                </label>
                                <label class="periode-option" data-value="bulan">
                                    <input type="radio" name="periode_radio" value="bulan">
                                    <div class="periode-option-inner">
                                        <i class="bi bi-calendar-month"></i>
                                        <span class="periode-option-label">Bulanan</span>
                                        <span class="periode-option-desc">1 bulan</span>
                                    </div>
                                </label>
                                <label class="periode-option" data-value="tahun">
                                    <input type="radio" name="periode_radio" value="tahun">
                                    <div class="periode-option-inner">
                                        <i class="bi bi-calendar-range"></i>
                                        <span class="periode-option-label">Tahunan</span>
                                        <span class="periode-option-desc">1 tahun</span>
                                    </div>
                                </label>
                            </div>
                            <!-- Hidden select for form submission -->
                            <select name="periode" id="periode" class="d-none" required>
                                <option value="hari" selected>Per Hari</option>
                                <option value="minggu">Per Minggu</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 2: Detail Periode -->
                    <div class="export-step">
                        <div class="export-step-number">2</div>
                        <div class="export-step-content">

                            <!-- Hari -->
                            <div id="hari" class="periode-group">
                                <label class="form-label">
                                    <i class="bi bi-calendar-date" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Pilih Tanggal
                                </label>
                                <input type="date"
                                       name="tanggal"
                                       class="form-control"
                                       id="inputHari"
                                       value="<?= date('Y-m-d') ?>">
                                <div class="form-hint" id="hintHari"></div>
                            </div>

                            <!-- Minggu -->
                            <div id="minggu" class="periode-group" style="display:none;">
                                <label class="form-label">
                                    <i class="bi bi-calendar-week" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Pilih Hari dalam Minggu
                                </label>
                                <input type="date"
                                       name="minggu"
                                       class="form-control"
                                       id="inputMinggu"
                                       value="<?= date('Y-m-d') ?>">
                                <div class="form-hint" id="hintMinggu">
                                    <i class="bi bi-info-circle"></i>
                                    Pilih salah satu hari, data seminggu akan otomatis diambil
                                </div>
                            </div>

                            <!-- Bulan -->
                            <div id="bulan" class="periode-group" style="display:none;">
                                <label class="form-label">
                                    <i class="bi bi-calendar-month" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Pilih Bulan
                                </label>
                                <input type="month"
                                       name="bulan"
                                       class="form-control"
                                       id="inputBulan"
                                       value="<?= date('Y-m') ?>">
                                <div class="form-hint" id="hintBulan"></div>
                            </div>

                            <!-- Tahun -->
                            <div id="tahun" class="periode-group" style="display:none;">
                                <label class="form-label">
                                    <i class="bi bi-calendar-range" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Pilih Tahun
                                </label>
                                <select name="tahun" class="form-select" id="inputTahun">
                                    <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
                                        <option value="<?= $y ?>" <?= $y == date('Y') ? 'selected' : '' ?>><?= $y ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- Step 3: Preview & Ekspor -->
                    <div class="export-step">
                        <div class="export-step-number">3</div>
                        <div class="export-step-content">
                            <label class="form-label">
                                <i class="bi bi-file-earmark-arrow-down" style="color:var(--c-gold); margin-right:4px;"></i>
                                Pilih Format & Ekspor
                            </label>

                            <!-- Preview Card -->
                            <div class="export-preview" id="exportPreview">
                                <div class="export-preview-header">
                                    <i class="bi bi-eye"></i> Preview Konfigurasi
                                </div>
                                <div class="export-preview-body">
                                    <div class="export-preview-row">
                                        <span class="export-preview-label">Periode</span>
                                        <span class="export-preview-value" id="prevPeriode">Harian</span>
                                    </div>
                                    <div class="export-preview-row">
                                        <span class="export-preview-label">Rentang</span>
                                        <span class="export-preview-value" id="prevRentang"><?= date('d F Y') ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Export Buttons -->
                            <div class="export-buttons">
                                <button type="button"
                                        id="btnPDF"
                                        class="export-btn export-btn-pdf">
                                    <div class="export-btn-icon">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div class="export-btn-info">
                                        <div class="export-btn-title">Export PDF</div>
                                        <div class="export-btn-desc">Format cetak, siap print</div>
                                    </div>
                                    <i class="bi bi-download export-btn-arrow"></i>
                                </button>

                                <button type="button"
                                        id="btnExcel"
                                        class="export-btn export-btn-excel">
                                    <div class="export-btn-icon">
                                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    </div>
                                    <div class="export-btn-info">
                                        <div class="export-btn-title">Export Excel</div>
                                        <div class="export-btn-desc">Format CSV, bisa diedit</div>
                                    </div>
                                    <i class="bi bi-download export-btn-arrow"></i>
                                </button>
                            </div>

                            <!-- Cancel -->
                            <a href="<?= BASE_URL ?>/AdminController/dashboard"
                               class="btn-scout-outline w-100 justify-content-center mt-3">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════
         RIGHT: INFO & TIPS
    ═══════════════════════════ -->
    <div class="col-lg-5 animate-in">

        <!-- Format Info Cards -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="card-scout-title">Panduan Format</div>
            </div>
            <div class="card-scout-body" style="padding:20px 24px;">

                <div class="format-info-card">
                    <div class="format-info-icon pdf">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </div>
                    <div class="format-info-content">
                        <div class="format-info-title">PDF</div>
                        <div class="format-info-desc">
                            Cocok untuk dicetak langsung. Tata letak rapi dengan header sekolah.
                        </div>
                        <div class="format-info-tags">
                            <span class="format-tag">Print-ready</span>
                            <span class="format-tag">Read-only</span>
                        </div>
                    </div>
                </div>

                <div class="format-info-divider"></div>

                <div class="format-info-card">
                    <div class="format-info-icon excel">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    </div>
                    <div class="format-info-content">
                        <div class="format-info-title">Excel / CSV</div>
                        <div class="format-info-desc">
                            Bisa dibuka di Excel atau Google Sheets. Data mudah dianalisis dan diedit.
                        </div>
                        <div class="format-info-tags">
                            <span class="format-tag">Editable</span>
                            <span class="format-tag">Spreadsheet</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Period Info Cards -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-calendar3"></i>
                </div>
                <div class="card-scout-title">Pilihan Periode</div>
            </div>
            <div class="card-scout-body" style="padding:16px 24px;">
                <div class="period-info-list">
                    <div class="period-info-item">
                        <div class="period-info-badge green">
                            <i class="bi bi-calendar-day"></i>
                        </div>
                        <div>
                            <div class="period-info-name">Harian</div>
                            <div class="period-info-desc">Data absensi 1 hari yang dipilih</div>
                        </div>
                    </div>
                    <div class="period-info-item">
                        <div class="period-info-badge gold">
                            <i class="bi bi-calendar-week"></i>
                        </div>
                        <div>
                            <div class="period-info-name">Mingguan</div>
                            <div class="period-info-desc">Senin–Minggu pada minggu yang dipilih</div>
                        </div>
                    </div>
                    <div class="period-info-item">
                        <div class="period-info-badge blue">
                            <i class="bi bi-calendar-month"></i>
                        </div>
                        <div>
                            <div class="period-info-name">Bulanan</div>
                            <div class="period-info-desc">Seluruh data dalam 1 bulan</div>
                        </div>
                    </div>
                    <div class="period-info-item">
                        <div class="period-info-badge red">
                            <i class="bi bi-calendar-range"></i>
                        </div>
                        <div>
                            <div class="period-info-name">Tahunan</div>
                            <div class="period-info-desc">Rekap lengkap 1 tahun ajaran</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Card -->
        <div class="tips-card animate-in">
            <div class="tips-card-title">
                <i class="bi bi-lightbulb-fill"></i> Tips Ekspor
            </div>
            <ul>
                <li>File akan terbuka di tab baru setelah proses selesai</li>
                <li>Untuk mencetak, gunakan format PDF lalu tekan <kbd>Ctrl+P</kbd></li>
                <li>File CSV bisa langsung di-import ke Google Sheets</li>
                <li>Pastikan data absensi sudah lengkap sebelum mengekspor</li>
            </ul>
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
    /* ── Card Form no-hover ── */
    .card-scout-form:hover {
        transform: none;
    }

    /* ── Export Steps ── */
    .export-step {
        display: flex;
        gap: 16px;
        padding-bottom: 28px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--c-border);
        position: relative;
    }

    .export-step:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    /* Connecting line */
    .export-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 17px;
        top: 42px;
        bottom: -4px;
        width: 2px;
        background: linear-gradient(to bottom, var(--c-gold-light), var(--c-border));
    }

    .export-step-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(201, 149, 42, .25);
        position: relative;
        z-index: 1;
    }

    .export-step-content {
        flex: 1;
        min-width: 0;
    }

    /* ── Periode Selector (Radio Cards) ── */
    .periode-selector {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 4px;
    }

    .periode-option {
        cursor: pointer;
        margin: 0;
    }

    .periode-option input[type="radio"] {
        display: none;
    }

    .periode-option-inner {
        padding: 14px 16px;
        border: 1.5px solid var(--c-border);
        border-radius: var(--radius-sm);
        background: var(--c-white);
        text-align: center;
        transition: all .25s;
    }

    .periode-option-inner i {
        font-size: 1.4rem;
        color: var(--c-muted);
        display: block;
        margin-bottom: 6px;
        transition: color .25s;
    }

    .periode-option-label {
        display: block;
        font-weight: 600;
        font-size: .82rem;
        color: var(--c-ink);
        line-height: 1.3;
    }

    .periode-option-desc {
        display: block;
        font-size: .68rem;
        color: var(--c-muted);
        margin-top: 2px;
    }

    .periode-option:hover .periode-option-inner {
        border-color: var(--c-gold);
        background: rgba(201, 149, 42, .03);
    }

    .periode-option:hover .periode-option-inner i {
        color: var(--c-gold);
    }

    .periode-option.active .periode-option-inner {
        border-color: var(--c-gold);
        background: rgba(201, 149, 42, .06);
        box-shadow: 0 0 0 3px rgba(201, 149, 42, .1);
    }

    .periode-option.active .periode-option-inner i {
        color: var(--c-gold);
    }

    .periode-option.active .periode-option-label {
        color: var(--c-forest);
    }

    /* ── Form Hint ── */
    .form-hint {
        font-size: .72rem;
        color: var(--c-gold);
        font-weight: 500;
        margin-top: 5px;
        min-height: 18px;
    }

    .form-hint i {
        margin-right: 3px;
    }

    /* ── Export Preview ── */
    .export-preview {
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        margin-bottom: 16px;
        overflow: hidden;
    }

    .export-preview-header {
        padding: 10px 16px;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .8rem;
        color: var(--c-forest);
        border-bottom: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .export-preview-header i {
        color: var(--c-gold);
    }

    .export-preview-body {
        padding: 12px 16px;
    }

    .export-preview-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 0;
    }

    .export-preview-row:not(:last-child) {
        border-bottom: 1px dashed rgba(27, 58, 45, .08);
    }

    .export-preview-label {
        font-size: .72rem;
        color: var(--c-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .export-preview-value {
        font-size: .85rem;
        font-weight: 600;
        color: var(--c-ink);
    }

    /* ── Export Buttons (Big Cards) ── */
    .export-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .export-btn {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 20px;
        border-radius: var(--radius-md);
        border: 1.5px solid;
        background: var(--c-white);
        cursor: pointer;
        transition: all .25s;
        font-family: var(--font-body);
        width: 100%;
        text-align: left;
    }

    .export-btn:hover {
        transform: translateY(-2px);
    }

    .export-btn-icon {
        width: 46px;
        height: 46px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .export-btn-info {
        flex: 1;
    }

    .export-btn-title {
        font-weight: 600;
        font-size: .9rem;
        line-height: 1.3;
    }

    .export-btn-desc {
        font-size: .72rem;
        color: var(--c-muted);
        margin-top: 2px;
    }

    .export-btn-arrow {
        font-size: 1.1rem;
        opacity: .4;
        transition: opacity .25s, transform .25s;
    }

    .export-btn:hover .export-btn-arrow {
        opacity: 1;
        transform: translateY(2px);
    }

    /* PDF */
    .export-btn-pdf {
        border-color: rgba(185, 50, 50, .15);
    }

    .export-btn-pdf .export-btn-icon {
        background: rgba(185, 50, 50, .08);
        color: #b93232;
    }

    .export-btn-pdf .export-btn-title { color: #b93232; }

    .export-btn-pdf:hover {
        border-color: #b93232;
        background: rgba(185, 50, 50, .02);
        box-shadow: 0 6px 20px rgba(185, 50, 50, .12);
    }

    /* Excel */
    .export-btn-excel {
        border-color: rgba(46, 94, 71, .15);
    }

    .export-btn-excel .export-btn-icon {
        background: rgba(46, 94, 71, .08);
        color: var(--c-forest-mid);
    }

    .export-btn-excel .export-btn-title { color: var(--c-forest-mid); }

    .export-btn-excel:hover {
        border-color: var(--c-forest-mid);
        background: rgba(46, 94, 71, .02);
        box-shadow: 0 6px 20px rgba(46, 94, 71, .12);
    }

    /* ── Format Info Cards ── */
    .format-info-card {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .format-info-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .format-info-icon.pdf {
        background: rgba(185, 50, 50, .08);
        color: #b93232;
    }

    .format-info-icon.excel {
        background: rgba(46, 94, 71, .08);
        color: var(--c-forest-mid);
    }

    .format-info-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .9rem;
        color: var(--c-forest);
    }

    .format-info-desc {
        font-size: .78rem;
        color: var(--c-muted);
        margin-top: 3px;
        line-height: 1.5;
    }

    .format-info-tags {
        display: flex;
        gap: 6px;
        margin-top: 8px;
    }

    .format-tag {
        padding: 2px 10px;
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-pill);
        font-size: .65rem;
        font-weight: 600;
        color: var(--c-muted);
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .format-info-divider {
        height: 1px;
        background: var(--c-border);
        margin: 16px 0;
    }

    /* ── Period Info List ── */
    .period-info-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .period-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: var(--radius-sm);
        transition: background .2s;
    }

    .period-info-item:hover {
        background: var(--c-parchment);
    }

    .period-info-badge {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .period-info-badge.green { background: rgba(46, 94, 71, .1);  color: var(--c-forest-mid); }
    .period-info-badge.gold  { background: rgba(201, 149, 42, .1); color: var(--c-gold); }
    .period-info-badge.blue  { background: rgba(59, 130, 246, .08); color: #3b82f6; }
    .period-info-badge.red   { background: rgba(185, 50, 50, .06); color: #b93232; }

    .period-info-name {
        font-weight: 600;
        font-size: .85rem;
        color: var(--c-ink);
    }

    .period-info-desc {
        font-size: .72rem;
        color: var(--c-muted);
        margin-top: 1px;
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

    .tips-card kbd {
        background: var(--c-white);
        border: 1px solid var(--c-border);
        border-radius: 4px;
        padding: 1px 6px;
        font-size: .72rem;
        font-family: var(--font-body);
        color: var(--c-forest);
    }

    /* ── Responsive ── */
    @media (max-width: 767.98px) {
        .periode-selector {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .periode-option-inner {
            padding: 10px 10px;
        }

        .periode-option-inner i {
            font-size: 1.2rem;
        }

        .export-step::after { display: none; }
        .export-step { gap: 12px; }

        .export-btn {
            padding: 14px 16px;
            gap: 12px;
        }

        .export-btn-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 575.98px) {
        .periode-selector {
            grid-template-columns: 1fr 1fr;
        }

        .periode-option-desc { display: none; }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    const periodeSelect = document.getElementById('periode');
    const groups        = document.querySelectorAll('.periode-group');
    const periodeOptions = document.querySelectorAll('.periode-option');

    const hariNames  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanNames = ['Januari','Februari','Maret','April','Mei','Juni',
                        'Juli','Agustus','September','Oktober','November','Desember'];

    /**
     * Show/hide periode fields
     */
    function showPeriode(value) {
        groups.forEach(group => {
            group.style.display = 'none';
            group.style.opacity = '0';
        });

        const target = document.getElementById(value);
        if (target) {
            target.style.display = 'block';
            requestAnimationFrame(() => {
                target.style.transition = 'opacity .3s ease';
                target.style.opacity = '1';
            });
        }

        // Update select
        periodeSelect.value = value;

        // Update radio cards
        periodeOptions.forEach(opt => {
            opt.classList.toggle('active', opt.dataset.value === value);
        });

        updatePreview();
    }

    // Periode radio cards
    periodeOptions.forEach(opt => {
        opt.addEventListener('click', function () {
            showPeriode(this.dataset.value);
        });
    });

    // Initialize
    showPeriode('hari');

    /**
     * Update preview
     */
    function updatePreview() {
        const value = periodeSelect.value;
        const prevPeriode = document.getElementById('prevPeriode');
        const prevRentang = document.getElementById('prevRentang');

        const labels = {
            hari:   'Harian',
            minggu: 'Mingguan',
            bulan:  'Bulanan',
            tahun:  'Tahunan'
        };

        prevPeriode.textContent = labels[value] || value;

        if (value === 'hari') {
            const d = new Date(document.getElementById('inputHari').value + 'T00:00:00');
            if (!isNaN(d)) {
                prevRentang.textContent = hariNames[d.getDay()] + ', ' +
                    d.getDate() + ' ' + bulanNames[d.getMonth()] + ' ' + d.getFullYear();
            }
        } else if (value === 'minggu') {
            const d = new Date(document.getElementById('inputMinggu').value + 'T00:00:00');
            if (!isNaN(d)) {
                const day = d.getDay();
                const monday = new Date(d);
                monday.setDate(d.getDate() - ((day + 6) % 7));
                const sunday = new Date(monday);
                sunday.setDate(monday.getDate() + 6);
                prevRentang.textContent =
                    monday.getDate() + ' ' + bulanNames[monday.getMonth()] +
                    ' — ' +
                    sunday.getDate() + ' ' + bulanNames[sunday.getMonth()] + ' ' + sunday.getFullYear();
            }
        } else if (value === 'bulan') {
            const val = document.getElementById('inputBulan').value;
            if (val) {
                const [y, m] = val.split('-');
                prevRentang.textContent = bulanNames[parseInt(m) - 1] + ' ' + y;
            }
        } else if (value === 'tahun') {
            prevRentang.textContent = 'Tahun ' + document.getElementById('inputTahun').value;
        }
    }

    // Listen to date changes
    document.getElementById('inputHari').addEventListener('change', function () {
        const d = new Date(this.value + 'T00:00:00');
        if (!isNaN(d)) {
            document.getElementById('hintHari').innerHTML =
                '<i class="bi bi-calendar2-check"></i> ' +
                hariNames[d.getDay()] + ', ' + d.getDate() + ' ' +
                bulanNames[d.getMonth()] + ' ' + d.getFullYear();
        }
        updatePreview();
    });

    document.getElementById('inputMinggu').addEventListener('change', function () {
        const d = new Date(this.value + 'T00:00:00');
        if (!isNaN(d)) {
            const day = d.getDay();
            const monday = new Date(d);
            monday.setDate(d.getDate() - ((day + 6) % 7));
            const sunday = new Date(monday);
            sunday.setDate(monday.getDate() + 6);

            document.getElementById('hintMinggu').innerHTML =
                '<i class="bi bi-calendar2-range"></i> Minggu: ' +
                monday.getDate() + ' ' + bulanNames[monday.getMonth()] +
                ' — ' +
                sunday.getDate() + ' ' + bulanNames[sunday.getMonth()] + ' ' + sunday.getFullYear();
        }
        updatePreview();
    });

    document.getElementById('inputBulan').addEventListener('change', function () {
        if (this.value) {
            const [y, m] = this.value.split('-');
            document.getElementById('hintBulan').innerHTML =
                '<i class="bi bi-calendar2-month"></i> ' + bulanNames[parseInt(m) - 1] + ' ' + y;
        }
        updatePreview();
    });

    document.getElementById('inputTahun').addEventListener('change', updatePreview);

    // Initial hints
    (function () {
        const d = new Date();
        document.getElementById('hintHari').innerHTML =
            '<i class="bi bi-calendar2-check"></i> ' +
            hariNames[d.getDay()] + ', ' + d.getDate() + ' ' +
            bulanNames[d.getMonth()] + ' ' + d.getFullYear();
    })();

    /**
     * Export submit handler
     */
    function submitExport(type) {
        const form    = document.getElementById('exportForm');
        const periode = periodeSelect.value;

        if (type === 'pdf') {
            form.action = '<?= BASE_URL ?>/AdminController/exportData';
        } else {
            form.action = '<?= BASE_URL ?>/AdminController/exportExcel';
        }

        // Disable inputs not matching current periode
        const allInputs = form.querySelectorAll('input, select');
        allInputs.forEach(input => {
            if (input.name && input.name !== 'periode' && input.name !== 'periode_radio') {
                input.disabled = (input.name !== periode);
            }
        });

        form.submit();

        // Re-enable all
        setTimeout(() => {
            allInputs.forEach(input => input.disabled = false);
        }, 100);
    }

    document.getElementById('btnPDF').addEventListener('click', () => submitExport('pdf'));
    document.getElementById('btnExcel').addEventListener('click', () => submitExport('excel'));

    // Initial preview
    updatePreview();
</script>