<?php 



require_once('includes/session.php');
require('includes/dbconnection.php');


         $username = $_POST["username"];
        // $username = "Test";
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $con->query($sql);
        echo $result->num_rows;


        