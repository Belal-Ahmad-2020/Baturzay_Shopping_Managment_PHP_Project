<?php
require_once('includes/authorize.php');
authorization(2, 9, 9, 2);
require_once('includes/session.php');
require('includes/dbconnection.php');

    if (!isset($_GET['sales_id'])) {
        $emp_id = $_SESSION['login'];
        $date = date("Y-m-d");
		$sql = "INSERT INTO sales VALUES(NULL, '$emp_id', CURDATE() ) LIMIT 1";
        $return = $con->query($sql);
        $last_id = $con->insert_id;
        header("location:sales-add.php?sales_id=$last_id");
    }

    if (isset($_GET['sales_id'])) {
        $sales_id = $_GET['sales_id'];      
    }
     

    $query = "SELECT * FROM product order by product_id ASC";
    $pro = $con->query($query);
    $product = $pro->fetch_assoc();
        
    if (isset($_POST['sale-add'])) {
        $pro_id = $_POST['product_id'] ;
        $quantity = $_POST['quantity'];
        $unitprice = $_POST['unitprice'];
        $totalprice = $_POST['totalprice'];
        $discount = $_POST['discount'];
        $totalamount = $_POST['totalamount'];

        $qu = "INSERT INTO sales_detail VALUES(NULL, $sales_id, $pro_id, $quantity, $unitprice, $totalprice, $discount, $totalamount)";
        $sal = $con->query($qu);
        if ($sal) {
			$update_product = "UPDATE product SET quantity=quantity-$quantity WHERE product_id=$pro_id";
			$update = $con->query($update_product);
            $_SESSION['msg'] = "Sale Added!";
			$_SESSION['type'] = 'text-success';
			header("location:sales-add.php?sales_id=$sales_id&sales_done=true");
			exit();
        }
        else {
            $_SESSION['msg'] = "Sale Does Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:sales-add.php?sales_id=$sales_id&sales_error=true");
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
                <li class="active">Add New Sale</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Sale</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">


                                <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" id="product_id" class="form-control">
                                        <option value="0" readonly="readonly">Choosea product</option>
                                        <?php foreach($pro as $p): ?>
                                        <option value="<?php echo $p['product_id']; ?>">
                                            <?php echo $p['product_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" type="number" id="quantity" value="" name="quantity"
                                        required="true">
                                </div>
                                <div class="form-group">
                                    <label>Unitprice</label>
                                    <input class="form-control" type="number" id="unitprice" value="" name="unitprice"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <label>Totalprice</label>
                                    <input class="form-control" type="number" id="totalprice" value="" required="true"
                                        name="totalprice" readonly='readonly'>
                                </div>

                                <div class="form-group">
                                    <label>Discount</label>
                                    <input class="form-control" type="text" id="discount" value="0" required="true"
                                        name="discount">
                                </div>

                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input class="form-control" type="text" id="totalamount" value="" required="true"
                                        name="totalamount" readonly='readonly'>
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="sale-add">Add New
                                        Sale</button>
                                    <a href="sales-list.php?sales_add=done" class="btn btn-success btn-md">Finish</a>
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