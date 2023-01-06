<?php 
include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');
$id = $_POST['id'];
$sql = "SELECT  flights.id, airplanes.numser, flights.dept_time, flights.arrival_time, flights.origin, flights.destination, flights.type, flights.status, flights.created_at
FROM flights
LEFT JOIN airplanes ON flights.id = airplanes.id WHERE flights.id = $id LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
