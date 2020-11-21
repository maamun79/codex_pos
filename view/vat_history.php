<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

$all_orders = mi_db_read_by_id('mi_orders', array('refund_date'=> '0000-00-00 00:00:00'), '', 'order_id', 'DESC');

// foreach($all_orders as $order){
//     $products = explode(', ', $order['order_products_details']);
    
//     foreach($products as $prod){
//         $data = json_decode($prod, true);
//         foreach($data as $d){
//             print_r($d['vat']);
//         }
//     }
// }

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

?>

<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title pull-left">VAT History</h5>
                        <?php print_r($product);?>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable" id="vat_history_table">
                            <thead class="text-primary text-center">
                            <tr>
                                <th style="max-width: 50px; padding-top: 0">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="vat"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                                </th>
                                <th colspan="8"></th>
                            </tr>
                            <tr>
                                <th style="max-width: 50px;">
                                    <div class="checkbox pull-left">
                                        <label style="font-size: 1.5em">
                                            <input type="checkbox" value="" class="selectAll">
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </th>
                                <th class="table_font_small">Order ID</th>
                                <th class="table_font_small">VAT Amount</th>
                                <th class="table_font_small">Date</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                                    $total_paid_vat = 0;
                                    foreach($all_orders as $order){
                                    $vat_amount = [];
                                    $products = explode(', ', $order['order_products_details']);
                                    foreach($products as $data){
                                        $prod = json_decode($data, true);
                                        $vat = $prod['vat'];
                                        $vat_amount[] = ($vat/100) * ($prod['pro_price'] * $prod['pro_qty']);
                                    }

                                    $total_paid_vat += array_sum($vat_amount);
                                    if(array_sum($vat_amount) != 0){

                                ?>
                                    <tr>
                                        <td style="padding-left: 18px !important;max-width: 50px;">
                                            <div class="checkbox">
                                                <label style="font-size: 1.5em">
                                                    <input type="checkbox" value="<?=$d['vid'];?>" class="selectorcheck">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td><?=$order['trx_id']?></td>
                                        <td><?= array_sum($vat_amount);?> <?=$currency['meta_value'];?></td>
                                        <td><?=$order['order_created']?></td>
                                    </tr>
                            <?php } }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center"> Total Paid VAT - <?= $total_paid_vat?> <?=$currency['meta_value'];?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?=mi_footer();?>

