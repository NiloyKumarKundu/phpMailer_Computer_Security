<?php
session_start();
require_once 'db_connect.php';

$_SESSION['validationMessage'] = '';

if ($_SESSION['blockAcc'] == 'Yes') {
    header("Location: blocked.php");
}


if (isset($_POST['submitOTP'])) {
    $value = stripcslashes($_POST['otp']);
    $value = mysqli_real_escape_string($connect, $value);

    $username = $_SESSION['testUser'];

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

    $query = "SELECT otp FROM user WHERE username='$username'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['otp'] == $value) {
            if ($_SESSION['testRole'] == 'admin') {
                $_SESSION['loginUser'] = $_SESSION['testUser'];
                $_SESSION['loginRole'] = $_SESSION['testRole'];
                
                $query = "UPDATE user SET loginCounter = 0 and isBlocked='No' WHERE username = '$username'";
                mysqli_query($connect, $query);
                header("Location: admin.php");
            } else {
                $_SESSION['loginUser'] = $_SESSION['testUser'];
                $_SESSION['loginRole'] = $_SESSION['testRole'];

                $query = "UPDATE user SET loginCounter = 0 and isBlocked='No' WHERE username = '$username'";
                mysqli_query($connect, $query);
                header("Location: user.php");
            }
        } else {
            $query = "UPDATE user SET loginCounter = loginCounter + 1 WHERE username = '$username'";
            mysqli_query($connect, $query);
            
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
            }

            $_SESSION['validationMessage'] = "<div class='alert alert-danger' role='alert'>Wrong OTP</div>";
            header("Location: verification.php");
        }
    } else {
        header("Location: index.php");
    }
}
?>