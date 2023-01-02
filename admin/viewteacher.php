<?php
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
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-key"></i>
                </span> <a href="viewteacher.php" style="text-decoration:none; color:black;">View Teacher</a> 
            </h3>

        </div>
        <div class="row">

            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By full name or username" aria-label="Recipient's username" aria-describedby="basic-addon2">
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

                            $query = "SELECT * FROM users WHERE (role=2 OR role=1) AND (name LIKE '%$sdata%' OR username LIKE '%$sdata%')";

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
                                            <th> Teacher ID </th>

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

                                                <td> <?php

                                                        if ($row['image'] == "") { ?>

                                                        <img style="height: 41px;" alt="profile photo" src="image/photo/default.jpg" />
                                                    <?php
                                                        } else { ?>
                                                        <img style="height: 41px;" src="image/photo/<?php echo $row['image']; ?>" alt="Book photo">



                                                    <?php
                                                        }
                                                    ?>
                                                </td>




                                                <td>
                                                    <a href="" title=""   data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                                                    <a onclick="return confirm('are you sure to delete');" href="viewteacher.php?delete=<?php echo $id; ?>" title=""  ><i class="mdi mdi-delete"></i></a>
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

                                        <!-- <th> Id </th> -->
                                        <th> Full name </th>
                                        <!-- <th> username </th> -->
                                        <th> Teacher ID </th>

                                        <th> Photo </th>
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




                                    $post_query_count = "select * from users WHERE role=2 OR role=1";
                                    $find_count = mysqli_query($db, $post_query_count);
                                    $count = mysqli_num_rows($find_count);
                                    $count = ceil($count / 5);




                                    $rr = mysqli_query($db, "select * from users where role=2 OR role=1 ORDER BY id desc  LIMIT $page_1, $per_page");
                                    while ($row = mysqli_fetch_assoc($rr)) {
                                        $id = $row['id'];
                                    ?>
                                        <tr>
                                            <!-- <td> <?php //echo $ids; ?> </td> -->

                                            <td> <?php echo $row['name']; ?> </td>
                                            <!-- <td> <?php //echo $row['username']; ?></td> -->
                                            <td> <?php echo $row['roll']; ?></td>

                                            <td> <?php

                                                    if ($row['image'] == "") { ?>

                                                    <img style="height: 41px;" alt="profile photo" src="image/photo/default.jpg" />
                                                <?php
                                                    } else { ?>
                                                    <img style="height: 41px;" src="image/photo/<?php echo $row['image']; ?>" alt="Book photo">



                                                <?php
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="" title=""class="text-success"   data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                                                <a onclick="return confirm('are you sure to delete');" href="viewteacher.php?delete=<?php echo $id; ?>" title="" class="text-danger"><i class="mdi mdi-delete"></i></a>
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

                                            echo "<li class='page-item'><a {$cc} class='page-link' href='viewteacher.php?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='viewteacher.php?page={$i}'>{$i}</a></li>";
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



            $query = "SELECT * FROM users WHERE role=2 OR role=1";
            $all_books = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($all_books)) {
                $ids = $row['id'];



            ?>


                <!-- Modal -->
                <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Teacher Edit</h5>
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
                                                    <label for="exampleInputName1">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputName1" name="email" required autocomplete="off" value="<?php echo $row['email']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Teacher Id</label>
                                                    <input type="text" class="form-control" id="exampleInputName1" name="roll" required autocomplete="off" value="<?php echo $row['roll']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName1">Role</label>

                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="role" aria-label="Default select example">

                                                            <!-- read class -->


                                                            <option value="2" <?php if ($row['role'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>Admin</option>
                                                            <option value="1" <?php if ($row['role'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Teacher</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName1">Previous Photo</label>
                                                    <?php

                                                    if ($row['image'] == "") { ?>

                                                        <img style="height: 41px;" class="mb-3" alt="profile photo" src="image/photo/default.jpg" />
                                                    <?php
                                                    } else { ?>
                                                        <img style="height: 41px;" class="mb-3" src="image/photo/<?php echo $row['image']; ?>" alt="Book photo">



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
                $mentorInfo = "SELECT * FROM users WHERE id = '$updateid' AND (role=2 OR role=1)";
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

                    $query = "UPDATE users SET  image='$new_photo_name'  WHERE id = '$updateid' AND (role=2 OR role=1)";
                    $addclass = mysqli_query($db, $query);
                    move_uploaded_file($_FILES['newphoto']['tmp_name'], 'image/photo/' . $new_photo_name);


                    echo "<script type='text/javascript'> document.location = 'viewteacher.php'; </script>";
                } else {
                    $upadte = mysqli_query($db, "UPDATE users SET image='$photo'  WHERE id = '$updateid' AND (role=1 OR role=2)");
                    echo "<script type='text/javascript'> document.location = 'viewteacher.php'; </script>";
                }
            }

            ?>


            <?php



            if (isset($_POST['update'])) {

                $updateid = $_POST['updateid'];

                $name           = mysqli_real_escape_string($db, $_POST['name']);
                $username           = mysqli_real_escape_string($db, $_POST['username']);
                $email           = mysqli_real_escape_string($db, $_POST['email']);


                $roll            = mysqli_real_escape_string($db, $_POST['roll']);
                 $role             = mysqli_real_escape_string($db, $_POST['role']);
 


                $upadte = mysqli_query($db, "UPDATE users SET name='$name',username='$username',email='$email',roll='$roll',role='$role' WHERE id = '$updateid' AND (role=1 OR role=2)");

                if ($upadte) {


                    echo "<script type='text/javascript'> document.location = 'viewteacher.php'; </script>";
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
        $deleteInfo = "DELETE FROM  users WHERE  id='$id' And (role=2 OR role=1)";
        $deletclassInfo = mysqli_query($db, $deleteInfo);

        $deleteInfo1 = "DELETE FROM  teacher_assign WHERE  teacher_id='$id'";
        $deletclassInfo1 = mysqli_query($db, $deleteInfo1);

        $deleteInfo2 = "DELETE FROM  task WHERE  teacher_id='$id'";
        $deletclassInfo2 = mysqli_query($db, $deleteInfo2);

        $deleteInfo3 = "DELETE FROM  mark WHERE  teacher_id='$id'";
        $deletclassInfo3 = mysqli_query($db, $deleteInfo3);

        if ($deletclassInfo) {
            echo "<script type='text/javascript'> document.location = 'viewteacher.php'; </script>";
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