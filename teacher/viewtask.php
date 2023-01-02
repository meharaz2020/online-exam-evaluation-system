<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<?php

$user = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

$userd = mysqli_fetch_assoc($user);


$u_id = $userd['id'];
?>
<?php
if (isset($_GET['view'])) {

    $id = $_GET['view'];
}
$mentorInfo = "SELECT * FROM task WHERE id = '$id'";
$mntrinfo = mysqli_query($db, $mentorInfo);

while ($row = mysqli_fetch_assoc($mntrinfo)) {
    $sub = $row['subject'];
    $cat = $row['category'];
    $classes=$row['class'];

     $task = $row['task'];
    $des = $row['description'];
    $from = $row['fo'];
    $to = $row['tos'];
}
 
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-pen"></i>
                </span> <a href="managetask.php" style="text-decoration: none;color:black;">View Task</a>
            </h3>

        </div>
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <h1 class="text-center"><?php echo $cat; ?></h1>

                      <h4 class="text-center">Task: <?php echo $task; ?></h4>

                         <h6 class="text-center">  <?php echo 'From ' .$from. ': To '.$to; ?></h6>

                        <hr>
                        <h6>Class: <?php echo $classes; ?></h6>
                         <h4>Subject: <?php echo $sub; ?></h4>
                        <p>Description: <?php echo $des; ?></p>



                     
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