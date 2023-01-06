<?php include('../../includes/connect.php');

$sql = "SELECT  passengers.id, passengers.name, passengers.surname, tickets.class, flights.origin, flights.destination, company, bookings.status, passengers.created_at
FROM bookings
LEFT JOIN passengers ON bookings.passenger_id = passengers.id
LEFT JOIN tickets ON tickets.id = bookings.flight_ticket_id
LEFT JOIN flights ON tickets.flight_id = flights.id
LEFT JOIN airplanes ON flights.airplane_id = airplanes.id";
$query = mysqli_query($con,$sql);
$count_all_rows = mysqli_num_rows($query);

// if(isset($_POST['search']['value']))
// {
// 	$search_value = $_POST['search']['value'];
// 	$sql .= " WHERE company like '%".$search_value."%' ";
// 	$sql .= " OR numser like '%".$search_value."%' ";
// 	$sql .= " OR minimum_rating like '%".$search_value."%' ";
// 	$sql .= " OR created_at like '%".$search_value."%' ";
// 	$sql .= " OR updated_at like '%".$search_value."%' ";
// }

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id DESC";
}

// if($_POST['length'] != -1)
// {
// 	$start = $_POST['start'];
// 	$length = $_POST['length'];
// 	$sql .= " LIMIT  ".$start.", ".$length;
// }	
$data = array();
//file_put_contents('logger.txt', $sql);
$run_query = mysqli_query($con,$sql);
$filtered_rows = mysqli_num_rows($run_query);

while($row = mysqli_fetch_assoc($run_query))
{
	$sub_array = array();
    $sub_array[] = $row['id'];
	$sub_array[] = $row['name']. " ". $row['surname'];
	$sub_array[] = $row['class'];
	$sub_array[] = $row['origin'];
	$sub_array[] = $row['destination'];
    $sub_array[] = $row['company'];
    $sub_array[] = $row['status'];
    $sub_array[] = $row['created_at'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deletebtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
    'data'=>$data,
	//'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_all_rows ,
	'recordsFiltered'=>   $filtered_rows,	
);
 echo  json_encode($output);

 

?>
