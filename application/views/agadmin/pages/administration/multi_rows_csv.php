<div class="row-fluid">
	 <div class="block">
		<div class="navbar navbar-inner block-header">
		  <div class="muted pull-left">Multi Rows CSV / Excel Upload</div>
		</div>
		<div class="block-content collapse in">
		  <div class="span12">
		  	<div class="uplaod-container">
				<div id="upload-file" class="upload-file">
					<div class="upload-icon">
						<i class="fa fa-cloud-upload-alt" style="font-size:50px;"></i>
					</div>
					<div>
						Drag CSV/Excel file here or click to browse
						<form enctype="multipart/form-data">
							<input id="browse_file" type="file" style="display:none" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
						</form>
					</div>
				</div>
				<div id="upload-status" class="upload-status">
					<div id="loader_message" class="upload-icon"><img src="<?php echo SITE_BASE_URL ?>assets/admin/images/loader.gif" /></div>
				</div>
			</div>
		  </div>
		  <p style="text-align:center; color:red">** Note: File size should be less than 4MB. Accepted formats: .csv, .xls, .xlsx</p>
		</div>
	</div>
</div>
<script>
let dropArea = document.getElementById('upload-file');
var fileselect = document.getElementById('browse_file');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)
});
function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}
['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
});
['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
});
function highlight(e) {
  dropArea.classList.add('highlight');
}
function unhighlight(e) {
  dropArea.classList.remove('highlight')
}
dropArea.addEventListener('drop', handleDrop, false);
dropArea.addEventListener('click', clickUpload, false);
fileselect.addEventListener('change', handleSelect, false);
function clickUpload(){
	fileselect.click();
}
function handleDrop(e) {
  let dt = e.dataTransfer;
  let files = dt.files;
  let length = files.length;
  if(length > 1){
 	alert('Multiple files not allowed');
  }else{
    handleFiles(files);
  }
}
function handleSelect(e) {
  let files = e.target.files;
  let length = files.length;
  if(length > 1){
 	alert('Multiple files not allowed');
  }else{
    handleFiles(files);
  }
}
function handleFiles(files) {
	if(files.length > 0){
		alert('File ' + files[0].name + ' selected. Ready for processing.');
	}
}
</script>
