<?php
require_once('includes/session.php');
include('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(2, 2, 9, 9);


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
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add New Employee</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Add New Employee</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete="off">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" value="" name="name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Family Name</label>
                                    <input class="form-control" type="text" value="" name="family_name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input class="form-control" type="text" value="" name="position" required="true">
                                </div>

                                <div class="form-group">
                                    <label> &nbsp; &nbsp; Single &nbsp;
                                        <input class="" type="radio" value="1" name="marital">
                                    </label> &nbsp;
                                    <label for=""> &nbsp; &nbsp; Married &nbsp;
                                        <input class="" type="radio" value="0" name="marital">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Education</label>
                                    <!-- <input class="form-control" type="text" value="" name="education" required="true"> -->
                                    <select name="education" id="" class="form-control">
                                        <option value="No Educate">No Educate</option>
                                        <option value="High School">High School</option>
                                        <option value="Bachelore">Bachelore</option>
                                        <option value="Doctor">Doctor</option>
                                    </select>
                                </div>
                                &nbsp;
                                <div class="form-group">
                                    <label> &nbsp; &nbsp; Female &nbsp;
                                        <input class="" type="radio" value="1" name="gender">
                                    </label> &nbsp;
                                    <label for=""> &nbsp; &nbsp; Male &nbsp;
                                        <input class="" type="radio" value="0" name="gender">
                                    </label>
                                </div>
                                &nbsp;
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" value="" name="phone" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" value="" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" value="" name="address">
                                </div>
                                <div class="form-group">
                                    <label for=""> Image </label>
                                    <input class="" type="file" value="" name="image" required="true">
                                </div>


                                <div class="form-group">
                                    <label>Hire Date</label>
                                    <input type="date" class="form-control" name='hire_date' required='true'>
                                    <!-- <select name="hire_date" id="" class="">
                                        <?php 
                                            // $curent = date('Y');                                            
                                            // for($t=2000; $t<=$curent; $t++) {
                                        ?>
                                        <option value=""> <?php //echo $t; ?></option>
                                        
										<?php 
                                            // $curent = date('m');                                            
                                           // for($m=1; $m<=12; $m++) {
                                        ?>
                                        <option value=""> <?php //echo $m; ?></option>
                                        
										<?php 
                                            // $curent = date('Y');                                            
                                          //  for($d=1; $d<=31; $d++) {
                                        ?>
                                        <option value=""> <?php //echo $d; ?></option>
                                        <?php //}?>
                                    </select> -->
                                </div>

                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <select name="dob" id="" class="form-control">
                                        <?php 
                                            $curent = date('Y');                                            
                                            for($t=1950; $t<=$curent; $t++) {
                                        ?>
                                        <option value="<?php echo $t; ?>"> <?php echo $t; ?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Salary</label>
                                    <input class="form-control" type="number" value="" required="true" name="salary">
                                </div>

                                <div class="form-group">
                                    <label>Shift</label>
                                    <select name="shift" id="" class="form-control">
                                        <option value="0"> Full Time</option>
                                        <option value="1"> Part Time</option>
                                    </select>
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="add_employee">Add</button>
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