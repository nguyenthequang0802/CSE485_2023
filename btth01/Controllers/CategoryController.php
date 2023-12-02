<?php
    require_once '../Services/CategoryService.php';
    class CategoryController{
        public function index(){
            $categories = CategoryService::getAll();
            require_once '../Views/admin/category.php';
        }
    }