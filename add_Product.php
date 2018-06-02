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
	$look_for_category="SELECT * FROM product_category";
	$view_category = mysqli_query($mysqli,$look_for_category) or die("Some error has been occured! .".mysqli_error($mysqli));
	
if(isset($_POST['addProductButton'])){
	$v0 = $_POST['productName'];
	//$v1 = $_POST['product_Image_One'];
	//$v2 = $_POST['product_Image_Two'];
	//$v3 = $_POST['product_Image_Three'];
	$v4 = $_POST['initial_Price'];
	$v5 = addslashes($_POST['product_Description']);
	$v6 = $_POST['category'];
	$v7 = $_POST['dateRegistration'];
	$v8 = $_SESSION['emailloggedin'];	
	$v9 = $_POST['date_end'];	

	$targetOne = "img/product/".$_FILES['product_Image']['name'];
	$imagepathOne = "img/product/".$_FILES['product_Image']['name'];
	
	if(!move_uploaded_file($_FILES['product_Image']['tmp_name'],$targetOne)){
		$message = "Error uploading images. Please try again.";
	}
	else
	{
		$query_insert="INSERT INTO product(name, image1, seller, initial_Price, current_Price, description, category, date_Added, date_Started, date_End) VALUES ('$v0', '$imagepathOne', '$v8', '$v4', '$v4', '$v5', '$v6', '$v7', '$v7', '$v9')";
		mysqli_query($mysqli,$query_insert) or die("Error adding data.".mysqli_error($mysqli));
		$message = "Successfully added product: $v0";
	}
}

?>
<div class="container p-3">
	<h4 class="text-center mb-5">Add Product</h4>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="Profile.php">Your Account</a></li>
		<li class="breadcrumb-item"><a href="sell_product.php">Your Products</a></li>
		<li class="breadcrumb-item active" aria-current="page">Add new Product</li>
	  </ol>
	</nav>
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
			<form method="POST" name="add_product" enctype="multipart/form-data">
				<h5>Product Name: </h5>
				<div class="form-group">
					<input type="text" class="form-control" name="productName" id="exampleFormControlInput1" required>
	    		</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<h5>Image</h5>
						</div>
						<div class="col-md-6">
							<input id="profilePhotoIn" class="pull-left" type="file" name="product_Image" >
						</div>
					</div>
				</div>
				
				<h5>Price(Initial): </h5>
				<div class="form-group">
					<input type="text" class="form-control" name="initial_Price" id="exampleFormControlInput1" required>
	    		</div>	
				
				<h5 for="exampleFormControlTextarea1">Product Description(Be precise as possible)</h5>
					<div class="form-group">
					<textarea class="form-control" name="product_Description" id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>
				
				<h5>Category</h5>
				<div class="form-group">
					<select name="category" class="form-control">
						<?php while($got_category = mysqli_fetch_assoc($view_category)){
							?>
							<option value="<?php echo $got_category['name'];?>"><?php echo $got_category['name'];?></option>
							<?php
						}
						mysqli_free_result($got_category);
						?>
					</select>
				</div>
				<h5>Expiration Date</h5>
				<div class="form-group">
					<input type="date" class="form-control" name="date_end" id="exampleFormControlInput1" required>
				</div>
				
				<input type="hidden" name="dateRegistration" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
				
				
				<button class="btn btn-primary my-2 my-sm-0 mt-sm-2" name="addProductButton" type="submit"><span class="mr-sm-2">Add Product</span></button>
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