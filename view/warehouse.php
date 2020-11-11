<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
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
                <h5 class="card-title pull-left" style="margin-top: 18px">All of The Product List</h5>
                <a class="btn btn-primary pull-right"href="single_product.php">Add Product &nbsp;<i class="nc-icon nc-simple-add"></i></a>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th style="max-width: 50px; padding-top: 0;">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="product"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                        </th>
                        <th colspan="8"></th>
                    </tr>
                    <tr>
                        <th style="max-width: 50px;">
                            <div class="checkbox pull-left">
                                <label style="font-size: 1.5em">
                                    <input type="checkbox" value="" class="selectAll">
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                </label>
                            </div>
                        </th>
                        <th class="table_font_small">Image</th>
                        <th class="table_font_small">Grade</th>
                        <th class="table_font_small">Product Name</th>
                        <th class="table_font_small">Stock</th>
                        <th class="table_font_small">Category</th>
                        <th class="table_font_small">Color</th>
                        <th class="table_font_small">Price</th>
                        <th class="table_font_small">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_products', 'pro_id', 'DESC');

                  foreach ($data as $d){
                  ?>
                  <tr>
                      <td style="padding-left: 18px !important;max-width: 50px;">
                          <div class="checkbox">
                              <label style="font-size: 1.5em">
                                  <input type="checkbox" value="<?=$d['pro_id'];?>" class="selectorcheck">
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              </label>
                          </div>
                      </td>
                      <td><?=(!empty($d['pro_img']))?
                              '<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'uploads/'.$d['pro_img'].'" style="max-width: 50px;">'
                              :
                              '<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'assets/img/empty-img.png" style="max-width: 50px;">'
                          ;?>
                      </td>
                      <td>
                          <?=(!empty($d['pro_model_number']))? $d['pro_model_number']:'';?>
                      </td>
                      <td>
                          <strong><?=(!empty($d['pro_title']))?$d['pro_title']:'N/A';?></strong>
                      </td>
                      <td><?=(!empty($d['pro_stock']) && $d['pro_stock'] != 0)? (($d['pro_stock'] > 10)?'<label class="badge badge-primary text-white">'.$d['pro_stock'].' L</label>':'<label class="badge badge-danger text-white">'.$d['pro_stock'].' L</label>'):'<label class="badge badge-danger text-white">Empty</label>';?></td>
                      <td><?=(!empty($d['pro_cat']))?mi_db_read_by_id('mi_product_category', array('cat_id'=>$d['pro_cat']))[0]['cat_title']:'N/A';?></td>
                      <td><?=(!empty($d['pro_brand']))?mi_db_read_by_id('mi_product_brand', array('br_id'=>$d['pro_brand']))[0]['br_title']:'N/A';?></td>
                      <td><?=$d['pro_price'];?> <?=$currency['meta_value']?></td>
                      <td>
                          <a title="Edit" href="single_product.php?mi_pro_id=<?=$d['pro_id'];?>" class="btn btn-sm btn-dark btn-rounded mt-1"><i class="fa fa-edit"></i></a>
                          <a title="Analytics" href="product_report.php?mi_pro_id=<?=$d['pro_id'];?>" class="btn btn-sm btn-dark btn-rounded mt-1"><i class="nc-icon nc-chart-bar-32"></i></a>
                      </td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<?=mi_footer();?>
