<?php
include_once('connection.php');

$nim_npp = $_POST['nim_npp'];
$response = array();

$query = "SELECT * FROM account where nim_npp='$nim_npp'";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);
if(!empty($row)) {
	$response['id'] = $row['id'];
 	$response['name'] = $row['name_account'];
 	$response['gender'] = $row['gender'];
 	$response['dob'] = $row['dob'];
 	$response['phone'] = $row['phone'];
 	$response['email'] = $row['email_account'];
 	$response['status'] = $row['status'];
}
die(json_encode($response));
mysqli_close($connection);
?>