<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action']: 'index';

if ($controller == 'post'){
    require_once './controllers/PostController.php';
    $postController = new PostController();
    switch ($action){
        case 'index':
            $postController->index();
            break;
        case 'create':
            $postController->create();
            break;
        case 'store':
            $postController->store();
            break;
        case 'edit':
            $postController->edit();
            break;
        case 'update':
            $postController->update();
            break;
        case 'delete':
            $postController->delete();
            break;
        default:
            $postController->index();
            break;
    }
<<<<<<< HEAD
}

if ($controller == 'category') {
    require_once './controllers/CategoryController.php';
    $categoryController = new CategoryController();
    switch ($action) {
        case 'index':
            $categoryController->index();
            break;
        case 'create':
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
}
=======
}
>>>>>>> 498dfbbc49e1a510026ed0f350fb4222cc676a40
