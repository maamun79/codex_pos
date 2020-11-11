
<?=mi_header();?>
<?php

if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['g']) && !empty($_GET['g'])){
    $pera = $_GET['g'];
    if ($pera == 'today'){
        $from = date('Y-m-d 00:00:01');
        $to = date('Y-m-d H:i:s');
    }elseif ($pera == 'last-week'){
        $from = date("Y-m-d 00:00:01", strtotime("-6 days"));
        $to = date('Y-m-d H:i:s');
    }elseif ($pera == 'last-month'){
        $from = date("Y-m-d 00:00:01", strtotime("-29 days"));
        $to = date('Y-m-d H:i:s');
    }elseif ($pera == 'last-six-month'){
        $from = date("Y-m-d 00:00:01", strtotime("-179 days"));
        $to = date('Y-m-d H:i:s');
    }elseif ($pera == 'last-year'){
        $from = date("Y-m-d 00:00:01", strtotime("-364 days"));
        $to = date('Y-m-d H:i:s');
    }

}elseif(isset($_GET['get_rep'])){

    if (empty($_GET['rep_from'])){
//        $from = "";
        echo mi_notifier('From date is required', 'error');
        mi_redirect('report.php');

    }else{
        $from = $_GET['rep_from']. ' 00:00:01';
    }

    if ($_GET['rep_to'] == ''){
        $to = date('Y-m-d 23:59:59');
    }else{
        $to = $_GET['rep_to']. ' 23:59:59';
    }

}else{
    $from = date('Y-m-d 00:00:01');
    $to = date('Y-m-d 23:59:59');
}


$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

?>
<?php
if (!empty(mi_get_session('alert'))  && count(mi_get_session('alert'))>0){
    echo mi_notifier('reporting', 'error');
    mi_unset('alert');
}
?>
<style>
    .dataTables_filter{
        width: 100%;
    }
    .dataTables_filter label{
        width: 100%;
        text-align: left;
    }
    .dataTables_filter label input{
        margin-left: 0px !important;
    }
</style>
<?=mi_sidebar();?>
<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <h5>Generate All Product Report</h5>
                        </div>

                        <div class="col-md-12">
                            <a href="report.php?g=today" class="btn btn-dark <?=($pera == 'today'?'filter-active':'')?> <?=(isset($pera) || isset($_GET['get_rep'])?'':'filter-active')?>">Today</a>
                            <a href="report.php?g=last-week" class="btn btn-dark <?=($pera == 'last-week'?'filter-active':'')?>">Last Week</a>
                            <a href="report.php?g=last-month" class="btn btn-dark <?=($pera == 'last-month'?'filter-active':'')?>">Last Month</a>
                            <a href="report.php?g=last-six-month" class="btn btn-dark <?=($pera == 'last-six-month'?'filter-active':'')?>">Last Six Month</a>
                            <a href="report.php?g=last-year" class="btn btn-dark <?=($pera == 'last-year'?'filter-active':'')?>">Last Year</a>
                            <a href="report.php?g=all-time" class="btn btn-dark <?=($pera == 'all-time'?'filter-active':'')?>">All Time</a>
                            <a class="btn btn-dark <?=($_GET['rep_from'] && !empty($_GET['rep_from'])?'filter-active':'')?>" role="button" data-toggle="collapse" href="#customReport" aria-expanded="false" aria-controls="customReport">
                                Custom Report
                            </a>
                        </div>
                    </div>

                    <div class="card-body" id="miReportPrint">
                        <div class="mi_roport_container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="collapse" id="customReport">
                                        <div class="well card card-stats">
                                            <div class="row" style="padding: 20px">
                                                <div class="col-md-12">
                                                    <h5>Generate Custom Report</h5>
                                                </div>

                                                <div class="col-md-12">
                                                    <form action="report.php" method="get" autocomplete="off">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="text" name="rep_from" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose from date" autocomplete="off">
                                                                    <div class="input-group-prepend">
                                                                      <span class="input-group-text">
                                                                          <i class="nc-icon nc-calendar-60"></i>
                                                                      </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="text" name="rep_to" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose to date" autocomplete="off">
                                                                    <div class="input-group-prepend">
                                                                      <span class="input-group-text">
                                                                          <i class="nc-icon nc-calendar-60"></i>
                                                                      </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6">
                                                                <button class="btn btn-spinner" type="submit" name="get_rep" style="margin-top: 0;">Generate</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-6">Total Product:</div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php if ($pera == 'all-time'){
                                                                    $get_all_time_prod = mi_db_read_all('mi_products');
                                                                    echo count($get_all_time_prod).' Items';
                                                                }else{
                                                                    echo mi_db_tbl_row_count_between('mi_products', array($from, $to), 'pro_added').' Items';
                                                                }

                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">Available Product: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php
                                                                if ($pera == 'all-time'){
                                                                    $all_time_avl_prods = mi_db_custom_query("SELECT * FROM mi_products WHERE pro_stock > 0 AND pro_status = 1");
                                                                    echo count($all_time_avl_prods);
                                                                }else{
                                                                    $avlProds = mi_db_custom_query("select * from mi_products where pro_stock > 0 and pro_status = 1 and pro_added between '". $from ."' and '". $to."'");
                                                                    echo count($avlProds);
                                                                }

                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">A-Z Stocks Qty: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php if ($pera == 'all-time'){
                                                                    $get_all_prods = mi_db_read_by_id('mi_products', array('pro_status' => 1));
                                                                    $prod_stocks = [];
                                                                    foreach ($get_all_prods as $prod){
                                                                        $prod_stocks[] = $prod['pro_in_total_stock'];
                                                                    }
