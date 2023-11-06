<?php 
require_once('includes/session.php');
require('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(8, 8, 9, 8);


$delete_id = $_GET['delete'];

$sql = "DELETE FROM expense WHERE expense_id=$delete_id";
$result = $con->query($sql);
if ($result) {
    $_SESSION['msg'] = "Expense Deleted";
    $_SESSION['type'] = "text-success";
    header("location:expense-list.php");
    exit();
}
else {
    $_SESSION['msg'] = "Expense Does Not Deleted";
    $_SESSION['type'] = "text-danger";
    header("location:expense-list.php");
    exit();
}