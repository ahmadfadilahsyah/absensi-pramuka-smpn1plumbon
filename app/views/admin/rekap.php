<h2 class="serif-heading">📊 Rekap Absensi</h2>
<div class="card-scout p-4">
    <?php if(isset($data['sesi'])): ?>
        <div class="alert alert-info">Sesi: <?= htmlspecialchars($data['sesi']['nama_sesi']) ?> (<?= $data['sesi']['tanggal'] ?>)</div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr><th>No</th><th>Nama Lengkap</th><th>Username</th>
                <?php if(isset($data['sesi'])): ?>
                    <th>Status</th><th>Waktu Absen</th><th>Keterangan</th><th>Aksi</th>
                <?php else: ?>
                    <th>Hadir</th><th>Izin</th><th>Sakit</th><th>Alpha</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['rekap'])): ?>
                <tr><td colspan="10" class="text-center">Belum ada data</td></tr>
                <?php else: ?>
                    <?php $no = ($data['currentPage']-1)*$this->limitPerPage + 1; foreach($data['rekap'] as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <?php if(isset($data['sesi'])): ?>
                            <td><?php 
                                $status = $row['status'] ?? 'alpha';
                                $badge = match($status) {
                                    'hadir' => 'success', 'izin' => 'warning', 'sakit' => 'info', default => 'danger'
                                };
                                echo '<span class="badge bg-'.$badge.'">'.ucfirst($status).'</span>';
                            ?></td>
                            <td><?= $row['waktu_absen'] ?? '-' ?></td>
                            <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                            <td><?= isset($row['id']) ? '<a href="'.BASE_URL.'/AdminController/editAbsensi/'.$row['id'].'" class="btn btn-sm btn-primary">Edit</a>' : '-' ?></td>
                        <?php else: ?>
                            <td><?= $row['total_hadir'] ?? 0 ?></td>
                            <td><?= $row['total_izin'] ?? 0 ?></td>
                            <td><?= $row['total_sakit'] ?? 0 ?></td>
                            <td><?= $row['total_alpha'] ?? 0 ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <?php if($data['totalPages'] > 1): ?>
    <nav><ul class="pagination justify-content-center">
        <li class="page-item <?= $data['currentPage']==1?'disabled':'' ?>"><a class="page-link" href="?page=<?= $data['currentPage']-1 ?>">Prev</a></li>
        <?php for($i=1;$i<=$data['totalPages'];$i++): ?>
        <li class="page-item <?= $i==$data['currentPage']?'active':'' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item <?= $data['currentPage']==$data['totalPages']?'disabled':'' ?>"><a class="page-link" href="?page=<?= $data['currentPage']+1 ?>">Next</a></li>
    </ul></nav>
    <?php endif; ?>
    <div class="text-muted small">Total <?= $data['totalRecords'] ?> anggota</div>
</div>