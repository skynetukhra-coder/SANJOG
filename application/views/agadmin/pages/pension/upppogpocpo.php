<link href="<?php echo base_url()?>pension/css/fileupload.css" rel="stylesheet">
<script src="<?php echo base_url()?>pension/js/fileupload.min.js"></script>

<div class="card shadow mb-4">
	<div class="card-body">
		<span style = "font-size: 13px; weight;bold; color: red">Maximum No of PDF : 200 and Maximum Size : 280 MB</span>
		<div class="table-responsive">
			<div id="mulitplefileuploader">Upload</div>
			<div id="status"></div>
		</div>
	</div>
</div>
<?php
$_SESSION['ppopath']=base_url().'pension/PPO/';
//echo base_url();
//echo getcwd();
?>

<script>

	$(document).ready(function()
	{
		var settings = {
			url: "<?php echo base_url()?>pension/ppouploadact.php",
//			url: "https://agwb.cag.gov.in/pension/ppouploadact.php",
			method: "POST",
			allowedTypes:"pdf",
			fileName: "myfile",
			multiple: true,
			onSuccess:function(files,data,xhr)
			{
				$("#status").html("<font color='green'>PPO/GPO/CPO Uploaded successfully</font>");

			},
			onError: function(files,status,errMsg)
			{
				$("#status").html("<font color='red'>PPO/GPO/CPO Upload failed</font>");
			}
		}
		$("#mulitplefileuploader").uploadFile(settings);
	});
</script>