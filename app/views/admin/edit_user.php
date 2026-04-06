<h2 class="serif-heading">✏️ Edit User</h2>
<div class="card-scout p-4">
    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['user']['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($data['user']['nama_lengkap']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="7" <?= $data['user']['kelas'] == '7' ? 'selected' : '' ?>>Kelas 7</option>
                <option value="8" <?= $data['user']['kelas'] == '8' ? 'selected' : '' ?>>Kelas 8</option>
                <option value="9" <?= $data['user']['kelas'] == '9' ? 'selected' : '' ?>>Kelas 9</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" <?= $data['user']['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= $data['user']['role'] == 'user' ? 'selected' : '' ?>>User</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Password Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="new_password" class="form-control" placeholder="Isi hanya jika ingin reset password">
        </div>
        <button type="submit" class="btn btn-scout-primary">Simpan Perubahan</button>
        <a href="<?= BASE_URL ?>/AdminController/users" class="btn btn-secondary">Batal</a>
    </form>
</div>