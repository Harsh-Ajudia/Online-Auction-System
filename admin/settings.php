<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';

if(isset($_POST['change_email'])){
	$em = $_POST['email_admin'];
	$mn = $_POST['contact_admin'];
	$dateRegistration = $_SESSION['datereg'];
	
	$contact_info="UPDATE admin_user SET email = '$em', contactNo = '$mn' WHERE dateRegistration='$dateRegistration'";
	mysqli_query($mysqli,$contact_info) or die("Error updating data.".mysqli_error($mysqli));
	$message = 'Email id is updated to: '.$em.'<br/>Contact number has been updated to: '.$mn;	

	$_SESSION['adminloggedin'] = $em;
	$_SESSION['contactadmin'] = $mn;
}

if(isset($_POST['password'])){
	$admin_email = $_SESSION['adminloggedin'];
	
	$look_for_admin_security="SELECT * FROM admin_user WHERE email = '$admin_email'";
	$view_admin_security = mysqli_query($mysqli,$look_for_admin_security) or die("Some error has been occured! .".mysqli_error($mysqli));
	$got_security = mysqli_fetch_assoc($view_admin_security);
	
	$curr = $_POST['currpass'];
	$new1 = $_POST['newpass1'];
	$new2 = $_POST['newpass2'];
	
	$hashed_current = password_hash($curr, PASSWORD_BCRYPT);
	$validPassword = password_verify($curr, $got_security['password']);
	
	if($curr!=$new1){
		if($validPassword){
			if($new1==$new2){
				if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $new1)){
					$hashvalue = password_hash($new1, PASSWORD_BCRYPT);
					
					$update_pass="UPDATE user SET password = '$hashvalue' WHERE email_id='$email_id'";
					$pass_update = mysqli_query($mysqli, $update_pass) or die("Error creating your account. Pleas try again.".mysqli_error($mysqli));
					$message =  "Your password has successfully been changed";
				} 
				else {
					$message='Your password is not safe. It should at least contain 1 letter, 1 special characters, 1 Capital';
				}
			}
			else{
				$message =  'New password and entered password does not matched!';
			}
		}
		else{
			$message = 'current password not matched.';
			
		}
	}
	else{
		$message = 'Your old password cannot be the new one! There is no sense updating it.';
	}
}
?>
<?php
		if(isset($message)){ echo '<div class="alert alert-primary" role="alert">
		  <strong>Note: </strong>
			' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button></div>'; }
		?>
<div class="col-md-12 mb-2">
<div class="mt-2 border p-3">
	<div class="form-group">
	<h3 class="font-weight-light text-success">Change Password</h3><hr/>
	<form method="POST">
			<div class="row">
				<div class="col-md-6">
					<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="currpass" placeholder="Current Password" required>
					<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="newpass1" placeholder="New Password" required>
					<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="newpass2" placeholder="Retype Current Password"required>
					<button class="btn btn-primary my-2 my-sm-0 mt-3" name="password" type="submit"><span class="mr-sm-2"><i class="fas fa-edit mr-sm-2 fa-lg"></i>Update</span></button>
				</div>
				
			</div>
	</form>
	</div>
</div>

<div class="mt-2 border p-3">
<div class="form-group">
<h3 class="font-weight-light text-success">Change Email id</h3><hr/>
<form method="POST">
		<div class="row">
			<div class="col-md-6">
				
				<input type="text" class="form-control mb-2" id="exampleFormControlInput1" name="email_admin" value = "<?php echo $_SESSION['adminloggedin']?>">
				<input type="text" class="form-control mb-2" id="exampleFormControlInput1" name="contact_admin" value = "<?php echo $_SESSION['contactadmin']?>">
				<button class="btn btn-primary my-2 my-sm-0 mt-3" name="change_email" type="submit"><span class="mr-sm-2"><i class="fas fa-edit mr-sm-2 fa-lg"></i>Update</span></button>
			</div>
			
		</div>
</form>
	 </div>
	</div>
</div>
