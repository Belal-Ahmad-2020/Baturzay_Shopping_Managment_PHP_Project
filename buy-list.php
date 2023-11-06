<?php  
require_once('includes/authorize.php');
authorization(1, 9, 1, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');


if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {
	$sql = "SELECT  buy_id, name, CONCAT(firstname, ' ', lastname) AS emp_name, buy_date  FROM buy INNER JOIN supplier ON supplier.supplier_id=buy.supplier_id JOIN
	employee ON employee.employee_id=buy.employee_id   
   LIMIT 5";
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
	$sql = "SELECT  buy_id, name, CONCAT(firstname, ' ', lastname) AS emp_name, buy_date  FROM buy
   INNER JOIN supplier ON supplier.supplier_id=buy.supplier_id
    JOIN employee ON employee.employee_id=buy.employee_id 
    LIMIT $proPerPage,5";
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
                <li class="active">All Buy</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Buy</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">
                            <br>
                            <a href="buy-add.php" class="btn btn-primary">Add New Buy</a>
                            <br><br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Supplier</th>
                                            <th>Employee</th>
                                            <th>Date </th>
                                            <!-- <th colspan="2"> Action</th> -->
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php                
                while($row_buy = $result->fetch_assoc()):        
                  if($result->num_rows>0){
				        ?>
                                        <tr>
                                            <td><?php echo $row_buy['buy_id'];?></td>
                                            <td>
                                                <a href="buy-detail.php?buy_id=<?php echo $row_buy['buy_id']; ?>">
                                                    <?php  echo $row_buy['name'];?></a>
                                            </td>
                                            <td><?php  echo $row_buy['emp_name'];?></td>
                                            <td><?php  echo $row_buy['buy_date'];?></td>
                                            <td><a href="buy-detail.php?buy_id=<?php echo $row_buy['buy_id'];?>"><span
                                                        class="	glyphicon glyphicon-info-sign text-info"></span> </a>
                                        </tr>
                                        <?php }else { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php 
                    }  endwhile;
				          ?>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>

                                </table>

                            </div>

                            <?php 
// calculate products
if (!isset($page)) {
	$page = 0;
  }
$pag = "SELECT COUNT(buy_id) AS total FROM buy";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                            <ul class="pagination pull-right">
                                <?php   if(isset($page)&&  $page > 1): ?>
                                <li>
                                    <a href="buy-list.php?page=<?php echo $page-1; ?>">
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
                                    <a class="" href="buy-list.php?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                                <?php } else{ ?>
                                <li class=" ">
                                    <a class="" href="buy-list.php?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                                <?php } 
                        }
                      }  
                      ?>
                                <?php   if(isset($page) &&  $page+1<= $p): ?>
                                <li>
                                    <a href="buy-list.php?page=<?php echo $page+1; ?>">
                                        &gt;
                                    </a>
                                </li>
                                <?php endif; ?>


                            </ul>
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