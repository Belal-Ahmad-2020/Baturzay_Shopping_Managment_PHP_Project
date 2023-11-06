<?php 
require_once('includes/authorize.php');
authorization(8, 9, 8, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');


$id  =  $_GET['delete'];
$sql = "DELETE FROM category WHERE category_id=$id";
$res = $con->query($sql);
if ($res) {
    $_SESSION['msg']="Category Deleted";
    $_SESSION['type']="text-success";
    header("location:product-category-list.php");
    exit();
}
else {
    $_SESSION['msg']="Category Does Not Deleted";
    $_SESSION['type']="text-danger";
    header("location:product-category-list.php");
    exit();
}