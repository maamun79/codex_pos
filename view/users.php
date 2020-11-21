<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['user_edit'])){
    $ctid = mi_secure_input($_GET['user_edit']);
    $getudata = mi_db_read_by_id('mi_users', array('id' => $ctid))[0];
}

$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">

          <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 5px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title pull-left" style="margin-top: 18px">All Staffs</h5>
                  <a class="btn btn-primary pull-right"href="add-staff.php">Add Staff &nbsp;<i class="nc-icon nc-simple-add"></i></a>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width mi_datatable">
                  <thead class="text-primary text-left">
                    <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                    <tr>
                        <th style="max-width: 50px; padding-top: 0">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="users"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                        </th>
                        <th colspan="8"></th>
                    </tr>
                    <?php }?>
                    <tr>
                        <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                        <th style="max-width: 50px;">
                            <div class="checkbox pull-left">
                                <label style="font-size: 1.5em">
                                    <input type="checkbox" value="" class="selectAll">
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                </label>
                            </div>
                        </th>
                        <?php }?>
                        <th class="table_font_small">Name</th>
                        <th class="table_font_small text-center">Id</th>
                        <th class="table_font_small text-center">Contact</th>
                        <th class="table_font_small text-center">Created By</th>
                        <th class="table_font_small text-center">Status</th>
                        <th class="table_font_small text-center">Salary</th>
                        <th class="table_font_small text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_users', 'id', 'DESC');
                  $currentTp = mi_db_read_by_id('mi_users', array('id'=>str_replace('mi_','',base64_decode($_SESSION['session_id']))))[0];

                  $total_salary_paid = [];
                  foreach ($data as $k => $d){
                      if (str_replace('mi_','',base64_decode($_SESSION['session_id'])) !== $d['id'] && $d['user_type'] != 1){
                      if ($currentTp['user_type'] == 2){
                  ?>
                      <tr>
                            <?php if (base64_decode($_SESSION['session_type']) == "mi_1"){?>
                          <td style="padding-left: 18px !important;max-width: 50px;">
                              <div class="checkbox">
                                  <label style="font-size: 1.5em">
                                      <input type="checkbox" value="<?=$d['id'];?>" class="selectorcheck">
                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                  </label>
                              </div>
                          </td>
                            <?php }?>
                          <td class="text-left">
                                <h6 class="m-0"><?=$d['user_name'];?></h6>
                                <sub><?=$d['user_designation'];?></sub>
                          </td>
                          <td>
                              <?=$d['user_id'];?>
                          </td>
                          <td>
                              <?=$d['phone'];?>
                          </td>
                          <td>
                              <?=(!empty($d['created_by']))?
                                  mi_db_read_by_id('mi_users', array('id'=>$d['created_by']))[0]['user_name']."<br><sub>".
                                  mi_db_read_by_id('mi_users', array('id'=>$d['created_by']))[0]['user_designation']."</sub>"
                                  :'System';
                              ?>
                          </td>
                          <td>
                              <p class="badge badge-dark"><?=($d['status'] == 1)?'Active':'Inactive';?></p>
                          </td>
                          <td>
                              <a title="Edit" href="users.php?user_edit=<?=$d['id'];?>" class="btn btn-sm btn-default btn-rounded"><i class="fa fa-edit"></i></a>
                          </td>

                      </tr>
                  <?php }else{?>
                          <tr>
                              <td style="padding-left: 18px !important;max-width: 50px;">
                                  <div class="checkbox">
                                      <label style="font-size: 1.5em">
                                          <input type="checkbox" value="<?=$d['id'];?>" class="selectorcheck">
                                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                      </label>
                                  </div>
                              </td>
                              <td class="text-left">
                                  <h6 class="m-0"><?=$d['user_name'];?></h6>
                                  <sub><?=$d['user_designation'];?></sub>
                              </td>
                              <td>
                                  <?=$d['user_id'];?>
                              </td>
                              <td>
                                  <?=$d['phone'];?>
                              </td>
                              <td>
                                  <?=(!empty($d['created_by']))?
                                      mi_db_read_by_id('mi_users', array('id'=>$d['created_by']))[0]['user_name']."<br><sub>".
                                      mi_db_read_by_id('mi_users', array('id'=>$d['created_by']))[0]['user_designation']."</sub>"
                                      :'System';
                                  ?>
                              </td>
                              <td>
                                  <p class="badge badge-dark"><?=($d['status'] == 1)?'Active':'Inactive';?></p>
                              </td>
                              <?php
                                    $expense = mi_db_custom_query("SELECT * FROM regular_expenses WHERE staff_id =".$d['id']." AND  MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())")[0];
                                    $total_salary_paid[] = $expense['amount'];
                              ?>
                              <td>
                                  <?php
                                        if (!empty($expense['amount']) && $expense['amount'] >= $d['salary']){
                                  ?>
                                      <?=(!empty($d['salary'])?$d['salary']:'0');?> <?=$currency['meta_value']?><br>
                                      Paid <i class="fa fa-check-circle" aria-hidden="true" style="color: #00c853"></i>
                                  <?php } else{?>
                                      <?=(!empty($d['salary'])?$d['salary']:'0');?> <?=$currency['meta_value']?><br>
                                      <button class="showSalary btn btn-sm btn-danger"
                                              type="button" data-toggle="modal" data-placement="top" title="Salary payment" data-target="#update_staff_salary" salary_amount="<?=$d['salary']?>" staff_id="<?=$d['id'] ?>" salary_due="<?= $d['salary'] - $expense['amount']; ?>">
                                          Pay Now
                                      </button>
                                  <?php }?>
                              </td>
                              <td>
                                  <a title="Edit" href="add-staff.php?user_edit=<?=$d['id'];?>" class="btn btn-sm btn-default btn-rounded"><i class="fa fa-edit"></i></a>
                              </td>

                          </tr>
                  <?php }}}?>
                  </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-right">
                                <h5>Salary Paid - <?= number_format(array_sum($total_salary_paid),2)?> <?= $currency['meta_value']?></h5>
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
<!--          --------------------salary modal-------------------->
          <div class="modal fade" id="update_staff_salary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" style="width: 450px">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Staff Salary Payment</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">


                          <form class="form-horizontal" id="mi_add_due" autocomplete="off">
                              <div class="row">
                                  <div class="col-md-12 col-sm-12 form-group">
                                      <strong>Salary: <span id="staff_salary"></span> <?=$currency['meta_value']?></strong><br>
                                      <strong>Total Paid   : <span id="salary_paid"></span> <?=$currency['meta_value']?></strong><br>
                                      <strong>Total Due    : <span id="salary_due"></span> <?=$currency['meta_value']?></strong><br><br>

                                      <input type="hidden" id="keep_staff_id" value="">
                                      <input type="hidden" id="keep_salary_amount" value="">
                                      <input type="hidden" id="keep_salary_paid" value="">

                                      <label>Collection Amount:</label>
                                      <input type="number" class="form-control" value="0" min="0" max="" id="salary_due_amount" required="">
                                      <button class="btn btn-sm btn-danger" id="add_salary_update">Update</button>
                                  </div>

                              </div>
                          </form>

                      </div>
                  </div>
              </div>
          </div>

      </div>





<?=mi_footer();?>
