<?php
#only if form was submitted
if (!isset($_POST['add-flight']))
    exit; //slience is golden

include_once('../../bootstrap.php');
include_once(INC_FLDR . '/connect.php');

//validate
try {
    //not empty
    $not_empty = post_not_empty([
        'airplane' => 'Select An Airplane for this flight',
        'origin' => 'Add a flight Origin',
        'destination' => 'Add a flight Destination',
        'departure-time' => 'Add Flight Departure time',
        'arrival-time' => 'Add Flight Arrival Time',
        'flight-type' => 'Add Flight Type',
        'pilot1' => 'Select first Pilot',
        'pilot2' => 'Select Second Pilot',
        'crew1' => 'Select First Crew Member',
        'crew2' => 'Select Second Crew Member',
        'crew3' => 'Select Third Crew Member'
    ]);

    if ($not_empty)
        throw new Exception($not_empty);

    //run against validation
    $validaton_error = run_against_validation([
        'departure-time' => function () {
            return valid_datetime($_POST['departure-time']);
        },
        'arrival-time' => function () {
            return valid_datetime($_POST['arrival-time']);
        },
        'd-in-future' => function () {
            return date_greater_than($_POST['departure-time'], date('Y-m-d H:i:s'));
        },
        'a-in-future' => function () {
            return date_greater_than($_POST['arrival-time'],  date('Y-m-d H:i:s'));
        },
        'a-gt-d' => function () {
            return date_greater_than($_POST['arrival-time'], $_POST['departure-time']);
        }
    ], [
        'departure-time' => 'Departure Time is not Valid',
        'arrival-time' => 'Arrival Time not valid',
        'd-in-future' => 'Departure Time must be in the future',
        'a-in-future' => 'Arrival must be in the future',
        'a-gt-d' => 'Arrival Date must be greater than Departure date'
    ]);

    if ($validaton_error)
        throw new Exception($validaton_error);

    mysqli_begin_transaction($con);

    //create flight
    $create_flight = execute_sql("INSERT INTO flights(airplane_id, dept_time, arrival_time, origin, destination, type, status, created_at) VALUE('{$_POST['airplane']}', '{$_POST['departure-time']}', '{$_POST['arrival-time']}', '{$_POST['origin']}', '{$_POST['destination']}', '{$_POST['flight-type']}', 'active', NOW())");

    //get flight id
    $flight_id = mysqli_insert_id($con);

    if (!$create_flight)
        throw new mysqli_sql_exception('Flight cannot be created');

    //create crew members
    foreach ([$_POST['crew1'], $_POST['crew2'], $_POST['crew3'], $_POST['pilot1'], $_POST['pilot2']] as $crew_id) {
        $insert_crew = execute_sql("INSERT INTO crews(staff_id, flight_id, created_at, updated_at) VALUE($crew_id, $flight_id, NOW(), NOW())");

        if (!$insert_crew)
            throw new mysqli_sql_exception('An error occured');
    }

    //if we are here then save
    mysqli_commit($con);
    
    echo json_encode([
        'message' => 'Flight was created successfully',
    ]);
} catch (\Throwable $th) {
    if ($th instanceof mysqli_sql_exception)
        mysqli_rollback($con);

    header('HTTP/1.1 422 Unprocessable Entity');

    echo json_encode([
        'message' => $th->getMessage()
    ]);
}

exit;
