<?php
require_once '../Libs/Database.php';
require_once '../Models/Author.php';

class AuthorService{
    public static function getAll(){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "SELECT * FROM tacgia ORDER BY ma_tgia DESC";
        if(!$conn) return null;
        $stmt = $conn->query($sql);

        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'], $row['ten_tgia']);
            $authors[] = $author;
        }
        return $authors;
    }

    public static function getById($ma_tgia){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "SELECT * FROM tacgia WHERE ma_tgia = :ma_tgia";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $ma_tgia);
        $stmt->execute();

        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'], $row['ten_tgia']);
        return $author;
    }

    public static function create($ten_tgia){
        $db = new Database();
        $conn = $db->getConn();

        $sql = "INSERT INTO tacgia (ten_tgia) VALUES (:ten_tgia)";
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tgia', $ten_tgia);
        $result = $stmt->execute();
        if ($result){
            $ma_tgia = $conn->lastInsertId();
            return self::getById($ma_tgia);
        }
        return null;
    }
    public static function update($ma_tgia, $ten_tgia) {
        $db = new Database();
        $conn = $db->getConn();

        $sql = 'UPDATE tacgia SET ten_tgia = :ten_tgia WHERE ma_tgia = :ma_tgia';
        if(!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tgia', $ten_tgia);
        $stmt->bindParam('ma_tgia', $ma_tgia);
        $result = $stmt->execute();
        if($result){
            $ma_tgia = $conn->lastInsertId();
            return self::getById($ma_tgia);
        }
        return null;
    }

    public static function delete($ma_tgia) {
        $db = new Database();
        $conn = $db->getConn();

        $sql = 'DELETE FROM tacgia WHERE ma_tgia = :ma_tgia';
        if (!$conn) return null;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $ma_tgia);
        return $stmt->execute();
    }
}