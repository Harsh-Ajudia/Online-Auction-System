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
	$email_id = $_SESSION['emailloggedin'];
	$look_for_products="SELECT * FROM product WHERE seller='$email_id'";
	$view_products = mysqli_query($mysqli,$look_for_products) or die("Some error has been occured! .".mysqli_error($mysqli));
	
	if(isset($_POST['delete'])){
		$vr1 = $_POST['id'];
		
		$delete="DELETE FROM product WHERE product_Id='$vr1'";
		$delete_product = mysqli_query($mysqli,$delete) or die("Cannot delete this Product.".mysqli_error($mysqli));	
		
		$message = "Successfully deleted the product!";		
	}
?>
<div class="container p-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item active" aria-current="page">Your Products</li>
	  </ol>
	</nav>
	<h3 class="text-center">Add Product</h3>
	<p class="text-center">Your Products for auction will appear here</p>
	<?php
		if(isset($message)){ echo '<div class="alert alert-danger" role="alert">
				  <strong>Note: </strong>
					' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>'; }
	?>
	<div class="p-2 text-center">
		<a class="btn btn-outline-primary" href="add_Product.php" role="button"><i class="fas fa-plus-circle fa-2x"></i><br/>Add Product</a>
	</div>
	<h2 class="font-weight-normal text-success">Auctions that are Open!</h2>
	<div class="row">
		<?php 
			$counter = 1;
			while($got_products = mysqli_fetch_assoc($view_products)){
			if($got_products['is_Auction_Over']==0){
			
		?>
			<div class="col-md-4">
				<div class="p-3 border mb-5 rounded">
					<div id="card_recent_more">
						<img src="<?php echo $got_products['image1'];?>" class="img-fluid rounded"/>
					</div>
					<h6>Name: <span class="font-weight-normal text-dark"><?php echo $got_products['name']?></span></h6>
					<h6>Currently listed: <span class="font-weight-normal text-dark">Yes</span></h6>
					<h6>Initial price: &#8377; <span class="font-weight-normal text-dark"><?php echo number_format($got_products['initial_Price'])?></span></h6>
					<h6>Current price: &#8377; <span class="font-weight-normal text-dark"><?php echo number_format($got_products['current_Price'])?></span></h6>	
					
					<div class="row">
						
						<form method="POST">
							<div class="col-md-3">
								<button name="delete" class="btn btn-outline-danger simple_link">Delete</button>
								<input type="hidden" name="id" value="<?php echo $got_products['product_Id'];?>"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php	
			$counter++;
			}
			}
			
			//mysqli_free_result($got_products);
		?>
	</div>
	<hr/>
		<h2 class="font-weight-normal text-danger">Auctions that has been over</h2>
		<div class="row">
			<?php 
				$email_id = $_SESSION['emailloggedin'];
				$look_for_productss="SELECT * FROM product WHERE seller='$email_id'";
				$view_productss = mysqli_query($mysqli,$look_for_productss) or die("Some error has been occured! .".mysqli_error($mysqli));
				$countertwo = 1;
				
				while($got_productss = mysqli_fetch_assoc($view_productss)){
				if($got_productss['is_Auction_Over']==1){
				
			?>
				<div class="col-md-4">
					<div class="p-3 border mb-5 rounded">
						<div class="view_product_image">
							<img src="<?php echo $got_productss['image1'];?>" class="view_product_image rounded"/>
						</div>
						<h6>Name: <span class="font-weight-normal text-dark"><?php echo $got_productss['name']?></span></h6>
						<h6>Currently listed: <span class="font-weight-normal text-dark">No</span></h6>
						<h6>Initial price: &#8377; <span class="font-weight-normal text-dark"><?php echo number_format($got_productss['initial_Price'])?></span></h6>
						<h6>Current price: &#8377; <span class="font-weight-normal text-dark"><?php echo number_format($got_productss['current_Price'])?></span></h6>
						<?php
							if($got_productss['is_Auction_Over']==1){
								?><h6>Final price: <span class="font-weight-normal text-dark"><?php echo $got_productss['final_Price'];?></span></h6>
								<?php
							}
						?>
						
					</div>
				</div>
			<?php	
				$countertwo++;
				}
				}
				//mysqli_free_result($got_products);
			?>
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