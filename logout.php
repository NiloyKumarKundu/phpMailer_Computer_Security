<?php 

session_start();

unset($_SESSION['loginUser']);
unset($_SESSION['loginRole']);
header('Location: index.php');


?> 