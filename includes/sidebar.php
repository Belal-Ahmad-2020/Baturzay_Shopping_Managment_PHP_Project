<?php 
 if (isset($_COOKIE['remember'])) {    
    $username = $_COOKIE['remember'];
 }

?>
<?php
        if (isset($_SESSION['login'])) {
         
            $uid=$_SESSION['login'];
            $ret="SELECT username, `image` FROM users Inner Join employee 
            ON employee.employee_id=users.employee_id WHERE users.employee_id='$uid'";
            $res = $con->query($ret);
            $row=$res->fetch_assoc();
            $name=$row['username'];   
            $image=$row['image'];
        }

        ?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="<?php echo $image; ?>" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php if(!isset($_COOKIE['remember'])) { echo $name; } else { echo $username;} ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="active"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

        <!-- Employees -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em>Employees <span data-toggle="collapse" href="#sub-item-1"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="employee-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Employee
                    </a></li>
                <li><a class="" href="employee-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Employees
                    </a>
                </li>
                <li><a class="" href="employee-account.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Employee Account
                    </a>
                </li>

            </ul>

        </li>


        <!-- Supplier -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em>Suppliers <span data-toggle="collapse" href="#sub-item-2"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a class="" href="supplier-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Supplier
                    </a></li>
                <li><a class="" href="supplier-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Suppliers
                    </a>
                </li>
                <!-- <li><a class="" href="employee-account.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Employee Account
                    </a>
                    </li> -->

            </ul>

        </li>

        <!-- Supplier -->


        <!-- Buy -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-3">
                <em class="fa fa-navicon">&nbsp;</em>Buy <span data-toggle="collapse" href="#sub-item-3"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li><a class="" href="buy-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Buy
                    </a></li>
                <li><a class="" href="buy-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Buy
                    </a>
                </li>
                <!-- <li><a class="" href="employee-account.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Employee Account
                    </a>
                    </li> -->

            </ul>

        </li>
        <!-- Products -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-4">
                <em class="fa fa-navicon">&nbsp;</em>Products <span data-toggle="collapse" href="#sub-item-4"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-4">
                <li><a class="" href="product-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Product
                    </a></li>
                <li><a class="" href="product-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Product
                    </a></li>
                <li><a class="" href="product-category-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Product Category
                    </a></li>

            </ul>
        </li>

        <!-- sales -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-5">
                <em class="fa fa-navicon">&nbsp;</em>Sales <span data-toggle="collapse" href="#sub-item-5"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-5">
                <li><a class="" href="sales-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Sale
                    </a></li>
                <li><a class="" href="sales-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Sales
                    </a></li>
                <li><a class="" href="sales-return-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Return Sales
                    </a></li>

            </ul>
        </li>





        <!-- Expenses  -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-8">
                <em class="fa fa-navicon">&nbsp;</em>Expenses <span data-toggle="collapse" href="#sub-item-8"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-8">
                <li><a class="" href="expense-add.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add New Expense
                    </a></li>
                <li><a class="" href="expense-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> List All Expenses
                    </a></li>

            </ul>
        </li>



        <!-- Finance  -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-7">
                <em class="fa fa-navicon">&nbsp;</em>Report <span data-toggle="collapse" href="#sub-item-7"
                    class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-7">
                <li><a class="" href="sales-report.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sales Report
                    </a></li>
                <li><a class="" href="expense-report.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Expense Report
                    </a></li>
                <!-- <li><a class="" href="expense-report-list.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Expense Report 
                    </a></li> -->

            </ul>
        </li>


        <li><a href="user-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
        <li><a href="change-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
        <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

    </ul>
</div>