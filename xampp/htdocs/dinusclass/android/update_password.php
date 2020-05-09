<?php
include_once "connection.php";

$nim_npp = $_POST['nim_npp'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$options = [
    'cost' => 10,
];
$response = array();

$query = mysqli_query($connection, "SELECT * FROM account WHERE nim_npp='$nim_npp'");
$row = mysqli_fetch_array($query);
if(!empty($row)) {
	$password_hash = $row['password_account'];
	if (password_verify($old_password,$password_hash)) {
		$password_hash = password_hash($new_password,PASSWORD_DEFAULT,$options);
 		$query = mysqli_query($connection, "UPDATE account SET password_account='$password_hash' WHERE nim_npp='$nim_npp'");
 		if ($query){
 			$response['success'] = 1;
 			$response['message'] = "Password has been updated";
 		} else {
 			$response['success'] = 0;
 			$response['message'] = "Error";
 		}
 	} else {
 		$response['success'] = 0;
 		$response['message'] = "Wrong old password";
 	}
}
die(json_encode($response));
mysqli_close($connection);
?>	