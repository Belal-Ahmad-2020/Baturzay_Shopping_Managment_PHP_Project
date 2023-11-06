<?php  
require_once('includes/session.php');
require('includes/dbconnection.php');
require_once('includes/authorize.php');

authorization(1, 1, 1, 1);



if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {
	$sql = "SELECT * FROM expense INNER JOIN employee ON employee.employee_id=expense.employee_id Order By expense_id DESC LIMIT 5";
	$exp = $con->query($sql);
}   
else {
	$page = $_GET['page'];
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
	  $proPerPage = ($page*5)-5;  
	} 
	$sql = "SELECT * FROM expense INNER JOIN employee.employee=expense.employee_id Order By expense_id DESC LIMIT $proPerPage,5";
	$exp = $con->query($sql);
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
                <li class="active">All Expenses</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">All Expenses</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th> Employee</th>
                                            <th>Amount </th>
                                            <th>Currency</th>
                                            <th colspan="2" class="text-center"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php								
				while ($row = $exp->fetch_assoc()) {
					if($exp->num_rows>0) {
				?>
                                        <tr>
                                            <td><?php echo $row['expense_id'];?></td>
                                            <td><?php  echo $row['title'];?></td>
                                            <td><?php  echo $row['firstname'];?></td>
                                            <td><?php  echo $row['amount'];?></td>
                                            <td><?php echo $row['currency'] == 0 ? 'Dollar':'Afhani';?></td>
                                            <td><a class="text-danger delete"
                                                    href="expense-delete.php?delete=<?php echo $row['expense_id']; ?>">
                                                    <span class="glyphicon glyphicon-trash text-danger"></span> </a>
                                            </td>
                                            <td><a class="text-primary "
                                                    href="expense-detail.php?detail=<?php echo $row['expense_id']; ?>">
                                                    <span class="	glyphicon glyphicon-info-sign text-info"></span></a>
                                            </td>
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
                                        <?php 
					}	
				}
				?>

                                    </tbody>
                                </table>


                                <?php 
// calculate products
if (!isset($page)) {
  $page = 0;
}
$pag = "SELECT COUNT(expense_id) AS total FROM expense";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="expense-list.php?page=<?php echo $page-1; ?>">
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
                                        <a class="" href="expense-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="expense-list.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="expense-list.php?page=<?php echo $page+1; ?>">
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
        </div><!-- /.row -->
    </div>
    <!--/.main-->

    <!-- scripts -->
    <?php include('includes/script.php'); ?>
</body>

</html>