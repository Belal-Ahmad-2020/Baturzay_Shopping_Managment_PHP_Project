<?php
require_once('includes/session.php');
include('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(2, 2, 9, 2);

$rep="SELECT * FROM employee Order By employee_id Desc";
$rmp = $con->query($rep);
// $emp=$rmp->fetch_assoc();



	if (isset($_POST['add_expense'])) {
        $title = $_POST['title'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $pay_date = $_POST['pay_date'];
        $emp_id = $_POST['employee_id'];
        $reciever = $_POST['reciever'];
        // print_r($_POST);
        // exit();


		$sql = "INSERT INTO expense VALUES(NULL, '$title', $amount, $currency, '$pay_date', $emp_id, '$reciever')";
		$return = $con->query($sql);
		if ($return) {
			$_SESSION['msg'] = "Expense Added!";
			$_SESSION['type'] = 'text-success';
			header("location:expense-list.php?expense=true");
			exit();
		}
		else {
			$_SESSION['msg'] = "Expense Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:expense-add.php?expense_error=true");
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
                <li class="active">Add New Expense</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Expense</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">
                                <div class="form-group">
                                    <label>Expense Title</label>
                                    <input class="form-control" type="text" value="" name="title" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Employee</label>
                                    <select name="employee_id" id="" class="form-control">
                                        <?php while($emp=$rmp->fetch_assoc()): ?>
                                        <option value="<?php echo $emp['employee_id'];  ?>">
                                            <?php echo $emp['firstname']; ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control" type="text" value="" name="amount" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Currency</label>
                                    <!-- <input class="form-control" type="text" value="" name="education" required="true"> -->
                                    <select name="currency" id="" class="form-control">
                                        <option value="0"> Dollar </option>
                                        <option value="1"> Afghani </option>
                                    </select>
                                </div>
                                &nbsp;
                                <div class="form-group">
                                    <label>Pay date</label>
                                    <input class="form-control" type="date" value="" name="pay_date" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Reciever</label>
                                    <input class="form-control" type="text" value="" name="reciever" required="true">
                                </div>
                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="add_expense">Add
                                        Expense</button>
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