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
$fname = $userData['name'];
$role = $userData['role'];

$uid = $userData['id'];
?>
<style>
    @media only screen and (max-width: 600px) {
        .table th, .table td{
    padding: 5px !important;
   }
}
    
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-bookmark-plus"></i>                 </span> <a href="managetask.php" style="text-decoration: none;color:black;">View Task</a>

            </h3>

        </div>
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Task Details</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By class or subject" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-gradient-primary" style="padding-bottom: 20px" name="fdata" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php


                        if (isset($_POST['fdata'])) {

                            $sdata = $_POST['sdata'];

                            $query = "SELECT * FROM task WHERE teacher_id='$uid' AND (class LIKE '%$sdata%'OR subject LIKE '%$sdata%')";

                            $search_query = mysqli_query($db, $query);
                            $count = mysqli_num_rows($search_query);

                            if ($count > 0) { ?>
                                <!-- search book end -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <!-- <th> Id </th> -->
                                            <th> Category </th>

                                            <th> Subject </th>
                                            <th> Class </th>

                                            <th>Action</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $ids = 1;
                                        while ($row = mysqli_fetch_assoc($search_query)) {
                                            $id = $row['id'];
                                        ?>
                                            <tr>
                                                <!-- <td> <?php //echo $ids; ?> </td> -->
                                                <td> <?php echo $row['category']; ?> </td>

                                                <td> <?php echo $row['subject']; ?> </td>
                                                <td> <?php echo $row['class']; ?></td>

                                                <td>
                                                    <a href="viewtask.php?view=<?php echo $id; ?>" title="" class="text-info"><i class="mdi mdi-eye"></i></a>
                                                    <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $id; ?>"><i class="mdi mdi-marker"></i></a>
                                                    <a   href="taskstudent.php" title="" class="text-warning"><i class="mdi mdi-account-multiple"></i></a>
                                                    <a href="viewedittask.php?view=<?php echo $id; ?>" title="" class="text-info"><i class="mdi mdi-arrow-up-bold-circle-outline"></i></a>

                                                    <a onclick="return confirm('are you sure to delete');" href="managetask.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>

                                                </td>
                                            </tr>
                                        <?php $ids++;
                                        }   ?>
                                    </tbody>
                                </table>





                            <?php } else {
                                echo "<h3 style=' 
                                 text-align: center;
                                 color: rebeccapurple;
                                 '>Task not found</h3>";
                            }
                        } else { ?>
                            <!-- search book end -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- <th> Id </th> -->
                                        <th> Category </th>

                                        <th> Subject </th>
                                        <th> Class </th>

                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $per_page = 5;
                                    $ids = 1;

                                    if (isset($_GET['page'])) {



                                        $page = $_GET['page'];
                                    } else {
                                        $page = "";
                                    }
                                    if ($page == "" || $page == 1) {
                                        $page_1 = 0;
                                    } else {
                                        $page_1 = ($page * $per_page) - $per_page;
                                    }




                                    $post_query_count = "select * from task where teacher_id='$uid'";
                                    $find_count = mysqli_query($db, $post_query_count);
                                    $count = mysqli_num_rows($find_count);
                                    $count = ceil($count / 5);




                                    $rr = mysqli_query($db, "select * from task where teacher_id='$uid'  LIMIT $page_1, $per_page  ");
                                    while ($row = mysqli_fetch_assoc($rr)) {
                                        $id = $row['id'];
                                    ?>
                                        <tr>
                                            <!-- <td> <?php // echo $ids; ?> </td> -->
                                            <td> <?php echo $row['category']; ?> </td>

                                            <td> <?php echo $row['subject']; ?> </td>
                                            <td> <?php echo $row['class']; ?> </td>

                                            <td>
                                                <a href="viewtask.php?view=<?php echo $id; ?>" title="" class="text-info"><i class="mdi mdi-eye"></i></a>
                                                <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $id; ?>"><i class="mdi mdi-marker"></i></a>
                                                <a   href="taskstudent.php?alltask=<?php echo $id; ?>" title="" class="text-warning"><i class="mdi mdi-account-multiple"></i></a>
                                                <a href="viewedittask.php?viewedit=<?php echo $row['id']; ?>" title="" class="text-info"><i class="mdi mdi-arrow-up-bold-circle-outline"></i></a>

                                                <a onclick="return confirm('are you sure to delete');" href="managetask.php?del=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>

                                            </td>
                                        </tr>
                                    <?php $ids++;
                                    }   ?>
                                </tbody>
                            </table>



                            <nav aria-label="Page navigation example" style="padding-top:2px" ;>
                                <ul class="pagination">
                                    <?php
                                    for ($i = 1; $i <= $count; $i++) {
                                        if ($page == $i) {
                                            $cc = "style='background:green;margin-left: 2px;color:white;margin-right: 2px;'";

                                            echo "<li class='page-item'><a {$cc} class='page-link' href='managetask.php?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='managetask.php?page={$i}'>{$i}</a></li>";
                                        }
                                    }

                                    ?>
                                </ul>
                            </nav>


                        <?php }
                        ?>

                    </div>
                </div>
                <!-- modal start -->


                <?php



                $query = "SELECT * FROM task";
                $all_books = mysqli_query($db, $query);
                while ($row = mysqli_fetch_assoc($all_books)) {
                    $tids = $row['id'];



                ?>


                    <!-- Modal -->
                    <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Task Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">


                                    <!-- modal form -->
                                    <div class="col-12 col-sm-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">

                                                <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" class="form-control" id="exampleInputName1" name="updateid" required autocomplete="off" value="<?php echo $row['id']; ?>">

                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Task</label>
                                                        <input type="text" class="form-control" id="exampleInputName1" name="task" required autocomplete="off" value="<?php echo $row['task']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleTextarea1">Description</label>
                                                        <textarea class="form-control" name="des" id="exampleTextarea1" rows="4"><?php echo $row['description']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">From</label>
                                                        <input type="date" class="form-control" name="fo" id="exampleInputUsername1" value="<?php echo $row['fo']; ?>" placeholder="Task date">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">To</label>
                                                        <input type="date" class="form-control" name="to" id="exampleInputUsername1" value="<?php echo $row['tos']; ?>" placeholder="Task end date">
                                                    </div>




                                                    <button type="submit" class="btn btn-gradient-primary me-2" name="update">Update</button>
                                                    <button class="btn btn-light">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal form end -->


                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- modal end -->
                <?php } ?>

            </div>

        </div>
        <?php



        if (isset($_POST['update'])) {

            $updateid = $_POST['updateid'];

            $task           = mysqli_real_escape_string($db, $_POST['task']);
            $des           = mysqli_real_escape_string($db, $_POST['des']);


            $fo            = mysqli_real_escape_string($db, $_POST['fo']);
            $to            = mysqli_real_escape_string($db, $_POST['to']);




            $upadte = mysqli_query($db, "UPDATE task SET task='$task',description='$des',fo='$fo',tos='$to' WHERE id = '$updateid'");

            if ($upadte) {


                echo "<script type='text/javascript'> document.location = 'managetask.php'; </script>";
            }
        }

        ?>

    </div>
    <?php

    if (isset($_GET['del'])) {


        $did = $_GET['del'];
        $deleteInfo = "DELETE FROM  task WHERE  id='$did' AND teacher_id='$uid'";
        $deletusersInfo = mysqli_query($db, $deleteInfo);
        if ($deletusersInfo) {
            echo "<script type='text/javascript'> document.location = 'managetask.php'; </script>";
        }
    }

    ?>

    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>