<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_POST['add_stock'])){
    $suid = mi_secure_input($_POST['stock_sup']);
    $prid = mi_secure_input($_POST['stock_pro']);
    $stqty = mi_secure_input($_POST['stock_qty']);
    $stamn = mi_secure_input($_POST['stock_amount']);
    $stunit = mi_secure_input($_POST['stock_unit_price']);

    if (isset($_POST['stock_paid'])){
        $stpaid = mi_secure_input($_POST['stock_paid']);
    }else{
        $stpaid = 0;
    }
    if (isset($_POST['stock_invoice_id'])){
        $stinv = mi_secure_input($_POST['stock_invoice_id']);
        $_SESSION['last_used_invoice'] = $stinv;
    }else{
        $stinv = "N/A";
    }

    if (isset($_POST['stock_extra_note'])){
        $stext = mi_secure_input($_POST['stock_extra_note']);
    }else{
        $stext = "";
    }

    if (empty($suid) || empty($stqty) || empty($stamn) || empty($stunit)){
        mi_notifier("Supplier, Product, Product quantity, Total amount and Product Unit Price is required", "error");
    }
    elseif (!is_numeric($suid) || !is_numeric($stqty) || !is_numeric($stamn) || !is_numeric($stunit)){
        mi_notifier("Product quantity, Total amount and Product Unit Price only contains numbers", "error");
    }
    else{
        if (isset($_FILES['stock_in_img']['name']) && !empty($_FILES['stock_in_img']['name']) && $_FILES['stock_in_img']['name'] !== ""){
            $stimg = $_FILES['stock_in_img']['name'];
            $rename = md5(date("dmYHis")).$stimg;
            $allowed_image_extension = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG", "GIF", "gif");
            $file_extension = pathinfo($rename, PATHINFO_EXTENSION);
            $path = "Uploads/";
            if (!in_array($file_extension, $allowed_image_extension)){
                echo mi_notifier("Only images are allowed", "error");
                exit();
            }else{
                if (move_uploaded_file($_FILES['stock_in_img']['tmp_name'], $path.$rename)){
                    $stinvoice = $path.$rename;
                }else{
                    echo mi_notifier("Image Not Uploaded", "error");
                    exit();
                }
            }
        }else{
            $stinvoice = "";
        }

        $stData = array(
            'supplier_id' => $suid,
            'product_id' => $prid,
            'stock_qty' => $stqty,
            'invoice_id' => $stinv,
            'invoice_picture' => $stinvoice,
            'expanse' => $stamn,
            'unit_price' => $stunit,
            'ex_paid' => $stpaid,
            'ex_note' => $stext
        );

        $stockadd = mi_db_insert('mi_stocks', $stData);

        if ($stockadd == true){

            $selpro = mi_db_read_by_id('mi_products', array('pro_id' => $prid))[0];
            $inTotal = $selpro['pro_stock'] + $stqty;
            $inAllTotal = $selpro['pro_in_total_stock'] + $stqty;

            if (!empty($selpro['pro_serial'])){
                $updata = array(
                    'pro_stock' => $inTotal,
                    'pro_in_total_stock' => $inAllTotal,
                    'last_stock_load_qty' => $stqty,
                    'last_stock_updated' => date('Y-m-d H:i:s'),
                    'buy_price' => $stunit
                );
            }else{
                $updata = array(
                    'pro_stock' => $inTotal,
                    'pro_in_total_stock' => $inAllTotal,
                    'last_stock_load_qty' => $stqty,
                    'last_stock_updated' => date('Y-m-d H:i:s'),
                    'buy_price' => $stunit
                );
            }

            $upPr = mi_db_update('mi_products', $updata, array('pro_id'=>$prid));
            if ($upPr == true){
                echo mi_notifier("Stock added successfully", "success");
            }else{
                echo mi_notifier("Product stock not updated", "error");

            }

        }else{
            echo mi_notifier("Error to add stock", "error");
        }

    }

}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];


$suppliers = mi_db_read_all('mi_product_suppliers');
$products = mi_db_read_all('mi_products');

$stockInv = [];
$data = mi_db_read_all('mi_stocks', 'stock_id', 'DESC');
foreach ($data as $dd){
    if (!empty($dd['invoice_id'])){
        $stockInv[] = $dd['invoice_id'];
    }
}
?>

