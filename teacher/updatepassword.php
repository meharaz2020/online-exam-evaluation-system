<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<?php

$user_name = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

$userData = mysqli_fetch_assoc($user_name);
$fname = $userData['name'];
$role = $userData['role'];

$uid = $userData['id'];
?>
<!--  -->
<?php
if (isset($_POST['submit'])) {
    $uname           = mysqli_real_escape_string($db, $_POST['user']);
    $password        = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword        = mysqli_real_escape_string($db, $_POST['cpassword']);
    $pass = password_hash($password, PASSWORD_DEFAULT);
    if (!$uname == "") {

        $querys = mysqli_query($db, "SELECT * FROM users WHERE id='$uid' AND (username ='$uname' OR roll ='$uname')");
        if (mysqli_num_rows($querys) == 1) {
            if (!$password == "") {
                if (strlen($password) > 4) {
                    if (!$cpassword == "") {
                        if ($password == $cpassword) {
                            $query1 = "UPDATE users SET password='$pass' WHERE username ='$uname' OR roll ='$uname'";
                            $query_run = mysqli_query($db, $query1);
                            if ($query_run) {
                                $update_sucess = "Password update sucessfully";
                            } else {
                                $update_error = "Password not update!";
                            }
                        } else {
                            $confirms_password_error = "Password not match";
                        }
                    } else {
                        $confirm_password_error = "Confirm Password fild is required";
                    }
                } else {
                    $passeord_error = "Password must be 5 character";
                }
            } else {
                $passeord_error1 = "Password field is required";
            }
        } else {
            $usernames_errors = "This Username or id is not your";
        }
    } else {
        $ferrors = "fild is required";
    }
}


?>
<style>
    .error {
        color: red;
        font-style: italic;

        font-weight: bold;

    }
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-settings"></i>
                </span> Forgot Password
            </h3>

        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Username or ID</label>
                                <input type="text" name="user" class="form-control" id="exampleInputUsername1" placeholder="Username">
                            </div>
                            <span class="error"><?php if (isset($ferrors)) {
                                                    echo $ferrors;
                                                } ?></span>
                            <span class="error"><?php if (isset($usernames_errors)) {
                                                    echo $usernames_errors;
                                                } ?></span>


                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputConfirmPassword1" placeholder="Password">
                            </div>
                            <span class="error"><?php if (isset($passeord_error1)) {
                                                    echo $passeord_error1;
                                                } ?></span>
                            <span class="error"><?php if (isset($passeord_error)) {
                                                    echo $passeord_error;
                                                } ?></span>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                <input type="password" class="form-control" name="cpassword" id="exampleInputConfirmPassword1" placeholder="Confirm password">
                            </div>
                            <span class="error"><?php if (isset($confirm_password_error)) {
                                                    echo $confirm_password_error;
                                                } ?></span>
                            <span class="error"><?php if (isset($confirms_password_error)) {
                                                    echo $confirms_password_error;
                                                } ?></span> <br>

                            <button type="submit" name="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <div class="col-sm-6 offset-sm-12">
                                <?php if (isset($update_sucess)) {
                                    echo '<p class="alert alert-success" role="alert col-sm-4 offset-sm-3">' . $update_sucess . '</p>';
                                } ?>
                            </div>
                            <div class="col-sm-6 offset-sm-12">
                                <?php if (isset($update_error)) {
                                    echo '<p class="alert alert-danger" role="alert col-sm-4 offset-sm-3">' . $update_error . '</p>';
                                } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>