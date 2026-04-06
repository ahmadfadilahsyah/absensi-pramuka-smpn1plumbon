<!-- ══════════════════════════════
     GANTI PASSWORD PAGE
══════════════════════════════ -->

<div class="row justify-content-center animate-in">
    <div class="col-md-7 col-lg-5">
        <div class="card-scout">

            <!-- Card Header -->
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-key-fill"></i>
                </div>
                <div>
                    <div class="card-scout-title">Update Password</div>
                    <div style="font-size: .78rem; color: var(--c-muted); margin-top: 2px;">
                        Pastikan password baru mudah diingat namun sulit ditebak
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-scout-body">

                <!-- Alert Messages -->
                <?php if(isset($success)): ?>
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

                <?php if(isset($error)): ?>
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
                <form method="POST" class="form-scout">

                    <!-- Password Lama -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-lock" style="color: var(--c-gold); margin-right: 4px;"></i>
                            Password Lama
                        </label>
                        <div class="input-group-scout">
                            <input type="password"
                                   name="old_password"
                                   id="oldPassword"
                                   class="form-control"
                                   placeholder="Masukkan password lama"
                                   required>
                            <button type="button"
                                    class="input-toggle-pw"
                                    onclick="togglePassword('oldPassword', this)"
                                    aria-label="Tampilkan password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="form-divider">
                        <span>Password Baru</span>
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-key" style="color: var(--c-gold); margin-right: 4px;"></i>
                            Password Baru
                        </label>
                        <div class="input-group-scout">
                            <input type="password"
                                   name="new_password"
                                   id="newPassword"
                                   class="form-control"
                                   placeholder="Minimal 6 karakter"
                                   minlength="6"
                                   required
                                   oninput="checkPasswordStrength(this.value)">
                            <button type="button"
                                    class="input-toggle-pw"
                                    onclick="togglePassword('newPassword', this)"
                                    aria-label="Tampilkan password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <!-- Strength Indicator -->
                        <div class="pw-strength-bar mt-2">
                            <div class="pw-strength-fill" id="pwStrengthFill"></div>
                        </div>
                        <div class="pw-strength-text" id="pwStrengthText">Minimal 6 karakter</div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-shield-check" style="color: var(--c-gold); margin-right: 4px;"></i>
                            Konfirmasi Password Baru
                        </label>
                        <div class="input-group-scout">
                            <input type="password"
                                   name="confirm_password"
                                   id="confirmPassword"
                                   class="form-control"
                                   placeholder="Ulangi password baru"
                                   required
                                   oninput="checkPasswordMatch()">
                            <button type="button"
                                    class="input-toggle-pw"
                                    onclick="togglePassword('confirmPassword', this)"
                                    aria-label="Tampilkan password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="pw-match-text" id="pwMatchText"></div>
                    </div>

                    <!-- Security Tips -->
                    <div class="security-tips mb-4">
                        <div class="security-tips-title">
                            <i class="bi bi-shield-lock-fill"></i> Tips Keamanan
                        </div>
                        <ul>
                            <li>Gunakan kombinasi huruf besar, kecil, dan angka</li>
                            <li>Hindari menggunakan tanggal lahir atau nama</li>
                            <li>Jangan gunakan password yang sama dengan akun lain</li>
                        </ul>
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="btn-scout w-100" id="submitBtn">
                        <i class="bi bi-check2-circle"></i> Update Password
                    </button>

                    <a href="<?= BASE_URL ?>/<?= $_SESSION['role'] == 'admin' ? 'AdminController/dashboard' : 'UserController/dashboard' ?>"
                       class="btn-scout-outline w-100 mt-3 justify-content-center">
                        <i class="bi bi-x-lg"></i> Batal
                    </a>
                </form>
            </div>
        </div>

        <!-- Footer note -->
        <div class="text-center mt-3 animate-in" style="font-size: .75rem; color: var(--c-muted);">
            <i class="bi bi-info-circle"></i>
            Jika lupa password lama, hubungi administrator Pramuka
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
    /* ── Custom Alert ── */
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
        background: rgba(46, 94, 71, .06);
        border-color: rgba(46, 94, 71, .15);
    }

    .alert-scout-success .alert-scout-icon {
        color: var(--c-forest-mid);
        font-size: 1.3rem;
        margin-top: 1px;
    }

    .alert-scout-danger {
        background: rgba(185, 50, 50, .05);
        border-color: rgba(185, 50, 50, .12);
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

    /* ── Input Group with Toggle ── */
    .input-group-scout {
        position: relative;
    }

    .input-group-scout .form-control {
        padding-right: 48px;
    }

    .input-toggle-pw {
        position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--c-muted);
        cursor: pointer;
        padding: 6px 10px;
        border-radius: var(--radius-sm);
        transition: color .2s, background .2s;
        font-size: 1.1rem;
    }

    .input-toggle-pw:hover {
        color: var(--c-forest);
        background: rgba(27, 58, 45, .05);
    }

    /* ── Password Strength Bar ── */
    .pw-strength-bar {
        height: 4px;
        background: rgba(27, 58, 45, .08);
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

    /* ── Password Match ── */
    .pw-match-text {
        font-size: .72rem;
        margin-top: 5px;
        font-weight: 500;
        min-height: 18px;
    }

    .pw-match-text.match    { color: var(--c-forest-mid); }
    .pw-match-text.no-match { color: #b93232; }

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

    /* ── Security Tips ── */
    .security-tips {
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-sm);
        padding: 16px 20px;
    }

    .security-tips-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .85rem;
        color: var(--c-forest);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .security-tips-title i {
        color: var(--c-gold);
    }

    .security-tips ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .security-tips ul li {
        font-size: .78rem;
        color: var(--c-muted);
        padding: 3px 0 3px 20px;
        position: relative;
        line-height: 1.6;
    }

    .security-tips ul li::before {
        content: '✦';
        position: absolute;
        left: 0;
        color: var(--c-gold);
        font-size: .6rem;
        top: 6px;
    }

    /* ── Button States ── */
    .btn-scout:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    /* ── Card hover override for form card ── */
    .card-scout:has(form):hover {
        transform: none;
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    /**
     * Toggle password visibility
     */
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    /**
     * Password strength checker
     */
    function checkPasswordStrength(password) {
        const fill = document.getElementById('pwStrengthFill');
        const text = document.getElementById('pwStrengthText');

        let score = 0;
        let label = '';
        let color = '';
        let width = '0%';

        if (password.length === 0) {
            text.textContent = 'Minimal 6 karakter';
            text.style.color = 'var(--c-muted)';
            fill.style.width = '0%';
            fill.style.background = 'transparent';
            checkPasswordMatch();
            return;
        }

        // Scoring
        if (password.length >= 6)  score++;
        if (password.length >= 8)  score++;
        if (password.length >= 12) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

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

        fill.style.width = width;
        fill.style.background = color;
        text.textContent = label;
        text.style.color = color;

        checkPasswordMatch();
    }

    /**
     * Check password match
     */
    function checkPasswordMatch() {
        const newPw      = document.getElementById('newPassword').value;
        const confirmPw  = document.getElementById('confirmPassword').value;
        const matchText  = document.getElementById('pwMatchText');

        if (confirmPw.length === 0) {
            matchText.textContent = '';
            matchText.className = 'pw-match-text';
            return;
        }

        if (newPw === confirmPw) {
            matchText.innerHTML = '<i class="bi bi-check-circle-fill"></i> Password cocok';
            matchText.className = 'pw-match-text match';
        } else {
            matchText.innerHTML = '<i class="bi bi-x-circle-fill"></i> Password tidak cocok';
            matchText.className = 'pw-match-text no-match';
        }
    }
</script>