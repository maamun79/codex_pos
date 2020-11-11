<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_POST['mi_category_save'])){
    $cname = mi_secure_input($_POST['cat_name']);
    $cslug = strtolower(str_replace(' ', '', $cname));

    if (empty($_POST['cat_type'])){
        $ctype = "";
    }else{
        $ctype = mi_secure_input($_POST['cat_type']);
    }


    $check = mi_db_read_by_id('mi_product_category', array('cat_slug' => $cslug));

    if ($check == true){
        echo mi_notifier("Category with this name already exists", "error");
    }else{

        if (empty($cname)){
            echo mi_notifier("Name and Icon Type is required", "error");
        }else{
            if ($ctype == 1){
                $cimg = $_FILES['cat_img']['name'];

                if (empty($cimg)){
                    echo mi_notifier("Category Image is Required", "error");
                }else{
                    $rename = md5(date("dmYHis")).$cimg;
                    $allowed_image_extension = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG", "GIF", "gif");
                    $file_extension = pathinfo($rename, PATHINFO_EXTENSION);
                    $path = "uploads/";
                    if (!in_array($file_extension, $allowed_image_extension)){
                        echo mi_notifier("Please Choose Image File for Icon", "error");
                    }else{
                        if (move_uploaded_file($_FILES['cat_img']['tmp_name'], $path.$rename)){
                            $data = array(
                                'cat_title' => $cname,
                                'cat_slug' => $cslug,
                                'cat_icn' => $rename,
                                'cat_icon_type' => $ctype
                            );
                            $insert = mi_db_insert('mi_product_category', $data);
                            if ($insert){
                                echo mi_notifier("Category Saved Successfully", "success");
                            }else{
                                echo mi_notifier("Error to save category", "error");
                            }
                        }else{
                            echo mi_notifier("Image Not Uploaded", "error");
                        }
                    }
                }
            }else{
                if (!empty($_POST['cat_icon'])) {
                    $cimg = mi_secure_input($_POST['cat_icon']);
                }else{
                    $cimg = "";
                }

                $data = array(
                    'cat_title' => $cname,
                    'cat_slug' => $cslug,
                    'cat_icn' => $cimg,
                    'cat_icon_type' => $ctype
                );
                $insert = mi_db_insert('mi_product_category', $data);
                if ($insert){
                    echo mi_notifier("Category Saved Successfully", "success");
                }else{
                    echo mi_notifier("Error to save category", "error");
                }
            }
        }

    }
}

if (isset($_POST['mi_category_update'])){
    $cat_id = mi_secure_input($_POST['categoyid']);
    $cname = mi_secure_input($_POST['cat_name']);
    $cslug = strtolower(str_replace(' ', '', $cname));
    $ctype = mi_secure_input($_POST['cat_type']);

    if ($ctype == 1){
        $cimg = $_FILES['cat_img']['name'];
        if (empty($cimg)){
            $data = array(
                'cat_title' => $cname,
                'cat_slug' => $cslug,
                'cat_icon_type' => $ctype
            );
            $update = mi_db_update('mi_product_category', $data, array('cat_id' => $cat_id));
            if ($update){
                echo mi_notifier("Category Updated Successfully", "success");
            }else{
                echo mi_notifier("Error to Update category", "error");
            }
        }else{
            $rename = md5(date("dmYHis")).$cimg;
            $allowed_image_extension = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG", "GIF", "gif");
            $file_extension = pathinfo($rename, PATHINFO_EXTENSION);
            $path = "uploads/";
            if (!in_array($file_extension, $allowed_image_extension)){
                echo mi_notifier("Please Choose Image File for Icon", "error");
            }else{
                if (move_uploaded_file($_FILES['cat_img']['tmp_name'], $path.$rename)){
                    $data = array(
                        'cat_title' => $cname,
                        'cat_slug' => $cslug,
                        'cat_icn' => $rename,
                        'cat_icon_type' => $ctype
                    );
                    $update = mi_db_update('mi_product_category', $data, array('cat_id' => $cat_id));
                    if ($update){
                        echo mi_notifier("Category Updated Successfully", "success");
                    }else{
                        echo mi_notifier("Error to update category", "error");
                    }
                }else{
                    echo mi_notifier("Image Not Uploaded", "error");
                }
            }
        }
    }else{
        $cimg = mi_secure_input($_POST['cat_icon']);

        if (empty($cimg)){
            echo mi_notifier("Category Icon can not be empty", "error");
        }else{
            $data = array(
                'cat_title' => $cname,
                'cat_slug' => $cslug,
                'cat_icn' => $cimg,
                'cat_icon_type' => $ctype
            );
            $update = mi_db_update('mi_product_category', $data, array('cat_id' => $cat_id));
            if ($update){
                echo mi_notifier("Category Updated Successfully", "success");
            }else{
                echo mi_notifier("Error to Update category", "error");
            }
        }
    }
}

