<?php include 'header.php' ?>
<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
require_once 'db_connect.php';

$message = "";
$role = "";

$_SESSION['validationMessage'] = '';

if (isset($_POST['Login'])) {
    $username = stripcslashes($_POST['email']);
    $password = stripcslashes($_POST['password']);
    $username = mysqli_real_escape_string($connect, $username);
    $password = mysqli_real_escape_string($connect, $password);

    $query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['testUser'] = $row['username'];
            $_SESSION['testRole'] = $row['role'];
            // $_SESSION['testPass'] = $row['password']; 

            $query = "SELECT loginCounter FROM user WHERE username = '$username'";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($result);
            $count = $row['loginCounter'];
            echo $count;

            if ($count > 2) {
                $_SESSION['blockAcc'] = 'Yes';
                $query = "UPDATE user SET isBlocked = 'Yes' WHERE username = '$username';";
                mysqli_query($connect, $query);
                header("Location: blocked.php");
            } else {
                $_SESSION['blockAcc'] = 'No';
            }

            $mail = new PHPMailer(true);
            $otp = rand(100000, 999999);

            $query = "UPDATE user SET otp = '$otp' WHERE username='$username';";
            mysqli_query($connect, $query);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'nkkundu2018@gmail.com';
                $mail->Password   = 'hzpyuxgdcrimnwpw';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                $mail->setFrom('nkkundu2018@gmail.com', 'Nimontron');
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = '2 step verification code';
                $mail->Body    = 'Your 2 step verification code is <b>' . $otp . '</b>';

                $mail->send();

                header("Location: verification.php");
            } catch (Exception $e) {
                echo "Please set up PHPMailer properly.";
            }
        }
    } else {
        $message = "<div class='alert alert-danger' role='alert'>Invalid Email or Password.</div>";
        header("Location: index.php");
    }
}





    // $mail = new PHPMailer(true);
    // $otp = rand(100000, 999999);
    // try {
    //     $mail->isSMTP();                            
    //     $mail->Host       = 'smtp.gmail.com';       
    //     $mail->SMTPAuth   = true;                   
    //     $mail->Username   = 'nkkundu2018@gmail.com';
    //     $mail->Password   = 'hzpyuxgdcrimnwpw';     
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //     $mail->Port       = 465;  
    //     $mail->setFrom('nkkundu2018@gmail.com', 'Nimontron');
    //     $mail->addAddress($_POST['email']);
    //     $mail->isHTML(true);
    //     $mail->Subject = '2 step verification code';
    //     $mail->Body    = 'Your 2 step verification code is <b>'. $otp . '</b>';

    //     $mail->send();
        
    //     header("Location: verification.php");
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }
