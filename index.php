<?php
require_once './controllers/Autoload.php';
$autoload = new Autoload();

$route = isset($_GET['r']) ? $_GET['r'] : 'home';
$inventariojuegos = new Router($route);
