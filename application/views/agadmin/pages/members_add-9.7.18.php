<?php
$name = isset($row['admin_name']) ? $row['admin_name'] : '';
$email = isset($row['admin_email']) ? $row['admin_email'] : '';
$username = isset($row['admin_username']) ? $row['admin_username'] : '';
$wing = isset($row['admin_type_id']) ? $row['admin_type_id'] : '';
$status = isset($row['admin_status']) ? $row['admin_status'] : '';
?>
<div class="row-fluid">
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left"><?php echo $this->uri->segment(4) > 0 ? 'Edit' : 'Add' ?> Member</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate">
          <fieldset>
          <div class="control-group">
            <label class="control-label">Name<span class="required">*</span></label>
            <div class="controls">
              <input type="text" name="name" value="<?php echo set_value('name',$name)?>" data-required="1" class="span12 m-wrap" required>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Email<span class="required">*</span></label>
            <div class="controls">
              <input name="email" type="email" value="<?php echo set_value('email',$email)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Username<span class="required">*</span></label>
            <div class="controls">
              <input name="username" type="text" value="<?php echo set_value('username',$username)?>" class="span12 m-wrap" required>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Password<?php echo (!empty($row) ? '' : '<span class="required">*</span>')?></label>
            <div class="controls">
              <input name="password" type="password" class="span12 m-wrap"<?php echo (!empty($row) ? '' : 'required')?>>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Confirm Password<?php echo (!empty($row) ? '' : '<span class="required">*</span>')?></label>
            <div class="controls">
              <input name="confirm_password" type="password" class="span12 m-wrap"<?php echo (!empty($row) ? '' : 'required')?>>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Wing<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="wing" required>
			  	<?php
				if(!empty($wings)){
					foreach($wings as $row){?>
						<option value="<?php echo $row['admin_type_id'] ?>" <?php echo set_select('wing', $row['admin_type_id'], ($wing == $row['admin_type_id'] ? true : false)); ?>><?php echo $row['admin_type_name'] ?></option>
				<?php
					}
				}?>
              </select>
            </div>
          </div>
		  <div class="control-group">
            <label class="control-label">Status<span class="required">*</span></label>
            <div class="controls">
              <select class="span12 m-wrap" name="status" required>
				<option value="ACTIVE" <?php echo set_select('status', "ACTIVE", ($status == "ACTIVE" ? true : false)); ?> >Active</option>
				<option value="INACTIVE" <?php echo set_select('status', "INACTIVE", ($status == "INACTIVE" ? true : false)); ?> >Inactive</option>
				<option value="BLOCK" <?php echo set_select('status', "BLOCK", ($status == "BLOCK" ? true : false)); ?> >Block</option>
				<option value="SUSPENDED" <?php echo set_select('status', "SUSPENDED", ($status == "SUSPENDED" ? true : false)); ?> >Suspended</option>
              </select>
            </div>
          </div>
		  <div>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
            <button type="button" class="btn" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>members'">Cancel</button>
          </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
