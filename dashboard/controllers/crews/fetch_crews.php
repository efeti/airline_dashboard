<?php include('../../includes/connect.php');

$sql = "SELECT  crews.id, staff.role, staff.name, staff.surname, flights.origin, flights.destination, company, airplanes.numser, crews.created_at
FROM crews
LEFT JOIN staff ON crews.staff_id = staff.id 
LEFT JOIN flights ON crews.flight_id = flights.id
LEFT JOIN airplanes ON flights.airplane_id = airplanes.id";
$query = mysqli_query($con,$sql);
$count_all_rows = mysqli_num_rows($query);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE company like '%".$search_value."%' ";
	$sql .= " OR numser like '%".$search_value."%' ";
	$sql .= " OR name like '%".$search_value."%' ";
	$sql .= " OR origin like '%".$search_value."%' ";
	$sql .= " OR destination like '%".$search_value."%' ";
}

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
    $sub_array[] = $row['role'];
	$sub_array[] = $row['name']. " ". $row['surname'];
	$sub_array[] = $row['origin'];
	$sub_array[] = $row['destination'];
    $sub_array[] = $row['company'];
    $sub_array[] = $row['numser'];
    $sub_array[] = $row['created_at'];
	//$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
    $sub_array[] = '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <button type="button" class="btn-sm btn-success">View</button>
    <button type="button" class="btn-sm btn-info">Edit</button>
    <button type="button" class="btn-sm btn-danger">Delete</button>
  </div>';
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
