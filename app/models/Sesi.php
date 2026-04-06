<?php
class Sesi {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAllSesi($limit = null, $offset = 0) {
        $sql = "SELECT * FROM sesi_latihan ORDER BY tanggal DESC";
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalSesiCount() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM sesi_latihan");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function getActiveSesi() {
        $today = date('Y-m-d');
        $stmt = $this->db->prepare("SELECT * FROM sesi_latihan WHERE tanggal = ? ORDER BY waktu_mulai LIMIT 1");
        $stmt->execute([$today]);
        return $stmt->fetch();
    }
    
    public function createSesi($data) {
        $stmt = $this->db->prepare("INSERT INTO sesi_latihan (nama_sesi, tanggal, waktu_mulai, waktu_selesai, created_by) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nama_sesi'],
            $data['tanggal'],
            $data['waktu_mulai'],
            $data['waktu_selesai'],
            $_SESSION['user_id']
        ]);
    }
    
    public function getSesiById($id) {
        $stmt = $this->db->prepare("SELECT * FROM sesi_latihan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>