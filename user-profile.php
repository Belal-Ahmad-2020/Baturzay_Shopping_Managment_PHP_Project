<?php
require_once('includes/session.php');
require('includes/dbconnection.php');


$id=$_SESSION['login'];
$user_query="SELECT * FROM users INNER JOIN employee ON employee.employee_id=users.employee_id WHERE users.employee_id=$id";
$users = $con->query($user_query);
$user =  $users->fetch_assoc();





	if (isset($_POST['update_user'])) {				
		$username = $_POST['username'];
		// print_r($_POST);
		// exit();

		if ($username != " ") {
			
			$query1 = "UPDATE users SET username='$username' WHERE employee_id=$id";
			$qu1_res = $con->query($query1);
		
				if ($qu1_res) {
					$_SESSION['msg'] = "User Profile Updated!";
					$_SESSION['type'] = 'text-success';
					header("location:user-profile.php?user=true");			
					exit();
				}				
				else {
				$_SESSION['msg'] = "User Profile Doest Not Updated!";
				$_SESSION['type'] = 'text-danger';
				header("location:user-profile.php?user_error=true");			
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
        <div class="row_supplier">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">User Profile</li>
            </ol>
        </div>
        <!--/.row_supplier-->




        <div class="row_supplier">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">User Profile</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">


                            <?php 

								

						?>
                            <br>
                            <div class="form-group">
                                <div class="text-center align-items-center">
                                    <img src="<?php echo $user['image']; ?>" alt="" width="150" height="150"
                                        class="img img-responsive img-circle">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete='on'>



                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $user['firstname'] . " " . $user['lastname']; ?>"
                                        readonly="readonly">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" value="<?php echo $user['username']; ?>"
                                        required="true" name="username">
                                </div>


                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" value="<?php echo $user['email']; ?>"
                                        name="email" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" value="<?php echo $user['phone']; ?>"
                                        name="phone" readonly="readonly">
                                </div>

                                <br>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="update_user">Update
                                        User</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('includes/footer.php');?>
        </div><!-- /.row_supplier -->
    </div>
    <!--/.main-->

    <?php include('includes/script.php'); ?>

</body>

</html>