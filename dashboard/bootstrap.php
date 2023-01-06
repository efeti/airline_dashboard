<?php

define('INC_FLDR', __DIR__ . '/includes');
define('JS_FLDR', __DIR__ . '/js');
define('VIEW_DIR', dirname(__DIR__) . '/views');
define('URL', 'http://localhost/airline');
define('DASHBOARD_URL', URL . '/dashboard');
define('VIEW_URL', DASHBOARD_URL . '/views');
define('CONTROLLER_URL', DASHBOARD_URL . '/controllers');

#include validationr
include(INC_FLDR . '/validators.php');

function logger($value)
{
    file_put_contents(dirname(__DIR__) . '/logger.txt', json_encode($value));
}

function message_board()
{
    if ($flash = flash_message()) : ?>
        <div class="mt-3 alert alert-<?php echo $flash['status'] ?> alert-dismissible fade show" role="alert" id="message-board">
            <div id="the-message">
                <strong>Info!</strong> <?php echo $flash['message'] ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
<?php
}

function color_text(string $text, string $status)
{ ?>
    <span class="text-<?php echo $status; ?> "><?php echo $text; ?></span>
<?php
}

$config = [
    'class' => [
        'Economic' => 100,
        'First' => 200,
        'Business' => 150
    ],

    'capacity' => 40,

    'First_sit' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'Business_sit' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
    'Economic_sit' => [26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50]
];


//start session
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
