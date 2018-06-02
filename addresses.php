<?php
ob_start();
$page="User_Profile";
include_once('header.php');
error_reporting(0);
?>
<?php
include_once 'admin/includes/db_connect.php';

if($_SESSION['isloggedin']==1){
$email_id = $_SESSION["emailloggedin"];

	$look_for_address="SELECT * FROM addresses WHERE user_email='$email_id'";
	$view_address = mysqli_query($mysqli,$look_for_address) or die("Some error has been occured! .".mysqli_error($mysqli));
	
	if(isset($_POST['delete'])){
		$v1 = $_POST['id'];
		$delete="DELETE FROM addresses WHERE id='$v1'";
		$view_address = mysqli_query($mysqli,$delete) or die("Cannot delete address.".mysqli_error($mysqli));	
		
	}
?>
<div class="container p-3">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item active" aria-current="page">Your Addresses</li>
	  </ol>
	</nav>
	<h3 class="text-center">Your All Address</h3>
	<p class="text-center">Your Addresses will appear here</p>
	<div class="p-2 text-center">
		<a class="btn btn-outline-primary" href="add_address.php" role="button"><i class="fas fa-plus-circle fa-2x"></i><br/>Add new Address</a>
	</div>
	<div class="row">
		<?php 
			$counter = 1;
			while($got_addresses = mysqli_fetch_assoc($view_address)){
		?>
			<div class="col-md-4">
				<div class="p-3 border">
					<?php 
					echo '<h6>'.$got_addresses['fullname'].'</h6>';
					echo $got_addresses['street_address'].',<br/>'.$got_addresses['landmark'].', '.$got_addresses['city'].'<br/>'.$got_addresses['state'].' '.$got_addresses['pincode'].'<br/>'.$got_addresses['country'];
					echo '<br/>Phone number: '.$got_addresses['mobile'];
					?>
					<br/>
					
						<div class="row mt-2">
							<form method="POST" action="edit_address.php">
								<div class="col-md-3">
									<button name="edit" class="btn btn-outline-success simple_link">Edit</button>
									<input type="hidden" name="edit_id" value="<?php echo $got_addresses['id'];?>"/>
									<?php $_SESSION["edit_address_id"] = $got_addresses['id'];
										$_SESSION["edit_address_id"] = $_SESSION["edit_address_id"];
									?>
								</div>
							</form>
							<form method="POST">
								<div class="col-md-3">
									<button name="delete" class="btn btn-outline-danger simple_link">Delete</button>
									<input type="hidden" name="id" value="<?php echo $got_addresses['id'];?>"/>
								</div>
							</form>
						</div>
					</form>
				</div>
			</div>
		<?php	
			$counter++;
			}
			mysqli_free_result($got_addresses);
		?>
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