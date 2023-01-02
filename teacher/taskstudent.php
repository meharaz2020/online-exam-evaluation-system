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


$id = $_GET['alltask'];

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


$connect = new PDO("mysql:host=localhost;dbname=online_edu", "root", "");
function fill_unit_select_box($connect, $class)
{
    $output = '';
    $query = "SELECT * FROM  users where class='$class' ORDER BY id ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["roll"] . '">' . $row["roll"] . '</option>';
    }
    return $output;
}

function fill_unit_select_box1($connect, $class)
{
    $output = '';
    $query = "SELECT * FROM  users where class='$class' ORDER BY id ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["username"] . '">' . $row["username"] . '</option>';
    }
    return $output;
}

?>




<style>
    @media only screen and (max-width: 600px) {
        .table th, .table td{
    padding: 5px !important;
    font-size: 10px;

   }
   .mark{
    width: 62px !important;
   }
   table{
    margin-left: -10px;
   }
}
    
</style>











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
        <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">



                        <!-- kacal-->
                        <h4 align="center">Enter Number Details</h4>
                        <br />
                        <form method="post" id="insert_form" enctype="multipart/form-data">



                            <div class="table-repsonsive">
                                <span id="error"></span>
                                <table class="table table-bordered table-striped" id="item_table">
                                    <tr>
                                        <th>Username</th>
                                        <th>Roll</th>
                                        <th>Pdf</th>
                                        <th>Mark</th>

                                        <th>
                                            <!-- <input type="button" name="add" class="text-success add"> -->
                                            <button type="button" style="border: none;background:none;" name="add" class="text-success add">Add</span></button>

                                        </th>

                                    </tr>

                                    <?php

                                    if (isset($_POST['submit'])) {

                                        $name = $_POST['roll'];
                                        $phone = $_POST['classes'];
                                         $tid = $_POST['tid'];
                                        $mark = $_POST['mark'];
                                        $username = $_POST['username'];

                                        $classes = $_POST['classes'];
                                        $cat = $_POST['cat'];

                                        $image = $_FILES['image']['name'];

                                        print_r($sub);






                                        foreach ($name as $index => $names) {
                                            $s_name = $names;
                                            $s_phone = $phone[$index];
                                            $s_class = $classes[$index];
                                            $s_sub = $sub[$index];

                                            $s_tid = $tid[$index];
                                            $s_mark = $mark[$index];
                                            $s_uname = $username[$index];
                                            $s_cat = $cat[$index];
                                            $image = $_FILES['image']['name'][$index];
                                            $imagePath = 'uploads/' . $image;
                                            $tmp_name = $_FILES['image']['tmp_name'][$index];
                                            move_uploaded_file($tmp_name, $imagePath);
                                            $query = "INSERT INTO mark (roll,class,subject,teacher_id,image,mark,username,category) VALUES ('$s_name','$s_class','$sub','$s_tid','$image','$s_mark','$s_uname','$s_cat')";
                                            $query_run = mysqli_query($db, $query);
                                            if ($query_run) {
                                                header('Location:managetask.php');
                                            }
                                        }
                                    }

                                    // if (isset($_POST['submit'])) {



                                    //     $image = $_FILES['image']['name'];
                                    //     foreach ($image as $key => $value) {
                                    //         $image = $_FILES['image']['name'][$key];
                                    //         $imagePath = 'uploads/' . $image;
                                    //         $tmp_name = $_FILES['image']['tmp_name'][$key];
                                    //         move_uploaded_file($tmp_name, $imagePath);
                                    //         $query = "INSERT INTO mark (image) VALUES 
                                    //         ('$value')";
                                    //          $query_run = mysqli_query($db, $query);
                                    //          if($query_run){
                                    //             header('Location:managetask.php');
                                    //          }
                                    //     }
                                    // }
                                    ?>













                                </table>
                                <div align="center">
                                    <input type="submit" name="submit" class="btn btn-block btn-sm btn-success mt-2" value="Insert" />
                                </div>
                            </div>
                        </form>
                    </div>
                    </body>

                    </html>












                    <script>
                        $(document).ready(function() {

                            // Append the table while the click button is clicked
                            $(document).on('click', '.add', function() {
                                var html = '';
                                html += '<tr>';
                                html += '<td><select name="username[]" class="form-control username"><option value="">Select Name</option><?php echo fill_unit_select_box1($connect, $class); ?></select></td>';
                                html += '<td><select name="roll[]" class="form-control roll"><option value="">Select Roll</option><?php echo fill_unit_select_box($connect, $class); ?></select></td>';
                                html += '<td><input type="file" name="image[]" class="form-control pdf"></td>';
                                html += '<input type="hidden" value="<?php echo $class; ?>" name="classes[]" class="form-control classes">';
                                html += '<input type="hidden" value="<?php echo $u_id; ?>" name="tid[]" class="form-control tid">';
                                 html += '<input type="hidden" value="<?php echo $cat; ?>" name="cat[]" class="form-control cat">';

                                html += '<td><input type="text" name="mark[]" class="form-control mark"></td>';

                                html += '<td><button type="button" style="border: none;background:none;" name="remove" class="text-danger remove">Remove</button></td></tr>';
                                $('#item_table').append(html);
                            });

                            // Remove the table row when the romove button is clicked
                            $(document).on('click', '.remove', function() {
                                $(this).closest('tr').remove();
                            });

                            // Insert the collected data when the submit button is clicked


                        });
                    </script>
                    <!-- all kacal end -->














                </div>
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