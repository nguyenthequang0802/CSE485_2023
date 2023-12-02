<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$param = isset($_GET['param']) ? $_GET['param'] : '';

if ($controller == 'category') {
    require_once '../Controllers/CategoryController.php';
    $categoryController = new CategoryController();
    switch ($action) {
        case 'index':
            $categoryController->index();
            break;
        default:
            $categoryController->index();
            break;
    }
}