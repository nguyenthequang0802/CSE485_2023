<?php
include '../layouts/header.php';
require_once __DIR__ . '/../../Config/config.php';

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Truy vấn để lấy thông tin bài viết cần sửa
    $sql = "SELECT * FROM baiviet WHERE ma_bviet = $articleId"; // Thay đổi tên bảng và tên cột
    $result = $conn->query($sql);

    // Kiểm tra kết quả truy vấn
    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Xử lý dữ liệu và hiển thị form sửa bài viết
        $articleName = $row['tieude']; // Thay đổi tên cột
        $categoryId = $row['ma_tloai']; // Thay đổi tên cột
        $authorId = $row['ma_tgia']; // Thay đổi tên cột
        $summary = $row['tomtat']; // Thay đổi tên cột
        $content = $row['noidung']; // Thay đổi tên cột

        // Kiểm tra xem form đã được gửi hay chưa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $newArticleTitle = $_POST['tieude'];
            $newCategoryId = $_POST['ma_tloai'];
            $newAuthorId = $_POST['ma_tgia'];
            $newSummary = $_POST['tomtat'];
            $newContent = $_POST['noidung'];

            // Thực hiện truy vấn để cập nhật thông tin bài viết
            $updateSql = "UPDATE baiviet SET
                tieude = '$newArticleName',
                ten_bhat = '$newAuthorName',
                ma_tloai = $newCategoryId,
                tomtat = '$newSummary',
                noidung = '$newContent',
                ma_tgia = $newAuthorId
                WHERE ma_bviet = $articleId";

            if ($conn->query($updateSql) === true) {
                // Chuyển hướng về trang article.php sau khi cập nhật thành công
                header("Location: article.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Không tìm thấy bài viết.";
    }
} else {
    echo "Thiếu tham số ID.";
}

?>
    <header>
       <?php include '../layouts/topNav_admin.php'?>
    </header>
    <main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h2>Sửa bài viết</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="tieude" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="tieude" name="tieude" value="<?php echo $articleName; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ma_tloai" class="form-label">Thể loại</label>
                    <!-- Dropdown để chọn thể loại -->
                    <select class="form-control" id="ma_tloai" name="ma_tloai" required>
                        <?php
                        // Truy vấn để lấy danh sách thể loại
                        $categoryQuery = "SELECT ma_tloai, ten_tloai FROM theloai";
                        $categoryResult = $conn->query($categoryQuery);

                        while ($category = $categoryResult->fetch_assoc()) {
                            $selected = ($category['ma_tloai'] == $categoryId) ? 'selected' : '';
                            echo "<option value='" . $category['ma_tloai'] . "' $selected>" . $category['ten_tloai'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ma_tgia" class="form-label">Tác giả</label>
                    <!-- Dropdown để chọn tác giả -->
                    <select class="form-control" id="ma_tgia" name="ma_tgia" required>
                        <?php
                        // Truy vấn để lấy danh sách tác giả
                        $authorQuery = "SELECT ma_tgia, ten_tgia FROM tacgia";
                        $authorResult = $conn->query($authorQuery);

                        while ($author = $authorResult->fetch_assoc()) {
                            $selected = ($author['ma_tgia'] == $authorId) ? 'selected' : '';
                            echo "<option value='" . $author['ma_tgia'] . "' $selected>" . $author['ten_tgia'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tomtat" class="form-label">Tóm tắt</label>
                    <textarea class="form-control" id="tomtat" name="tomtat" rows="3" required><?php echo $summary; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="noidung" class="form-label">Nội dung</label>
                    <textarea class="form-control" id="noidung" name="noidung" rows="6" required><?php echo $content; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div>
    </div>
</main>

<?php include '../layouts/footer.php'?>