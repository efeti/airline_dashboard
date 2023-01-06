<?php
include_once(__DIR__ . '/dashboard/bootstrap.php');
include_once(INC_FLDR . '/connect.php');
include_once(INC_FLDR . '/flight_logic.php');

#var_dump(gettype());
$sit_array = $pilot_working_hour = db_fetch_rows("SELECT staff.id, (SELECT SUM(TIMESTAMPDIFF(HOUR, flights.arrival_time, flights.dept_time)) FROM flights left join crews on flights.id = crews.flight_id where crews.staff_id = staff.id) as working_hours from staff where staff.role = 'pilot'");

var_dump($sit_array);

