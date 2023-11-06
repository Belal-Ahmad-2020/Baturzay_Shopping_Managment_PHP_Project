<?php
require_once('includes/authorize.php');
authorization(4, 4, 9, 4);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['edit'];
$query = "SELECT * FROM supplier WHERE supplier_id = $id";
$sup = $con->query($query);
$row_supplier = $sup->fetch_assoc();

	if (isset($_POST['supplier_add'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $type = $_POST['type'];
		// print_r($_POST);

		$sql = "UPDATE supplier SET  name='$name', phone='$phone', email='$email', supplier_type=$type, location='$location' WHERE supplier_id=$id";
        $return = $con->query($sql);
        
		if ($return) {
			$_SESSION['msg'] = "Supplier Updated!";
			$_SESSION['type'] = 'text-success';
			header("location:supplier-list.php?supplier_done=true");
			exit();
		}
		else {
			$_SESSION['msg'] = "Supplier Doest Not Updated!";
			$_SESSION['type'] = 'text-danger';
			header("location:supplier-edit.php?supplier_error=true");
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
        <div class="row_supplier">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Edit Supplier</li>
            </ol>
        </div>
        <!--/.row_supplier-->




        <div class="row_supplier">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Edit Supllier</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete='on'>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" value="<?php echo $row_supplier['name']; ?>"
                                        name="name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email"
                                        value="<?php echo $row_supplier['email']; ?>" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_supplier['phone']; ?>" name="phone" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Location</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_supplier['location']; ?>" required="true"
                                        name="location">
                                </div>

                                <div class="form-group">
                                    <label>Supplier Type</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="0"
                                            <?php if($row_supplier['supplier_type'] == 0) echo "selected" ; ?>>Internal
                                        </option>
                                        <option value="1"
                                            <?php if($row_supplier['supplier_type'] == 1) echo "selected" ; ?>>External
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="supplier_add">Update
                                        Supplier</button>
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