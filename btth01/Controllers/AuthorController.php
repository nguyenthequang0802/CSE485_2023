<?php
    require_once '../Services/AuthorService.php';

    class AuthorController{
        public function index(){
            $authors = AuthorService::getAll();
            require_once '../Views/admin/author.php';
        }

        public function create(){
            require_once '../Views/admin/add_author.php';
        }

        public function store(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = isset($_POST['txtAuthorName']) ? $_POST['txtAuthorName'] : '';
                if(AuthorService::create($name)){
                    header('Location: ?controller=author');
                } else {
                    echo 'Thêm mới thất bại';
                }
            } else {
                require_once '../Views/admin/add_author.php';
            }
        }

        public function edit(){
            $id = isset($_GET['id']) ? $_GET['id']  : '';
            $_SESSION['id'] = $id;
            $author = AuthorService::getById($id);
            require_once '../Views/admin/edit_author.php';
        }
        public function update(){
            if ($_SERVER['REQUEST_METHOD'] = 'POST'){
                $id = $_GET['id'];
                $name = isset($_POST['txtAuthorName']) ? $_POST['txtAuthorName'] : '';
                if (AuthorService::update($id, $name)) {
                    header('Location: ?controller=author');
                } else {
                    echo 'Cập nhật thất bại';
                }
            } else {
                $id = $_GET['id'];
                $author = AuthorService::getById($id);
                require_once '../Views/admin/edit_author.php';
            }
        }
        public function delete(){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $author = AuthorService::delete($id);
            if($author){
                header('Location: ?controller=author');
            } else{
                echo 'Xóa thất bại.';
            }
        }
    }