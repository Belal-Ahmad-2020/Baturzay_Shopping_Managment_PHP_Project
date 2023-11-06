<?php
require_once('includes/session.php');
require('includes/dbconnection.php');
require('includes/authorize.php');
authorization(2, 2, 9, 9);

        // sub query 
        // only for those employees which doest not have an account
$sql = "SELECT * FROM employee WHERE employee_id NOT IN (SELECT employee_id FROM users)";
$return = $con->query($sql);
$user = $return->fetch_assoc();



	if (isset($_POST['create'])) {    
        $id = $_POST['employee_id'];
        $username = $_POST['username'];
        $newpass = $_POST['new'];
        $confpass = $_POST['confirm'];
		// print_r($_POST);
		// exit();

        if ($newpass == $confpass) {            
              $query = "INSERT INTO users(employee_id, username, password) VALUES('$id', '$username', '$newpass')"; 
              $result = $con->query($query);

              $u_level = "INSERT INTO user_level(employee_id) VALUES($id)";
              $con->query($u_level);
            if ($result) {
                $_SESSION['msg'] = "Account Created!";
                $_SESSION['type'] = 'text-success';
                header("location:employee-account.php?employee_done=true");
                exit();
            }
            else {
                $_SESSION['msg'] = "Account Does Not Created!";
                $_SESSION['type'] = 'text-danger';
                header("location:employee-account-add.php?employee_error=true");
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
                <li class="active">Add New User Account</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New User Account</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php'); ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" autocomplete="off" enctype='multipart/form-data'
                                id="password">

                                <div class="form-group">
                                    <label for="">Employee</label>
                                    <select name="employee_id" class="form-control">
                                        <?php do { ?>
                                        <option value="<?php echo $user['employee_id']; ?>">
                                            <?php  echo $user['firstname']. ' ' . $user['lastname']; ?></option>
                                        <?php } while($user = $return->fetch_assoc()); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" id='emp_user' value="" name="username"
                                        required="true">
                                </div>

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
                                    <button id="user_exist" type="submit" class="btn btn-primary" name="create">Create
                                        Account</button>
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