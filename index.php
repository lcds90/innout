<?php 

require_once('./config/config.php');

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if($uri === '/' || $uri === '' || $uri === '/index.php' ) {
    $uri = '/login.php';
}

require_once(CONTROLLER_PATH . "/{$uri}");
