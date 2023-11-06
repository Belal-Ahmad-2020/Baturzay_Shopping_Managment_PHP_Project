<?php
require_once('includes/session.php');
require('includes/dbconnection.php');
require_once('includes/authorize.php');
authorization(4, 4, 9, 9);

$id = $_GET['edit'];
$emp = "SELECT * FROM employee WHERE employee_id=$id";
$employee = $con->query($emp);
$row_emp = $employee->fetch_assoc();

	if (isset($_POST['edit_employee'])) {
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
		if ($_FILES['image']['name'] != "") {
			$path = 'assets/images/employee/'. time() .$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $path);				
		}
		else {
			$path = $row_emp['image'];
		}


		$sql = "UPDATE employee SET firstname='$firstname', lastname='$family_name', position='$position', education='$education', 
		phone='$phone', email='$email', address='$address', image='$path', gender=$gender, hire_date='$hire_date', dob=$dob,
		marital_status=$marital, salary=$salary, shift='$shift' WHERE employee_id=$id";

		$return = $con->query($sql);
		if ($return) {
			$_SESSION['msg'] = "Employee Updated!";
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
                <li class="active">Edit Employee Details</li>
            </ol>
        </div>
        <!--/.row-->




        <div class="row">
            <div class="col-lg-12">



                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Edit Employee Details</div>
                    <div class="panel-body">
                        <?php include('includes/msg.php') ?>
                        <div class="col-md-12">

                            <form role="form" method="post" action="" enctype='multipart/form-data' autocomplete='off'>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" value="<?php echo $row_emp['firstname']; ?>"
                                        name="name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Family Name</label>
                                    <input class="form-control" type="text" value="<?php echo $row_emp['lastname']; ?>"
                                        name="family_name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input class="form-control" type="text" value="<?php echo $row_emp['position']; ?>"
                                        name="position" required="true">
                                </div>

                                <div class="form-group">
                                    <label> &nbsp; &nbsp; Single &nbsp;
                                        <input class="" type="radio" value="1"
                                            <?php if($row_emp['marital_status'] == 1) echo 'checked'; ?> name="marital">
                                    </label> &nbsp;
                                    <label for=""> &nbsp; &nbsp; Married &nbsp;
                                        <input class="" type="radio" value="0" name="marital"
                                            <?php if($row_emp['marital_status'] == 0) echo 'checked'; ?>>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Education</label>
                                    <!-- <input class="form-control" type="text" value="" name="education" required="true"> -->
                                    <select name="education" id="" class="form-control">
                                        <option value="No Educate"
                                            <?php if($row_emp['education'] == 'No Educate') echo 'selected'; ?>>No
                                            Educate</option>
                                        <option value="High School"
                                            <?php if($row_emp['education'] == 'High School') echo 'selected'; ?>>High
                                            School</option>
                                        <option value="Bachelore"
                                            <?php if($row_emp['education'] == 'Bachelore') echo 'selected'; ?>>Bachelore
                                        </option>
                                        <option value="Doctor"
                                            <?php if($row_emp['education'] == 'Doctor') echo 'selected'; ?>>Doctor
                                        </option>
                                    </select>
                                </div>
                                &nbsp;
                                <div class="form-group">
                                    <label> &nbsp; &nbsp; Female &nbsp;
                                        <input class="" type="radio" value="1" name="gender"
                                            <?php if($row_emp['gender'] == 1) echo 'checked'; ?>>
                                    </label> &nbsp;
                                    <label for=""> &nbsp; &nbsp; Male &nbsp;
                                        <input class="" type="radio" value="0" name="gender"
                                            <?php if($row_emp['gender'] == 0) echo 'checked'; ?>>
                                    </label>
                                </div>
                                &nbsp;
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" value="<?php echo $row_emp['phone']; ?>"
                                        name="phone" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" value="<?php echo $row_emp['email']; ?>"
                                        name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" value="<?php echo $row_emp['address']; ?>"
                                        name="address">
                                </div>
                                <div class="form-group">
                                    <label for=""> Image </label>
                                    <input class="" type="file" value="" name="image">
                                    <br>
                                    <img src="<?php echo $row_emp['image']; ?>" class="img img-circle img-responsive"
                                        width='70' height="50">
                                    <br>
                                </div>


                                <div class="form-group">
                                    <label>Hire Date</label>
                                    <input type="date" class="form-control" name='hire_date'
                                        value="<?php echo $row_emp['hire_date']; ?>" required='true'>
                                    <!-- <select name="hire_date" id="" class="">
                                        <?php 
                                            // $curent = date('Y');                                            
                                            // for($t=2000; $t<=$curent; $t++) {
                                        ?>
                                        <option value=""> <?php //echo $t; ?></option>
                                        <?php// }?>
										<?php 
                                            // $curent = date('m');                                            
                                           // for($m=1; $m<=12; $m++) {
                                        ?>
                                        <option value=""> <?php //echo $m; ?></option>
                                        <?php// }?>
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
                                    <input type="text" required='true' name='dob' value="<?php echo $row_emp['dob']; ?>"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Salary</label>
                                    <input class="form-control" type="number" value="<?php echo $row_emp['salary']; ?>"
                                        required="true" name="salary">
                                </div>

                                <div class="form-group">
                                    <label>Shift</label>
                                    <input type="text" name='shift' required="true"
                                        value="<?php if($row_emp['shift']==0){ echo 'Full Time';} else {echo "Part Time";}  ?>"
                                        class="form-control">
                                    <!-- <select name="shift" id="" class="form-control">
                                        <option value="0"> Full Time</option>                                        
										<option value="1"> Part Time</option>
                                    </select> -->
                                </div>

                                <div class="form-group has-success ">
                                    <button type="submit" class="btn btn-primary" name="edit_employee">Update</button>
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