<div class="row-fluid">
  <div class="span12" id="content">
	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<div class="">
				<label class="control-label"><b>View GPF Account Statement</b></label>
			</div>
			<form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/view_ac_slip"  target="_blank">
			  <div class="control-form">
				<label class="control-label">Series</label>
				<div class="controls">
					<select  id="series_code" name="series" class="form-control" placeholder="dd-mm-yyyy">
						<option value="">--- <?php echo $this->lang->line('choose_series_code'); ?> ---</option>
							<?php
							if(isset($series_codes)){
								foreach($series_codes as $code){
									echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
								}
							}
							?>
					</select>
				</div>
			  </div>
			  <div class="control-form" style ="padding-left: 20px">
				<label class="control-label">AC Code</label>
				<div class="controls">
				 <input type="text" name="ac_code" placeholder="Ac code"/>
				</div>
			  </div>
			   <div class="control-form">
                 <label class="control-label">Year</label>
                 <div class="controls">
                   <input type="text" name="fyear"  data-required="1" value ="31-03-2021" autocomplete="off" placeholder="DD-MM-YYYY" />
                 </div>
              </div>
			  <div class="control-form">
			  	<label class="control-label">&nbsp;</label>
				<div class="controls">
					<input type="submit" value="View" />
				</div>
			  </div>
			  <div class="control-form">
                 <label class="control-label">&nbsp;</label>
                 <div class="controls">
                    <button class="btn-success btn-lg" onclick="window.location.reload();" >REFRESH</button>
                 </div>
              </div>
			  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			  <div class="clearfix"></div>
			 </form>
		</div>
	</div>
	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<div class="">
				<label class="control-label"><b>View Final Payment Authority</b></label>
			</div>
			<form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/view_fpa_pdf"  target="_blank">
			  <div class="control-form">
				<label class="control-label">Series</label>
				<div class="controls">
					<select  id="series_code" name="series" class="form-control" placeholder="dd-mm-yyyy">
						<option value="">--- <?php echo $this->lang->line('choose_series_code'); ?> ---</option>
							<?php
							if(isset($series_codes)){
								foreach($series_codes as $code){
									echo '<option value="'.$code['series'].'">'.$code['series'].'</option>';
								}
							}
							?>
					</select>
				</div>
			  </div>
			  <div class="control-form" style ="padding-left: 20px" >
				<label class="control-label">AC Code</label>
				<div class="controls">
				 <input type="text" name="ac_code" value="<?php echo $this->input->get('ac_code',true)?>" placeholder="Ac code"/>
				</div>
			  </div>
			  <div class="control-form">
                 <label class="control-label">&nbsp;</label>
                 <div class="controls">
                    <input type="submit" value="View" />
                 </div>
              </div>
			  <div class="control-form">
                 <label class="control-label">&nbsp;</label>
                 <div class="controls">
                    <button class="btn-success btn-lg" onclick="window.location.reload();" >REFRESH</button>
                 </div>
              </div>
			  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			  <div class="clearfix"></div>
			 </form>
		</div>
	</div>
	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			 <form >
              <label class="control-label">* View sample output by giving proper input and click on the view button above.</label>
             </form>
		</div>
	</div>
</div>
    <div class="block">

    </div>
  </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function goGPF(){
	window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/view_ac_slip/;
}
function goFPA(){
	window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/view_fpa_pdf/;
}
</script>