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
$classes = $userData['class'];

$uid = $userData['id'];
?>
 
 
<!-- task end code -->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span><?php
                        if ($role == 1) {
                            echo 'Teacher';
                        } elseif ($role == 3) {
                            echo 'Admin';
                        } elseif ($role == 0) {
                            echo 'Student';
                        }
                        ?> Dashboard
            </h3>


        </div>
        <div class="row">
            <div class="col-md-6 stretch-card grid-margin">

                <!-- <div class="col-md-12 mb-5"> -->
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <h1 class="font-weight-normal mb-3 text-white">Hello <?php echo $fname; ?>
                            </h1>
                            <h4>Have a nice day at work &#128516;</h4>
                        </div>
                    </div>
                     
                <!-- </div> -->



            </div>
             

            <div class="col-md-6 stretch-card grid-margin">

                <!-- <div class="col-md-12 mb-5"> -->
                    <div class="card bg-gradient-danger">
                        <div class="card-body">
                            <?php
                            $date = date('d-m-y');

                            $orderdate = $date;
                            $orderdate = explode('-', $orderdate);
                            $day   = $orderdate[1];
                            $month = $orderdate[0];
                            $year  = $orderdate[2];
                            ?>

<h3 class="text-center"><?php echo $month . '-' . $day . '-' . $year; ?></h3>
                            <?php
                      $rr = mysqli_query($db, "select * from task where  class='$classes' && tos>=CURDATE()");
                      $n=mysqli_num_rows($rr);
                    ?>
                            <h3 class="font-weight-normal mb-3 text-white text-center">View TASK (<?php echo $n;?>)
                            </h3>

                            <div class="text-center">
                                <!-- <h4><button class="btn btn-sm btn-primary"><i class="mdi mdi-calendar-plus"></i></button></h4> -->
                                <a href="viewtask.php" title="" class=" btn btn-sm btn-primary view_payment" ><i class="mdi mdi-calendar-plus"></i></a>

                            </div>

                        </div>
                    </div>
                   

                <!-- </div> -->

            </div>
        </div>
    </div>
</div>


                    
                <!-- modal end -->
            </div>
 
           


    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>