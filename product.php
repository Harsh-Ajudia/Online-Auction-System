<?php
ob_start();
$page="User_Profile";
include_once('header.php');
error_reporting(0);
?>
<?php
include_once 'admin/includes/db_connect.php';
if(isset($_POST['bid_change_submit'])){
		$bidValue = $_POST['bid_Value'];
		$currValue = $_POST['curr_Price'];
		if($bidValue <= $currValue){
			$message = 'Bid value must be greater than the past value &#8377; '.$currValue;
		}
		else{
			
		$dateBidded = $_POST['dateBidded'];
		$buyerEmail = addslashes($_SESSION['emailloggedin']);
		$buyerId = $_SESSION['idloggedin'];
		$productId = $_POST['product_bid_id'];
		$userName = $_SESSION['nameloggedin'];
		
		$look_for_existing="SELECT * FROM bidders WHERE prod_Id = '$productId' AND userId = '$buyerId'";
		$view_existing = mysqli_query($mysqli, $look_for_existing) or die("Some error has been occured! Please Search again...".mysqli_error($mysqli));		
		$got_product_existing = mysqli_fetch_assoc($view_existing);
		
		$bID = $got_product_existing['bidderId'];
		
		if(($got_product_existing['userId'] == $buyerId) && ($got_product_existing['prod_Id'] == $productId))
		{
			$query_bid_insert="UPDATE bidders SET Amount = '$bidValue', userName = '$userName', bidder_Email = '$buyerEmail', date_bidded = '$dateBidded' WHERE bidderId = '$bID' AND userId = '$buyerId' AND prod_ID = '$productId'";
			
			$query_bid_result = mysqli_query($mysqli,$query_bid_insert) or die("Error updating bid on your product. Please try again.".mysqli_error($mysqli));
			$message = 'Your Bid of &#8377; '.$bidValue.' has successfully been updated! Stay Tuned';
		}
		else{
			$query_bid_insert="INSERT INTO bidders (Amount, userId, bidder_Email, date_bidded, prod_Id, userName) VALUES('$bidValue', '$buyerId', '$buyerEmail', '$dateBidded', '$productId', '$userName')";
			$query_bid_result = mysqli_query($mysqli,$query_bid_insert) or die("Error bidding on your product. Please try again.".mysqli_error($mysqli));
			$message = 'Your Bid of &#8377; '.$bidValue.' has successfully been placed! Stay Tuned';
		}
		
		$query_bid_insert_another="UPDATE product SET current_Price = '$bidValue', final_Price = '$bidValue' WHERE product_Id = '$productId'";
		$query_bid_result_another = mysqli_query($mysqli,$query_bid_insert_another) or die("Error updating bid on your product. Please try again.".mysqli_error($mysqli));
		
		$query_bid_update_winner="UPDATE product SET winnder = '$buyerEmail' WHERE product_Id = '$productId'";
		$query_bid_result_winner = mysqli_query($mysqli,$query_bid_update_winner) or die("Error updating bid on your product. Please try again.".mysqli_error($mysqli));
		
		}
	}