<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Stock</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="add-stock.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Supplier*</label>
                                    <select name="stock_sup" class="selectpicker form-control" data-live-search="true" title="Choose one of the following...">
                                        <?php foreach ($suppliers as $sup){?>
                                            <option value="<?=$sup['sup_id']?>" data-subtext="<?=$sup['sup_company']?>"><?=$sup['sup_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Product*</label>
                                    <select name="stock_pro" class="selectpicker form-control show-tick" data-live-search="true" title="Choose one of the following...">
                                        <?php foreach ($products as $pro){?>
                                            <option value="<?=$pro['pro_id']?>" data-subtext="৳<?=$pro['pro_price']?> (<?=$pro['pro_stock']?>)"><?=$pro['pro_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Product Stock Quantity (L)*</label>
                                    <input type="number" name="stock_qty" id="miStockQtyUp" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Product Buying Price*</label>
                                    <input type="number" name="stock_unit_price" class="form-control" id="miStockUnitPrice" value="1" min="1">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Total Expense Amount*</label>
                                    <input type="number" name="stock_amount" id="miTotalStockAddExpenses" class="form-control" value="1" min="1" readonly>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label>Paid Amount*</label>
                                    <input type="number" name="stock_paid" id="stockPaidAmount" value="1" class="form-control" >
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Total Due</label>
                                    <input type="number" name="stock_due" id="miTotalStockDue" class="form-control" value="0" min="0" readonly>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Invoice Id</label>
                                    <input type="text" name="stock_invoice_id" list="stockInvoiceData" class="form-control" autocomplete="off">

                                    <datalist id="stockInvoiceData">
                                        <?php
                                        foreach (array_unique($stockInv) as $dlist) {
                                            echo "<option value='".$dlist."'>".$dlist."</option>";
                                        }
                                        ?>
                                    </datalist>

                                    <?php if (isset($_SESSION['last_used_invoice']) && !empty($_SESSION['last_used_invoice'])){?>
                                        <div>
                                            Last Used Invoice: <button class="btn btn-sm btn-default" id="last_inv_id" miinv="<?=$_SESSION['last_used_invoice'];?>">#<?=$_SESSION['last_used_invoice'];?></button>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Upload Invoice Image</label>
                                    <input type="file" name="stock_in_img" class="form-control">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Extra Note</label>
                                    <textarea name="stock_extra_note" class="form-control" placeholder="Add extra note if need!"></textarea>
                                </div>
                                <div class="col-md-12 btn-block">
                                    <button type="submit" name="add_stock" class="btn btn-primary pull-right"><i class="nc-icon nc-simple-add"></i>&nbsp;Add Stock</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">All stocks update history</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable">
                            <thead class="text-primary text-center">
                            <tr>
                                <th style="max-width: 50px;">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="stockHistory"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                                </th>
                                <th colspan="8"></th>
                            </tr>
                            <tr>
                                <th style="max-width: 50px;" class="table_font_small">
                                    <!--  <div class="checkbox pull-left">
                                         <label style="font-size: 1.5em">
                                             <input type="checkbox" value="" class="selectAll">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                         </label>
                                     </div> -->
                                    #
                                </th>
                                <th class="table_font_small text-left">Product</th>
                                <th class="table_font_small">Supplier</th>
                                <!--                        <th>Attach.</th>-->
                                <th class="table_font_small">Qty (L)</th>
                                <th class="table_font_small">Total</th>
                                <th class="table_font_small">Due</th>
                                <th class="table_font_small">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                            $total_expenses = [];
                            $total_due = [];
                            foreach ($data as $k => $d){
                                $total_expenses[] = $d['expanse'];
                                $total_due[] = $d['expanse'] - $d['ex_paid'];
                                ?>
                                <tr>
                                    <td style="padding-left: 18px !important;max-width: 50px;">
                                        <div class="checkbox">
                                            <label style="font-size: 1.5em">
                                                <input type="checkbox" value="<?=$d['stock_id'];?>" class="selectorcheck">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <a href="single_product.php?mi_pro_id=<?=$d['product_id'];?>">
                                            <?=mi_db_read_by_id('mi_products', array('pro_id'=>$d['product_id']))[0]['pro_title'];?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=mi_db_read_by_id('mi_product_suppliers', array('sup_id'=>$d['supplier_id']))[0]['sup_name'];?>
                                    </td>

                                    <td>
                                        <?=$d['stock_qty'];?> L
                                    </td>

                                    <td>
                                        <?=number_format($d['expanse'], 2);?> <?=$currency['meta_value']?><br>
                                        <?php if ($d['refund_date'] !== '0000-00-00 00:00:00'){?>
                                            <span class="badge badge-dark" style="font-size: 12px;">Returned</span><br>
                                            <sub>
                                                <?=$d['refund_date'];?>
                                            </sub>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (($d['expanse'] - $d['ex_paid']) > 0){?>
                                            <span><?=number_format($d['expanse'] - $d['ex_paid'], 2); ?> <?=$currency['meta_value']?></span>
                                        <?php }else{echo "Paid";}?>
                                        <?php
                                        if (($d['expanse'] - $d['ex_paid'])>0) {?>
                                            <br><button
                                                    class="showStockduetk btn btn-sm btn-info"
                                                    type="button" data-toggle="modal" data-placement="top" title="Due collection" data-target="#update_stock_due" amount_stock_due="<?=$d['expanse'] - $d['ex_paid'] ?>" stock_id="<?=$d['stock_id'] ?>" stock_payable="<?= $d['expanse']; ?>"><i class="fa fa-edit"></i>
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" style="border: 1px solid #d4cece;">
                                                <a    href="view-stock.php?view=<?=$d['stock_id'];?>"
                                                      class="dropdown-item">
                                                    View
                                                </a>

                                                <?php if ($d['refund_date'] == "0000-00-00 00:00:00"){?>
                                                    <form class="pull-left stockRefundForm" style="width: 100%">
                                                        <input type="hidden" name="stock_ref_id" value="<?=$d['stock_id'];?>">
                                                        <button
                                                                class="dropdown-item"
                                                                name="submitStockRefund">
                                                            Return
                                                        </button>
                                                    </form>

                                                    <button
                                                            class="dropdown-item singleStockRefundForm"
                                                            type="button"
                                                            value="<?=$d['stock_id'];?>"
                                                            >
                                                        Single Refund
                                                    </button>
                                                <?php }?>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total Expense - <?= number_format(array_sum($total_expenses),2);?> Tk</th>
                                    <th colspan="3" class="text-right">Total Due - <?= number_format(array_sum($total_due),2);?> Tk</th>
                                </tr>
                            </tfoot>
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

