<div class="row">
	<style>
	label{margin-top:10px;}
	</style>
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="heading" style="color:red; font-size: 20px" >SUBSCRIBER'S LOGIN SERVICE IS NOT AVAILABLE TEMPORARILY.</div>
	</div>
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php // $this->load->view('layout/left_panel');?>
		</div>
	</div>
</div>
<script>
function check_validation(){
	var error = false;
	if($('#series_code').val() == ''){
		error = true;
	}
	if($('#gpf_no').val() == ''){
		error = true;
	}
	if($('#datepicker').val() == ''){
		error = true;
	}
	if(error){
		$('.error').text('<?php echo $this->lang->line('all_maindatory_fields'); ?>');
		return false;
	}else{
		$('.error').text('');
		return true;
	}
	return false;
}
 
</script>
