<?php 

if (!isset($_SESSION)) {
    session_start();
}


    function authorization($admin, $hr, $inventory, $finance) {

        $authorize = true;

        if ($_SESSION['admin'] >= $admin) {
            $authorize = false;
        }

        if ($_SESSION['human_resource'] >= $hr) {
            $authorize = false;
        }

        if ($_SESSION['inventory'] >= $inventory) {
            $authorize = false;
        }

        if ($_SESSION['finance'] >= $finance) {
            $authorize = false;
        }

         // if authorize is false    
        if($authorize == true) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                $url = $_SERVER['HTTP_REFERER'];  // get the url of the old page     
            }
            else {
                $url = "dashboard.php";                 
            }
            
            if (strpos($url, "?") > 0) {  // when we have a ? in url                                    
                $url = $url . "&authorize=failed";                       
            }
            else {            
                $url = $url . "?authorize=failed";                    
            }
            header("location:$url");
            exit();
        }
}


?>