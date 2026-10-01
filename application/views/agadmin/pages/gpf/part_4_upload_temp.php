
<div class="row-fluid">
	 <div class="block">
		<div class="navbar navbar-inner block-header">
		  <div class="muted pull-left">Upload file of Part IV</div>
		  <div class="header-btn-wrap"><button class="btn btn-primary" onclick="downloadSample('sample_ac_slip_part_4.xls')"><i class="icon-download icon-white"></i> Download  sample file</button></div>
		</div>
		<div class="block-content collapse in">
		  <div class="span12">
		  	<div class="uplaod-container">
				<div id="upload-file" class="upload-file">
					<div class="upload-icon">
						<i class="fa fa-cloud-upload-alt" style="font-size:50px;"></i>
					</div>
					<div>
						Drag file here or click to browse
						<form enctype="multipart/form-data">
							<input id="browse_file" type="file" style="display:none" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
						</form>
					</div>
					<div>
						
					</div>
				</div>
				<div id="upload-status" class="upload-status">
					<div id="loader_message" class="upload-icon"><img src="<?php echo SITE_BASE_URL ?>assets/admin/images/loader.gif" /></div>
				</div>
			</div>
		  </div>
		  <p style="text-align:center; color:red">** Note: File size should be less than 4MB</p>
		</div>
	</div>
</div>
<script>
function downloadSample($sample_file){
	window.open('<?php echo SITE_BASE_URL ?>excel/sample/'+$sample_file,'_blank');
}
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
})

;['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
})

function highlight(e) {
  dropArea.classList.add('highlight');
}

function unhighlight(e) {
  dropArea.classList.remove('highlight')
}
//dropArea.addEventListener('dragenter', handlerFunction, false);
//dropArea.addEventListener('dragleave', handlerFunction, false);
//dropArea.addEventListener('dragover', handlerFunction, false);
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
  let type = files[0].type;
  var allowedTypes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'];
  var file = this.files[0];
  var fileType = file.type;
  if(length > 1){
 	alert('Multiple file not allowed');
  }else if(!allowedTypes.includes(fileType)){
  	alert('Only CSV files allowed');
  }else{
   handleFiles(files);
  }
}
function handleSelect(e) {
  let files = e.target.files;
  console.log(files);
  let length = files.length;
  let type = files[0].type;
  var allowedTypes = ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'];
  var file = this.files[0];
  var fileType = file.type;

  if(length > 1){
 	alert('Multiple file not allowed');
  }else if(!allowedTypes.includes(fileType)){
  	alert('Only CSV files allowed');
  }else{
   handleFiles(files);
  }
}

function handleFiles(files) {
  ([...files]).forEach(uploadFile)
}
function uploadFile(file) {
	$('#upload-file').hide();
	$('#upload-status').show();
  var url = '<?php echo ADMIN_BASE_URL ?>gpf/part_4_ajax_upload_temp';
  var xhr = new XMLHttpRequest();
  var formData = new FormData();
  xhr.open('POST', url, true);

  xhr.addEventListener('readystatechange', function(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Done. Inform the user
	  var response = JSON.parse(xhr.response);
	  $('#loader_message').html('<p>'+response.message+'</p>');
    }
    else if (xhr.readyState == 4 && xhr.status != 200) {
      // Error. Inform the user
	   console.log(xhr.response);
    }
  });
  formData.append('file', file);
  formData.append('<?=$csrf['name'];?>', '<?=$csrf['hash'];?>');
  xhr.send(formData)
}
</script>


