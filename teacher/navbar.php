 <?php

    include "db.php";

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../signin.php');
    }
    $user = $_SESSION['user_id'];


    ?>
 <!-- info collect -->

 <?php

    $user_name = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

    $userData = mysqli_fetch_assoc($user_name);
    $fn = $userData['name'];
    $role = $userData['role'];
    $image = $userData['image'];


    ?>
 <!-- info collect -->
 <!-- partial -->
 <div class="container-fluid page-body-wrapper">
     <!-- partial:partials/_sidebar.html -->
     <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <ul class="nav">
             <li class="nav-item nav-profile">
                 <a href="#" class="nav-link">
                     <div class="nav-profile-image">
                         <?php if (!$image =="") { ?>
                             <img src="../admin/image/photo/<?php echo  $userData['image']; ?>" alt="image">
                         <?php   } ?>
                         <?php if ($image =="") { ?>
                             <img src="../admin/image/photo/default.jpg"  >
                         <?php   } ?>


                         <span class="login-status online"></span>
                         <!--change to offline or busy as needed-->
                     </div>
                     <div class="nav-profile-text d-flex flex-column">
                         <span class="font-weight-bold mb-2"><?php echo  $fn; ?></span>
                         <span class="text-secondary text-small">
                             <?php
                                if ($role == 1) {
                                    echo "Teacher";
                                }
                                ?>
                         </span>
                     </div>
                     <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="teacherdashboard.php">
                     <span class="menu-title">Dashboard</span>
                     <i class="mdi mdi-home menu-icon"></i>
                 </a>
             </li>
             <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Add Student</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-key menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic6">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="student.php">Add Student</a></li>
                        <li class="nav-item"> <a class="nav-link" href="viewstudent.php">View Student</a></li>

                    </ul>
                </div>
            </li>
             <li class="nav-item">
                 <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic71" aria-expanded="false" aria-controls="ui-basic">
                     <span class="menu-title">Manage</span>
                     <i class="menu-arrow"></i>

                     <i class="mdi mdi-calendar-check menu-icon"></i>
                 </a>
                 <div class="collapse" id="ui-basic71">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="managetask.php">Task</a></li>
 
                     </ul>
                 </div>
             </li>
              
             <li class="nav-item">
                 <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic712" aria-expanded="false" aria-controls="ui-basic">
                     <span class="menu-title">Setting</span>
                     <i class="menu-arrow"></i>

                     <i class="mdi mdi-settings menu-icon"></i>
                 </a>
                 <div class="collapse" id="ui-basic712">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="updatepassword.php">Update Password</a></li>
 
                     </ul>
                 </div>
             </li>

             <li class="nav-item">
                 <a class="nav-link" href="logout.php">
                     <span class="menu-title">Sign Out</span>
                     <i class="mdi mdi-power menu-icon"></i>
                 </a>
             </li>



         </ul>
     </nav>