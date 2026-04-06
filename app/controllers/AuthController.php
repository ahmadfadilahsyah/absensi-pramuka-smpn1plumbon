<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../core/Controller.php';

class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        // Cek apakah model User berhasil dimuat
        $this->userModel = $this->model('User');
        if (!$this->userModel) {
            die("Model User gagal dimuat.");
        }
    }
    
    public function index() {
        $this->login();
    }
    
    public function login() {
        // Jika sudah login, langsung redirect ke dashboard sesuai role
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['role'] == 'admin') {
                $this->redirect('AdminController/dashboard');
            } else {
                $this->redirect('UserController/dashboard');
            }
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            // Captcha check
            if(!isset($_POST['captcha']) || !isset($_SESSION['captcha']) || $_POST['captcha'] != $_SESSION['captcha']) {
                $error = "Captcha salah!";
                // Gunakan view khusus login tanpa template
                $this->viewLogin($error);
                return;
            }
            
            $user = $this->userModel->login($username, $password);
            
            if($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                
                if($user['role'] == 'admin') {
                    $this->redirect('AdminController/dashboard');
                } else {
                    $this->redirect('UserController/dashboard');
                }
            } else {
                $error = "Username atau password salah!";
                $this->viewLogin($error);
            }
        } else {
            $this->viewLogin();
        }
    }

    // Method khusus untuk menampilkan halaman login tanpa header/footer
    private function viewLogin($error = null) {
        // Sertakan file login_standalone.php yang sudah dibuat
        require_once '../app/views/auth/login_standalone.php';
        exit;
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('AuthController/login');
    }
    
    public function gantiPassword() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('AuthController/login');
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old = $_POST['old_password'];
            $new = $_POST['new_password'];
            $confirm = $_POST['confirm_password'];
            
            if($new !== $confirm) {
                $error = "Password baru tidak cocok!";
                $this->view('auth/ganti_password', ['error' => $error]);
                return;
            }
            
            $user = $this->userModel->login($_SESSION['username'], $old);
            if(!$user) {
                $error = "Password lama salah!";
                $this->view('auth/ganti_password', ['error' => $error]);
                return;
            }
            
            if($this->userModel->updatePassword($_SESSION['user_id'], $new)) {
                $success = "Password berhasil diubah!";
                $this->view('auth/ganti_password', ['success' => $success]);
            } else {
                $error = "Gagal mengubah password!";
                $this->view('auth/ganti_password', ['error' => $error]);
            }
        } else {
            $this->view('auth/ganti_password');
        }
    }
}
?>