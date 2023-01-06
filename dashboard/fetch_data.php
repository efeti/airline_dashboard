<?php include('includes/connect.php');

$sql = "SELECT * FROM airplanes ";
$query = mysqli_query($con,$sql);
$count_all_rows = mysqli_num_rows($query);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE company like '%".$search_value."%' ";
	$sql .= " OR numser like '%".$search_value."%' ";
	$sql .= " OR minimum_rating like '%".$search_value."%' ";
	$sql .= " OR created_at like '%".$search_value."%' ";
	$sql .= " OR updated_at like '%".$search_value."%' ";
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
$run_query = mysqli_query($con,$sql);
$filtered_rows = mysqli_num_rows($run_query);

while($row = mysqli_fetch_assoc($run_query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['company'];
	$sub_array[] = $row['numser'];
	$sub_array[] = $row['minimum_rating'];
	$sub_array[] = $row['created_at'];
    $sub_array[] = $row['updated_at'];
	$sub_array[] = '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <button type="button" class="btn-sm btn-success viewbtn" data-id="'.$row['id'].'">View</button>
    <button type="button" class="btn-sm btn-info editbtn" data-id="'.$row['id'].'">Edit</button>
    <button type="button" class="btn-sm btn-danger deletebtn" data-id="'.$row['id'].'">Delete</button>
  </div>';
  $sub_array[] =
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
