<?php
include_once('connection.php');

$arraydata = array();

$query = "SELECT re.id AS id, re.accountId AS accountId, re.roomId AS roomId, ro.type AS type, ro.name AS name, ro.image AS image, re.date AS date, re.time AS timeId, t.time AS time FROM reservation re,room ro,time t WHERE re.roomId=ro.id AND re.time=t.id ORDER BY re.date DESC, t.time DESC";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result))
{
	$arraydata[]=$row;
}
echo json_encode($arraydata);
mysqli_close($connection); 
?>