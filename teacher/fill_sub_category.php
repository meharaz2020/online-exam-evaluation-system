<?php
include "db.php";

$id=mysqli_real_escape_string($db, $_REQUEST['id']);

$sql=mysqli_query($db,"select roll from users where class='$id'");
if(mysqli_num_rows($sql)>0){
    while($row=mysqli_fetch_assoc($sql)){
        $data[]=$row;
     }
  
        
        echo json_encode($data);
   
}