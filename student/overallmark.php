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
$id = $userData['id'];
$class = $userData['class'];
$username = $userData['username'];


?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Over All Mark
            </h3>

        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <div class="btn btn-sm btn-success mb-2">
                            <a href="allstudent_mark.php" style="text-decoration: none; color:white;">All subject mark</a> &nbsp;
                        </div>
                        <div class="btn btn-sm btn-success mb-2">
                            <a href="allstudent_overall_mark.php" style="text-decoration: none; color:white;">All Student overall mark</a>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Subject</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Avg</th>

                                </tr>
                                <?php

                                $usermark = mysqli_query($db, "select subject,sum(mark) as total from mark where username='$username' and class='$class' group by subject;");
                                while ($row = mysqli_fetch_assoc($usermark)) {
                                ?>
                                    <tr>

                                        <th scope="col"><?php echo $row['subject']; ?></th>
                                        <th scope="col"><?php echo $row['total']; ?></th>
                                        <th scope="col"><?php echo $row['total'] / 5; ?></th>


                                    </tr>

                                <?php } ?>
                            </thead>
                            <tbody>






                            </tbody>
                        </table>

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