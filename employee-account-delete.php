<?php 
require_once('includes/authorize.php');
authorization(8, 8, 9, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');



$delete_id = $_GET['delete'];

$sql = "Delete From users Where employee_id=$delete_id";
$result = $con->query($sql);
if ($result) {
    $_SESSION['msg'] = "Employee Account Deleted";
    $_SESSION['type'] = "text-success";
    header("location:employee-account.php");
    exit();
}
else {
    $_SESSION['msg'] = "Employee Account Does Not Deleted";
    $_SESSION['type'] = "text-danger";
    header("location:employee-account.php");
    exit();
}