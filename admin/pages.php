<?php
ob_start();
include_once('header.php');
/*Home page*/
$page=' ';
if($_SESSION['isadminloggedin'] == 1){

include_once 'includes/db_connect.php';

if(isset($_POST['change_Button'])){
	$got_Id = $_POST['iid'];
	$desc = $_POST['desc'];
	$lnkId = $_POST['lnkId'];
	$targetOne = "../img/carousel/".$_FILES['product_Image']['name'];
	$imagepathOne = "img/carousel/".$_FILES['product_Image']['name'];
	
	if(!move_uploaded_file($_FILES['product_Image']['tmp_name'],$targetOne)){
		$message = "Error uploading images. Please try again.";
	}
	else
	{
		$query_update_carousel="UPDATE carousel SET image3 = '$imagepathOne', description = '$desc', linkId = '$lnkId' WHERE car_Id = '$got_Id'";
		mysqli_query($mysqli, $query_update_carousel) or die("Error adding data.".mysqli_error($mysqli));
		$message = "Successfully updated product";
	}
}

		$look_for_carousel = "SELECT * FROM carousel";
		$view_for_carousel = mysqli_query($mysqli,$look_for_carousel) or die("Some error has been occured! .".mysqli_error($mysqli));
?>
<div class="container mt-5 mb-2">
	<div class="mt-2 border p-3">
	<?php
			if(isset($message)){ echo '<div class="alert alert-success" role="alert">
			  <strong>Note: </strong>
				' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button></div>'; }
			?>
		<div class="form-group">
		<h3 class="font-weight-light text-success">Index Page: Carousel section</h3><hr/>
			<div class="row font-weight-bold">
				<div class="col-md-1">
				Sr. No.
				</div>
				<div class="col-md-3">
				Image
				</div>
				<div class="col-md-4">
				Description
				</div>
				<div class="col-md-3">
				Upload
				</div>
				<div class="col-md-1">
				Update
				</div>
			</div>
		<hr/>
			<?php
			$counter_car = 1;
			while($got_carousel = mysqli_fetch_assoc($view_for_carousel)){?>
				<form method="POST" enctype="multipart/form-data">
					<div class="row font-weight-bold">
						<div class="col-md-1">
						<?php echo $counter_car;?>
						</div>
						<div class="col-md-3">
							<div class="car_image_show border">
								<img src="../<?php echo $got_carousel['image3'];?>" class="car_image_show"/>
							</div>
						</div>
						<input type="hidden" name="iid" value="<?php echo $got_carousel['car_Id']?>"/>
						<div class="col-md-3">
							<div class="form-group">
								<textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"><?php echo $got_carousel['description'];?></textarea>
							  </div>
						</div>
						<div class="col-md-3">
							<input id="profilePhotoIn" class="pull-left" type="file" name="product_Image" required>
						</div>
						<div class="col-md-2 text-center">
							<div class="form-group">
							<input type="text" class="form-control" id="exampleFormControlInput1" name="lnkId" value="<?php echo $got_carousel['linkId']?>" placeholder="Product Id"/>
						  </div>
							<button class="btn btn-success" name="change_Button" type="submit">Update</button>
						</div>
					</div>
					<hr/>
				</form>
				<?php
			$counter_car = $counter_car + 1;
			}
			?>
		</div>
	</div>
</div>

<?php
include_once('footer.php');
}
?>