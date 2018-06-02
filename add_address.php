<?php
ob_start();
$page="User_Profile";
include_once('header.php');
error_reporting(0);
?>
<?php
include_once 'admin/includes/db_connect.php';
if($_SESSION['isloggedin']==1){
?>
<?php
	if(isset($_POST['addaddressbutton'])){
		$v1 = $_POST['country'];
		$v2 = $_POST['fullname'];
		$v3 = $_POST['mobileno'];
		$v4 = $_POST['pincode'];
		$v5 = addslashes($_POST['staddress']);
		$v6 = addslashes($_POST['landmark']);
		$v7 = $_POST['city'];
		$v8 = $_POST['state'];
		$v9 = $_SESSION["emailloggedin"];
		
		
		$add_address="INSERT INTO addresses (country, fullname, mobile, pincode, street_address, landmark, city, state, user_email) VALUES('$v1', '$v2', '$v3', '$v4', '$v5', '$v6', '$v7', '$v8', '$v9')";
		
		$result = mysqli_query($mysqli,$add_address) or die("Error adding your address. Pleas try again.".mysqli_error($mysqli));
		$message_add_address = "Addresses has successfully been created";
		$message = 'The address named on '.$v2.' has successfully been added!';
	}
?>
<div class="container p-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item"><a href="addresses.php">Your Addresses</a></li>
		<li class="breadcrumb-item active" aria-current="page">Add new Address</li>
	  </ol>
	</nav>
	<h4 class="text-center mb-5">Add Address</h4>
	
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
					<input type="text" class="form-control" name="fullname" id="exampleFormControlInput1" required>
	    		</div>
				<h5>Mobile Number </h5>
				<div class="form-group">
					<input type="text" class="form-control" name="mobileno" id="exampleFormControlInput1" required>
			    </div>
				<h5>Pincode</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="pincode" id="exampleFormControlInput1" required>
			    </div>
				<h5>Street Address</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="staddress" id="exampleFormControlInput1" placeholder="Flat/ house" required>
			    </div>
				<h5>Landmark</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="landmark" id="exampleFormControlInput1" placeholder="Eg: Behind Inox cinemas">
			    </div>
				<h5>City</h5>
				<div class="form-group">
					<input type="text" class="form-control" name="city" id="exampleFormControlInput1" required>
			    </div>
				<h5>State</h5>
				<div class="form-group">
				<select name="state" class="form-control">
					<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
					<option value="Daman and Diu">Daman and Diu</option>
					<option value="Delhi">Delhi</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Lakshadweep">Lakshadweep</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Orissa">Orissa</option>
					<option value="Pondicherry">Pondicherry</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttaranchal">Uttaranchal</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="West Bengal">West Bengal</option>
					</select>
				</div>			   
				<button class="btn btn-primary my-2 my-sm-0 mt-sm-2" name="addaddressbutton" type="submit"><span class="mr-sm-2">Add Address</span></button>
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