<?php
include_once 'psl-config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_error) {
	echo '<div class="container"><h3 class="text-center mt-5 text-danger">Error 404: <br/><br/>The connection could not be established</h3></div>';
	//header("Location: ../error.php?err=Unable to connect to MySQL");
    exit();
}
?>