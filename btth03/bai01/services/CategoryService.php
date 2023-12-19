<?php
require_once '../bai01/libs/Database.php';
require_once '../bai01/models/Category.php';

class CategoryService
{
    public static function getALL()
    {
        $db = new Database();
        $conn = $db->getConn();

        $sql = 'Select * from categories ORDER BY id DESC';
        if(!$conn) return null;
        $stmt = $conn->query($sql);

        $categories = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['id'], $row['name']);
            $categories[] = $category;
        }
        return $categories;
    }

    public static function getById($id){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "SELECT * FROM cms_categories WHERE id = :id";
        if (!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $category = new Category($row['id'], $row['name']);
        return $category;
    }

    public static function create($name){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "INSERT INTO cms_categories(name) VALUES (:name)";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $result = $stmt->execute();
        if($result){
            $id = $conn->lastInsertId();
            return self::getById($id);
        }
        return null;
    }

    public static function update($id, $name){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "UPDATE cms_categories SET name = :name WHERE id = :id";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if($result){
            $id = $conn->lastInsertId();
            return self::getById($id);
        }
        return null;
    }

    public static function delete($id){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "DELETE FROM cms_categories WHERE id = :id";
        if (!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}