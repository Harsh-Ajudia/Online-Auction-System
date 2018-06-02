<?php
session_start();
$connectionforprice = new mysqli('localhost', 'root', '', 'auction');
if ($connectionforprice->connect_error) {
	die("Connection error: " . $connectionforprice->connect_error);
}
$product_Id = $_SESSION['product_Query_Pag'];
$resultprice = $connectionforprice->query("SELECT * FROM product WHERE product_Id='$product_Id'");

$got_product_price = mysqli_fetch_assoc($resultprice);
?>
<div class="row">
	<div class="col-md-6">
		<h6 class="font-weight-regular text-dark text-right">Intial Price: </h6>
		<h6 class="font-weight-regular text-dark text-right">Current Price: </h6>
		<h6 class="font-weight-regular text-dark text-right">Final Price: </h6>
	</div>
					
	<div class="col-md-6">
		<?php echo '<h6 class="text-left text-success"> &#8377; '.number_format($got_product_price['initial_Price']).'</h6>';?>
		<?php echo '<h6 class="text-left text-warning"> &#8377; '.number_format($got_product_price['current_Price']).'</h6>';?>
		<?php echo '<h6 class="text-left text-danger"> &#8377; '.number_format($got_product_price['final_Price']).'</h6>';?>
	</div>
	
</div>