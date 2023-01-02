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
    $student_id           = mysqli_real_escape_string($db, $_POST['roll']);
    $class           = mysqli_real_escape_string($db, $_POST['class']);

    $password           = mysqli_real_escape_string($db, $_POST['pass']);
    $pass = password_hash($password, PASSWORD_DEFAULT);



    $photo = explode('.', $_FILES['photo']['name']);
    $photo  = end($photo);
    $random = rand(0, 100000);

    $photo_name = $random . $name . '.' . $photo;

    $status = 1;
    $querys = mysqli_query($db, "SELECT * FROM users WHERE username ='$username'");
    if (mysqli_num_rows($querys) == 0) {
        if ($photo == "") {
            $result = mysqli_query($db, "INSERT INTO users (name,username,roll,class,password)
        VALUES 
              ('$name','$username','$student_id','$class','$pass')");
            if ($result) {
                echo "<script type='text/javascript'> document.location = 'student.php'; </script>";
            }
        } else {
            $result = mysqli_query($db, "INSERT INTO users (name,username,roll,class,password,image)
        VALUES 
              ('$name','$username','$student_id','$class','$pass','$photo_name')");
            move_uploaded_file($_FILES['photo']['tmp_name'], '../admin/image/photo/' . $photo_name);
            if ($result) {
                echo "<script type='text/javascript'> document.location = 'student.php'; </script>";
            }
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
                </span> Student
            </h3>

        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student form</h4>

                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Full Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" required name="name" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="username" class="form-control" id="exampleInputEmail1" required name="username" placeholder="Username">
                            </div>
                            <span class="error"><?php if (isset($confirms_error)) {
                                                    echo $confirms_error;
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
                        <label for="exampleInputPassword1">Class</label>

                            <select class="form-select" name="class" aria-label="Default select example">
                                <option selected>All Classes</option>
                                <!-- read class -->



                                <option value="one">One</option>
                                <option value="two">Two</option>
                                <option value="three">Three</option>
                                <option value="four">Four</option>
                                <option value="five">Five</option>


                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Student Id</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" required name="roll" placeholder="Student Id">
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