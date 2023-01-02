<?php
 session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



if(isset($_POST['contact_mail'])){
    $name=$_POST['name'];
    $email="weareteamhelix@gmail.com";
    $message=$_POST['message'];

    $mail = new PHPMailer(true);
        $mail->isSMTP();
      
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mhrphp@gmail.com';                     //SMTP username
        $mail->Password   = 'fqyxfmgrcucmjcgx';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('mhrphp@gmail.com', 'Sikkha');
        // $mail->addAddress('mhrphp@gmail.com');                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->addAddress($email);                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
         
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject ='Dear Admin I am '.$name;
        
        $mail->Body    =  $message.'<br> Thank You............';
        // $mail->AltBody = $_POST["message"].'<a href="https://www.youtube.com/watch?v=nbaXkKJMflg&list=RDUu40qFSaINw&index=21">link</a>';
    
        $mail->send();
        if($mail)
        {
            $_SESSION['message'] = "Mail sent successfully";
            header("Location: contact_us.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Mail not sent";
            header("Location: contact_us.php");
            exit(0);
        }

}