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

                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">



                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label>

                                <select class="form-select" name="subject" aria-label="Default select example">
                                    <option selected>All Subject</option>
                                    <!-- read class -->
                                    <?php

                                    $query = "SELECT * FROM addsubject  GROUP BY sub_name ORDER BY id ASC";
                                    $all_class = mysqli_query($db, $query);
                                    while ($row = mysqli_fetch_assoc($all_class)) {

                                        $subject = $row['sub_name'];



                                    ?>
                                        <!-- read class end -->

                                        <option value="<?php echo  $subject; ?>"><?php echo $subject; ?></option>
                                    <?php  }

                                    ?>

                                </select>

                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Submit</button>


                        </form>



                        <table class="table">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Roll</th>
                                    <!-- <th scope="col">Username</th> -->
                                    <th scope="col">Subject</th>
                                    <th scope="col">Mark</th>
                                    <th scope="col">Avg</th>
                                    <th scope="col">Position</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                if (isset($_POST['submit'])) {

                                    $su = mysqli_real_escape_string($db, $_POST['subject']);
                                ?>


                                    <?php
                                    $j = 1;
                                    $usermark = mysqli_query($db, "select roll,subject,username, sum(mark) as total from mark where class='$class' and subject='$su' group by username order by total desc;");
                                    while ($row = mysqli_fetch_assoc($usermark)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['roll']; ?></td>
                                            <!-- <td><?php //echo $row['username']; ?></td> -->
                                            <td><?php echo $row['subject']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td><?php echo $row['total'] / 5; ?></td>
                                            <td><?php echo $j; ?></td>


                                        <?php

                                      $j++; }
                                 
                                        ?>
                                    <?php

                                }

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