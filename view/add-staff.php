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
        <form class="form-horizontal" id="mi_user_adding_form" autocomplete="off">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12" style="padding-right: 5px">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><?=(isset($_GET['user_edit']))?'Update Staff':'Add Staff';?></h5>
                        </div>
                        <div class="card-body">

                            <?php if (isset($_GET['user_edit'])){?>
                                <input type="hidden" name="mi_user_updating_form" value="1">
                                <input type='hidden' name='csxrf' value='<?=base64_encode($getudata['id']);?>'>
                            <?php }else{?>
                                <input type="hidden" name="mi_user_adding_form" value="1">
                                <input type='hidden' name='created_by' value='<?=str_replace('mi_', '', base64_decode($_SESSION['session_id']));?>'>
                            <?php }?>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Id</label>
                                    <input type="text" name="usr_id" value="<?=(!empty($getudata['user_id']))?$getudata['user_id']:'';?>" <?=(!empty($getudata['user_id'])?'disabled':'')?> placeholder="Enter User Id" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Name</label>
                                    <input type="text" value="<?=(!empty($getudata['user_name']))?$getudata['user_name']:'';?>" name="usr_name" placeholder="Enter User Name" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Father's Name</label>
                                    <input type="text" value="<?=(!empty($getudata['father_name']))?$getudata['father_name']:'';?>" name="father_name" placeholder="Enter User's Father Name" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Mother's Name</label>
                                    <input type="text" value="<?=(!empty($getudata['mother_name']))?$getudata['mother_name']:'';?>" name="mother_name" placeholder="Enter User's Mother  Name" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Address</label>
                                    <input type="tel" name="address" value="<?=(!empty($getudata['address']))?$getudata['address']:'';?>" placeholder="Enter User address" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Phone</label>
                                    <input type="tel" name="usr_phone" value="<?=(!empty($getudata['phone']))?$getudata['phone']:'';?>" placeholder="Enter User phone" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Email</label>
                                    <input type="email" name="usr_email" value="<?=(!empty($getudata['email']))?$getudata['email']:'';?>" placeholder="Enter User email" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Password</label>
                                    <input type="password" name="usr_pass" placeholder="Enter User password" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff NID No.</label>
                                    <input type="text" name="nid_no" value="<?=(!empty($getudata['nid_no']))?$getudata['nid_no']:'';?>" placeholder="Enter User NID no" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label>Staff Salary</label>
                                    <input type="number" name="salary" value="<?=(!empty($getudata['salary']))?$getudata['salary']:'';?>" placeholder="Enter User salary" class="form-control">
                                </div>

                                <div class="col-md-6 col-sm-12 form-group">
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
                                <div class="col-md-6 col-sm-12 form-group">
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
                                                        <label for="radio1">Accounts</label>
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

                            </div>

                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="col-md-12 col-sm-5 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>NID Photo</label>
                                            <input type="file" class="dropify" name="staff_nid" data-provide="dropify" data-height="165" data-default-file="<?=(!empty($getudata['nid_photo']))?MI_CDN_URL.$getudata['nid_photo']:'';?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Staff Photo</label>
                                            <input type="file" class="dropify" name="staff_photo" data-provide="dropify" data-height="165" data-default-file="<?=(!empty($getudata['user_photo']))?MI_CDN_URL.$getudata['user_photo']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 btn-block">
                                <button type="submit" name="Add_User" value="1" class="btn btn-primary pull-right"><i class="nc-icon <?=(isset($_GET['user_edit']))?'nc-refresh-69':'nc-simple-add'?>"></i>&nbsp; <?=(isset($_GET['user_edit']))?'Update':'Add'?> Staff</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?=mi_footer();?>


