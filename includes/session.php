<?php

if (!isset($_SESSION)) {
  session_start();  
}


if (strlen($_SESSION['login']==0)) {
    header('location:logout.php');
  }