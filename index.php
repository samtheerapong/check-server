<?php
require_once 'controllers/ServerController.php';

$controller = new ServerController();

// Simple routing
$uri = $_SERVER['REQUEST_URI'];
// ลบ /check-server ออกจาก URI เพื่อให้ routing ทำงานได้ถูกต้อง
$basePath = '/check-server';
$uri = str_replace($basePath, '', $uri);
$uri = explode('/', trim($uri, '/'));

if (empty($uri[0])) {
    $controller->index();
} elseif ($uri[0] === 'admin') {
    $controller->admin();
} elseif ($uri[0] === 'create') {
    $controller->create();
} elseif ($uri[0] === 'edit' && isset($uri[1])) {
    $controller->edit($uri[1]);
} elseif ($uri[0] === 'delete' && isset($uri[1])) {
    $controller->delete($uri[1]);
} else {
    $controller->index();
}