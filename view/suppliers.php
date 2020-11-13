<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h5 class="card-title pull-left" style="margin-top: 18px">All of The Suppliers List</h5>
                <a class="btn btn-primary pull-right"href="single_supplier.php">Add Supplier &nbsp;<i class="nc-icon nc-simple-add"></i></a>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th style="max-width: 50px; padding-top: 0">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="supplier"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
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
                        <th class="table_font_small">Supplier Name</th>
                        <th class="table_font_small">Company</th>
                        <th class="table_font_small">Email</th>
                        <th class="table_font_small">Phone</th>
                        <th class="table_font_small">Address</th>
                        <th class="table_font_small">Added</th>
                        <th class="table_font_small">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_product_suppliers', 'sup_id', 'DESC');

                  foreach ($data as $d){
                  ?>
                  <tr>
                      <td style="padding-left: 18px !important;max-width: 50px;">
                          <div class="checkbox">
                              <label style="font-size: 1.5em">
                                  <input type="checkbox" value="<?=$d['sup_id'];?>" class="selectorcheck">
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              </label>
                          </div>
                      </td>
                      <td><?=(!empty($d['sup_img']))?'<img class="img-fluid img-thumbnail" src="uploads/'.$d['sup_img'].'" style="max-width: 70px;">': '<img class="img-fluid img-thumbnail" src="uploads/empty-img.png" style="max-width: 70px;">';?></td>
                      <td><strong><?=(!empty($d['sup_name']))?$d['sup_name']:'N/A';?></strong></td>
                      <td><?=(!empty($d['sup_company']))? $d['sup_company']: 'N/A';?></td>
                      <td><?=(!empty($d['sup_email']))? $d['sup_email']:'N/A';?></td>
                      <td><?=(!empty($d['sup_phone']))? $d['sup_phone']:'N/A';?></td>
                      <td><?=(!empty($d['sup_address']))? $d['sup_address']:'N/A';?></td>
                      <td><?=$d['sup_added'];?></td>
                      <td>
                          <a title="Edit" href="single_supplier.php?mi_sup_id=<?=$d['sup_id'];?>" class="btn btn-sm btn-dark btn-rounded"><i class="fa fa-edit"></i></a>
                          <a title="View" href="supplier-transaction.php?st=<?=$d['sup_id'];?>" class="btn btn-sm btn-success btn-rounded"><i class="nc-icon nc-chart-bar-32"></i></a>
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
