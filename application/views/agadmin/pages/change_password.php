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
