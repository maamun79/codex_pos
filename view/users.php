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
?>

      <?=mi_sidebar();?>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-right: 5px">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?=(isset($_GET['user_edit']))?'Update Staff':'Add Staff';?></h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="mi_user_adding_form" autocomplete="off">
                            <?php if (isset($_GET['user_edit'])){?>
                                <input type="hidden" name="mi_user_updating_form" value="1">
                                <input type='hidden' name='csxrf' value='<?=base64_encode($getudata['id']);?>'>
                            <?php }else{?>
                                <input type="hidden" name="mi_user_adding_form" value="1">
                                <input type='hidden' name='created_by' value='<?=str_replace('mi_', '', base64_decode($_SESSION['session_id']));?>'>
                            <?php }?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Staff Id</label>
                                    <?php if (isset($_GET['user_edit'])){?>
                                        <input type="text" value="<?=(!empty($getudata['user_id']))?$getudata['user_id']:'';?>" disabled="disabled" class="form-control">
                                    <?php }else{?>
                                        <input type="text" name="usr_id" placeholder="Enter User Id" class="form-control">
                                    <?php }?>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Staff Name</label>
                                    <input type="text" value="<?=(!empty($getudata['user_name']))?$getudata['user_name']:'';?>" name="usr_name" placeholder="Enter User Name" class="form-control">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Staff Phone</label>
                                    <input type="tel" name="usr_phone" value="<?=(!empty($getudata['phone']))?$getudata['phone']:'';?>" placeholder="Enter User phone" class="form-control">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Staff Email</label>
                                    <input type="email" name="usr_email" value="<?=(!empty($getudata['email']))?$getudata['email']:'';?>" placeholder="Enter User email" class="form-control">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Staff Password</label>
                                    <input type="password" name="usr_pass" placeholder="Enter User password" class="form-control">
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Status</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="usr_status" id="radioActive" value="1" <?=(!empty($getudata['status']))?(($getudata['status'] == 1)?'checked':''):'checked'?>/>
                                                    <label for="radioActive">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="usr_status" id="radioActive1" value="2" <?=(!empty($getudata['status']))?(($getudata['status'] == 2)?'checked':''):''?>/>
                                                    <label for="radioActive1">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Staff Type</label>
                                    <div class="row">
                                        <?php
                                        $yourtype = base64_decode($_SESSION['session_type']);

                                        if ($yourtype == 'mi_1'){
                                            ?>
                                            <div class="col-md-6">
                                                <div class="funkyradio">
                                                    <div class="funkyradio-primary">
                                                        <input type="radio" name="usr_type" id="radio1" value="2" <?=(!empty($getudata['user_type']))?(($getudata['user_type'] == 2)?'checked':''):''?>/>
                                                        <label for="radio1">Shop Manager</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="usr_type" id="radio2" value="3" <?=(!empty($getudata['user_type']))?(($getudata['user_type'] == 3)?'checked':''):'checked'?>/>
                                                    <label for="radio2">Sales Man</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 btn-block">
                                    <button type="submit" name="Add_User" value="1" class="btn btn-primary pull-right"><i class="nc-icon <?=(isset($_GET['user_edit']))?'nc-refresh-69':'nc-simple-add'?>"></i>&nbsp; <?=(isset($_GET['user_edit']))?'Update':'Add'?> Staff</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
          <div class="col-md-8 col-sm-12 col-xs-12" style="padding-left: 5px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">All Staffs</h5>
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
                        <th class="table_font_small">Id</th>
                        <th class="table_font_small">Contact</th>
                        <th class="table_font_small">Created By</th>
                        <th class="table_font_small">Status</th>
                        <th class="table_font_small">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php

                  $data = mi_db_read_all('mi_users', 'id', 'DESC');
                  $currentTp = mi_db_read_by_id('mi_users', array('id'=>str_replace('mi_','',base64_decode($_SESSION['session_id']))))[0];


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
                              <td>
                                  <a title="Edit" href="users.php?user_edit=<?=$d['id'];?>" class="btn btn-sm btn-default btn-rounded"><i class="fa fa-edit"></i></a>
                              </td>

                          </tr>
                  <?php }}}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>





<?=mi_footer();?>
