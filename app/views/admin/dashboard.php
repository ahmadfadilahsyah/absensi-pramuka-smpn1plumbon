<!-- ══════════════════════════════
     PAGE HEADER
══════════════════════════════ -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Admin Panel</div>
        <h1 class="page-header-title">Dashboard Admin</h1>
        <p class="page-header-sub">
            <i class="bi bi-shield-fill-check me-1" style="color: var(--c-gold);"></i>
            Gudep 31.079/31.080 &nbsp;·&nbsp; Pasukan Faletehan &amp; Nyimas Gandasari
            &nbsp;·&nbsp; Kwarran Plumbon &nbsp;·&nbsp; Kwarcab Cirebon
        </p>
    </div>
</div>

<!-- ══════════════════════════════
     STAT CARDS
══════════════════════════════ -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4 animate-in">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['total_users'] ?></div>
                <div class="stat-label">Total Anggota</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 animate-in">
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="bi bi-calendar-week-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['total_sesi'] ?></div>
                <div class="stat-label">Total Sesi Latihan</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 animate-in">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div>
                <div class="stat-value">—</div>
                <div class="stat-label">Tingkat Kehadiran</div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     TABEL SESI TERBARU
══════════════════════════════ -->
<div class="card-scout mb-4 animate-in">
    <div class="card-scout-header">
        <div class="card-scout-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="card-scout-title">Sesi Latihan Terbaru</div>
        <a href="<?= BASE_URL ?>/AdminController/sesi"
           class="btn-scout-outline ms-auto"
           style="padding: 7px 18px; font-size: .8rem;">
            <i class="bi bi-grid-3x3-gap"></i> Lihat Semua
        </a>
    </div>
    <div class="card-scout-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="table-scout w-100">
                <thead>
                    <tr>
                        <th>Nama Sesi</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['recent_sesi'] as $sesi): ?>
                    <tr>
                        <td style="font-weight: 500;"><?= htmlspecialchars($sesi['nama_sesi']) ?></td>
                        <td style="color: var(--c-muted);">
                            <i class="bi bi-calendar3 me-1" style="color: var(--c-gold); font-size: .8rem;"></i>
                            <?= date('d M Y', strtotime($sesi['tanggal'])) ?>
                        </td>
                        <td style="color: var(--c-muted);">
                            <i class="bi bi-clock me-1" style="color: var(--c-gold); font-size: .8rem;"></i>
                            <?= $sesi['waktu_mulai'] ?> – <?= $sesi['waktu_selesai'] ?>
                        </td>
                        <td>
                            <span class="status-badge badge-hadir">
                                <i class="bi bi-check-circle-fill me-1"></i> Aktif
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($data['recent_sesi'])): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px 16px; color: var(--c-muted);">
                            <i class="bi bi-calendar-x d-block mb-2" style="font-size: 2rem; opacity: .35;"></i>
                            Belum ada sesi latihan
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ══════════════════════════════
     QUICK ACTION CARDS
══════════════════════════════ -->
<div class="row g-3 animate-in">

    <div class="col-md-6">
        <div class="card-scout" style="padding: 24px 22px; display: flex; align-items: center; gap: 18px;">
            <div style="
                width: 50px; height: 50px;
                border-radius: var(--radius-sm);
                background: rgba(27,58,45,.08);
                display: grid; place-items: center;
                color: var(--c-forest);
                font-size: 1.4rem;
                flex-shrink: 0;
            ">
                <i class="bi bi-person-badge-fill"></i>
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--c-forest);">
                    Kelola Anggota
                </div>
                <p style="font-size: .82rem; color: var(--c-muted); margin: 4px 0 14px;">
                    Tambah, edit, dan hapus data anggota pramuka
                </p>
                <a href="<?= BASE_URL ?>/AdminController/users" class="btn-scout" style="font-size: .8rem; padding: 8px 20px;">
                    <i class="bi bi-arrow-right-circle"></i> Kelola User
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-scout" style="padding: 24px 22px; display: flex; align-items: center; gap: 18px;">
            <div style="
                width: 50px; height: 50px;
                border-radius: var(--radius-sm);
                background: rgba(201,149,42,.1);
                display: grid; place-items: center;
                color: var(--c-gold);
                font-size: 1.4rem;
                flex-shrink: 0;
            ">
                <i class="bi bi-printer-fill"></i>
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--c-forest);">
                    Ekspor Laporan
                </div>
                <p style="font-size: .82rem; color: var(--c-muted); margin: 4px 0 14px;">
                    Cetak laporan kehadiran dalam format PDF atau Excel
                </p>
                <a href="<?= BASE_URL ?>/AdminController/laporan" class="btn-scout" style="font-size: .8rem; padding: 8px 20px;">
                    <i class="bi bi-file-earmark-arrow-down"></i> Buka Laporan
                </a>
            </div>
        </div>
    </div>

</div>