if(((isset($_SESSION['product_Query_Pag'])) || (isset($_POST['product_Query_Page']))) ){
	if(isset($_POST['product_Query_Page'])){
		$_SESSION['product_Query_Pag'] = $_POST['product_Query_Page'];
	}
	else{
		$_SESSION['product_Query_Pag'] = $_SESSION['product_Query_Pag'];
	}
	//$email_id = $_SESSION['emailloggedin'];
	$product_Id = $_SESSION['product_Query_Pag'];
	$look_for_product_page="SELECT * FROM product WHERE product_Id='$product_Id'";
	$view_product_page = mysqli_query($mysqli,$look_for_product_page) or die("Some error has been occured! Please search again .".mysqli_error($mysqli));
	$got_product_page = mysqli_fetch_assoc($view_product_page);
	
	
?>
<div class="container-fluid pt-3 mb-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Search</li>
		</ol>
	</nav>
	<script src="js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<?php
		if(isset($message)){ echo '<div class="alert alert-primary" role="alert">
		  <strong>Note: </strong>
			' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button></div>'; }
		?>
	<div class="row">
		<div class="col-md-4 bg-light p-3">
			<img class="img-fluid rounded" alt="" src="<?php echo $got_product_page['image1'];?>"/>
			<?php echo '<h3 class="font-weight-light text-center mt-2 text-info">'.$got_product_page['name'].'</h3>';?><hr/>
			<div id="pricetag" class="container">
			</div>
			<script type="text/javascript">
			$(document).ready(function() {
				setInterval(function () {
					$('#pricetag').load('price.php')
				}, 100);
			});
			</script>
			<div class="">
				<div class="bg-light p-3">
					<div class="">
					<div class="alert alert-success" role="alert">
					<?php
					if($got_product_page['is_Auction_Over']==1){
						echo '
						<h5 class="text-success font-weight-regular text-center">Winner: </h5><p class="text-dark">'.$got_product_page['winnder'].'</p>
					';
					}
					else{
						echo 'Winner is yet to be declared. For now you can bid on the product if you want.';
					}
					?>
					</div>
					<hr/>
						<h4 class="font-weight-light text-center">Bid Now!</h4>
					</div>
					<div class="alert alert-info" role="alert">
						<form method="POST" action="">
							<input type="number" class="form-control" name="bid_Value" onkeypress='validate(event)' placeholder="Enter Amount higher than current price" <?php if(($got_product_page['is_Auction_Over']==1) || ($_SESSION['isloggedin']==0)){echo 'disabled';}?> />
							
							<div class="text-center">
								<input type="hidden" name="curr_Price" value="<?php echo $got_product_page['current_Price']?>"/>
								<input type="hidden" name="product_bid_id" value="<?php echo $got_product_page['product_Id']?>"/>
								<input type="hidden" name="dateBidded" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
								<button type="submit" name="bid_change_submit" class="mt-2 text-center btn btn-primary" <?php if(($got_product_page['is_Auction_Over']==1) || ($got_product_page['is_verified'] == 0) || ($_SESSION['isloggedin'] == 0)){echo 'disabled';}?>>Bid Now!</button>
							</div>
						</form>
					<div class="mt-3 alert alert-light">
						<?php
							if($_SESSION['isloggedin']==1){
								echo '<p class="font-weight-regular text-success">Note: <span class="font-weight-light text-dark">Bidding of only higher amount than current bid is allowed!</span></p>';
								if($got_product_page['is_Auction_Over'] == 1){
									echo'<p class="font-weight-regular text-info">Note: <span class="font-weight-light text-dark">Sorry, but this Auction is already over. Better luck next time.</span></p>';
								}
							}
							else{
								echo '<p><span class="font-weight-regular text-danger">Note: </span><span class="font-weight-light text-dark">You need to have an account to bid on this product
								
								</span></p>';
							}
						?>
						
					</div>
					</div>
					
				</div>
			</div>
			<div id="showthis"></div>
			
			<script type="text/javascript">
			$(document).ready(function() {
				setInterval(function () {
					$('#showthis').load('bidderslist.php')
				}, 100);
			});
			</script>
			
			<?php //include('bidderslist.php')?>
		</div>
		<div class="col-md-8">
			<div class=" p-4 bg-light">
				<div class="" id="product_description">
					<h4 class="font-weight-regular">Product Description:</h4>
					<h6 class="font-weight-light"><?php echo $got_product_page['description']?></h6>
				</div>
				<div class="mt-3" id="product_">
					<div class="bg-light p-3">
					<h4 class="font-weight-regular">Auction status: 
					<?php if($got_product_page['is_Auction_Over']==0){echo '<span class="font-weight-light text-success">Ongoing!';}else{echo'<span class="font-weight-light text-danger">Auction ended!';}?></span></h4>
				
				</div>
				</div>
				<div class="mt-3" id="remaining_time">
				<div class="bg-light p-3">
					<h4 class="font-weight-regular">Remaining Time left! </h4>
					<h6 class="font-weight-light"><?php
						if($got_product_page['is_Auction_Over']==0){
							$now = new DateTime();
							$future_date = $got_product_page['date_End'];
							$future_date = new DateTime(''.$future_date.'');
							$interval = $future_date->diff($now);
							echo $interval->format("%a days, %h hours, %i minutes, %s seconds");
						}
						else{
							echo '0 days, 0 hours, 0 minutes, 0seconds left';
						}
					?></h6>
				</div>
				</div>
				
			</div>
		</div>
		
	</div>
	<div class="mt-3 mb-3 container-fluid">
		<div class="row">
			
			
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