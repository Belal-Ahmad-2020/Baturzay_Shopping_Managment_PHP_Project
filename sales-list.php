<?php  
require_once('includes/authorize.php');
authorization(1, 9, 1, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');


if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {
	$sql = "SELECT sales_id, firstname, lastname, sale_date FROM sales 
	 INNER JOIN employee ON employee.employee_id=sales.employee_id
	  ORDER BY sales.sales_id DESC LIMIT 5";
	$result = $con->query($sql);
	
}   
else {
	$page = $_GET['page'];
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
	  $proPerPage = ($page*5)-5;  
	} 
	$sql = "SELECT sales_id, firstname, lastname, sale_date FROM sales  INNER JOIN employee ON employee.employee_id=sales.employee_id ORDER BY sales.sales_id DESC LIMIT $proPerPage, 5";
	$result = $con->query($sql); 	

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
                <li class="active">All Sales</li>
            </ol>
        </div>
        <!--/.sup$supplier-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Sales</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Bill Number</th>
                                            <th>Employee Name</th>
                                            <th>Date </th>

                                            <!-- <th colspan="2" class="text-center"> Action</th> -->
                                            <th colspan="2">More</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php  while($sale = $result->fetch_assoc()) {
				
				  ?>
                                        <tr>
                                            <td><?php echo $sale['sales_id'];?></td>
                                            <td>
                                                <?php  echo $sale['firstname'] . " " . $sale['lastname'];?>
                                            </td>
                                            <td><?php  echo $sale['sale_date'];?></td>
                                            <td><a class="text-info"
                                                    href="sales-detail.php?sales_id=<?php echo $sale['sales_id']; ?>"><span
                                                        class="	glyphicon glyphicon-info-sign text-info"></span></a>
                                            </td>
                                        </tr>

                                        <?php  } ?>

                                    </tbody>
                                </table>
                                <?php 
// calculate products
if (!isset($page)) {
  $page = 0;
}
$pag = "SELECT COUNT(sales_id) AS total FROM sales";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="sales-list.php?page=<?php echo $page-1; ?>">
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
                                        <a class="" href="sales-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="sales-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="sales-list.php?page=<?php echo $page+1; ?>">
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