if (isset($_GET['mi_cat_edit'])){
    $ctid = mi_secure_input($_GET['mi_cat_edit']);
    $getcatdata = mi_db_read_by_id('mi_product_category', array('cat_id' => $ctid))[0];
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
                        <h5 class="card-title"><?=(isset($ctid)?'Edit':'Add')?> Category</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="<?=(isset($ctid))?'categories.php?mi_cat_edit='.$ctid:'categories.php'?>" method="post" enctype="multipart/form-data">
                            <?php if (isset($ctid)){echo "<input type='hidden' name='categoyid' value='".$ctid."'>";}?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="cat_name" placeholder="Enter Category Name" class="form-control" value="<?=(isset($ctid) && !empty($getcatdata['cat_title']))?$getcatdata['cat_title']:'';?>">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Category Type</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="cat_type" id="radio1" value="1" <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 1)?'checked':'';?>/>
                                                    <label for="radio1">Image</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="cat_type" id="radio2" value="2" <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 2)?'checked':'';?>/>
                                                    <label for="radio2">Icon</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group radio1element" style="display: <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 1)?'block':'';?>;">
                                    <label>Upload Image</label>
                                    <input type="file" name="cat_img" class="form-control">
                                    <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 1)?'<img src="'.MI_CDN_URL.'uploads/'.$getcatdata['cat_icn'].'" class="img-thumbnail img-fluid" style="width: 100px;">':'';?>
                                </div>
                                <div class="col-md-12 form-group radio2element" style="display: <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 2)?'block':'';?>;">
                                    <label>Upload Image</label>
                                    <input type="text" name="cat_icon" class="form-control iconpicker" placeholder="Click and Choose Icon" value="<?=(isset($ctid) && $getcatdata['cat_icon_type'] == 2)? $getcatdata['cat_icn']:'';?>">
                                    <?=(isset($ctid) && $getcatdata['cat_icon_type'] == 2)?'<i class="'.$getcatdata['cat_icn'].' img-fluid img-thumbnail" style="font-size: 80px;"></i>':'';?>
                                </div>
                                <div class="col-md-12 btn-block">
                                    <button type="submit" name="<?=(isset($ctid))?'mi_category_update':'mi_category_save';?>" class="btn btn-primary pull-right"><i class="nc-icon <?=(isset($ctid))?'nc-refresh-69':'nc-simple-add';?>"></i>&nbsp;<?=(isset($ctid))?'Update':'Save';?> Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
          <div class="col-md-8 col-sm-12 col-xs-12" style="padding-left: 6px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">All of The Categories</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th style="max-width: 50px; padding-top: 0">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="category"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
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
                        <th class="table_font_small">Category Icon</th>
                        <th class="table_font_small">Category Name</th>
                        <th class="table_font_small">Category Slug</th>
                        <th class="table_font_small">Category Icon Type</th>
                        <th class="table_font_small">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_product_category', 'cat_id', 'DESC');

                  foreach ($data as $k => $d){
                  ?>
                  <tr>
                      <td style="padding-left: 18px !important;max-width: 50px;">
                          <div class="checkbox">
                              <label style="font-size: 1.5em">
                                  <input type="checkbox" value="<?=$d['cat_id'];?>" class="selectorcheck">
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              </label>
                          </div>
                      </td>
                      <td><?=(!empty($d['cat_icn']))?(($d['cat_icon_type'] == 2)? '<i class="'.$d['cat_icn'].'" style="font-size: 30px;"></i>':'<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'uploads/'.$d['cat_icn'].'" style="max-width: 40px;">'): '<img class="img-fluid img-thumbnail" src="'.MI_CDN_URL.'uploads/empty-img.png" style="max-width: 40px;">';?></td>
                      <td><strong><?=(!empty($d['cat_title']))? $d['cat_title']:'N/A';?></strong></td>
                      <td><?=(!empty($d['cat_slug']))? $d['cat_slug']:'N/A';?></td>
                      <td><?=(!empty($d['cat_icon_type']))? (($d['cat_icon_type'] == 2)? '<label class="badge badge-dark text-white">Icon</label>':'<label class="badge badge-dark text-white">Image</label>'):'N/A';?></td>
                      <td>
                          <a title="Edit" href="categories.php?mi_cat_edit=<?=$d['cat_id'];?>" class="btn btn-sm btn-dark btn-rounded"><i class="nc-icon nc-settings"></i>&nbsp;Edit</a>
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
