<?php
require_once('includes/authorize.php');
authorization(1, 9, 1, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['buy_id'];


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
                <li class="active">Buy Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Buy Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">

                            <?php 
                $sql = "SELECT * FROM buy_detail INNER JOIN category ON category.category_id=buy_detail.category_id WHERE buy_id=$id";
                $buy = $con->query($sql);
                $row_buy = $buy->fetch_assoc();                                    
                ?>

                            <span class="btn btn-success pull-right" id="print_btn">
                                Print
                            </span>

                            <br>
                            <hr />
                            <!-- for prict printArea -->

                            <br>
                            <div id="printArea">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tbody>

                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unitprice </th>
                                                <th>Totalprice</th>
                                                <th>Manufacture Date</th>
                                                <th>Expire Date</th>
                                            </tr>

                                            <?php  $num = 1; $total=0; do { ?>
                                            <tr>
                                                <td><?php echo $num; ?></<td>
                                                <td><?php echo $row_buy['product_name']; ?></td>
                                                <td><?php echo $row_buy['category_name']; ?></td>
                                                <td><?php echo $row_buy['description']; ?></td>
                                                <td><?php echo $row_buy['quantity']; ?></td>
                                                <td><?php echo $row_buy['unitprice']; ?> &dollar;</td>
                                                <td><?php echo $row_buy['totalprice']; ?> &dollar;
                                                    <?php $total += $row_buy['totalprice']; ?></td>
                                                <td><?php echo $row_buy['manufacture_date']; ?></td>
                                                <td><?php echo $row_buy['expire_date']; ?></td>
                                            </tr>


                                            <?php $num++; } while($row_buy = $buy->fetch_assoc()); ?>
                                            <tr>
                                                <th colspan="6">Total Price In Dollor</th>
                                                <td><?php echo $total . " "; ?> &dollar;</td>
                                                <th colspan="2"></th>
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