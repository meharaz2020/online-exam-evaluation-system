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
$uname = $userData['username'];

$roll = $userData['roll'];
$classes = $userData['class'];
$image = $userData['image'];


?>

<?php

?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-face"></i>
                </span> Profile Edit
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
                                <input type="text" required class="form-control" id="exampleInputUsername1" name="name" value="<?php echo $fname; ?>" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">User Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" name="uname" value="<?php echo $uname; ?>" placeholder="User name">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Roll</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="roll" value="<?php echo $roll; ?>" placeholder="Roll">
                            </div>







                    </div>
                </div>
            </div>



            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="exampleInputName1">Class</label>

                            <div class="col-sm-9">
                                <select class="form-select" name="class" aria-label="Default select example">

                                    <!-- read class -->


                                    <option value="one" <?php if ($classes  == 'one') {
                                                            echo 'selected';
                                                        } ?>>One</option>
                                    <option value="two" <?php if ($classes  == 'two') {
                                                            echo 'selected';
                                                        } ?>>Two</option>
                                    <option value="three" <?php if ($classes  == 'three') {
                                                                echo 'selected';
                                                            } ?>>Three</option>
                                    <option value="four" <?php if ($classes  == 'four') {
                                                                echo 'selected';
                                                            } ?>>Four</option>
                                    <option value="five" <?php if ($classes == 'five') {
                                                                echo 'selected';
                                                            } ?>>Five</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputName1">Previous Photo</label>
                            <?php

                            if ($image == null) { ?>

                                <img style="height: 41px;width:100px;" class="mb-3" alt="profile photo" src="../admin/image/photo/default.jpg" />
                            <?php
                            } else { ?>
                                <img style="height: 41px;width:100px;" class="mb-3" src="../admin/image/photo/<?php echo $image; ?>" alt="Book photo">



                            <?php
                            }
                            ?>
                            <br>
                            <label for="exampleInputPassword1">Photo</label>
                            <input type="file" class="form-control" name="newphoto" id="exampleInputPassword2" placeholder="Photo">
                        </div>



                        <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Update</button>



                        </form>
                    </div>
                </div>
            </div>
            <!-- update start -->
            <?php
            if (isset($_POST['submit'])) {


                $fname           = mysqli_real_escape_string($db, $_POST['name']);
                $uname           = mysqli_real_escape_string($db, $_POST['uname']);


                $roll           = mysqli_real_escape_string($db, $_POST['roll']);
                $class        = mysqli_real_escape_string($db, $_POST['class']);




                $upadte = mysqli_query($db, "UPDATE users SET name='$fname',username='$uname',roll='$roll',class='$class'  WHERE id = '$user' AND role=0");

                if ($upadte) {
                    echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                }
            }
            ?>

            <?php

            if (isset($_POST['submit'])) {


                // $mentorInfo = "SELECT * FROM stu_info WHERE sid = '$uid'";
                // $mntrinfo = mysqli_query($db, $mentorInfo);

                // while ($row = mysqli_fetch_assoc($mntrinfo)) {
                //     $photo = $row['photo'];
                // }


                if (!$_FILES['newphoto']['name'] == "") {
                    $ffname           = mysqli_real_escape_string($db, $_POST['name']);

                    $newphoto = $_FILES['newphoto']['name'];
                    $newphoto = explode('.', $_FILES['newphoto']['name']);
                    $newphoto = end($newphoto);
                    $random = rand(0, 100000);

                    $new_photo_name = $random . $ffname . '.' . $newphoto;

                    $query = "UPDATE users SET  image='$new_photo_name'  WHERE id = '$user'";
                    $addclass = mysqli_query($db, $query);
                    move_uploaded_file($_FILES['newphoto']['tmp_name'], '../admin/image/photo/' . $new_photo_name);


                    echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                } //else {
                //     $upadte = mysqli_query($db, "UPDATE stu_info SET photo='$photo'  WHERE id = '$id'");
                //     echo "<script type='text/javascript'> document.location = 'viewstudentinfo.php'; </script>";
                // }
            }

            ?>
            <!-- update end -->
        </div>

    </div>

    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>