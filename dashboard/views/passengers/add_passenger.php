<?php
include_once('../../bootstrap.php');
include_once(INC_FLDR . '/connect.php');

//handle submission logic
if (isset($_POST['add-new-passenger'])) {
    try {
        //validate
        $validate = run_against_validation([
            'password-same' => function () {
                return $_POST['re-password'] == $_POST['password'];
            },
            'email-unique' => function () {
                $email_exist = db_fetch_rows("SELECT count(*) AS email_count from passengers WHERE email = '{$_POST['email']}'");

                return ($email_exist[0]['email_count'] > 0) ? false : true;
            },
            'phone-unique' => function () {
                $phone_not_unique = db_fetch_rows("SELECT count(*) p_count from passengers WHERE phone = '{$_POST['phone']}'");

                return ($phone_not_unique[0]['p_count'] > 0) ? false : true;
            }
        ], [
            'password-same' => 'Password Confirmation does not match',
            'email-unique' => 'Email already exist, Select a new Email',
            'phone-unique' => 'Phone Number Must be Unique'
        ]);

        if ($validate)
            throw new Exception($validate);


        $add_user = execute_sql("INSERT INTO passengers(phone, name, gender, surname, address, email, password, created_at, updated_at) VALUE('{$_POST['phone']}', '{$_POST['firstname']}', '{$_POST['gender']}', '{$_POST['lastname']}', '{$_POST['address']}', '{$_POST['email']}', MD5('{$_POST['password']}'), NOW(), NOW())");

        if (!$add_user)
            throw new Exception('An Error Occured, try again later');

        make_flash('A new passenger was added Successfully');
        header('Location: ' . VIEW_URL . '/passengers/passengers.php');
        exit;
    } catch (\Throwable $th) {
        make_flash($th->getMessage(), 'warning');
    }
}

//load view
include(INC_FLDR . '/header.php');
include(INC_FLDR . '/navbar.php');
include(INC_FLDR . '/sidebar.php');
?>
<main class="mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form action="" method="post">
                    <div class="container mt-5 mb-5">
                        <h3>Add A Passenger</h3>
                        <?php message_board(); ?>
                        <div class="form-group mb-2">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php old('email'); ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="Password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2">Confirm Password</label>
                            <input type="password" name="re-password" id="re-password" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstname" class="mb-2">Firstname</label>
                            <input type="text" value="<?php old('firstname'); ?>" name="firstname" class="form-control" id="firstname" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="lastname" class="mb-2">Lastname</label>
                            <input type="text" value="<?php old('lastname'); ?>" name="lastname" class="form-control" id="lastname" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone" class="mb-2">Phone Number</label>
                            <input type="text" value="<?php old('phone'); ?>" name="phone" class="form-control" id="phone" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="gener" class="mb-2">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="M" <?php old_selected('gender', 'M') ?>>Male</option>
                                <option value="F" <?php old_selected('gender', 'F') ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="address" class="mb-2">Address</label>
                            <textarea name="address" class="form-control" id="" cols="30" rows="4" required><?php old('address'); ?></textarea>
                        </div>

                        <button type="submit" name="add-new-passenger" class="btn btn-info">Create a Passenger</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>
</main>

<?php
include_once(INC_FLDR . '/scripts.php');
include_once(INC_FLDR . '/footer.php');
