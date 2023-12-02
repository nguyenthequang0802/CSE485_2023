<?php 
require_once(__DIR__ . '/../../Config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $articleName = $_POST['tieude']; // thay đổi tên cột
    $categoryId = $_POST['ma_tloai']; // thay đổi tên cột
    $authorId = $_POST['ma_tgia']; // thay đổi tên cột
    $summary = $_POST['tomtat']; // thay đổi tên cột
    $content = $_POST['noidung']; // thay đổi tên cột

    // Thực hiện truy vấn để thêm bài viết mới
    $sql = "INSERT INTO baiviet (tieude, ma_tloai, ma_tgia, tomtat, noidung) 
            VALUES ('$articleName', $categoryId, $authorId, '$summary', '$content')";
    
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang article.php
        header("Location: article.php");
        exit(); // Đảm bảo không có mã PHP nào thực thi sau khi chuyển hướng
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h2>Thêm mới bài viết</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="tieude" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" id="tieude" name="tieude" required>
                </div>
                <div class="mb-3">
                    <label for="ma_tloai" class="form-label">Thể loại</label>
                    <!-- Dropdown để chọn thể loại -->
                    <select class="form-control" id="ma_tloai" name="ma_tloai" required>
                        <?php
                        // Truy vấn để lấy danh sách thể loại
                        $categoryQuery = "SELECT ma_tloai, ten_tloai FROM theloai"; // Thay đổi tên bảng và tên cột
                        $categoryResult = $conn->query($categoryQuery);

                        while ($category = $categoryResult->fetch_assoc()) {
                            echo "<option value='" . $category['ma_tloai'] . "'>" . $category['ten_tloai'] . "</option>"; // Thay đổi tên cột
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
                        $authorQuery = "SELECT ma_tgia, ten_tgia FROM tacgia"; // Thay đổi tên bảng và tên cột
                        $authorResult = $conn->query($authorQuery);

                        while ($author = $authorResult->fetch_assoc()) {
                            echo "<option value='" . $author['ma_tgia'] . "'>" . $author['ten_tgia'] . "</option>"; // Thay đổi tên cột
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tomtat" class="form-label">Tóm tắt</label>
                    <textarea class="form-control" id="tomtat" name="tomtat" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="noidung" class="form-label">Nội dung</label>
                    <textarea class="form-control" id="noidung" name="noidung" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>