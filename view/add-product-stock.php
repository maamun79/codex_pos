
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Stock</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="add-product-stock.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Choose Supplier*</label>
                                    <select name="stock_sup" class="selectpicker form-control" data-live-search="true" title="Choose one of the following...">
                                        <?php foreach ($suppliers as $sup){?>
                                            <option value="<?=$sup['sup_id']?>" data-subtext="<?=$sup['sup_company']?>"><?=$sup['sup_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Choose Product*</label>
                                    <select name="stock_pro" class="selectpicker form-control show-tick" data-live-search="true" title="Choose one of the following...">
                                        <?php foreach ($products as $pro){?>
                                            <option value="<?=$pro['pro_id']?>" data-subtext="৳<?=$pro['pro_price']?> (<?=$pro['pro_stock']?>)"><?=$pro['pro_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Product Stock Quantity (L)*</label>
                                    <input type="number" name="stock_qty" id="miStockQtyUp" class="form-control" value="1" min="1">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Product Buying Price*</label>
                                    <input type="number" name="stock_unit_price" class="form-control" id="miStockUnitPrice" value="1" min="1">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Total Expense Amount*</label>
                                    <input type="number" name="stock_amount" id="miTotalStockAddExpenses" class="form-control" value="1" min="1" readonly>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label>Paid Amount*</label>
                                    <input type="number" name="stock_paid" id="stockPaidAmount" value="1" class="form-control" >
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Total Due</label>
                                    <input type="number" name="stock_due" id="miTotalStockDue" class="form-control" value="0" min="0" readonly>
                                </div>
                                <div class="col-md-6 form-group">
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
                                <div class="col-md-6 form-group">
                                    <label>Upload Invoice Image</label>
                                    <input type="file" name="stock_in_img" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
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
        </div>
    </div>

<?=mi_footer();?>