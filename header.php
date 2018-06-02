<?php
/*Header page*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
ob_start();
session_start();
error_reporting();
if(isset($_POST['signstep1'])){
	if($_POST['emailforsignup']!=""){
		include_once 'admin/includes/db_connect.php';		
		$_SESSION["emailsignup"] = $_POST['emailforsignup'];
		
		$var0 = $_POST['emailforsignup'];
		//$que = "SELECT user_id FROM user WHERE email_id='$var0'";
		//$result = mysqli_query($que, $mysqli);
		$query1="SELECT user_id FROM user WHERE email_id='$var0'";
		$result = mysqli_query($mysqli,$query1) or die("Error updating data.".mysqli_error($mysqli));
		$num_rows = mysqli_num_rows($result);
		
		//$row = mysql_num_rows($results);
		if ($num_rows > 0){
			//header("Location: index.php");
			$error_msg = "Username already exists! Try another";
            //$script = "<script> $(document).ready(function(){ $('#step1').modal('show'); }); </script>";
			//if $row is greater than 0, (means the email exists)
			//die("EMAIL Already exists");
			//echo "Error: email already exists";
		}
		else{
			// $row is equal to 0, (==), this means it didnt find results (email)
			//echo "Email does not exists, so lets add the email to the database";
			//mysql_query("INSERT INTO users (user_email) VALUES ('$email')");
			require 'PHPMailer-master/vendor/autoload.php';
			require 'Files/pass.php';

			function generateRandomString($length = 50) {
			   return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
			}
			$OTP_signup = generateRandomString();
			
			$mail = new PHPMailer(true);  
			$message="";                            
			try {
				$mail->SMTPDebug = 2;                                 
				$mail->isSMTP();                                      
				$mail->Host = 'smtp.gmail.com';  
				$mail->SMTPAuth = true;                               
				$mail->Username = $username;                 
				$mail->Password = $password;                        
				$mail->SMTPSecure = 'tls';                          
				$mail->Port = 587;                                  
				
				$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
				$mail->setFrom($username, 'Auction Admin');
				$mail->addAddress($_SESSION["emailsignup"]);   
				$mail->isHTML(true);                                  
				$mail->Subject = 'OTP for Registration';
				$mail->Body    = '<div style="font-family: sans-serif; border: 1px solid #bbb; padding: 15px; text-align: center; background: #f3f3f3">
	<div style="margin: 15px; text-align: center; color: rgb(94, 130, 167); border-bottom: 1px solid rgb(94, 130, 167);">
		<h1>Welcome to Auction!</h1>
	</div>
	<b>
	<table style="padding: 10px; margin: 0 auto;">
		<tr><td style="font-weight:bold; text-align: right; padding: 5px 30px 5px 5px; color: rgb(94, 130, 167)">Your OTP for Registration:</td><td style="text-align: left">'.$OTP_signup.'</td></tr>
		<tr><td style="font-weight:bold; text-align: right; padding: 5px 30px 5px 5px; color: rgb(94, 130, 167)">Email:</td><td style="text-align: left">'.$_SESSION['emailsignup'].'</td></tr>
	</table>
	
	<div style="color: #222; font-weight: bold; font-size: 15px;text-align: left; border-top: 1px solid #bbb; padding-top: 15px;">
		Thanks & Regards:<br/>
		Auction.com<br/><br/>
	</div>
	<div style="background:#fff; padding:10px;">
	Note:
		<p style="text-align:left; font-weight:lighter;  padding: 15px 5px 5px 5px; font-size:12px;">* By your positive acts of registering on auction .com, you agree to be bound by the Terms & Conditions & Privacy Policy
and if you do not agree with any of the provisions of these policies, you should not access or use auction .com.<br/><span>* This is a system generated personalized mail regarding your Naukri account preferences. We have enabled auto-login for your convenience, you are strongly advised not to forward this email to protect your account from unauthorized access. <br/>* Please do not reply to this message.</span></p>
	</div>
</div>';
				$mail->AltBody = $OTP_signup;
				
				$mail->send();
				echo 'Message has been sent';
				
				$query2="SELECT id FROM otp WHERE email='$var0'";
				$result2 = mysqli_query($mysqli,$query2) or die("Error updating data.".mysqli_error($mysqli));
				$num_rows2 = mysqli_num_rows($result2);
				//$fetched=mysqli_fetch_assoc($result2)
				//$id = $fetched['id'];
				echo 'this ';
				echo $ids;
				while($fetched=mysqli_fetch_assoc($result2)){
					
				}
				$ids = $fetched['id'];
				$datetime = date("Y-m-d H:i:s");
				if($num_rows2>0){
					$query1="UPDATE otp set OTP='$OTP_signup', Time_Stamp='$datetime' WHERE email='$var0'";
					mysqli_query($mysqli,$query1) or die("Error updating data.".mysqli_error($mysqli));
				}
				else{
					$query3="INSERT INTO otp (email, type, OTP, Time_Stamp) VALUES ('$var0', 'S', '$OTP_signup', '$datetime')";
					mysqli_query($mysqli,$query3) or die("Error updating data.".mysqli_error($mysqli));
				}
				
			} 
			catch (Exception $e) {
				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}

			header('Location: Sign_up.php');
			
				//echo "email has been added to the database";
			}
	}
}
if(isset($_POST['loginbutton'])){
	include_once 'admin/includes/db_connect.php';	
	$username = $_POST['userlogin'];
	$password = $_POST['passlogin'];
	
	$query6="SELECT * FROM user WHERE email_id='$username'";
	$result6 = mysqli_query($mysqli,$query6) or die("Error updating data.".mysqli_error($mysqli));
	$num_rows = mysqli_num_rows($result6);
	
	if ($num_rows > 0) {
			$fetch=mysqli_fetch_assoc($result6);
			$validPassword = password_verify($password, $fetch['password']);
			
			if($validPassword){
				//in
				unset($_SESSION['emailsignup']);
				$_SESSION["emailloggedin"] = $username;
				$_SESSION["nameloggedin"] = $fetch['full_name'];
				$_SESSION["idloggedin"] = $fetch['user_id'];
				$_SESSION["isloggedin"] = '1';
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
include_once('admin/includes/db_connect.php');
$look_for_categories="SELECT * FROM product_category";
$view_categories = mysqli_query($mysqli, $look_for_categories) or die("Some error has been occured! .".mysqli_error($mysqli));
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
	<link href="css/custom.css" rel="stylesheet">
	<link href="web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <title>Auction</title>
  </head>
	<body>
		<div class="container-fluid ">
			<div class="row bg-light bg-light border">
				<div class="mt-2 col-md-2 text-center border-right footer_list">
					<a class="simple_link mt-4" href="index.php"><img src="img/logo.png" height="50" width="100" class="img-fluid" alt="logo"></a>
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12">
						<ul class="nav justify-content-end">
						  <li class="nav-item">
							<a class="nav-link active" href="Contact.php">24 x 7 Customer Care</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="Contact.php"><i class="fas fa-phone fa-lg mr-1"></i>Contact us</a>
						  </li>
						  <div class="dropdown show">
							  <a style="text-decoration: none;" class="btn btn-link dropdown-toggle footer_list" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell fa-lg mr-1"></i>Notifications
							  </a>

							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							  </div>
							</div>
						  
						  <?php
						  if(isset($_SESSION['emailloggedin'])){
							  include_once('userloggedin.php');
						  }
						  else{
							  include_once('usernotloggedin.php');
						  }
						  ?>
						  </ul>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<form class="my-2 my-lg-0" method="POST" action="results.php">
									  <input class="form-control mr-sm-2" name="search_Query" type="search" value="<?php if(isset($_SESSION['Query_Search']))echo $_SESSION['Query_Search'];?>" placeholder="Search..." aria-label="Search" pattern=".{3,}" title="Enter 3 or more characters to continue search." autofocus />
										</div>
											<div class="form-group col-md-2">
												<select name="category_Selected" class="form-control">
													<?php while($got_categories = mysqli_fetch_assoc($view_categories)){
														?>
														<option value="<?php echo $got_categories['name'];?>"><?php echo $got_categories['name'];?></option>
														<?php
													}
													mysqli_free_result($got_categories);
													?>
											  </select>
											</div>
										<div class="col-md-2 text-center">
										<button class="btn btn-outline-success btn-block my-2 my-sm-0 mb-sm-1" name="search_Query_Submit" type="submit">Search<i class="fas fa-angle-right mt-2 ml-1"></i></button>
											</form>
										</div>
								
								<div class="col-md-3 text-right">
									<?php 
									if(isset($_SESSION['isloggedin'])){
										echo '<a class="btn btn-outline-warning my-2 my-sm-0 text-dark" href="Cart.php"><i class="fas fa-shopping-cart mr-2 fa-lg"></i><span class="mr-2">Cart</span><span class="badge badge-secondary"></span></a>';
									}
									?>
								
									<a class="btn btn-outline-warning my-2 my-sm-0 " type="link" href="trending.php"><i class="fas fa-fire mr-sm-2 fa-lg"></i><span class="mr-sm-2">Trending</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row bg-light">
				<div class="col-md-10">
					<!--nav class="navbar navbar-expand-lg navbar-light bg-light">
					 <a class="navbar-brand" href="#">Categories</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  </button>
					  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto justify-content-end">
						  <li class="nav-item">
							<a class="nav-link" href="#">Electronics <span class="sr-only">(current)</span></a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">TV & Appliances</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">Home & Furniture</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">Books & More</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">Sports</a>
						  </li>
						</ul>
					  </div>
					</nav-->
				</div>
				<div class="mb-2 col-md-2">
					
				</div>
			</div>
		