<?php

include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Post.php';
include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);

if(!$user->loggedIn()) {
    header("location: index.php");
}

$post = new Post($db);

$categories = $post->getCategories();

$post->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$saveMessage = '';
if(!empty($_POST["savePost"]) && $_POST["title"]!=''&& $_POST["message"]!='') {

    $post->title = $_POST["title"];
    $post->message = $_POST["message"];
    $post->category = $_POST["category"];
    $post->status = $_POST["status"];
    if($post->id) {
        $post->updated = date('Y-m-d H:i:s');
        if($post->update()) {
            $saveMessage = "Post updated successfully!";
        }
    } else {
        $post->userid = $_SESSION["userid"];
        $post->created = date('Y-m-d H:i:s');
        $post->updated = date('Y-m-d H:i:s');
        $lastInserId = $post->insert();
        if($lastInserId) {
            $post->id = $lastInserId;
            $saveMessage = "Post saved successfully!";
        }
    }
}

$postdetails = $post->getPost();

include('layouts/header.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/posts.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" >
</head>
<body>
<?php include "menu.php"; ?>
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
            </div>
            <br>
        </div>
    </div>
</header>
<br>
<section id="main">
    <div class="container">
        <div class="row">
            <?php include "left_menu.php"; ?>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Post</h3>
                    </div>
                    <div class="panel-body">

                        <form method="post" id="postForm">
                            <?php if ($saveMessage != '') { ?>
                                <div id="login-alert" class="alert alert-success col-sm-12"><?php echo $saveMessage; ?></div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $postdetails['title']; ?>" placeholder="Post title..">
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="control-label">Message</label>
                                <textarea class="form-control" rows="5" id="message" name="message" placeholder="Post message.."><?php echo $postdetails['message']; ?></textarea>
                            </div>


                            <div class="form-group">
                                <label for="sel1">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <?php
                                    while ($category = $categories->fetch_assoc()) {
                                        $selected = '';
                                        if($category['name'] ==$postdetails['name']) {
                                            $selected = 'selected=selected';
                                        }
                                        echo "<option value='".$category['id']."' $selected>".$category['name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status" class="control-label"></label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="publish" value="published" <?php if($postdetails['status'] == 'published') { echo "checked";} ?>>Publish
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="draft" value="draft" <?php if($postdetails['status'] == 'draft') { echo "checked";} ?>>Draft
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="archived" value="archived" <?php if($postdetails['status'] == 'archived') { echo "checked";} ?>>Archive
                                </label>
                            </div>
                            <input type="submit" name="savePost" id="savePost" class="btn btn-info" value="Save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('layouts/footer.php');?>