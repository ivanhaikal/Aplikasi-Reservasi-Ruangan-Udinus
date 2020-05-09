<?php
include_once "connection.php";

$accountId = $_POST['accountId'];
$roomId = $_POST['roomId'];
$date = $_POST['date'];
$time = $_POST['time'];
$response = array();

$query = mysqli_query($connection, "SELECT re.id AS reservationId, ro.code AS code, ro.type AS type, ro.name AS room_name, ro.capacity AS capacity, a.status AS status, a.nim_npp AS nim_npp, a.name_account AS account_name, re.date AS date, t.time AS time, ro.image AS image FROM reservation re,account a,room ro,time t WHERE re.accountId=a.id AND re.roomId=ro.id AND re.time=t.id AND re.accountId='$accountId' AND re.roomId='$roomId' AND re.date='$date' AND re.time='$time'");
$row = mysqli_fetch_array($query);
if(!empty($row)) {
	$response['success'] = 1;
	$response['message'] = "Success";
 	$response['id'] = $row['reservationId'];
	$response['code'] = $row['code'];
	$response['type'] = $row['type'];
	$response['room_name'] = $row['room_name'];
	$response['capacity'] = $row['capacity'];
	$response['status'] = $row['status'];
	$response['nim_npp'] = $row['nim_npp'];
	$response['account_name'] = $row['account_name'];
	$response['date'] = $row['date'];
	$response['time'] = $row['time'];
	$response['image'] = $row['image'];
} else {
 	$response['success'] = 0;
 	$response['message'] = "Error";
}
die(json_encode($response));
mysqli_close($connection);
?>	