<?php
// login_process.php

include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sử dụng prepared statement để tránh SQL injection
    $sql = "SELECT * FROM login WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Thực hiện truy vấn
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->get_result();

    // Kiểm tra kết quả truy vấn
    // if ($result->num_rows > 0) {
    //     echo "Đăng nhập thành công!";
    // } else {
    //     echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    // }

    // Đóng prepared statement
    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>
