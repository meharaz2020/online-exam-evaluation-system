<?php
    
$host="localhost";
  $username="root";
  $password="";
  $databse_name="online_edu";

  $db =mysqli_connect($host,$username,$password,$databse_name);
  if($db){
  	// echo "database connect successfully";
  }else{
  	die("Database not connected".mysqli_connect_errno($db));
    }
