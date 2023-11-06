<?php
require_once('includes/authorize.php');
authorization(8, 8, 9, 9);
require_once('includes/session.php');
require('includes/dbconnection.php');



if (!isset($page)) {
	$page = 1;
}


if (!isset($_GET['page'])) {
	$query = "SELECT * FROM employee INNER JOIN users ON employee.employee_id=users.employee_id ORDER BY employee.employee_id DESC limit 5";
	$result = $con->query($query);
	$users = $result->fetch_assoc();
  
}   
else {
	$page = $_GET['page'];	
	if ($page == 0 || $page < 1) {
	  $proPerPage = "0";
	}
	else {
    $proPerPage = ($page*5)-5;  	  
	} 
	$query = "SELECT * FROM employee INNER JOIN users ON employee.employee_id=users.employee_id  $proPerPage,5";
	$result = $con->query($query);
	$users = $result->fetch_assoc();

} 


	if (isset($_POST['add_employee'])) {
		$firstname = $_POST['name'];
		$family_name = $_POST['family_name'];
		$position = $_POST['position'];
		$marital = $_POST['marital'];
		$education = $_POST['education'];
		$gender = $_POST['gender'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$hire_date = $_POST['hire_date'];
		$dob = $_POST['dob'];
		$hire_date = $_POST['hire_date'];
		$salary = $_POST['salary'];
		$shift = $_POST['shift'];
		// print_r($_POST);

		// image 
		$path = 'assets/images/employee/'. time() .$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], $path);


		$sql = "INSERT INTO employee VALUES(NULL, '$firstname', '$family_name', '$position', '$education', 
		'$phone', '$email', '$address', '$path', $gender, '$hire_date', $dob, $marital, $salary, '$shift')";

		$return = $con->query($sql);
		if ($return) {
			$_SESSION['msg'] = "Employee Added!";
			$_SESSION['type'] = 'text-success';
			header("location:employee-list.php?employee_done=true");
			exit();
		}
		else {
			$_SESSION['msg'] = "Employee Doest Not Added!";
			$_SESSION['type'] = 'text-danger';
			header("location:employee-add.php?employee_error=true");
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
        <div class="users">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add New Account</li>
            </ol>
        </div>
        <!--/.users-->




        <div class="users">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Account</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <a href="employee-account-add.php" class="btn btn-primary">Add New User Account</a>
                            <hr />

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th> Image</th>
                                            <th>Email</th>
                                            <th colspan="3" class="text-center"> Action</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php do{
					 if($result->num_rows>0){ 
					  ?>
                                        <tr>
                                            <td><?php echo $users['employee_id'];?></td>
                                            <td><?php  echo $users['firstname']. " " . $users['lastname'];?></td>
                                            <td><?php  echo $users['username'];?></td>
                                            <td> <img src="<?php  echo $users['image'];?>" width='60' height='60'
                                                    class="img img-responsive img-circle" alt=""> </td>
                                            <td><?php  echo $users['email'];?></td>
                                            <td><a class="text-success "
                                                    href="employee-account-reset.php?reset=<?php echo $users['employee_id']; ?>">
                                                    Reset </a></td>
                                            <td><a class="text-danger delete delete"
                                                    href="employee-account-delete.php?delete=<?php echo $users['employee_id']; ?>"><span
                                                        class="glyphicon glyphicon-trash text-danger"></span></a> </td>
                                            <td><a class="text-warning"
                                                    href="employee-authorize.php?auth=<?php echo $users['employee_id']; ?>">
                                                    <span class="glyphicon glyphicon-lock"></span> </span></a> </td>
                                            <td><a
                                                    href="employee-account-detail.php?emp_id=<?php echo $users['employee_id'];?>"><span
                                                        class="glyphicon glyphicon-info-sign text-info"></span></a>
                                        </tr>
                                        <?php  }else { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <?php } } while ($users = $result->fetch_assoc()); ?>
                                    </tbody>
                                </table>
                                <?php 
// calculate products
if (!isset($page)) {
	$page = 0;
  }
$pag = "SELECT COUNT(employee_id) AS total FROM users";
$pag_res = $con->query($pag);
$res = $pag_res->fetch_assoc();
$total = $res['total'];
$PerPage = $total/5;
$p = ceil($PerPage);
?>
                                <ul class="pagination pull-right">
                                    <?php   if(isset($page)&&  $page > 1): ?>
                                    <li>
                                        <a href="employee-account.php?page=<?php echo $page-1; ?>">
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
                                        <a class="" href="employee-account.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } else{ ?>
                                    <li class=" ">
                                        <a class="" href="employee-account.php?page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php } 
                        }
                      }  
                      ?>
                                    <?php   if(isset($page) &&  $page+1<= $p): ?>
                                    <li>
                                        <a href="employee-account.php?page=<?php echo $page+1; ?>">
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
        </div><!-- /.users -->
    </div>
    <!--/.main-->

    <?php include('includes/script.php'); ?>

</body>

</html>