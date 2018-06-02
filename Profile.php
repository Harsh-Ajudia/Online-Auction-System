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
<div class="container mb-5">
	<div class="container-fluid pt-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item">Your Account</li>
	  </ol>
	</nav>
	<h3 class="mt-4">Your Account</h3>
	<p><?php echo $_SESSION["emailloggedin"]?></p>
		<div class="text-center row">
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-gavel fa-lg mr-2 mt-4"></i><span class="text-info">Your Bids</span></h4>
					<li class="list-unstyled simple_link"><a href="Your_Bids.php" class="text-dark">View your bids</a></li>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-lock fa-lg mr-2 mt-4"></i><span class="text-info">Login & Security</span></h4>
					<li class="list-unstyled simple_link"><a href="change_details.php" class="text-dark">Change Password, Email, Phone</a></li>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-map-marker-alt fa-lg mr-2 mt-4"></i><span class="text-info">Your Addresses</span></h4>
					<li class="list-unstyled simple_link"><a href="addresses.php" class="text-dark">View your Addresses</a></li>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-gift fa-lg mr-2 mt-4"></i><span class="text-info">Sell the product</span></h4>
					<li class="list-unstyled simple_link"><a href="sell_product.php" class="text-dark">Click here to start</a></li>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-shopping-cart fa-lg mr-2 mt-4"></i><span class="text-info">Cart</span></h4>
					<li class="list-unstyled simple_link"><a href="Cart.php" class="text-dark">Click here to view your cart</a></li>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-2 mt-4 border rounded boxprofile">
					<h4><i class="fas fa-credit-card fa-lg mr-2 mt-4"></i><span class="text-info">Payment Method</span></h4>
					<li class="list-unstyled simple_link"><a href="Payment_method.php" class="text-dark">Click here to add payment method</a></li>
				</div>
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