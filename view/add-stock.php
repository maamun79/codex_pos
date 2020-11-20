<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}


?>

<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title pull-left">All stocks update history</h5>
                        <a class="btn btn-primary pull-right"href="add-product-stock.php">Add Stock &nbsp;<i class="nc-icon nc-simple-add"></i></a>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width" id="stock_datatable">
                            <thead class="text-primary text-center">
                            <tr>
                                <th colspan="2" style="max-width: 50px;">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="stockHistory"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                                </th>
                                <th colspan="8" class="text-right" style="padding-right: 0">
                                    <div class="row justify-content-end" style="padding-right: 10px">
                                        <div class="col-md-5 col-sm-6 text-right">
                                            <div class="input-group">
                                                <input type="text" name="start_date" id="start_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose from date" autocomplete="off">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-6 text-right">
                                            <div class="input-group">
                                                <input type="text" name="end_date" id="end_date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Choose to date" autocomplete="off">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-dark" id="date_search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </th>
                                </tr>
                                <tr>
                                    <th style="max-width: 50px;" class="table_font_small text-left">
                                        #
                                    </th>
                                    <th class="table_font_small text-left">Product</th>
                                    <th class="table_font_small text-left">Supplier</th>
                                    <th class="table_font_small">Qty (L)</th>
                                    <th class="table_font_small">Date</th>
                                    <th class="table_font_small">Total</th>
                                    <th class="table_font_small">Due</th>
                                    <th class="table_font_small">Action</th>
                                </tr>
                            </thead>
                            <tfoot id="stock_tfoot"></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------------------------single stock refund modal----------------------------------->
        <!-- Modal -->
            <div class="modal fade modal-lg" id="singleStockRefund" style="max-width: 100%" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="width: 800px" role="document">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Single product refund</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                        $product = mi_db_read_by_id('mi_products', array('pro_id'=> $d['product_id']))[0];

                        ?>
                        <form action="" method="post" name="singleStockRefundFormSubmitter" class="singleStockRefundFormSubmitter">
                            <div class="modal-body">
                                <input type="hidden" name="stock_id" value="">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3"><strong>Title</strong></div>
                                    <div class="col-md-2 col-sm-3 d-flex justify-content-center"><strong>Qty</strong></div>
                                    <div class="col-md-2 col-sm-3 d-flex justify-content-center"><strong>Available Stock</strong></div>
                                    <div class="col-md-2 col-sm-3 d-flex justify-content-center"><strong>Refund Qty</strong></div>
                                </div>
                                <hr>
                                <div id="stock_refund_field">
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="singleStockRefundSubmit" value="1">
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary float-right">Refund</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        <!-----------------------------------single stock refund modal----------------------------------->

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
        <!--          ------------------------------------due collection modal-------------------------------------->
    </div>





    <?=mi_footer();?>

    <script>
        $('.refundForm').on('submit', function (e) {
            e.preventDefault();


            var inputValue = $("input[name='ref_id']",this).val();


            swal({

                html:true,
                title: "How you want refund?",
                text: "Once refunded, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Enter quantity",
                        type: "number",
                    },
                },

            })
                .then((willDelete) => {

                if (willDelete > 0) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: {deleteStock: inputValue, quantity:willDelete},
                    success: function (data) {
                        console.log(data);
                        var response = JSON.parse(data);
                        if (response.status == "success"){
                            swal(response.message, {
                                icon: "success"
                            }).then(() => {
                                window.location.href = 'add-stock.php';
                        });
                        }else{
                            swal(response.message, {
                                icon: "error"
                            });
                        }

                    }
                });

            }else{
                swal("Invalid Quantity", {
                    icon: "error"
                });
            }
        });
        });
    </script>

