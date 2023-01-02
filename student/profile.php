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
$uname = $userData['username'];
 
$roll = $userData['roll'];
$classes = $userData['class'];
 
?>
 <?php
 $mentorInfo = "SELECT * FROM users WHERE id = '$user'";
 $mntrinfo = mysqli_query($db, $mentorInfo);
 
 while ($row = mysqli_fetch_assoc($mntrinfo)) {
     $id=$row['id'];
    //   $uname = $row['uname'];
 
     $ffname = $row['name'];
       
    
     $photo = $row['image'];
 }
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
                </span>Profile  

            </h3>

        </div>
        <div class="row">
            <div class="col-md-12 border-rignt">
                <a href="editprofile.php"> <button class=" float-end btn btn-sm btn-primary"><i class="mdi mdi-eyedropper"></i></button>
                </a>
            </div>

            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <?php $query0=mysqli_query($db,"SELECT * FROM users WHERE  id = '$user'");
                if(mysqli_num_rows($query0)==0){
                    ?>
                        <img class="rounded-circle mt-5" width="150px" src="../admin/image/photo/default.jpg">

                    <?php
                }else{ 
                    if (!$photo == "") { 
 
                        ?>
                        <img class="rounded-circle mt-5" width="150px" src="../admin/image/photo/<?php echo  $photo; ?>" alt="image">
                        <?php   } 
                        ?>
                        <?php if ($photo == "") { 
                        ?>
                        <img class="rounded-circle mt-5" width="150px" src="../admin/image/photo/default.jpg">
                        <?php  } 

                } ?>
                 </div>

            </div>
            <div class="col-md-4 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Personal Information:</h4>
                        <hr>
                    </div>

                    <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">User Name:</label>&nbsp; &nbsp; <?php echo $fn; ?></div>
                        <hr>
                        <div class="col-md-12"><label class="labels">User Name:</label>&nbsp; &nbsp; <?php echo $uname; ?></div>
                        <hr>
                        <div class="col-md-12"><label class="labels">Roll:</label>&nbsp;&nbsp; <?php echo $roll; ?></div>
                        <hr>
                        <div class="col-md-12"><label class="labels">Class:</label>&nbsp;&nbsp; <?php echo $classes; ?></div>
                        <hr>
                      
                      
                      
                       
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