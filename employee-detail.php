<?php
require_once('includes/session.php');
require('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(1, 1, 9, 9);
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
                <li class="active">Employee Detail</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Employee Detail</div>
                    <div class="panel-body">

                        <div class="col-md-12">

                            <?php

?>

                            <hr />

                            <?php          
				$id = $_GET['emp_id'];
			  $sql = "SELECT * FROM employee WHERE employee_id=$id";
			  $emp = $con->query($sql);
			  $row = $emp->fetch_assoc();

?>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-hover dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <th>Number</th>
                                            <td><?php echo $row['employee_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $row['firstname']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><?php echo $row['lastname']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Position</th>
                                            <td><?php echo $row['position']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Education</th>
                                            <td><?php echo $row['education']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone </th>
                                            <td><?php echo $row['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td><?php echo $row['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Image</th>
                                            <td><img src="<?php echo $row['image']; ?>" width='60' height='60' alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td><?php echo $row['gender']=='0'?"Male":"Female"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Hire Date</th>
                                            <td><?php echo $row['hire_date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Birth</th>
                                            <td><?php echo $row['dob']; ?>
                                                (<?php echo (date('Y') - $row['dob'] . ' years old' );?>)</td>
                                        </tr>
                                        <tr>
                                            <th>Marital Status</th>
                                            <td><?php echo $row['marital_status']==1?"Single":"Married"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Salary</th>
                                            <td><?php echo $row['salary']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shift</th>
                                            <td><?php if($row['shift'] == 0)  echo "Full Time"; else echo "Part Time"; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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