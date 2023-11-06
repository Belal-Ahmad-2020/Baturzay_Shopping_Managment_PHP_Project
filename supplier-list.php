<?php  
require_once('includes/authorize.php');
authorization(1, 1, 9, 1);
require_once('includes/session.php');
require('includes/dbconnection.php');

if (!isset($page)) {
	$page = 1;
}




if (!isset($_GET['page'])) {
	$sql = "SELECT * FROM supplier LIMIT 5 ";
	$result = $con->query($sql);
	$supplier = $result->fetch_assoc();
}   
else {
	$page = $_GET['page'];
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
	  $proPerPage = ($page*5)-5;  
	} 
	$sql = "SELECT * FROM supplier LIMIT $proPerPage,5";
	$result = $con->query($sql);
	$supplier = $result->fetch_assoc();
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
        <div class="sup$supplier">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">All Suppliers</li>
            </ol>
        </div>
        <!--/.sup$supplier-->




        <div class="sup$supplier">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Suppliers</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">
                            <br>
                            <a href="supplier-add.php" class="btn btn-primary">Add New Supplier</a>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Supplier ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone </th>
                                            <th>Type</th>
                                            <th> Action</th>
                                            <!-- <th>More</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php do {
				  if($result->num_rows>0) { ?>
                                        <tr>
                                            <td><?php echo $supplier['supplier_id'];?></td>
                                            <td>
                                                <a
                                                    href="supplier-detail.php?detail=<?php echo $supplier['supplier_id'];?>">
                                                    <?php  echo $supplier['name'];?> </a>
                                            </td>
                                            <td><?php  echo $supplier['email'];?></td>
                                            <td><?php  echo $supplier['phone'];?></td>
                                            <td><?php echo $supplier['supplier_type']==0 ? 'Internal': 'External'; ?>
                                            </td>
                                            <td><a class="text-success"
                                                    href="supplier-edit.php?edit=<?php echo $supplier['supplier_id']; ?>">
                                                    <span class="	glyphicon glyphicon-edit"></span> </a></td>
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
                                        <?php } } while($supplier = $result->fetch_assoc()); ?>

                                    </tbody>
                                </table>

                                <?php 
// calculate products
if (!isset($page)) {
  $page = 0;
}
$pag = "SELECT COUNT(supplier_id) AS total FROM supplier";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="supplier-list.php?page=<?php echo $page-1; ?>">
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
                                        <a class="" href="supplier-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="supplier-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="supplier-list.php?page=<?php echo $page+1; ?>">
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