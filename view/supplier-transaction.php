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
                        <table class="table table-full-width" id="supplier_transaction_datatable">
                            <input type="hidden" id="trans_sup_id" value="<?=mi_secure_input($_GET['st']);?>">
                            <thead class="text-primary text-center">
                            <?php if (
                            base64_decode($_SESSION['session_type']) == "mi_1" ||
                            base64_decode($_SESSION['session_type']) == "mi_2"){?>
                            <tr>
                                <th colspan="9" style="padding-right: 0">
                                    <div class="row justify-content-end" style="padding-right: 10px">
                                        <div class="col-md-3 col-sm-6 text-right">
                                            <div class="input-group">
                                                <input type="text" name="sup_start_date" id="sup_start_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose from date" autocomplete="off">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 text-right">
                                            <div class="input-group">
                                                <input type="text" name="sup_end_date" id="sup_end_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose to date" autocomplete="off">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding-right: 0">
                                            <button class="btn btn-dark" id="sup_trans_date_search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <?php }?>
                            <tr>
                                <th>SL.</th>
                                <th class="text-left">Product</th>
                                <th>Stock Quantity</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Total Due</th>
                            </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>

        <!--          ------------------------------------due collection modal-------------------------------------->
        <div class="modal fade" id="update_stock_due" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Due Collection</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form class="form-horizontal" id="mi_add_due" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <strong>Total Payable: <span id="totalStockpayable"></span> <?=$currency['meta_value']?></strong><br>
                                    <strong>Total Paid   : <span id="totalStockpaid"></span> <?=$currency['meta_value']?></strong><br>
                                    <strong>Total Due    : <span id="stock_current_due"></span> <?=$currency['meta_value']?></strong><br><br>

                                    <input type="hidden" id="keep_stock_id" value="">
                                    <input type="hidden" id="keep_stock_amount" value="">
                                    <input type="hidden" id="keep_stock_paid" value="">

                                    <label>Collection Amount:</label>
                                    <input type="number" class="form-control" value="0" min="0" max="" id="due_stock_amount" required="">
                                    <button class="btn btn-sm btn-danger" id="add_stock_due_update">Update</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
</div>




  

    <!-- Button trigger modal -->
   

    <!-- Modal -->

    <?=mi_footer();?>
