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
                <table class="table table-full-width" id="product_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th colspan="2" style="max-width: 50px; padding-top: 0;">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="product"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                        </th>
                        <th colspan="7">
                            <div class="row justify-content-end" style="padding-bottom: 10px">
                                <div class="col-md-3">
                                    <?php
                                        $cats = mi_db_read_all('mi_product_category');
                                    ?>
                                    <select class="form-control" name="pro_cat_sort" id="pro_cat_sort">
                                        <option value="">Category</option>
                                        <?php foreach ($cats as $cat){?>
                                            <option value="<?=$cat['cat_id']?>"><?=$cat['cat_title']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-3" style="padding-right: 0">
                                    <?php
                                        $colors = mi_db_read_all('mi_product_brand');
                                    ?>
                                    <select class="form-control" name="pro_color_sort" id="pro_color_sort">
                                        <option value="">Color</option>
                                        <?php foreach ($colors as $color){?>
                                            <option value="<?=$color['br_id']?>"><?=$color['br_title']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                        </th>
                    </tr>
                    <tr>
                        <?php if (
                            base64_decode($_SESSION['session_type']) == "mi_1" ||
                            base64_decode($_SESSION['session_type']) == "mi_2"){?>
                            <th style="max-width: 50px;" class="text-left">
                                #
                            </th>
                        <?php }else{?>
                            <th class="table_font_small">SL.</th>
                        <?php }?>
                        <th class="table_font_small text-left">Image</th>
                        <th class="table_font_small text-left">Grade</th>
                        <th class="table_font_small text-left">Product Name</th>
                        <th class="table_font_small text-left">Stock</th>
                        <th class="table_font_small text-left">Category</th>
                        <th class="table_font_small text-left">Color</th>
                        <th class="table_font_small text-left">Price</th>
                        <th class="table_font_small text-left">Actions</th>
                    </tr>
                  </thead>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<?=mi_footer();?>
