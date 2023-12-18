<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center text-primary text-uppercase mt-3 mb-5">Add Post</h1>
<form action="?controller=post&action=update&id=<?= $post->getId(); ?>" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" required id="title" name="title" value="<?= $post->getTitle(); ?>">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Title</label>
        <input type="text" class="form-control" required id="message" name="message" value="<?= $post->getMessage(); ?>">
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category_id</label>
        <input type="text" class="form-control" required id="category_id" name="category_id" value="<?= $post->getCategoryId(); ?>">
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">User_id</label>
        <input type="text" class="form-control" required id="user_id" name="user_id" value="<?= $post->getUserId(); ?>">
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" aria-label="Default select example" name="status">
            <option value="1">published</option>
            <option value="2">draft</option>
            <option value="3">archived</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Tạo</button>
    <a href="?controller=post" class="btn btn-primary" >Quay lại</a>
</form>
</body>
</html>
