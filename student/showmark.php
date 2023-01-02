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
<style>
    @media only screen and (max-width: 600px) {
        .table th, .table td{
    padding: 10px !important;
    font-size: 12px;
   }
}
    
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Mark
            </h3>

        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Subject</th>
                                    <th scope="col">Mark</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Download</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $usermark = mysqli_query($db, "select * from mark where username='$username' and class='$class'");
                                while ($row = mysqli_fetch_assoc($usermark)) {
                                ?>

                                    <tr>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td><?php echo $row['mark']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td>
                                         
                                            <a href="managemark.php?view=<?php echo $row['id']; ?>" title="" class="text-success"><i class="mdi mdi-eye"></i></a>
                                            <?php

                                            if (!$row['image'] == "") { ?>
                                                <a class="text-success" href="download.php?file=<?php echo $row['image']; ?>"><i class="mdi mdi-cloud-download"></i></a>

                                            <?Php  } else {
                                            }
                                            ?>

                                    </tr>
                                <?php
                                }
                                ?></td>

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