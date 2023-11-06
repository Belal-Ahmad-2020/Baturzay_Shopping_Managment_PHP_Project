<?php
require_once('includes/authorize.php');
authorization(4, 9, 9, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');




	if (isset($_POST['reset_pass'])) {
        $newpass = $_POST['new'];
        $confpass = $_POST['confirm'];

        if ($newpass == $confpass) {
            $sql = "UPDATE users SET password='$newpass'";    
            $return = $con->query($sql);
            if ($return) {
                $_SESSION['msg'] = "Password Updated!";
                $_SESSION['type'] = 'text-success';
                header("location:employee-account.php?employee_done=true");
                exit();
            }
            else {
                $_SESSION['msg'] = "Password Does Not Updated!";
                $_SESSION['type'] = 'text-danger';
                header("location:employee-account-reset.php?employee_error=true");
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
    <title>MIS</title>

    <?php include('includes/style.php') ?>
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
                <li class="active">Reset Password</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Reset Password</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php'); ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' id="password">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" id="new" value="" name="new"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password" id='confirm' value="" name="confirm"
                                        required="true">
                                </div>


                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="reset_pass">Add</button>
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