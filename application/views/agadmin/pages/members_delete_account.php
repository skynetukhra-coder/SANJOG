<style type="text/css">
.table tr.small td{
	padding:2px 10px;
}
.table tr.small:hover{
	background:#f4f1f1;
}
.table tr.root-parent td{
	background:#ccc;
}
</style>
<div class="row-fluid">
  <div class="span12" id="content" style="text-align:center; padding:10px;">
    <h2>Do you want to delete your account?</h2>
	<div>
		<button class="btn btn-primary" type="button" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>dashboard'">No, Goto Dashboard</button>
		<button class="btn btn-danger" type="button" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>members/delete/<?php echo $this->uri->segment(4)?>?q=delete'">Yes, Delete my account</button>
	</div>
  </div>
</div>
<script type="text/javascript">
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>office/ag-ae-edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>pages/delete/'+id;
		}
		
	}
}
</script>