//                                                                    print_r(array_sum($prod_stocks)); return;
                                                                    echo array_sum($prod_stocks).' L';
                                                                }else{
                                                                    echo mi_db_tbl_sum('mi_products', 'pro_in_total_stock', array('pro_status' => 1), array($from, $to), 'pro_added').'L';
                                                                }?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">Available Stocks Qty: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php if ($pera == 'all-time'){
                                                                    $get_all_prods = mi_db_read_by_id('mi_products', array('pro_status' => 1));
                                                                    $prod_stocks = [];
                                                                    foreach ($get_all_prods as $prod){
                                                                        $prod_stocks[] = $prod['pro_stock'];
                                                                    }
//
                                                                    echo array_sum($prod_stocks).' L';
                                                                }else{
                                                                    echo mi_db_tbl_sum('mi_products', 'pro_stock', array('pro_status'=> 1),  array($from, $to), 'pro_added').'L';
                                                                }?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer ">
                                                <hr>
                                                <div class="stats text-center">
                                                    Products Summery
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-6">Total Orders:</div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php
                                                                    if ($pera == 'all-time'){
                                                                        $get_orders = mi_db_read_all('mi_orders');
                                                                        echo count($get_orders);
                                                                    }else{
                                                                        echo mi_db_tbl_row_count_between('mi_orders', array($from, $to), 'order_created');
                                                                    }
                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">Sold Product Qty: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php
                                                                if ($pera == 'all-time'){
                                                                    $var = mi_db_read_all('mi_orders');
                                                                }else{
                                                                    $var = mi_db_tbl_val_between('mi_orders', 'order_created', $from, $to);
                                                                }
                                                                $arra = [];
                                                                $data = [];
                                                                foreach ($var as $k => $dr){
                                                                    if ($dr['refund_date'] == '0000-00-00 00:00:00'){
                                                                        $data[] = explode(', ', $dr['order_products_details']);
                                                                    }
                                                                }
                                                                foreach ($data as $item){
                                                                    foreach ($item as $ditem){
                                                                        $arra[] = json_decode($ditem, true)['pro_qty'];
                                                                    }
                                                                }
                                                                echo array_sum($arra);
                                                                ?>
                                                                Pcs
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">Completed Orders: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php
                                                                    if ($pera == 'all-time'){
                                                                        $get_complete_ord = mi_db_read_by_id('mi_orders', array('refund_date' => '0000-00-00 00:00:00'));
                                                                        echo count($get_complete_ord);
                                                                    }else{
                                                                        echo mi_db_tbl_row_count_between('mi_orders', array($from, $to), 'order_created', array('refund_date'=>'0000-00-00 00:00:00'));
                                                                    }
                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6">Refunded Orders: </div>
                                                        <div class="col-6">
                                                            <strong>
                                                                <?php
                                                                if ($pera == 'all-time'){
                                                                    $get_refund_ord = mi_db_read_by_id('mi_orders', array('refund_date' => '0000-00-00 00:00:00'), true);
                                                                    echo count($get_refund_ord);
                                                                }else{
                                                                    $refOrds = mi_db_custom_query("select * from mi_orders where refund_date != '0000-00-00 00:00:00' and order_created between '". $from ."' and '". $to."'");
                                                                    echo count($refOrds);
                                                                }
                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer ">
                                                <hr>
                                                <div class="stats text-center">
                                                    Order Summery
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Current Expenses:
                                                    </div>
                                                    <?php
                                                    if ($pera == 'all-time'){
                                                        $expenses = mi_db_read_all('regular_expenses');

                                                        $totalExp = [];
                                                        foreach ($expenses as $exp){
                                                            $totalExp[] = $exp['amount'];
                                                        }
                                                    }else{
                                                        $expenses = mi_db_tbl_val_between('regular_expenses', 'expense_date', $from, $to);
                                                        $totalExp = [];
                                                        foreach ($expenses as $exp){
                                                            $totalExp[] = $exp['amount'];
                                                        }
                                                    }
                                                    ?>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?=array_sum($totalExp);?> <?=$currency['meta_value']?>
                                                        </strong>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Current Investments:
                                                    </div>
                                                    <?php
                                                    if ($pera == 'all-time'){
                                                        $invsts = mi_db_read_all('investments');

                                                        $totalInv = [];
                                                        foreach ($invsts as $inv){
                                                            $totalInv[] = $inv['amount'];
                                                        }
                                                    }else{
                                                        $investments = mi_db_tbl_val_between('investments', 'expense_date', $from, $to);
                                                        $totalInv = [];
                                                        foreach ($investments as $inv){
                                                            $totalInv[] = $inv['amount'];
                                                        }
                                                    }
                                                    ?>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?=number_format(array_sum($totalInv));?> <?=$currency['meta_value']?>
                                                        </strong>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-footer ">
                                                <hr>
                                                <div class="stats text-center">
                                                    Expense Summery
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Current Sell Amount:
                                                    </div>
                                                    <br>
                                                    <?php
                                                    if ($pera == 'all-time'){
                                                        $get_ords = mi_db_read_by_id('mi_orders', array('refund_date'=> '0000-00-00 00:00:00'));
                                                        $sell_amounts = [];

                                                        foreach ($get_ords as $ord){
                                                            $sell_amounts[] = $ord['total_amount'];
                                                        }
                                                    }else{
                                                        $allProds = mi_db_tbl_val_between('mi_orders', 'order_created', $from, $to);
                                                        $sell_amounts = [];

                                                        foreach ($allProds as $sprod) {
                                                            if ($sprod['refund_date'] == '0000-00-00 00:00:00') {
                                                                $sell_amounts[] = $sprod['total_amount'];
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?=number_format(array_sum($sell_amounts));?> <?=$currency['meta_value']?>
                                                        </strong>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Product Buy Amount:
                                                    </div>
                                                    <?php
                                                    if ($pera == 'all-time'){
                                                        $all_stocks = mi_db_read_by_id('mi_stocks', array('refund_date'=> '0000-00-00 00:00:00'));
                                                        $ttlSupExp = [];
                                                        foreach ($all_stocks as $sprod) {
                                                            $ttlSupExp[] = $sprod['expanse'];
                                                        }
                                                    }else{
                                                        $allProd = mi_db_tbl_val_between('mi_stocks', 'upload_date', $from, $to, array('refund_date'=> '0000-00-00 00:00:00'));
                                                        $ttlSupExp = [];
                                                        foreach ($allProd as $sprod) {
                                                            $ttlSupExp[] = $sprod['expanse'];
                                                        }
                                                    }
                                                    ?>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?=number_format(array_sum($ttlSupExp));?> <?=$currency['meta_value']?>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer ">
                                                <hr>
                                                <div class="stats text-center">
                                                    Sell Summery
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        $revenue = (array_sum($sell_amounts))-(array_sum($ttlSupExp)+array_sum($totalExp)+array_sum($totalInv));
                                    ?>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="card card-stats text-white <?=($revenue < 0?'bg-danger':($revenue>0?'bg-success':'bg-warning'))?>">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Total Profit:
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h3 class="text-center mb-0">
                                                            <?=number_format($revenue)?>  <?=$currency['meta_value']?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <hr>
                                                <div class="stats text-center text-white">
                                                    Revenue Summery
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mi-page-break">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Statistics</h5>
                                            </div>
                                            <?php

                                            if ($pera == 'all-time'){
                                                $var = mi_db_read_all('mi_orders');
                                            }else{
                                                $var = mi_db_tbl_val_between('mi_orders', 'order_created', $from, $to);
                                            }

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

                                            $dataPointsProfit = [];
                                            $repStPrc = [];
                                            $repStTotal = [];
                                            $repStQty = [];

                                            foreach ($noya as $prokey => $proval){
                                                if ($rounder <= 4) {
                                                    $prodat = mi_db_read_by_id('mi_products', array('pro_id' => $prokey))[0];
                                                    $ttlPrcPro = ($prodat['pro_price'] * $proval);
                                                    $dataPoints[] = array("y" => $proval, "label" => $prodat['pro_title'], "indexLabel" => $currency['meta_value'] . " " . number_format($ttlPrcPro));
                                                    $repOrQty[] = $proval;
                                                    $repOrTotal[] = number_format($ttlPrcPro);


                                                    $ttlPrcProProfit = (($prodat['pro_price'] - $prodat['buy_price']) * $proval)/100;
                                                    $ttlPrcProlol = (($prodat['pro_price'] - $prodat['buy_price']) * $proval);
                                                    $ttlPrcPro1 = ($prodat['pro_price'] * $proval);

                                                    $repStPrc[] = $ttlPrcProProfit;
                                                    $repStTotal[] = $ttlPrcPro1;
                                                    $repStQty[] = $proval;

                                                    $dataPointsProfit[] = array("y" => $ttlPrcProProfit, "label" => $prodat['pro_title'], "indexLabel" => $ttlPrcProProfit.'% - '.$currency['meta_value'].' '.number_format($ttlPrcProlol));

                                                }
                                                $rounder++;
                                            }


                                            ?>

                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <div class="card-body mi_canvas_hide_in_print">
                                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <div id="chartProfitContainer" style="height: 370px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <div class="">
                    </div>
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
                    text: "Top 5 sold products",
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

            var chart1 = new CanvasJS.Chart("chartProfitContainer", {
                animationEnabled: true,
                theme: "light",
                title:{
                    text: "Top 5 profitable products",
                },
                axisY: {
                    title: "Profit amount",
                },
                data: [{
                    type: "column",

                    indexLabel: "{y}%",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    labelAutoFit: true,
                    dataPoints: <?php echo json_encode($dataPointsProfit, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

        }
    </script>