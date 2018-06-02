<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';
	$status = '0';
	if(isset($_POST['Active'])){
		$status = $_POST['Active'];
	}	
	if(isset($_POST['block'])){
		$toBlock = $_POST['sta'];
		$toBlockUser="UPDATE user SET account_status = 1 WHERE user_id = '$toBlock'";
		$got_block_result = mysqli_query($mysqli,$toBlockUser) or die("Error updating information. Please try again.".mysqli_error($mysqli));
		$message = 'User '.$toBlock.' has successfully been blocked';
	}
	if(isset($_POST['unblock'])){
		$toUnBlock = $_POST['stan'];
		$toUnBlockUser="UPDATE user SET account_status = 0 WHERE user_id = '$toUnBlock'";
		$got_Unblock_result = mysqli_query($mysqli,$toUnBlockUser) or die("Error updating information. Please try again.".mysqli_error($mysqli));
		$message = 'User '.$toUnBlock.' has successfully been unblocked';
	}
	
	$get_users="SELECT * FROM user WHERE account_status = $status";
	$got_users_result = mysqli_query($mysqli,$get_users) or die("Error viewing information. Please try again.".mysqli_error($mysqli));
	
	$count_got_results = mysqli_num_rows($got_users_result);
	?>
	<hr/>
	<?php
			if(isset($message)){ echo '<div class="alert alert-success" role="alert">
			  <strong>Note: </strong>
				' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button></div>'; }
			?>
	<div class="container text-right">
		<div class="custom-control custom-radio custom-control-inline">
		  <form action="" method="POST">
		  <input type="radio" id="customRadioInline1" name="Active" value="0" class="custom-control-input" selected>
		  
		  <label class="custom-control-label text-success" for="customRadioInline1">Active</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
		
		  <input type="radio" id="customRadioInline2" name="Active" value="1" class="custom-control-input">
		  <label class="custom-control-label text-danger mr-3" for="customRadioInline2">Inactive</label>
		  <input type="submit" name="submit" class="btn btn-secondary-outline">
		</div>
		</form>
	</div>
	
	<?php
		if($count_got_results==0){
			echo '<h4 class="font-weight-light">0 users found who are blocked!</h4>';
		}
		else{
			echo '<table class="mt-3 table table-responsive">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">Id</th>
			  <th scope="col">Link</th>
			  
			  <th scope="col">Email</th>
			  <th scope="col">Contact</th>
			  <th scope="col">Address</th>
			  <th scope="col">Status</th>
			  <th scope="col">Block</th>
			</tr>
		  </thead>';
	
	while($got_users = mysqli_fetch_assoc($got_users_result)){
	echo '
	<tbody>
    <tr>
      <td> '.$got_users['user_id'].'</td>
	  <td><a href="user_page.php?user_id_passed='.$got_users['user_id'].'" >'.$got_users['full_name'].'</a></td>
      
      <td>'.$got_users['email_id'].'</td>
      <td>+91'.$got_users['contact_no'].'</td>
      <td>'.$got_users['address'].'</td>
	  <td>';
	  
	  if($got_users['account_status']==0){echo '<p class="text-success">Active</p>';} else{echo '<p class="text-danger">Blocked</p>';}?></td>
	  <td><?php if($got_users['account_status']==0){echo '<form method="POST"><input type="hidden" name="sta" value="'.$got_users['user_id'].'"><button class="btn btn-danger" type="submit" name="block"><i class="fas fa-ban mr-2"></i>Block</button></form>';} else{echo '<form method="POST"><input type="hidden" name="stan" value="'.$got_users['user_id'].'"><button class="btn btn-danger" type="submit" name="unblock"><i class="fas fa-check-square mr-2"></i>Unblock</button></form>';} ?></td>
    </tr>
	<?php
	}
?>
	</table><?php
	}
	?>

