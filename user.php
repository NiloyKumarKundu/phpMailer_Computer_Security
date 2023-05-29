<?php
session_start();

if ($_SESSION['blockAcc'] == 'Yes') {
    header("Location: blocked.php");
}


if (!isset($_SESSION['loginUser'])) {
    header("Location: index.php");
}

if ($_SESSION['loginRole'] != 'user') {
    if ($_SESSION['loginRole'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
}
?>

<?php include 'header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="jumbotron">
                <h2 class="text-center">
                    Welcome User, <?php echo $_SESSION['loginUser'] ?>
                </h2>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="logout.php" name="Logout" class="btn btn-success btn-block mb-4" value="Log out"> Log out </a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>