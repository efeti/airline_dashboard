<?php
include('../../bootstrap.php');
include_once(INC_FLDR . '/connect.php');
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');

#fetch all airplane
$airplanes = db_fetch_rows("SELECT id, company, numser, minimum_rating FROM airplanes");

?>
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <h4>Create New Flight</h4>
                <div id="message-box"></div>
                <form class="row" id="add-flight">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="airplane-machine">Airplane</label>
                        <select name="airplane" id="airplane-machine" class="form-control">
                            <option value="" data-rating="0">Select an airplane</option>
                            <?php foreach ($airplanes as $airplane) : ?>
                                <option value="<?php echo $airplane['id']; ?>" data-rating="<?php echo $airplane['minimum_rating']; ?>"> <?php echo $airplane['company'] . '-' . $airplane['numser']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rating</label>
                        <input type="text" id="rating" value="0" class="form-control" disabled required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Origin</label>
                        <input type="text" class="form-control" id="origin" name="origin" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-control" name="destination" id="destination" required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Departure Time</label>
                        <input type="datetime-local" id="departure-time" class="form-control" id="departure-time" required>
                    </div>
                    <div class="col-md-5 mt-3">
                        <label for="form-label">Arrival Time</label>
                        <input type="datetime-local" id="arrival-time" name="arrival-time" id="arrival-time" class="form-control">
                    </div>
                    <div class="col-md-5 mt-2">
                        <label class="form-label">Flight Type</label>
                        <select name="flight-type" id="flight-type" class="form-control" required>
                            <option value="">Select a flight type</option>
                            <option value="connecting">Connecting</option>
                            <option value="non-stop">Non-stop</option>
                        </select>
                    </div>

                    <h3 class="mt-4">Pilot</h3>
                    <div class="row mt-1">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="pilot1">Pilot 1</label>
                                <select name="pilot1" id="pilot1" class="form-control mt-3" required disabled>
                                    <option selected value="">Select First Pilot</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="pilot2">Pilot 2</label>
                            <select name="pilot2" id="pilot2" class="form-control mt-3" required disabled>
                                <option selected>Select Second Pilot</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="mt-4">Crew Members</h3>
                    <div class="row mt-1">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="crew1" class="mb-3">First Crew Member</label>
                                <select name="crew1" id="crew1" class="form-control" required disabled>
                                    <option selected>Select First crew member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-2">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="crew2" class="mb-3">Second Crew Member</label>
                                <select name="crew2" id="crew2" class="form-control" required disabled>
                                    <option selected>Select second crew member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="crew3" class="mb-3">Third Crew Member</label>
                                <select name="crew3" id="crew3" class="form-control" required disabled>
                                    <option selected>Select third crew member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-5">
                        <input class="btn btn-primary" id="submit" type="submit" name="add-flight" value="Place a new flight">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include(INC_FLDR . '/scripts.php');
?>

