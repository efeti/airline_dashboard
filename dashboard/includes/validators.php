<?php

/**
 * Flash message
 */
function flash_message(): array
{
    if (session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['flash_message']))
        return [];


    $message = $_SESSION['flash_message'];
    $status = $_SESSION['status'];

    unset($_SESSION['flash_message']);
    unset($_SESSION['status']);

    return [
        'message' => $message,
        'status' => $status
    ];
}


function make_flash(string $message, $status = 'success'): bool
{
    if (session_status() != PHP_SESSION_ACTIVE)
        return false;

    $_SESSION['flash_message'] = $message;
    $_SESSION['status'] = $status;
    return true;
}

function post_not_empty(array $fields)
{
    foreach ($fields as $post_key => $message) {
        if (!isset($_POST["$post_key"]) || empty($_POST["$post_key"]))
            return $message;
    }

    return '';
}

function run_against_validation(array $fields, array $message)
{
    foreach ($fields as $post_key => $validator) {
        foreach ($fields as $post_key => $validator) {
            if (!$validator())
                return $message[$post_key];
        }
    }

    return '';
}


function valid_datetime(string $datetime, bool $strict = false)
{
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
    if ($strict) {
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
    }

    return $dateTime !== false;
}

function date_greater_than(string $value, string $against)
{
    if (!valid_datetime($value) || !valid_datetime($against))
        return false;

    return DateTime::createFromFormat('Y-m-d H:i:s', $value) > DateTime::createFromFormat('Y-m-d H:i:s', $against);
}

function old($value): void
{
    echo $_POST[$value] ?? '';
}

function old_selected($key, $value): void
{
    echo (($_POST[$key] ?? false) && ($_POST[$key] == $value)) ? 'selected' : '';
}

function old_value($value): void
{
    global $value_store;
    echo $value_store[$value] ?? '';
}

function old_value_selected($key, $value): void
{
    global $value_store;
    echo isset($value_store[$key]) && ($value_store[$key] == $value) ? 'selected' : '';
}
