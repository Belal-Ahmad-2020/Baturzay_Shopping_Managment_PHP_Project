<?php
require_once('includes/authorize.php');
authorization(2, 9, 2, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');

	if (isset($_POST['category_add'])) {
      $category_name = $_POST['category_name'];
      


		$sql = "INSERT INTO category VALUES(NULL, '$category_name')"; 

		$return = $con->query($sql);
		if ($return) {
			$last_id = $con->insert_id;
			$_SESSION['msg'] = "Category  Added!";
			$_SESSION['type'] = 'text-success';
			header("location:product-category-list.php?id=$last_id");
			exit();
		}
		else {
			$_SESSION['msg'] = "Category Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:product-category-add.php?Category_error=true");
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
                <li class="active">Add New Category</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Category</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" autocomplete="off" enctype='multipart/form-data'>

                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name='category_name' class="form-control" required='true'>
                                </div>


                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="category_add">Add New
                                        Category</button>
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