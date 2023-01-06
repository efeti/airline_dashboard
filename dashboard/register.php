<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100 mt-5">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

                <div class="card shadow-lg mt-5">
                    <div class="card-body p-5">
                        <?php
                        if(isset($_SESSION['status']) && $_SESSION['status'] != '' 
                           && isset($_SESSION['message']) && $_SESSION['message'] != '')
                        {
                            if($_SESSION['status'] == "pass")
                            {
                                $color = 'green';
                            }
                            else
                            {
                                $color = 'red';

                            }
                            echo '<h5 style="color:'.$color.';">'.$_SESSION['message'].'</h5>';
                            unset($_SESSION['status']);
                            unset($_SESSION['message']);
                        }
                        // if(isset($_SESSION['status']) && $_SESSION['status'] != '')
                        // {
                        //     echo '<h5 style="color:red;">'.$_SESSION['status'].'</h5>';
                        //     unset($_SESSION['status']);
                        // }
                        ?>
                        <h1 class="fs-4 card-title fw-bold mb-4 mt=2">Register</h1>
                        <form method="POST" action="code.php" class="needs-validation" novalidate="" autocomplete="off">

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="firstname">First Name</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="" required="" autofocus>
                                <div class="invalid-feedback">
                                    First Name is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="lastname">Last Name</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="" required autofocus>
                                <div class="invalid-feedback">
                                    Last Name is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="username">User Name</label>
                                <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
                                <div class="invalid-feedback">
                                    User Name is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="cpassword">confirm Password</label>
                                <input id="cpassword" type="password" class="form-control" name="cpassword" required>
                                <div class="invalid-feedback">
                                    Password confirmation is required
                                </div>
                            </div>

                            <p class="form-text text-muted mb-3">
                                By registering you agree with our terms and condition.
                            </p>

                            <div class="align-items-center d-flex">
                                <button type="submit" name="registerbtn" class="btn btn-primary ms-auto">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Already have an account? <a href="index.html" class="text-dark">Login</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2017-2021 &mdash; Your Company
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>