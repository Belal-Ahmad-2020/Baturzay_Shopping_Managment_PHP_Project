<?php
require_once('includes/authorize.php');
authorization(1, 1, 9, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');
  

$id = $_GET['detail'];
$sql = "SELECT * FROM supplier WHERE supplier_id=$id";
$sup = $con->query($sql);
$row_supplier = $sup->fetch_assoc();
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
                <li class="active">Supplier Detail</li>
            </ol>
        </div>
        <!--/.row_supplier-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Supplier Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">

                            <?php

?>

                            <hr />


                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <th>Supplier ID</th>
                                            <td><?php echo $row_supplier['supplier_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $row_supplier['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone </th>
                                            <td><?php echo $row_supplier['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $row_supplier['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td><?php echo $row_supplier['location']; ?></td>
                                        </tr>

                                        <tr>

                                        <tr>
                                            <th>Supplier Type</th>
                                            <td><?php if($row_supplier['supplier_type'] == 0)  echo "Internal"; else echo "External"; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>






                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('includes/footer.php');?>
        </div><!-- /.row_supplier -->
    </div>
    <!--/.main-->

    <!-- scripts -->
    <?php include('includes/script.php'); ?>
</body>

</html>