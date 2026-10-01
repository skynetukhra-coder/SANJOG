</div>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/vendors/jquery-1.9.1.js"></script>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/assets/scripts.js"></script>
<script>
  function reload_captcha(){
	  $.get('<?php echo base_url()?>ajax/regenerate_captcha',function(data){
	    var res = $.parseJSON(data);
	    var image = '<?php echo base_url()?>'+res.image;
	    $('#capId').attr('src',image);
	  });
 }
</script>
</body>
</html>