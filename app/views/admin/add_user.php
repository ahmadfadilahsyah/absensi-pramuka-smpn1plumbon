<!-- ══════════════════════════════
     TAMBAH USER BARU PAGE
══════════════════════════════ -->

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Manajemen User</div>
        <h1 class="page-header-title">Tambah User Baru</h1>
        <p class="page-header-sub">Daftarkan anggota atau administrator baru ke dalam sistem</p>
    </div>
    <a href="<?= BASE_URL ?>/AdminController/users" class="btn-scout-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">

    <!-- ═══════════════════════════
         LEFT: FORM TAMBAH USER
    ═══════════════════════════ -->
    <div class="col-lg-7 animate-in">
        <div class="card-scout card-scout-form">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div>
                    <div class="card-scout-title">Form Pendaftaran</div>
                    <div style="font-size:.78rem; color:var(--c-muted); margin-top:2px;">
                        Lengkapi semua field yang diperlukan
                    </div>
                </div>
            </div>

            <div class="card-scout-body">

                <!-- Alerts -->
                <?php if (isset($success)): ?>
                    <div class="alert-scout alert-scout-success animate-in">
                        <div class="alert-scout-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div class="alert-scout-title">Berhasil!</div>
                            <div class="alert-scout-text"><?= htmlspecialchars($success) ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert-scout alert-scout-danger animate-in">
                        <div class="alert-scout-icon">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <div class="alert-scout-title">Gagal!</div>
                            <div class="alert-scout-text"><?= htmlspecialchars($error) ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="POST" class="form-scout" id="formTambahUser">

                    <!-- Step 1: Identitas -->
                    <div class="form-step">
                        <div class="form-step-number">1</div>
                        <div class="form-step-content">
                            <div class="form-step-label">Identitas Akun</div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-at" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Username
                                </label>
                                <div class="input-group-scout">
                                    <input type="text"
                                           name="username"
                                           id="inputUsername"
                                           class="form-control"
                                           placeholder="Contoh: ahmad_rafi"
                                           required
                                           oninput="validateUsername(this)">
                                    <span class="input-status" id="usernameStatus"></span>
                                </div>
                                <div class="form-hint" id="usernameHint">Huruf kecil, angka, dan underscore. Tanpa spasi.</div>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-person" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text"
                                       name="nama_lengkap"
                                       id="inputNama"
                                       class="form-control"
                                       placeholder="Contoh: Ahmad Rafi Pratama"
                                       required
                                       oninput="updatePreview()">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Keamanan -->
                    <div class="form-step">
                        <div class="form-step-number">2</div>
                        <div class="form-step-content">
                            <div class="form-step-label">Keamanan</div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="bi bi-lock" style="color:var(--c-gold); margin-right:4px;"></i>
                                    Password
                                </label>
                                <div class="input-group-scout">
                                    <input type="password"
                                           name="password"
                                           id="inputPassword"
                                           class="form-control"
                                           placeholder="Minimal 6 karakter"
                                           minlength="6"
                                           required
                                           oninput="checkPasswordStrength(this.value)">
                                    <button type="button"
                                            class="input-toggle-pw"
                                            onclick="togglePassword('inputPassword', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <!-- Strength Bar -->
                                <div class="pw-strength-bar mt-2">
                                    <div class="pw-strength-fill" id="pwStrengthFill"></div>
                                </div>
                                <div class="pw-strength-text" id="pwStrengthText">Minimal 6 karakter</div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Detail Anggota -->
                    <div class="form-step">
                        <div class="form-step-number">3</div>
                        <div class="form-step-content">
                            <div class="form-step-label">Detail Anggota</div>

                            <div class="row g-3">
                                <!-- Kelas -->
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-mortarboard" style="color:var(--c-gold); margin-right:4px;"></i>
                                        Kelas
                                    </label>
                                    <div class="kelas-selector">
                                        <label class="kelas-option active" data-value="7">
                                            <input type="radio" name="kelas_radio" value="7" checked>
                                            <div class="kelas-option-inner">
                                                <span class="kelas-option-number">7</span>
                                                <span class="kelas-option-label">Kelas 7</span>
                                            </div>
                                        </label>
                                        <label class="kelas-option" data-value="8">
                                            <input type="radio" name="kelas_radio" value="8">
                                            <div class="kelas-option-inner">
                                                <span class="kelas-option-number">8</span>
                                                <span class="kelas-option-label">Kelas 8</span>
                                            </div>
                                        </label>
                                        <label class="kelas-option" data-value="9">
                                            <input type="radio" name="kelas_radio" value="9">
                                            <div class="kelas-option-inner">
                                                <span class="kelas-option-number">9</span>
                                                <span class="kelas-option-label">Kelas 9</span>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Hidden select -->
                                    <select name="kelas" id="selectKelas" class="d-none" required>
                                        <option value="7" selected>Kelas 7</option>
                                        <option value="8">Kelas 8</option>
                                        <option value="9">Kelas 9</option>
                                    </select>
                                </div>

                                <!-- Role -->
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-shield" style="color:var(--c-gold); margin-right:4px;"></i>
                                        Role
                                    </label>
                                    <div class="role-selector">
                                        <label class="role-option active" data-value="user">
                                            <input type="radio" name="role_radio" value="user" checked>
                                            <div class="role-option-inner">
                                                <div class="role-option-icon member">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <span class="role-option-name">Anggota</span>
                                                    <span class="role-option-desc">Akses terbatas</span>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="role-option" data-value="admin">
                                            <input type="radio" name="role_radio" value="admin">
                                            <div class="role-option-inner">
                                                <div class="role-option-icon admin">
                                                    <i class="bi bi-shield-fill"></i>
                                                </div>
                                                <div>
                                                    <span class="role-option-name">Admin</span>
                                                    <span class="role-option-desc">Akses penuh</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Hidden select -->
                                    <select name="role" id="selectRole" class="d-none">
                                        <option value="user" selected>User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-step">
                        <div class="form-step-number">
                            <i class="bi bi-check-lg" style="font-size:.85rem;"></i>
                        </div>
                        <div class="form-step-content">
                            <button type="submit" class="btn-scout w-100" id="submitBtn">
                                <i class="bi bi-person-plus-fill"></i> Simpan User Baru
                            </button>
                            <a href="<?= BASE_URL ?>/AdminController/users"
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
         RIGHT: PREVIEW & INFO
    ═══════════════════════════ -->
    <div class="col-lg-5 animate-in">

        <!-- Live Preview Card -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <div class="card-scout-title">Preview User</div>
            </div>
            <div class="card-scout-body">
                <div class="preview-user-card" id="previewCard">
                    <div class="preview-user-avatar" id="previewAvatar">
                        <span id="previewInitial">?</span>
                    </div>
                    <div class="preview-user-name" id="previewName">Nama Lengkap</div>
                    <div class="preview-user-username" id="previewUsername">
                        <i class="bi bi-at"></i>username
                    </div>
                    <div class="preview-user-badges">
                        <span class="preview-badge preview-badge-kelas" id="previewKelas">
                            <i class="bi bi-mortarboard-fill"></i> Kelas 7
                        </span>
                        <span class="preview-badge preview-badge-role" id="previewRole">
                            <i class="bi bi-person-fill"></i> Anggota
                        </span>
                    </div>
                    <div class="preview-user-divider"></div>
                    <div class="preview-user-info">
                        <div class="preview-user-info-row">
                            <span class="preview-info-label">Status</span>
                            <span class="preview-info-value">
                                <span class="status-dot-inline active"></span> Aktif
                            </span>
                        </div>
                        <div class="preview-user-info-row">
                            <span class="preview-info-label">Gudep</span>
                            <span class="preview-info-value">31.079–31.080</span>
                        </div>
                        <div class="preview-user-info-row">
                            <span class="preview-info-label">Terdaftar</span>
                            <span class="preview-info-value" id="previewDate"><?= date('d M Y') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Info -->
        <div class="card-scout mb-3">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="card-scout-title">Panduan Role</div>
            </div>
            <div class="card-scout-body" style="padding:16px 24px;">

                <div class="role-info-card">
                    <div class="role-info-icon member">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="role-info-content">
                        <div class="role-info-title">Anggota (User)</div>
                        <ul class="role-info-list">
                            <li>Melihat jadwal latihan</li>
                            <li>Absensi via QR Code</li>
                            <li>Mengajukan izin/sakit</li>
                            <li>Melihat riwayat kehadiran sendiri</li>
                        </ul>
                    </div>
                </div>

                <div class="role-info-divider"></div>

                <div class="role-info-card">
                    <div class="role-info-icon admin">
                        <i class="bi bi-shield-fill"></i>
                    </div>
                    <div class="role-info-content">
                        <div class="role-info-title">Administrator</div>
                        <ul class="role-info-list">
                            <li>Semua hak akses Anggota</li>
                            <li>Kelola user & sesi latihan</li>
                            <li>Melihat rekap kehadiran</li>
                            <li>Ekspor laporan PDF/Excel</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="tips-card animate-in">
            <div class="tips-card-title">
                <i class="bi bi-lightbulb-fill"></i> Tips Pendaftaran
            </div>
            <ul>
                <li>Username harus unik, tidak boleh sama dengan user lain</li>
                <li>Password minimal 6 karakter, kombinasikan huruf dan angka</li>
                <li>Pilih kelas sesuai tingkatan siswa saat ini</li>
                <li>Berikan role <strong>Admin</strong> hanya untuk pembina/pelatih</li>
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

    .alert-scout-success .alert-scout-icon { color: var(--c-forest-mid); font-size: 1.3rem; }

    .alert-scout-danger {
        background: rgba(185,50,50,.05);
        border-color: rgba(185,50,50,.12);
    }

    .alert-scout-danger .alert-scout-icon { color: #b93232; font-size: 1.3rem; }

    .alert-scout-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .95rem;
        margin-bottom: 2px;
    }

    .alert-scout-success .alert-scout-title { color: var(--c-forest); }
    .alert-scout-danger .alert-scout-title  { color: #8b1a1a; }

    .alert-scout-text { font-size: .84rem; color: var(--c-muted); }

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

    /* ── Input Group with Status ── */
    .input-group-scout { position: relative; }

    .input-group-scout .form-control { padding-right: 48px; }

    .input-toggle-pw,
    .input-status {
        position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 6px 10px;
        border-radius: var(--radius-sm);
        font-size: 1.1rem;
        cursor: pointer;
        transition: color .2s, background .2s;
    }

    .input-toggle-pw { color: var(--c-muted); }
    .input-toggle-pw:hover { color: var(--c-forest); background: rgba(27,58,45,.05); }

    .input-status { cursor: default; font-size: .9rem; }
    .input-status.valid   { color: var(--c-forest-mid); }
    .input-status.invalid { color: #b93232; }

    /* ── Form Hint ── */
    .form-hint {
        font-size: .72rem;
        color: var(--c-muted);
        font-weight: 500;
        margin-top: 5px;
        min-height: 18px;
        transition: color .3s;
    }

    .form-hint.error { color: #b93232; }
    .form-hint.success { color: var(--c-forest-mid); }

    /* ── Password Strength ── */
    .pw-strength-bar {
        height: 4px;
        background: rgba(27,58,45,.08);
        border-radius: 4px;
        overflow: hidden;
    }

    .pw-strength-fill {
        height: 100%;
        width: 0%;
        border-radius: 4px;
        transition: width .35s ease, background .35s ease;
    }

    .pw-strength-text {
        font-size: .72rem;
        color: var(--c-muted);
        margin-top: 5px;
        font-weight: 500;
        transition: color .3s;
    }

    /* ── Kelas Selector ── */
    .kelas-selector {
        display: flex;
        gap: 8px;
    }

    .kelas-option {
        flex: 1;
        cursor: pointer;
        margin: 0;
    }

    .kelas-option input[type="radio"] { display: none; }

    .kelas-option-inner {
        text-align: center;
        padding: 14px 8px;
        border: 1.5px solid var(--c-border);
        border-radius: var(--radius-sm);
        background: var(--c-white);
        transition: all .25s;
    }

    .kelas-option-number {
        display: block;
        font-family: var(--font-display);
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--c-muted);
        line-height: 1;
        transition: color .25s;
    }

    .kelas-option-label {
        display: block;
        font-size: .68rem;
        color: var(--c-muted);
        font-weight: 500;
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .kelas-option:hover .kelas-option-inner {
        border-color: var(--c-gold);
        background: rgba(201,149,42,.03);
    }

    .kelas-option:hover .kelas-option-number { color: var(--c-gold); }

    .kelas-option.active .kelas-option-inner {
        border-color: var(--c-gold);
        background: rgba(201,149,42,.06);
        box-shadow: 0 0 0 3px rgba(201,149,42,.1);
    }

    .kelas-option.active .kelas-option-number { color: var(--c-forest); }
    .kelas-option.active .kelas-option-label  { color: var(--c-forest); }

    /* ── Role Selector ── */
    .role-selector {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .role-option {
        cursor: pointer;
        margin: 0;
    }

    .role-option input[type="radio"] { display: none; }

    .role-option-inner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border: 1.5px solid var(--c-border);
        border-radius: var(--radius-sm);
        background: var(--c-white);
        transition: all .25s;
    }

    .role-option-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .role-option-icon.member { background: rgba(46,94,71,.1);  color: var(--c-forest-mid); }
    .role-option-icon.admin  { background: rgba(201,149,42,.1); color: var(--c-gold); }

    .role-option-name {
        display: block;
        font-weight: 600;
        font-size: .85rem;
        color: var(--c-ink);
    }

    .role-option-desc {
        display: block;
        font-size: .68rem;
        color: var(--c-muted);
    }

    .role-option:hover .role-option-inner {
        border-color: var(--c-forest-soft);
        background: rgba(27,58,45,.02);
    }

    .role-option.active .role-option-inner {
        border-color: var(--c-gold);
        background: rgba(201,149,42,.04);
        box-shadow: 0 0 0 3px rgba(201,149,42,.1);
    }

    /* ── Preview User Card ── */
    .preview-user-card {
        text-align: center;
        padding: 8px 0;
    }

    .preview-user-avatar {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: rgba(46,94,71,.1);
        color: var(--c-forest-mid);
        display: grid;
        place-items: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.8rem;
        margin: 0 auto 14px;
        transition: all .3s;
    }

    .preview-user-avatar.admin-avatar {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
    }

    .preview-user-name {
        font-family: var(--font-display);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--c-forest);
        margin-bottom: 4px;
        transition: all .3s;
    }

    .preview-user-username {
        font-size: .82rem;
        color: var(--c-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1px;
    }

    .preview-user-username i { color: var(--c-gold); }

    .preview-user-badges {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 14px;
    }

    .preview-badge {
        padding: 5px 14px;
        border-radius: var(--radius-pill);
        font-size: .72rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .preview-badge-kelas {
        background: rgba(46,94,71,.08);
        color: var(--c-forest-mid);
    }

    .preview-badge-role {
        background: rgba(201,149,42,.1);
        color: #a07820;
    }

    .preview-badge-role.admin-role {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
    }

    .preview-user-divider {
        height: 1px;
        background: var(--c-border);
        margin: 18px 0;
    }

    .preview-user-info-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: .8rem;
    }

    .preview-info-label { color: var(--c-muted); font-weight: 500; }
    .preview-info-value { color: var(--c-ink); font-weight: 600; }

    .status-dot-inline {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 4px;
    }

    .status-dot-inline.active { background: var(--c-forest-mid); }

    /* ── Role Info Cards ── */
    .role-info-card {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .role-info-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .role-info-icon.member { background: rgba(46,94,71,.1);  color: var(--c-forest-mid); }
    .role-info-icon.admin  { background: rgba(201,149,42,.1); color: var(--c-gold); }

    .role-info-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .9rem;
        color: var(--c-forest);
        margin-bottom: 6px;
    }

    .role-info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .role-info-list li {
        font-size: .75rem;
        color: var(--c-muted);
        padding: 2px 0 2px 18px;
        position: relative;
        line-height: 1.6;
    }

    .role-info-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--c-gold);
        font-weight: 700;
        font-size: .7rem;
    }

    .role-info-divider {
        height: 1px;
        background: var(--c-border);
        margin: 16px 0;
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

        .kelas-selector { gap: 6px; }
        .kelas-option-inner { padding: 10px 6px; }
        .kelas-option-number { font-size: 1.3rem; }

        .role-option-inner { padding: 10px 12px; gap: 10px; }
        .role-option-icon { width: 32px; height: 32px; font-size: .9rem; }

        .preview-user-avatar { width: 60px; height: 60px; font-size: 1.5rem; border-radius: 16px; }
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    const selectKelas = document.getElementById('selectKelas');
    const selectRole  = document.getElementById('selectRole');

    /**
     * Kelas Selector
     */
    document.querySelectorAll('.kelas-option').forEach(opt => {
        opt.addEventListener('click', function () {
            document.querySelectorAll('.kelas-option').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            selectKelas.value = this.dataset.value;
            updatePreview();
        });
    });

    /**
     * Role Selector
     */
    document.querySelectorAll('.role-option').forEach(opt => {
        opt.addEventListener('click', function () {
            document.querySelectorAll('.role-option').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            selectRole.value = this.dataset.value;
            updatePreview();
        });
    });

    /**
     * Username Validation
     */
    function validateUsername(input) {
        const val    = input.value;
        const status = document.getElementById('usernameStatus');
        const hint   = document.getElementById('usernameHint');
        const regex  = /^[a-z0-9_]+$/;

        if (val.length === 0) {
            status.innerHTML = '';
            status.className = 'input-status';
            hint.textContent = 'Huruf kecil, angka, dan underscore. Tanpa spasi.';
            hint.className   = 'form-hint';
        } else if (!regex.test(val)) {
            status.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
            status.className = 'input-status invalid';
            hint.textContent = 'Hanya huruf kecil, angka, dan underscore yang diperbolehkan';
            hint.className   = 'form-hint error';
        } else if (val.length < 3) {
            status.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i>';
            status.className = 'input-status invalid';
            hint.textContent = 'Username minimal 3 karakter';
            hint.className   = 'form-hint error';
        } else {
            status.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
            status.className = 'input-status valid';
            hint.textContent = 'Username tersedia ✓';
            hint.className   = 'form-hint success';
        }

        updatePreview();
    }

    /**
     * Password Strength
     */
    function checkPasswordStrength(password) {
        const fill = document.getElementById('pwStrengthFill');
        const text = document.getElementById('pwStrengthText');

        if (password.length === 0) {
            text.textContent = 'Minimal 6 karakter';
            text.style.color = 'var(--c-muted)';
            fill.style.width = '0%';
            return;
        }

        let score = 0;
        if (password.length >= 6)  score++;
        if (password.length >= 8)  score++;
        if (password.length >= 12) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        let label, color, width;
        if (score <= 2) {
            label = 'Lemah — tambahkan variasi karakter';
            color = '#b93232';
            width = '30%';
        } else if (score <= 4) {
            label = 'Cukup — bisa lebih kuat lagi';
            color = '#c9952a';
            width = '60%';
        } else {
            label = 'Kuat — password aman ✓';
            color = 'var(--c-forest-mid)';
            width = '100%';
        }

        fill.style.width      = width;
        fill.style.background = color;
        text.textContent       = label;
        text.style.color       = color;
    }

    /**
     * Toggle Password Visibility
     */
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon  = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    /**
     * Live Preview Update
     */
    function updatePreview() {
        const nama     = document.getElementById('inputNama').value.trim();
        const username = document.getElementById('inputUsername').value.trim();
        const kelas    = selectKelas.value;
        const role     = selectRole.value;

        // Name
        document.getElementById('previewName').textContent = nama || 'Nama Lengkap';

        // Initial
        const initial = nama ? nama.charAt(0).toUpperCase() : '?';
        document.getElementById('previewInitial').textContent = initial;

        // Avatar style
        const avatar = document.getElementById('previewAvatar');
        if (role === 'admin') {
            avatar.classList.add('admin-avatar');
        } else {
            avatar.classList.remove('admin-avatar');
        }

        // Username
        document.getElementById('previewUsername').innerHTML =
            '<i class="bi bi-at" style="color:var(--c-gold);"></i>' + (username || 'username');

        // Kelas
        document.getElementById('previewKelas').innerHTML =
            '<i class="bi bi-mortarboard-fill"></i> Kelas ' + kelas;

        // Role
        const roleEl = document.getElementById('previewRole');
        if (role === 'admin') {
            roleEl.innerHTML = '<i class="bi bi-shield-fill"></i> Administrator';
            roleEl.className = 'preview-badge preview-badge-role admin-role';
        } else {
            roleEl.innerHTML = '<i class="bi bi-person-fill"></i> Anggota';
            roleEl.className = 'preview-badge preview-badge-role';
        }
    }
</script>