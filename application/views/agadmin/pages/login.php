<div class="row-fluid">
  <!-- block -->
  <div class="logo-block"><img src="<?php echo SITE_BASE_URL ?>assets/images/logo.png" /></div>
  
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><img src="<?php echo SITE_BASE_URL ?>assets/images/key-icon.png" style="height:25px" />&nbsp;Member Login</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
	  	<div class="error">
			<?php echo $errors ?>
		</div>
        <!-- BEGIN FORM-->
        <form autocomplete="off" method="post" class="form-horizontal">
          <fieldset>
          <div class="control-group">
            <div class="">
              <input autocomplete="off" type="text" name="username" value="<?php echo set_value('username'); ?>" required="required" class="span12 m-wrap" placeholder="Username">
            </div>
          </div>
          <div class="control-group">
            <div class="">
              <input autocomplete="off" type="password" name="password" required="required" class="span12 m-wrap" placeholder="Password">
            </div>
          </div>
          <div class="control-group">
            <div class="">
              <?php echo $cap['image'];?>
               <button type="button" style="width:60px;height:40px" onclick="reload_captcha()" title="Re-Generate"><i class="fa fa-refresh" style="font-size:20px" aria-hidden="true"></i></button>
            </div>
          </div>
          <div class="control-group">
            <div class="">
              <input type="text" name="c_image" class="span12 m-wrap" placeholder="<?php echo $this->lang->line('write_image_code'); ?>" autocomplete="off" required >
            </div>
          </div>
		      <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <button type="submit" class="btn btn-block btn-success">Login</button>
		  <a class="small-anchor" href="<?php echo ADMIN_BASE_URL.'forgot-password' ?>">Forgot Password?</a>
          </fieldset>
        </form>
        <!-- END FORM-->
      </div>
    </div>
  </div>
  <!-- /block -->
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const usernameInput = document.querySelector('input[name="username"]');
    const userCaptchaInput = document.querySelector('input[name="c_image"]');

    usernameInput.addEventListener("input", function (e) {
      // Allow only letters, numbers, underscore, and hyphen
      this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, "");
    });
    userCaptchaInput.addEventListener("input", function (e) {
      // Allow only letters, numbers, underscore, and hyphen
      this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, "");
    });
  });
</script>