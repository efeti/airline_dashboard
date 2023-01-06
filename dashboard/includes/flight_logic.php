<?php

function active_flight(): array
{
    return db_fetch_rows("SELECT * FROM flights WHERE dept_time > NOW() OR arrival_time > NOW()");
}

function bookable_flights(): array
{
    return db_fetch_rows("SELECT * FROM flights WHERE TIMESTAMPDIFF(MINUTE, NOW(), dept_time) > 30");
}

function get_flight_code(array $flight_data): string
{
    if (!isset($flight_data['id']) || !isset($flight_data['created_at']))
        return '';

    return "FL-" . substr(str_replace([' ', ':', '-'], '', $flight_data['created_at']), 8) . "-" . $flight_data['id'];
}

function get_flights_available_sit(int $flight_id): array
{
    return db_fetch_rows("SELECT sit_no FROM tickets WHERE flight_id = '$flight_id'");
}

//update flight status
function update_flight_status()
{
    //look for completed ones
    execute_sql("UPDATE flights SET status = 'completed' WHERE flights.arrival_time < NOW();");
}


function flight_color_text($status)
{
    switch ($status) {
        case 'completed':
            return color_text('<b>completed</b>', 'success');
            break;
        case 'active':
            return color_text('<b>active</b>', 'info');
            break;
        case 'cancelled':
            return color_text('<b>cancelled</b>', 'danger');
            break;
    }
}
