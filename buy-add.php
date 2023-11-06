<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');
// employee
$query1 = "SELECT * FROM employee ORDER BY employee_id ASC";
$emp_res = $con->query($query1);
$row_emp = $emp_res->fetch_assoc();

// supplier
$query2 = "SELECT * FROM supplier ORDER BY supplier_id ASC";
$sup_res = $con->query($query2);
$row_sup = $sup_res->fetch_assoc();

	if (isset($_POST['buy_add'])) {
        $supplier_id = $_POST['supplier_id'];
        $employee_id = $_POST['employee_id'];
		$buy_date = $_POST['buy_date'];

		$sql = "INSERT INTO buy VALUES(NULL, $supplier_id, $employee_id, '$buy_date')"; 

		$return = $con->query($sql);
		if ($return) {
            $last_id = $con->insert_id;
			$_SESSION['msg'] = "Buy Added Please Insert Buy Details!";
			$_SESSION['type'] = 'text-success';
			header("location:buy-detail-add.php?id=$last_id");
			exit();
		}
		else {
			$_SESSION['msg'] = "Buy Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:buy-add.php?buy_error=true");
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
                <li class="active">Add New Buy</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-default">
                    <div class="panel-heading">Add New Buy</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">

                                <div class="form-group">
                                    <label for="">Supplier</label>
                                    <select name="supplier_id" id="" class="form-control">
                                        <?php do {?>
                                        <option value="<?php echo $row_sup['supplier_id'] ?>">
                                            <?php echo $row_sup['name'] ?></option>
                                        <?php } while($row_sup = $sup_res->fetch_assoc());?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Employee</label>
                                    <select name="employee_id" id="" class="form-control">
                                        <?php do {?>
                                        <option value="<?php echo $row_emp['employee_id'] ?>">
                                            <?php echo $row_emp['firstname'] ?></option>
                                        <?php } while($row_emp = $emp_res->fetch_assoc());?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" value="" name="buy_date" required="true">
                                </div>


                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="buy_add">Add New Buy</button>
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