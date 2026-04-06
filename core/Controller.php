<?php
define('BASE_URL', 'http://localhost/absensi/public');

class Controller {
    public function view($view, $data = []) {
        extract($data);
        require_once '../app/views/templates/header.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/templates/footer.php';
    }
    
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    
    public function redirect($url) {
        $fullUrl = rtrim(BASE_URL, '/') . '/' . ltrim($url, '/');
        header('Location: ' . $fullUrl);
        exit;
    }
}
?>