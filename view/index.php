<?=mi_header();?>
<?php

if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2" &&
    base64_decode($_SESSION['session_type']) !== "mi_3"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

?>
<?=mi_sidebar();?>

    <div class="main-panel">
<?=mi_nav();?>

    <div class="content">
        <?php if (
            base64_decode($_SESSION['session_type']) == "mi_1" ||
            base64_decode($_SESSION['session_type']) == "mi_2"){?>
            <div class="row">
                <div class="col-md-3 col-sm-4" style="padding: 0 8px">
                    <a href="orders.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats bg-primary text-white" style="margin-bottom: 16px">
=======
                        <div class="card card-stats text-white rounded-0" style="margin-bottom: 16px; background-color: #303f9f">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4" style="padding: 0 8px">
                    <a href="warehouse.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats bg-primary text-white" style="margin-bottom: 16px">
=======
                        <div class="card card-stats text-white rounded-0" style="margin-bottom: 16px; background-color: #00695c">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="add-stock.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats bg-primary text-white" style="margin-bottom: 16px">
=======
                        <div class="card card-stats text-white rounded-0" style="margin-bottom: 16px; background-color: #673ab7">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Stock</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="suppliers.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats bg-primary text-white" style="margin-bottom: 16px">
=======
                        <div class="card card-stats text-white rounded-0" style="margin-bottom: 16px; background-color: #1b5e20">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Suppliers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="report.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats bg-primary text-white" style="margin-bottom: 16px">
=======
                        <div class="card card-stats text-white rounded-0" style="margin-bottom: 16px; background-color: #e65100">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Report</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4" style="padding: 0 8px;">
                    <a href="shop-settings.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats text-white" style="background-color: #66615b;">
=======
                        <div class="card card-stats text-white rounded-0" style="background-color: #5c6bc0;">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Settings</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4" style="padding: 0 8px">
                    <a href="expense.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats text-white" style="background-color: #66615b;">
=======
                        <div class="card card-stats text-white rounded-0" style="background-color: #009688;">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Regular Expenses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="vat.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats text-white" style="background-color: #66615b;">
=======
                        <div class="card card-stats text-white rounded-0" style="background-color: #9575cd;">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">VAT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="users.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats text-white" style="background-color: #66615b;">
=======
                        <div class="card card-stats text-white rounded-0" style="background-color: #4caf50;">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Staffs</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-sm-4" style="padding: 0 8px">
                    <a href="customers.php" class="text-center">
<<<<<<< HEAD
                        <div class="card card-stats text-white" style="background-color: #66615b;">
=======
                        <div class="card card-stats text-white rounded-0" style="background-color: #ff9800;">
>>>>>>> 517c8a120bafaea68439c7cb9fb65be2ca27b30a
                            <div class="card-body">
                                <div>
                                    <div class="numbers text-center custom_card_layout_padding">
                                        <p class="">Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="row">
                <div style="padding: 8px" class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-app text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Total Products</p>
                                        <?php
                                            $products = mi_db_custom_query("SELECT * FROM mi_products WHERE MONTH(pro_added) = MONTH(CURDATE()) AND YEAR(pro_added) = YEAR(CURDATE())");
                                        ?>
                                        <p class="card-title"><?=count($products);?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> Products Total
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 8px" class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-bag-16 text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Total Sales</p>
                                        <?php
                                            $orders = mi_db_custom_query("SELECT * FROM mi_orders WHERE refund_date = '0000-00-00 00:00:00' AND MONTH(order_created) = MONTH(CURDATE()) AND YEAR(order_created) = YEAR(CURDATE())");
                                        ?>
                                        <p class="card-title"><?=count($orders);?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> Orders Got Total
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 8px" class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-money-coins text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Total Sell Amount</p>
                                        <p class="card-title"><?=$currency['meta_value']?>
                                            <?php
                                                $total_saleslf = array();
                                                $total_saleslfdata = mi_db_custom_query("SELECT * FROM mi_orders WHERE MONTH(order_created) = MONTH(CURDATE()) AND YEAR(order_created) = YEAR(CURDATE())");
                                                foreach ($total_saleslfdata as $totalval){
                                                    if ($totalval['refund_date'] == '0000-00-00 00:00:00'){
                                                        $total_saleslf[] = $totalval['total_amount'];
                                                    }
                                                }
                                                echo number_format(array_sum($total_saleslf), 2);
                                            ?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> Revenue Earned Total
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 8px" class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-circle-10 text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Total Suppliers</p>
                                        <?php
                                            $suppliers = mi_db_custom_query("SELECT * FROM mi_product_suppliers WHERE MONTH(sup_added) = MONTH(CURDATE()) AND YEAR(sup_added) = YEAR(CURDATE())");
                                        ?>
                                        <p class="card-title"><?=mi_db_tbl_row_count('mi_product_suppliers');?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> All Suppliers
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-md-4" style="padding: 0 10px">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title pull-left" style="margin-top: 20px !important;">Sales</h5>
                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                            <button type="button" id="today" class="btn btn-secondary btn-sm filter-active" style="text-transform:capitalize;">Today</button>
                            <button type="button" id="lastWeek" class="btn btn-secondary btn-sm" style="text-transform:capitalize;">Last Week</button>
                            <button type="button" id="lastMonth" class="btn btn-secondary btn-sm" style="text-transform:capitalize;">Last Month</button>
                        </div>
                    </div>
                    <div class="card-body text-center" id="sales_filter">
                        <h1 class="display-1" style="font-size: 5rem;padding: 1.6rem 0rem;line-height: 100px;">
                            <strong>
                                <?=count(mi_db_tbl_val_between('mi_orders', 'order_created', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00'))); ?>
                            </strong>
                        </h1>
                        <?php
                        $todaySales = array();
                        $todaysAmnt = mi_db_tbl_val_between('mi_orders', 'order_created', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00'));
                        foreach ($todaysAmnt as $tvl){
                            $todaySales[] = $tvl['total_amount'];
                        }
                        $todaySaleAmount = array_sum($todaySales);
                        ?>
                        <h5>
                            Sale Amount: <strong><?=number_format($todaySaleAmount, 2);?> <?=$currency['meta_value']?></strong>
                        </h5>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-shopping-bag"></i> Number of Sales & Amount <a href="report.php" class="btn btn-link btn-sm float-right" style="text-transform:uppercase;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--            ------------------Regular expenses------------------>
            <div class="col-md-4" style="padding: 0 10px">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title pull-left" style="margin-top: 20px !important;">Regular Expenses</h5>
                        <button class="btn btn-dark btn-sm pull-right" style="text-transform:capitalize;" data-toggle="modal" data-target="#addExpense"><i class="fas fa-plus-circle"></i> Add</button>
                    </div>
                    <div class="card-body">
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic example">
                            <button type="button" id="exp_today" class="btn btn-secondary btn-sm filter-active" style="text-transform:capitalize;">Today</button>
                            <button type="button" id="exp_lastWeek" class="btn btn-secondary btn-sm" style="text-transform:capitalize;">Last Week</button>
                            <button type="button" id="exp_lastMonth" class="btn btn-secondary btn-sm" style="text-transform:capitalize;">Last Month</button>
                            <button type="button" id="exp_total" class="btn btn-secondary btn-sm" style="text-transform:capitalize;">Total</button>
                        </div>
                        <div class="text-center" id="exp_filter_result">
                            <?php
                            $todayExpense = array();
                            $todaysExpAmnt = mi_db_tbl_val_between('regular_expenses', 'expense_date', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'));
                            foreach ($todaysExpAmnt as $tvl){
                                $todayExpense[] = $tvl['amount'];
                            }
                            $todayExpenseAmount = array_sum($todayExpense);
                            ?>
                            <span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 169px;">
                          <strong><?=number_format($todayExpenseAmount);?></strong>
                      </span><span style="font-size: 2rem;"><?=$currency['meta_value']?></span>

                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Regular expenses <a href="expense.php" class="btn btn-link btn-sm float-right" style="text-transform:uppercase;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--            ------------------Investment------------------>
            <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                <div class="col-md-4" style="padding: 0 10px">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title pull-left" style="margin-top: 20px !important;">Investment Expenses</h5>
                            <button class="btn btn-dark btn-sm pull-right" style="text-transform:capitalize;" data-toggle="modal" data-target="#addInvestExpense"><i class="fas fa-plus-circle"></i> Add</button>

                        </div>
                        <div class="card-body">
                            <div class="text-center" id="exp_filter_result">
                                <?php
                                $investExpense = array();
                                $investExpAmnt = mi_db_read_all('investments');
                                foreach ($investExpAmnt as $tvl){
                                    $investExpense[] = $tvl['amount'];
                                }
                                $investExpenseAmount = array_sum($investExpense);
                                ?>
                                <span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 214px;">
                          <strong><?=number_format($investExpenseAmount);?></strong>
                      </span><span style="font-size: 2rem;"><?=$currency['meta_value']?></span>

                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-history"></i> Investment expenses <a href="investment.php" class="btn btn-link btn-sm float-right" style="text-transform:uppercase;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>

        </div>

        <!--        --------------------------chart------------------------------->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Statistics</h5>
                    </div>
                    <?php
                    $var = mi_db_read_all('mi_orders');
                    $arra = [];
                    $data = [];
                    foreach ($var as $k => $dr){
                        if ($dr['refund_date'] == '0000-00-00 00:00:00'){
                            $data[] = explode(', ', $dr['order_products_details']);
                        }
                    }

                    $noya = array();
                    foreach ($data as $item){
                        foreach ($item as $ditem){
                            $id = json_decode($ditem, true)['pro_id'];
                            $price = mi_db_read_by_id('mi_products', array('pro_id'=>$id))[0]['pro_price'];
                            $qty = json_decode($ditem, true)['pro_qty'];
                            $mprice = $price * $qty;
                            $arra[] = array($id=>$qty);
                        }
                    }

                    foreach ($arra as $klm => $vlm){
                        error_reporting(0);
                        foreach ($vlm as $llk => $vvl){
                            $noya[$llk] += $vvl;
                        }
                    }
                    $dataPoints = [];

                    ksort($noya);

                    $rounder = 0;

                    $repOrQty = [];
                    $repOrTotal = [];
                    foreach ($noya as $prokey => $proval){
                        $prodat = mi_db_read_by_id('mi_products', array('pro_id'=>$prokey))[0];
                        $ttlPrcPro = ($prodat['pro_price'] * $proval);
                        $dataPoints[] = array("y" => $proval, "label" => $prodat['pro_title'], "indexLabel" => $currency['meta_value']." ".number_format($ttlPrcPro));
                        $repOrQty[] = $proval;
                        $repOrTotal[] = number_format($ttlPrcPro);

                        $rounder++;
                    }

                    ?>
                    <div class="card-body mi_canvas_hide_in_print">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------add expense modal----------------------->
        <div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addExpenseForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="addExpenseForm" value="1">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="title">Expense Title</label>
                                    <select name="title" class="selectpicker form-control show-tick" data-live-search="true" title="Choose Expense Type">
                                        <?php
                                        $typeGet = mi_db_read_all('expense_type');
                                        foreach ($typeGet as $typ){?>
                                            <option value="<?=$typ['id'];?>"><?=$typ['type'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="amount">Expense Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Expense Amount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exp_date">Expense Date</label>
                                    <div class="input-group">
                                        <input type="text" name="exp_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose Expense Date" autocomplete="off">
                                        <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                  <i class="nc-icon nc-calendar-60"></i>
                                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addExpenseSubmit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--------------------add investment expense modal----------------------->
        <div class="modal fade" id="addInvestExpense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Investment Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addInvExpenseForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="addInvExpenseForm" value="1">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="title">Expense Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Expense Title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="amount">Expense Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Expense Amount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exp_date">Expense Date</label>
                                    <div class="input-group">
                                        <input type="text" name="exp_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose Expense Date" autocomplete="off">
                                        <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                  <i class="nc-icon nc-calendar-60"></i>
                                              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addInvExpenseSubmit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



<?=mi_footer();?>

        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light",
                    title:{
                        text: "Top 15 sold products",
                    },
                    axisY: {
                        title: "Sold Quantity",
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0",
                        indexLabel: "{y}",
                        indexLabelPlacement: "inside",
                        indexLabelFontWeight: "bolder",
                        indexLabelFontColor: "white",
                        labelAutoFit: true,
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>
