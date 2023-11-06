<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

$query = "SELECT * FROM category";
$result = $con->query($query);
$cats = $result->fetch_assoc();



	if (isset($_POST['product_add'])) {
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['qunatity'];
        $store_date =$_POST['date'];
        $location = $_POST['location'];
        //print_r($_POST);
        // image 
        if ($_FILES['image']['name'] != "") {
            $path = 'assets/images/product/' . time() . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $path);            
        }
        else {
            $path = "";
        }

		

		$sql = "INSERT INTO product VALUES(NULL, '$name', $category_id, $unitprice, $quantity, '$path','$store_date', '$location')";
        $return = $con->query($sql);
        
		if ($return) {
			$_SESSION['msg'] = "Product Added!";
			$_SESSION['type'] = 'text-success';
			header("location:product-list.php?product_done=true");
			exit();
		}
		else {
			$_SESSION['msg'] = "Product Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:product-add.php?product_error=true");
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
    <br>

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
                <li class="active">Add New Product</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Product</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">
                                <div class="form-group">
                                    <label> Product Name</label>
                                    <input class="form-control" type="text" value="" name="name" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" type="number" value="" name="qunatity" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Unitprice</label>
                                    <input class="form-control" type="number" value="" name="unitprice" required="true">
                                </div>

                                <div class="form-group">
                                    <label>Product Image</label>
                                    <input class="form-control" type="file" value="" required="true" name="image">
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" value="" required="true" name="date">
                                </div>
                                <div class="form-group">
                                    <label>Inventory Location</label>
                                    <input class="form-control" type="text" value="" required="true" name="location">
                                </div>
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select name="category_id" id="" class="form-control">
                                        <?php  foreach($result as $cat): ?>
                                        <option value="<?php echo $cat['category_id']; ?>">
                                            <?php echo $cat['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary btn-md " name="product_add">Add New
                                        Product</button>
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