<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<!-- teacher info add -->
<?php





if (isset($_POST['submit'])) {




    $name           = mysqli_real_escape_string($db, $_POST['name']);
    $username           = mysqli_real_escape_string($db, $_POST['username']);
    $email           = mysqli_real_escape_string($db, $_POST['email']);
    $teacher_id           = mysqli_real_escape_string($db, $_POST['roll']);

    $password           = mysqli_real_escape_string($db, $_POST['pass']);
    $pass = password_hash($password, PASSWORD_DEFAULT);


    $role             = mysqli_real_escape_string($db, $_POST['role']);

    $photo = explode('.', $_FILES['photo']['name']);
    $photo  = end($photo);
    $random = rand(0, 100000);

    $photo_name = $random . $name . '.' . $photo;

    $status = 1;
    $querys = mysqli_query($db, "SELECT * FROM users WHERE username ='$username'");
    if (mysqli_num_rows($querys) == 0) {

        $querys1 = mysqli_query($db, "SELECT * FROM users WHERE email ='$email'");
        if (mysqli_num_rows($querys1) == 0) {
            if ($photo == "") {
                $result = mysqli_query($db, "INSERT INTO users (name,username,email,roll,password,status,role)
        VALUES 
              ('$name','$username','$email','$teacher_id','$pass','$status','$role')");
                if ($result) {
                    echo "<script type='text/javascript'> document.location = 'teacher.php'; </script>";
                }
            } else {
                $result = mysqli_query($db, "INSERT INTO users (name,username,email,roll,password,image,status,role)
        VALUES 
              ('$name','$username','$email','$teacher_id','$pass','$photo_name','$status','$role')");
                move_uploaded_file($_FILES['photo']['tmp_name'], 'image/photo/' . $photo_name);
                if ($result) {
                    echo "<script type='text/javascript'> document.location = 'teacher.php'; </script>";
                }
            }
        } else {
            $confirms_error1 = "User email already exists";
        }
    } else {
        $confirms_error = "User name already exists";
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
<!-- teacher info end -->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-key"></i>
                </span> Teacher
            </h3>

        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Teacher form</h4>

                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Full Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" required name="name" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" required name="username" placeholder="Username">
                            </div>
                            <span class="error"><?php if (isset($confirms_error)) {
                                                    echo $confirms_error;
                                                } ?></span>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" required name="email" placeholder="Email">
                            </div>
                            <span class="error"><?php if (isset($confirms_error1)) {
                                                    echo $confirms_error1;
                                                } ?></span>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" required name="pass" placeholder="Password">
                            </div>



                    </div>
                </div>
            </div>



            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Id</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" required name="roll" placeholder="Teacher ID">
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" required class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="role" aria-label="Default select example">
                                    <option selected>All Role</option>
                                    <!-- read class -->


                                    <option value="2">Admin</option>
                                    <option value="1">Teacher</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="photo" id="exampleInputPassword2" placeholder="Photo">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Submit</button>
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