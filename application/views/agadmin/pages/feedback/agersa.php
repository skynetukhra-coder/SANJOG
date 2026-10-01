<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Feedback</div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <div class="table-scroll">
           <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
				<th>Personal Details</th>
				<th>Purpose of Visit</th>
                <th style="width:50%">Comments</th>
				<th>Rating</th>
				<th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo '<b>Name:</b> '.$row['name'].'<br/><b>Email:</b> '.$row['email'].'<br/><b>Mobile:</b> '.$row['mobile'] ?></td>
							<td>
								<?php echo '<b>Office:</b> '.$row['office'];?>
							 </td>
							<td><?php echo $row['details'] ?></td>
							<td>
								<?php 
									echo '<img src="'.base_url().'assets/images/'.intval($row['overall_service_rating']).'.png"/>';
								?>
							</td>
							<td>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['feed_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="6">No data found!</td></tr>';
					}
				?>
            </tbody>
          </table>
          </div>
        </div>
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function updateFeedback(id){
	var visit_for = $('input[name=visit_for]:checked').val();
	$('#visit_for_'+id).html(visit_for);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/feedback/update/'+id,{'visit_for':visit_for,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
	
}
function goEdit(id){}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>feedback/agersa_delete/'+id;
		}
		
	}
}
</script>