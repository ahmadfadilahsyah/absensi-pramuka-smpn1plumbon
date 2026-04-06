<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../config/database.php';
require_once '../core/App.php';
require_once '../core/Controller.php';

$app = new App();
?>