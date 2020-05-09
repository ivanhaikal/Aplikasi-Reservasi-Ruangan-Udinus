<?php
include_once "connection.php";

$accountId = $_POST['accountId'];
$roomId = $_POST['roomId'];
$date = $_POST['date'];
$time = $_POST['time'];
$response = array();

$query = mysqli_query($connection, "DELETE FROM reservation WHERE accountId='$accountId' AND roomId='$roomId' AND date='$date' AND time='$time'");
if($query) {
	$response['success'] = 1;
	$response['message'] = "Reservation Successfully Canceled";
} else {
 	$response['success'] = 0;
 	$response['message'] = "Error";
}
die(json_encode($response));
mysqli_close($connection);
?>	