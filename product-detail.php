<?php
require_once('includes/authorize.php');
authorization(1, 9, 1, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['detail'];


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
                <li class="active">Product Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Product Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">

                            <?php 
                $sql = "SELECT * FROM product INNER JOIN category ON category.category_id=product.category_id WHERE product_id=$id";
                $pro = $con->query($sql);
                $product = $pro->fetch_assoc();                                    
                ?>
                            <hr />

                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tbody>

                                        <tr>
                                            <th>ID</th>
                                            <td><?php echo $product['product_id']; ?>
                                            <td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $product['product_name']; ?>
                                            <td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td><?php echo $product['category_name']; ?>
                                            <td>
                                        </tr>
                                        <tr>
                                            <th>Image</th>
                                            <td> <img src="<?php echo $product['image']; ?>"
                                                    class='img img-responsive img-circle' width="100" height="100"
                                                    alt="">
                                            <td>
                                        </tr>
                                        <tr>
                                            <th> Date</th>
                                            <td><?php echo $product['store_date']; ?></<td>
                                        </tr>
                                        <tr>
                                            <th>Unitprice</th>
                                            <td><?php echo $product['unitprice']; ?> &dollar;
                                            <td>
                                        </tr>

                                        <tr>
                                            <th>Quantity </th>
                                            <td><?php echo $product['quantity']; ?>
                                            <td>
                                        </tr>
                                        <tr>
                                            <?php   $total=0; ?>
                                            <th colspan="1">Total Price</th>
                                            <td> <?php   $total = $product['quantity'] * $product['unitprice'];      echo $total . " "; ?>
                                                &dollar;
                                            <td>
                                        </tr>


                                    </tbody>
                                </table>
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