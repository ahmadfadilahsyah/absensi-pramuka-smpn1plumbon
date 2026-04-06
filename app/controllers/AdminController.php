<?php
require_once '../libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller {
    private $userModel;
    private $sesiModel;
    private $absensiModel;
    private $limitPerPage = 12;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('AuthController/login');
            exit;
        }
        if($_SESSION['role'] != 'admin') {
            $this->redirect('UserController/dashboard');
            exit;
        }
        
        $this->userModel = $this->model('User');
        $this->sesiModel = $this->model('Sesi');
        $this->absensiModel = $this->model('Absensi');
    }
    
    public function dashboard() {
        $users = $this->userModel->getAllUsers();
        $sesi = $this->sesiModel->getAllSesi();
        $data = [
            'total_users' => count($users),
            'total_sesi' => count($sesi),
            'recent_sesi' => array_slice($sesi, 0, 5)
        ];
        $this->view('admin/dashboard', $data);
    }
    
    public function users() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $this->limitPerPage;
        
        $users = $this->userModel->getAllUsersWithRole($this->limitPerPage, $offset);
        $totalUsers = $this->userModel->getTotalUsersCount();
        $totalPages = ceil($totalUsers / $this->limitPerPage);
        
        $this->view('admin/users', [
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalUsers' => $totalUsers
        ]);
    }
    
    public function editUser($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'nama_lengkap' => trim($_POST['nama_lengkap']),
                'role' => $_POST['role'],
                'kelas' => $_POST['kelas']
            ];
            $this->userModel->updateUser($id, $data);
            
            if (!empty($_POST['new_password'])) {
                $this->userModel->resetPassword($id, $_POST['new_password']);
            }
            
            $this->redirect('AdminController/users');
        } else {
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                $this->redirect('AdminController/users');
            }
            $this->view('admin/edit_user', ['user' => $user]);
        }
    }
    
    public function deleteUser($id) {
        if ($id == 1) {
            $_SESSION['error'] = "Tidak dapat menghapus admin utama.";
        } else {
            $this->userModel->deleteUser($id);
        }
        $this->redirect('AdminController/users');
    }
    
    public function addUser() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'nama_lengkap' => $_POST['nama_lengkap'],
                'role' => $_POST['role'],
                'kelas' => $_POST['kelas']
            ];
            
            if($this->userModel->createUser($data)) {
                $success = "User berhasil ditambahkan!";
                $this->view('admin/add_user', ['success' => $success]);
            } else {
                $error = "Gagal menambahkan user!";
                $this->view('admin/add_user', ['error' => $error]);
            }
        } else {
            $this->view('admin/add_user');
        }
    }
    
    public function sesi() {
        $success = null;
        $error = null;
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama_sesi' => $_POST['nama_sesi'],
                'tanggal' => $_POST['tanggal'],
                'waktu_mulai' => $_POST['waktu_mulai'],
                'waktu_selesai' => $_POST['waktu_selesai']
            ];
            
            if($this->sesiModel->createSesi($data)) {
                $success = "Sesi latihan berhasil dibuat!";
            } else {
                $error = "Gagal membuat sesi!";
            }
        }
        
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $this->limitPerPage;
        
        $sesi_list = $this->sesiModel->getAllSesi($this->limitPerPage, $offset);
        $totalSesi = $this->sesiModel->getTotalSesiCount();
        $totalPages = ceil($totalSesi / $this->limitPerPage);
        
        $this->view('admin/sesi', [
            'sesi_list' => $sesi_list,
            'success' => $success,
            'error' => $error,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalSesi' => $totalSesi
        ]);
    }
    
    public function rekap($sesi_id = null) {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $this->limitPerPage;
        
        if($sesi_id) {
            $rekap = $this->absensiModel->getRekapAbsensi($sesi_id, $this->limitPerPage, $offset);
            $total = $this->absensiModel->getTotalAbsensiCount($sesi_id);
            $sesi = $this->sesiModel->getSesiById($sesi_id);
            $totalPages = ceil($total / $this->limitPerPage);
            $this->view('admin/rekap', [
                'rekap' => $rekap,
                'sesi' => $sesi,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalRecords' => $total
            ]);
        } else {
            $rekap = $this->absensiModel->getRekapAbsensi(null, $this->limitPerPage, $offset);
            $total = $this->absensiModel->getTotalAbsensiCount();
            $totalPages = ceil($total / $this->limitPerPage);
            $this->view('admin/rekap', [
                'rekap' => $rekap,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalRecords' => $total
            ]);
        }
    }
    
    public function editAbsensi($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['status'];
            $keterangan = $_POST['keterangan'] ?? null;
            $this->absensiModel->updateStatus($id, $status, $keterangan);
            $this->redirect('AdminController/rekap');
        }
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT a.*, u.nama_lengkap, s.nama_sesi FROM absensi a JOIN users u ON a.user_id=u.id JOIN sesi_latihan s ON a.sesi_id=s.id WHERE a.id=?");
        $stmt->execute([$id]);
        $absen = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->view('admin/edit_absensi', ['absen' => $absen]);
    }
    
    // EKSPOR LAPORAN (PDF/CSV)
    public function exportLaporan() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $jenis = $_GET['jenis'] ?? 'bulanan';
        $kelas = $_GET['kelas'] ?? 'semua';
        $format = $_GET['format'] ?? 'pdf';
        
        $db = Database::getInstance()->getConnection();
        
        switch($jenis) {
            case 'harian':
                $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
                $where = "DATE(s.tanggal) = :tanggal";
                $params = [':tanggal' => $tanggal];
                $judul = "Laporan_Harian_" . date('d-m-Y', strtotime($tanggal));
                break;
            case 'mingguan':
                $minggu = $_GET['minggu'] ?? date('Y-m-d');
                $start = date('Y-m-d', strtotime('monday this week', strtotime($minggu)));
                $end = date('Y-m-d', strtotime('sunday this week', strtotime($minggu)));
                $where = "DATE(s.tanggal) BETWEEN :start AND :end";
                $params = [':start' => $start, ':end' => $end];
                $judul = "Laporan_Mingguan_" . date('d-m-Y', strtotime($start)) . "_s_d_" . date('d-m-Y', strtotime($end));
                break;
            case 'bulanan':
                $bulan = $_GET['bulan'] ?? date('Y-m');
                $where = "DATE_FORMAT(s.tanggal, '%Y-%m') = :bulan";
                $params = [':bulan' => $bulan];
                $judul = "Laporan_Bulanan_" . date('F_Y', strtotime($bulan . '-01'));
                break;
            case 'tahunan':
                $tahun = $_GET['tahun'] ?? date('Y');
                $where = "YEAR(s.tanggal) = :tahun";
                $params = [':tahun' => $tahun];
                $judul = "Laporan_Tahunan_" . $tahun;
                break;
            default:
                die('Jenis laporan tidak valid');
        }
        
        $kelasFilter = '';
        if($kelas !== 'semua') {
            $kelasFilter = "AND u.kelas = :kelas";
            $params[':kelas'] = $kelas;
        }
        
        $sql = "
            SELECT 
                u.nama_lengkap AS nama,
                u.username,
                u.kelas,
                s.nama_sesi AS sesi,
                s.tanggal,
                s.waktu_mulai,
                s.waktu_selesai,
                a.status,
                a.waktu_absen,
                a.keterangan
            FROM users u
            LEFT JOIN absensi a ON u.id = a.user_id
            LEFT JOIN sesi_latihan s ON a.sesi_id = s.id
            WHERE u.role = 'user' $kelasFilter AND $where
            ORDER BY u.kelas ASC, u.nama_lengkap ASC, s.tanggal DESC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($format == 'csv') {
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename="' . $judul . '.csv"');
            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($output, ['No', 'Kelas', 'Nama', 'Username', 'Sesi', 'Tanggal', 'Waktu', 'Status', 'Waktu Absen', 'Keterangan']);
            $no = 1;
            foreach($data as $row) {
                fputcsv($output, [
                    $no++,
                    $row['kelas'],
                    $row['nama'],
                    $row['username'],
                    $row['sesi'],
                    $row['tanggal'],
                    ($row['waktu_mulai'] && $row['waktu_selesai']) ? $row['waktu_mulai'].'-'.$row['waktu_selesai'] : '-',
                    $row['status'] ?? 'Alpha',
                    $row['waktu_absen'] ?? '-',
                    $row['keterangan'] ?? '-'
                ]);
            }
            fclose($output);
            exit;
        } else {
            if (!class_exists('Dompdf\Dompdf')) {
                die("Library Dompdf tidak ditemukan.");
            }
            $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' . $judul . '</title>
            <style>body{font-family:Arial,sans-serif;} h2{text-align:center;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ddd;padding:6px;text-align:left;} th{background:#4CAF50;color:white;} .footer{text-align:center;margin-top:20px;font-size:11px;}</style>
            </head><body><h2>' . str_replace('_', ' ', $judul) . '</h2><p>Kelas: ' . ucfirst($kelas) . '</p>
            <table><thead><tr><th>No</th><th>Kelas</th><th>Nama</th><th>Username</th><th>Sesi</th><th>Tanggal</th><th>Waktu</th><th>Status</th><th>Waktu Absen</th><th>Keterangan</th></tr></thead><tbody>';
            $no=1;
            foreach($data as $row) {
                $html .= '<tr>
                            <td>'.$no++.'</td>
                            <td>'.$row['kelas'].'</td>
                            <td>'.htmlspecialchars($row['nama']).'</td>
                            <td>'.htmlspecialchars($row['username']).'</td>
                            <td>'.htmlspecialchars($row['sesi']).'</td>
                            <td>'.$row['tanggal'].'</td>
                            <td>'.($row['waktu_mulai']?$row['waktu_mulai'].'-'.$row['waktu_selesai']:'-').'</td>
                            <td>'.($row['status']??'Alpha').'</td>
                            <td>'.($row['waktu_absen']??'-').'</td>
                            <td>'.($row['keterangan']??'-').'</td>
                        </tr>';
            }
            $html .= '</tbody></table><div class="footer">Dicetak: '.date('d-m-Y H:i:s').'<br>Sistem Absensi Pramuka</div></body></html>';
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($judul . '.pdf', ['Attachment' => true]);
            exit;
        }
    }
    
    // LAPORAN PERTEMUAN
    public function laporan() {
        $this->view('admin/laporan_menu');
    }
    
    public function laporanBulanan() {
        $bulan = $_GET['bulan'] ?? date('Y-m');
        $kelas = $_GET['kelas'] ?? '7';
        $db = Database::getInstance()->getConnection();
        
        $allowedKelas = ['7','8','9'];
        if (!in_array($kelas, $allowedKelas)) $kelas = '7';
        
        $stmtSesi = $db->prepare("SELECT id, tanggal, nama_sesi FROM sesi_latihan WHERE DATE_FORMAT(tanggal, '%Y-%m') = ? ORDER BY tanggal ASC");
        $stmtSesi->execute([$bulan]);
        $sesiList = $stmtSesi->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($sesiList)) {
            $error = "Tidak ada sesi latihan pada bulan " . date('F Y', strtotime($bulan . '-01'));
            $this->view('admin/laporan_bulanan', [
                'error' => $error,
                'bulan' => $bulan,
                'kelas' => $kelas,
                'limitPerPage' => $this->limitPerPage
            ]);
            return;
        }
        
        $stmtUser = $db->prepare("SELECT id, nama_lengkap FROM users WHERE role = 'user' AND kelas = ? ORDER BY nama_lengkap");
        $stmtUser->execute([$kelas]);
        $users = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
        
        $laporan = [];
        foreach ($users as $user) {
            $row = ['nama' => $user['nama_lengkap'], 'kehadiran' => []];
            $totalHadir = 0;
            foreach ($sesiList as $sesi) {
                $stmtAbsen = $db->prepare("SELECT status FROM absensi WHERE user_id = ? AND sesi_id = ?");
                $stmtAbsen->execute([$user['id'], $sesi['id']]);
                $absen = $stmtAbsen->fetch(PDO::FETCH_ASSOC);
                $status = $absen ? $absen['status'] : 'alpha';
                $singkatan = match($status) {
                    'hadir' => 'H', 'izin' => 'I', 'sakit' => 'S', default => 'A'
                };
                $row['kehadiran'][] = $singkatan;
                if ($status == 'hadir') $totalHadir++;
            }
            $row['total_hadir'] = $totalHadir;
            $laporan[] = $row;
        }
        
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $total = count($laporan);
        $totalPages = ceil($total / $this->limitPerPage);
        $offset = ($page - 1) * $this->limitPerPage;
        $laporanPaginate = array_slice($laporan, $offset, $this->limitPerPage);
        
        $data = [
            'bulan' => $bulan,
            'kelas' => $kelas,
            'nama_bulan' => date('F Y', strtotime($bulan . '-01')),
            'sesi_list' => $sesiList,
            'laporan' => $laporanPaginate,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalRecords' => $total,
            'limitPerPage' => $this->limitPerPage
        ];
        $this->view('admin/laporan_bulanan', $data);
    }
    
    public function laporanTahunan() {
        $tahun = $_GET['tahun'] ?? date('Y');
        $kelas = $_GET['kelas'] ?? '7';
        $db = Database::getInstance()->getConnection();
        
        $allowedKelas = ['7','8','9'];
        if (!in_array($kelas, $allowedKelas)) $kelas = '7';
        
        $stmtTotalSesi = $db->prepare("SELECT COUNT(*) as total FROM sesi_latihan WHERE YEAR(tanggal) = ?");
        $stmtTotalSesi->execute([$tahun]);
        $totalSesiTahun = $stmtTotalSesi->fetch(PDO::FETCH_ASSOC)['total'];
        
        $stmtUser = $db->prepare("SELECT id, nama_lengkap FROM users WHERE role = 'user' AND kelas = ? ORDER BY nama_lengkap");
        $stmtUser->execute([$kelas]);
        $users = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
        
        $laporan = [];
        foreach ($users as $user) {
            $stmtHadir = $db->prepare("SELECT COUNT(*) as hadir FROM absensi a JOIN sesi_latihan s ON a.sesi_id = s.id WHERE a.user_id = ? AND YEAR(s.tanggal) = ? AND a.status = 'hadir'");
            $stmtHadir->execute([$user['id'], $tahun]);
            $hadir = $stmtHadir->fetch(PDO::FETCH_ASSOC)['hadir'];
            
            $stmtIzin = $db->prepare("SELECT COUNT(*) as izin FROM absensi a JOIN sesi_latihan s ON a.sesi_id = s.id WHERE a.user_id = ? AND YEAR(s.tanggal) = ? AND a.status = 'izin'");
            $stmtIzin->execute([$user['id'], $tahun]);
            $izin = $stmtIzin->fetch(PDO::FETCH_ASSOC)['izin'];
            
            $stmtSakit = $db->prepare("SELECT COUNT(*) as sakit FROM absensi a JOIN sesi_latihan s ON a.sesi_id = s.id WHERE a.user_id = ? AND YEAR(s.tanggal) = ? AND a.status = 'sakit'");
            $stmtSakit->execute([$user['id'], $tahun]);
            $sakit = $stmtSakit->fetch(PDO::FETCH_ASSOC)['sakit'];
            
            $alpha = $totalSesiTahun - ($hadir + $izin + $sakit);
            $skor = $totalSesiTahun > 0 ? round(($hadir / $totalSesiTahun) * 100) : 0;
            
            $laporan[] = [
                'nama' => $user['nama_lengkap'],
                'total_sesi' => $totalSesiTahun,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpha' => $alpha,
                'skor' => $skor
            ];
        }
        
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $total = count($laporan);
        $totalPages = ceil($total / $this->limitPerPage);
        $offset = ($page - 1) * $this->limitPerPage;
        $laporanPaginate = array_slice($laporan, $offset, $this->limitPerPage);
        
        $data = [
            'tahun' => $tahun,
            'kelas' => $kelas,
            'laporan' => $laporanPaginate,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalRecords' => $total,
            'limitPerPage' => $this->limitPerPage
        ];
        $this->view('admin/laporan_tahunan', $data);
    }
}
?>