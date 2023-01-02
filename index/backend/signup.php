<?php
ob_start();
session_start();
include "../../database/db.php";
?>

<!-- register start -->
<?php





if (isset($_POST['signup'])) {


    $name           = mysqli_real_escape_string($db, $_POST['name']);
    $uname           = mysqli_real_escape_string($db, $_POST['uname']);

    $roll           = mysqli_real_escape_string($db, $_POST['roll']);
    $class        = mysqli_real_escape_string($db, $_POST['class']);

    $password        = mysqli_real_escape_string($db, $_POST['pass']);
    $cpassword        = mysqli_real_escape_string($db, $_POST['cpass']);
    $pass = password_hash($password, PASSWORD_DEFAULT);


    if (!$name == "") {
        if (!$uname == "") {
            $querys = mysqli_query($db, "SELECT * FROM users WHERE username ='$uname'");
            if (mysqli_num_rows($querys) == 0) {

                if (!$roll == "") {

                    if (!$class == "") {

                        if (strlen($password) > 4) {
                            if (!$cpassword == "") {
                                if ($password == $cpassword) {

                                    $result = mysqli_query($db, "INSERT INTO users (name,username,roll,class,password)
                                                     VALUES 
                                                     ('$name','$uname','$roll','$class','$pass')");
                                    if ($result) {
                                        if ($result) {
                                            $_SESSION['message'] = "Register successfully";
                                            header("Location: ../../register.php");
                                            exit(0);
                                        } else {
                                            $_SESSION['message'] = "Register faield";
                                            header("Location: ../../register.php");
                                            exit(0);
                                        }
                                    }
                                } else {
                                    $_SESSION['message'] = "Password not match";
                                    header("Location: ../../register.php");
                                }
                            } else {
                                $_SESSION['message'] = "Confirm Password fild is required";
                                header("Location: ../../register.php");
                            }
                        } else {
                            $_SESSION['message'] = "Password must be 5 character";
                            header("Location: ../../register.php");
                        }
                    } else {
                        $_SESSION['message'] = "Class fild is required";
                        header("Location: ../../register.php");
                    }
                } else {
                    $_SESSION['message'] = "Roll fild is required";
                    header("Location: ../../register.php");
                }
            } else {
                $_SESSION['message'] = "This Username already exist";
                header("Location: ../../register.php");
            }
        } else {
            $_SESSION['message'] = "Username fild is required";
            header("Location: ../../register.php");
        }
    } else {
        $_SESSION['message'] = "Full name fild is required";
        header("Location: ../../register.php");
    }
}









?>