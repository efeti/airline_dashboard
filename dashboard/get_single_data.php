<?php 
include('bootstrap.php');
include(INC_FLDR . '/connect.php');
$id = $_POST['id'];
$sql = "SELECT * FROM airplanes WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
