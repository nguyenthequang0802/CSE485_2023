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

        public static function getById($ma_tloai){
            $db = new Database();
            $conn = $db->getConn();

            $sql = "SELECT * FROM theloai WHERE ma_tloai = :ma_tloai";
            if(!$conn) return null;
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ma_tloai', $ma_tloai);
            $stmt->execute();

            $row = $stmt->fetch();
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            return $category;
        }

        public static function create($ten_tloai){
            $db = new Database();
            $conn = $db->getConn();

            $sql = "INSERT INTO theloai (ten_tloai) VALUES (:ten_tloai)";
            if(!$conn) return null;
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ten_tloai', $ten_tloai);
            $result = $stmt->execute();
            if ($result){
                $ma_tloai = $conn->lastInsertId();
                return self::getById($ma_tloai);
            }
            return null;
        }

        public static function update($ma_tloai, $ten_tloai){
            $db = new Database();
            $conn = $db->getConn();

            $sql = 'UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai';
            if (!$conn) return null;
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ten_tloai', $ten_tloai);
            $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result){
                $ma_tloai = $conn->lastInsertId();
                return self::getById($ma_tloai);
            }
            return null;
        }

        public static function delete($ma_tloai){
            $db = new Database();
            $conn = $db->getConn();

            $sql = 'DELETE FROM theloai WHERE ma_tloai = :ma_tloai';
            if(!$conn) return null;
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ma_tloai', $ma_tloai);
            return $stmt->execute();
        }
    }