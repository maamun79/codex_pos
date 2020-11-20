<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2" &&
    base64_decode($_SESSION['session_type']) !== "mi_3"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

?>
<?php

if (isset($_GET['mi_order_view'])){
    $orid = mi_secure_input($_GET['mi_order_view']);
    $data = mi_db_read_by_id('mi_orders', array('order_id' => $orid))[0];

    $counter = array();
    $ttl_array = explode(', ', $data['order_products_details']);
    foreach ($ttl_array as $itms){
        $counter[] = json_decode($itms, true);
    }
}else{
    mi_redirect('orders.php');
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
$logo = mi_db_read_by_id('settings_meta', array('type'=>'image'))[0];
$address = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_address'))[0];
$email = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_email'))[0];
$phone = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_phone'))[0];
$note = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_note'))[0];

?>
<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">Order Others Details</h5>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-primary btn-sm float-right billing-modal" id="billing-modal" href="#animatedModal">View Invoice&nbsp;<i class="nc-icon nc-paper"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table no-border">
                            <tr>
                                <th><h4 style="margin-top: 0; margin-bottom: 0">Order Id</h4></th>
                                <td>
                                    <h4 class="text-right" style="margin-top: 0; margin-bottom: 0"><?=$data['trx_id'];?></h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Order completed by</th>
                                <td>
                                    <?php
                                    $uuid = mi_db_read_by_id('mi_users', array('id'=>$data['user_id']))[0];
                                    echo '<strong>'.$uuid['user_name'].'</strong> &nbsp; ('.$uuid['user_designation'].')';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Ordered Total Item</th>
                                <td><?=count($counter);?></td>
                            </tr>
                            <tr>
                                <th>Ordered Time</th>
                                <td><?=date('d M Y', strtotime($data['order_created']))." | ".date('h:i:s A', strtotime($data['order_created']));?></td>
                            </tr>

                            <?php
                                $vats = [];
                                $sub_total = [];
                                foreach ($counter as $count){
                                    $price = $count['pro_price'] * $count['pro_qty'];
                                    $discount_amount = ($count['discount']/100)*$price;
                                    $total = $price - $discount_amount;
                                    $sub_total[] = $total;

                                    $vats[] = ($count['vat']/100) * $total;

                                }
                            ?>

                            <tr>
                                <th>Total VAT Amount</th>
                                <td><?=array_sum($vats);?> <?=$currency['meta_value']?></td>
                            </tr>
                            <tr>
                                <th>Order Sub-Total</th>
                                <td><?=(array_sum($sub_total))?> <?=$currency['meta_value']?></td>
                            </tr>
                            <tr>
                                <th>Order Total</th>
                                <td><?=$data['total_amount']?> <?=$currency['meta_value']?></td>
                            </tr>
                            <tr>
                                <th>Total Paid</th>
                                <td><?=$data['paid_amount']?> <?=$currency['meta_value']?></td>
                            </tr>
                            <tr>
                                <th>Order Due</th>
                                <td><?=($data['total_amount'] - $data['paid_amount']);?> <?=$currency['meta_value']?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Ordered Product Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table no-border table-striped table_font_small text-center pro_details_table">
                            <thead>
                            <tr>
                                <th class="table_head_font_small">#</th>
                                <th class="table_head_font_small">Image</th>
                                <th class="table_head_font_small text-left">Title</th>
                                <th class="table_head_font_small">Qty (L)</th>
                                <th class="table_head_font_small">Unit Price</th>
                                <th class="table_head_font_small">Discount Amount</th>
                                <th class="table_head_font_small">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($counter as $key => $count){
                                $get_pro = mi_db_read_by_id('mi_products', array('pro_id' => $count['pro_id']))[0];

                                $price = $count['pro_price'] * $count['pro_qty'];
                                $discount_amount = ($count['discount']/100)*$price;
                                $total = $price - $discount_amount;
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><img src="Uploads/<?=$get_pro['pro_img'];?>" class="img-thumbnail img-fluid" style="width: 60px; height: 70px"></td>
                                    <td class="text-left">
                                        <?=$get_pro['pro_title'];?>
                                    </td>
                                    <td><?=$count['pro_qty'];?> L</td>
                                    <td><?=$get_pro['pro_price'];?> <?=$currency['meta_value']?></td>
                                    <td><?=$discount_amount;?> <?=$currency['meta_value']?></td>
                                    <td><?=$total;?> <?=$currency['meta_value']?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="animatedModal" role="dialog" style="z-index: 999999; padding-left: 0px !important; ">
        <button type="button" class="close mi_close close-animatedModal">&times;</button>
        <div class="modal-content border-0" style="top: 5%;background: none">
            <div id="invoice-POS" style="width:794px; height:1122px;
                                        background-image: url('<?=MI_CDN_URL?>uploads/settings-img/invoice_logo.png');
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        z-index:99;
                                        background-color: white;">
                <div class="paid_or_due_seal">
                    <?php
                        if (($data['total_amount'] - $data['paid_amount']) > 0){
                    ?>
                            <h1 class="due-color-red">Due</h1>
                    <?php }else{ ?>
                            <h1 class="due-color-green">Paid</h1>
                    <?php } ?>
                </div>
                <div id="top" class="text-left">
                    <div class="logo">
                        <img src="<?=MI_CDN_URL.$logo['meta_value']?>" width="170px" alt="Soft Minion">
                    </div>
                </div>

                <div id="mid">
                    <div class="row">
                        <div class="info col-sm-6 col-md-6 col-6">
                            <h5>Bill From</h5>
                            <p>
                                Address : <?=$address['meta_value']?></br>
                                Email   : <?=$email['meta_value']?></br>
                                Phone   : <?=$phone['meta_value']?></br>
                            </p>
                            <p style="margin-bottom: 0">Created by: <strong><?php print_r(mi_db_read_by_id('mi_users', array('id'=>str_replace('mi_', '', base64_decode($_SESSION['session_id']))))[0]['user_id'])?></strong></p>
                        </div>
                        <div class="info mi_customer_information col-sm-6 col-md-6 col-6 text-right">
                            <?php
                                if (!empty($data['customer_id'])){
                                    $customer = mi_db_read_by_id('customers', array('id' => $data['customer_id']))[0];
                                }
                            ?>
                            <h5 class="">Bill To</h5>
                            <p>
                                <span><?=$customer['customer_name'];?></span><br>
                                <span><?=$customer['phone'];?></span><br>
                                <span><?=$customer['address'];?></span>
                            </p>
                            <p>Billing Date: <?=$data['order_created']?></p>
                        </div>
                    </div>
                </div>

                <div id="bot">

                    <div id="mi_billing_table">
                        <div class="info mi_invoice_id">
                            <h2 style="font-size: 15px !important;float: left; margin-bottom: 2px">Invoice ID: <?=$data['trx_id']?></h2>
                        </div>
                        <table class="table table-shopping table-borderless border" style="font-size: smaller">
                            <thead style="border-bottom: 1px solid #e3e3e3;">
                            <tr style="font-size: 10px">
                                <th class="text-left" style="width: 40px;">SL.</th>
                                <th class="text-left invoice_border">Item</th>
                                <th class="text-center invoice_border">Qty</th>
                                <th class="text-center invoice_border">Unit Price</th>
                                <th class="text-center invoice_border">Discount (%)</th>
                                <th class="text-center invoice_border">VAT (%)</th>
                                <th class="text-center invoice_border">VAT amount</th>
                                <th class="text-right invoice_border">Total</th>
                            </tr>
                            </thead>
                            <tbody style="border-bottom: 1px solid #e3e3e3; line-height: 0">
                                    <?php
                                    $rounder = 1;
                                    $total_invoice = [];
                                    $nvat = [];
                                    $vat_counter = [];
                                    foreach ($ttl_array as $prods){
                                        $product_details = json_decode($prods, true);
                                        $products = mi_db_read_by_id('mi_products', array('pro_id'=> $product_details['pro_id']))[0];

                                        $price_invoice = $product_details["pro_qty"] * $product_details["pro_price"];
                                        $discount_amount = ($product_details['discount']/100)*$price_invoice;
                                        $sub_total_amount = $price_invoice - $discount_amount;
                                        $total_invoice[] = $sub_total_amount;
                                        $qty_total[] = $product_details["pro_qty"];

                                        if (!in_array($product_details['vat_id'], $vat_counter)){
                                            $vat_counter[] = $product_details['vat_id'];
                                            $nvat[$product_details['vat_id']] = ($product_details['vat']/100)*$sub_total_amount;
                                        }else{
                                            $nvat[$product_details['vat_id']]+= ($product_details['vat']/100)*$sub_total_amount;
                                        }
                                    ?>
                                        <tr>
                                            <td><?=$rounder;?></td>
                                            <td class="text-left invoice_border">
                                                <?=$products['pro_title'];?>
                                            </td>
                                            <td class="text-center invoice_border">
                                                <?=$product_details['pro_qty'];?> L
                                            </td>
                                            <td class="text-center invoice_border">
                                                <?=$product_details['pro_price'];?> <?=$currency['meta_value'];?>
                                            </td>
                                            <td class="text-center invoice_border">
                                                <?=$product_details['discount']?> %
                                            </td>
                                            <td class="text-center invoice_border">
                                                <?=(!empty($product_details['vat'])?$product_details['vat']:'0')?> %
                                            </td>
                                            <td class="text-center invoice_border">
                                                <?=($product_details['vat']/100)*$price_invoice;?> <?=$currency['meta_value'];?>
                                            </td>
                                            <td class="text-right invoice_border"><?=$sub_total_amount?> <?=$currency['meta_value'];?></td>
                                        </tr>
                                <?php
                                        $rounder++;
                                    }
                                    $get_i = 23 - count($ttl_array);
                                    for ($i=1;$i<=$get_i;$i++){
                                        ?>
                                        <tr>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                            <td class="invoice_border"></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right" colspan="7" style="padding: 3px">Sub total</th>
                                    <th class="text-right" style="padding: 3px"><?=array_sum($total_invoice)?> <?=$currency['meta_value']?></th>
                                </tr>
                            <?php
                                $payable_vat_invoice = [];
                                foreach($nvat as $k => $vt){
                                $payable_vat[] = $vt;
                                $get_title = mi_db_read_by_id('mi_purchase_vat', array('vid'=>$k));
                                    if (count($get_title)>0){
                                ?>
                                    <tr>
                                        <th class="text-right" colspan="7" style="padding: 3px"><?=$get_title[0]['vtaxdetails'];?></th>
                                        <th class="text-right" style="padding: 3px"><?= $vt; ?> <?=$currency['meta_value'];?></th>
                                    </tr>
                            <?php
                                    }
                                }
                            ?>
                                <tr>
                                    <th class="text-right" colspan="7" style="padding: 3px">Due: </th>
                                    <th class="text-right" style="padding: 3px"><?= ($data['total_amount'] - $data['paid_amount'])?> <?= $currency['meta_value']; ?></th>
                                </tr>

                                <tr>
                                    <th class="text-left" colspan="2">Total Products: <?=count($ttl_array)?><br>Total Qty: <?=array_sum($qty_total)?> L</th>
                                    <th class="text-right" colspan="5" >
                                        <span style="font-size:15px">Total Amount:</span><br>
                                        Paid:
                                    </th>
                                    <th class="text-right">
                                        <span style='font-size:15px' class='totalpayable'><?=($data['total_amount'])?> <?=$currency['meta_value']?></span><br>
                                        <span><?=($data['paid_amount'])?> <?=$currency['meta_value'];?></span>
                                    </th>
                                </tr>

                            </tfoot>
                        </table>
                    </div><!--End Table-->

                    <div class="row">
                        <div id="legalcopy" class="col-sm-19 col-md-9">
                            <p id="sales_due_note">N.B. : <span></span></p>
                            <p class="legal"><small><?=$note['meta_value']?></small></p>
                        </div>
                        <div class="col-sm-3 col-md-3 text-right">
                            <p>Receiver Signature</p>
                            <p>-------------------------</p>
                        </div>

                    </div>

                </div>
            </div>
            <div class="button-container-mi">
                <button type="button" class="btn btn-primary" id="mi_print_pdf_recipt">Print PDF <i class="nc-icon nc-paper"></i></button>
                <button type="button" class="btn btn-default close-animatedModal" data-dismiss="modal">Done <i class="nc-icon nc-check-2"></i></button>
            </div>
        </div>
    </div>

    <?=mi_footer();?>