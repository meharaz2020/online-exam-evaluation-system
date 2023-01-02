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
$uid = $userData['id'];
$fn = $userData['name'];
$role = $userData['role'];
$image = $userData['image'];
$username = $userData['username'];
$roll = $userData['roll'];





?>
<style>
    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-face"></i>
                </span> Profile

            </h3>

        </div>
        <div class="row">
            <div class="col-md-12 border-rignt">
                <a href="" data-bs-toggle="modal" data-bs-target="#class-<?php echo $uid; ?>"> <button class=" float-end btn btn-sm btn-primary"><i class="mdi mdi-eyedropper"></i></button>
                </a>
            </div>

            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><?php if (!$image == "") { ?>
                        <img class="rounded-circle mt-5" width="150px" src="../admin/image/photo/<?php echo  $userData['image']; ?>" alt="image">
                    <?php   } ?>
                    <?php if ($image == "") { ?>
                        <img class="rounded-circle mt-5" width="150px" src="../admin/image/photo/default.jpg">
                    <?php   } ?> 
                </div>

            </div>
            <div class="col-md-7 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Personal Information:</h4>
                        <hr>
                    </div>
                    <h4>Name: <?php echo $fn;?></h4>
                    <h4>Username: <?php echo $username;?></h4>
                    <h4>TeacherID: <?php echo $roll;?></h4>

                </div>
            </div>
            <div class="col-md-2 border-right">

            </div>


        </div>
        <!-- modal start -->


        <?php



        $query = "SELECT * FROM users WHERE id='$uid'";
        $all_books = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($all_books)) {
            $ids = $row['id'];



        ?>


            <!-- Modal -->
            <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Profile Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <!-- modal form -->
                            <div class="col-12 col-sm-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">

                                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" id="exampleInputName1" name="updateid" required autocomplete="off" value="<?php echo $row['id']; ?>">

                                            <div class="form-group">
                                                <label for="exampleInputName1">Full Name</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="name" required autocomplete="off" value="<?php echo $row['name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Username</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="uname" required autocomplete="off" value="<?php echo $row['username']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Email</label>
                                                <input type="email" class="form-control" id="exampleInputName1" name="uemail" required autocomplete="off" value="<?php echo $row['email']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Teacher ID</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="roll" required autocomplete="off" value="<?php echo $row['roll']; ?>">
                                            </div>
                                             
                                            <div class="form-group">
                                                <label for="exampleInputName1">Photo</label>

                                                <input type="file" class="form-control" name="newphoto" id="exampleInputPassword2" placeholder="Photo">
                                            </div>

                                            <button type="submit" class="btn btn-gradient-primary me-2" name="update">Submit</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal form end -->


                        </div>
                        <?php

                        if (isset($_POST['update'])) {

                            $updateid = $_POST['updateid'];
                            $mentorInfo = "SELECT * FROM users WHERE id = '$updateid' AND (role=2 OR role=1)";
                            $mntrinfo = mysqli_query($db, $mentorInfo);

                            while ($row = mysqli_fetch_assoc($mntrinfo)) {
                                $photo = $row['image'];
                            }


                            if (!$_FILES['newphoto']['name'] == "") {

                                $newphoto = $_FILES['newphoto']['name'];
                                $newphoto = explode('.', $_FILES['newphoto']['name']);
                                $newphoto = end($newphoto);
                                $random = rand(0, 100000);


                                $new_photo_name = $random . '.' . $newphoto;

                                $query = "UPDATE users SET  image='$new_photo_name'  WHERE id = '$updateid' AND (role=1 OR role=2)";
                                $addclass = mysqli_query($db, $query);
                                move_uploaded_file($_FILES['newphoto']['tmp_name'], '../admin/image/photo/' . $new_photo_name);


                                echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                            } else {
                                $upadte = mysqli_query($db, "UPDATE users SET image='$photo'  WHERE id = '$updateid' AND (role=1 OR role=2)");
                                echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                            }
                        }

                        ?>

                        <?php



                        if (isset($_POST['update'])) {

                            $updateid = $_POST['updateid'];

                            $name           = mysqli_real_escape_string($db, $_POST['name']);
                            $uname           = mysqli_real_escape_string($db, $_POST['uname']);
                            $email           = mysqli_real_escape_string($db, $_POST['uemail']);
                            $roll           = mysqli_real_escape_string($db, $_POST['roll']);


                           
 


                            $upadte = mysqli_query($db, "UPDATE users SET name='$name',username='$uname',email='$email',roll='$roll' WHERE id = '$updateid' AND (role=1 OR role=2)");

                            if ($upadte) {


                                echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                            }
                        }










                        ?>

                    </div>
                </div>
            </div>
            <!-- modal end -->
        <?php } ?>

    </div>

    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>