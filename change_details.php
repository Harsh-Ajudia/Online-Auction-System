<?php
ob_start();
$page="User_Profile";
include_once('header.php');
//error_reporting(0);
?>
<?php
include_once 'admin/includes/db_connect.php';
if($_SESSION['isloggedin']==1){
	$email_id = $_SESSION["emailloggedin"];
	//1
	$look_for_security="SELECT * FROM user WHERE email_id='$email_id'";
	$view_security = mysqli_query($mysqli,$look_for_security) or die("Some error has been occured! .".mysqli_error($mysqli));
	$got_security = mysqli_fetch_assoc($view_security);
?>
<?php
if(isset($_POST['personal_info'])){
	$v1 = $_POST['fullname'];

	$per_info="UPDATE user SET full_name = '$v1' WHERE email_id='$email_id'";
	mysqli_query($mysqli,$per_info) or die("Error updating data.".mysqli_error($mysqli));
	$message = 'Full name has been changed to '.$v1;
}
if(isset($_POST['password'])){
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
if(isset($_POST['contact'])){
	$em = $_POST['email'];
	$mn = $_POST['mobile'];
	$dateRegistration = $got_security['date_registration'];
	
	$contact_info="UPDATE user SET email_id = '$em', contact_no = '$mn' WHERE date_registration='$dateRegistration'";
	mysqli_query($mysqli,$contact_info) or die("Error updating data.".mysqli_error($mysqli));
	$message = 'Email id is update to: '.$em.'<br/>Contact number has been updated to: '.$mn;	

	$_SESSION['emailloggedin'] = $em;
}
if(isset($_POST['2step'])){
	$status = $_POST['status'];
	
	$st="UPDATE user SET two_step_verfication = '$status' WHERE email_id='$email_id'";
	mysqli_query($mysqli,$st) or die("Error updating data.".mysqli_error($mysqli));
	if($status==0){
		$message = 'Two step verification has been disabled!';
	}
	else{
		$message = 'Two step verification has been enabled!';
	}
}

?>
<div class="container pt-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item active" aria-current="page">Login & Security</li>
	  </ol>
	</nav>
	<h3 class="text-center mt-3 mb-3">Login And Security</h3>
	<div class="row">
		<div class="col-md-2">
		
		</div>
		<div class="col-md-8">
		<?php
		if(isset($message)){ echo '<div class="alert alert-success" role="alert">
		  <strong>Note: </strong>
			' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'; }
		?>
			<form method="POST">
			<div class="border p-3 col-md-12 mb-2">
				<h4>1. Personal Information</h4>
				<div class="form-group">
					<h6>Your Name</h6>
					<div class="row">
						<div class="col-md-10">
							<input type="text" class="form-control" id="exampleFormControlInput1" name="fullname" value="<?php echo $got_security['full_name'];?>">
						</div>
						<div class="col-md-2 text-center">
							<button class="btn btn-primary my-2 my-sm-0" name="personal_info" type="submit"><span class="mr-sm-2">Update</span></button>
						</div>
					</div>
   			     </div>
			</div>
			</form>
			<div class="border p-3 col-md-12 mb-2">
				<h4>2. Password</h4>
				<div class="form-group">
			<form method="POST">
					<div class="row">
						<div class="col-md-10">
							<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="currpass" placeholder="Current Password" required>
							<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="newpass1" placeholder="New Password" required>
							<input type="password" class="form-control mb-2" id="exampleFormControlInput1" name="newpass2" placeholder="Retype Current Password"required>
						</div>
						<div class="col-md-2 text-center">
							<button class="btn btn-primary my-2 my-sm-0" name="password" type="submit"><span class="mr-sm-2">Update</span></button>
						</div>
					</div>
			</form>
   			     </div>
			</div>
			<div class="border p-3 col-md-12 mb-2">
				<h4>3. Contact Information</h4>
				<div class="form-group">
				<form method="POST">
					<div class="row">
						<div class="col-md-10">
							<input type="text" class="form-control mb-2" id="exampleFormControlInput1" name="email" value="<?php echo $got_security['email_id']?>">
							<input type="text" class="form-control mb-2" id="exampleFormControlInput1" name="mobile" value="<?php echo $got_security['contact_no']?>">
						</div>
						<div class="col-md-2 text-center">
							<button class="btn btn-primary my-2 my-sm-0" name="contact" type="submit"><span class="mr-sm-2">Update</span></button>
						</div>
					</div>
				</form>
   			     </div>
			</div>
			<div class="border p-3 col-md-12 mb-2">
				<h4>4. Advanced Security</h4>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 mt-2">
							<h6>Enable two-step Verification?</h6>
						</div>
						<div class="col-md-6">
							<form class="form-inline" method="POST">
							  <div class="form-group mb-2">
							  </div>
							  <select name="status" class="form-control mr-4">
								<option value="0" <?php if($got_security['two_step_verfication']==0){ echo 'selected';}?>>No</option>
								<option value="1" <?php if($got_security['two_step_verfication']==1){ echo 'selected';}?>>Yes</option>
							  </select>
							  <button type="submit" name="2step" class="mt-1 btn btn-primary mb-2 ml-5">Update</button>
							</form>
						</div>
						
					</div>
   			     </div>
			</div>
		</div>
		<div class="col-md-2">
		
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