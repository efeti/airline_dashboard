<?php 
include('includes/connect.php');

$company =  $_POST['company'];
$minimum_rating =  $_POST['minimum_rating'];
$id =  $_POST['id'];
$date = date('Y-m-d H:i:s'); 

$sql = "UPDATE `airplanes` SET  `company`='$company', `minimum_rating`= '$minimum_rating', `updated_at`='$date' WHERE `id`='$id'";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
        'updated_at'=>$date,
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>