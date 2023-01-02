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
        .table th, .table td{
    padding: 5px !important;
   }
}
    
</style>
<!-- class php -->
<?php
if (isset($_POST['submit'])) {

    $teacher = mysqli_real_escape_string($db, $_POST['teacher']);
    $class = mysqli_real_escape_string($db, $_POST['class']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);

    $query = "SELECT * FROM users WHERE (role=2 OR role=1) AND name='$teacher'";
    $allclass = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($allclass)) {
        $tid = $row['id'];
    }


    $query = "SELECT * FROM addsubject WHERE sub_name='$subject'";
    $allclass = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($allclass)) {
        $suid = $row['id'];
    }
    $email_check = mysqli_query($db, "SELECT * FROM teacher_assign WHERE
   teacher_id = '$tid' AND  subject_id='$suid' ");

    if (mysqli_num_rows($email_check) == 0) {


        $query = "INSERT INTO teacher_assign (teacher,class,subject,teacher_id,subject_id) VALUES ('$teacher','$class','$subject','$tid','$suid')";
        $addclass = mysqli_query($db, $query);
        if ($addclass) {
            echo "<script type='text/javascript'> document.location = 'teacherassign.php'; </script>";
        }
    } else {
        $email_error = "Already Added";
    }
}
?>
<!-- class php end-->
<style>
    .error {
        color: red;
        font-style: italic;

        font-weight: bold;

    }
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-wheelchair-accessibility "></i> </span> <a href="teacherassign.php" style="text-decoration:none; color:black;">Teacher Assign</a>
            </h3>

        </div>
        <div class="row">
            <!-- class start -->
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teacher</label>

                                <select class="form-select" name="teacher" aria-label="Default select example">
                                    <option selected>All Teacher</option>
                                    <!-- read class -->
                                    <?php

                                    $query = "SELECT * FROM users where (role=1 or role=2) GROUP BY username ORDER BY id ASC";
                                    $all_class = mysqli_query($db, $query);
                                    while ($row = mysqli_fetch_assoc($all_class)) {

                                        $fname = $row['name'];



                                    ?>
                                        <!-- read class end -->

                                        <option value="<?php echo  $fname; ?>"><?php echo $fname; ?></option>
                                    <?php  }

                                    ?>

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Class</label>

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


                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label>

                                <select class="form-select" name="subject" aria-label="Default select example">
                                    <option selected>All Subject</option>
                                    <!-- read class -->
                                    <?php

                                    $query = "SELECT * FROM addsubject GROUP BY sub_name ORDER BY id ASC";
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
                        <span class="error"><?php if (isset($email_error)) {
                                                echo $email_error;
                                            } ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Assign Teacher</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By  teacher name or class" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-gradient-primary" style="padding-bottom: 20px" name="fdata" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- search book start -->
                        <?php

                        if (isset($_POST['fdata'])) {

                            $sdata = $_POST['sdata'];

                            $query = "SELECT * FROM teacher_assign WHERE teacher LIKE '%$sdata%'  OR class LIKE '%$sdata%'";

                            $search_query = mysqli_query($db, $query);
                            $count = mysqli_num_rows($search_query);

                            if ($count > 0) { ?>
                                <!-- search book end -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Teacher Name </th>
                                            <th> Class </th>
                                            <th> Subject </th>
                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $ids = 1;
                                        while ($row = mysqli_fetch_assoc($search_query)) {
                                            $id = $row['id'];
                                        ?>
                                            <tr>
                                                <td> <?php echo $ids; ?> </td>
                                                <td> <?php echo $row['teacher']; ?> </td>
                                                <td> <?php echo $row['class']; ?></td>
                                                <td> <?php echo $row['subject']; ?></td>
                                                <td>
                                                    <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                                                    <a onclick="return confirm('are you sure to delete');" href="teacherassign.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>
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
'>Teacher not found</h3>";
                            }
                        } else { ?>
                            <!-- search book end -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Id </th>
                                        <th> Teacher </th>
                                        <th> Class </th>
                                        <th> Subject </th>

                                        <th> Action </th>

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




                                    $post_query_count = "select * from teacher_assign";
                                    $find_count = mysqli_query($db, $post_query_count);
                                    $count = mysqli_num_rows($find_count);
                                    $count = ceil($count / 5);




                                    $rr = mysqli_query($db, "select * from teacher_assign LIMIT $page_1, $per_page");
                                    while ($row = mysqli_fetch_assoc($rr)) {
                                        $id = $row['id'];
                                    ?>
                                        <tr>
                                            <td> <?php echo $ids; ?> </td>
                                            <td> <?php echo $row['teacher']; ?> </td>
                                            <td> <?php echo $row['class']; ?></td>
                                            <td> <?php echo $row['subject']; ?></td>
                                            <td>
                                                <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>

                                                <a onclick="return confirm('are you sure to delete');" href="teacherassign.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>
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

                                            echo "<li class='page-item'><a {$cc} class='page-link' href='teacherassign.php?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='teacherassign.php?page={$i}'>{$i}</a></li>";
                                        }
                                    }

                                    ?>
                                </ul>
                            </nav>


                        <?php }
                        ?>


                    </div>
                </div>
            </div>

            <!-- class end -->


        </div>

        <!-- modal start -->


        <?php



        $query = "SELECT * FROM teacher_assign";
        $all_books = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($all_books)) {
            $ids = $row['id'];
            $tt = $row['teacher'];

            $cs = $row['class'];

            $sc = $row['subject'];





        ?>


            <!-- Modal -->
            <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Teacher Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <!-- modal form -->
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">

                                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" id="exampleInputName1" name="updateid" required autocomplete="off" value="<?php echo $row['id']; ?>">

                                            <div class="form-group">

                                                <select class="form-select" name="uteacher" aria-label="Default select example">
                                                    <option selected>All Teacher</option>
                                                    <!-- read class -->
                                                    <?php

                                                    $query = "SELECT * FROM users where (role=2 or role=1) GROUP BY username ORDER BY id ASC";
                                                    $all_class = mysqli_query($db, $query);
                                                    while ($row = mysqli_fetch_assoc($all_class)) {

                                                        $fname = $row['name'];
                                             


                                                    ?>
                                                        <!-- read class end -->

                                                        <option value="<?php echo $fname; ?>" <?= $row['name'] == $tt ? ' selected="selected"' : '' ?>><?php echo $fname; ?></option><?php  } ?>

                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <select class="form-select" name="uclass" aria-label="Default select example">

                                                    <!-- read class -->


                                                    <option value="one" <?php if ($cs == 'one') {
                                                                            echo 'selected';
                                                                        } ?>>One</option>
                                                    <option value="two" <?php if ($cs == 'two') {
                                                                            echo 'selected';
                                                                        } ?>>Two</option>
                                                    <option value="three" <?php if ($cs == 'three') {
                                                                                echo 'selected';
                                                                            } ?>>Three</option>
                                                    <option value="four" <?php if ($cs == 'four') {
                                                                                echo 'selected';
                                                                            } ?>>Four</option>
                                                    <option value="five" <?php if ($cs == 'five') {
                                                                                echo 'selected';
                                                                            } ?>>Five</option>

                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Subject</label>

                                                <select class="form-select" name="usubject" aria-label="Default select example">
                                                    <option selected>All Subject</option>
                                                    <!-- read class -->
                                                    <?php

                                                    $query = "SELECT * FROM addsubject GROUP BY sub_name ORDER BY id ASC";
                                                    $all_class = mysqli_query($db, $query);
                                                    while ($row = mysqli_fetch_assoc($all_class)) {

                                                        $subject = $row['sub_name'];



                                                    ?>
                                                        <!-- read class end -->


                                                        <option value="<?php echo $subject; ?>" <?= $row['sub_name'] == $sc ? ' selected="selected"' : '' ?>><?php echo $subject; ?></option> <?php  }

                                                                                                                                                                                                ?>

                                                </select>

                                            </div>



                                            <button type="submit" class="btn btn-gradient-primary me-2" name="update">Submit</button>
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
    </div>
</div>
<!-- modal end -->
<?php } ?>


