<?php
// db_connection.php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "logindata";

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
?>
