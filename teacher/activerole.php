<?php
ob_start();
include "db.php";
include "uper-bar.php";
?>
 <?php
  include "navbar.php";

  if (isset($_GET['active'])) {

    $id = $_GET['active'];
    $r_update = mysqli_query($db, "update users set status=1 where id='$id'");
    if ($r_update) {
      echo "<script type='text/javascript'> document.location = 'viewstudent.php'; </script>";
    }
  }
  ?>
<?php
ob_end_flush();


?>