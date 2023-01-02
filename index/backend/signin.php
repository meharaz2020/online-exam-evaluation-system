<?php
include "../../database/db.php";
session_start();
if (isset($_POST['signin'])) {
    if (isset($_POST['checked'])) {

        $uname           = mysqli_real_escape_string($db, $_POST['uname']);

        $pass        = mysqli_real_escape_string($db, $_POST['pass']);

        $email_check = mysqli_query($db, "SELECT * FROM users WHERE roll = '$uname' OR username = '$uname'");

        if (mysqli_num_rows($email_check) > 0) {
            $row = mysqli_fetch_assoc($email_check);
            if (password_verify($pass, $row['password'])) {
                if ($row['status'] == 1) {
                    if ($row['role'] == 3) {
                        $_SESSION['user_id'] = $row['id'];
                        header("Location:../../admin/dashboard.php");
                    }
                    if ($row['role'] == 2) {
                        $_SESSION['user_id'] = $row['id'];
                        header("Location:../../admin/dashboard.php");
                    }
                    if ($row['role'] == 1) {
                        $_SESSION['user_id'] = $row['id'];
                        header("Location:../../teacher/teacherdashboard.php ");
                    }
                    if ($row['role'] == 0) {
                            $_SESSION['user_id'] = $row['id'];
                         header("Location:../../student/studentdashboard.php ");
                    }
                } else {
                    $_SESSION['message'] = "Your status inactive!";
                    header("Location: ../../signin.php");
                 }
            } else {
                $_SESSION['message'] = "Wrong Password";
                header("Location: ../../signin.php");
             }
        } else {
            $_SESSION['message'] ="Wrong email or username id";
            header("Location: ../../signin.php");
         }
    } else {
        $_SESSION['message'] = "Please check me out";
        header("Location: ../../signin.php");
       
    }
}



?>