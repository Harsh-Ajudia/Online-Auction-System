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
$emid = $_SESSION['idloggedin'];
	
	$look_for_bids = "SELECT * FROM bidders WHERE userId = '$emid' ORDER BY date_bidded DESC";
	$view_bids = mysqli_query($mysqli,$look_for_bids) or die("Some error has been occured! .".mysqli_error($mysqli));
	
	
?>
<div class="container mb-5">
	<div class="container-fluid pt-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item">Your Account</li>
	  </ol>
	</nav>
	<h3 class="mt-4">Your Bids</h3>
	<p><?php echo $_SESSION["emailloggedin"]?></p>
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th scope="col">Sr. no.</th>
			  <th scope="col">Product</th>
			  <th scope="col">Amount</th>
			  <th scope="col">Date Bidded</th>
			  <th scope="col">Link</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		  $counter_bids = 1;
		  while($got_bids = mysqli_fetch_assoc($view_bids)){	
		  ?>
		  <tr>
			  <th scope="row"><?php echo $counter_bids;?></th>
			  <td><?php echo $got_bids['prod_Id'];?></td>
			  <td class="text-success">&#8377; <?php echo number_format($got_bids['Amount']);?></td>
			  <td><?php echo $got_bids['date_bidded'];?></td>
			  <td>
			  <form action="product.php" method="POST" class="footer_list">
				<input type="hidden" name="product_Query_Page" value="<?php echo $got_bids['prod_Id'] ?>"/>
				<button class="btn btn-primary simple_link" type="submit">View Product</button>
			</form></td>
			</tr>
		  <?php
		  $counter_bids = $counter_bids + 1; 
		  } ?>
		  </tbody>
		  </table>
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