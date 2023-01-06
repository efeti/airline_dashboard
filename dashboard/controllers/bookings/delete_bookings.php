<?php 
include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');

$bookings_id = $_POST['id'];
$sql = "DELETE FROM bookings WHERE id='$bookings_id'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}   
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?> 