<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<?php


if (isset($_GET['view'])) {

    $id = $_GET['view'];

    $mentorInfo = "SELECT * FROM mark WHERE id = '$id'";
    $mntrinfo = mysqli_query($db, $mentorInfo);

    while ($row = mysqli_fetch_assoc($mntrinfo)) {
        $name = $row['username'];
        $pdf = $row['image'];

        $roll = $row['roll'];
        $subject = $row['subject'];
        $class = $row['class'];
     }
}

?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-eye"></i>
                </span>  Dear <?php echo $name;?>
                <!-- <div class="col-md-12 grid-margin mt-3 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            
                            
                            <form action="" method="post">
                                <button name="view" class="btn btn-primary">view pdf</button>
                            </form>
                            </p>
                        </div>
                    </div>

                </div> -->

            </h3>

        </div>
        <div class="col-md-12">
        <div class="row justify-content-center">
             
     
            <?php
            // if (isset($_POST['view'])) { ?>

                <?php

                if (!$pdf == "") {
                ?>
                    <embed type="application/pdf" target="_blank" src="../teacher/uploads/<?php echo $pdf; ?>" width="1000" height="700"> </form>

                <?php
                }
                // if ($pdf == "") {
                // }

                ?>


            <?php



           // }
            ?>

 
    </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>