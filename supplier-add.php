<?php
require_once('includes/authorize.php');
authorization(2, 2, 9, 2);
require_once('includes/session.php');
require('includes/dbconnection.php');



	if (isset($_POST['supplier_add'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $type = $_POST['type'];
		// print_r($_POST);

		$sql = "INSERT INTO supplier VALUES(NULL, '$name', '$phone', '$email', $type, '$location')";
        $return = $con->query($sql);
        
		if ($return) {
			$_SESSION['msg'] = "Supplier Added!";
			$_SESSION['type'] = 'text-success';
			header("location:supplier-list.php?supplier_done=true");
			exit();
		}
		else {
			$_SESSION['msg'] = "Supplier Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:supplier-add.php?supplier_error=true");
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
                <li class="active">Add New Supplier</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Supllier</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" value="" name="name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" value="" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" value="" name="phone" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Location</label>
                                    <input class="form-control" type="text" value="" required="true" name="location">
                                </div>

                                <div class="form-group">
                                    <label>Supplier Type</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="0">Internal</option>
                                        <option value="1">External</option>
                                    </select>
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="supplier_add">Add New
                                        Supplier</button>
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