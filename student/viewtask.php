<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
<?php
include "navbar.php";
?>
<!-- info collect -->

<?php

$user_name = mysqli_query($db, "SELECT * FROM users WHERE id = '$user'");

$userData = mysqli_fetch_assoc($user_name);
$fn = $userData['name'];
$role = $userData['role'];
$image = $userData['image'];
$classes = $userData['class'];
$uid = $userData['id'];


?>

<style>
    @media only screen and (max-width: 600px) {
        .table th, .table td{
    padding: 5px !important;
   }
}
    
</style>
<!-- info collect -->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-search"></i>
                </span> View Task
            </h3>

        </div>
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Task</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By category or subject or class" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-gradient-primary" style="padding-bottom: 20px" name="fdata" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php


                        if (isset($_POST['fdata'])) {

                            $sdata = $_POST['sdata'];

                            $query = "SELECT * FROM task WHERE (class='$classes') && class LIKE '%$sdata%' OR subject LIKE '%$sdata%' OR category LIKE '%$sdata%'";

                            $search_query = mysqli_query($db, $query);
                            $count = mysqli_num_rows($search_query);

                            if ($count > 0) { ?>
                                <!-- search book end -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <!-- <th> Id </th> -->
                                            <th> Subject </th>
                                            <th> category </th>
                                            <!-- <th> Task </th> -->
                                            <!-- <th> Description </th> -->
                                            <!-- <th> Time </th> -->
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
                                                <td> <?php echo $row['subject']; ?> </td>
                                                <td> <?php echo $row['category']; ?> </td>

                                                <!-- <td> <?php //echo $row['task']; ?></td> -->
                                                <!-- <td> <?php //echo substr($row['description'], 0, 20) . ((strlen($row['description']) > 20) ? '......' : '');  ?></td> -->
                                                <!-- <td> <?php //echo  'From: ' . $row['fo'] . ' To: ' . $row['tos']; ?></td> -->
                                                <td>
                                                    <a href="readtask.php?view=<?php echo $id; ?>" title="" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>


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
                                        <th> Subject </th>
                                        <th> category </th>
                                        <!-- <th> Task </th> -->
                                        <!-- <th> Description </th> -->
                                        <!-- <th> Time </th> -->
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




                                    $post_query_count = "select * from task where class='$classes'";
                                    $find_count = mysqli_query($db, $post_query_count);
                                    $count = mysqli_num_rows($find_count);
                                    $count = ceil($count / 5);




                                    $rr = mysqli_query($db, "select * from task where (class ='$classes' && tos>=CURDATE())  LIMIT $page_1, $per_page  ");
                                    while ($row = mysqli_fetch_assoc($rr)) {
                                        $id = $row['id'];
                                        $tos = $row['tos'];
                                    ?>
                                        <tr>
                                        <!-- <td> <?php //echo $ids; ?> </td> -->

                                            <td> <?php echo $row['subject']; ?> </td>
                                            <td> <?php echo $row['category']; ?> </td>

                                            <!-- <td> <?php //echo $row['task']; ?></td> -->
                                            <!-- <td> <?php //echo substr($row['description'], 0, 20) . ((strlen($row['description']) > 20) ? '......' : '');  ?></td> -->
                                            <!-- <td> <?php //echo  'From: ' . $row['fo'] . ' To: ' . $row['tos']; ?></td> -->
                                            <td>
                                                <a href="readtask.php?view=<?php echo $id; ?>" title="" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>


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
                                        if($page==$i){
                                            $cc= "style='background:green;margin-left: 2px;color:white;margin-right: 2px;'";
                                          
                                            echo "<li class='page-item'><a {$cc} class='page-link' href='viewtask.php?page={$i}'>{$i}</a></li>";
                                         }else{
                                            echo "<li class='page-item'><a class='page-link' href='viewtask.php?page={$i}'>{$i}</a></li>";
                    
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

        </div>
    </div>
        <?php
        include "footer.php";
        ?>
        <?php
        ob_end_flush();


        ?>