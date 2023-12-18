<?php
require_once '../bai01/libs/Database.php';
require_once  '../bai01/models/Post.php';
class PostService{
    public static function getAll() {
        $db  = new Database();
        $conn = $db->getConn();

        $sql = "SELECT * FROM cms_posts ORDER BY updated DESC ";
        if (!$conn) return null;
        $stmt = $conn->query($sql);

        $posts = [];
        while ($row = $stmt->fetch()){
            $post = new Post($row['id'], $row['title'], $row['message'], $row['category_id'], $row['user_id'], $row['status'], $row['created'], $row['updated'],);
            $posts[] = $post;
        }
        return $posts;
    }

    public static function getById($id){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "SELECT * FROM cms_posts WHERE id = :id";
        if (!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post = new Post($row['id'], $row['title'], $row['message'], $row['category_id'], $row['user_id'], $row['status'], $row['created'], $row['updated'],);
        return $post;
    }

    public static function create($title, $message, $category_id, $user_id, $status){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "Insert into  cms_posts(title, message, category_id, user_id, status, created, updated) 
                VALUES (:title, :message, :category_id, :user_id, :status, NOW(),NOW())";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $result = $stmt->execute();
        if($result){
            $id = $conn->lastInsertId();
            return self::getById($id);
        }
        return null;
    }

    public static function update($id, $title, $message, $category_id, $user_id, $status){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "Update cms_posts Set title = :title, message = :message, category_id = :category_id, user_id = :user_id, status = :status, updated = NOW() WHERE id = :id";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
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

        $sql = "DELETE FROM cms_posts WHERE id = :id";
        if (!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
