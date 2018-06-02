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
if($_SESSION['add_edit_id']==""){
	$_SESSION['add_edit_id'] = $_POST['edit_id'];
}
	if(isset($_POST['editaddressbutton'])){
		$v1 = $_POST['country'];
		$v2 = $_POST['fullname'];
		$v3 = $_POST['mobileno'];
		$v4 = $_POST['pincode'];
		$v5 = addslashes($_POST['staddress']);
		$v6 = addslashes($_POST['landmark']);
		$v7 = $_POST['city'];
		$v8 = $_POST['state'];
		$v9 = $_SESSION["emailloggedin"];
		$v10 = $_SESSION['add_edit_id'];
		
		$update_address="UPDATE addresses SET country = '$v1', fullname = '$v2', mobile = '$v3', pincode = '$v4', street_address = '$v5', landmark = '$v6', city = '$v7', state = '$v8', user_email = '$v9' WHERE id = '$v10'";
		
		$edit_address = mysqli_query($mysqli,$update_address) or die("Error updating your address. Pleas try again.".mysqli_error($mysqli));
		$message = 'The address named on '.$v2.' has successfully been updated!';
	}
	
	$edit_id = $_SESSION["add_edit_id"];
	$look_for_edit_address="SELECT * FROM addresses WHERE id = '$edit_id'";
	$view_addresses = mysqli_query($mysqli,$look_for_edit_address) or die("Some error has been occured! .".mysqli_error($mysqli));
	$got_addresses = mysqli_fetch_assoc($view_addresses);
?>
<div class="container p-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item"><a href="addresses.php">Your Addresses</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit existing Address</li>
	  </ol>
	</nav>
	<h4 class="text-center mb-5">Edit Address <?php echo $_SESSION['add_edit_id'];?></h4>
	
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
			<form method="POST" name="add_address">
				<h5>Country: </h5>
				<div class="form-group">
					<select class="form-control" name="country" id="exampleFormControlSelect1">
						<option value="India">India</option>
					</select>
				  </div>
				<h5>Full Name: </h5>
				<div class="form-group">
					<input type="text" class="form-control" name="fullname" id="exampleFormControlInput1" value="<?php echo $got_addresses['fullname'];?>" required>
	    		</div>
				<h5>Mobile Number </h5>
				<div class="form-group">
					<input type="text" class="form-control" name="mobileno" id="exampleFormControlInput1" value="<?php echo $got_addresses['mobile'];?>" required>
			    </div>
				<h5>Pincode</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="pincode" id="exampleFormControlInput1" value="<?php echo $got_addresses['pincode'];?>" required>
			    </div>
				<h5>Street Address</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="staddress" id="exampleFormControlInput1" value="<?php echo $got_addresses['street_address'];?>" placeholder="Flat/ house" required>
			    </div>
				<h5>Landmark</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="landmark" id="exampleFormControlInput1" value="<?php echo $got_addresses['landmark'];?>" placeholder="Eg: Behind Inox cinemas">
			    </div>
				<h5>City</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="city" id="exampleFormControlInput1" value="<?php echo $got_addresses['city'];?>" required>
			    </div>
				<h5>State</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="state" id="exampleFormControlInput1" value="<?php echo $got_addresses['state'];?>" required>
			    </div>
				<button class="btn btn-primary my-2 my-sm-0 mt-sm-2" name="editaddressbutton" type="submit"><span class="mr-sm-2">Update Address</span></button>
			</form>
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