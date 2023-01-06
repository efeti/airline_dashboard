<?php 
include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');

file_put_contents('logger.txt', json_encode($_POST));

$id =  $_POST['id'];
$role =  $_POST['role'];
//$empnum =  $_POST['empnum'];
$name =  $_POST['name'];
$surname =  $_POST['surname'];
$address =  $_POST['address'];
$phone =  $_POST['phone'];
$rating =  $_POST['rating'];
$salary =  $_POST['salary'];
$date = date('Y-m-d H:i:s');

$sql = "UPDATE `staff` SET  `role`='$role', `name`= '$name', `surname`= '$surname', `address`= '$address', `phone`= '$phone', `rating`= '$rating', `salary`= '$salary', `updated_at`= '$date' WHERE `id`='$id'";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
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