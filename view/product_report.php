<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['mi_pro_id'])){

    $pro_id = mi_secure_input($_GET['mi_pro_id']);

}else{
    mi_redirect(MI_BASE_URL.'warehouse.php');
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

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
          <div class="container-fluid mi_roport_container">
              <div class="row">

                  <?php if (isset($pro_id) && !empty($pro_id)){
                      $miProD = mi_db_read_by_id('mi_products', array('pro_id'=>$pro_id))[0];
                      ?>
                      <div class="col-md-6 col-12">
                          <div class="card">
                              <div class="card-body" id="miReportPrint">
                                  <h3 class="mt-3">Statestics about <?=$miProD['pro_title'];?></h3>

                                  <div class="row mi-page-break pb-5 mb-5">
                                      <div class="col-md-5 col-sm-6">
                                          <img style="width: 100%;border: 1px solid #e3e3e3; padding: 10px;min-height: 240px" src="<?=MI_CDN_URL;?>uploads/<?=$miProD['pro_img'];?>">
                                      </div>
                                      <div class="col-md-7 col-sm-6">
                                          <p><strong>Name:</strong> <?=$miProD['pro_title'];?></p>
                                          <p><strong>Sell Price:</strong> <?=$currency['meta_value']?> <?=$miProD['pro_price'];?></p>
                                          <p><strong>Buy Price:</strong> <?=$currency['meta_value']?> <?=$miProD['buy_price'];?></p>
                                          <p><strong>Available Qty:</strong> <?=$miProD['pro_stock'];?> Pcs</p>
                                          <p><strong>Brand:</strong> <?=mi_db_read_by_id('mi_product_brand', array('br_id'=>$miProD['pro_brand']))[0]['br_title'];?></p>
                                          <p><strong>Category:</strong> <?=mi_db_read_by_id('mi_product_category', array('cat_id'=>$miProD['pro_cat']))[0]['cat_title'];?></p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-12">
                          <div class="row mi-page-break">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-header">
                                          <h5>Statistics</h5>
                                      </div>
                                      <div class="card-body mi_print_show_table">
                                          <h6><strong>Top 15 sold product report</strong></h6>
                                          <?php


                                          $var = mi_db_read_all('mi_orders');
                                          $arra = [];
                                          $data = [];
                                          foreach ($var as $k => $dr){
                                              if ($dr['refund_date'] == '0000-00-00 00:00:00'){
                                                  $data[] = array('details'=>explode(', ', $dr['order_products_details']), 'time'=>$dr['order_created']);
                                              }
                                          }
                                          $noya = array();

                                          foreach ($data as $item){
                                              foreach ($item['details'] as $itm){
                                                  $newitm = json_decode($itm, true);
                                                  if ($newitm['pro_id'] == $pro_id){
                                                      $noya[] = array($newitm, $item['time']);
                                                  }
                                              }
                                          }


                                          ?>
                                          <table class="table table-bordered" style="font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif">
                                              <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Product title</th>
                                                  <th>Product sold qty</th>
                                                  <th>Sold Amount</th>
                                                  <th>Serials</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <?php
                                              $dataPoints = [];
                                              $repOrQty = [];
                                              $repOrTotal = [];
                                              $roun = 1;
                                              foreach ($noya as $proval){
                                                  $proDetails = $proval[0];
                                                  $odDt = strtotime($proval[1])."000";
                                                  $prodat = mi_db_read_by_id('mi_products', array('pro_id'=>$proDetails['pro_id']))[0];
                                                  $repOrQty[] = $proDetails['pro_qty'];
                                                  $repOrTotal[] = ($prodat['pro_price'] * $proDetails['pro_qty']);
                                                  $dataPoints[] = array("x" => $odDt, "y" => $proDetails['pro_qty']);
                                                  ?>
                                                  <tr>
                                                      <th><?=$roun;?></th>
                                                      <th><?=$prodat['pro_title'];?></th>
                                                      <th><?=$proDetails['pro_qty'];?></th>
                                                      <th><?=$currency['meta_value']?> <?=($prodat['pro_price']*$proDetails['pro_qty']);?></th>
                                                      <th><?php
                                                          foreach ($proDetails['pro_serials'] as $renser){
                                                              echo "<h2 class='badge badge-dark badge-pill text-white' style='margin-right: 5px;font-size: 12px;'>".$renser."</h2>";
                                                          }
                                                          ?></th>
                                                  </tr>
                                                  <?php $roun++;}?>
                                              </tbody>
                                              <tfoot>
                                              <th colspan="2">Total</th>
                                              <th><?=array_sum($repOrQty);?> Pcs</th>
                                              <th colspan="2"><?=$currency['meta_value']?> <?=array_sum($repOrTotal);?></th>
                                              </tfoot>
                                          </table>
                                      </div>
                                      <div class="card-body mi_canvas_hide_in_print pb-4">
                                          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-12">
                          <div class="row mi-page-break">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-header">
                                          <h5>Orders Details</h5>
                                      </div>
                                      <div class="card-body">

                                          <table class="table table-bordered table-striped">
                                              <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Order Id</th>
                                                  <th>Order Quantity</th>
                                                  <th>Product Total</th>
                                                  <th>Order Total</th>
                                                  <th>Order Status</th>
                                                  <th>Order time</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <?php
                                              $router = 1;
                                              $getTotalQty = [];
                                              $getTotalpro = [];
                                              $getTotalPrc = [];

                                              foreach ($var as $rorder){
                                                  $vvl = explode(', ', $rorder['order_products_details']);
                                                  foreach ($vvl as $v){
                                                      $idr = json_decode($v)->{'pro_id'};
                                                      $get_Prc = mi_db_read_by_id('mi_products', array('pro_id'=>$idr))[0];

                                                      if ($idr == $pro_id){
                                                          if ($rorder['refund_date'] == "0000-00-00 00:00:00"){
                                                              ?>
                                                              <tr>
                                                                  <td><?=$router;?></td>
                                                                  <td>
                                                                      <a class="text-body font-weight-bold" href="view_orders.php?mi_order_view=<?=$rorder['order_id'];?>"><?=$rorder['trx_id'];?></a>
                                                                  </td>
                                                                  <td>
                                                                      <?=json_decode($v)->{'pro_qty'};?> Pcs
                                                                  </td>

                                                                  <td><?=$currency['meta_value']?> <?=($get_Prc['pro_price'] * json_decode($v)->{'pro_qty'});?></td>
                                                                  <td><?=$currency['meta_value']?> <?=$rorder['no_tax_amount']+(($rorder['tax_percentage']/100)*$rorder['no_tax_amount']) + ((!empty($rorder['order_extra_amount']))?$rorder['order_extra_amount']:0);?></td>
                                                                  <td><?=($rorder['refund_date'] == "0000-00-00 00:00:00")?'Active':'Refunded';?></td>
                                                                  <td><?=$rorder['order_created'];?></td>
                                                              </tr>
                                                              <?php
                                                              $getTotalQty[] = json_decode($v)->{'pro_qty'};
                                                              $getTotalPrc[] = $rorder['no_tax_amount']+(($rorder['tax_percentage']/100)*$rorder['no_tax_amount']) + ((!empty($rorder['order_extra_amount']))?$rorder['order_extra_amount']:0);
                                                              $getTotalpro[] = ($get_Prc['pro_price'] * json_decode($v)->{'pro_qty'});

                                                              $router++;}}}}?>
                                              </tbody>
                                              <tfoot>
                                              <tr>
                                                  <th colspan="2">Total: </th>
                                                  <th><?=array_sum($getTotalQty);?> Pcs</th>
                                                  <th><?=$currency['meta_value']?> <?=array_sum($getTotalpro);?></th>
                                                  <th><?=$currency['meta_value']?> <?=array_sum($getTotalPrc);?></th>
                                                  <th colspan="3"></th>
                                              </tr>
                                              </tfoot>
                                          </table>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-12">
                          <div class="row mi-page-break">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-header">
                                          <h5>Expense Details</h5>
                                      </div>
                                      <div class="card-body">

                                          <table class="table table-bordered table-striped">
                                              <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Stock Id</th>
                                                  <th>Supplier</th>
                                                  <th>Stock qty</th>
                                                  <th>Stock total</th>
                                                  <th>Product unit</th>
                                                  <th>Supply time</th>
                                                  <th>Supply status</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <?php
                                              $supp = mi_db_read_all('mi_stocks');
                                              $romm = 1;
                                              $supTotalQty = [];
                                              $supTotalpro = [];
                                              $supTotalPrc = [];
                                              $shower = "";

                                              foreach ($supp as $supUp){
                                                  if ($pro_id == $supUp['product_id']){
                                                      $repsupSup = mi_db_read_by_id('mi_product_suppliers', array('sup_id'=>$supUp['supplier_id']))[0];

                                                      $supTotalQty[] = $supUp['stock_qty'];
                                                      $supTotalpro[] = $supUp['unit_price'];
                                                      $supTotalPrc[] = $supUp['expanse'];

                                                      $shower .= "<tr>";

                                                      $shower .= "<td>".$romm."</td>";
                                                      $shower .= "<td>stk_".$supUp['stock_id']."</td>";
                                                      $shower .= "<td><strong>".$repsupSup['sup_name']."</strong><br><sub>".$repsupSup['sup_company']."</sub></td>";
                                                      $shower .= "<td>".$supUp['stock_qty']." Pcs</td>";
                                                      $shower .= "<td>".$currency['meta_value']." ".$supUp['expanse']."</td>";
                                                      $shower .= "<td>".$currency['meta_value']." ".$supUp['unit_price']."</td>";
                                                      $shower .= "<td>".$supUp['upload_date']."</td>";
                                                      if ($supUp['refund_date'] == "0000-00-00 00:00:00"){
                                                          $shower .= "<td>Active</td>";
                                                      }else{
                                                          $shower .= "<td>Refunded</td>";
                                                      }

                                                      $shower .= "</tr>";
                                                      $romm++;
                                                  }
                                              }
                                              echo $shower;
                                              ?>
                                              </tbody>
                                              <tfoot>
                                              <tr>
                                                  <th colspan="3">Total:</th>
                                                  <th><?=array_sum($supTotalQty);?> Pcs</th>
                                                  <th><?=$currency['meta_value']?> <?=array_sum($supTotalPrc);?></th>
                                                  <th><?=$currency['meta_value']?> <?=array_sum($supTotalpro);?></th>
                                                  <th colspan="3"></th>
                                              </tr>
                                              </tfoot>
                                          </table>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  <?php }?>
              </div>
          </div>
      </div>
    </div>


<?=mi_footer();?>
        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    //theme: "light2",
                    title:{
                        text: "Product report"
                    },
                    axisX: {
                        valueFormatString: "DD MMM"
                    },
                    axisY:{
                        title: "Sold Quantity",
                    },
                    data: [{
                        type: "splineArea",
                        color: "#6599FF",
                        xValueType: "dateTime",
                        xValueFormatString: "DD MMM",
                        yValueFormatString: "#,##0 Pics",
                        dataPoints: <?=json_encode($dataPoints, JSON_NUMERIC_CHECK);?>
                    }]
                });
                chart.render();

            }
        </script>