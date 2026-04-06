<!-- ══════════════════════════════
     EDIT STATUS ABSENSI PAGE
══════════════════════════════ -->

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Manajemen Kehadiran</div>
        <h1 class="page-header-title">Edit Status Absensi</h1>
        <p class="page-header-sub">Perbarui status kehadiran anggota pada sesi latihan</p>
    </div>
    <a href="<?= BASE_URL ?>/AdminController/rekap" class="btn-scout-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">

    <!-- ═══════════════════════════
         LEFT: FORM EDIT
    ═══════════════════════════ -->
    <div class="col-lg-7 animate-in">
        <div class="card-scout card-scout-form">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <div class="card-scout-title">Ubah Status Kehadiran</div>
                    <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                        Pilih status baru dan tambahkan keterangan jika diperlukan
                    </div>
                </div>
            </div>

            <div class="card-scout-body">

                <!-- Identity Bar -->
                <div class="absen-identity-card">
                    <div class="absen-identity-row">
                        <div class="absen-identity-avatar">
                            <?= strtoupper(substr($absen['nama_lengkap'], 0, 1)) ?>
                        </div>
                        <div>
                            <div class="absen-identity-name"><?= htmlspecialchars($absen['nama_lengkap']) ?></div>
                            <div class="absen-identity-meta">
                                <i class="bi bi-calendar-event" style="color:var(--c-gold);"></i>
                                <?= htmlspecialchars($absen['nama_sesi']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="absen-identity-current">
                        <div class="absen-identity-current-label">Status Saat Ini</div>
                        <?php
                        $statusClass = [
                            'hadir' => 'status-hadir',
                            'izin'  => 'status-izin',
                            'sakit' => 'status-sakit',
                            'alpha' => 'status-alfa'
                        ];
                        $statusIcon = [
                            'hadir' => 'bi-check-circle-fill',
                            'izin'  => 'bi-envelope-fill',
                            'sakit' => 'bi-heart-pulse-fill',
                            'alpha' => 'bi-x-circle-fill'
                        ];
                        $statusLabel = [
                            'hadir' => 'Hadir',
                            'izin'  => 'Izin',
                            'sakit' => 'Sakit',
                            'alpha' => 'Alfa'
                        ];
                        $currentStatus = $absen['status'];
                        $cls   = $statusClass[$currentStatus] ?? 'status-alfa';
                        $ico   = $statusIcon[$currentStatus] ?? 'bi-question-circle-fill';
                        $lbl   = $statusLabel[$currentStatus] ?? ucfirst($currentStatus);
                        ?>
                        <span class="status-badge-current <?= $cls ?>">
                            <i class="bi <?= $ico ?>"></i> <?= $lbl ?>
                        </span>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" class="form-scout" id="formEditAbsen">

                    <!-- Step 1: Status -->
                    <div class="form-step">
                        <div class="form-step-number">1</div>
                        <div class="form-step-content">
                            <div class="form-step-label">Pilih Status Baru</div>

                            <div class="status-selector" id="statusSelector">
                                <!-- Hadir -->
                                <label class="status-option <?= $currentStatus === 'hadir' ? 'active' : '' ?>" data-value="hadir">
                                    <input type="radio" name="status_radio" value="hadir" <?= $currentStatus === 'hadir' ? 'checked' : '' ?>>
                                    <div class="status-option-inner status-option-hadir">
                                        <div class="status-option-icon">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </div>
                                        <div class="status-option-info">
                                            <span class="status-option-name">Hadir</span>
                                            <span class="status-option-desc">Anggota mengikuti latihan</span>
                                        </div>
                                        <div class="status-option-check">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </label>

                                <!-- Izin -->
                                <label class="status-option <?= $currentStatus === 'izin' ? 'active' : '' ?>" data-value="izin">
                                    <input type="radio" name="status_radio" value="izin" <?= $currentStatus === 'izin' ? 'checked' : '' ?>>
                                    <div class="status-option-inner status-option-izin">
                                        <div class="status-option-icon">
                                            <i class="bi bi-envelope-paper-fill"></i>
                                        </div>
                                        <div class="status-option-info">
                                            <span class="status-option-name">Izin</span>
                                            <span class="status-option-desc">Tidak hadir dengan surat izin</span>
                                        </div>
                                        <div class="status-option-check">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </label>

                                <!-- Sakit -->
                                <label class="status-option <?= $currentStatus === 'sakit' ? 'active' : '' ?>" data-value="sakit">
                                    <input type="radio" name="status_radio" value="sakit" <?= $currentStatus === 'sakit' ? 'checked' : '' ?>>
                                    <div class="status-option-inner status-option-sakit">
                                        <div class="status-option-icon">
                                            <i class="bi bi-heart-pulse-fill"></i>
                                        </div>
                                        <div class="status-option-info">
                                            <span class="status-option-name">Sakit</span>
                                            <span class="status-option-desc">Tidak hadir karena sakit</span>
                                        </div>
                                        <div class="status-option-check">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </label>

                                <!-- Alpha -->
                                <label class="status-option <?= $currentStatus === 'alpha' ? 'active' : '' ?>" data-value="alpha">
                                    <input type="radio" name="status_radio" value="alpha" <?= $currentStatus === 'alpha' ? 'checked' : '' ?>>
                                    <div class="status-option-inner status-option-alfa">
                                        <div class="status-option-icon">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </div>
                                        <div class="status-option-info">
                                            <span class="status-option-name">Alfa</span>
                                            <span class="status-option-desc">Tidak hadir tanpa keterangan</span>
                                        </div>
                                        <div class="status-option-check">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Hidden select for submission -->
                            <select name="status" id="selectStatus" class="d-none">
                                <option value="hadir" <?= $currentStatus === 'hadir' ? 'selected' : '' ?>>Hadir</option>
                                <option value="izin"  <?= $currentStatus === 'izin'  ? 'selected' : '' ?>>Izin</option>
                                <option value="sakit" <?= $currentStatus === 'sakit' ? 'selected' : '' ?>>Sakit</option>
                                <option value="alpha" <?= $currentStatus === 'alpha' ? 'selected' : '' ?>>Alpha</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 2: Keterangan -->
                    <div class="form-step">
                        <div class="form-step-number">2</div>
                        <div class="form-step-content">
                            <div class="form-step-label">Keterangan (Opsional)</div>

                            <label class="form-label">
                                <i class="bi bi-chat-left-text" style="color:var(--c-gold); margin-right:4px;"></i>
                                Tambahkan Catatan
                            </label>
                            <textarea name="keterangan"
                                      id="inputKeterangan"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Contoh: Izin mengikuti lomba karya ilmiah tingkat kabupaten..."
                                      oninput="updatePreview()"><?= htmlspecialchars($absen['keterangan'] ?? '') ?></textarea>
                            <div class="textarea-counter">
                                <span id="charCount">0</span>/500 karakter
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Konfirmasi -->
                    <div class="form-step">
                        <div class="form-step-number">
                            <i class="bi bi-check-lg" style="font-size:.85rem;"></i>
                        </div>
                        <div class="form-step-content">

                            <!-- Change Preview -->
                            <div class="change-preview" id="changePreview">
                                <div class="change-preview-title">
                                    <i class="bi bi-arrow-repeat"></i> Perubahan
                                </div>
                                <div class="change-preview-body">
                                    <div class="change-flow">
                                        <div class="change-from">
                                            <div class="change-label">Sebelum</div>
                                            <span class="status-mini <?= $cls ?>" id="prevStatusOld">
                                                <i class="bi <?= $ico ?>"></i> <?= $lbl ?>
                                            </span>
                                        </div>
                                        <div class="change-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </div>
                                        <div class="change-to">
                                            <div class="change-label">Sesudah</div>
                                            <span class="status-mini <?= $cls ?>" id="prevStatusNew">
                                                <i class="bi <?= $ico ?>"></i> <?= $lbl ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-scout w-100 mt-3">
                                <i class="bi bi-check2-circle"></i> Simpan Perubahan
                            </button>
                            <a href="<?= BASE_URL ?>/AdminController/rekap"
                               class="btn-scout-outline w-100 mt-3 justify-content-center">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════
         RIGHT: INFO & PREVIEW
    ═══════════════════════════ -->
    <div class="col-lg-5 animate-in">

        <!-- Detail Info Card -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>
                <div class="card-scout-title">Detail Absensi</div>
            </div>
            <div class="card-scout-body" style="padding:16px 24px;">
                <div class="detail-info-list">
                    <div class="detail-info-item">
                        <div class="detail-info-icon green">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="detail-info-label">Nama Anggota</div>
                            <div class="detail-info-value"><?= htmlspecialchars($absen['nama_lengkap']) ?></div>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <div class="detail-info-icon gold">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div>
                            <div class="detail-info-label">Sesi Latihan</div>
                            <div class="detail-info-value"><?= htmlspecialchars($absen['nama_sesi']) ?></div>
                        </div>
                    </div>
                    <?php if (isset($absen['tanggal'])): ?>
                    <div class="detail-info-item">
                        <div class="detail-info-icon blue">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div>
                            <div class="detail-info-label">Tanggal</div>
                            <div class="detail-info-value"><?= date('d F Y', strtotime($absen['tanggal'])) ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($absen['waktu_absen'])): ?>
                    <div class="detail-info-item">
                        <div class="detail-info-icon green">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div>
                            <div class="detail-info-label">Waktu Absen</div>
                            <div class="detail-info-value"><?= $absen['waktu_absen'] ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Status Guide -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="card-scout-title">Panduan Status</div>
            </div>
            <div class="card-scout-body" style="padding:16px 24px;">
                <div class="status-guide-list">
                    <div class="status-guide-item">
                        <span class="status-guide-dot hadir"></span>
                        <div>
                            <div class="status-guide-name">Hadir</div>
                            <div class="status-guide-desc">Anggota mengikuti kegiatan latihan secara langsung</div>
                        </div>
                    </div>
                    <div class="status-guide-item">
                        <span class="status-guide-dot izin"></span>
                        <div>
                            <div class="status-guide-name">Izin</div>
                            <div class="status-guide-desc">Tidak hadir dengan alasan tertentu dan surat izin</div>
                        </div>
                    </div>
                    <div class="status-guide-item">
                        <span class="status-guide-dot sakit"></span>
                        <div>
                            <div class="status-guide-name">Sakit</div>
                            <div class="status-guide-desc">Tidak hadir karena kondisi kesehatan</div>
                        </div>
                    </div>
                    <div class="status-guide-item">
                        <span class="status-guide-dot alfa"></span>
                        <div>
                            <div class="status-guide-name">Alfa</div>
                            <div class="status-guide-desc">Tidak hadir tanpa keterangan apapun</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="tips-card animate-in">
            <div class="tips-card-title">
                <i class="bi bi-lightbulb-fill"></i> Catatan
            </div>
            <ul>
                <li>Perubahan status akan langsung tercatat dalam rekap</li>
                <li>Tambahkan keterangan untuk status <strong>Izin</strong> atau <strong>Sakit</strong></li>
                <li>Perubahan status tercatat dalam log aktivitas sistem</li>
            </ul>
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
    /* ── Card Form no-hover ── */
    .card-scout-form:hover { transform: none; }

    /* ── Absen Identity Card ── */
    .absen-identity-card {
        background: linear-gradient(135deg, var(--c-forest) 0%, var(--c-forest-mid) 100%);
        border-radius: var(--radius-md);
        padding: 20px 22px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .absen-identity-card::after {
        content: '\F591';
        font-family: 'bootstrap-icons';
        position: absolute;
        right: 20px;
        bottom: -10px;
        font-size: 5rem;
        color: rgba(255,255,255,.04);
        pointer-events: none;
    }

    .absen-identity-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .absen-identity-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(255,255,255,.15);
        border: 2px solid var(--c-gold-light);
        display: grid;
        place-items: center;
        color: var(--c-gold-light);
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .absen-identity-name {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--c-white);
    }

    .absen-identity-meta {
        font-size: .78rem;
        color: rgba(255,255,255,.6);
        margin-top: 3px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .absen-identity-current {
        text-align: right;
        position: relative;
        z-index: 1;
    }

    .absen-identity-current-label {
        font-size: .65rem;
        color: rgba(255,255,255,.4);
        text-transform: uppercase;
        letter-spacing: .1em;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .status-badge-current {
        padding: 6px 16px;
        border-radius: var(--radius-pill);
        font-size: .78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .status-badge-current.status-hadir {
        background: rgba(46,94,71,.2);
        color: #7dcea0;
    }

    .status-badge-current.status-izin {
        background: rgba(201,149,42,.2);
        color: var(--c-gold-light);
    }

    .status-badge-current.status-sakit {
        background: rgba(59,130,246,.15);
        color: #93bbfc;
    }

    .status-badge-current.status-alfa {
        background: rgba(185,50,50,.15);
        color: #f09090;
    }

    /* ── Form Steps ── */
    .form-step {
        display: flex;
        gap: 16px;
        padding-bottom: 28px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--c-border);
        position: relative;
    }

    .form-step:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .form-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 17px;
        top: 42px;
        bottom: -4px;
        width: 2px;
        background: linear-gradient(to bottom, var(--c-gold-light), var(--c-border));
    }

    .form-step-number {
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
        box-shadow: 0 4px 12px rgba(201,149,42,.25);
        position: relative;
        z-index: 1;
    }

    .form-step-content { flex: 1; min-width: 0; }

    .form-step-label {
        font-size: .7rem;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--c-muted);
        margin-bottom: 14px;
    }

    /* ── Status Selector ── */
    .status-selector {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .status-option {
        cursor: pointer;
        margin: 0;
    }

    .status-option input[type="radio"] { display: none; }

    .status-option-inner {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        border: 1.5px solid var(--c-border);
        border-radius: var(--radius-md);
        background: var(--c-white);
        transition: all .25s;
    }

    .status-option-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        transition: all .25s;
    }

    .status-option-info { flex: 1; }

    .status-option-name {
        display: block;
        font-weight: 600;
        font-size: .9rem;
        color: var(--c-ink);
    }

    .status-option-desc {
        display: block;
        font-size: .72rem;
        color: var(--c-muted);
        margin-top: 2px;
    }

    .status-option-check {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid var(--c-border);
        display: grid;
        place-items: center;
        font-size: .75rem;
        color: transparent;
        transition: all .25s;
        flex-shrink: 0;
    }

    /* Status color variants */
    .status-option-hadir .status-option-icon { background: rgba(46,94,71,.1);  color: var(--c-forest-mid); }
    .status-option-izin  .status-option-icon { background: rgba(201,149,42,.1); color: var(--c-gold); }
    .status-option-sakit .status-option-icon { background: rgba(59,130,246,.08); color: #3b82f6; }
    .status-option-alfa  .status-option-icon { background: rgba(185,50,50,.06); color: #b93232; }

    /* Hover */
    .status-option:hover .status-option-inner {
        border-color: var(--c-forest-soft);
        background: rgba(27,58,45,.015);
    }

    /* Active states */
    .status-option.active .status-option-inner.status-option-hadir {
        border-color: var(--c-forest-mid);
        background: rgba(46,94,71,.04);
        box-shadow: 0 0 0 3px rgba(46,94,71,.08);
    }

    .status-option.active .status-option-inner.status-option-izin {
        border-color: var(--c-gold);
        background: rgba(201,149,42,.04);
        box-shadow: 0 0 0 3px rgba(201,149,42,.08);
    }

    .status-option.active .status-option-inner.status-option-sakit {
        border-color: #3b82f6;
        background: rgba(59,130,246,.03);
        box-shadow: 0 0 0 3px rgba(59,130,246,.08);
    }

    .status-option.active .status-option-inner.status-option-alfa {
        border-color: #b93232;
        background: rgba(185,50,50,.03);
        box-shadow: 0 0 0 3px rgba(185,50,50,.06);
    }

    .status-option.active .status-option-check {
        border-color: var(--c-forest-mid);
        background: var(--c-forest-mid);
        color: var(--c-white);
    }

    .status-option.active .status-option-inner.status-option-izin ~ .status-option-check,
    .status-option.active .status-option-inner.status-option-izin + .status-option-check {
        border-color: var(--c-gold);
        background: var(--c-gold);
    }

    /* Fix: Check is inside inner, use parent selector */
    .status-option.active[data-value="hadir"] .status-option-check { border-color: var(--c-forest-mid); background: var(--c-forest-mid); color: #fff; }
    .status-option.active[data-value="izin"]  .status-option-check { border-color: var(--c-gold); background: var(--c-gold); color: var(--c-forest); }
    .status-option.active[data-value="sakit"] .status-option-check { border-color: #3b82f6; background: #3b82f6; color: #fff; }
    .status-option.active[data-value="alpha"] .status-option-check { border-color: #b93232; background: #b93232; color: #fff; }

    /* ── Textarea Counter ── */
    .textarea-counter {
        text-align: right;
        font-size: .68rem;
        color: var(--c-muted);
        margin-top: 5px;
    }

    /* ── Change Preview ── */
    .change-preview {
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        overflow: hidden;
    }

    .change-preview-title {
        padding: 10px 16px;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .82rem;
        color: var(--c-forest);
        border-bottom: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .change-preview-title i { color: var(--c-gold); }

    .change-preview-body {
        padding: 16px;
    }

    .change-flow {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .change-from,
    .change-to {
        text-align: center;
        flex: 1;
    }

    .change-label {
        font-size: .65rem;
        color: var(--c-muted);
        text-transform: uppercase;
        letter-spacing: .1em;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .change-arrow {
        color: var(--c-gold);
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .status-mini {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 14px;
        border-radius: var(--radius-pill);
        font-size: .75rem;
        font-weight: 600;
    }

    .status-mini.status-hadir { background: rgba(46,94,71,.12); color: var(--c-forest-mid); }
    .status-mini.status-izin  { background: rgba(201,149,42,.12); color: #a07820; }
    .status-mini.status-sakit { background: rgba(59,130,246,.1); color: #3b82f6; }
    .status-mini.status-alfa  { background: rgba(185,50,50,.08); color: #b93232; }

    /* ── Detail Info List ── */
    .detail-info-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .detail-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: var(--radius-sm);
        transition: background .2s;
    }

    .detail-info-item:hover { background: var(--c-parchment); }

    .detail-info-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .detail-info-icon.green { background: rgba(46,94,71,.1);   color: var(--c-forest-mid); }
    .detail-info-icon.gold  { background: rgba(201,149,42,.1); color: var(--c-gold); }
    .detail-info-icon.blue  { background: rgba(59,130,246,.08); color: #3b82f6; }

    .detail-info-label {
        font-size: .68rem;
        color: var(--c-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .detail-info-value {
        font-weight: 600;
        font-size: .88rem;
        color: var(--c-ink);
        margin-top: 1px;
    }

    /* ── Status Guide ── */
    .status-guide-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .status-guide-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .status-guide-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-top: 4px;
        flex-shrink: 0;
    }

    .status-guide-dot.hadir { background: var(--c-forest-mid); }
    .status-guide-dot.izin  { background: var(--c-gold); }
    .status-guide-dot.sakit { background: #3b82f6; }
    .status-guide-dot.alfa  { background: #b93232; }

    .status-guide-name {
        font-weight: 600;
        font-size: .85rem;
        color: var(--c-ink);
    }

    .status-guide-desc {
        font-size: .72rem;
        color: var(--c-muted);
        margin-top: 2px;
        line-height: 1.5;
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

    /* ── Responsive ── */
    @media (max-width: 767.98px) {
        .form-step::after { display: none; }
        .form-step { gap: 12px; }

        .absen-identity-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .absen-identity-current { text-align: left; }

        .status-option-inner { padding: 12px 14px; gap: 10px; }
        .status-option-icon { width: 36px; height: 36px; font-size: 1rem; border-radius: 10px; }
        .status-option-desc { display: none; }

        .change-flow { gap: 10px; }
        .status-mini { font-size: .7rem; padding: 4px 10px; }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    const selectStatus = document.getElementById('selectStatus');

    const statusMeta = {
        hadir: { cls: 'status-hadir', ico: 'bi-check-circle-fill',   label: 'Hadir' },
        izin:  { cls: 'status-izin',  ico: 'bi-envelope-paper-fill', label: 'Izin'  },
        sakit: { cls: 'status-sakit', ico: 'bi-heart-pulse-fill',    label: 'Sakit' },
        alpha: { cls: 'status-alfa',  ico: 'bi-x-circle-fill',       label: 'Alfa'  }
    };

    /**
     * Status Selector
     */
    document.querySelectorAll('.status-option').forEach(opt => {
        opt.addEventListener('click', function () {
            document.querySelectorAll('.status-option').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            selectStatus.value = this.dataset.value;
            updatePreview();
        });
    });

    /**
     * Character counter
     */
    const textarea = document.getElementById('inputKeterangan');
    const charCount = document.getElementById('charCount');

    function updateCharCount() {
        charCount.textContent = textarea.value.length;
    }

    textarea.addEventListener('input', updateCharCount);
    updateCharCount();

    /**
     * Update change preview
     */
    function updatePreview() {
        const newStatus = selectStatus.value;
        const meta      = statusMeta[newStatus];

        if (meta) {
            const el = document.getElementById('prevStatusNew');
            el.className = 'status-mini ' + meta.cls;
            el.innerHTML = '<i class="bi ' + meta.ico + '"></i> ' + meta.label;
        }
    }

    // Initial
    updatePreview();
</script>