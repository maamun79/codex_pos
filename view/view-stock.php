<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}else{
    if (isset($_GET['view']) || !empty($_GET['view'])){
        $getstock = mi_db_read_by_id('mi_stocks', array('stock_id'=>$_GET['view']));

        if (count($getstock) > 0){
            $suppliers = mi_db_read_by_id('mi_product_suppliers', array('sup_id'=>$getstock[0]['supplier_id']));
            $products = mi_db_read_by_id('mi_products', array('pro_id'=>$getstock[0]['product_id']));
        }else{
            mi_redirect('add-stock.php');
        }
    }else{
        mi_redirect('add-stock.php');
    }
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];


?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12" style="padding-right: 6px">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="margin-bottom: 0">Stock Information</h5>
                        <ul class="nav navbar mi_supplier_nav">
                            <li class="nav-item">
                                <strong>Invoice#: </strong>
                                <span>
                                    <?=(!empty($getstock[0]['invoice_id']))?$getstock[0]['invoice_id']:'N/A';?>
                                    <?php if (!empty($getstock[0]['invoice_picture'])){?>
                                    <a class="btn btn-primary btn-sm m-0" href="<?=$getstock[0]['invoice_picture'];?>" download="<?=$getstock[0]['invoice_picture'];?>">
                                        Invoice <i class="nc-icon nc-cloud-download-93"></i>
                                    </a>
                                    <?php }?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <strong>Total Expenses:</strong> <span><?=$getstock[0]['expanse'];?> <?=$currency['meta_value']?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Product Unit Price:</strong> <span><?=$getstock[0]['unit_price'];?> <?=$currency['meta_value']?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Expense Due:</strong> <span><?=$getstock[0]['ex_due'];?> <?=$currency['meta_value']?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Stock Uploaded:</strong> <span><?=$getstock[0]['upload_date'];?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Stock Note:</strong> <span><?=$getstock[0]['ex_note'];?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Stock Refund:</strong> <span><?=($getstock[0]['refund_date'] == '0000-00-00 00:00:00')?'Not Refunded':$getstock[0]['refund_date'];?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Supplier Information</h5>
                        <hr>
                        <ul class="nav navbar mi_supplier_nav">
                            <li class="nav-item">
                                <strong>Name:</strong> <span><?=$suppliers[0]['sup_name'];?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Company:</strong> <span><?=$suppliers[0]['sup_company'];?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Email:</strong> <span><?=$suppliers[0]['sup_email'];?></span>
                            </li>
                            <li class="nav-item">
                                <strong>Phone:</strong> <span><?=$suppliers[0]['sup_phone'];?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
          <div class="col-md-6 col-sm-12 col-xs-12" style="padding-left: 6px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="margin-bottom: 0">Product Information</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body">
                  <ul class="nav navbar mi_supplier_nav">
                      <li class="nav-item">
                          <strong>Name:</strong> <span><?=$products[0]['pro_title'];?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Model No:</strong> <span><?=$products[0]['pro_model_number'];?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Buy Price:</strong> <span><?=$products[0]['buy_price'];?> <?=$currency['meta_value']?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Sell Price:</strong> <span><?=$products[0]['pro_price'];?> <?=$currency['meta_value']?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Current Stock:</strong> <span><?=$products[0]['pro_stock'];?> Pcs</span>
                      </li>
                      <li class="nav-item">
                          <strong>Total Stock:</strong> <span><?=$products[0]['pro_in_total_stock'];?> Pcs</span>
                      </li>
                      <li class="nav-item">
                          <strong>Last Uploaded Stock:</strong> <span><?=$products[0]['last_stock_updated'];?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Last Uploaded Stock Qty:</strong> <span><?=$products[0]['last_stock_load_qty'];?> Pcs</span>
                      </li>
                      <li class="nav-item">
                          <strong>Serials Added:</strong> <span><?=implode(' | ', json_decode($getstock[0]['pro_serials'], JSON_PRETTY_PRINT));?></span>
                      </li>
                      <li class="nav-item">
                          <strong>Available Serials:</strong> <span><?=(count(json_decode($products[0]['pro_serial'], JSON_PRETTY_PRINT)) > 0)?implode(' | ', json_decode($products[0]['pro_serial'], JSON_PRETTY_PRINT)):'N/A';?></span>
                      </li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>





<?=mi_footer();?>

<script>
    $('.refundForm').on('submit', function (e) {
        e.preventDefault();
        var inputValue = $("input[name='ref_id']",this).val();
        swal({
            title: "Are you sure?",
            text: "Once refunded, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: {deleteStock: inputValue},
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
                return false;
            }
        });
    });
</script>