<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 2);
require_once('includes/session.php');
require('includes/dbconnection.php');

$emp_id=$_SESSION['login'];

if (isset($_POST['submit'])) {
    $from=$_POST['fromdate'];
    $to=$_POST['todate'];
  
  $rep="SELECT *, SUM(amount) as total FROM expense
   INNER JOIN employee ON employee.employee_id=expense.employee_id
    WHERE (pay_date BETWEEN '$from' and '$to') GROUP BY pay_date";
   $result = $con->query($rep);
   $exp = $result->fetch_assoc();   

}


  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MIS</title>
    <?php include("includes/style.php"); ?>
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
                <li class="active"> Expense Report Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center"> Expense Report Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">
                            <button href="" id="print_btn" class="btn btn-success pull-right">Print</button>
                            <hr />
                            <div class="table-responsive">
                                <div id="printArea">

                                    <h5 class="text-center text-info text-bold">
                                        Expense Report from <?php echo $from?> to <?php echo $to?>
                                    </h5>
                                    <br>
                                    <table id="datatable"
                                        class="table table-bordered  table-striped table-hover dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                            <tr class='text-info'>
                                                <th>Number</th>
                                                <th>Expense Title</th>
                                                <th>Employee</th>
                                                <th>Pay Date</th>
                                                <th>Reciever</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <?php
                        $num=1;
                        $total = 0;                        
                        while($exp = $result->fetch_assoc()) {

                    ?>

                                        <tr>
                                            <td><?php echo $num;?></td>
                                            <td><?php echo $report['title'];?></td>
                                            <td><?php echo $report['firstname']. " " . $report['lastname']  ; ?></td>
                                            <td><?php echo $report['pay_date']; ?></td>
                                            <td><?php  echo $report['reciever'];?></td>
                                            <td><?php  echo $report['total'];    ?> &dollar;
                                                <?php $total +=  $report['total']; ?></td>
                                            <td><?php  echo $report['currency'];?></td>
                                        </tr>
                                        <?php                            
                            $num++;
                        }?>

                                        <tr>
                                            <th colspan="5" class="text-center"> Total Expense</th>
                                            <td><?php echo ceil($total);?> &dollar;</td>
                                        </tr>

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

    <?php include('includes/script.php'); ?>

</body>

</html>