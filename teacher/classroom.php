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
$fn = $userData['fname'];
$role = $userData['role'];
$image = $userData['photo'];
$uid = $userData['id'];


?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-grid"></i> </span> Class Room And class
            </h3>

        </div>
        <div class="row">
            <div class="row">

                <div class="col-md-12 stretch-card grid-margin">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View Student Details</h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By classes or sec" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-gradient-primary" style="padding-bottom: 20px" name="fdata" type="button">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php


                            if (isset($_POST['fdata'])) {

                                $sdata = $_POST['sdata'];

                                $query = "SELECT * FROM teacher_assign WHERE tid='$uid' AND( classes LIKE '%$sdata%' OR sections LIKE '%$sdata%')";

                                $search_query = mysqli_query($db, $query);
                                $count = mysqli_num_rows($search_query);

                                if ($count > 0) { ?>
                                    <!-- search book end -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Id </th>
                                                <th> Class </th>
                                                <th> Section </th>
                                                <th> Subject </th>
                                                <th> Room </th>

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
                                                    <td> <?php echo $row['classes']; ?> </td>
                                                    <td> <?php echo $row['sections']; ?></td>
                                                    <td> <?php echo $row['subject']; ?></td>
                                                    <?php
                                                    $crquery = mysqli_query($db, "SELECT class_room_assign.id, teacher_assign.id, class_room_assign.cid,teacher_assign.cid,class_room_assign.room as room
                                                    FROM class_room_assign
                                                    INNER JOIN teacher_assign ON class_room_assign.cid='$cid'");
                                                    while ($cr = mysqli_fetch_assoc($crquery)) {
                                                        $room = $cr['room'];
                                                    ?>
                                                        <td> <?php echo $room; ?> </td>
                                                    <?php

                                                        break;
                                                    }
                                                    ?>
                                                </tr>
                                            <?php $ids++;
                                            }   ?>
                                        </tbody>
                                    </table>





                                <?php } else {
                                    echo "<h3 style=' 
                                 text-align: center;
                                 color: rebeccapurple;
                                 '>Class not found</h3>";
                                }
                            } else { ?>
                                <!-- search book end -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Class </th>
                                            <th> Section </th>
                                            <th> Subject </th>
                                            <th> Room </th>



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




                                        $post_query_count = "select * from teacher_assign WHERE tid='$uid'";
                                        $find_count = mysqli_query($db, $post_query_count);
                                        $count = mysqli_num_rows($find_count);
                                        $count = ceil($count / 10);




                                        $rr = mysqli_query($db, "select * from teacher_assign where tid='$uid' LIMIT $page_1, $per_page");
                                        while ($row = mysqli_fetch_assoc($rr)) {
                                            $id = $row['id'];
                                            $cid = $row['cid'];
                                        ?>
                                            <tr>
                                                <td> <?php echo $ids; ?> </td>
                                                <td> <?php echo $row['classes']; ?> </td>
                                                <td> <?php echo $row['sections']; ?></td>
                                                <td> <?php echo $row['subject']; ?></td>
                                                <?php
                                                $crquery = mysqli_query($db, "SELECT class_room_assign.id, teacher_assign.id, class_room_assign.cid,teacher_assign.cid,class_room_assign.room as room
                                                FROM class_room_assign
                                                INNER JOIN teacher_assign ON class_room_assign.cid='$cid'");
                                                while ($cr = mysqli_fetch_assoc($crquery)) {
                                                    $room = $cr['room'];
                                                ?>
                                                    <td> <?php echo $room; ?> </td>
                                                <?php

                                                    break;
                                                }
                                                ?>



                                            </tr>
                                        <?php $ids++;
                                        }   ?>
                                    </tbody>
                                </table>



                                <nav aria-label="Page navigation example" style="padding-top:2px" ;>
                                    <ul class="pagination">
                                        <?php
                                        for ($i = 1; $i <= $count; $i++) {
                                            echo "<li class='page-item'><a  class='page-link' href='classroom.php?page={$i}'>{$i}</a></li>";
                                        }

                                        ?>
                                    </ul>
                                </nav>


                            <?php }
                            ?>

                        </div>
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