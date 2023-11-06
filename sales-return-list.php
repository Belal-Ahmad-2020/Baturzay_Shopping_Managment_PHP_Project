<?php  
require_once('includes/authorize.php');
authorization(1, 9, 1, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');



if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {

	$sql = "SELECT * FROM sales_return INNER JOIN product ON product.product_id=sales_return.product_id ORDER BY return_id DESC LIMIT 5";
	$result = $con->query($sql);
	$sale = $result->fetch_assoc();
	
}   
else {
	$page = $_GET['page'];
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
	  $proPerPage = ($page*5)-5;  
	} 

	$sql = "SELECT * FROM sales_return INNER JOIN product ON product.product_id=sales_return.product_id ORDER BY return_id DESC LIMIT $proPerPage,5";
	$result = $con->query($sql);
	$sale = $result->fetch_assoc();
	

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
                <li class="active">Sales Return</li>
            </ol>
        </div>
        <!--/.sup$supplier-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Returned Products</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <a href="sales-return.php" class="btn btn-primary">Add Return Sale</a>
                            <br>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Bill Number</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Unitprice</th>
                                            <th>Totalprice</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php do {
                  if($result->num_rows>0) {
                ?>
                                        <tr>
                                            <td><?php echo $sale['sales_id'];?></td>
                                            <td>
                                                <?php  echo $sale['product_name'];?>
                                            </td>
                                            <td><?php  echo $sale['return_date'];?></td>
                                            <td><?php echo $sale['quantity']; ?></td>
                                            <td><?php echo $sale['unitprice']; ?></td>
                                            <td><?php echo $sale['totalprice']; ?></td>
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
                                        <?php } } while($sale = $result->fetch_assoc()); ?>

                                    </tbody>
                                </table>
                                <?php 
// calculate products
if (!isset($page)) {
  $page = 0;
}
$pag = "SELECT COUNT(return_id) AS total FROM sales_return";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="sales-return-list.php?page=<?php echo $page-1; ?>">
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
                                        <a class="" href="sales-return-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="sales-return-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="sales-return-list.php?page=<?php echo $page+1; ?>">
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