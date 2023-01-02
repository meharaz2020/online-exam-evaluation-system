<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>


<style>
    @media only screen and (max-width: 600px) {

        .table th,
        .table td {
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
                                <select class="form-select" name="class" aria-label="Default select example">
                                    <option selected>All Classes</option>
                                    <!-- read class -->



                                    <option value="one">One</option>
                                    <option value="two">Two</option>
                                    <option value="three">Three</option>
                                    <option value="four">Four</option>
                                    <option value="five">Five</option>


                                </select>

                            </div>

                            <button type="submit" class="btn btn-gradient-primary mb-5" name="submit">Submit</button>


                        </form>



                        <table class="table">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Roll</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Mark</th>
                                    <th scope="col">Avg</th>
                                    <th scope="col">Position </th>



                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                if (isset($_POST['submit'])) {

                                    $class = mysqli_real_escape_string($db, $_POST['class']);
                                ?>


                                    <?php
                                    $j = 1;
                                    $allusermark = mysqli_query($db, "select roll,username, sum(mark) as total from mark where class='$class' group by username order by total desc;");
                                    while ($row = mysqli_fetch_assoc($allusermark)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['roll']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td><?php echo $row['total'] / 5; ?></td>
                                            <td><?php echo $j; ?></td>


                                        <?php

                                        $j++;
                                    }

                                        ?>

                                        <div class="btn btn-sm btn-success position-absolute bottom-50 end-0">
                                            <a target="_blank" href="mark_pdf.php?view=<?php echo $class; ?>" style="text-decoration: none; color:white;">PDF</a> &nbsp;
                                        </div>
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