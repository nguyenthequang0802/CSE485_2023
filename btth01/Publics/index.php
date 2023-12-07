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
        case 'add':
            $categoryController->create();
            break;
        case 'store':
            $categoryController->store();
            break;
        case 'edit':
            $categoryController->edit();
            break;
        case 'update':
            $categoryController->update();
            break;
        case 'delete':
            $categoryController->delete();
            break;
        default:
            $categoryController->index();
            break;
    }
} elseif ($controller == 'author')  {
    require_once '../Controllers/AuthorController.php';
    $authorController = new AuthorController();
    switch ($action) {
        case 'index':
            $authorController->index();
            break;
        case 'add':
            $authorController->create();
            break;
        case 'store':
            $authorController->store();
            break;
        case 'edit':
            $authorController->edit();
            break;
        case 'update':
            $authorController->update();
            break;
        case 'delete':
            $authorController->delete();
            break;
        default:
            $authorController->index();
            break;
    }
}