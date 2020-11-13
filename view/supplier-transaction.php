<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2" && !isset($_GET['st'])){
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
                        <h5 class="card-title">Supplier Transactions</h5>
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
                                <th>Invoice ID</th>
                                <th class="text-left">Product</th>
                                <th>Stock Quantity</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Total Due</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                            $round = 1;
                            $data = mi_db_read_by_id('mi_stocks', array('supplier_id'=> mi_secure_input($_GET['st'])), false, 'stock_id', 'DESC');

                            $total_amount = [];
                            $total_due = [];
                            foreach ($data as $d){
                                $product = mi_db_read_by_id('mi_products', array('pro_id' => $d['product_id']))[0];

                                $total_amount[] = $d['expanse'];
                                $total_due[] = ($d['expanse'] - $d['ex_paid']);
                                ?>
                                <tr>
                                    <td><?=$round;?></td>
                                    <td>
                                        <strong><?=$d['invoice_id'];?></strong>
                                    </td>
                                    <td class="text-left">
                                        <a href="product_report.php?mi_pro_id=<?=$product['pro_id'];?>"><?=$product['pro_title'];?></a>
                                    </td>
                                    <td><?=$d['stock_qty']?> L</td>
                                    <td>
                                        <?=date('d M Y', strtotime($d['upload_date']));?>
                                        <br>
                                        <?=date('h:i:s A', strtotime($d['upload_date']));?>
                                    </td>
                                    <td class="text-center">
                                        <span><?=number_format($d['expanse'], 2); ?> <?=$currency['meta_value']?></span>
                                    </td>
                                    <td class="text-center">
                                        <span><?=number_format($d['expanse'] - $d['ex_paid'], 2); ?> <?=$currency['meta_value']?></span>
                                    </td>

                                </tr>
                                <!-----------------------------------single product refund modal----------------------------------->
                            <?php $round++;}?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-right">Total Amount - <?= number_format(array_sum($total_amount),2);?> <?=$currency['meta_value']?></th>
                                    <th colspan="1" class="text-right">Total Due - <?= number_format(array_sum($total_due),2);?> <?=$currency['meta_value']?></th>
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
