<?php
require_once('includes/authorize.php');
authorization(1, 1, 1, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['detail'];
$sql = "SELECT * FROM expense INNER JOIN employee ON employee.employee_id=expense.employee_id  WHERE expense_id=$id";
 $expense = $con->query($sql);

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
                <li class="active">Expense Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Expense Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">

                            <span>
                                <button id="print_btn" class="btn btn-success pull-right">Print</button>
                            </span>

                            <br>
                            <hr />


                            <div id="printArea">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tbody>

                                            <tr>
                                                <th>ID</th>
                                                <th>Expense Title</th>
                                                <th>Employee Name</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                                <th>Pay Date</th>
                                                <th>Reciever</th>
                                            </tr>

                                            <?php  foreach($expense as $sale): ?>
                                            <tr>
                                                <td><?php echo $sale['expense_id']; ?> </td>
                                                <td><?php echo $sale['title']; ?> </td>
                                                <td><?php echo $sale['firstname']; ?> </td>
                                                <td><?php echo $sale['amount']; ?> &dollar; </td>
                                                <td><?php echo $sale['currency'] == 0 ? 'Dollar':'Afhani'; ?> </td>
                                                <td><?php echo $sale['pay_date']; ?> </td>
                                                <td><?php echo $sale['receiver']; ?> </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('includes/footer.php');?>
        </div><!-- /.row -->
    </div>
    <!--/.main-->

    <!-- scripts -->
    <?php include('includes/script.php'); ?>
</body>

</html>