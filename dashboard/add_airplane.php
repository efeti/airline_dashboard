<?php 
include('bootstrap.php');
include(INC_FLDR . '/connect.php');
$company = $_POST['company'];
$minimum_rating  = $_POST['minimum_rating'];

function generateRandomString($length = 9) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$numser = generateRandomString();

$date = date('Y-m-d H:i:s'); 

$sql = "INSERT INTO `airplanes` (`company`,`numser`,`minimum_rating`,`created_at`) values ('$company', '$numser', '$minimum_rating','$date')";
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