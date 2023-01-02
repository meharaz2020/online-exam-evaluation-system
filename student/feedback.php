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
$fn = $userData['name'];
$role = $userData['role'];
$image = $userData['image'];
$roll = $userData['roll'];
$class = $userData['class'];



?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Email
            </h3>

        </div>
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <?php include "../index/message.php"; ?>
                        <form class="forms-sample" action="teacher_mail.php" method="POST" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $fn; ?>" autocapitalize="off" placeholder="Enter ypur name">
                            </div>

                            <input type="hidden" class="form-control" name="roll" value="<?php echo $roll; ?>" autocapitalize="off" placeholder="Enter ypur name">

                            <input type="hidden" class="form-control" name="class" value="<?php echo $class; ?>" autocapitalize="off" placeholder="Enter ypur name">




                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label>

                                <select class="form-select" name="email" aria-label="Default select example">
                                    <option selected>All Mail</option>
                                    <!-- read class -->
                                    <?php

                                    $query = "SELECT * FROM users where role=2 or role=1";
                                    $all_class = mysqli_query($db, $query);
                                    while ($row = mysqli_fetch_assoc($all_class)) {

                                        $subject = $row['email'];



                                    ?>
                                        <!-- read class end -->

                                        <option value="<?php echo  $subject; ?>"><?php echo $subject; ?></option>
                                    <?php  }

                                    ?>

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Send</button>


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