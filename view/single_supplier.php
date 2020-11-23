<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

?>
<?php
if (isset($_POST['save_supplier_mi']) || isset($_POST['update_supplier_mi'])){
    $name = $_POST['supplier_name_mi'];
    $comp = $_POST['supplier_company_mi'];
    $email = $_POST['supplier_email_mi'];
    $phone = $_POST['supplier_phone_mi'];
    $address = $_POST['supplier_address_mi'];

    $image = $_FILES['supplier_image_mi'];

    if (!isset($_POST['update_supplier_mi'])){

        if (empty($name)){
            echo mi_notifier("Supplier name is required", "error");
        }else{

            if (!empty($image['name'])){
                $up_img = mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    'uploads/supplier/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                );
                $data = array(
                    'sup_name' => $name,
                    'sup_company' => $comp,
                    'sup_email' => $email,
                    'sup_phone' => $phone,
                    'sup_address' => $address,
                    'sup_img' => $up_img
                );
            }else{
                $data = array(
                    'sup_name' => $name,
                    'sup_company' => $comp,
                    'sup_email' => $email,
                    'sup_phone' => $phone,
                    'sup_address' => $address
                );
            }

            $insert = mi_db_insert('mi_product_suppliers', $data);

            if ($insert === true){
                $data['sup_name'] = "";
                $data['sup_company'] = "";
                $data['sup_email'] = "";
                $data['sup_phone'] = "";
                $data['sup_address'] = "";
                $data['sup_img'] = "";

                $name = "";
                $comp = "";
                $email = "";
                $phone = "";
                $address = "";
                $image = "";
                echo mi_notifier("Supplier Saved Successfully", "success");
            }else{
                echo mi_notifier("Error to Save Supplier", "error");
            }
        }

    }else{
        $sup_id = $_POST['supp_id'];

        if (empty($name)){
            echo mi_notifier("Supplier name is required", "error");
        }else{

            if (!empty($image['name'])){
                $get_existing = mi_db_read_by_id('mi_product_suppliers', array('sup_id'=> $sup_id))[0];

                $up_img = mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    'uploads/supplier/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                );

                if ($up_img == true){
                    unlink($get_existing['sup_img']);
                }
                $data = array(
                    'sup_name' => $name,
                    'sup_company' => $comp,
                    'sup_email' => $email,
                    'sup_phone' => $phone,
                    'sup_address' => $address,
                    'sup_img' => $up_img
                );
            }else{

                $data = array(
                    'sup_name' => $name,
                    'sup_company' => $comp,
                    'sup_email' => $email,
                    'sup_phone' => $phone,
                    'sup_address' => $address
                );

            }
            $insert = mi_db_update('mi_product_suppliers', $data, array('sup_id'=>$sup_id));

            if ($insert === true){
                echo mi_notifier("Supplier Updated Successfully", "success");
            }else{
                echo mi_notifier("Error to Update Supplier", "error");
            }

        }
    }
}


if (isset($_GET['mi_sup_id'])){
    $data = mi_db_read_by_id('mi_product_suppliers', array('sup_id' => $_GET['mi_sup_id']))[0];
}
?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>


      <div class="content">
          <?php if (!isset($_GET['mi_sup_id'])){?>
          <form style="width: 100%;" action="single_supplier.php" method="post" enctype="multipart/form-data">
              <?php }else{?>
              <form style="width: 100%;" action="single_supplier.php?mi_sup_id=<?=$data['sup_id'];?>" method="post" enctype="multipart/form-data">
                  <?php }?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title pull-left">Add New Supplier</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body">
                  <div class="row mi_product_add_container">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Supplier Name</label>
                              <input type="text" class="form-control" placeholder="Enter Supplier Name" name="supplier_name_mi" value="<?=(isset($data['sup_name']))?$data['sup_name']:((isset($name))?$name:'');?>">
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Supplier Company Name</label>
                              <input type="text" class="form-control" placeholder="Enter Supplier Company Name" name="supplier_company_mi" value="<?=(isset($data['sup_company']))?$data['sup_company']:((isset($comp))?$comp:'');?>">
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Supplier Email</label>
                              <input type="email" class="form-control" placeholder="Enter Supplier Email" name="supplier_email_mi" value="<?=(isset($data['sup_email']))?$data['sup_email']:((isset($email))?$email:'');?>">
                          </div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Supplier Phone Number</label>
                              <input type="tel" class="form-control" placeholder="Enter Supplier Phone Number" name="supplier_phone_mi" value="<?=(isset($data['sup_phone']))?$data['sup_phone']:((isset($phone))?$phone:'');?>">
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                              <label>Supplier Address</label>
                              <input type="text" class="form-control" placeholder="Enter Supplier Address" name="supplier_address_mi" value="<?=(isset($data['sup_address']))?$data['sup_address']:((isset($address))?$address:'');?>">
                          </div>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Upload Supplier Image</label>
                              <input type="file" class="dropify" name="supplier_image_mi" data-provide="dropify" data-default-file="<?=(!empty($data['sup_img']))?MI_CDN_URL.$data['sup_img']:'';?>">
                          </div>
                      </div>
                  </div>


                  <?php if (!isset($_GET['mi_sup_id'])){?>
                      <button type="submit" class="btn btn-lg btn-default w-100" name="save_supplier_mi"><i class="nc-icon nc-simple-add"></i>&nbsp; Add Supplier</button>
                  <?php }else{?>
                      <input type="hidden" name="supp_id" value="<?=$data['sup_id'];?>">
                      <button type="submit" class="btn btn-lg btn-default w-100" name="update_supplier_mi"><i class="nc-icon nc-refresh-69"></i>&nbsp; Update Supplier</button>
                  <?php }?>
              </div>
            </div>
          </div>
        </div>
              </form>

      </div>

<?=mi_footer();?>
