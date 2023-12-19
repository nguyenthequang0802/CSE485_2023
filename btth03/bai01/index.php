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
}

//  if($controller == 'user'){
//        // If index.php is in the bai01 directory and UserController.php is in the controllers directory
//         require_once('./controllers/UserController.php');
    
//         $userController = new UserController();
//         switch ($action){
//             case 'index':
//                 $userController->index();
//                 break;
//             default:
//                 $userController->index();
//                 break;
//         }
//     }