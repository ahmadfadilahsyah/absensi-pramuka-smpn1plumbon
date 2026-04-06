<?php
class Absensi {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function absen($user_id, $sesi_id, $qr_code = null) {
        $stmt = $this->db->prepare("SELECT * FROM absensi WHERE user_id = ? AND sesi_id = ?");
        $stmt->execute([$user_id, $sesi_id]);
        if($stmt->rowCount() > 0) return false;
        
        $stmt = $this->db->prepare("INSERT INTO absensi (user_id, sesi_id, qr_code, status) VALUES (?, ?, ?, 'hadir')");
        return $stmt->execute([$user_id, $sesi_id, $qr_code]);
    }
    
    public function getAbsensiByUser($user_id) {
        $stmt = $this->db->prepare("
            SELECT a.*, s.nama_sesi, s.tanggal 
            FROM absensi a 
            JOIN sesi_latihan s ON a.sesi_id = s.id 
            WHERE a.user_id = ? 
            ORDER BY s.tanggal DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    
    public function getRekapAbsensi($sesi_id = null, $limit = null, $offset = 0) {
        if($sesi_id) {
            $sql = "
                SELECT u.nama_lengkap, u.username, a.id, a.status, a.waktu_absen, a.keterangan
                FROM users u 
                LEFT JOIN absensi a ON u.id = a.user_id AND a.sesi_id = ?
                WHERE u.role = 'user'
                ORDER BY u.nama_lengkap
            ";
            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$sesi_id]);
        } else {
            $sql = "
                SELECT u.nama_lengkap, u.username, 
                       COUNT(CASE WHEN a.status = 'hadir' THEN 1 END) as total_hadir,
                       COUNT(CASE WHEN a.status = 'izin' THEN 1 END) as total_izin,
                       COUNT(CASE WHEN a.status = 'sakit' THEN 1 END) as total_sakit,
                       COUNT(CASE WHEN a.status IS NULL OR a.status = 'alpha' THEN 1 END) as total_alpha
                FROM users u 
                LEFT JOIN absensi a ON u.id = a.user_id
                WHERE u.role = 'user'
                GROUP BY u.id
                ORDER BY u.nama_lengkap
            ";
            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
            }
            $stmt = $this->db->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalAbsensiCount($sesi_id = null) {
        if($sesi_id) {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
            $stmt->execute();
        } else {
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function izinSakit($user_id, $sesi_id, $status, $keterangan) {
        $stmt = $this->db->prepare("SELECT * FROM absensi WHERE user_id = ? AND sesi_id = ?");
        $stmt->execute([$user_id, $sesi_id]);
        if($stmt->rowCount() > 0) return false;
        
        $stmt = $this->db->prepare("INSERT INTO absensi (user_id, sesi_id, status, keterangan) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $sesi_id, $status, $keterangan]);
    }

    public function updateStatus($absensi_id, $status, $keterangan = null) {
        if($keterangan !== null) {
            $stmt = $this->db->prepare("UPDATE absensi SET status = ?, keterangan = ? WHERE id = ?");
            return $stmt->execute([$status, $keterangan, $absensi_id]);
        } else {
            $stmt = $this->db->prepare("UPDATE absensi SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $absensi_id]);
        }
    }
}
?>