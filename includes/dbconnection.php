<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "baturzay";

$con = new mysqli($server, $username, $password, $db_name);

if (!$con) {
  die("connection error" . $con->connect_error);
}
// else {
//   echo "connected";
// }


  ?>