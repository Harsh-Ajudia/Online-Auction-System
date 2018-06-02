<?php
/*Home page*/
$page='home';
include_once('header.php');
include_once('admin/includes/db_connect.php');

	$check_for_carousel_data = "SELECT * FROM carousel";
	$checked_carousel_data = mysqli_query($mysqli,$check_for_carousel_data) or die("Some error has been occured! .".mysqli_error($mysqli));
	
	
?>
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
<!--div class="row mt-1 mb-1">
	<div class="col-md-2 border p-5">
		<h3 class="text-center">Upcoming Auctions</h3>
	</div>
	<div class="col-md-10 border text-center">
		<div class="card-group p-4">
		 <?php
			$check_for_upcoming_data = "SELECT * FROM product WHERE is_verified = 0 or 1 ORDER BY date_Added DESC LIMIT 4";
			$checked_upcoming_data = mysqli_query($mysqli,$check_for_upcoming_data) or die("Some error has been occured! .".mysqli_error($mysqli));
			
		$count_recents = 1;
		while($got_upcoming_data = mysqli_fetch_assoc($checked_upcoming_data)){
		  ?><div class="col-md-3 mt-3">
				<div class="card_recent_tile">
				<div id="tile_grid">
					<img class="card-img-top" src="<?php echo $got_upcoming_data['image1']?>" alt="Card image cap">
				</div>
				<div class="card-body">
				  <p class="card-title"><?php echo $got_upcoming_data['name'];?></p>
				  <p class="card-text text-primary">Started &#8377; <?php echo number_format($got_upcoming_data['initial_Price']);?></p>
			  <p class="card-text text-success">Current &#8377; <?php echo number_format($got_upcoming_data['current_Price']);?></p>
				</div>
				<div class="card-footer">
				<form method="POST" name="recenteeee" action="product.php">  
				<input type="hidden" name="product_Query_Page" value="<?php echo $got_upcoming_data['product_Id']?>"/>
				  <button type="submit" class="btn btn-outline-primary">View deal <i class="fas fa-angle-right mr-sm-2 fa-lg"></i></button>
				</form>
				</div>
			  </div>
			 </div>
		<?php
		}
		?>
			  
		</div>
	</div>
</div-->


<div class="row mt-1 mb-1">
	<div class="col-md-2 border p-5">
		<h3 class="text-center">Recently added Auctions</h3>
	</div>
	<div class="col-md-10 border text-center">
		<div class="card-group p-4">
		  <?php
			$check_for_recently_added_data = "SELECT * FROM product WHERE is_verified = 1 ORDER BY date_Added DESC LIMIT 4";
			$checked_recently_added = mysqli_query($mysqli,$check_for_recently_added_data) or die("Some error has been occured! .".mysqli_error($mysqli));
			
		$count_recents = 1;
		while($got_recents_data = mysqli_fetch_assoc($checked_recently_added)){
		  ?>
		  <div class="m-1 card" id="card_recent_tile">
			<div id="tile_card">
				<img class=" rounded" src="<?php echo $got_recents_data['image1'];?>" alt="Card image cap">
			</div>
			<div class="card-body">
			  <h5 class="card-title font-weight-light"><?php echo $got_recents_data['name'];?></h5>
			  <p class="card-text text-primary">Started &#8377; <?php echo number_format($got_recents_data['initial_Price']);?></p>
			  <p class="card-text text-success">Current &#8377; <?php echo number_format($got_recents_data['current_Price']);?></p>
			</div>
			<div class="card-footer">
				<form method="POST" name="recenteeee" action="product.php">
					<input type="hidden" name="product_Query_Page" value="<?php echo $got_recents_data['product_Id']?>"/>
					<button type="submit" class="btn btn-outline-primary">View deal</button>
				</form>
			</div>
		  </div>
		<?php
		$count_recents =$count_recents + 1;
		}
		?>		
		</div>
	</div>
</div>

<!--div class="row mt-1 mb-1">
	<div class="col-md-2 border p-5">
		<h3 class="text-center">Already Closed Auctions</h3>
	</div>
	<div class="col-md-10 border text-center">
		<div class="card-group p-4">
		  <div class="card">
			<img class="card-img-top" src="img/blank/blue.png" alt="Card image cap">
			<div class="card-body">
			  <h5 class="card-title ">Card title</h5>
			  <p class="card-text text-success">Final Price</p>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-outline-primary">View deal</button>
			</div>
		  </div>
		  <div class="card">
			<img class="card-img-top" src="img/blank/blue.png" alt="Card image cap">
			<div class="card-body">
			  <h5 class="card-title">Card title</h5>
			  <p class="card-text text-success">Final Price</p>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-outline-primary">View deal</button>
			</div>
		  </div>
		  <div class="card">
			<img class="card-img-top" src="img/blank/blue.png" alt="Card image cap">
			<div class="card-body">
			  <h5 class="card-title">Card title</h5>
			  <p class="card-text text-success">Final Price</p>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-outline-primary">View deal</button>
			</div>
		  </div>
		   <div class="card">
			<img class="card-img-top" src="img/blank/blue.png" alt="Card image cap">
			<div class="card-body">
			  <h5 class="card-title">Card title</h5>
			  <p class="card-text text-success">Final Price</p>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-outline-primary">View deal</button>
			</div>
		  </div>
		   <div class="card">
			<img class="card-img-top" src="img/blank/blue.png" alt="Card image cap">
			<div class="card-body">
			  <h5 class="card-title">Card title</h5>
			  <p class="card-text text-success">Final Price</p>
			</div>
			<div class="card-footer">
			  <button type="button" class="btn btn-outline-primary">View deal</button>
			</div>
		  </div>
		</div>
	</div>
</div-->
<script>

</script>
<?php
include_once('footer.php');
?>
