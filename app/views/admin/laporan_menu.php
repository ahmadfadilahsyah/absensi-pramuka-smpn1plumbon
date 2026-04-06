<!-- ══════════════════════════════
     PAGE HEADER
══════════════════════════════ -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Admin Panel</div>
        <h1 class="page-header-title">Laporan Absensi</h1>
        <p class="page-header-sub">Tampilkan dan ekspor laporan kehadiran anggota pramuka</p>
    </div>
</div>

<!-- ══════════════════════════════
     KARTU LAPORAN BULANAN & TAHUNAN
══════════════════════════════ -->
<div class="row g-3 mb-4">

    <!-- Laporan Bulanan -->
    <div class="col-md-6 animate-in">
        <div class="card-scout h-100">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-calendar-month"></i>
                </div>
                <div class="card-scout-title">Laporan Bulanan</div>
            </div>
            <div class="card-scout-body form-scout">
                <form method="GET" action="<?= BASE_URL ?>/AdminController/laporanBulanan">
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="month"
                               name="bulan"
                               class="form-control"
                               value="<?= date('Y-m') ?>"
                               required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="7">Kelas 7</option>
                            <option value="8">Kelas 8</option>
                            <option value="9">Kelas 9</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-scout w-100" style="justify-content: center;">
                        <i class="bi bi-search"></i> Tampilkan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Laporan Tahunan -->
    <div class="col-md-6 animate-in">
        <div class="card-scout h-100">
            <div class="card-scout-header">
                <div class="card-scout-icon">
                    <i class="bi bi-calendar2-range"></i>
                </div>
                <div class="card-scout-title">Laporan Tahunan</div>
            </div>
            <div class="card-scout-body form-scout">
                <form method="GET" action="<?= BASE_URL ?>/AdminController/laporanTahunan">
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select">
                            <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                                <option value="<?= $y ?>"><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="7">Kelas 7</option>
                            <option value="8">Kelas 8</option>
                            <option value="9">Kelas 9</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-scout w-100" style="justify-content: center;">
                        <i class="bi bi-search"></i> Tampilkan
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- ══════════════════════════════
     EKSPOR LANGSUNG
══════════════════════════════ -->
<div class="card-scout animate-in">
    <div class="card-scout-header">
        <div class="card-scout-icon">
            <i class="bi bi-file-earmark-arrow-down"></i>
        </div>
        <div class="card-scout-title">Ekspor Langsung</div>
    </div>
    <div class="card-scout-body form-scout">

        <form method="GET"
              action="<?= BASE_URL ?>/AdminController/exportLaporan"
              target="_blank"
              id="form-ekspor">

            <!-- Row 1: Jenis + field dinamis -->
            <div class="row g-3 mb-3">
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label">Jenis Laporan</label>
                    <select name="jenis" class="form-select" id="sel-jenis" required>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>

                <!-- Harian -->
                <div class="col-sm-6 col-lg-3 export-field" id="f-tanggal">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="<?= date('Y-m-d') ?>">
                </div>

                <!-- Mingguan -->
                <div class="col-sm-6 col-lg-3 export-field" id="f-minggu" style="display:none;">
                    <label class="form-label">Pilih Minggu</label>
                    <input type="date" name="minggu" class="form-control"
                           value="<?= date('Y-m-d') ?>">
                </div>

                <!-- Bulanan -->
                <div class="col-sm-6 col-lg-3 export-field" id="f-bulan" style="display:none;">
                    <label class="form-label">Bulan</label>
                    <input type="month" name="bulan" class="form-control"
                           value="<?= date('Y-m') ?>">
                </div>

                <!-- Tahunan -->
                <div class="col-sm-6 col-lg-3 export-field" id="f-tahun" style="display:none;">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?= $y ?>"><?= $y ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <!-- Row 2: Kelas + Format + Tombol -->
            <div class="row g-3 align-items-end">
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label">Kelas</label>
                    <select name="kelas" class="form-select">
                        <option value="semua">Semua Kelas</option>
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>
                    </select>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <label class="form-label">Format File</label>
                    <select name="format" class="form-select" required>
                        <option value="pdf">
                            PDF
                        </option>
                        <option value="csv">Excel (CSV)</option>
                    </select>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <button type="submit" class="btn-scout w-100" style="justify-content: center; padding: 11px 24px;">
                        <i class="bi bi-download"></i> Ekspor Sekarang
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- ══════════════════════════════
     SCRIPT TOGGLE FIELD
══════════════════════════════ -->
<script>
(function() {
    const sel    = document.getElementById('sel-jenis');
    const fields = {
        harian:   document.getElementById('f-tanggal'),
        mingguan: document.getElementById('f-minggu'),
        bulanan:  document.getElementById('f-bulan'),
        tahunan:  document.getElementById('f-tahun'),
    };

    function toggle() {
        Object.entries(fields).forEach(([key, el]) => {
            el.style.display = (key === sel.value) ? 'block' : 'none';
        });
    }

    sel.addEventListener('change', toggle);
    toggle();
})();
</script>