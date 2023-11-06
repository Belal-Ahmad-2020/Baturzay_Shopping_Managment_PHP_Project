<?php
require_once('includes/authorize.php');
authorization(8, 9, 9, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');



if (isset($_GET['auth'])) {
    $id = $_GET['auth'];
}


$sql = "SELECT * FROM user_level WHERE employee_id=$id";
$return = $con->query($sql);
$user_level = $return->fetch_assoc();

// print_r($user_level);

// exit();



	if (isset($_POST['set'])) {    
        $admin = $_POST['admin'];
        $hr = $_POST['hr'];
        $inventory = $_POST['inventory'];
        $finance = $_POST['finance'];


        
              $query = "UPDATE user_level  SET admin=$admin, human_resource=$hr, inventory=$inventory, finance=$finance WHERE employee_id=$id";  
              $result = $con->query($query);


            if ($result) {
                $_SESSION['msg'] = "Privilege Updated!";
                $_SESSION['type'] = 'text-success';
                header("location:employee-account.php?employee_done=true");
                exit();
            }
            else {
                $_SESSION['msg'] = "Privilege Does Not Updated!";
                $_SESSION['type'] = 'text-danger';
                header("location:employee-list.php?employee_error=true");
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
                <li class="active">Privilage</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Set Privilage</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php'); ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data'>

                                <div class="form-check ">
                                    <p class="h3 text-info">Admin</p>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['admin'] == 0) echo "checked"; ?> type="radio"
                                            value="0" name="admin"> None
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['admin'] == 1) echo "checked"; ?> type="radio"
                                            value="1" name="admin"> Read
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['admin'] == 2) echo "checked"; ?> type="radio"
                                            value="2" name="admin"> Write
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['admin'] == 4) echo "checked"; ?> type="radio"
                                            value="4" name="admin"> Update
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['admin'] == 8) echo "checked"; ?> type="radio"
                                            value="8" name="admin"> Delete
                                    </label>
                                </div>

                                <br>
                                <div class="form-check ">
                                    <p class="h3 text-info">Human Resource</p>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['human_resource'] == 0) echo "checked"; ?> type="radio"
                                            value="0" name="hr"> None
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['human_resource'] == 1) echo "checked"; ?> type="radio"
                                            value="1" name="hr"> Read
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['human_resource'] == 2) echo "checked"; ?> type="radio"
                                            value="2" name="hr"> Write
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['human_resource'] == 4) echo "checked"; ?> type="radio"
                                            value="4" name="hr"> Update
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['human_resource'] == 8) echo "checked"; ?> type="radio"
                                            value="8" name="hr"> Delete
                                    </label>
                                </div>

                                <br>
                                <div class="form-check ">
                                    <p class="h3 text-info">Inventory</p>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['inventory'] == 0) echo "checked"; ?> type="radio"
                                            value="0" name="inventory"> None
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['inventory'] == 1) echo "checked"; ?> type="radio"
                                            value="1" name="inventory"> Read
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['inventory'] == 2) echo "checked"; ?> type="radio"
                                            value="2" name="inventory"> Write
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['inventory'] == 4) echo "checked"; ?> type="radio"
                                            value="4" name="inventory"> Update
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['inventory'] == 8) echo "checked"; ?> type="radio"
                                            value="8" name="inventory"> Delete
                                    </label>
                                </div>
                                <br>
                                <div class="form-check ">
                                    <p class="h3 text-info">Finance</p>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['finance'] == 0) echo "checked"; ?> type="radio"
                                            value="0" name="finance"> None
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['finance'] == 1) echo "checked"; ?> type="radio"
                                            value="1" name="finance"> Read
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['finance'] == 2) echo "checked"; ?> type="radio"
                                            value="2" name="finance"> Write
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['finance'] == 4) echo "checked"; ?> type="radio"
                                            value="4" name="finance"> Update
                                    </label>
                                    &nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                            <?php if($user_level['finance'] == 8) echo "checked"; ?> type="radio"
                                            value="8" name="finance"> Delete
                                    </label>
                                </div>
                                <br><br>
                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="set">Set
                                        Privilege</button>
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