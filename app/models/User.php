<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch(PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }
    
    // Ambil semua user (hanya role = 'user') – untuk keperluan tertentu
    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil semua user (termasuk admin) dengan pagination – urut berdasarkan kelas lalu nama
    public function getAllUsersWithRole($limit = null, $offset = 0) {
        $sql = "SELECT * FROM users ORDER BY kelas ASC, nama_lengkap ASC";
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalUsersCount() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Ambil user berdasarkan kelas (hanya role user)
    public function getUsersByKelas($kelas) {
        $stmt = $this->db->prepare("SELECT id, nama_lengkap FROM users WHERE role = 'user' AND kelas = ? ORDER BY nama_lengkap");
        $stmt->execute([$kelas]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, nama_lengkap, role, kelas) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['nama_lengkap'],
            $data['role'],
            $data['kelas']
        ]);
    }

    public function updateUser($id, $data) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, nama_lengkap = ?, role = ?, kelas = ? WHERE id = ?");
        return $stmt->execute([
            $data['username'],
            $data['nama_lengkap'],
            $data['role'],
            $data['kelas'],
            $id
        ]);
    }

    public function deleteUser($id) {
        // Jangan hapus admin utama (id=1)
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ? AND id != 1");
        return $stmt->execute([$id]);
    }

    public function updatePassword($user_id, $new_password) {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT), $user_id]);
    }

    public function resetPassword($id, $new_password) {
        return $this->updatePassword($id, $new_password);
    }
}
?>