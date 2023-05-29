<?php
session_start();
require_once 'db_connect.php';

if ($_SESSION['blockAcc'] == 'Yes') {
    header("Location: blocked.php");
}


$username = $_SESSION['testUser'];
$query = "SELECT loginCounter FROM user WHERE username = '$username'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['loginCounter'];


?>

<?php include 'header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="m-4">2 Step verification</h1>

            <form action="handleVerification.php" method="POST">
                <!-- Email input --> 
                <div class="form-outline mb-4">
                    <div class='alert alert-info' role='alert'>
                        OTP is sent to you mail.
                        <br>
                        You have left <?php echo 3 - $count; ?> attemps, otherwise your account will be blocked.
                    </div>
                    <br>
                    <label class="form-label" for="form2Example1">Enter OTP</label>
                    <input type="number" name="otp" id="form2Example1" class="form-control" />
                </div>

                <?php echo $_SESSION['validationMessage']; ?>

                <input type="submit" name="submitOTP" class="btn btn-success btn-block mb-4" value="submit" />
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
