<?php
ob_start();
$page="User_Profile";
$sort_variable = "date_Added";
include_once('header.php');
//error_reporting(0);
?>
<?php
include_once 'admin/includes/db_connect.php';

if((isset($_POST['sort_var']))){
	$sort_variable = $_POST['sort_var'];	
	//$sortType = $_POST['sort_type'];
}

if(((isset($_SESSION['search_Query']))||(isset($_POST['search_Query'])))){

	if(isset($_POST['search_Query'])){
		$_SESSION['search_Query'] = $_POST['search_Query'];
		$_SESSION['category_Selected'] = $_POST['category_Selected'];
		$var1 = $_SESSION['search_Query'];
		$var2 = $_SESSION['category_Selected'];
	}
	else{
		$var1 = $_SESSION['search_Query'];
		$var2 = $_SESSION['category_Selected'];
	}
	
	$var1 = preg_replace("#[^0-9a-z@ .]#i","",$var1);
	$_SESSION['Query_Search'] = $var1;
	
	$look_for_search="SELECT * FROM product WHERE (name Like '%$var1%' OR seller Like '%$var1%' OR description Like '%$var1%') AND is_verified = 1 ORDER BY $sort_variable";
	$view_search = mysqli_query($mysqli, $look_for_search) or die("Some error has been occured! Please Search again...".mysqli_error($mysqli));
	//echo $look_for_search;
	
	$count = mysqli_num_rows($view_search);
	if($count == 0){
		$message = 'Your query "' .$var1. '" yield no results! Try again with a different search parameters.';
	}
	else{
	}
?>

<div class="container mb-5 mt-5">
<div class="container">
	<?php
		if(isset($message)){ echo '<div class="alert alert-primary" role="alert">
		  <strong>Note: </strong>
			' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button></div>'; }
		?>
</div>
	<?php echo '<h3 class="font-weight-light">' .$count. ' results found! for your query "'.$var1.'"</h3><br/>';?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
					 <a class="navbar-brand" href="#">Sort <i class="fas fa-random mt-2 ml-1 fa-lg"></i></a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  </button>
					  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto justify-content-end">
						  <li class="nav-item">
							<form method="POST">
								<button type="submit" class="border-left border-right btn btn-link nav-link" name="sort_var" value="date_Started ASC"><span class="text-dark">Date<i class="fas fa-sort-numeric-up mt-2 ml-1"></i></span></button>
								<input type="hidden" name="sort_type" value="ASC" />
							</form>
						 </li>
						  <li class="nav-item">
							<form method="POST">
								<button type="submit" class="border-right btn btn-link nav-link" name="sort_var" value="date_Started DESC"><span class="text-dark">Date<i class="fas fa-sort-numeric-down mt-2 ml-1"></i></span></button>
								<input type="hidden" name="sort_type" value="DESC" />
							</form>
						  </li>
						  <li class="nav-item">
							<form method="POST">
								<button type="submit" class="border-right btn btn-link nav-link" name="sort_var" value="category"><span class="text-dark">Category<i class="fas fa-object-ungroup mt-2 ml-1"></i></span></button>
							</form>
						  </li>
						  <li class="nav-item">
							<form method="POST">
								<button type="submit" class="border-right btn btn-link nav-link" name="sort_var" value="current_Price ASC"><span class="text-dark">Price<i class="fas fa-sort-numeric-down mt-2 ml-1"></i></span></button>
								<input type="hidden" name="sort_type" value="ASC" />
							</form>
						  </li>
						  <li class="nav-item">
							<form method="POST">
								<button type="submit" class="border-right btn btn-link nav-link" name="sort_var" value="current_Price DESC"><span class="text-dark">Price<i class="fas fa-sort-numeric-up mt-2 ml-1"></i></span></button>
								<input type="hidden" name="sort_type" value="DESC" />
							</form>
						  </li>
						</ul>
					  </div>
					</nav>
	<div class="row">
		
		<?php		
			while($got_search = mysqli_fetch_assoc($view_search)){
				?>
				<div class="p-3 col-md-3">
					<div class="border rounded p-3">
						<div id="card_recent_tile">
							<img src="<?php echo $got_search['image1'];?>" class=" rounded img-fluid"/>
						</div>
						<form action="product.php" method="POST">
										
						<ul class="list-unstyled footer_list text-center"><li><button type="submit" name="product_Query_Page" value="<?php echo $got_search['product_Id']?>" class="btn btn-link"><?php echo $got_search['name']?></button></li></ul>
						</form>
						<h6 class="font-weight-normal">Initial Price: &#8377; <?php echo number_format($got_search['initial_Price']);?></h6>
						<h6 class="font-weight-normal">Current Price: &#8377; <?php echo number_format($got_search['current_Price']);?></h6>
						<?php
						if($got_search['is_Auction_Over']==0){
							$now = new DateTime();
							$future_date = $got_search['date_End'];
							$future_date = new DateTime(''.$future_date.'');
							$interval = $future_date->diff($now);
							echo $interval->format('<p class="text-success">%a days, %h hours left!</p>');
						}
						else{
							echo '<p><span class="text-danger">0 days left!</span><span><br/>Auction has been ended!</span></p>';
						}
						?>
					</div>
				</div>
				<?php
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