<?php
include_once('connection.php');

$arraydata = array();

$query = "SELECT * FROM time";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result))
{
	$arraydata[]=$row;
}
echo json_encode($arraydata);
mysqli_close($connection); 
?>