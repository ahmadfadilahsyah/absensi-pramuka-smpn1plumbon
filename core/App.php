<?php
class App {
    protected $controller = 'AuthController';
    protected $method = 'login';
    protected $params = [];
    
    public function __construct() {
        $url = $this->parseURL();
        
        // Jika URL kosong, gunakan default
        if (empty($url[0])) {
            $this->loadController();
            $this->callMethod();
            return;
        }
        
        // Cek apakah file controller ada
        $controllerFile = '../app/controllers/' . $url[0] . '.php';
        if (file_exists($controllerFile)) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        $this->loadController();
        
        // Cek method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        
        $this->params = $url ? array_values($url) : [];
        $this->callMethod();
    }
    
    private function loadController() {
        $file = '../app/controllers/' . $this->controller . '.php';
        if (!file_exists($file)) {
            die("Controller tidak ditemukan: " . $this->controller);
        }
        require_once $file;
        $this->controller = new $this->controller;
    }
    
    private function callMethod() {
        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            die("Method tidak ditemukan: " . $this->method);
        }
    }
    
    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
?>