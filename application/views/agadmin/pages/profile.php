<?php
$username = isset($row['admin_username']) ? $row['admin_username'] : '';
$admin_type_name = isset($row['admin_type_name']) ? $row['admin_type_name'] : '';
$name = isset($row['admin_name']) ? $row['admin_name'] : '';
$email = isset($row['admin_email']) ? $row['admin_email'] : '';
$wing = isset($row['admin_type_id']) ? $row['admin_type_id'] : '';
$status = isset($row['admin_status']) ? $row['admin_status'] : '';
?>
<div class="row-fluid">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">My Profile</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<form id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate">
					<fieldset>
					<div class="control-group">
						<label class="control-label">Admin Type<span class="required">*</span></label>
						<div class="controls">
							<input name="username" type="text" value="<?php echo set_value('admin_type_name',$admin_type_name)?>" class="span12 m-wrap" readonly>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Username<span class="required">*</span></label>
						<div class="controls">
							<input name="username" type="text" value="<?php echo set_value('username',$username)?>" class="span12 m-wrap" readonly>
						</div>
					</div>
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
					<div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-success"><?php echo $this->uri->segment(4) > 0 ? 'Update' : 'Submit' ?></button>
					</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
