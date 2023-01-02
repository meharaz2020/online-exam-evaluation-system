<?php
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>

        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <?php
                        $bre = mysqli_query($db, "SELECT * FROM users where role=0");

                        $bst = mysqli_num_rows($bre);
                        ?>
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Students <i class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $bst; ?></h2>
                        <!-- <h6 class="card-text">Increased by 60%</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <?php
                        $bre1 = mysqli_query($db, "SELECT * FROM users where (role=1 OR role=2)");

                        $bst1 = mysqli_num_rows($bre1);
                        ?>
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Teacher <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5"><?php echo $bst1; ?></h2>
                        <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                    </div>
                </div>
            </div>
           

 
        </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php
    include "footer.php";
    ?>