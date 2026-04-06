<?php
class UserController extends Controller {
    private $absensiModel;
    private $sesiModel;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('AuthController/login');
            exit;
        }
        if($_SESSION['role'] != 'user') {
            $this->redirect('AdminController/dashboard');
            exit;
        }
        
        $this->absensiModel = $this->model('Absensi');
        $this->sesiModel = $this->model('Sesi');
    }
    
    public function dashboard() {
        $recent_absensi = $this->absensiModel->getAbsensiByUser($_SESSION['user_id']);
        $data = [
            'nama' => $_SESSION['nama_lengkap'],
            'recent_absensi' => array_slice($recent_absensi, 0, 5)
        ];
        $this->view('user/dashboard', $data);
    }
    
    public function absen() {
        $active_sesi = $this->sesiModel->getActiveSesi();
        
        if(!$active_sesi) {
            $error = "Tidak ada sesi latihan hari ini!";
            $this->view('user/absen', ['error' => $error]);
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $qr_code = $_POST['qr_code'] ?? null;
            
            if($this->absensiModel->absen($_SESSION['user_id'], $active_sesi['id'], $qr_code)) {
                $success = "Absensi berhasil! Terima kasih.";
                $this->view('user/absen', ['success' => $success, 'sesi' => $active_sesi]);
            } else {
                $error = "Anda sudah melakukan absensi untuk sesi ini!";
                $this->view('user/absen', ['error' => $error, 'sesi' => $active_sesi]);
            }
        } else {
            $this->view('user/absen', ['sesi' => $active_sesi]);
        }
    }

    public function izin() {
        $active_sesi = $this->sesiModel->getActiveSesi();
        if(!$active_sesi) {
            $error = "Tidak ada sesi latihan hari ini!";
            $this->view('user/izin', ['error' => $error]);
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['status']; // 'izin' atau 'sakit'
            $keterangan = trim($_POST['keterangan']);
            
            if(empty($keterangan)) {
                $error = "Harap isi keterangan!";
                $this->view('user/izin', ['error' => $error, 'sesi' => $active_sesi]);
                return;
            }
            
            if($this->absensiModel->izinSakit($_SESSION['user_id'], $active_sesi['id'], $status, $keterangan)) {
                $success = "Pengajuan $status berhasil dicatat.";
                $this->view('user/izin', ['success' => $success, 'sesi' => $active_sesi]);
            } else {
                $error = "Anda sudah melakukan absensi untuk sesi ini!";
                $this->view('user/izin', ['error' => $error, 'sesi' => $active_sesi]);
            }
        } else {
            $this->view('user/izin', ['sesi' => $active_sesi]);
        }
    }
}
?>