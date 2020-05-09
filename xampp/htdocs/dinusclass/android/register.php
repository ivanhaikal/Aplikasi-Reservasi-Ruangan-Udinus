<?php
include_once "connection.php";

$nim_npp = $_POST['nim_npp'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$status = $_POST['status'];
$password = $_POST['password'];
$options = [
    'cost' => 10,
];
$password_hash = password_hash($password,PASSWORD_DEFAULT,$options);
$response = array();

$num_rows = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM account WHERE nim_npp='$nim_npp'"));
if ($num_rows == 0){
	$query = mysqli_query($connection, "INSERT INTO account(nim_npp,name_account,gender,dob,phone,email_account,status,password_account) VALUES('$nim_npp','$name','$gender','$dob','$phone','$email','$status','$password_hash')");
	if ($query){
		$response['success'] = 1;
		$response['message'] = "Registration Success";
 	} else {
 		$response['success'] = 0;
 		$response['message'] = "Error registration";
 	}
} else {
	$response['success'] = 0;
	$response['message'] = "Nim/Npp has been used";
}
die(json_encode($response));
mysqli_close($connection);
?>	