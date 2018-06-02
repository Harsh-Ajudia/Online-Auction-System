<?php
ob_start();
include_once('header.php');
$page = 'login';
?>
<?php
if(isset($_POST['admin_login_button'])){
	include_once 'includes/db_connect.php';
	
	$username = $_POST['admin_username'];
	$password = $_POST['admin_password'];
	
	$query_admin_login="SELECT * FROM admin_user WHERE email='$username'";
	$result_admin_login = mysqli_query($mysqli,$query_admin_login) or die("Error updating data.".mysqli_error($mysqli));
	$num_rows = mysqli_num_rows($result_admin_login);
	
	if ($num_rows > 0) {
			$fetch=mysqli_fetch_assoc($result_admin_login);
			$validPassword = password_verify($password, $fetch['password']);
			
			if($validPassword){
				//in
				//unset($_SESSION['emailsignup']);
				$_SESSION["adminloggedin"] = $username;
				$_SESSION["adminfullname"] = $fetch['name'];
				//$_SESSION["adminnameloggedin"] = $fetch['full_name'];
				$_SESSION["adminidloggedin"] = $fetch['id'];
				$_SESSION["contactadmin"] = $fetch['contactNo'];
				$_SESSION["isadminloggedin"] = '1';
				$_SESSION['datereg'] = $fetch['dateRegistration'];
				
				
				header('Location: index.php');
			}
			else{
				//out
				$error_msg_login = "Username and email combination are incorrect";
			}
	}
	else{
		$error_msg_login = "Username/Email does not exist!";
	}
}
?>
<div class="mt-5 container">
	<h2 class="font-weight-light text-center mb-3">Existing users Log in here:</h2>
	
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6 rounded alert alert-dark">
			<div class="p-3 font-weight-light">
				<?php 
				if(isset($error_msg_login)){
					echo '<div class="alert mt-3 mb-3 alert-info">
					<p class="text-danger">'.$error_msg_login.'</p>
				</div>';
				}
				?>				
				<form method="POST" name="admin-login">
				<h4>Username</h4>
					<div class="form-group">
						<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="admin_username" placeholder="Enter username">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						
   				    </div>
				<h4>Password</h4>
					<div class="form-group">
						<input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="admin_password" placeholder="Enter password">
   				    </div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Remember me</label>
					  </div>
					<div class="text-center">
						<button name="admin_login_button" type="submit" class="btn btn-primary mt-3"><span class="mr-3 ml-3">Log in</span></button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-3">
		</div>
	</div>
</div>
<?php
include_once('footer.php');
?>