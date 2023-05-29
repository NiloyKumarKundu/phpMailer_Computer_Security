<?php
session_start();

require_once 'db_connect.php';

if ($_SESSION['blockAcc'] == 'Yes') {
    header("Location: blocked.php");
}


if (!isset($_SESSION['loginUser'])) {
    header("Location: index.php");
}

if ($_SESSION['loginRole'] != 'admin') {
    if ($_SESSION['loginRole'] == 'user') {
        header("Location: user.php");
    } else {
        header("Location: index.php");
    }
}
?>

<?php include 'header.php' ?>


<?php

$username = stripcslashes($_GET['email']);
$username = mysqli_real_escape_string($connect, $username);

$query = "UPDATE user SET loginCounter=0, isBlocked = 'No'  WHERE username = '$username'";
mysqli_query($connect, $query);

header("Location: admin.php");

?>
<?php include 'footer.php' ?>
