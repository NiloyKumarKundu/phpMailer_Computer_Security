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



<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="jumbotron">
                <h2 class="text-center">
                    Welcome Admin, <?php echo $_SESSION['loginUser'] ?>
                </h2>
            </div>

            <div class='alert table-primary' role='alert'>Blocked User</div>

            <?php 
            $query = "SELECT * FROM user WHERE isBlocked='Yes'";
            $result = mysqli_query($connect, $query);
        
            if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="removeBlock.php" method="post">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>       
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><a href="removeBlock.php?email=<?php echo $row['username']; ?>" class="btn btn-danger">Remove </a></td>

                                <td><a href=""></a></td>
                            </tr>
                <?php
                }

                ?></form>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<div class='alert alert-info' role='alert'>There is no blocked user.</div>";
            }


            ?>


            <div class="col-md-6 offset-md-3">
                <a href="logout.php" name="Logout" class="btn btn-success btn-block mb-4" value="Log out"> Log out </a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>