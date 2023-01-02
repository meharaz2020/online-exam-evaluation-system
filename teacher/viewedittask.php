<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<?php

$user = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

$userd = mysqli_fetch_assoc($user);


$u_id = $userd['id'];
?>
<?php


$id = $_GET['viewedit'];

$mentorInfo = "SELECT * FROM task WHERE id = '$id'";
$mntrinfo = mysqli_query($db, $mentorInfo);

while ($row = mysqli_fetch_assoc($mntrinfo)) {
    $sub = $row['subject'];
    $cat = $row['category'];
    $class = $row['class'];

    $task = $row['task'];
    $des = $row['description'];
    $from = $row['fo'];
    $to = $row['tos'];
}

?>
















<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-pen"></i>
                </span> <a href="managetask.php" style="text-decoration: none;color:black;">View Task</a>
            </h3>

        </div>
















        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">roll</th>
                                <th scope="col">mark</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ids = 1;
                            $datasql = mysqli_query($db, "Select * from mark where category='$cat' AND class='$class' AND teacher_id='$u_id' AND subject='$sub'");
                            while ($row = mysqli_fetch_assoc($datasql)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $ids; ?></th>
                                    <td><?php echo $row['roll'] ?></td>
                                    <td><?php echo $row['mark'] ?></td>
                                    <td>
                                        <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>

                                        <a onclick="return confirm('are you sure to delete');" href="viewedittask.php?delete=<?php echo $row['id']; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>

                                    </td>
                                </tr>
                            <?php $ids++;
                            }
                            ?>

                        </tbody>
                    </table>


                </div>
            </div>
        </div>

        <!-- edit task modal -->

        <?php



        $query = "SELECT * FROM mark";
        $all_books = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($all_books)) {
            $tids = $row['id'];



        ?>


            <!-- Modal -->
            <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mark Edit</h5>
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
                                                <label for="exampleInputName1">Roll</label>
                                                <input type="text" readonly class="form-control" id="exampleInputName1" name="roll" required autocomplete="off" value="<?php echo $row['roll']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Mark</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="mark" required autocomplete="off" value="<?php echo $row['mark']; ?>">
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

        <!-- edit task modal end -->
        <?php



        if (isset($_POST['update'])) {

            $updateid = $_POST['updateid'];

            $mark           = mysqli_real_escape_string($db, $_POST['mark']);
            



            $upadte = mysqli_query($db, "UPDATE mark SET mark='$mark' WHERE id = '$updateid'");

            if ($upadte) {


                echo "<script type='text/javascript'> document.location = 'managetask.php'; </script>";
            }
        }

        ?>

        <?php

        if (isset($_GET['delete'])) {


            $id = $_GET['delete'];
            $deleteInfo = "DELETE FROM  mark WHERE  id='$id'";
            $deletclassInfo = mysqli_query($db, $deleteInfo);

            if ($deletclassInfo) {
                header('Location: managetask.php');
            }
        }

        ?>





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