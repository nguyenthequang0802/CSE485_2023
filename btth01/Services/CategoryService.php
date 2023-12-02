<?php
    require_once '../Libs/Database.php';
    require_once '../Models/Category.php';

    class CategoryService{
        public static function getAll(){
            $db = new Database();
            $conn = $db->getConn();

            $sql = "SELECT * FROM theloai ORDER BY ma_tloai DESC";
            if(!$conn) return null;
            $stmt = $conn->query($sql);

            $categories = [];
            while ($row = $stmt->fetch()){
                $category = new Category($row['ma_tloai'], $row['ten_tloai']);
                $categories[] = $category;
            }
            return $categories;
        }
    }