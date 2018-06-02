<?php
ob_start();
$page="User_Profile";
include_once('header.php');
//error_reporting(0);
?>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="card/j/jquery.creditCardValidator.js"></script>
<?php
include_once 'admin/includes/db_connect.php';
if($_SESSION['isloggedin']==1){
?>
<?php
	
?>

<div class="container p-3">
	<h4 class="text-center mb-5">Add Product</h4>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item"><a href="Payment_method.php">Payment Method</a></li>
		<li class="breadcrumb-item active" aria-current="page">New Payment Mode</li>
	  </ol>
	</nav>
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-8">
		<?php
			if(isset($message)){ echo '<div class="alert alert-success" role="alert">
			  <strong>Note: </strong>
				' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button></div>'; }
			?>
			
		</div>
	</div>
	<div class="container">
		
	</div>
</div>
<?php
} 
else{
	header('Location: index.php');
}
?>
<?php

include_once('footer.php');
?>