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
	$ethis = $_SESSION['emailloggedin'];
	$look_cart="SELECT * FROM product WHERE winnder = '$ethis' AND winner = 1 AND is_Auction_Over = 1";
	$view_cart = mysqli_query($mysqli, $look_cart) or die("Some error has been occured! Please try again...".mysqli_error($mysqli));
	$countcart = mysqli_num_rows($view_cart);
?>
<div class="container p-3">
	<h4 class="text-center mb-5">Add Product</h4>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item active" aria-current="page">Cart</li>
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
		<?php if($countcart==0){
			echo 'Nothing found!';
		}
		else{
			
	$cartCounter = 1;
	while($got_cart = mysqli_fetch_assoc($view_cart)){?>
		<div class="row rounded border p-2 mt-3">
			<div class="col-md-1">
			<?php echo $cartCounter;?>
			</div>
			<div class="col-md-2">
			<span class="text-primary">Name: <br/></span><?php echo $got_cart['name']?>
			</div>
			<div class="col-md-2">
				<img class="img-fluid" src="<?php echo $got_cart['image1']?>"/>
			</div>
			<div class="col-md-4">
				<span class="text-primary">Seller: <br/></span><?php echo $got_cart['seller']?><br/>
				<span class="text-primary">Price: </span><span class="text-success">&#8377; <?php echo number_format($got_cart['final_Price'])?></span>
			</div>
			<div class="col-md-3 text-right">
				<button class="mt-4 btn btn-primary"><i class="fas fa-credit-card mr-sm-2 fa-lg"></i>Pay</button>
				<button class="mt-4 btn btn-danger"><i class="fas fa-exclamation-triangle mr-sm-2 fa-lg"></i>Let go</button>
			</div>

		</div>
	<?php
	$cartCounter = $cartCounter+1; 
	}
		}
		?>
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