        </div> <!-- close col -->
    </div> <!-- close row -->
</div> <!-- close container-fluid -->

<?php if(isset($_SESSION['user_id'])): ?>
<!-- Bottom Navigation Mobile -->
<div class="mobile-bottom-nav d-lg-none">
    <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="<?= BASE_URL ?>/AdminController/dashboard" class="nav-item"><i class="bi bi-speedometer2"></i> Home</a>
        <a href="<?= BASE_URL ?>/AdminController/sesi" class="nav-item"><i class="bi bi-calendar-event"></i> Sesi</a>
        <a href="<?= BASE_URL ?>/AdminController/rekap" class="nav-item"><i class="bi bi-clipboard-data"></i> Rekap</a>
        <a href="<?= BASE_URL ?>/AuthController/gantiPassword" class="nav-item"><i class="bi bi-key"></i> Ganti</a>
    <?php else: ?>
        <a href="<?= BASE_URL ?>/UserController/dashboard" class="nav-item"><i class="bi bi-house-door"></i> Home</a>
        <a href="<?= BASE_URL ?>/UserController/absen" class="nav-item"><i class="bi bi-qr-code-scan"></i> Absen</a>
        <a href="<?= BASE_URL ?>/UserController/izin" class="nav-item"><i class="bi bi-envelope-paper"></i> Izin</a>
        <a href="<?= BASE_URL ?>/AuthController/gantiPassword" class="nav-item"><i class="bi bi-key"></i> Ganti</a>
    <?php endif; ?>
</div>

<footer class="footer-scout">
    <div class="container">
        <i class="bi bi-tree-fill me-1"></i>
        <strong>PRAMUKA SMP NEGERI 1 PLUMBON</strong><br>
        Pangkalan SMP Negeri 1 Plumbon | Gudep 31.079 - 31.080<br>
        Pasukan Fletehan & Nyimas Gandasari | Kwarran Plumbon | Kwarcab Cirebon<br>
        <span class="text-muted">Sistem Absensi Digital - Gerakan Pramuka</span>
    </div>
</footer>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>