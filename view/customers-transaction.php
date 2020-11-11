<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2" && !isset($_GET['c'])){
    mi_redirect(MI_BASE_URL.'logout.php');
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
?>

<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">All of The Sales History</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable">
                            <thead class="text-primary text-center">
                            <?php if (
                            base64_decode($_SESSION['session_type']) == "mi_1" ||
                            base64_decode($_SESSION['session_type']) == "mi_2"){?>
                            <tr>
                                <th colspan="9"></th>
                            </tr>
                            <?php }?>
                            <tr>
                                <th>SL.</th>
                                <th>Order ID</th>
                                <th>Product Details</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                                <th>Total Due</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                            $round = 1;
                            $data = mi_db_read_by_id('mi_orders', array('customer_id'=> mi_secure_input($_GET['c'])), false, 'order_id', 'DESC');

                            $total_tr = [];
                            $total_due = [];
                            foreach ($data as $d){
                                $total_tr[] = $d['total_amount'];
                                $total_due[] = ($d['total_amount'] - $d['paid_amount']);
                                    $vvl = explode(', ', $d['order_products_details']);
                                    $item_qty = [];

                                    foreach ($vvl as $k => $v){
                                        $get_pro_id = json_decode($v)->{'pro_id'};
                                        $item_qty[] = json_decode($v)->{'pro_qty'};
                                    }
                                ?>
                                <tr>
                                    <td><?=$round;?></td>
                                    <td>
                                        <strong><?=$d['trx_id'];?></strong>
                                    </td>
                                    <td>
                                        Total Items: <?=count($vvl);?><br>
                                        Total Qty: <?=array_sum($item_qty);?>
                                    </td>
                                    <td><?=number_format($d['total_amount'], 2);?> <?=$currency['meta_value']?></td>
                                    <td>
                                        <?=date('d M Y', strtotime($d['order_created']));?>
                                        <br>
                                        <?=date('h:i:s A', strtotime($d['order_created']));?>
                                    </td>
                                    <td class="text-center">
                                        <span><?=number_format($d['total_amount'] - $d['paid_amount'], 2); ?> TK</span>
                                    </td>

                                </tr>
                                <!-----------------------------------single product refund modal----------------------------------->
                            <?php $round++;}?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total Amount - <?= number_format(array_sum($total_tr),2);?> Tk</th>
                                    <th colspan="2" class="text-right">Total Due - <?= number_format(array_sum($total_due),2);?> Tk</th>
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>




  

    <!-- Button trigger modal -->
   

    <!-- Modal -->

    <?=mi_footer();?>
