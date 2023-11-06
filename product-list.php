<?php  
require_once('includes/authorize.php');
authorization(1, 1, 1, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');



if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {
	$sql = "SELECT * FROM product   LIMIT 5";
	$result = $con->query($sql);
	$product = $result->fetch_assoc();
}   
else {
	$page = $_GET['page'];
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
	  $proPerPage = ($page*5)-5;  
	} 
	$sql = "SELECT * FROM product  LIMIT $proPerPage,5";
	$result = $con->query($sql);
	$product = $result->fetch_assoc();
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
                <li class="active">All Products</li>
            </ol>
        </div>
        <!--/.sup$supplier-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Products</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">
                            <br>
                            <a href="product-add.php" class="btn btn-primary">Add New Product</a>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stiped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Unitprice </th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th> Action</th>
                                            <!-- <th>More</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php  do { 
                      if($result->num_rows>0) {
                ?>

                                        <tr>
                                            <td><?php echo $product['product_id'];?></td>
                                            <td>
                                                <a
                                                    href="product-detail.php?detail=<?php echo $product['product_id'];?>">
                                                    <?php  echo $product['product_name'];?> </a>
                                            </td>
                                            <td><?php  echo $product['unitprice'];?></td>
                                            <td> <img src="<?php  echo $product['image'];?>" alt="" width="90"
                                                    height="80" class="img img-responsive img-circle"> </td>
                                            <td><?php  echo $product['store_date'];?></td>
                                            <td><a class="text-success"
                                                    href="product-edit.php?edit=<?php echo $product['product_id']; ?>">
                                                    Edit </a></td>

                                        </tr>
                                        <?php }else { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php }} while($product = $result->fetch_assoc()); ?>

                                    </tbody>
                                </table>

                                <?php 
// calculate products
if (!isset($page)) {
  $page = 0;
}
$pag = "SELECT COUNT(product_id) AS total FROM product";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="product-list.php?page=<?php echo $page-1; ?>">
                                            &lt;
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php 
                      for($i=1; $i<=$p; $i++) {
                        if (isset($page)) {                                                
                          if ($i == $page) {
                    ?>
                                    <li class=" active">
                                        <a class="" href="product-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="product-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="product-list.php?page=<?php echo $page+1; ?>">
                                            &gt;
                                        </a>
                                    </li>
                                    <?php endif; ?>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('includes/footer.php');?>
        </div><!-- /.sup$supplier -->
    </div>
    <!--/.main-->

    <!-- scripts -->
    <?php include('includes/script.php'); ?>
</body>

</html>