<?php
include_once "connection.php";
	
$nim_npp = $_POST['nim_npp'];
$password = $_POST['password'];
$response = array();
	
$query = mysqli_query($connection, "SELECT * FROM account WHERE nim_npp='$nim_npp'");
$row = mysqli_fetch_array($query);
if(!empty($row)) {
	$password_hash = $row['password_account'];
	if (password_verify($password,$password_hash)){
 		$response['success'] = 1;
 		$response['message'] = "Welcome ".$row['name_account'];
		$response['id'] = $row['id'];
		$response['name'] = $row['name_account'];
		if ($row['gender'] == 'L') {
			$response['gender'] = "Laki-laki";
		} else {
			$response['gender'] = "Perempuan";
		}
 		$response['dob'] = $row['dob'];
 		$response['phone'] = $row['phone'];
 		$response['email'] = $row['email_account'];
 		$response['status'] = $row['status'];
		$response['image'] = $row['image'];
	} else {
 		$response['success'] = 0;
 		$response['message'] = "Wrong password";	
	}
} else {
 	$response['success'] = 0;
 	$response['message'] = "Nim/Npp not found";	
}
die(json_encode($response));
mysqli_close($connection);
?>