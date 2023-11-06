<?php

session_start();
include('includes/dbconnection.php');

	if (isset($_COOKIE['remember'])) {
		header("location:dashboard.php");    
	}



if(isset($_POST['login'])) {
    $username = $_POST['username'];
	$password = $_POST['password'];	


	if (empty($username)) {
		 $_SESSION['msg'] = "Username is required!";
		 $_SESSION['type'] = "text-danger";
	 	// header("location:index.php");		
	}
	else if (empty($password)) {
		$_SESSION['msg'] = "Password is required!";
		$_SESSION['type'] = "text-danger";
		// header("location:index.php");		
	}
	else {
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$result = $con->query($sql);
		$user = $result->fetch_assoc();
	 	if ($result->num_rows>0) {
			 $_SESSION['login'] = $user['employee_id'];
			 if (isset($_POST['remember'])) {
				setcookie("remember", "$username", time() + 7 * 24 * 60 * 60 );
			}

			 $query2 = "SELECT * FROM user_level WHERE employee_id=".$user['employee_id'];
			 $q_res = $con->query($query2);
			 $user_levels = $q_res->fetch_assoc();
			 $_SESSION['admin'] = $user_levels['admin'];
			 $_SESSION['human_resource'] = $user_levels['human_resource'];
			 $_SESSION['inventory'] = $user_levels['inventory'];
			 $_SESSION['finance'] = $user_levels['finance'];						 
		 	header("location:dashboard.php?welcome=".$user['username']); 
		 	exit();
	 	}
	 	else {
			 $_SESSION['msg'] = "Enter valid email/password";
			 $_SESSION['type'] = "text-danger";
			 header("location:index.php?invalid=username_and_password");
			 exit();
	 	}	 
	}	
}




  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login</title>
    <?php include("includes/style.php"); ?>

</head>

<body>

    <div class="row">
        <h2 class="text-center">M-I-S</h2>
        <hr />
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading text-center">Log in</div>
                <div class="panel-body">
                    <?php include('includes/msg.php'); ?>
                    <form role="form" action="index.php" method="post" id="" name="login" autocomplete="off">
                        <fieldset>
                            <br>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text"
                                    autofocus="" required="true">
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                    value="" required="true">


                            </div>

                            <div class="checkbox">
                                <label for="r" class="checkbox-label">
                                    &nbsp; <input type="checkbox" name="remember" id="r"> Remember Me!
                                </label>
                            </div>

                            <br>

                            <div class="checkbox">
                                <button type="submit" value="login" name="login"
                                    class="btn btn-primary btn-lg btn-block">login</button><span
                                    style="padding-left:250px">
                                    <br>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

    <?php include('includes/script.php'); ?>
</body>

</html>