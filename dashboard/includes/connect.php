<?php

/**@var mysqli */
$con  = mysqli_connect('localhost', 'root', '', 'airline');

if (mysqli_connect_errno())
    throw new Exception('Database Connection Error');

function db_fetch_rows($query): array
{
    global $con;
    $result = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result))
        $rows[] = $row;

    return $rows;
}

function db_sanitize_string(string $value)
{
    global $con;
    return mysqli_real_escape_string($con, $value);
}

function execute_sql(string $query)
{
    global $con;
    return mysqli_query($con, $query);
}

function get_array_column(array $results, $column_name)
{
    $column = [];

    foreach ($results as $result)
        $column[] = $result[$column_name];

    return $column;
}
