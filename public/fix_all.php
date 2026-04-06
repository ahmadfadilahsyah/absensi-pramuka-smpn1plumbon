<?php
require_once '../config/database.php';
$db = Database::getInstance()->getConnection();

// Reset semua tabel
$db->exec("SET FOREIGN_KEY_CHECKS = 0");
$db->exec("TRUNCATE TABLE absensi");
$db->exec("TRUNCATE TABLE sesi_latihan");
$db->exec("TRUNCATE TABLE users");
$db->exec("SET FOREIGN_KEY_CHECKS = 1");

// Insert admin
$admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
$db->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, 'admin')")
   ->execute(['admin', $admin_pass, 'Administrator']);

// Insert user
$user_pass = password_hash('user123', PASSWORD_DEFAULT);
$db->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, 'user')")
   ->execute(['user1', $user_pass, 'Anggota Pramuka']);

echo "✅ Database siap!<br>";
echo "Admin: admin / admin123<br>";
echo "User: user1 / user123<br>";
echo "<a href='index.php?url=AuthController/login'>Login</a>";
?>