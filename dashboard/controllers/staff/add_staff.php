<?php 
include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');

$role = $_POST['role'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$rating = $_POST['rating'];
$salary = $_POST['salary'];

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$empnum = generateRandomString();

$date = date('Y-m-d H:i:s'); 

$sql = "INSERT INTO `staff` (`role`,`empnum`,`name`,`surname`,`address`,`phone`,`rating`,`salary`,`created_at`) values ('$role','$empnum','$name','$surname','$address','$phone','$rating','$salary','$date')";
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