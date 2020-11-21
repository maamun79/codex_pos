<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

?>
<?php
if (isset($_POST['save_product_mi']) || isset($_POST['update_product_mi'])){
    $name = mi_secure_input($_POST['product_title_mi']);
    $price = mi_secure_input($_POST['product_price_mi']);
    $model = mi_secure_input($_POST['product_model_mi']);
    $status = mi_secure_input($_POST['product_status_mi']);
    $procat = mi_secure_input($_POST['product_category_mi']);
    $probr = mi_secure_input($_POST['product_brnad_mi']);

    $image = $_FILES['product_image_mi'];

    if (!isset($_POST['update_product_mi'])){

        if (
                empty($name) ||
                empty($price) ||
                empty($model) ||
                empty($status) ||
                empty($procat) ||
                empty($probr)
        ){

            echo mi_notifier("All the fields are Required", "error");
        }elseif ($price < 1){
            echo mi_notifier("Product price can not be less than 1", "error");
        }else{

            if (!empty($image['name'])){
                $up_img = mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    'uploads/product/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                );

                $data = array(
                    'pro_title' => $name,
                    'pro_price' => $price,
                    'pro_img' => $up_img,
                    'pro_brand' => $probr,
                    'pro_cat' => $procat,
                    'pro_status' => $status,
                    'pro_model_number' => $model
                );

            }else{
                $data = array(
                    'pro_title' => $name,
                    'pro_price' => $price,
                    'pro_brand' => $probr,
                    'pro_cat' => $procat,
                    'pro_status' => $status,
                    'pro_model_number' => $model
                );
            }
            $insert = mi_db_insert('mi_products', $data);

            if ($insert === true){
                $data['pro_title'] = "";
                $data['pro_price'] = "";
                $data['pro_cat'] = "";
                $data['pro_brand'] = "";
                $data['pro_model_number'] = "";
                $data['pro_status'] = "";
                $data['pro_img'] = "";

                $name = "";
                $price = "";
                $model = "";
                $status = "";
                $procat = "";
                $probr = "";
                $image = "";

                echo mi_notifier("Product Saved Successfully", "success");
            }else{
                echo mi_notifier("Error to Save Product", "error");
            }

        }

    }else{
        $pro_id = $_POST['pro_id'];

        if (
                empty($name) ||
                empty($price) ||
                empty($model) ||
                empty($procat) ||
                empty($probr)
        ){
            echo mi_notifier("All the fields are Required", "error");
        }else{

            if (!empty($image['name'])){

                $get_existing_pro = mi_db_read_by_id('mi_products', array('pro_id'=> $pro_id))[0];

                $up_img = mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    'uploads/product/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                );

                if ($up_img == true){
                    unlink($get_existing_pro['pro_img']);
                }

                $data = array(
                    'pro_title' => $name,
                    'pro_price' => $price,
                    'pro_img' => $up_img,
                    'pro_brand' => $probr,
                    'pro_cat' => $procat,
                    'pro_status' => $status,
                    'pro_model_number' => $model
                );

            }else{

                $data = array(
                    'pro_title' => $name,
                    'pro_price' => $price,
                    'pro_brand' => $probr,
                    'pro_cat' => $procat,
                    'pro_status' => $status,
                    'pro_model_number' => $model
                );

            }

            $update = mi_db_update('mi_products', $data, array('pro_id' => $pro_id));
            if ($update == true){
                echo mi_notifier("Product updated successfully", "success");
            }else{
                echo mi_notifier("Error to update product", "error");
            }

        }
    }
}

if (isset($_GET['mi_pro_id'])){
    $data = mi_db_read_by_id('mi_products', array('pro_id' => $_GET['mi_pro_id']))[0];
}
?>


      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>


      <div class="content">
          <?php if (!isset($_GET['mi_pro_id'])){?>
          <form style="width: 100%;" action="single_product.php" method="post" enctype="multipart/form-data">
              <?php }else{?>
              <form style="width: 100%;" action="single_product.php?mi_pro_id=<?=$data['pro_id'];?>" method="post" enctype="multipart/form-data">
                  <?php }?>
        <div class="row">
          <div class="col-md-8" style="padding-right: 6px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title pull-left">Add New Product</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body">
                  <div class="row mi_product_add_container">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Product Title</label>
                              <input type="text" class="form-control" placeholder="Enter Product Title" name="product_title_mi" value="<?=(!empty($data['pro_title']))?$data['pro_title']:((!empty($name))?$name:'');?>">
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Product Price</label>
                              <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price_mi" value="<?=(!empty($data['pro_price']))?$data['pro_price']:((!empty($price))?$price:'');?>">
                          </div>
                      </div>

                      <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Product Grade</label>
                              <input type="text" class="form-control" placeholder="Enter Product Grade" name="product_model_mi" value="<?=(!empty($data['pro_model_number']))?$data['pro_model_number']:((!empty($model))?$model:'');?>">
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Product Status</label>
                              <select class="form-control" name="product_status_mi" type="text">
                                  <option>Choose Product Status</option>
                                  <option value="1" <?=(!empty($data['pro_status']) && $data['pro_status'] == 1)?'selected':((!empty($status) && $status == 1)?'selected':'');?>>Enable</option>
                                  <option value="0" <?=(!empty($data['pro_status']) && $data['pro_status'] == 0)?'selected':((!empty($status) && $status == 0)?'selected':'');?>>Disable</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Upload Product Image</label>
                              <input type="file" class="dropify" name="product_image_mi" data-provide="dropify" data-default-file="<?=(!empty($data['pro_img']))?MI_CDN_URL.$data['pro_img']:'';?>">
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>


            <div class="col-md-4" style="padding-left: 6px">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="col-md-12 col-sm-5 col-xs-12">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Category*</label>
                                    <select name="product_category_mi" class="selectpicker form-control show-tick" data-live-search="true" title="Choose one category">
                                        <?php
                                        $catGet = mi_db_read_all('mi_product_category');
                                        foreach ($catGet as $ctg){?>
                                            <option value="<?=$ctg['cat_id'];?>" <?=(!empty($data['pro_cat']) && $data['pro_cat'] == $ctg['cat_id'])?'selected':((!empty($procat) && $procat == $ctg['cat_id'])?'checked':'');?>><?=$ctg['cat_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Color*</label>
                                    <select name="product_brnad_mi" class="selectpicker form-control show-tick" data-live-search="true" title="Choose one color">
                                        <?php
                                        $brGet = mi_db_read_all('mi_product_brand');
                                        foreach ($brGet as $brg){?>
                                            <option value="<?=$brg['br_id'];?>" <?=(!empty($data['pro_brand']) && $data['pro_brand'] == $brg['br_id'])?'selected':((!empty($probr) && $probr == $brg['br_id'])?'checked':'');?>><?=$brg['br_title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="col-md-12 m-auto no-gutters">
                                    <?php if (!isset($_GET['mi_pro_id'])){?>
                                        <button type="submit" class="btn btn-default w-100" name="save_product_mi"><i class="nc-icon nc-simple-add"></i>&nbsp; Save Product</button>
                                    <?php }else{?>
                                        <input type="hidden" name="pro_id" value="<?=$data['pro_id'];?>">
                                        <button type="submit" class="btn btn-default w-100" name="update_product_mi"><i class="nc-icon nc-refresh-69"></i>&nbsp; Update Product</button>
                                    <?php }?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              </form>

      </div>

<?=mi_footer();?>
