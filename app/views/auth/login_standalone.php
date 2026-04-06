
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Absensi Pramuka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* \u2500\u2500 CSS Variables \u2500\u2500 */
        :root {
            --c-forest:       #1B3A2D;
            --c-forest-mid:   #2E5E47;
            --c-gold:         #C9952A;
            --c-gold-light:   #E8B84B;
            --c-white:        #ffffff;
            --c-parchment:    #F8F5F0;
            --c-ink:          #1a1a2e;
            --c-muted:        #7a8a80;
            --font-display:   'Playfair Display', serif;
            --font-body:      'Inter', sans-serif;
            --radius-sm:      10px;
            --radius-pill:    999px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            background: var(--c-forest);
        }

        /* \u2500\u2500 Login Wrap \u2500\u2500 */
        .login-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background:
                radial-gradient(ellipse 80% 60% at 20% 110%, rgba(46,94,71,.35) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% -10%, rgba(201,149,42,.12) 0%, transparent 55%),
                var(--c-forest);
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--c-white);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,.28);
        }

        /* \u2500\u2500 Card top banner \u2500\u2500 */
        .login-banner {
            background: var(--c-forest);
            padding: 36px 32px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* subtle diagonal texture */
        .login-banner::before {
            content: '';
            position: absolute; inset: 0;
            background-image: repeating-linear-gradient(
                45deg,
                rgba(255,255,255,.018) 0px, rgba(255,255,255,.018) 1px,
                transparent 1px, transparent 12px
            );
            pointer-events: none;
        }

        /* gold bottom border */
        .login-banner::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--c-gold), var(--c-gold-light), var(--c-gold), transparent);
        }

        .login-logo-ring {
            width: 68px; height: 68px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            border: 2px solid var(--c-gold);
            display: grid; place-items: center;
            margin: 0 auto 14px;
            color: var(--c-gold-light);
            font-size: 1.9rem;
            position: relative;
            z-index: 1;
        }

        .login-title {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--c-white);
            letter-spacing: .03em;
            position: relative; z-index: 1;
        }

        .login-gudep {
            font-size: .75rem;
            color: rgba(255,255,255,.5);
            letter-spacing: .08em;
            margin-top: 5px;
            position: relative; z-index: 1;
        }

        /* \u2500\u2500 Card body \u2500\u2500 */
        .login-body {
            padding: 36px 36px 32px;
        }

        @media (max-width: 480px) {
            .login-body  { padding: 24px 20px 28px; }
            .login-banner { padding: 28px 20px 22px; }
        }

        /* \u2500\u2500 Alert error \u2500\u2500 */
        .login-alert {
            background: rgba(185,50,50,.07);
            border: 1px solid rgba(185,50,50,.18);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            color: #b93232;
            font-size: .82rem;
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 22px;
        }

        /* \u2500\u2500 Form fields \u2500\u2500 */
        .login-field {
            margin-bottom: 18px;
        }

        .login-label {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--c-forest);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 7px;
        }

        .login-label i { color: var(--c-gold); font-size: .8rem; }

        .login-input {
            width: 100%;
            border: 1.5px solid rgba(27,58,45,.15);
            border-radius: var(--radius-sm);
            padding: 11px 14px;
            font-family: var(--font-body);
            font-size: .9rem;
            background: var(--c-parchment);
            color: var(--c-ink);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            box-sizing: border-box;
        }

        .login-input:focus {
            border-color: var(--c-gold);
            box-shadow: 0 0 0 3px rgba(201,149,42,.15);
            background: var(--c-white);
        }

        .login-input::placeholder { color: #aaa; }

        /* \u2500\u2500 Captcha row \u2500\u2500 */
        .captcha-row {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 10px;
            align-items: stretch;
        }

        .captcha-img-wrap {
            border: 1.5px solid rgba(27,58,45,.15);
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: var(--c-parchment);
            display: flex; align-items: center; justify-content: center;
            min-height: 46px;
        }

        .captcha-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
        }

        .refresh-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: .75rem;
            color: var(--c-gold);
            text-decoration: none;
            font-weight: 500;
            margin-top: 6px;
            float: right;
            transition: color .2s;
        }

        .refresh-link:hover { color: var(--c-forest); }

        /* \u2500\u2500 Submit button \u2500\u2500 */
        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
            color: var(--c-forest);
            font-family: var(--font-body);
            font-weight: 700;
            font-size: .95rem;
            letter-spacing: .04em;
            border: none;
            border-radius: var(--radius-pill);
            padding: 13px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(201,149,42,.35);
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #f5c95e, #b8841e);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(201,149,42,.42);
        }

        .login-btn:active { transform: scale(.98); }

        /* \u2500\u2500 Footer text \u2500\u2500 */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(27,58,45,.08);
            font-size: .75rem;
            color: var(--c-muted);
            line-height: 1.7;
        }

        .login-footer i { color: var(--c-gold); }
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="login-card">

        <!-- \u2500\u2500 Banner \u2500\u2500 -->
        <div class="login-banner">
            <div class="login-logo-ring">
                <i class="bi bi-tree-fill"></i>
            </div>
            <div class="login-title">Pramuka SMPN 1 Plumbon</div>
            <div class="login-gudep">Gudep 31.079\u201331.080 &nbsp;\u00b7&nbsp; Kwarran Plumbon</div>
        </div>

        <!-- \u2500\u2500 Body \u2500\u2500 -->
        <div class="login-body">

            <?php if(isset($error)): ?>
            <div class="login-alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/AuthController/login">

                <!-- Username -->
                <div class="login-field">
                    <label class="login-label">
                        <i class="bi bi-person-circle"></i> Username
                    </label>
                    <input type="text"
                           name="username"
                           class="login-input"
                           placeholder="Masukkan username"
                           autocomplete="username"
                           required>
                </div>

                <!-- Password -->
                <div class="login-field">
                    <label class="login-label">
                        <i class="bi bi-lock-fill"></i> Password
                    </label>
                    <input type="password"
                           name="password"
                           class="login-input"
                           placeholder="Masukkan password"
                           autocomplete="current-password"
                           required>
                </div>

                <!-- Captcha -->
                <div class="login-field">
                    <label class="login-label">
                        <i class="bi bi-shield-lock-fill"></i> Captcha
                    </label>
                    <div class="captcha-row">
                        <div class="captcha-img-wrap">
                            <img src="<?= BASE_URL ?>/captcha.php"
                                 id="captcha_img"
                                 alt="Captcha">
                        </div>
                        <input type="text"
                               name="captcha"
                               class="login-input"
                               placeholder="Ketik kode di samping"
                               autocomplete="off"
                               required>
                    </div>
                    <a href="#"
                       class="refresh-link"
                       onclick="document.getElementById('captcha_img').src='<?= BASE_URL ?>/captcha.php?'+Math.random(); return false;">
                        <i class="bi bi-arrow-repeat"></i> Refresh Captcha
                    </a>
                    <div style="clear:both"></div>
                </div>

                <!-- Submit -->
                <button type="submit" class="login-btn">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>

            </form>

            <!-- Footer info -->
            <div class="login-footer">
                <i class="bi bi-geo-alt-fill"></i>
                Pangkalan SMP Negeri 1 Plumbon<br>
                Pasukan Fletehan &amp; Nyimas Gandasari &nbsp;\u00b7&nbsp; Kwarcab Cirebon
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
