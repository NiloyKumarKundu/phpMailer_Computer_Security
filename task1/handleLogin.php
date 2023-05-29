<?php 

session_start();
require_once '../db_connect.php';

$message = "";
$role = "";

if (isset($_POST['Login'])) {
    // SQL-Injected Prevented
    $username = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['loginUser'] = $row['username'];
            header("Location: user.php");
        }
    } else {
        $message = "Invalid Email or Password.";
        header("Location: index.php");
    }
}


?>



<!-- App password hzpyuxgdcrimnwpw -->