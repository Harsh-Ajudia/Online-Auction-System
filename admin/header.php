<?php
/*Header page*/
session_start();
$page = 'header';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" crossorigin="anonymous">
	<link href="../css/custom.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="../web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">
    <title>Auction</title>
  </head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		   <a class="navbar-brand" href="index.php">
			<img src="../img/blank/blue.png" width="30" height="30" class="d-inline-block align-top" alt="">
			Auction
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <?php
			if(isset($_SESSION['adminloggedin'])){
			echo '
		  <div class="collapse navbar-collapse" id="navbarNav">
			 <ul class="navbar-nav mr-auto">
            </ul>
			<ul class="navbar-nav">
			  <li class="nav-item active">
				<a class="nav-link" href="#"><i class="fas fa-user mr-sm-2 fa-lg"></i>'.$_SESSION['adminloggedin'].' <span class="sr-only">(current)</span></a>
			  </li>
			  
			  
			  <div class="btn-group mb-1">
				  <span class="text-white btn"><i class="fas fa-edit mr-sm-2 fa-lg"></i>Edit</span>
				  <button type="button" class="text-white btn btn-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <div class="dropdown-menu dropdown-menu-right text-center">
					<a class="nav-link text-dark" href="pages.php">Carousel Page</a>
					
				  </div>
				</div>
			 
			  <li class="nav-item active">
				<a class="nav-link" href="includes/logout.php"><i class="fas fa-sign-out-alt mr-sm-2 fa-lg"></i>Logout</a>
			  </li>
			</ul>
		  </div>
			';}
		  ?>
		</nav>
		