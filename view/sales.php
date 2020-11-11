<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2" &&
    base64_decode($_SESSION['session_type']) !== "mi_3"){

    mi_redirect(MI_BASE_URL.'logout.php');

}

$user_id = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
$logo = mi_db_read_by_id('settings_meta', array('type'=>'image'))[0];
$sales_note = mi_db_read_by_id('sales_meta', array('user_id'=> $user_id))[0];

$address = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_address'))[0];
$email = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_email'))[0];
$phone = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_phone'))[0];
$note = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_note'))[0];

$cart_data = mi_db_read_by_id('mi_product_cart', array('user_id'=> $user_id));
$sales_meta = mi_db_read_by_id('sales_meta', array('user_id' => $user_id))[0];

$paid_amount = $sales_meta['paid_amount'];
$total = [];
foreach ($cart_data as $cart){
    $product = mi_db_read_by_id('mi_products', array('pro_id' => $cart['pro_id']))[0];
    $price = $product['pro_price'] * $cart["pro_qty"];
    $discount_amount = ($cart['discount']/100)*$price;
    $sub_total_amount = $price - $discount_amount;
    $total[] = $sub_total_amount;
}

$due_amount = array_sum($total)-$paid_amount;
?>
<style>
    .dataTables_filter{
        width: 100%;
    }
    .dataTables_filter label{
        width: 100%;
        text-align: left;
    }
    .dataTables_filter label input{
        margin-left: 0px !important;
    }
</style>
    <div class="main-panel" style="width: 100%;">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title pull-left" style="margin-top: 10px !important;">All Products</h5>
                  <select type="text" id="sort_brand" class="pull-right" style="height: 30px;margin-left: 10px; margin-top: 0; max-width: 150px;">
                      <option value="0">Color</option>
                      <?php
                      $getCat = mi_db_read_all('mi_product_brand', 'br_id', 'DESC');
                      foreach ($getCat as $ct){
                          echo '<option value="'.$ct['br_id'].'">'.$ct['br_title'].'</option>';
                      }
                      ?>
                  </select>
                  <select type="text" id="sort_category" class="pull-right" style="height: 30px;margin-left: 10px; margin-top: 0; max-width: 150px;">
                      <option value="0">Category</option>
                      <?php
                        $getCat = mi_db_read_all('mi_product_category', 'cat_id', 'DESC');
                        foreach ($getCat as $ct){
                            echo '<option value="'.$ct['cat_id'].'">'.$ct['cat_title'].'</option>';
                        }
                      ?>
                  </select>
                  <input type="text" placeholder="Search Product" id="get_product_search" class="form-control pull-right" style="max-width:150px;width: 100%;height: 30px; margin-top: 0">
                  <div class="clearfix"></div>
                  <hr>
              </div>
              <div class="card-body" style="max-height: 650px;overflow: hidden;">
                  <div class="container-fluid">
                      <div class="row" id="all_of_product_grid">

                      </div>

                      <div class="d-flex justify-content-center">
                          <button class="btn btn-success btn-sm rounded-0" id="page-prev"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Prev</button>
                          <button class="btn btn-success btn-sm rounded-0" id="page-next">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                      </div>


                  </div>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>

            <div class="col-md-6" style="padding-left: 5px;">
                <div class="card" style="max-height: 775px;">
                    <div class="card-header ">
                        <h5 class="card-title pull-left"><i class="nc-icon nc-bag-16"></i> User Basket</h5>
                        <button class="btn btn-danger btn-sm pull-right cart_clear_btn rounded-0">Clear <i class="nc-icon nc-simple-remove"></i></button>
                    </div>

                    
                    <div class="card-body text-center table-responsive" style="overflow-x: auto;" id="get_cart_products">

                    </div>


                    <div class="card-footer">
                        <button class="btn btn-primary pull-left mi_print_btn rounded-0" style="margin-right: 5px;">
                            <i class="fa fa-print"></i>
                        </button>
                        <button class="btn btn-success pull-left rounded-0" data-toggle="modal" data-target="#addCustomerSales">
                            <i class="fa fa-user-alt"></i>
                        </button>
                        <div class="form-group float-left col-md-4 col-sm-6" id="select-customer">
                            <?php
                            echo '<select class="form-control" id="getnewcustomer" style="z-index:999999;">
                                            <option value="">Select Customer</option>';

                            $customerget=mi_db_read_all('customers','id','DESC');
                            foreach ($customerget as $newc) {
                                echo '<option value="'.$newc['id'].'">'.$newc['customer_name'].'</option>';
                            }
                            echo  '</select>';
                            ?>
                        </div>
                        <button class="btn btn-primary pull-right mi_complete_purchase rounded-0">Purchase</button>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <!-- Trigger the modal with a button -->
        <a class="btn btn-info btn-lg billing-modal d-none" id="billing-modal" href="#animatedModal">Modal</a>


    <div id="animatedModal" role="dialog" style="z-index: 999999; padding-left: 0px !important; display:none;">
        <button type="button" class="close mi_close close-animatedModal">&times;</button>
        <div class="modal-content border-0" style="top: 5%;background: none">
            <div id="invoice-POS" style="width:794px; height:1122px;">
                <div class="paid_or_due_seal">
                    <h1></h1>
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
                            <h5 class="">Bill To</h5>
                            <p>
                                <span class="rrcname"></span><br>
                                <span  class="rrcphone"></span><br>
                                <span  class="rrcaddress"></span>
                            </p>
                            <p>Billing Date: <?=date("Y/m/d")?></p>
                        </div>
                    </div>
                </div>

                <div id="bot">

                    <div id="mi_billing_table">

                    </div><!--End Table-->

                    <div class="row">
                        <div id="legalcopy" class="col-sm-10 col-md-10">
                            <p id="sales_due_note">N.B. : <span></span></p>
                            <p class="legal"><small><?=$note['meta_value']?></small></p>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">
                            <p>Signature</p>
                            <p>-------------</p>
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

        <!--    -------------------------add customer modal--------------------------->
        <div class="modal fade" id="addCustomerSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal" name="addCustomerForm" id="addCustomerForm" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Name</label>

                                    <input type="text" name="customer_name" placeholder="Enter customer Name" class="form-control">

                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Phone</label>
                                    <input type="tel" name="phone" placeholder="Enter customer phone" class="form-control">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Address</label>
                                    <textarea class="form-control" name="address" placeholder="Customer address"></textarea>
                                </div>

                                <div class="col-md-12 btn-block">
                                    <input type="hidden" name="AddCustomerSales" value="1">
                                    <button type="submit" name="AddCustomerSales" class="btn btn-primary pull-right"><i class="nc-icon nc-simple-add"></i>&nbsp; Add Customer</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>




<?=mi_footer();?>

        <script>
            window.onload = function(){
                document.getElementById('mi_pro_for_bar').focus();
            };
            function barScanFocus(){
                document.getElementById('mi_pro_for_bar').value = "";
                document.getElementById('mi_pro_for_bar').focus();
            }
        </script>
