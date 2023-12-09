<?php
require_once __DIR__ . '/../../Config/config.php';

// Kiểm tra xem có tham số 'id' được chuyển qua không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Lấy giá trị của tham số 'id'
    $articleId = $_GET['id'];

    // Xây dựng truy vấn xóa bài viết từ bảng 'baiviet'
    $deleteQuery = "DELETE FROM baiviet WHERE ma_bviet = $articleId";

    // Thực hiện truy vấn xóa
    if ($conn->query($deleteQuery) === TRUE) {
        // Nếu xóa thành công, chuyển hướng về trang article.php
        header("Location: article.php");
        exit();
    } else {
        // Nếu có lỗi, hiển thị thông báo lỗi
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Nếu không có tham số 'id', hiển thị thông báo lỗi
    echo "Invalid article ID";
}
?>
