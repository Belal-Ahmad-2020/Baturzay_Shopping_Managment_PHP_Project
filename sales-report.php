<?php
require_once('includes/authorize.php');
authorization(1, 9, 1, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');




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
                <li class="active"> Sales Report</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Sales Report</div>
                    <div class="panel-body">

                        <?php include('includes/msg.php') ?>

                        <div class="col-md-12">
                            <form role="form" method="post" action="sales-report-detail.php" name="bwdatesreport">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input class="form-control" type="date" id="fromdate" name="fromdate"
                                        required="true">
                                </div>
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input class="form-control" type="date" id="todate" name="todate" required="true">
                                </div>



                                <div class="form-group has-success">
                                    <button type="submit" class="btn btn-primary" name="submit">Genrate Report</button>
                                </div>


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