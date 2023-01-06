<?php
include_once('../../bootstrap.php');
include_once(INC_FLDR . '/connect.php');

if (isset($_POST['action']) && ($_POST['action'] == 'available-staff')) {

    $time_from = db_sanitize_string($_POST['departure_time'] ?? '');
    $time_to = db_sanitize_string($_POST['arrival_time'] ?? '');
    $rating = db_sanitize_string($_POST['rating'] ?? 0);

    #select staff not working at that time
    $available_pilot = db_fetch_rows("SELECT staff.* from staff where id not in ( #select staff not working
        SELECT crews.staff_id from crews where crews.flight_id in ( #select staff working at this time
        SELECT flights.id FROM `flights` where arrival_time not BETWEEN '$time_from' AND '$time_to' AND (arrival_time > NOW()) AND (dept_time NOT BETWEEN '$time_from' AND '$time_to')
        ) group by crews.staff_id
    ) AND staff.rating >= '$rating' AND role='pilot';");

    $available_staff = db_fetch_rows("SELECT staff.* from staff where id not in ( #select staff not working
        SELECT crews.staff_id from crews where crews.flight_id in ( #select staff working at this time
            SELECT flights.id FROM `flights` where (arrival_time not BETWEEN '$time_from' AND '$time_to') AND (arrival_time > NOW()) AND (dept_time NOT BETWEEN '$time_from' AND '$time_to')
            ) group by crews.staff_id
        ) AND staff.rating >= '$rating' AND role='host';");

    #submit details
    echo json_encode([
        'host' => $available_staff,
        'pilot' => $available_pilot
    ]);
}
