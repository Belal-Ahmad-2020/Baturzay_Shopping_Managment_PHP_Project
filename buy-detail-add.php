<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

if (isset($_GET['id'])) {
	$buy_id = $_GET['id'];
}
else {
	header("location:buy-add.php");
}


$query1 = "SELECT * FROM category ORDER BY category_id ASC";
$cat = $con->query($query1);
$row_cat = $cat->fetch_assoc();		

	if (isset($_POST['buy_detail_add'])) {
		$buy_id = $_POST['buy_id'];
		$product_name = $_POST['product_name'];
		$category_id = $_POST['category_id'];
		$description = $_POST['description'];
		$quantity = $_POST['quantity'];
		$unitprice = $_POST['unitprice'];
		$totalprice = $_POST['totalprice'];
		$manufacture_date = $_POST['manufacture_date'];		
		if (isset($_POST['expire_date'])) {
			$expire_date = "'" . $_POST["expire_date"] . "'"; 	
		}
		else {
			$expire_date = 'NULL';
		}

		$sql = "INSERT INTO buy_detail VALUES(NULL, $buy_id, '$product_name', $category_id, '$description', $quantity, $unitprice,
		$totalprice, '$manufacture_date', $expire_date)"; 

		$return = $con->query($sql);
		if ($return) {
			$_SESSION['msg'] = "New Buy Added You Can Add More Details!";
			$_SESSION['type'] = 'text-success';
			header("location:buy-detail-add.php?id=$buy_id");
			exit();
		}
		else {
			$_SESSION['msg'] = "Buy Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:buy-detail-add.php?buy_error=true");
			exit();

		}
	}


//  to show the number of stored products in table
$qu = "SELECT COUNT(detail_id) AS num FROM buy_detail WHERE buy_id=$buy_id";
$count = $con->query($qu);
$buy_det = $count->fetch_assoc();


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
                <li class="active">Add New Buy</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Buy</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <br>
                        <p class="text-center ">
                            <?php if(isset($buy_det)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            The number of inserted products<strong> (<?php echo $buy_det['num']; ?>)</strong>
                        </div>
                        <?php }  ?>
                        </p>
                        <br>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">

                                <input type="hidden" name="buy_id" value="<?php echo $buy_id; ?>">

                                <div class="form-group">
                                    <label>Product Name </label>
                                    <input class="form-control" type="text" value="" name="product_name"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <?php  
							
								?>
                                    <select name="category_id" id="" class="form-control">
                                        <?php do { ?>
                                        <option value="<?php echo $row_cat['category_id'] ?>">
                                            <?php echo $row_cat['category_name'] ?></option>
                                        <?php } while($row_cat = $cat->fetch_assoc());?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for=""> Description </label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control">
								</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" id="quantity" type="number" value="" name="quantity"
                                        required="true">
                                </div>

                                <div class="form-group ">
                                    <label>Unit Price</label>
                                    <input class="form-control" type="number" id="unitprice" value="" name="unitprice"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <label>Total Price</label>
                                    <input class="form-control" type="text" id="totalprice" value="" name="totalprice"
                                        readonly="readonly">
                                </div>

                                <div class="form-group">
                                    <label>Manufacture Date</label>
                                    <input class="form-control" type="date" value="" name="manufacture_date"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <label>Expire Date</label>
                                    <input class="form-control" type="date" value="" name="expire_date">
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="buy_detail_add">Add Buy
                                        Detail</button>
                                    <a href="buy-list.php" class="btn btn-success">Finish</a>
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