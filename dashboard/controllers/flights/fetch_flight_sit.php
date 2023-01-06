<?php
if (!isset($_POST['fetch-flight-sit']))
    exit; //slience is golden

include_once('../../bootstrap.php');
include_once(INC_FLDR . '/connect.php');

$flight_id = $_POST['flight_id'] ?? 0;
$class = $_POST['class'] ?? 'none';

$sit_picked = db_fetch_rows("SELECT sit_no FROM tickets where flight_id = '$flight_id'");

$array_sit_picked = get_array_column($sit_picked, 'sit_no');

//select_numbers not in array
echo json_encode([
    'data' => (isset($config["{$class}_sit"])) ? array_diff($config["{$class}_sit"], $array_sit_picked) : []
]);
