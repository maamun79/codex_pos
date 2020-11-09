<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['get_rep'])){

    if (empty($_GET['inv'])){
        echo mi_notifier('Invoice Number is required', 'error');
    }else{
        $repInv = $_GET['inv'];
    }

}

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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Generate Invoice Report</h5>
                            </div>

                            <div class="col-md-12">
                                <form action="invoice-report.php" method="get" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="input-group">
                                                <input type="text" list="stockInvoiceData" name="inv" class="form-control" placeholder="Enter Invoice Number" autocomplete="off">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                      <i class="nc-icon nc-paper"></i>
                                                  </span>
                                                </div>

                                                <datalist id="stockInvoiceData">
                                                    <?php
                                                    foreach (array_unique($stockInv) as $dlist) {
                                                        echo "<option value='".$dlist."'>".$dlist."</option>";
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <button class="btn btn-spinner" type="submit" name="get_rep" value="1" style="margin-top: 0;">Generate</button>
                                            <button class="btn btn-default" type="button" id="miReportPrintBtn2" style="margin-top: 0;"><i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>





                    <?php if (isset($repInv) && !empty($repInv)){
                        $miProD = mi_db_read_by_id('mi_stocks', array('invoice_id'=>$repInv));
                        $getImg = [];
                        foreach ($miProD as $im){
                            if (!empty($im['invoice_picture'])){
                                $getImg[] = $im['invoice_picture'];
                            }
                        }
                        ?>

                        <div class="card-body" id="miReportPrint2">
                            <div class="container-fluid">
                                <h3>Statistics by Stock Invoice Number</h3>

                                <div class="row">
                                    <div class="col-md-12 col-sm-8">
                                        <h5>
                                            <strong>Invoice No:</strong> #<?=(!empty($repInv))?$repInv:'N/A';?>
                                            <?php if (!empty($getImg[0])){?>
                                                <a class="btn btn-primary btn-sm" href="<?=$getImg[0];?>" download="<?=$getImg[0];?>">
                                                    <i class="nc-icon nc-cloud-download-93"></i>
                                                </a>
                                            <?php }?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered text-dark">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Supplier</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $ii = 1;
                                            foreach ($miProD as $pros){
                                                $get_pro = mi_db_read_by_id('mi_products', array('pro_id'=>$pros['product_id']))[0];
                                                $get_sup = mi_db_read_by_id('mi_product_suppliers', array('sup_id'=>$pros['supplier_id']))[0];
                                                ?>
                                                <tr>
                                                    <td><?=$ii;?></td>
                                                    <td>
                                                        <img
                                                                src="Uploads/<?=$get_pro['pro_img'];?>"
                                                                class="img-thumbnail img-fluid pull-left"
                                                                style="width: 70px; margin-right: 10px;"
                                                        >
                                                        <strong><?=$get_pro['pro_title'];?></strong><br>
                                                        <strong>Sell: </strong><?=$get_pro['pro_price'];?> Tk
                                                        <br>
                                                        <strong>Buy: </strong><?=$pros['unit_price'];?> Tk
                                                        <br>
                                                        <strong>Stock: </strong><?=$get_pro['pro_stock'];?> Pcs
                                                        <br>
                                                    </td>
                                                    <td>
                                                        <img
                                                                src="Uploads/<?=$get_sup['sup_img'];?>"
                                                                class="img-thumbnail img-fluid pull-left"
                                                                style="width: 70px; margin-right: 10px;"
                                                        >
                                                        <strong><?=$get_sup['sup_name'];?></strong><br>
                                                        <strong>Company: </strong><?=$get_sup['sup_company'];?>
                                                        <br>
                                                        <strong>Email: </strong><?=$get_sup['sup_email'];?>
                                                        <br>
                                                        <strong>Phone: </strong><?=$get_sup['sup_phone'];?>
                                                        <br>
                                                    </td>
                                                    <td style="max-width: 150px;">
                                                        <strong>Note: </strong><?=(!empty($pros['ex_note']))?$pros['ex_note']:'N/A';?>
                                                        <br>
                                                        <strong>Total Expense: </strong><?=$pros['expanse'];?> Tk
                                                        <br>
                                                        <strong>Uploaded: </strong><?=$pros['upload_date'];?>
                                                        <br>
                                                    </td>
                                                    <td>
                                                        <?=($pros['refund_date'] != '0000-00-00 00:00:00')?"Refunded<br>".$pros['refund_date']:'Active';?>
                                                    </td>
                                                </tr>
                                                <?php $ii++;}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }?>






                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?=mi_footer();?>