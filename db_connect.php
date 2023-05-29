<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'CS');

    $connect = mysqli_connect(HOST, USER, PASS, DB);

    if (!$connect) {
        echo "Connection Failed.";
    }
?>