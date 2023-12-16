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


include('layouts/header.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/users.js"></script>	
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
					<div class="panel-heading"style="background-color:  #095f59;>
						<h3 class="panel-title">Latest Users</h3>
					</div>
					<div class="panel-body">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-10">
									<h3 class="panel-title"></h3>
								</div>
								<div class="col-md-2" align="right">
									<a href="add_users.php" class="btn btn-default btn-xs">Add New</a>				
								</div>
							</div>
						</div>
						<table id="userList" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>									
									<th>Email</th>
									<th>Type</th>	
									<th>Status</th>																				
									<th></th>
									<th></th>	
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


 <?php include('layouts/footer.php');?>
