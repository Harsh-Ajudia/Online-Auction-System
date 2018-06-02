<?php
/*Home page*/
$page='home';
$varInc = 4;
include_once('header.php');
include_once('admin/includes/db_connect.php');

	$check_for_carousel_data = "SELECT * FROM carousel";
	$checked_carousel_data = mysqli_query($mysqli,$check_for_carousel_data) or die("Some error has been occured! .".mysqli_error($mysqli));
	
	
?>
<div class="">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<?php 
			$cou = 1;
			while($got_carousel_data = mysqli_fetch_assoc($checked_carousel_data)){?>
				<div class="carousel-item <?php if($cou == 1){echo 'active';}?>">
					<img class="d-block w-100" src="<?php echo $got_carousel_data['image3']?>" alt="First slide">
					  <div class="carousel-caption d-none d-md-block">
						<!--h5>Product link</h5>
						<h4 class="text-dark"><?php echo $got_carousel_data['description']?></h4-->
					  </div>
				</div>
			<?php
			$cou = $cou+1;
			}
			//mysqli_free_result($got_carousel_data);
			?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	
	<div class="row mt-1 mb-1">
	<div class="col-md-12 border text-center">
		<div class="card-group p-4">
		
		  <?php 
		  
		  if(isset($_POST['loadMore'])){
			  $varInc = $varInc + 4;
		  }
		  
		  $check_for_trending = "SELECT * FROM product WHERE is_verified = 0 or 1 AND is_Auction_Over = 0 ORDER BY date_Added DESC LIMIT $varInc";
		  $checked_trending = mysqli_query($mysqli,$check_for_trending) or die("Some error has been occured! .".mysqli_error($mysqli));
		  
		  while($got_approved = mysqli_fetch_assoc($checked_trending)){	
			  ?>
		  <div class="col-md-3 mt-5">
			<div class="card m-2">
			<div id="tile_card">
				<img class="img-fluid" src="<?php echo $got_approved['image1']?>" alt="Card image cap">
			</div>
			<div class="card-body">
			  <h5 class="card-title "><?php echo $got_approved['name'];?></h5>
			  <p class="card-text text-primary">Started &#8377; <?php echo number_format($got_approved['initial_Price']);?></p>
			  <p class="card-text text-success">Current &#8377; <?php echo number_format($got_approved['current_Price']);?></p>
			</div>
			<div class="card-footer">
			<form method="POST" name="recenteeee" action="product.php">
			<input type="hidden" name="product_Query_Page" value="<?php echo $got_approved['product_Id']?>"/>
			  <button type="submit" class="btn btn-outline-primary">View deal</button>
			 </form>
			</div>
		  </div>
		  </div>
		  <?php
		  }
		  ?>
		
		</div>
	</div>
</div>
<form action="" method="POST" class="text-center">
	<button type="submit" name="loadMore" class="btn btn-outline-primary">Load More</button>
</form>
</div>

<?php
include_once('footer.php');
?>
