<?php
include('.././bootstrap.php');
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');
?>
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card-table">
                    <div class="card-header text-center fw-bold">
                        All Staffs
                    </div>
                    <div class="col-md-8 m-3">
                        <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addstaff" class="btn btn-success btn-sm">Add New Staff</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="staff" class="table table-bordered data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>role</th>
                                        <th>empnum</th>
                                        <th>name</th>
                                        <th>surname</th>
                                        <th>address</th>
                                        <th>phone</th>
                                        <th>rating</th>
                                        <th>salary</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th>option</th>
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
<div class="modal fade" id="addstaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addstaff" action="">
                    <div class="mb-3 row">
                        <label for="role" class="col-md-3 form-label">Role</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addrole" name="role">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-3 form-label">name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addname" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="surname" class="col-md-3 form-label">surname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addsurname" name="surname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-md-3 form-label">Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addaddress" name="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-md-3 form-label">Phone no</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addphone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rating" class="col-md-3 form-label">Rating</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addrating" name="rating">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Salary" class="col-md-3 form-label">salary</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addsalary" name="salary">
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


<!-- Edit airplane Modal -->
<div class="modal fade" id="editstaffmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editstaff" action="">
                <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="empnum" id="editempnum" value="">
                    <input type="hidden" name="created_at" id="editcreated_at" value="">
                    <input type="hidden" name="updated_at" id="editupdated_at" value="">
                    <input type="hidden" name="trid" id="trid" value="">
                    <div class="mb-3 row">
                        <label for="role" class="col-md-3 form-label">Role</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editrole" name="role">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-3 form-label">name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editname" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="surname" class="col-md-3 form-label">surname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editsurname" name="surname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-md-3 form-label">Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editaddress" name="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-md-3 form-label">Phone no</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editphone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rating" class="col-md-3 form-label">Rating</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editrating" name="rating">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Salary" class="col-md-3 form-label">salary</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="editsalary" name="salary">
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
<!-- end staff model -->


<script>
    $(document).on('submit', '#addstaff', function(e) {
  e.preventDefault();
  var role = $('#addrole').val();
  var name = $('#addname').val();
  var surname = $('#addsurname').val();
  var address = $('#addaddress').val();
  var phone = $('#addphone').val();
  var rating = $('#addrating').val();
  var salary = $('#addsalary').val();
  if (role != '' && name != '' && surname != '' && address != '' && phone != '' && rating != '' && salary != '') {
    $.ajax({
      url: "<?php echo DASHBOARD_URL ?>/controllers/staff/add_staff.php",
      type: "post",
      data: {
        role: role,
        name: name,
        surname: surname,
        address: address,
        phone: phone,
        rating: rating,
        salary: salary,
      },
      success: function(data) {
        var json = JSON.parse(data);
        var status = json.status;
        if (status == 'true') {
          mytable = $('#staff').DataTable();
          mytable.draw();
          $('#addrole').val('');
          $('#addname').val('');
          $('#addsurname').val('');
          $('#addaddress').val('');
          $('#addphone').val('');
          $('#addrating').val('');
          $('#addsalary').val('');
          $('#addstaff').modal('hide');
        } else {
          alert('failed');
        }
      }
    });
  } else {
    alert('Fill all the required fields');
  }
});

    $(document).ready(function() {
        $('#staff').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': true,
            'processing': true,
            'paging': false,
            'info': false,
            'ordering': false,
            'order': [],

            'ajax': {
                'url': '<?php echo DASHBOARD_URL ?>/controllers/staff/fetch_staff.php',
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
        var table = $('#staff').DataTable();
        var trid = $(this).closest('tr').attr('id');
        var id = $(this).data('id');
        $('#editstaffmodal').modal('show');
        $.ajax({
            url: "<?php echo DASHBOARD_URL ?>/controllers/staff/get_staff_data.php",
            data: {
                id: id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#id').val(id);
                $('#trid').val(trid);
                $('#editrole').val(json.role);
                $('#empnum').val(json.empnum);
                $('#editname').val(json.name);
                $('#editsurname').val(json.surname);
                $('#editaddress').val(json.address);
                $('#editphone').val(json.phone);
                $('#editrating').val(json.rating);
                $('#editsalary').val(json.salary);
                $('#editcreated_at').val(json.created_at);
                $('#editupdated_at').val(json.updated_at);
            }
        });
    });


    $(document).on('submit', '#editstaff', function(e) {
        e.preventDefault();
        //var tr = $(this).closest('tr');
        var id = $('#id').val();
        var trid = $('#trid').val();
        var role = $('#editrole').val();
        var empnum = $('#editempnum').val();   
        var name = $('#editname').val();
        var surname = $('#editsurname').val();
        var address = $('#editaddress').val();
        var phone = $('#editphone').val();
        var rating = $('#editrating').val();   
        var salary = $('#editsalary').val();
        var created_at = $('#editcreated_at').val();
        var updated_at = $('#editupdated_at').val();
        // console.log(id);
        //console.log(this);
        

        if (role != '' && name != '' && surname != '' && address != '' && phone != '' && rating != '' && salary != '')  {
             console.log(empnum);
            //alert($company );
            $.ajax({
                url: "<?php echo DASHBOARD_URL ?>/controllers/staff/update_staff.php",
                type: "post", 
                data: {
                    id: id,
                    role: role,
                    name: name,
                    surname: surname,
                    address: address,
                    phone: phone,
                    rating: rating,
                    salary: salary,
                    created_at: created_at,
                    updated_at: updated_at,
                }, 
                success: function(data) {
                    console.log(role);
                    var json = JSON.parse(data);
                    var status = json.status;
                    if (status == 'true') {
                        table = $('#staff').DataTable();
                        // table.cell(parseInt(trid) - 1,0).data(id);
                        // table.cell(parseInt(trid) - 1,1).data(username);
                        // table.cell(parseInt(trid) - 1,2).data(email);
                        // table.cell(parseInt(trid) - 1,3).data(mobile);
                        // table.cell(parseInt(trid) - 1,4).data(city);
                        var button = '<div class="btn-group" role="group" aria-label="Basic mixed styles example"> <button type="button" class="btn-sm btn-success viewbtn" data-id="' + id + '" >View</button> <button type="button" class="btn-sm btn-info editbtn" data-id="' + id + '" >Edit</button> <button type="button" class="btn-sm btn-danger deletebtn" data-id="' + id + '" >Delete</button> </div>';

                        var row = table.row("[id='" + trid + "']");
                        row.row("[id='" + trid + "']").data([id, role, empnum, name, surname, address, phone, rating, salary, created_at, updated_at, button]);
                        $('#editstaffmodal').modal('hide');
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
        var table = $('#staff').DataTable();
        event.preventDefault();
        var id = $(this).data('id');
        if (confirm("Are you sure want to delete this User ? ")) {
            $.ajax({
                url: "<?php echo DASHBOARD_URL ?>/controllers/staff/delete_staff.php",
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