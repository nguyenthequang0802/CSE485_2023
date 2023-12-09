<?php
    require_once '../Services/CategoryService.php';
    class CategoryController{
        public function index(){
            $categories = CategoryService::getAll();
            require_once '../Views/admin/category.php';
        }

        public function create(){
            require_once '../Views/admin/add_category.php';
        }

        public function store(){
            if ($_SERVER['REQUEST_METHOD'] = 'POST'){
                $name = isset($_POST['txtCatName']) ? $_POST['txtCatName'] : '';
                if (CategoryService::create($name)){
                    header('Location: ?controller=category');
                } else {
                    echo 'Thêm mới thất bại';
                }
            } else {
                require_once '../Views/admin/add_category.php';
            }
        }

        public function edit(){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $_SESSION['id'] = $id;
            $category = CategoryService::getById($id);
            require_once '../Views/admin/edit_category.php';
        }

        public function update(){
            if ($_SERVER['REQUEST_METHOD'] = 'POST'){
                $id = $_GET['id'];
                $name = isset($_POST['txtCatName']) ? $_POST['txtCatName'] : '';
                if (CategoryService::update($id, $name)){
                    header('Location: ?controller=category');
                } else {
                    echo 'Cập nhật thất bại';
                }
            } else {
                $id = $_GET['id'];
                $category = CategoryService::getById($id);
                require_once '../Views/admin/edit_category.php';
            }
        }

        public function delete(){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $category = CategoryService::delete($id);
            if (CategoryService::delete($id)){
                header('Location: ?controller=category');
            } else {
                echo "Xóa thất bại.";
            }
        }
    }
