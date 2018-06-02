<?php
/*Home page*/
$page='home';
include_once('header.php');
include_once 'admin/includes/db_connect.php';
?>
<?php
if(isset($_POST['contact_us'])){
	$v1 = $_POST['fname'];
	$v2 = $_POST['email'];
	$v3 = $_POST['subject'];
	$v4 = addslashes($_POST['message']);
	$v5 = $_POST['date_contacted'];
	
	if($v4==""){
		$message = "Message cannot be empty! Your form is not submitted";		
	}
	else{
		$add_contact="INSERT INTO contact_us (name, email, subject, message, date_contacted) VALUES('$v1', '$v2', '$v3', '$v4', '$v5')";
		
		$cont = mysqli_query($mysqli,$add_contact) or die("Error adding your contact Information. Pleas try again.".mysqli_error($mysqli));
		$message = 'Dear '.$v1 .', your message has successfully been sent!';
	}
}
?>
<div class="container-fluid">
	<?php
	if(isset($message)){ echo '<div class="alert mt-3 alert-success" role="alert">
			  <strong>Note: </strong>
				' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button></div>'; }
	?>
	<div class="jumbotron bg-success jumbotron-fluid">
		<div class="container text-white text-center">
			<i class="fas fa-comments fa-4x mr-5"></i>
			<i class="fas fa-users fa-4x"></i>
			<h1 class="display-4">Contact Us</h1>
			<p class="lead">We are happy to help. Feel free to contact us.</p>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 p-4">
				<div class="container-fluid p-4">
					<h4>Contact us</h4>
					<hr/>
					<form method="POST">
						<div class="form-group">
							<label for="exampleFormControlInput1">Full Name</label>
							<input type="text" class="form-control" id="exampleFormControlInput1" name="fname" placeholder="First Name, Last Name" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Email</label>
							<input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Subject</label>
							<select name="subject" class="form-control" id="exampleFormControlSelect2">
								<option>General</option>
								<option>Complain</option>
								<option>Suggestion</option>
								<option>Others</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Message</label>
							<div class="form-group">
								<textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="4"></textarea required>
							  </div>
						</div>
						<input type="hidden" name="date_contacted" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
						<button class="btn btn-success my-2 my-sm-0" name="contact_us" type="submit"><span class="mr-sm-2">Send</span></button>
					</form>
				</div>
			</div>
			<div class="col-md-6 p-4">
				<div class="container-fluid p-4">
					<h4>Our Contact Information</h4>
					<hr/>
					<div class="row">
						<div class="col-md-2 text-right">
							<i class="fas fa-map-marker-alt fa-2x"></i>
						</div>
						<div class="col-md-10">
							<h5>Our Address</h5>
							<p>Rajkot-Morbi Road, <br/>PO Gauridad, Rajkot<br/>360003, Gujarat</p>
						
						<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 text-right">
							<i class="fas fa-address-card fa-2x"></i>
						</div>
						<div class="col-md-10">
							<h5>Our Contact</h5>
							<p>1800 8888888888<br/>1800 9999999999</p>
						<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 text-right">
							<i class="fas fa-globe fa-2x"></i>
						</div>
						<div class="col-md-10">
							<h5>Website</h5>
							<a class="simple_link" href="http://localhost/auction/">www.auction.com</a>
							<hr/>
						</div>
					</div>						
						
				</div>
			</div>
		</div>
	</div>
</div>

<!--div class="container-fluid embed-container maps">
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6723.520305364035!2d70.79353474726034!3d22.36759617532854!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c83cf3e28db7%3A0xcf4894ee53eaed62!2sMarwadi+University!5e0!3m2!1sen!2sin!4v1486801017199" frameborder="0" style="border:0" width="100%" height="400" allowfullscreen></iframe>	
</div-->
<?php
include_once('footer.php');
?>
