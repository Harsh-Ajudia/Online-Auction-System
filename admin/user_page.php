<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';
	$got_id = $_GET['user_id_passed'];
	$get_users="SELECT * FROM user";
	$got_users_result = mysqli_query($mysqli,$get_users) or die("Error viewing information. Please try again.".mysqli_error($mysqli));
	
	echo $got_id;
	?>
	
	

