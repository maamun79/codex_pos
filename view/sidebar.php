<?php
$logo = mi_db_read_by_id('settings_meta', array('type'=>'image'))[0];
?>

<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="index.php" class="simple-text logo-normal" style="max-width: 106px;margin: 0 auto;">
            <img src="<?=MI_CDN_URL.'assets/img/logo.png';?>">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <?php if (isset($_SESSION['session_id'])){?>
                <li>
                    <a href="index.php" style="padding: 0" class="text-white">
                        <div class="row">
                            <div class="col-md-2"><i class="nc-icon nc-bank mr-2 text-white"></i></div>
                            <div class="col-md-10 text-left" style="padding-left: 25px">Dashboard</div>
                        </div>

                    </a>
                </li>
                <li>
                    <a href="orders.php" style="padding: 0" class="text-white">
                        <div class="row">
                            <div class="col-md-2"><i class="nc-icon nc-delivery-fast mr-2 text-white"></i></div>
                            <div class="col-md-10 text-left text-white" style="padding-left: 25px">Sales History</div>
                        </div>
                    </a>
                </li>
                <?php if (
                    base64_decode($_SESSION['session_type']) == "mi_1" ||
                    base64_decode($_SESSION['session_type']) == "mi_2"){?>

                    <li class="dropdown">
                        <a href="#" style="padding: 0" class="dropdown-toggle text-white" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row">
                                <div class="col-md-2"><i class="nc-icon nc-app text-white mr-2"></i></div>
                                <div class="col-md-10 text-left text-white" style="padding-left: 25px">Inventory</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2" style="max-width: 95%;">
                            <a class="dropdown-item" style="padding: 5px" href="warehouse.php">Warehouse</a>
                            <a class="dropdown-item" style="padding: 5px" href="add-stock.php">Stock</a>
                            <a class="dropdown-item" style="padding: 5px" href="categories.php">Category</a>
                            <a class="dropdown-item" style="padding: 5px" href="brands.php">Colors</a>
                            <a class="dropdown-item" style="padding: 5px" href="suppliers.php">Suppliers</a>
                        </div>
                    </li>
                <?php }?>
                <li class="dropdown">
                    <a href="#" style="padding: 0" class="dropdown-toggle text-white" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="row">
                            <div class="col-md-2"><i class="nc-icon nc-app mr-2 text-white"></i></div>
                            <div class="col-md-10 text-left text-white" style="padding-left: 25px">Expenses</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2" style="max-width: 95%;">
                        <a class="dropdown-item" href="expense.php" style="padding: 5px">Regular Expenses</a>
                        <a class="dropdown-item" href="expense_type.php" style="padding: 5px">Expense Type</a>
                        <?php
                        if (base64_decode($_SESSION['session_type']) == "mi_1"){
                            ?>
                            <a class="dropdown-item" href="investment.php" style="padding: 5px">Investment Expenses</a>
                        <?php }?>
                    </div>
                </li>
                <?php if (
                    base64_decode($_SESSION['session_type']) == "mi_1" ||
                    base64_decode($_SESSION['session_type']) == "mi_2"){?>

                    <li class="dropdown">
                        <a href="#" style="padding: 0" class="dropdown-toggle text-white" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row">
                                <div class="col-md-2"><i class="nc-icon nc-settings mr-2 text-white"></i></div>
                                <div class="col-md-10 text-left text-white" style="padding-left: 25px">Settings</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2" style="max-width: 95%;">
                            <a class="dropdown-item" style="padding: 5px" href="backup.php">Backup</a>
                            <a class="dropdown-item" style="padding: 5px" href="vat.php">VAT</a>
                            <a class="dropdown-item" style="padding: 5px" href="shop-settings.php">Shop Settings</a>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="#" style="padding: 0" class="dropdown-toggle text-white" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row">
                                <div class="col-md-2"><i class="nc-icon nc-single-02 mr-2 text-white"></i></div>
                                <div class="col-md-10 text-left text-white" style="padding-left: 25px">Users</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2" style="max-width: 95%;">
                            <a class="dropdown-item" style="padding: 5px" href="users.php">Staffs</a>
                            <a class="dropdown-item" style="padding: 5px" href="customers.php">Customers</a>
                        </div>
                    </li>

                    <li>
                        <a href="report.php" style="padding: 0" class="text-white">
                            <div class="row">
                                <div class="col-md-2"><i class="nc-icon nc-zoom-split mr-2 text-white"></i></div>
                                <div class="col-md-10 text-left text-white" style="padding-left: 25px">Report</div>
                            </div>
                        </a>
                    </li>
                <?php }?>

                <li>
                    <a href="logout.php" style="padding: 0" class="text-white">
                        <div class="row">
                            <div class="col-md-2"><i class="nc-icon nc-button-power mr-2 text-white"></i></div>
                            <div class="col-md-10 text-left text-white" style="padding-left: 25px">Sign Out</div>
                        </div>
                    </a>
                </li>
            <?php }?>
        </ul>
    </div>
</div>