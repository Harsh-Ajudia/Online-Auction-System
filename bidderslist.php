<?php
session_start();
?>
<div class="">
				<div class="p-3">
				<h4 class="font-weight-light text-center mb-2">List of Bidders</h4>
					
					<?php
					
					$connection = new mysqli('localhost', 'root', '', 'auction');
if ($connection->connect_error) {
	die("Connection error: " . $connection->connect_error);
}
$prod_Id = $_SESSION['product_Query_Pag'];
$result = $connection->query("SELECT * FROM bidders WHERE prod_Id='$prod_Id' ORDER BY Amount DESC");




		//$prod_Id = $_SESSION['product_Query_Pag'];
		//$look_for_product_bids="SELECT * FROM bidders WHERE prod_Id='$product_Id' ORDER BY Amount DESC";
		//$view_product_bids = mysqli_query($mysqli,$look_for_product_bids) or die("Some error has been occured! Please try again .".mysqli_error($mysqli));
				$count = 1;
					while($got_product_bids = mysqli_fetch_assoc($result)){?>
					<div class="alert <?php if($count==1){echo 'alert-success';}else{echo 'alert-info';}?>" role="alert">
						<div class="row">
							<div class="col-md-8">
								<h6 class="text-dark text-left"><?php echo $count.'. '.$got_product_bids['userName']; if($count==1){echo'*';}?></h6>
							</div>
							<div class="col-md-4">
								<h6 class="text-right">&#8377; <?php echo $got_product_bids['Amount']?></h6>
							</div>
						</div>
					</div>
					<?php
					$count = $count+1;
					}
					?>
				</div>
			</div>