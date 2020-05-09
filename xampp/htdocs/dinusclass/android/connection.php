<?php
	$server		= "localhost";
	$user		= "root";
	$password	= "";
	$database	= "dinusclass";
	$connection = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Failed to Connect to MySQL: " . mysqli_connect_error();
	}
?>