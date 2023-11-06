<?php

require_once('includes/session.php');
require('includes/dbconnection.php');

$userid=$_SESSION['login'];

if(isset($_POST['submit'])) {
	$newpass = $_POST['newpassword'];
	$confpass = $_POST['confirmpassword'];

	$query="SELECT password FROM users WHERE employee_id=$userid";
	$result = $con->query($query);	
		if($result->num_rows>0){			
			$ret= "UPDATE users SET password='$newpass' WHERE employee_id=$userid";
			$up = $con->query($ret);
				$_SESSION['msg'] ="Password Changed";
				$_SESSION['type'] = "text-success";
				header("location:change-password.php?done=true");
				exit();
			}
			else {
				$_SESSION['msg'] ="Password  Does Not Changed";
				$_SESSION['type'] = "text-danger";
				header("location:change-password.php?error=true");
				exit();
				
			}

}

  
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIS</title>
    <?php include('includes/style.php'); ?>

    <script type="text/javascript">


    </script>
</head>

<body>
    <?php include_once('includes/header.php');?>
    <?php include_once('includes/sidebar.php');?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Change Password</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Change Password</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php'); ?>
                        <div class="col-md-12">
                            <?php


							?>
                            <form role="form" method="post" action="" id="changepassword" " >
								<div class=" form-group">
                                <label>Current Password</label>
                                <input type="password" name="currentpassword" class=" form-control" required="true"
                                    value="">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" value=""
                                required="true">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"
                                value="" required="true">
                        </div>

                        <div class="form-group has-success">
                            <button type="submit" class="btn btn-primary" name="submit">Change</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div><!-- /.panel-->
        </div><!-- /.col-->
        <?php include_once('includes/footer.php');?>
    </div><!-- /.row -->
    </div>
    <!--/.main-->

    <?php include('includes/script.php'); ?>

</body>

</html>