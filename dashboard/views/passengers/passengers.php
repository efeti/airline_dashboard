<?php
include('../../bootstrap.php');
include(INC_FLDR . '/connect.php');
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');

$all_passenger =  db_fetch_rows("SELECT * FROM passengers");
?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card-table">
                    <div class="card-header fs-4 text-center fw-bold">
                        Passengers
                    </div>
                    <?php message_board() ?>
                    <div class="col-md-8 m-3">
                        <a href="<?php echo VIEW_URL?>/passengers/add_passenger.php" class="btn btn-primary btn-md">Add New Passenger</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="Passenger" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>surname</th>
                                        <th>gender</th>
                                        <th>phone_no</th>
                                        <th>email</th>
                                        <th>address</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_passenger as $passenger) : ?>
                                        <tr>
                                            <td><?php echo $passenger['id']; ?></td>
                                            <td><?php echo $passenger['name']; ?></td>
                                            <td><?php echo $passenger['surname']; ?></td>
                                            <td><?php echo $passenger['gender']; ?> </td>
                                            <td><?php echo $passenger['phone']; ?></td>
                                            <td><?php echo $passenger['email']; ?></td>
                                            <td><?php echo $passenger['address']; ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="<?php echo VIEW_URL ?>/passengers/update_passenger.php?p_id=<?php echo $passenger['id']; ?>" class="btn btn-info">Edit</a>
                                                    <a href="#" class="btn btn-warning " style="margin-left: 3px !important;">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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

<?php
include(INC_FLDR . '/scripts.php');
?>
<script>

</script>
<?php
include(INC_FLDR . '/footer.php');
?>