<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 2);
require_once('includes/session.php');
require('includes/dbconnection.php');

$emp_id=$_SESSION['login'];

if (isset($_POST['submit'])) {
    $from=$_POST['fromdate'];
    $to=$_POST['todate'];

//     echo "SELECT *, quantity as salesQuantity, unitprice as salesUnit,  SUM(totalamount) as total FROM sales_detail INNER JOIN sales ON sales.sales_id=sales_detail.sales_id 
//   JOIN product ON product.product_id=sales_detail.product_id   where (sale_date BETWEEN '$from' and '$to') AND (employee_id=$emp_id) group by sale_date";
// exit();

  $rep="SELECT *, sales_detail.quantity as salesQuantity, sales_detail.unitprice as salesUnit,  SUM(totalamount) as total FROM sales_detail INNER JOIN sales ON sales.sales_id=sales_detail.sales_id 
  JOIN product ON product.product_id=sales_detail.product_id   where (sale_date BETWEEN '$from' and '$to') AND (employee_id=$emp_id) group by sale_date";
   $result = $con->query($rep);
   $s = $result->fetch_assoc();
   $product_id = $s['product_id'];


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
                <li class="active"> Sales Report Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center"> Sales Report Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">
                            <button href="" id="print_btn" class="btn btn-success pull-right">Print</button>
                            <hr />
                            <div class="table-responsive">
                                <div id="printArea">

                                    <h5 class="text-center text-info text-bold">
                                        Sales Report from <?php echo $from?> to <?php echo $to?>
                                    </h5>
                                    <br>
                                    <table id="datatable"
                                        class="table table-bordered  table-striped table-hover dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                            <tr class='text-info'>
                                                <th>Number</th>
                                                <th>Sale Title</th>
                                                <th>Quantity</th>
                                                <th>Unitprice</th>
                                                <th>Pay Date</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <?php
                        $num=1;
                        $total = 0;
                        foreach($result as $report) {

                    ?>

                                        <tr>
                                            <td><?php echo $num;?></td>
                                            <td><?php echo $report['product_name'];?></td>
                                            <td><?php echo $report['salesQuantity']; ?></td>
                                            <td><?php echo $report['salesUnit']; ?></td>
                                            <td><?php  echo $report['sale_date'];?></td>
                                            <td><?php  echo $report['total'];    ?> &dollar;
                                                <?php $total +=  $report['total']; ?></td>
                                        </tr>
                                        <?php                            
                            $num++;
                        }?>

                                        <tr>
                                            <th colspan="5" class="text-center"> Total </th>
                                            <td><?php echo $total;?> &dollar;</td>
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