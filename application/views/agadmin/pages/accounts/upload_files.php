
<div class="row-fluid">
	 <div class="block">
		<div class="navbar navbar-inner block-header">
		  <div class="muted pull-left">Upload files</div>
		</div>
		<div class="block-content collapse in">
		  <div class="span12">
		  	<div class="uplaod-container">
				<div>
					<div class="upload-icon" style="cursor:pointer" onclick="open_fms_file_location('accounts')">
						<i class="fa fa-cloud-upload-alt" style="font-size:50px;"></i>
					</div>
					<div>
						<div style="color:red">Note: ** USE ONLY <span style="color:green">files/accounts</span> LOCATION FOR UPLOAD FILE.</div>
					</div>
					<div>
						
					</div>
				</div>
				<div id="upload-status" class="upload-status">
					<div id="loader_message" class="upload-icon"><img src="<?php echo SITE_BASE_URL ?>assets/admin/images/loader.gif" /></div>
				</div>
			</div>
		  	
		  </div>
		</div>
	</div>
</div>
<script>

function open_fms_file_location (id_input){
	window.KCFinder = {};
    window.KCFinder.callBack = function(url) {
		document.getElementById(id_input).value = url;
        // Actions with url parameter here
        window.KCFinder = null;
    };
    window.open('/agwb/editor/fms/browse.php?type=files&dir=files/accounts', 'kcfinder_single','width=800,height=500');
}

</script>


