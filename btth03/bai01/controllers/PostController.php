<?php
require_once "../bai01/services/PostService.php";

class PostController{
    public function index(){
        $posts = PostService::getAll();
        require_once '../bai01/views/posts/index.php';
    }
    public function create(){
        require_once '../bai01/views/posts/create.php';
    }

    public function store(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = isset($_POST['title']) ? $_POST['title'] :'';
            $message = isset($_POST['message']) ? $_POST['message']:'';
            $category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $user = isset($_POST['user_id']) ? $_POST['user_id'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            if (PostService::create($title, $message, $category, $user, $status)) {
                header("Location: ?controller=post");
            } else {
                echo "Thất bại!";
            }
        } else{
            require_once '../bai01/views/posts/create.php';
        }
    }

    public function edit(){
        $id = isset($_GET['id']) ? $_GET['id']: '';
        $_SESSION['id'] = $id;
        $post = PostService::getById($id);
        require_once '../bai01/views/posts/edit.php';
    }

    public function update(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_GET['id'];
            $title = isset($_POST['title']) ? $_POST['title'] :'';
            $message = isset($_POST['message']) ? $_POST['message']:'';
            $category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $user = isset($_POST['user_id']) ? $_POST['user_id'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            if (PostService::update($id, $title, $message, $category, $user, $status)) {
                header("Location: ?controller=post");
            } else {
                echo "Thất bại!";
            }
        } else {
            $id = $_GET['id'];
            $post = PostService::getById($id);
            require_once '../bai01/views/posts/edit.php';
        }
    }

    public function delete(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $_SESSION['id'] = $id;
        $post = PostService::delete($id);
        if (PostService::delete($id)){
            header("Location: ?controller=post");
        } else {
            echo "Failed";
        }

    }
}