<!-- class edit php -->
<?php

if (isset($_POST['update'])) {
    $updateid = $_POST['updateid'];
    $uteacher = mysqli_real_escape_string($db, $_POST['uteacher']);
     $uclass = mysqli_real_escape_string($db, $_POST['uclass']);
    $usubject = mysqli_real_escape_string($db, $_POST['usubject']);

    $query = "SELECT * FROM users WHERE (role=2 OR role=1) AND name='$uteacher'";
    $allclass = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($allclass)) {
        $tid = $row['id'];
    }
    
    
    $query = "SELECT * FROM addsubject WHERE sub_name='$usubject'";
    $allclass = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($allclass)) {
        $suid = $row['id'];
    }

    $query = "UPDATE teacher_assign SET teacher ='$uteacher',class='$uclass',subject='$usubject',teacher_id='$tid',subject_id='$suid'  WHERE id = '$updateid'";
    $addclass = mysqli_query($db, $query);
    if ($addclass) {
        echo "<script type='text/javascript'> document.location = 'teacherassign.php'; </script>";
    }
}

?>
<!-- class edit php end -->

</div>


<!-- class delete -->
<?php

if (isset($_GET['delete'])) {


    $id = $_GET['delete'];
    $deleteInfo = "DELETE FROM  teacher_assign WHERE  id='$id'";
    $deletclassInfo = mysqli_query($db, $deleteInfo);
    if ($deletclassInfo) {
        echo "<script type='text/javascript'> document.location = 'teacherassign.php'; </script>";
    }
}

?>
<!-- class delete end -->



<?php
include "footer.php";
?>
<?php
ob_end_flush();


?>