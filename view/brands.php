<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_POST['mi_brand_save'])){
    $cname = mi_secure_input($_POST['br_name']);
    $cslug = strtolower(str_replace(' ', '', $cname));

    if (!empty($_POST['br_type'])) {
        $ctype = mi_secure_input($_POST['br_type']);
    }else{
        $ctype = "";
    }

    $check = mi_db_read_by_id('mi_product_brand', array('br_slug' => $cslug));

    if ($check == true){
        echo mi_notifier("Brand with this name already exists", "error");
    }else{

        if (empty($cname)){
            echo mi_notifier("Name and Icon Type is required", "error");
        }else{
            if ($ctype == 1){
                $cimg = $_FILES['br_img']['name'];
                if (empty($cimg)){
                    echo mi_notifier("Brand Image is Required", "error");
                }else{
                    $rename = md5(date("dmYHis")).$cimg;
                    $allowed_image_extension = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG", "GIF", "gif");
                    $file_extension = pathinfo($rename, PATHINFO_EXTENSION);
                    $path = "uploads/";
                    if (!in_array($file_extension, $allowed_image_extension)){
                        echo mi_notifier("Please Choose Image File for Icon", "error");
                    }else{
                        if (move_uploaded_file($_FILES['br_img']['tmp_name'], $path.$rename)){
                            $data = array(
                                'br_title' => $cname,
                                'br_slug' => $cslug,
                                'br_icon' => $rename,
                                'br_icon_type' => $ctype
                            );
                            $insert = mi_db_insert('mi_product_brand', $data);
                            if ($insert){
                                echo mi_notifier("Brand Saved Successfully", "success");
                            }else{
                                echo mi_notifier("Error to save Brand", "error");
                            }
                        }else{
                            echo mi_notifier("Image Not Uploaded", "error");
                        }
                    }
                }
            }else{
                if (!empty($_POST['br_icon'])) {
                    $cimg = mi_secure_input($_POST['br_icon']);
                }else{
                    $cimg = "";
                }

                $data = array(
                    'br_title' => $cname,
                    'br_slug' => $cslug,
                    'br_icon' => $cimg,
                    'br_icon_type' => $ctype
                );
                $insert = mi_db_insert('mi_product_brand', $data);
                if ($insert){
                    echo mi_notifier("Brand Saved Successfully", "success");
                }else{
                    echo mi_notifier("Error to save Brand", "error");
                }
            }
        }

    }
}


if (isset($_POST['mi_brand_update'])){
    $cat_id = mi_secure_input($_POST['brandid']);
    $cname = mi_secure_input($_POST['br_name']);
    $cslug = strtolower(str_replace(' ', '', $cname));
    $ctype = mi_secure_input($_POST['br_type']);

    if ($ctype == 1){
        $cimg = $_FILES['br_img']['name'];
        if (empty($cimg)){
            $data = array(
                'br_title' => $cname,
                'br_slug' => $cslug,
                'br_icon_type' => $ctype
            );
            $update = mi_db_update('mi_product_brand', $data, array('br_id' => $cat_id));
            if ($update){
                echo mi_notifier("Brand Updated Successfully", "success");
            }else{
                echo mi_notifier("Error to Update Brand", "error");
            }
        }else{
            $rename = md5(date("dmYHis")).$cimg;
            $allowed_image_extension = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG", "GIF", "gif");
            $file_extension = pathinfo($rename, PATHINFO_EXTENSION);
            $path = "uploads/";
            if (!in_array($file_extension, $allowed_image_extension)){
                echo mi_notifier("Please Choose Image File for Icon", "error");
            }else{
                if (move_uploaded_file($_FILES['br_img']['tmp_name'], $path.$rename)){
                    $data = array(
                        'br_title' => $cname,
                        'br_slug' => $cslug,
                        'br_icon' => $rename,
                        'br_icon_type' => $ctype
                    );
                    $update = mi_db_update('mi_product_brand', $data, array('br_id' => $cat_id));
                    if ($update){
                        echo mi_notifier("Brand Updated Successfully", "success");
                    }else{
                        echo mi_notifier("Error to update Brand", "error");
                    }
                }else{
                    echo mi_notifier("Image Not Uploaded", "error");
                }
            }
        }
    }else{
        $cimg = mi_secure_input($_POST['br_icon']);

        if (empty($cimg)){
            echo mi_notifier("Brand Icon can not be empty", "error");
        }else{
            $data = array(
                'br_title' => $cname,
                'br_slug' => $cslug,
                'br_icon' => $cimg,
                'br_icon_type' => $ctype
            );
            print_r($data);
            $update = mi_db_update('mi_product_brand', $data, array('br_id' => $cat_id));
            if ($update){
                echo mi_notifier("Brand Updated Successfully", "success");
            }else{
                echo mi_notifier("Error to Update Brand", "error");
            }
        }
    }
}

