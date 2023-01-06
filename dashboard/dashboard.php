<?php
include('bootstrap.php');
include(INC_FLDR . '/connect.php');
include_once(INC_FLDR . '/flight_logic.php');
include_once(INC_FLDR . '/validators.php');

update_flight_status();

$month = $_POST['month'] ?? date('n');
//load flight based on month
$flight_for_the_month =  db_fetch_rows("SELECT flights.id, staff.name, staff.surname, airplanes.minimum_rating, airplanes.numser, flights.status, flights.dept_time, flights.origin, flights.created_at from crews LEFT JOIN flights on flights.id = crews.flight_id LEFT JOIN staff on staff.id = crews.staff_id LEFT JOIN airplanes ON airplanes.id = flights.airplane_id WHERE MONTH(flights.dept_time) = $month AND staff.role = 'pilot' ORDER BY flights.created_at DESC");


$flight_info = db_fetch_rows("SELECT flights.id, flights.created_at, (SELECT count(tickets.id) from tickets where tickets.flight_id = flights.id) as number_of_passenger, flights.status from flights ORDER BY flights.created_at DESC");

$hour_asc_or_desc = $_POST['work-hour'] ?? 'DESC';
$pilot_working_hour = db_fetch_rows("SELECT staff.empnum, staff.rating, staff.name, staff.surname, (SELECT  SUM(TIMESTAMPDIFF(MINUTE, flights.dept_time, flights.arrival_time))/60 FROM flights left join crews on flights.id = crews.flight_id where crews.staff_id = staff.id) as working_hours from staff where staff.role = 'pilot' ORDER BY  working_hours $hour_asc_or_desc");


include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');

?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 fw-bold fs-3">Report Dashboard</div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Pilot Schedules</h5>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3 mb-4">
                        <form action="" id="filter-month" method="post">
                            <label for="month">Select by Month</label>
                            <select name="month" id="month" class="form-control">
                                <?php for ($i = 1; $i < 13; $i++) : ?>
                                    <option value="<?php echo $i; ?>" <?php old_selected('month', $i); ?>><?php echo date("F", strtotime('00-' . $i . '-01')); ?></option>
                                <?php endfor ?>
                            </select>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="row">Pilot Name</th>
                            <th scope="row">Flight Code</th>
                            <th scope="row">Airplane</th>
                            <th scope="row">Flight Rating</th>
                            <th scope="row">Departure Time</th>
                            <th scope="row">Flight Origin</th>
                            <th scope="row">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flight_for_the_month as $flight) : ?>
                            <tr>
                                <td><?php echo $flight['name'] . ' ' . $flight['surname']; ?></td>
                                <td><?php echo get_flight_code($flight); ?></td>
                                <td><?php echo $flight['numser']; ?></td>
                                <td><?php echo $flight['minimum_rating']; ?></td>
                                <td><?php echo $flight['dept_time']; ?></td>
                                <td><?php echo $flight['origin']; ?></td>
                                <td><?php echo flight_color_text($flight['status']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-md-6">
                <h4 class="mb-4">Flights and numbers of passengers</h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="row">Flight Code</th>
                            <th scope="row">Total amount of Passengers</th>
                            <th scope="row">Flight status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flight_info as $info) : ?>
                            <tr>
                                <td><?php echo get_flight_code($info) ?></td>
                                <td><?php echo $info['number_of_passenger']; ?></td>
                                <td><?php echo flight_color_text($info['status']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Pilot and working hours</h4>
                    </div>
                    <div class="col-md-6">
                        <form action="" id="change-working-order" method="post">
                            <select name="work-hour" id="work-hour" class="form-control">
                                <option value="DESC" <?php old_selected('work-hour', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php old_selected('work-hour', 'ASC'); ?>>Ascending</option>
                            </select>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="row">EMP NUM</th>
                            <th scope="row">Firstname</th>
                            <th scope="row">Lastname</th>
                            <th scope="row">Rating</th>
                            <th scope="row">Total hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pilot_working_hour as $pilot_working) : ?>
                            <tr>
                                <td><?php echo $pilot_working['empnum']; ?></td>
                                <td><?php echo $pilot_working['name']; ?></td>
                                <td><?php echo $pilot_working['surname']; ?></td>
                                <td><?php echo $pilot_working['rating']; ?></td>
                                <td><?php echo $pilot_working['working_hours']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Main Content End -->
<?php
include(INC_FLDR . '/scripts.php');
?>
<script>
    (function($) {
        $(function() {
            $('#month').change(function(e) {
                $('#filter-month').submit();
            });

            $('#work-hour').change(function(e) {
                $('#change-working-order').submit();
            })
        });
    })(jQuery)
</script>
<?php
include(INC_FLDR . '/footer.php');
