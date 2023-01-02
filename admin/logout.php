<?php


ob_start();
session_start();
session_destroy();
header("Location:../signin.php");
ob_end_flush();
