<?php
ob_start();
include "db.php";
include "uper-bar.php";

?>
<?php
include "navbar.php";
?>

<!-- class php -->
<?php
$error = "";
if (isset($_POST['submit'])) {
  $sub_name = mysqli_real_escape_string($db, $_POST['sub_name']);
  $querys = mysqli_query($db, "SELECT * FROM addsubject WHERE sub_name ='$sub_name'");
  if (mysqli_num_rows($querys) == 0) {
    $query = "INSERT INTO addsubject (sub_name) VALUES ('$sub_name')";
    $addclass = mysqli_query($db, $query);
    if ($addclass) {
      echo "<script type='text/javascript'> document.location = 'addsubject.php'; </script>";
    }
  } else {
    $error = "subject already added";
  }
}
?>
<!-- class php end-->

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-account-box-outline"></i>
        </span> <a href="addsubject.php" style="text-decoration:none; color:black;">Subject</a>
      </h3>

    </div>
    <div class="row">
      <!-- class start -->
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Subject</h4>

            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">



              <div class="form-group">
                <label for="exampleInputUsername1">Subject Name</label>
                <input type="text" class="form-control" name="sub_name" id="exampleInputUsername1" autocomplete="off" required placeholder="Add Subject">
                <span class="error" style="color: red;font-style: italic;font-weight: bold;"><?php if (isset($error)) {
                                                                                                echo $error;
                                                                                              } ?></span>

              </div>
              <button type="submit" class="btn btn-gradient-primary me-2" name="submit">Submit</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">View Subject</h4>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" autocomplete="off" name="sdata" required placeholder="Search By Subject" aria-label="Recipient's username" aria-describedby="basic-addon2">
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

              $query = "SELECT * FROM addsubject WHERE sub_name LIKE '%$sdata%'";

              $search_query = mysqli_query($db, $query);
              $count = mysqli_num_rows($search_query);

              if ($count > 0) { ?>
                <!-- search book end -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> Id </th>
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


                        <td> <?php echo $row['sub_name'];
                              ?></td>
                        <td>
                          <a href="" title="" class="btn btn-success btn-sm view_payment" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                          <a onclick="return confirm('are you sure to delete');" href="addsubject.php?delete=<?php echo $id; ?>" title="" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
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
'>Subject not found</h3>";
              }
            } else { ?>
              <!-- search book end -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> Id </th>

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





                  $post_query_count = "select * from addsubject";
                  $find_count = mysqli_query($db, $post_query_count);
                  $count = mysqli_num_rows($find_count);
                  $count = ceil($count / 5);




                  $rr = mysqli_query($db, "select * from addsubject ORDER BY sub_name ASC LIMIT $page_1, $per_page");
                  while ($row = mysqli_fetch_assoc($rr)) {
                    $id = $row['id'];
                  ?>
                    <tr>
                      <td> <?php echo $ids; ?> </td>

                      <td> <?php echo $row['sub_name'];
                            ?></td>
                      <td>
                        <a href="" title="" class="btn btn-success btn-sm view_payment" data-bs-toggle="modal" data-bs-target="#class-<?php echo $row['id']; ?>"><i class="mdi mdi-marker"></i></a>


                        <a onclick="return confirm('are you sure to delete');" href="addsubject.php?delete=<?php echo $id; ?>" title="" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
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
                      
                        echo "<li class='page-item'><a {$cc} class='page-link' href='addsubject.php?page={$i}'>{$i}</a></li>";
                     }else{
                        echo "<li class='page-item'><a class='page-link' href='addsubject.php?page={$i}'>{$i}</a></li>";

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



    $query = "SELECT * FROM addsubject";
    $all_books = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($all_books)) {
      $ids = $row['id'];



    ?>


      <!-- Modal -->
      <div class="modal fade" id="class-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Subject Edit</h5>
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
                        <label for="exampleInputName1">Subject</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="usub_name" required autocomplete="off" value="<?php echo $row['sub_name'];
                                                                                                                                            ?>">
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

      $usub_name = mysqli_real_escape_string($db, $_POST['usub_name']);
      $query = "UPDATE addsubject SET sub_name='$usub_name' WHERE id = '$updateid'";
      $addclass = mysqli_query($db, $query);
      if ($addclass) {
        echo "<script type='text/javascript'> document.location = 'addsubject.php'; </script>";
      }
    }

    ?>
    <!-- class edit php end -->

  </div>


  <!-- class delete -->
  <?php

  if (isset($_GET['delete'])) {


    $id = $_GET['delete'];
    $deleteInfo = "DELETE FROM  addsubject WHERE  id='$id'";
    $deletclassInfo = mysqli_query($db, $deleteInfo);
    if ($deletclassInfo) {
      echo "<script type='text/javascript'> document.location = 'addsubject.php'; </script>";
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