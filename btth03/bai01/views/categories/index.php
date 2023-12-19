<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center text-primary text-uppercase mt-3 mb-5">Categories Table</h1>
<a href="?controller=category&action=create" class="btn btn-primary">Thêm mới</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) {
        ?>
            <tr>
                <th scope="col"><?= $category->getId(); ?></th>
                <td><?= $category->getName(); ?></td>
                <td>
                    <a href='?controller=category&action=edit&id=<?= $category->getId(); ?>'><i class='bi bi-pencil-square'></i></a> |
                    <a href='?controller=category&action=delete&id=<?= $category->getId(); ?>'><i class='bi bi-trash3'></i></a>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>
</body>
</html> 