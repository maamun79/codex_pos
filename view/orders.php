
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
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">All of The Sales History</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width text-center" id="mi_orders_datatable">
                            <thead class="text-primary text-center">
                            <?php if (
                                base64_decode($_SESSION['session_type']) == "mi_1" ||
                                base64_decode($_SESSION['session_type']) == "mi_2"){?>
                                <tr>
                                    <th colspan="2" style="max-width: 50px;">
                                        <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="orders"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                                    </th>
                                    <th colspan="6" class="text-right" style="padding-right: 0">
                                        <div class="row justify-content-end" style="padding-right: 10px">
                                            <div class="col-md-4 col-sm-6 text-right">
                                                <div class="input-group">
                                                    <input type="text" name="order_start_date" id="order_start_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose from date" autocomplete="off">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 text-right">
                                                <div class="input-group">
                                                    <input type="text" name="order_end_date" id="order_end_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose to date" autocomplete="off">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-dark" id="order_date_search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            <?php }?>
                            <tr>
                                <?php if (
                                    base64_decode($_SESSION['session_type']) == "mi_1" ||
                                    base64_decode($_SESSION['session_type']) == "mi_2"){?>
                                    <th style="max-width: 50px;" class="text-left">
<!--                                        <div class="checkbox pull-left">-->
<!--                                            <label style="font-size: 1.5em">-->
<!--                                                <input type="checkbox" value="" class="selectAll">-->
<!--                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>-->
<!--                                            </label>-->
<!--                                        </div>-->
                                        #
                                    </th>
                                <?php }else{?>
                                    <th class="table_font_small">SL.</th>
                                <?php }?>
                                <th class="table_font_small">Order ID</th>
                                <th class="table_font_small">Customer</th>
                                <th class="table_font_small">Details</th>
                                <th class="table_font_small">Total Amount</th>
                                <th class="table_font_small">Order Date</th>
                                <th class="table_font_small">Total Due</th>
                                <th class="table_font_small">Actions</th>
                            </tr>
                            </thead>
                        </table>

                        <!-----------------------------------single product refund modal----------------------------------->
                        <!-- Modal -->
                        <div class="modal fade modal-lg" id="singleRefundFormModal" style="max-width: 100%" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="width: 800px" role="document">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Single product refund</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post" class="singleRefundFormSubmitter">
                                        <div class="modal-body">
                                            <input type="hidden" name="order_id" value="">
                                            <div class="row">
                                                <div class="col-md-2 d-flex justify-content-center"><strong>#</strong></div>
                                                <div class="col-md-6"><strong>Title</strong></div>
                                                <div class="col-md-2 d-flex justify-content-center"><strong>Qty</strong></div>
                                                <div class="col-md-2 d-flex justify-content-center"><strong>Refund Qty</strong></div>
                                            </div>
                                            <hr>
                                            <div id="mi-get-refund-fields">

                                            </div>
                                        </div>
                                        <div class="">
                                            <input type="hidden" name="singleRefundSubmit" value="1">
                                            <button type="submit" class="btn btn-primary float-right">Refund</button>
                                            <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-----------------------------------single product refund modal----------------------------------->

                        <div class="modal fade" id="update_due" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <strong>Total Payable: <span id="totalpayable"></span> <?=$currency['meta_value']?></strong><br>
                                                    <strong>Total Paid   : <span id="totalpaid"></span> <?=$currency['meta_value']?></strong><br>
                                                    <strong>Total Due    : <span id="current_due"></span> <?=$currency['meta_value']?></strong><br><br>

                                                    <input type="hidden" id="keep_id" value="">
                                                    <input type="hidden" id="keep_amount" value="">
                                                    <input type="hidden" id="keep_paid" value="">

                                                    <label>Collection Amount:</label>
                                                    <input type="number" class="form-control" value="0" min="0" max="" id="due_amount" required="">
                                                    <button class="btn btn-sm btn-danger" id="add_due_update">Update</button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->

    <?=mi_footer();?>