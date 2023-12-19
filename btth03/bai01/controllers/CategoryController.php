<?php
require_once '../bai01/services/CategoryService.php';

class CategoryController {
    public function index() {
        $categories = CategoryService::getAll();
        require_once '../bai01/views/categories/index.php';
    }

    public function create() {
        require_once '../bai01/views/categories/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            if (CategoryService::create($name)) {
                header("Location: ?controller=category");
            } else {
                echo "Thất bại!";
            }
        } else {
            require_once '../bai01/views/categories/create.php';
        }
    }

    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $_SESSION['id'] = $id;
        $category = CategoryService::getById($id);
        require_once '../bai01/views/categories/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            if (CategoryService::update($id, $name)) {
                header("Location: ?controller=category");
            } else {
                echo "Thất bại!";
            }
        } else {
            $id = $_GET['id'];
            $category = CategoryService::getById($id);
            require_once '../bai01/views/categories/edit.php';
        }
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $_SESSION['id'] = $id;
        $category = CategoryService::delete($id);
        if (CategoryService::delete($id)) {
            header("Location: ?controller=category");
        } else {
            echo "Failed";
        }
    }
}