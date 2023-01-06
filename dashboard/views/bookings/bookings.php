<?php
include('../../bootstrap.php');
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');
?>
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card-table">
          <div class="card-header text-center fw-bold fs-4">
            Bookings
          </div>
          <?php message_board(); ?>
          <div class="col-md-8 m-3">
            <a class="btn btn-primary" href="<?php echo VIEW_URL; ?>/bookings/add_booking.php">Place a new Booking</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="bookings" class="table table-striped data-table" style="width:100%">
                <thead class="table-dark">
                  <tr>
                    <th scope="row">Id</th>
                    <th scope="row">Passenger</th>
                    <th scope="row">Class</th>
                    <th scope="row">origin</th>
                    <th scope="row">destination</th>
                    <th scope="row">company</th>
                    <th scope="row">status</th>
                    <th scope="row">purchased</th>
                    <th scope="row">Option</th>
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

<!-- Add airplane Modal -->
<div class="modal fade" id="addbookingsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Bookings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addbookings" action="">
          <div class="mb-3 row">
            <label for="company" class="col-md-3 form-label">Company</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addcompany" name="company">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="minimum_rating" class="col-md-3 form-label">minimum_rating</label>
            <div class="col-md-9">
              <input type="number" class="form-control" id="addminimum_rating" name="minimum_rating">
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end airplane model -->

<!-- edit airplane Modal -->
<div class="modal fade" id="editairplanemodal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Edit Airplane</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editairplane" action="">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="numser" id="editnumser" value="">
          <input type="hidden" name="created_at" id="editcreated_at" value="">
          <input type="hidden" name="updated_at" id="editupdated_at" value="">
          <input type="hidden" name="trid" id="trid" value="">
          <div class="mb-3 row">
            <label for="company" class="col-md-3 form-label">Company</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="editcompany" name="company">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editminimum_rating" class="col-md-3 form-label">minimum_rating</label>
            <div class="col-md-9">
              <input type="number" class="form-control" id="aditminimum_rating" name="minimum_rating">
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end airplane Modal -->

<script>
  $(document).ready(function() {
    $('#bookings').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': true,
      'processing': true,
      'paging': true,
      'order': [],

      'ajax': {
        'url': '<?php echo DASHBOARD_URL ?>/controllers/bookings/fetch_bookings.php',
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

  $(document).on('click', '.editbtn', function(event) {
    var table = $('#airplane').DataTable();
    var trid = $(this).closest('tr').attr('id');
    console.log($(this).closest('tr').attr('class'));
    // console.log(selectedRow);
    var id = $(this).data('id');
    $('#editairplanemodal').modal('show');
    $.ajax({
      url: "<?php echo DASHBOARD_URL ?>/get_single_data.php",
      data: {
        id: id,
      },
      type: 'post',
      success: function(data) {
        var json = JSON.parse(data);
        $('#editcompany').val(json.company);
        $('#id').val(json.id);
        $('#aditminimum_rating').val(json.minimum_rating);
        $('#trid').val(trid);
        $('#editnumser').val(editnumser);
        $('#editcreated_at').val(editcreated_at);
        $('#editupdated_at').val(editupdated_at);
      }
    })
  });


  $(document).on('submit', '#editairplane', function(e) {
    e.preventDefault();
    //var tr = $(this).closest('tr');
    var company = $('#editcompany').val();
    var minimum_rating = $('#aditminimum_rating').val();
    var trid = $('#trid').val();
    var numser = $('#editnumser').val();
    var created_at = $('#editcreated_at').val();
    var updated_at = $('#editupdated_at').val();
    //console.log(this);
    var id = $('#id').val();

    if (company != '' && minimum_rating != '') {
      //alert($company );
      $.ajax({
        url: "<?php echo DASHBOARD_URL ?>/update_airplane.php",
        type: "post",
        data: {
          company: company,
          minimum_rating: minimum_rating,
          id: id,
          numser: numser,
          created_at: created_at,
          updated_at: updated_at
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            table = $('#airplane').DataTable();
            // table.cell(parseInt(trid) - 1,0).data(id);
            // table.cell(parseInt(trid) - 1,1).data(username);
            // table.cell(parseInt(trid) - 1,2).data(email);
            // table.cell(parseInt(trid) - 1,3).data(mobile);
            // table.cell(parseInt(trid) - 1,4).data(city);
            var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
            var row = table.row("[id='" + trid + "']");
            row.row("[id='" + trid + "']").data([id, company, numser, minimum_rating, created_at, updated_at, button]);
            $('#addairplanemodal').modal('hide');
          } else {
            alert('failed');
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });


  $(document).on('click', '.deletebtn', function(event) {
    var table = $('#bookings').DataTable();
    event.preventDefault();
    var id = $(this).data('id');
    if (confirm("Are you sure want to delete this User ? ")) {
      $.ajax({
        url: "<?php echo DASHBOARD_URL ?>/controllers/bookings/delete_bookings.php",
        data: {
          id: id
        },
        type: "post",
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          if (status == 'success') {
            //table.fnDeleteRow( table.$('#' + id)[0] );
            //$("#example tbody").find(id).remove();
            //table.row($(this).closest("tr")) .remove();
            $("#" + id).closest('tr').remove();
          } else {
            alert('Failed');
            return;
          }
        }
      });
    } else {
      return null;
    }

  })
</script>


<?php
include(INC_FLDR . '/scripts.php');
include(INC_FLDR . '/footer.php');
?>