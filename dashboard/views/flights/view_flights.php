<?php
include('../../bootstrap.php');
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');
file_put_contents('logger.txt', $_POST['numser']);
?>

<main class="mt-5 ">
  <div class="container-fluid">
  <a class="btn btn-dark" href="<?php echo DASHBOARD_URL ?>/views/flights/flights.php" role="button"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>

  <div class="row">
        <div class="col">
          <h5 class="text-center text-muted">Airplane_no</h5>
          <h4 class="text-center" id="numser"></h4>
        </div>
        <div class="col">
          <h5 class="text-center text-muted">Origin</h5>
          <h4 class="text-center" id="origin"></h4>
        </div>
        <div class="col">
          <h5 class="text-center text-muted">Destination</h5>
          <h4 class="text-center" id="destination"></h4>
        </div>
        <div class="col">
          <h5 class="text-center text-muted">Status</h5>
          <h4 class="text-center" id="status"></h4>
        </div>
      </div>

    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card-table">
          <div class="card-header text-center fw-bold fs-5">
          Airplanes
          </div>
          <!-- <div class="col-md-8 m-3">
                        <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addairplanemodal" class="btn btn-primary btn-sm">Add data</a>

                    </div> -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="airplanes" class="table data-table" style="width:100%">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>company</th>
                    <th>numser</th>
                    <th>minimum_rating</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>option</th>
                  </tr>
                </thead>
                <tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card-table">
          <div class="card-header text-center fw-bold fs-5">
            Flight Pilot and Crews
          </div>
          <!-- <div class="col-md-8 m-3">
                        <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addairplanemodal" class="btn btn-primary btn-sm">Add data</a>

                    </div> -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="crews" class="table data-table" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>origin</th>
                    <th>destination</th>
                    <th>company</th>
                    <th>Numser</th>
                    <th>created_at</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card-table">
          <div class="card-header text-center fw-bold fs-5">
            Flight Bookings
          </div>
          <!-- <div class="col-md-8 m-3">
                        <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addairplanemodal" class="btn btn-primary btn-sm">Add data</a>

                    </div> -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="bookings" class="table data-table" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Passenger</th>
                    <th>Class</th>
                    <th>origin</th>
                    <th>destination</th>
                    <th>company</th>
                    <th>status</th>
                    <th>purchased</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</main>
<!-- Main Content End -->



<script>
  $(document).ready(function() {
    var id = "<?php echo $_GET['id']; ?>";
    $.ajax({
      url: "<?php echo DASHBOARD_URL ?>/controllers/flights/fetch_flight_data.php",
      data: {
        id: id,
      },
      type: 'post',
      success: function(data) {
        var json = JSON.parse(data);
        $('#numser').text(json.numser);
        $('#origin').text(json.origin);
        $('#destination').text(json.destination);
        $('#status').text(json.status);
      }
    })
  });


  $(document).ready(function() {
    var id = "<?php echo $_GET['id']; ?>";
    var data = "airplanes"
    $('#airplanes').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': true,
      'processing': true,
      'paging': false,
      'info': false,
      'ordering': false,
      'searching': false,
      'order': [],

      'ajax': {
        'url': '<?php echo DASHBOARD_URL ?>/controllers/flights/fetch_view_flights.php',
        data: {
          id: id,
          data: data,

        },
        'type': 'post',
      },
      'fnCreateRow': function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'columnDefs': [{
        'target': [0, 5],
        'orderable': false,
      }]
    });
  });

  $(document).ready(function() {
    var id = "<?php echo $_GET['id']; ?>";
    var data = "bookings"
    $('#bookings').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': true,
      'processing': true,
      'paging': false,
      'info': false,
      'ordering': false,
      'searching': false,
      'order': [],

      'ajax': {
        'url': '<?php echo DASHBOARD_URL ?>/controllers/flights/fetch_bookings_flights.php',
        data: {
          id: id,
          data: data,

        },
        'type': 'post',
      },
      'fnCreateRow': function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'columnDefs': [{
        'target': [0, 5],
        'orderable': false,
      }]
    });
  });

  $(document).ready(function() {
    var id = "<?php echo $_GET['id']; ?>";
    console.log(id)
    var data = "bookings"
    $('#crews').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': true,
      'processing': true,
      'paging': false,
      'info': false,
      'ordering': false,
      'searching': false,
      'order': [],

      'ajax': {
        'url': '<?php echo DASHBOARD_URL ?>/controllers/flights/fetch_crews_flights.php',
        data: {
          id: id,
          data: data,

        },
        'type': 'post',
      },
      'fnCreateRow': function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'columnDefs': [{
        'target': [0, 5],
        'orderable': false,
      }]
    });
  });
</script>


<?php
include(INC_FLDR . '/scripts.php');
include(INC_FLDR . '/footer.php');
?>