<?=mi_header();?>
<?=mi_sidebar();?>
<?php

if (isset($_POST['mi_user_profile_updater_submit'])){
    $uid = mi_secure_input($_POST['miuid']);
    $uname = mi_secure_input($_POST['user_name']);
    $udesig = mi_secure_input($_POST['user_designation']);
    $uphone = mi_secure_input($_POST['user_phone']);
    $uemail = mi_secure_input($_POST['user_email']);


    if (empty($uid)){
        mi_notifier('User undefined', 'error');
    }elseif (empty($uname)){
        mi_notifier('User name is required', 'error');
    }else{
        $data = array(
            'user_name'         => $uname,
            'user_designation'  => $udesig,
            'email'             => $uemail,
            'phone'             => $uphone
        );
        $update = mi_db_update('mi_users', $data, array('id'=>$uid));

        if($update){
            mi_notifier('Profile Updated Successfully', 'success');
        }else{
            mi_notifier('Error to update profile', 'error');
        }
    }
}


if (isset($_POST['mi_user_password_updater_submit'])){
    $uid = mi_secure_input($_POST['miuid']);
    $old = mi_secure_input($_POST['old_pass']);
    $new = mi_secure_input($_POST['new_pass']);
    $con = mi_secure_input($_POST['con_newpass']);

    if (empty($old) || empty($new) || empty($con)){
        mi_notifier('All the fields are required on password reset', 'error');
    }else{
        $usData = mi_db_read_by_id('mi_users', array('id'=>$uid))[0];

        if (md5($old) !== $usData['pass']){
            mi_notifier('Old password not matching', 'error');
        }elseif ($new !== $con){
            mi_notifier('New passwords are not matching', 'error');
        }else{
            $updata = array(
                    'pass' => md5($con)
            );

            $upPass = mi_db_update('mi_users', $updata, array('id'=>$uid));
            if ($upPass){
                mi_notifier('Password reset successfully', 'success');
            }else{
                mi_notifier('Password not updated', 'error');
            }
        }
    }
}

    $idmk = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $user = mi_db_read_by_id('mi_users', array('id'=>$idmk))[0];

?>
<style>
    .dataTables_filter{
        width: 100%;
    }
    .dataTables_filter label{
        width: 100%;
        text-align: left;
    }
    .dataTables_filter label input{
        margin-left: 0px !important;
    }
</style>

    <div class="main-panel">
      <?=mi_nav();?>

      <div class="content">
          <div class="row">
              <div class="col-md-7">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Your Profile</h5>
                      </div>
                      <div class="card-body">
                          <form action="profile.php" method="post" autocomplete="off">
                              <input type="hidden" name="miuid" value="<?=$idmk;?>">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>User Id</label>
                                          <input type="text" class="form-control" disabled="disabled" value="<?=$user['user_id'];?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Name</label>
                                          <input type="text" name="user_name" class="form-control" placeholder="Your Name" value="<?=$user['user_name'];?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Designation</label>
                                          <input type="text" name="user_designation" class="form-control" placeholder="Your designation" value="<?=$user['user_designation'];?>">
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Phone</label>
                                          <input type="tel" name="user_phone" class="form-control" placeholder="Your Phone Number" value="<?=$user['phone'];?>">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input type="email" name="user_email" class="form-control" placeholder="Your Email" value="<?=$user['email'];?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label><strong>Registered From:</strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-7">
                                      <div class="form-group">
                                          <label><strong><?=date('d M Y', strtotime($user['registered_from']))?></strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label><strong>Registered By:</strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-7">
                                      <div class="form-group">
                                          <label><strong>
                                                  <?php
                                                       if (isset($user['created_by'])){
                                                           error_reporting(0);
                                                           $creator = mi_db_read_by_id('mi_users', array('id'=>$user['created_by']))[0];
                                                           echo $creator['user_name'];
                                                           if ($creator['user_type'] == 1){
                                                               echo "(Admin)";
                                                           }elseif ($creator['user_type'] == 2){
                                                               echo "(Shop Manager)";
                                                           }else{
                                                               echo "System";
                                                           }
                                                       }
                                                  ?>
                                              </strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label><strong>User Type:</strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-7">
                                      <div class="form-group">
                                          <h2 class="badge badge-info m-0" style="font-size: 13px;">
                                              <?php
                                              if ($user['user_type'] == 1){
                                                  echo "Admin";
                                              }elseif ($user['user_type'] == 2){
                                                  echo "Shop Manager";
                                              }elseif ($user['user_type'] == 3){
                                                  echo "Sales Man";
                                              }else{
                                                  echo "Undefined";
                                              }
                                              ?>
                                          </h2>
                                      </div>
                                  </div>
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label><strong>Account Status:</strong></label>
                                      </div>
                                  </div>
                                  <div class="col-md-7">
                                      <div class="form-group">
                                          <h2 class="badge badge-success m-0" style="font-size: 13px;">
                                              <?php
                                              if ($user['status'] == 1){
                                                  echo "Active";
                                              }elseif ($user['status'] == 2){
                                                  echo "Deactive";
                                              }
                                              ?>
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="update ml-3">
                                      <button type="submit" name="mi_user_profile_updater_submit" class="btn btn-primary">Update Profile &nbsp;<i class="nc-icon nc-refresh-69"></i></button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-md-5">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Reset your password</h5>
                      </div>
                      <div class="card-body">
                          <form action="profile.php" method="post" autocomplete="off">
                              <input type="hidden" name="miuid" value="<?=$idmk;?>">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Old Password</label>
                                          <input type="password" name="old_pass" class="form-control" placeholder="Enter Old password">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>New Password</label>
                                          <input type="password" name="new_pass" class="form-control" placeholder="Enter New password">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Confirm New Password</label>
                                          <input type="password" name="con_newpass" class="form-control" placeholder="Confirm New password">
                                      </div>
                                  </div>

                              <div class="row">
                                  <div class="update" style="margin-left: 30px;">
                                      <button type="submit" name="mi_user_password_updater_submit" class="btn btn-primary">Reset Password &nbsp;<i class="nc-icon nc-refresh-69"></i></button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>


<?=mi_footer();?>