<!-- ══════════════════════════════
     KELOLA USER PAGE
══════════════════════════════ -->

<!-- Page Header -->
<div class="page-header animate-in">
    <div>
        <div class="page-header-eyebrow">Manajemen</div>
        <h1 class="page-header-title">Kelola User</h1>
        <p class="page-header-sub">Tambah, edit, atau hapus data anggota & administrator Pramuka</p>
    </div>
    <a href="<?= BASE_URL ?>/AdminController/addUser" class="btn-scout">
        <i class="bi bi-person-plus-fill"></i> Tambah User Baru
    </a>
</div>

<!-- Stat Cards Row -->
<div class="row g-3 mb-4 animate-in">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['totalUsers'] ?></div>
                <div class="stat-label">Total User</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="bi bi-person-badge-fill"></i>
            </div>
            <div>
                <div class="stat-value">
                    <?= count(array_filter($data['users'], fn($u) => $u['role'] === 'admin')) ?>
                </div>
                <div class="stat-label">Admin</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <div class="stat-value">
                    <?= count(array_filter($data['users'], fn($u) => $u['role'] === 'user')) ?>
                </div>
                <div class="stat-label">Anggota</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <div class="stat-value"><?= $data['totalPages'] ?></div>
                <div class="stat-label">Halaman</div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="card-scout animate-in" style="border-radius: var(--radius-md); margin-bottom: 20px;">
    <div style="padding: 16px 22px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <div class="form-scout" style="flex: 1; min-width: 200px;">
            <div class="search-input-wrapper">
                <i class="bi bi-search search-input-icon"></i>
                <input type="text"
                       id="searchUser"
                       class="form-control search-input"
                       placeholder="Cari nama atau username...">
            </div>
        </div>
        <div class="form-scout">
            <select class="form-select filter-select" id="filterRole">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="user">Anggota</option>
            </select>
        </div>
        <div class="user-count-badge">
            <i class="bi bi-database"></i>
            <span id="shownCount"><?= count($data['users']) ?></span> dari <?= $data['totalUsers'] ?> user
        </div>
    </div>
</div>

