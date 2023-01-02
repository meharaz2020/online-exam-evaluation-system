<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
 <?php
  include "navbar.php";

  if (isset($_GET['dactive'])) {

    $id = $_GET['dactive'];
    $r_update = mysqli_query($db, "update users set status=0 where id='$id'");
    if ($r_update) {
      echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
    }
  }
  ?>
<?php
ob_end_flush();


?>