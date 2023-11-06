<?php
require_once('includes/authorize.php');
authorization(1, 9, 1, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['sales_id'];
$sql = "SELECT *, sales_detail.quantity AS final_quantity FROM sales_detail INNER JOIN product ON product.product_id=sales_detail.product_id  WHERE sales_id=$id";
$sales = $con->query($sql);


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
                <li class="active">Sale Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Sale Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">
                            <!-- select *, col -->

                            <span class="btn btn-success pull-right" id="print_btn">
                                Print
                            </span>
                            <br>
                            <hr />


                            <div id="printArea">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tbody>

                                            <tr>
                                                <th>Bill No</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Unitprice </th>
                                                <th>Totalprice</th>
                                                <th>Discount</th>
                                                <th>Totalamount</th>
                                            </tr>

                                            <?php $total=0; while($sale = $sales->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $sale['sales_id']; ?> </td>
                                                <td><?php echo $sale['product_name']; ?> </td>
                                                <td><?php echo $sale['final_quantity']; ?> </td>
                                                <td><?php echo $sale['unitprice']; ?> &dollar; </td>
                                                <td><?php echo $sale['totalprice']; ?> &dollar;</td>
                                                <td><?php echo $sale['discount']; ?> % </td>
                                                <td><?php echo $sale['totalamount']; ?> &dollar;
                                                    <?php $total += $sale['totalamount']; ?></td>
                                            </tr>


                                            <?php endwhile; ?>
                                            <tr>
                                                <th colspan="6">Total Price In Dollor</th>
                                                <td><?php echo $total . " "; ?> &dollar;</td>
                                            </tr>
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