if (isset($_GET['mi_br_edit'])){
    $brid = mi_secure_input($_GET['mi_br_edit']);
    $getbrdata = mi_db_read_by_id('mi_product_brand', array('br_id' => $brid))[0];
}

?>
      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-right: 6px">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Color</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="<?=(isset($brid))?'brands.php?mi_br_edit='.$brid:'brands.php'?>" method="post" enctype="multipart/form-data">
                            <?php if (isset($brid)){echo "<input type='hidden' name='brandid' value='".$brid."'>";}?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Color Name</label>
                                    <input type="text" name="br_name" placeholder="Enter Color Name" class="form-control" value="<?=(isset($brid) && !empty($getbrdata['br_title']))?$getbrdata['br_title']:'';?>">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Brand Type</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="br_type" id="radio1" value="1" <?=(isset($brid) && $getbrdata['br_icon_type'] == 1)?'checked':'';?>/>
                                                    <label for="radio1">Image</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="br_type" id="radio2" value="2" <?=(isset($brid) && $getbrdata['br_icon_type'] == 2)?'checked':'';?>/>
                                                    <label for="radio2">Icon</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group radio1element" style="display: <?=(isset($brid) && $getbrdata['br_icon_type'] == 1)?'block':'';?>;">
                                    <label>Upload Image</label>
                                    <input type="file" name="br_img" class="form-control">
                                    <?=(isset($brid) && $getbrdata['br_icon_type'] == 1)?'<img src="'.MI_CDN_URL.'uploads/'.$getbrdata['br_icon'].'" class="img-thumbnail img-fluid" style="width: 100px;">':'';?>
                                </div>
                                <div class="col-md-12 form-group radio2element" style="display: <?=(isset($brid) && $getbrdata['br_icon_type'] == 2)?'block':'';?>;">
                                    <label>Upload Image</label>
                                    <input type="text" name="br_icon" class="form-control iconpicker" placeholder="Click and Choose Icon" value="<?=(isset($brid) && $getbrdata['br_icon_type'] == 2)? $getbrdata['br_icon']:'';?>">
                                    <?=(isset($brid) && $getbrdata['br_icon_type'] == 2)?'<i class="'.$getbrdata['br_icon'].' img-fluid img-thumbnail" style="font-size: 80px;"></i>':'';?>
                                </div>
                                <div class="col-md-12 btn-block">
                                    <button type="submit" name="<?=(isset($brid))?'mi_brand_update':'mi_brand_save';?>" class="btn btn-primary pull-right"><i class="nc-icon <?=(isset($brid))?'nc-refresh-69':'nc-simple-add';?>"></i>&nbsp;<?=(isset($brid))?'Update':'Save';?> Brand</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

          <div class="col-md-8 col-sm-12 col-xs-12" style="padding-left: 6px">
            <div class="card ">
              <div class="card-header">
                <h5 class="card-title pull-left">All of The Colors</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th style="max-width: 50px; padding-top: 0">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="brand"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
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
                        <th>Color Icon</th>
                        <th>Color Name</th>
                        <th>Color Slug</th>
                        <th>Color Icon Type</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_product_brand', 'br_id', 'DESC');

                  foreach ($data as $k => $d){
                  ?>
                  <tr>
                      <td style="padding-left: 18px !important;max-width: 50px;">
                          <div class="checkbox">
                              <label style="font-size: 1.5em">
                                  <input type="checkbox" value="<?=$d['br_id'];?>" class="selectorcheck">
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              </label>
                          </div>
                      </td>
                      <td><?=(!empty($d['br_icon']))?(($d['br_icon_type'] == 2)? '<i class="'.$d['br_icon'].'" style="font-size: 30px;"></i>':'<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'uploads/'.$d['br_icon'].'" style="max-width: 40px;">'): '<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'uploads/empty-img.png" style="max-width: 40px;">';?></td>
                      <td><strong><?=(!empty($d['br_title']))? $d['br_title']:'N/A';?></strong></td>
                      <td><?=(!empty($d['br_slug']))? $d['br_slug']:'N/A';?></td>
                      <td><?=(!empty($d['br_icon_type']))? (($d['br_icon_type'] == 2)? '<label class="badge badge-dark text-white">Icon</label>':'<label class="badge badge-dark text-white">Image</label>'):'N/A';?></td>
                      <td>
                          <a title="Edit" class="btn btn-sm btn-dark btn-rounded" href="brands.php?mi_br_edit=<?=$d['br_id'];?>" value="<?=$d['br_id'];?>"><i class="nc-icon nc-settings"></i>&nbsp;Edit</a>
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
