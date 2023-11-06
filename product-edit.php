<?php 
require_once('includes/authorize.php');
authorization(4, 9, 4, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

$id = $_GET['edit'];
$query = "SELECT * FROM product WHERE product_id = $id";
$sup = $con->query($query);
$row_product = $sup->fetch_assoc();

	if (isset($_POST['edit'])) {
        $name = $_POST['product_name'];
        $category_id = $row_product['category_id'];
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['quantity'];
        $image = $_POST['image'];
        $store_date = $_POST['store_date'];
        $location = $_POST['location'];        
        // echo  $row_product['image'];
        // print_r($_POST);
        // exit();

        		// image 
		if ($_FILES['image']['name'] != "") {
			$path = 'assets/images/product/'. time() .$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $path);				
		}
		else {
			$path = $row_product['image'];
		}


		$sql = "UPDATE product SET  product_name='$name', category_id='$category_id', unitprice=$unitprice, quantity=$quantity, image='$path', store_date='$store_date', location='$location' WHERE product_id=$id";
        $return = $con->query($sql);
        
		if ($return) {
			$_SESSION['msg'] = "Product Updated!";
			$_SESSION['type'] = 'text-success';
			header("location:product-list.php");
			exit();
		}
		else {
			$_SESSION['msg'] = "Product Doest Not Updated!";
			$_SESSION['type'] = 'text-danger';
			header("location:product-edit.php");
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
        <div class="row_product">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Edit Product</li>
            </ol>
        </div>
        <!--/.row_product-->




        <div class="row_product">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Edit Product</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_product['product_name']; ?>" name="product_name"
                                        required="true">
                                </div>
                                <div class="form-group">
                                    <label>Unitprice</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_product['unitprice']; ?>" name="unitprice"
                                        required="true">
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_product['quantity']; ?>" required="true" name="quantity">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control" type="file" name="image"><br>
                                    <img src="<?php echo $row_product['image']; ?>"
                                        class="img img-circle img-responsive" width='70' height="50">
                                    <br>

                                </div>
                                <div class="form-group">
                                    <label>Store Date</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_product['store_date']; ?>" required="true"
                                        name="store_date">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input class="form-control" type="text"
                                        value="<?php echo $row_product['location']; ?>" required="true" name="location">
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="edit">Update
                                        Product</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('includes/footer.php');?>
        </div><!-- /.row_product -->
    </div>
    <!--/.main-->

    <?php include('includes/script.php'); ?>

</body>

</html>