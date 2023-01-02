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
                </span>Over All Mark
            </h3>

        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">

                    <div class="btn btn-sm btn-success">
                            <a target="_blank" href="mark_pdf.php?view=<?php echo $class; ?>" style="text-decoration: none; color:white;">PDF</a> &nbsp;
                        </div>           



                        <table class="table">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Roll</th>
                                    <th scope="col">Username</th>
                                     
                                    <th scope="col">Mark</th>
                                    
                                    <th scope="col">Position</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
 
                                    $j = 1;
                                    $usermark = mysqli_query($db, "select roll,subject,username, sum(mark) as total from mark where class='$class' group by username order by total desc;");
                                    while ($row = mysqli_fetch_assoc($usermark)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['roll']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                             <td><?php echo $row['total']; ?></td>
                                             <td><?php echo $j; ?></td>


                                        <?php

                                      $j++; }
                                 
                                        ?>
                                     
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