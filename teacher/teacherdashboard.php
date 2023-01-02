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

<!-- task add code -->
<?php
if (isset($_POST['taskadd'])) {
    $category           = mysqli_real_escape_string($db, $_POST['category']);
    $sub           = mysqli_real_escape_string($db, $_POST['sub']);
    $class           = mysqli_real_escape_string($db, $_POST['class']);
    $task           = mysqli_real_escape_string($db, $_POST['task']);
    $des           = mysqli_real_escape_string($db, $_POST['des']);
    $fo           = mysqli_real_escape_string($db, $_POST['fo']);
    $tos          = mysqli_real_escape_string($db, $_POST['to']);
    $taskadd = mysqli_query($db, "INSERT INTO task (teacher_id,category,subject,class,task,description,fo,tos)
    VALUES 
          ('$uid','$category','$sub','$class','$task','$des','$fo','$tos')");
    if ($taskadd) {
        echo "<script type='text/javascript'> document.location = 'teacherdashboard.php'; </script>";
    }
}

?>
<!-- task end code -->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span><?php
                        if ($role == 1) {
                            echo 'Teacher';
                        } elseif ($role == 3) {
                            echo 'Admin';
                        } elseif ($role == 0) {
                            echo 'Student';
                        }
                        ?> Dashboard
            </h3>


        </div>
        <div class="row">
            <div class="col-md-6 stretch-card grid-margin">

                <!-- <div class="col-md-12 mb-5"> -->
                    <div class="card bg-gradient-danger">
                        <div class="card-body">
                            <h1 class="font-weight-normal mb-3 text-white">Hello <?php echo $fname; ?>
                            </h1>
                            <h4>Have a nice day at work &#128516;</h4>
                        </div>
                    </div>

                <!-- </div> -->



            </div>

            <div class="col-md-6 stretch-card grid-margin">

                <!-- <div class="col-md-12 mb-5"> -->
                    <div class="card bg-gradient-danger">
                        <div class="card-body">
                            <?php
                            $date = date('d-m-y');

                            $orderdate = $date;
                            $orderdate = explode('-', $orderdate);
                            $day   = $orderdate[1];
                            $month = $orderdate[0];
                            $year  = $orderdate[2];
                            ?>

                            <h3 class="text-center"><?php echo $month . '-' . $day . '-' . $year; ?></h3>
                            <h3 class="font-weight-normal mb-3 text-white text-center">ADD TASK
                            </h3>

                            <div class="text-center">
                                <!-- <h4><button class="btn btn-sm btn-primary"><i class="mdi mdi-calendar-plus"></i></button></h4> -->
                                <a href="" title="" class=" btn btn-sm btn-primary view_payment" data-bs-toggle="modal" data-bs-target="#task"><i class="mdi mdi-calendar-plus"></i></a>

                            </div>

                        </div>
                    </div>


                <!-- </div> -->






            </div>
        </div>

        <!-- task modal start -->
        <div class="modal fade" id="task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Task Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <!-- modal form -->
                        <div class="col-12 col-sm-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">

                                            <select class="form-select" name="category" aria-label="Default select example">
                                                <option selected>All Category</option>
                                                <!-- read class -->



                                                <option value="Drawing">Drawing</option>
                                                <option value="Assignment">Assignment</option>
                                                <option value="Vocabulary">Vocabulary</option>
                                                <option value="Game">Game </option>
                                                <option value="Phycomoto">Phycomoto</option>


                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Subject</label>
                                            <select class="form-select" name="sub" aria-label="Default select example">
                                                <option selected>All Subject</option>
                                                <!-- read class -->
                                                <?php

                                                $query = "SELECT * FROM teacher_assign where teacher_id='$uid'";
                                                $all_class = mysqli_query($db, $query);
                                                while ($row = mysqli_fetch_assoc($all_class)) {

                                                    $subject = $row['subject'];



                                                ?>
                                                    <!-- read class end -->


                                                    <option value="<?php echo  $subject; ?>"><?php echo $subject; ?></option>
                                                <?php  }

                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Class</label>
                                            <select class="form-select" name="class" aria-label="Default select example">
                                                <option selected>All Classes</option>
                                                <!-- read class -->
                                                <?php

                                                $query = "SELECT * FROM teacher_assign where teacher_id='$uid' group by class";
                                                $all_class = mysqli_query($db, $query);
                                                while ($row = mysqli_fetch_assoc($all_class)) {

                                                    $class = $row['class'];



                                                ?>
                                                    <!-- read class end -->


                                                    <option value="<?php echo  $class; ?>"><?php echo $class; ?></option>
                                                <?php  }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Task Title</label>
                                            <input type="text" class="form-control" name="task" id="exampleInputUsername1" placeholder="Task Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea1">Description</label>
                                            <textarea class="form-control" name="des" id="exampleTextarea1" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">From</label>
                                            <input type="date" class="form-control" name="fo" id="exampleInputUsername1" placeholder="Task date">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">To</label>
                                            <input type="date" class="form-control" name="to" id="exampleInputUsername1" placeholder="Task end date">
                                        </div>
                                        <button type="submit" name="taskadd" class="btn btn-sm btn-gradient-primary me-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal form end -->


                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->

        <!-- modal end -->
        <!-- task modal end -->




    </div>



    <?php
    include "footer.php";
    ?>
    <?php
    ob_end_flush();


    ?>