<!-- User Table Card -->
<div class="card-scout animate-in">
    <div class="card-scout-header">
        <div class="card-scout-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <div style="flex: 1;">
            <div class="card-scout-title">Daftar User</div>
            <div style="font-size: .78rem; color: var(--c-muted); margin-top: 2px;">
                Halaman <?= $data['currentPage'] ?> dari <?= $data['totalPages'] ?>
            </div>
        </div>
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-toggle-btn active" onclick="setView('table', this)" title="Tampilan Tabel">
                <i class="bi bi-list-ul"></i>
            </button>
            <button class="view-toggle-btn" onclick="setView('grid', this)" title="Tampilan Grid">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
        </div>
    </div>

    <div class="card-scout-body" style="padding: 0;">

        <!-- ═══ TABLE VIEW ═══ -->
        <div class="table-responsive" id="tableView">
            <table class="table-scout" id="userTable">
                <thead>
                    <tr>
                        <th style="width: 56px;">No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th style="width: 120px;">Role</th>
                        <th style="width: 180px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = ($data['currentPage'] - 1) * 12 + 1;
                    foreach ($data['users'] as $user):
                    ?>
                    <tr class="user-row"
                        data-name="<?= strtolower(htmlspecialchars($user['nama_lengkap'])) ?>"
                        data-username="<?= strtolower(htmlspecialchars($user['username'])) ?>"
                        data-role="<?= $user['role'] ?>">
                        <td>
                            <span class="row-number"><?= $no++ ?></span>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="user-cell-avatar <?= $user['role'] === 'admin' ? 'admin' : 'member' ?>">
                                    <?= strtoupper(substr($user['nama_lengkap'], 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="user-cell-name"><?= htmlspecialchars($user['nama_lengkap']) ?></div>
                                    <div class="user-cell-id">ID: <?= $user['id'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="username-tag">
                                <i class="bi bi-at"></i><?= htmlspecialchars($user['username']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($user['role'] === 'admin'): ?>
                                <span class="status-badge badge-admin">
                                    <i class="bi bi-shield-fill"></i> Admin
                                </span>
                            <?php else: ?>
                                <span class="status-badge badge-member">
                                    <i class="bi bi-person-fill"></i> Anggota
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <div class="action-buttons">
                                <a href="<?= BASE_URL ?>/AdminController/editUser/<?= $user['id'] ?>"
                                   class="btn-action btn-action-edit"
                                   title="Edit User">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit</span>
                                </a>
                                <?php if ($user['id'] != 1): ?>
                                    <a href="<?= BASE_URL ?>/AdminController/deleteUser/<?= $user['id'] ?>"
                                       class="btn-action btn-action-delete"
                                       title="Hapus User"
                                       onclick="return confirmDelete('<?= htmlspecialchars($user['nama_lengkap']) ?>')">
                                        <i class="bi bi-trash3"></i>
                                        <span>Hapus</span>
                                    </a>
                                <?php else: ?>
                                    <span class="btn-action btn-action-disabled" title="Super Admin tidak bisa dihapus">
                                        <i class="bi bi-lock-fill"></i>
                                        <span>Protected</span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($data['users'])): ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-person-x"></i>
                                </div>
                                <div class="empty-state-title">Belum Ada Data User</div>
                                <div class="empty-state-text">Mulai dengan menambahkan user baru</div>
                                <a href="<?= BASE_URL ?>/AdminController/addUser" class="btn-scout mt-3">
                                    <i class="bi bi-person-plus-fill"></i> Tambah User
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- ═══ GRID VIEW (hidden by default) ═══ -->
        <div class="user-grid" id="gridView" style="display: none;">
            <?php
            $no2 = ($data['currentPage'] - 1) * 12 + 1;
            foreach ($data['users'] as $user):
            ?>
            <div class="user-grid-card user-row"
                 data-name="<?= strtolower(htmlspecialchars($user['nama_lengkap'])) ?>"
                 data-username="<?= strtolower(htmlspecialchars($user['username'])) ?>"
                 data-role="<?= $user['role'] ?>">
                <div class="user-grid-avatar <?= $user['role'] === 'admin' ? 'admin' : 'member' ?>">
                    <?= strtoupper(substr($user['nama_lengkap'], 0, 1)) ?>
                </div>
                <div class="user-grid-name"><?= htmlspecialchars($user['nama_lengkap']) ?></div>
                <div class="user-grid-username">
                    <i class="bi bi-at"></i><?= htmlspecialchars($user['username']) ?>
                </div>
                <?php if ($user['role'] === 'admin'): ?>
                    <span class="status-badge badge-admin mt-2">
                        <i class="bi bi-shield-fill"></i> Admin
                    </span>
                <?php else: ?>
                    <span class="status-badge badge-member mt-2">
                        <i class="bi bi-person-fill"></i> Anggota
                    </span>
                <?php endif; ?>
                <div class="user-grid-actions mt-3">
                    <a href="<?= BASE_URL ?>/AdminController/editUser/<?= $user['id'] ?>"
                       class="btn-action btn-action-edit">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <?php if ($user['id'] != 1): ?>
                        <a href="<?= BASE_URL ?>/AdminController/deleteUser/<?= $user['id'] ?>"
                           class="btn-action btn-action-delete"
                           onclick="return confirmDelete('<?= htmlspecialchars($user['nama_lengkap']) ?>')">
                            <i class="bi bi-trash3"></i> Hapus
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- No Search Result -->
        <div class="empty-state" id="noResultState" style="display: none;">
            <div class="empty-state-icon">
                <i class="bi bi-search"></i>
            </div>
            <div class="empty-state-title">Tidak Ditemukan</div>
            <div class="empty-state-text">Coba ubah kata kunci pencarian atau filter</div>
        </div>
    </div>
</div>

<!-- Pagination -->
<?php if ($data['totalPages'] > 1): ?>
<div class="pagination-scout animate-in">
    <div class="pagination-info">
        Menampilkan halaman <strong><?= $data['currentPage'] ?></strong> dari
        <strong><?= $data['totalPages'] ?></strong>
    </div>
    <div class="pagination-buttons">
        <!-- Previous -->
        <a href="?page=<?= $data['currentPage'] - 1 ?>"
           class="pagination-btn <?= $data['currentPage'] == 1 ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-left"></i>
        </a>

        <?php
        $start = max(1, $data['currentPage'] - 2);
        $end = min($data['totalPages'], $data['currentPage'] + 2);
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

        <!-- Next -->
        <a href="?page=<?= $data['currentPage'] + 1 ?>"
           class="pagination-btn <?= $data['currentPage'] == $data['totalPages'] ? 'disabled' : '' ?>">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>
</div>
<?php endif; ?>

<!-- Footer Note -->
<div class="text-center mt-3 animate-in" style="font-size: .75rem; color: var(--c-muted);">
    <i class="bi bi-info-circle"></i>
    User dengan ID #1 (Super Admin) dilindungi dan tidak dapat dihapus
</div>

<!-- ══════════════════════════════
     ADDITIONAL STYLES
══════════════════════════════ -->
<style>
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
        font-size: .875rem;
        background: var(--c-cream) !important;
        transition: all .25s;
    }

    .search-input:focus {
        background: var(--c-white) !important;
        border-color: var(--c-gold) !important;
        box-shadow: 0 0 0 3px rgba(201, 149, 42, .12) !important;
    }

    .filter-select {
        border: 1.5px solid var(--c-border) !important;
        border-radius: var(--radius-pill) !important;
        padding: 10px 36px 10px 16px !important;
        font-size: .875rem;
        background-color: var(--c-cream) !important;
        min-width: 150px;
        cursor: pointer;
        transition: all .25s;
    }

    .filter-select:focus {
        border-color: var(--c-gold) !important;
        box-shadow: 0 0 0 3px rgba(201, 149, 42, .12) !important;
    }

    .user-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--c-parchment);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-pill);
        font-size: .78rem;
        font-weight: 500;
        color: var(--c-muted);
        white-space: nowrap;
    }

    .user-count-badge i { color: var(--c-gold); }

    /* ── View Toggle ── */
    .view-toggle {
        display: flex;
        background: var(--c-parchment);
        border-radius: var(--radius-sm);
        padding: 3px;
        gap: 2px;
    }

    .view-toggle-btn {
        background: none;
        border: none;
        padding: 6px 10px;
        border-radius: 7px;
        color: var(--c-muted);
        cursor: pointer;
        font-size: .95rem;
        transition: all .2s;
    }

    .view-toggle-btn:hover { color: var(--c-forest); }

    .view-toggle-btn.active {
        background: var(--c-white);
        color: var(--c-forest);
        box-shadow: var(--shadow-sm);
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

    /* ── User Cell (table) ── */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-cell-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: .95rem;
        flex-shrink: 0;
    }

    .user-cell-avatar.admin {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
    }

    .user-cell-avatar.member {
        background: rgba(46, 94, 71, .1);
        color: var(--c-forest-mid);
    }

    .user-cell-name {
        font-weight: 600;
        font-size: .9rem;
        color: var(--c-ink);
        line-height: 1.3;
    }

    .user-cell-id {
        font-size: .7rem;
        color: var(--c-muted);
        letter-spacing: .04em;
    }

    /* ── Username Tag ── */
    .username-tag {
        display: inline-flex;
        align-items: center;
        gap: 1px;
        padding: 4px 12px;
        background: var(--c-parchment);
        border-radius: var(--radius-pill);
        font-size: .8rem;
        color: var(--c-muted);
        font-weight: 500;
    }

    .username-tag i {
        font-size: .85rem;
        color: var(--c-gold);
    }

    /* ── Role Badges ── */
    .badge-admin {
        background: rgba(201, 149, 42, .12) !important;
        color: #a07820 !important;
    }

    .badge-admin i { margin-right: 3px; }

    .badge-member {
        background: rgba(46, 94, 71, .1) !important;
        color: var(--c-forest-mid) !important;
    }

    .badge-member i { margin-right: 3px; }

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

    .btn-action-edit {
        background: rgba(46, 94, 71, .08);
        color: var(--c-forest-mid);
        border-color: rgba(46, 94, 71, .15);
    }

    .btn-action-edit:hover {
        background: var(--c-forest);
        color: var(--c-white);
        border-color: var(--c-forest);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(27, 58, 45, .2);
    }

    .btn-action-delete {
        background: rgba(185, 50, 50, .06);
        color: #b93232;
        border-color: rgba(185, 50, 50, .12);
    }

    .btn-action-delete:hover {
        background: #b93232;
        color: var(--c-white);
        border-color: #b93232;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(185, 50, 50, .25);
    }

    .btn-action-disabled {
        background: var(--c-parchment);
        color: var(--c-muted);
        border-color: var(--c-border);
        cursor: not-allowed;
        opacity: .6;
    }

    /* ── Grid View ── */
    .user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        padding: 20px 24px;
    }

    .user-grid-card {
        background: var(--c-cream);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        padding: 24px 20px;
        text-align: center;
        transition: all .25s;
    }

    .user-grid-card:hover {
        background: var(--c-white);
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
    }

    .user-grid-avatar {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0 auto 12px;
    }

    .user-grid-avatar.admin {
        background: linear-gradient(135deg, var(--c-gold-light), var(--c-gold));
        color: var(--c-forest);
    }

    .user-grid-avatar.member {
        background: rgba(46, 94, 71, .1);
        color: var(--c-forest-mid);
    }

    .user-grid-name {
        font-weight: 600;
        font-size: .95rem;
        color: var(--c-ink);
        margin-bottom: 4px;
    }

    .user-grid-username {
        font-size: .78rem;
        color: var(--c-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1px;
    }

    .user-grid-username i { color: var(--c-gold); }

    .user-grid-actions {
        display: flex;
        justify-content: center;
        gap: 6px;
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
        box-shadow: 0 4px 12px rgba(201, 149, 42, .3);
    }

    .pagination-btn.disabled {
        opacity: .35;
        pointer-events: none;
        cursor: not-allowed;
    }

    .pagination-dots {
        color: var(--c-muted);
        font-size: .85rem;
        padding: 0 4px;
        user-select: none;
    }

    /* ── Delete Confirm Modal ── */
    .modal-scout .modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .modal-scout .modal-header {
        background: linear-gradient(135deg, #b93232, #d44444);
        color: white;
        border: none;
        padding: 20px 24px;
    }

    .modal-scout .modal-title {
        font-family: var(--font-display);
        font-weight: 700;
    }

    .modal-scout .modal-body {
        padding: 28px 24px;
        text-align: center;
    }

    .modal-scout .modal-footer {
        border: none;
        padding: 16px 24px 24px;
        justify-content: center;
        gap: 10px;
    }

    /* ── Responsive Adjustments ── */
    @media (max-width: 767.98px) {
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }

        .btn-action span {
            display: none;
        }

        .btn-action {
            padding: 8px 10px;
            border-radius: 8px;
        }

        .user-count-badge {
            width: 100%;
            justify-content: center;
        }

        .pagination-scout {
            justify-content: center;
        }

        .pagination-info {
            width: 100%;
            text-align: center;
        }

        .user-cell-avatar {
            width: 32px;
            height: 32px;
            font-size: .8rem;
            border-radius: 8px;
        }

        .user-cell { gap: 8px; }

        .table-scout thead th,
        .table-scout tbody td {
            padding: 10px 10px;
            font-size: .8rem;
        }
    }

    /* ── Row Animation ── */
    .table-scout tbody tr {
        transition: opacity .3s, transform .3s;
    }

    .table-scout tbody tr.hiding {
        opacity: 0;
        transform: scale(.97);
    }

    .user-grid-card {
        transition: opacity .3s, transform .3s;
    }

    .user-grid-card.hiding {
        opacity: 0;
        transform: scale(.95);
    }
</style>

<!-- ══════════════════════════════
     SCRIPTS
══════════════════════════════ -->
<script>
    /**
     * Search & Filter
     */
    const searchInput = document.getElementById('searchUser');
    const filterRole  = document.getElementById('filterRole');

    function filterUsers() {
        const query = searchInput.value.toLowerCase().trim();
        const role  = filterRole.value;
        const rows  = document.querySelectorAll('.user-row');
        let visible = 0;

        rows.forEach(row => {
            const name     = row.dataset.name || '';
            const username = row.dataset.username || '';
            const rowRole  = row.dataset.role || '';

            const matchSearch = name.includes(query) || username.includes(query);
            const matchRole   = !role || rowRole === role;

            if (matchSearch && matchRole) {
                row.style.display = '';
                row.classList.remove('hiding');
                visible++;
            } else {
                row.classList.add('hiding');
                setTimeout(() => {
                    row.style.display = 'none';
                }, 200);
            }
        });

        // Update count
        const countEl = document.getElementById('shownCount');
        if (countEl) countEl.textContent = visible;

        // Show no result state
        const noResult = document.getElementById('noResultState');
        const tableView = document.getElementById('tableView');
        const gridView  = document.getElementById('gridView');

        if (visible === 0 && (query || role)) {
            noResult.style.display = 'block';
            tableView.style.display = 'none';
            gridView.style.display  = 'none';
        } else {
            noResult.style.display = 'none';
            // Restore whichever view is active
            const isGrid = document.querySelector('.view-toggle-btn:last-child').classList.contains('active');
            tableView.style.display = isGrid ? 'none' : '';
            gridView.style.display  = isGrid ? 'grid' : 'none';
        }
    }

    searchInput.addEventListener('input', filterUsers);
    filterRole.addEventListener('change', filterUsers);

    /**
     * View Toggle
     */
    function setView(mode, btn) {
        document.querySelectorAll('.view-toggle-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const tableView = document.getElementById('tableView');
        const gridView  = document.getElementById('gridView');

        if (mode === 'grid') {
            tableView.style.display = 'none';
            gridView.style.display  = 'grid';
        } else {
            tableView.style.display = '';
            gridView.style.display  = 'none';
        }
    }

    /**
     * Delete Confirmation
     */
    function confirmDelete(name) {
        return confirm(
            '⚠️ Hapus User\n\n' +
            'Apakah Anda yakin ingin menghapus user "' + name + '"?\n\n' +
            'Tindakan ini tidak dapat dibatalkan.'
        );
    }
</script>