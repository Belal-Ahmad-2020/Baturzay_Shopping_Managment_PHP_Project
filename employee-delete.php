<?php 
require_once('includes/session.php');
require('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(8, 8, 9, 9);


$delete_id = $_GET['delete'];

$sql = "Delete From employee Where employee_id=$delete_id";
$result = $con->query($sql);
if ($result) {
    $_SESSION['msg'] = "Employee Deleted";
    $_SESSION['type'] = "text-success";
    header("location:employee-list.php");
    exit();
}
else {
    $_SESSION['msg'] = "Employee Does Not Deleted";
    $_SESSION['type'] = "text-danger";
    header("location:employee-list.php");
    exit();
}