<?php
session_start();
// authentication
unset($_SESSION['login']);
// authorization
unset($_SESSION['admin']);
unset($_SESSION['human_resource']);
unset($_SESSION['inventory']);
unset($_SESSION['finance']); 
session_destroy();


setcookie("remember", "", time() - 3600);

header('location:index.php');

?>