<script>
    (function($) {
        //on document ready
        let available_pilot = [];
        let available_host = [];
        $(function() {
            let worker_fetch = false;
            $('#airplane-machine').change(function(e) {
                //render rating
                rating = $(this).find(":selected").data('rating');
                $('#rating').val(rating);
            });

            $('#arrival-time, #departure-time, #airplane-machine').change(function(e) {
                //if flight 
                if (
                    ($('#rating').val() > 0) &&
                    ($('#departure-time').val() != '') &&
                    ($('#arrival-time').val() != '')
                ) {
                    //clear pilot and crew and disable them too

                    let arrival_time = new Date($('#arrival-time').val()),
                        departure_time = new Date($('#departure-time').val());
                    //get possible list of pilot
                    $.post('<?php echo DASHBOARD_URL ?>/controllers/staff/available_staff.php', {
                        'action': 'available-staff',
                        'rating': $('#rating').val(),
                        'arrival_time': arrival_time.toISOString().slice(0, 19).replace('T', ' '),
                        'departure_time': departure_time.toISOString().slice(0, 19).replace('T', ' '),
                    }).done(function(data) {
                        let result = JSON.parse(data);
                        available_pilot = result['pilot'];
                        available_host = result['host']

                        //add pilot
                        $('#pilot1').html('<option value="" selected>Select First Pilot</option>');

                        available_pilot.forEach(element => {
                            $('#pilot1').append(`<option value="${element.id}">${element.name} ${element.surname}</option>`);
                        });
                        $('#pilot1').attr('disabled', false);

                        //add pilot 1
                        $('#crew1').html('<option value="" selected>Select First Crew Member </option>');
                        available_host.forEach(element => {
                            $('#crew1').append(`<option value="${element.id}">${element.name} ${element.surname}</option>`);
                        });
                        $('#crew1').attr('disabled', false)
                    }).fail(function(data) {
                        console.log(data);
                    })
                }
            });

            //when pilot1 is clicked
            $('#pilot1').change(function(e) {
                $('#pilot2').html('<option value="" selected>Select Second Pilot</option>');

                available_pilot.forEach(element => {
                    if (element.id == $('#pilot1').val())
                        return;

                    $('#pilot2').append(`<option value="${element.id}">${element.name} ${element.surname}</option>`);
                });

                $('#pilot2').attr('disabled', false);
            });

            //when crew1 is clicked
            $('#crew1').change(function(e) {
                $('#crew2').html('<option value="" selected>Select Second Crew Member</option>');

                available_host.forEach(element => {
                    if (element.id == $('#crew1').val())
                        return;

                    $('#crew2').append(`<option value="${element.id}">${element.name} ${element.surname}</option>`);
                })

                $('#crew2').attr('disabled', false);
            });

            //when crew2 is clicked
            $('#crew2').change(function(e) {
                $('#crew3').html('<option selected value="">Select Second Crew Member</option>');

                available_host.forEach(element => {
                    if (element.id == $('#crew1').val())
                        return;
                    else if (element.id == $('#crew2').val())
                        return;

                    $('#crew3').append(`<option value="${element.id}">${element.name} ${element.surname}</option>`);
                })

                $('#crew3').attr('disabled', false);
            });

            //submit
            $('#add-flight').submit(function(e) {
                let formData = {
                    'departure-time': (new Date($('#departure-time').val())).toISOString().slice(0, 19).replace('T', ' '),
                    'arrival-time': (new Date($('#arrival-time').val())).toISOString().slice(0, 19).replace('T', ' '),
                    'origin': $('#origin').val(),
                    'destination': $('#destination').val(),
                    'airplane': $('#airplane-machine').val(),
                    'flight-type': $('#flight-type').val(),
                    'pilot1': $('#pilot1').val(),
                    'pilot2': $('#pilot2').val(),
                    'crew1': $('#crew1').val(),
                    'crew2': $('#crew2').val(),
                    'crew3': $('#crew3').val(),
                    'add-flight': true,
                }

                $('#submit').attr('disabled', true);

                $.post('<?php echo DASHBOARD_URL ?>/controllers/flights/add_new_flight.php', formData)
                    .done(function(data) {
                        let message = JSON.parse(data);
                        should_flash(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="message-board">
                                <div id="the-message">
                                    <strong>Info!</strong> ${message['message']}.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `)
                        window.location.href = '<?php echo VIEW_URL ?>/flights/flights.php';
                    }).fail(function(data) {
                        let result = JSON.parse(data.responseText);
                        $('#message-box').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="message-board">
                            <div id="the-message">
                                <strong>Info!</strong> ${result['message']}.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                        )

                        $('html, body').animate({
                            scrollTop: $("#message-box")
                        }, 100);
                    }).always(function() {
                        $('#submit').attr('disabled', false);
                    });

                e.preventDefault();
                e.stopPropagation();
            });
        });
    })(jQuery)
</script>

<?php
include(INC_FLDR . '/footer.php');
?>