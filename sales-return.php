<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

     


    $query = "SELECT * FROM product order by product_id ASC";
    $pro = $con->query($query);
    $product = $pro->fetch_assoc();

    
    $query2 = "SELECT sales_id FROM sales ORDER BY  sales_id DESC";
    $sale = $con->query($query2);
    $sales = $sale->fetch_assoc();

    if (isset($_POST['sale-return'])) {
        $sales_id = $_POST['sales_id'];
        $product_id = $_POST['product_id'] ;
        $return_date = $_POST['return_date'];        
        $reason = $_POST['reason'];
        $quantity = $_POST['quantity'];
        $unitprice = $_POST['unitprice'];
        $totalprice = $_POST['totalprice'];
       

        $sql = "INSERT INTO sales_return VALUES (NULL, $sales_id, $product_id, '$return_date', '$reason', $quantity, $unitprice, $totalprice)";
        $result = $con->query($sql);
        if ($result) {
			$update_product = "UPDATE product SET quantity=quantity+$quantity WHERE product_id=$pro_id";
			$update = $con->query($update_product);
            $_SESSION['msg'] = "Product Returned!";
			$_SESSION['type'] = 'text-success';
			header("location:sales-return.php?sales_return_done=true");
			exit();
        }
        else {
            $_SESSION['msg'] = "Product Does Not Returned!";
			$_SESSION['type'] = 'text-danger';
			header("location:sales-return.php?sales_return_error=true");
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
                <li class="active">Retrun Sales</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Return Sales</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete='on'>
                                <div class="form-group">
                                    <input type="hidden" name="sales_id" value="<?php echo $sales['sales_id']; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" id="product_id" class="form-control">
                                        <option value="0" readonly="readonly">Choose a product</option>
                                        <?php foreach($pro as $p): ?>
                                        <option value="<?php echo $p['product_id']; ?>">
                                            <?php echo $p['product_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Reurn Date</label>
                                    <input class="form-control" type="date" value="" required="true" name="return_date">
                                </div>



                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea name="reason" class="form-control" cols="30" rows="6">

                                    </textarea>
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

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="sale-return">Return
                                        Sale</button>
                                    <a href="sales-return-list.php?sales_add=done"
                                        class="btn btn-success btn-md">Finish</a>
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