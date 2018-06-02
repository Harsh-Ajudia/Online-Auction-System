<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';	
	if(isset($_POST['prod_App'])){
		$prod_App = $_POST['idToApprove'];
		$date_of_Approval = $_POST['date_of_Approval'];
		
		$look_for_approval = "UPDATE product SET is_verified = 1, date_Started = '$date_of_Approval' WHERE product_Id = '$prod_App'";
		$view_approval = mysqli_query($mysqli,$look_for_approval) or die("Some error has been occured! .".mysqli_error($mysqli));
		
		$message = 'The product with Sr. no. "'.$prod_App.'" has successfully been approved <i class="fas fa-smile mr-sm-1 fa-lg"></i>';
	}
	if(isset($_POST['prod_Dis'])){
		$prod_Dis = $_POST['idToDisapprove'];
		$date_of_Approval = $_POST['date_of_Disapproval'];
		
		$look_for_unapproval = "UPDATE product SET is_verified = 2 WHERE product_Id = '$prod_Dis'";
		$view_unapproval = mysqli_query($mysqli,$look_for_unapproval) or die("Some error has been occured! .".mysqli_error($mysqli));
		$message = 'The product with Sr. no. "'.$prod_Dis.'" has successfully been disapproved <i class="fas fa-frown mr-sm-1 fa-lg"></i>';
	}
	$look_for_unapproved = "SELECT * FROM product WHERE is_verified = 0";
	$view_unapproved = mysqli_query($mysqli,$look_for_unapproved) or die("Some error has been occured! .".mysqli_error($mysqli));
	$count_need = mysqli_num_rows($view_unapproved);
?>
<div class="container-fluid mb-2">
	<div class=" border p-3">
		<h2 class="font-weight-light text-primary">Products that needs Approval</h2><hr/>
		<?php
		if($count_need==0){
			echo '<h4 class="font-weight-light">0 product found that needs approval</h4>';
		}
		?>
		<?php
		if(isset($message)){ echo '<div class="alert alert-primary" role="alert">
				  <strong>Note: </strong>
					' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button></div>'; }
		?>
		
		<div class="table-responsive">
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th scope="col">Sr. no.</th>
			  <th scope="col">Image</th>
			  <th scope="col">Product</th>
			  <th scope="col">Seller Email</th>
			  <th scope="col">category</th>
			  <th scope="col">Date Added</th>
			  <th scope="col">Approve</th>
			  <th scope="col">Disapprove</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		  $counter_unapproved = 1;
		  while($got_approved = mysqli_fetch_assoc($view_unapproved)){	
		  ?>
		  <tr>
			  <th scope="row"><?php echo $counter_unapproved;?></th>
			  <th scope="row"><img src="../<?php echo $got_approved['image1'];?>" width="50"/></th>
			  <td><?php echo $got_approved['name'];?></td>
			  <td><?php echo $got_approved['seller'];?></td>
			  <td><?php echo $got_approved['category'];?></td>
			  <td><?php echo $got_approved['date_Added'];?></td>
			  <input type="hidden" name="date_of_Approvl" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
				<form method="POST">
					<input type="hidden" value="<?php echo $got_approved['product_Id']?>" name="idToApprove" />
					<input type="hidden" name="date_of_Approval" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
					<td><button class="btn btn-success" type="submit" name="prod_App"><i class="fas fa-thumbs-up mr-sm-1 fa-lg"></i></button></td>
				</form>
				<form method="POST">
					<input type="hidden" value="<?php echo $got_approved['product_Id']?>" name="idToDisapprove" />
					<input type="hidden" name="date_of_Disapproval" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
					<td><button class="btn btn-danger" type="submit" name="prod_Dis"><i class="fas fa-thumbs-down mr-sm-1 fa-lg"></i></button></td>
				</form>
			</tr>
		  <?php
		  $counter_unapproved = $counter_unapproved + 1; 
		  } ?>
		  </tbody>
		  </table>
		  </div>
	</div>
</div>