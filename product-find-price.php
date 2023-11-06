<?php 

// find the product price using ajax and php  
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_POST['p_id'];

$sql = "SELECT unitprice FROM product WHERE product_id=$id";
$res = $con->query($sql);
$unit = $res->fetch_assoc();
$unitprice = $unit['unitprice'];
echo $unitprice;// it sends the data to the js