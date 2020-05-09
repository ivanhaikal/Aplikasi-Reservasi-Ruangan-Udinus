<?php
include_once "connection.php";

$accountId = $_POST['accountId'];
$roomId = $_POST['roomId'];
$date = $_POST['date'];
$time = $_POST['time'];
$response = array();

$query = mysqli_query($connection, "INSERT INTO reservation(accountId,roomId,date,time) VALUES ('$accountId','$roomId','$date','$time')");
if($query) {
	$response['success'] = 1;
 	$response['message'] = "Reservation Success";
} else {
 	$response['success'] = 0;
 	$response['message'] = "Error";
}
die(json_encode($response));
mysqli_close($connection);
?>	