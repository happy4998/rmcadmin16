<div class="wrapper wrapper-content animated fadeInRight">
  <div class="col-lg-12">
    <div class="ibox">
      <div class="ibox-content">
          <h3 class="m-t-none m-b"><?php echo __("Change Password")?></h3>
          <form class="m-t" role="form" method="POST" action="<?php echo getConfig('siteUrl').'/users/changepassword'?>">
            <div class="form-group">
              <label><?php echo __("Old Password")?></label>
              <input type="password" class="form-control" placeholder="Please enter old password" required="" name="current_password">
            </div>
            <div class="form-group">
              <label><?php echo __("New Password")?></label>
              <input type="password" class="form-control" placeholder="Please enter new password" required="" name="new_password">
            </div>
            <div class="form-group">
              <label><?php echo __("Confirm New Password")?></label>
              <input type="password" class="form-control" placeholder="Please confirm new Password" required="" name="confirm_password">
            </div>
            <div class="col-md-2">
              <button type="submit" name="changePassword" class="btn btn-primary block full-width m-b"><?php echo __("Update")?></button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
