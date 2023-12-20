<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center text-primary text-uppercase mt-3 mb-5"><?= isset($category) ? 'Edit Category' : 'Add Category'; ?></h1>
<form action="<?= isset($category) ? "?controller=category&action=update&id={$category->getId()}" : "?controller=category&action=store"; ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" required id="name" name="name" value="<?= isset($category) ? $category->getName() : ''; ?>">
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($category) ? 'Update' : 'Create'; ?></button>
    <a href="?controller=category" class="btn btn-primary">Go Back</a>
</form>
</body>
</html>
