<?php
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<style>
    @media only screen and (max-width: 600px) {
        .table th, .table td{
    padding: 2px !important;
   }
}
    
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-key"></i>
                </span> <a href="viewstudent.php" style="text-decoration:none; color:black;">View Student</a>
            </h3>

        </div>
        <div class="row">

            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By full name or mobile" aria-label="Recipient's username" aria-describedby="basic-addon2">
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

                            $query = "SELECT * FROM users WHERE (role=0) AND (name LIKE '%$sdata%' OR username LIKE '%$sdata%')";

                            $search_query = mysqli_query($db, $query);
                            $count = mysqli_num_rows($search_query);

                            if ($count > 0) { ?>
                                <!-- search book end -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <!-- <th> Id </th> -->
                                            <th> Full name </th>
                                            <!-- <th> username </th> -->
                                            <th> Student ID </th>
                                            <th> class </th>

                                            <th> Photo </th>
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
                                                <!-- <td> <?php //echo $ids; ?> </td> -->
                                                <td> <?php echo $row['name']; ?> </td>
                                                <!-- <td> <?php //echo $row['username']; ?></td> -->
                                                <td> <?php echo $row['roll']; ?></td>
                                                <td> <?php echo $row['class']; ?></td>

                                                <td> <?php

                                                        if ($row['image'] == "") { ?>

                                                        <img style="height: 41px;" alt="profile photo" src="../admin/image/photo/default.jpg" />
                                                    <?php
                                                        } else { ?>
                                                        <img style="height: 41px;" src="../admin/image/photo/<?php echo $row['image']; ?>" alt="Book photo">



                                                    <?php
                                                        }
                                                    ?>
                                                </td>




                                                <td>
                                                    <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>

                                                    <?php

                                                    if ($row['status'] == 1) { ?>
                                                        <a onclick="return confirm('are you sure to Dactive');" href="dactiverole.php?dactive=<?php echo $id; ?>" title="" class="text-warning"> <i class="mdi mdi-arrow-up text-success"></i></a>

                                                    <?php } ?>
                                                    <?php

                                                    if ($row['status'] == 0) { ?>
                                                        <a onclick="return confirm('are you sure to Active');" href="activerole.php?active=<?php echo $id; ?>" title="" class="text-warning"><i class="mdi mdi-arrow-down text-danger"></i></a>

                                                    <?php } ?>

                                                    <a onclick="return confirm('are you sure to delete');" href="viewteacher.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>
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
'>Student not found</h3>";
                            }
                        } else { ?>
                            <!-- search book end -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <!-- <th> Id </th> -->
                                        <th> Full name </th>
                                        <!-- <th> username </th> -->
                                        <th> Student ID </th>
                                        <th> Class </th>

                                        <th> Photo </th>
                                        <th> Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $per_page = 10;
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




                                    $post_query_count = "select * from users WHERE role=0";
                                    $find_count = mysqli_query($db, $post_query_count);
                                    $count = mysqli_num_rows($find_count);
                                    $count = ceil($count / 10);




                                    $rr = mysqli_query($db, "select * from users where role=0 ORDER BY class asc  LIMIT $page_1, $per_page");
                                    while ($row = mysqli_fetch_assoc($rr)) {
                                        $id = $row['id'];
                                    ?>
                                        <tr>
                                            <!-- <td> <?php //echo $ids; ?> </td> -->

                                            <td> <?php echo $row['name']; ?> </td>
                                            <!-- <td> <?php //echo $row['username']; ?></td> -->
                                            <td> <?php echo $row['roll']; ?></td>
                                            <td> <?php echo $row['class']; ?></td>

                                            <td> <?php

                                                    if ($row['image'] == "") { ?>

                                                    <img style="height: 41px;" alt="profile photo" src="../admin/image/photo/default.jpg" />
                                                <?php
                                                    } else { ?>
                                                    <img style="height: 41px;" src="../admin/image/photo/<?php echo $row['image']; ?>" alt="Book photo">



                                                <?php
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="" title="" class="text-success" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                                                <?php

                                                if ($row['status'] == 1) { ?>
                                                    <a onclick="return confirm('are you sure to Dactive');" href="dactiverole.php?dactive=<?php echo $id; ?>" title="" class="text-warning"> <i class="mdi mdi-arrow-up text-success"></i></a>

                                                <?php } ?>
                                                <?php

                                                if ($row['status'] == 0) { ?>
                                                    <a onclick="return confirm('are you sure to Active');" href="activerole.php?active=<?php echo $id; ?>" title="" class="text-warning"><i class="mdi mdi-arrow-down text-danger"></i></a>

                                                <?php } ?>
                                                <a onclick="return confirm('are you sure to delete');" href="viewstudent.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>
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

                                            echo "<li class='page-item'><a {$cc} class='page-link' href='viewstudent.php?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='viewstudent.php?page={$i}'>{$i}</a></li>";
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
            <!-- modal start -->


            <?php



            $query = "SELECT * FROM users WHERE role=0";
            $all_books = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($all_books)) {
                $ids = $row['id'];



            ?>


                <!-- Modal -->
                <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Student Edit</h5>
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
                                                    <label for="exampleInputName1">Full Name</label>
                                                    <input type="text" class="form-control" id="exampleInputName1" name="name" required autocomplete="off" value="<?php echo $row['name']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">User name</label>
                                                    <input type="text" class="form-control" id="exampleInputName1" name="username" required autocomplete="off" value="<?php echo $row['username']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Student Id</label>
                                                    <input type="text" class="form-control" id="exampleInputName1" name="roll" required autocomplete="off" value="<?php echo $row['roll']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName1">Class</label>

                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="class" aria-label="Default select example">

                                                            <!-- read class -->


                                                            <option value="one" <?php if ($row['class'] == 'one') {
                                                                                    echo 'selected';
                                                                                } ?>>One</option>
                                                            <option value="two" <?php if ($row['class'] == 'two') {
                                                                                    echo 'selected';
                                                                                } ?>>Two</option>
                                                            <option value="three" <?php if ($row['class'] == 'three') {
                                                                                        echo 'selected';
                                                                                    } ?>>Three</option>
                                                            <option value="four" <?php if ($row['class'] == 'four') {
                                                                                        echo 'selected';
                                                                                    } ?>>Four</option>
                                                            <option value="five" <?php if ($row['class'] == 'five') {
                                                                                        echo 'selected';
                                                                                    } ?>>Five</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName1">Previous Photo</label>
                                                    <?php

                                                    if ($row['image'] == "") { ?>

                                                        <img style="height: 41px;" class="mb-3" alt="profile photo" src="../admin/image/photo/default.jpg" />
                                                    <?php
                                                    } else { ?>
                                                        <img style="height: 41px;" class="mb-3" src="../admin/image/photo/<?php echo $row['image']; ?>" alt="Book photo">



                                                    <?php
                                                    }
                                                    ?>
                                                    <br>
                                                    <label for="exampleInputName1">Photo</label>


                                                    <input type="file" class="form-control" name="newphoto" id="exampleInputPassword2" placeholder="Photo">
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
                <!-- modal end -->
            <?php } ?>


            <!-- class edit php -->
            <?php

            if (isset($_POST['update'])) {

                $updateid = $_POST['updateid'];
                $mentorInfo = "SELECT * FROM users WHERE id = '$updateid' AND (role=0)";
                $mntrinfo = mysqli_query($db, $mentorInfo);

                while ($row = mysqli_fetch_assoc($mntrinfo)) {
                    $photo = $row['image'];
                }


                if (!$_FILES['newphoto']['name'] == "") {

                    $newphoto = $_FILES['newphoto']['name'];
                    $newphoto = explode('.', $_FILES['newphoto']['name']);
                    $newphoto = end($newphoto);
                    $random = rand(0, 100000);


                    $new_photo_name = $random . '.' . $newphoto;

                    $query = "UPDATE users SET  image='$new_photo_name'  WHERE id = '$updateid' AND (role=0)";
                    $addclass = mysqli_query($db, $query);
                    move_uploaded_file($_FILES['newphoto']['tmp_name'], '../admin/image/photo/' . $new_photo_name);


                    echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
                } else {
                    $upadte = mysqli_query($db, "UPDATE users SET image='$photo'  WHERE id = '$updateid' AND (role=0)");
                    echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
                }
            }

            ?>


            <?php



            if (isset($_POST['update'])) {

                $updateid = $_POST['updateid'];

                $name           = mysqli_real_escape_string($db, $_POST['name']);
                $username           = mysqli_real_escape_string($db, $_POST['username']);


                $roll            = mysqli_real_escape_string($db, $_POST['roll']);
                $class             = mysqli_real_escape_string($db, $_POST['class']);



                $upadte = mysqli_query($db, "UPDATE users SET name='$name',username='$username',roll='$roll',class='$class' WHERE id = '$updateid' AND (role=0)");

                if ($upadte) {


                    echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
                }
            }










            ?>
            <!-- class edit php end -->

        </div>
    </div>


    <!-- class delete -->
    <?php

    if (isset($_GET['delete'])) {


        $id = $_GET['delete'];
        $deleteInfo = "DELETE FROM  users WHERE  id='$id' And (role=0)";
        $deletclassInfo = mysqli_query($db, $deleteInfo);
        if ($deletclassInfo) {
            echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
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