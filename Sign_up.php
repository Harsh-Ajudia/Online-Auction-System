<?php
/*Signup page*/
$messagesignup = $m1 = $m2 = $m3 = '';
$page='registration';
include_once('header.php');
if(isset($_SESSION['emailsignup'])){
		include_once 'admin/includes/db_connect.php';
		$emailsignup = $_SESSION['emailsignup'];
		//$messagesignup = 'An email with OTP has been sent to your email: <strong>' . $_SESSION['emailsignup'] . '</strong>';
}
if(isset($_POST['pstep2'])){
	$fullname=$_POST['fullname'];
	$contact_no=$_POST['contact_no'];
	$address=addslashes($_POST['address']);
	$state=$_POST['state'];
	$city=$_POST['city'];
	$pincode=$_POST['pincode'];
	$dateRegistration=$_POST['dateRegistration'];
	$gender=$_POST['gender'];
	$otpentered = $_POST['OTPentered'];
	$query4="SELECT * FROM otp WHERE email='$emailsignup'";
	$result4 = mysqli_query($mysqli,$query4) or die("Some error ahs been occured.".mysqli_error($mysqli));
	$fetched=mysqli_fetch_assoc($result4);
	if($otpentered==$fetched['OTP']){
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		if($pass1!=""||$pass2!=""){
			if($pass2==$pass1){
			if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pass1)){
				$hashvalue = password_hash($pass1, PASSWORD_BCRYPT);
				
				$query5="INSERT INTO user (full_name, email_id, password, contact_no, address, state, city, pincode, gender, date_registration) VALUES('$fullname', '$emailsignup', '$hashvalue', '$contact_no', '$address', '$state', '$city', '$pincode', '$gender', '$dateRegistration')";
				$result5 = mysqli_query($mysqli,$query5) or die("Error creating your account. Pleas try again.".mysqli_error($mysqli));
				$m3 = "Your account has sussessfully been created!";
				
				$query7="DELETE from otp where email='$emailsignup'";
				mysqli_query($mysqli,$query7) or die("Error updating data.".mysqli_error($mysqli));
				
				unset($_SESSION['emailsignup']);
			} else {
				$m2 = "Your password is not safe. It should at least contain 1 letter, 1 special characters, 1 Capital";
			}
		}
		}
		else{
			$m1 = "Password cannot be empty";
		}
	}
	else{
		echo 'no';
	}
}
//unset($_SESSION['emailsignup']);
?>
<div class="container mt-5">
		<?php
		if($messagesignup!=""||$m1!=""||$m2!=""||$m3!=""){
			echo '<div class="text-center alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Note: </strong>' ;
		  echo $messagesignup .'<br/>'. $m1 .'<br/>'. $m2;
		  echo $m3;
		  echo '
		</div>
			';
		}
		?>
		<div class="row text-center">
			<div class="col-md-3">
			</div>
			<div class="col-md-6 border p-4">
			<h5>Register with us</h5>
				<ul class="nav nav-tabs nav-fill mt-4" id="myTab" role="tablist">
				  <li class="nav-item">
					<a class="nav-link active" id="st1-tab" data-toggle="tab" href="#st1" role="tab" aria-controls="st1" aria-selected="true">Step 1</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="st2-tab" data-toggle="tab" href="#st2" role="tab" aria-controls="st2" aria-selected="false">Step 2</a>
				  </li>
				</ul>
				<div class="tab-content mt-5" id="myTabContent">
				  <div class="tab-pane fade show active" id="st1" role="tabpanel" aria-labelledby="st1-tab">
						<form method="POST" name="otpcheck">
						  <div class="form-group">
							<label for="exampleFormControlInput1">Email address</label>
							<input type="email" name="emaildisabled" class="form-control" id="exampleFormControlInput1" placeholder="<?php if(isset($_SESSION['emailsignup'])){echo $emailsignup;} ?>" disabled />
						  </div>
						  <div class="form-group">
							<label for="exampleFormControlInput1">OTP</label>
							<input type="password" name="OTPentered" class="form-control" value="uLIxZgMv2blcP5HXFGNf9UyqKwrhVC74sJnAtTQReOpYmkzj8W" id="OTPsent"/>
						  </div>
						  
					<button name="pstep" type="button" onclick="$('#st2-tab').trigger('click')" class="btn btn-outline-primary">Proceed</button>
				  </div>
				  <div class="tab-pane fade" id="st2" role="tabpanel" aria-labelledby="st2-tab">
						 <div class="row">
							<div class="col-md-6">
								  <div class="form-group">
									<label for="exampleFormControlInput1">Full Name</label>
									<input type="text" name="fullname" class="form-control" id="exampleFormControlInput1" required/>
								  </div>
								  <div class="form-group">
									<label for="exampleFormControlInput1">Password</label>
									<input type="password" name="pass1" class="form-control" id="exampleFormControlInput1" required/>
								  </div>
							</div>
							<input type="hidden" name="dateRegistration" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
							<div class="col-md-6">
								  <div class="form-group">
									<label for="exampleFormControlInput1">Contact Number</label>
									<input type="text" name="contact_no" class="form-control" id="exampleFormControlInput1" maxlength="10"/>
								  </div>
								  <div class="form-group">
									<label for="exampleFormControlInput1">Confirm Password</label>
									<input type="password" name="pass2" class="form-control" id="exampleFormControlInput1" />
								  </div>
							</div>
						 </div>
						 <div class="form-group">
							<label for="exampleFormControlInput1">Address</label>
							<textarea type="text" name="address" class="form-control" id="exampleFormControlInput1"></textarea>
						  </div>
						 <div class="row">
							<div class="col-md-3">
									<label for="exampleFormControlSelect1">State</label>
									<select name="state" class="form-control" id="exampleFormControlSelect1">
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
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleFormControlInput1">City</label>
									<input type="text" name="city" class="form-control" id="exampleFormControlInput1" required/>
								  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleFormControlInput1">Pincode</label>
									<input type="text" name="pincode" class="form-control" id="exampleFormControlInput1" required/>
								  </div>
							</div>
							<div class="col-md-3">
								<label for="exampleFormControlInput1">Gender</label>
								<div class="text-left">
									<div class="form-check form-check-inline">
									  <input name="gender" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="male" checked>
									  <label class="form-check-label" for="inlineRadio1">Male</label>
									</div>
									<div class="form-check form-check-inline">
									  <input name="gender" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female">
									  <label class="form-check-label" for="inlineRadio2">Female</label>
									</div>
								</div>
							</div>
						 </div>
						 <button name="pstep2" class="btn btn-outline-primary">Register</button>
					</form>
				  </div>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
</div>
<?php
include_once('footer.php');
?>