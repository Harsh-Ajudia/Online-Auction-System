<?php
ob_start();
$page="User_Profile";
include_once('header.php');
//error_reporting(0);
?>
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
		<li class="breadcrumb-item active" aria-current="page">Payment Method</li>
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
	
	<div class="p-2 text-center">
		<a class="btn btn-outline-primary" href="add_Method.php" role="button"><i class="fas fa-plus-circle fa-2x"></i><br/>Add new <br/>Payment method</a>
	</div>
	
		<div class="row rounded border p-2">
			<div class="col-md-4">
			f
			</div>
			<div class="col-md-4">
			f
			</div>
			<div class="col-md-4">
			f
			</div>
		</div>
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