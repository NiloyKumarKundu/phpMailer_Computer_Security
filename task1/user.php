<?php
session_start();
?>
<?php include '../header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="jumbotron">
                <h2 class="text-center">
                    Welcome User
                </h2>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="logout.php" name="Logout" class="btn btn-success btn-block mb-4" value="Log out"> Log out </a>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php' ?>