<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['customer_edit'])){
    $ctid = mi_secure_input($_GET['customer_edit']);
    $getudata = mi_db_read_by_id('customers', array('id' => $ctid))[0];
}
?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?=(isset($_GET['customer_edit']))?'Update Customer':'Add Customer';?></h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="actions.php" method="post" id="mi_customer_adding_form" autocomplete="off">

                        
                            <div class="row">

                              <?php if (isset($_GET['customer_edit'])){?>

                                <input type="hidden" name="mi_customer_updating_form" value="1">
                                <input type="hidden" name="cid" value="<?=$getudata['id'] ?>">                                 

                              <?php }else{ ?>
                               <input type="hidden" name="mi_customer_adding_form" value="<?php echo md5('1147') ?>">
                              <?php } ?>
                            
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Name</label>

                                    <input type="text" name="customer_name" placeholder="Enter customer Name" class="form-control" value="<?=(!empty($getudata['customer_name'])) ? $getudata['customer_name'] : ''; ?>">
                                   
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Phone</label>
                                    <input type="tel" name="phone" value="<?=(!empty($getudata['phone'])) ? $getudata['phone'] : ''; ?>" placeholder="Enter customer phone" class="form-control">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Customer Address</label>
                                    <textarea class="form-control" name="address" placeholder="Customer address"><?=(!empty($getudata['address'])) ? $getudata['address'] : ''; ?></textarea>
                                </div>
                            

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Customer Type</label>
                                    <div class="row">
                                        
                                            <div class="col-md-6">
                                                <div class="funkyradio">
                                                    <div class="funkyradio-primary">
                                                        <input type="radio" name="customertype" id="radio1" value="1" <?=(!empty($getudata['type'])) ? (($getudata['type']==1) ? 'checked' :'') : ''; ?> checked="1"/>
                                                        <label for="radio1">Retailer</label>
                                                    </div>
                                                </div>
                                            </div>
                                  
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="customertype" id="radio2" value="2" <?=(!empty($getudata['type'])) ? (($getudata['type']==2) ? 'checked' :'') : ''; ?>/>
                                                    <label for="radio2">Industrial</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 btn-block">
                                    <button type="submit" name="add_customer" value="1" class="btn btn-primary pull-right"><i class="nc-icon <?=(isset($_GET['customer_edit']))?'nc-refresh-69':'nc-simple-add'?>"></i>&nbsp; <?=(isset($_GET['customer_edit']))?'Update':'Add'?> Customer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
          <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">All of the customers</h5>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-left">
                    <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                    <tr>
                        <th style="max-width: 50px;">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="customers"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                        </th>
                        <th colspan="8"></th>
                    </tr>
                    <?php }?>
                    <tr>
                        <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                        <th style="max-width: 50px;">
                            <!-- <div class="checkbox pull-left">
                                <label style="font-size: 1.5em">
                                    <input type="checkbox" value="" class="selectAll">
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                </label>
                            </div> -->
                            #
                        </th>
                        <?php }?>

                        <th class="table_font_small text-left">Name</th>
                        <th class="table_font_small text-center">Phone</th>
                        <th class="table_font_small">Address</th>
                        <th class="table_font_small">Type</th>
                        <th class="table_font_small">Status</th>
                        <th class="table_font_small">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                  <tr>
                      <td></td>
                      <td class="text-left"><strong>Unknown</strong></td>
                      <td>N/A</td>
                      <td>N/A</td>
                      <td>N/A</td>
                      <td>N/A</td>
                      <td>
                          <a title="Edit" href="customers-transaction.php?c=0" class="btn btn-sm btn-success btn-rounded"><i class="nc-icon nc-chart-bar-32"></i></a>
                      </td>
                  </tr>
                  <?php

                  $data = mi_db_read_all('customers', 'id', 'DESC');
                  $currentTp = mi_db_read_by_id('mi_users', array('id'=>str_replace('mi_','',base64_decode($_SESSION['session_id']))))[0];


                       foreach ($data as $k => $d){?>
                         <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                          <tr>
                              <td style="padding-left: 18px !important;max-width: 50px;">
                                  <div class="checkbox">
                                      <label style="font-size: 1.5em">
                                          <input type="checkbox" value="<?=$d['id'];?>" class="selectorcheck">
                                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                      </label>
                                  </div>
                              </td>
                          <?php } ?>
                              <td class="text-left">
                                  <h6 class="m-0"><?=$d['customer_name'];?></h6>
                                 
                              </td>
                              
                              <td>
                                  <?=$d['phone'];?>
                              </td>
                               <td>
                                  <?=$d['address'];?>
                              </td>

                               <td>
                                 <p><?=($d['type'] == 1)?'Retailer':'Industrial';?></p>
                              </td>
                              
                              <td>
                                  <p class="badge badge-dark"><?=($d['customer_status'] == 0)?'Active':'Inactive';?></p>
                              </td>
                              <td>
                                  <a title="Edit" href="customers.php?customer_edit=<?=$d['id'];?>" class="btn btn-sm btn-dark btn-rounded"><i class="fa fa-edit"></i></a>
                                  <a title="View" href="customers-transaction.php?c=<?=$d['id'];?>" class="btn btn-sm btn-success btn-rounded"><i class="nc-icon nc-chart-bar-32"></i></a>
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
