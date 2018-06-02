<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';
?>
<div class="col-md-12">
<h3 class="font-weight-light text-success">Your Details</h3><hr/>
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-right text-primary">
				<h4 class="font-weight-light">Name</h4>
				<h4 class="font-weight-light">Email</h4>
				<h4 class="font-weight-light">Date Registered</h4>
				<h4 class="font-weight-light">Contact</h4>
			</div>
			
			<div class="col-md-4 text-left">
				<h4 class="font-weight-light"><?php echo $_SESSION['adminfullname']?></h4>
				<h4 class="font-weight-light"><?php echo $_SESSION['adminloggedin']?></h4>
				<h4 class="font-weight-light"><?php echo $_SESSION['datereg']?></h4>
				<h4 class="font-weight-light"><?php echo $_SESSION['contactadmin']?></h4>
			</div>
		</div>
	</div>
</div>