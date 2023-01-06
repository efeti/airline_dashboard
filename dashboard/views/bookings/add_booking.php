<?php
session_start();

include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');
include(INC_FLDR . '/flight_logic.php');
$flights = bookable_flights();
$passengers = db_fetch_rows("SELECT * FROM passengers");

//if form is submitted
if (isset($_POST['add-booking'])) {
    try {
        $flight_id = $_POST['flight'];
        $class = $_POST['class'];
        $sit_no = $_POST['sit_no'];
        $amount = $config['class'][$class];
        $passenger_id = $_POST['passenger'];

        mysqli_begin_transaction($con);

        //create ticket
        $create_ticket = execute_sql("INSERT INTO tickets(flight_id, class, amount, sit_no, created_at, updated_at) VALUES('$flight_id', '$class', '$amount', '$sit_no', NOW(), NOW())");

        if (!$create_ticket)
            throw new mysqli_sql_exception('An error Occured, please try again later');

        $create_ticket_id = mysqli_insert_id($con);

        //add booking
        $create_booking = execute_sql("INSERT INTO bookings(passenger_id, flight_ticket_id, status, created_at, updated_at) VALUE('$passenger_id', '$create_ticket_id', 'active', NOW(), NOW())");

        if (!$create_booking)
            throw new mysqli_sql_exception('An error Occured, please try again later');

        //commit now we are here
        mysqli_commit($con);

        make_flash('Booking was placed successfully');

        header("Location: " . VIEW_URL . '/bookings/bookings.php');

        exit;
    } catch (\Throwable $th) {
        if ($th instanceof mysqli_sql_exception)
            mysqli_rollback($con);

        logger((string) $th);
        make_flash($th->getMessage(), 'danger');
    }
}


include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');
?>



<main class="mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-3">
                <form class="add booking" method="POST" action="">
                    <div class="mx-4">
                        <h3 class="mb-3">Place a new Booking</h3>
                        <?php message_board() ?>
                        <div class="form-group mb-3">
                            <label for="passenger"><b>Passenger</b></label>
                            <select name="passenger" id="passenger" class="form-control" required>
                                <option value="">Select a passenger</option>
                                <?php foreach ($passengers as $passenger) : ?>
                                    <option value="<?php echo $passenger['id']; ?>"><?php echo $passenger['name'] . ' ' . $passenger['surname']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="flight" class="mb-1"><b>Flight</b></label>
                            <select name="flight" title="select a flight" id="flight" class="form-control" required>
                                <option value="">Select Flight</option>
                                <?php foreach (bookable_flights() as $flight) : ?>
                                    <option value="<?php echo $flight['id']; ?>"><?php echo get_flight_code($flight) ?> <?php echo $flight['origin'] ?> - <?php echo $flight['destination']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-1"><b>Flight Class</b></label>
                            <select name="class" id="class" class="form-control" required>
                                <option value="">Select flight</option>
                                <?php foreach ($config['class'] as $key => $class) : ?>
                                    <option value="<?php echo $key; ?>"> <?php echo $key; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sit_no">Sit Number</label>
                            <select name="sit_no" id="sit_no" class="form-control" required>
                                <option value="">Select Sit Number</option>
                            </select>
                        </div>
                        <button type="submit" name="add-booking" class="btn btn-primary">Place New Booking</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</main>
<?php
include_once(INC_FLDR . '/scripts.php');
?>
<script>
    (function($) {
        $('#flight, #class').change(function(e) {
            //flight and class must be selected
            if (!$('#flight').val() || !$('#class').val())
                return;

            let flight_id = $('#flight').val();

            $.post('<?php echo CONTROLLER_URL ?>/flights/fetch_flight_sit.php', {
                'fetch-flight-sit': true,
                'flight_id': flight_id,
                'class': $('#class').val(),
            }).done(function(data) {
                let result = JSON.parse(data);
                let sits = Object.values(result.data)
                console.log(result);
                
                $('#sit_no').html('<option selected value="">Select Sit No</option>');

                sits.forEach(element => {
                    $('#sit_no').append(`<option value="${element}">${element}</option>`);
                });
            }).fail(function(data) {
                console.log(data);
            });
        });

    })(jQuery)
</script>
<?php
include_once(INC_FLDR . '/footer.php');
