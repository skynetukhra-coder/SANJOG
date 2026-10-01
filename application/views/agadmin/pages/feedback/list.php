<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="get">
                    <div class="control-form">
                        <label class="control-label">Search</label>
                        <div class="controls">
                            <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>"
                                placeholder="Search ......." />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Filter" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>feedback/all_feedback_status">
                    <div class="control-form">
                        <label class="control-label">Feedback Status</label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">to</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Feedback Status</label>
                        <div class="controls">
                            
								<select id="status" name="status" class="form-control" >
									<option value=""> -- Select Status--</option>
									<option data-value="1" value="active"<?php echo $this->input->get('status') == 'active' ? 'selected' : ''?> > Active </option>
									<option data-value="2" value="close"<?php echo $this->input->get('status') == 'close' ? 'selected' : ''?> >Close</option>
								</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Feedback" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                <th style="width:20%">Comments</th>
				<th>Interaction / Rating </th>
				<th>Service / Rating</th>
				<th>Feedback Date</th>
				<th>Feedback Status</th>
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
								<?php echo '<b>Visit For:</b> <span id="visit_for_'.$row['feed_id'].'">'.trim($row['visit_for']).'</span>';
									echo $row['ppo_no_file_id_application_no'] !='' ? '<br><b>PPO No./File Id/Application No.:</b> '.$row['ppo_no_file_id_application_no'] : '';
									echo $row['gpf_no'] !='' ? '<br><b>GPF A/C No.:</b> '.$row['gpf_no'] : '';
									echo $row['office'] !='' ? '<br><b>Office:</b> '.$row['office'] : '';
							   ?>
							 </td>
							<td><?php echo $row['details'] ?></td>
							<td>
								<?php 
									if(strtolower($row['interected_to_office']) == 'yes'){
										echo '<b>By Email: </b><img src="'.base_url().'assets/images/'.intval($row['rate_of_interact_email']).'.png"/>';
										echo '<br><b>By Phone: </b><img src="'.base_url().'assets/images/'.intval($row['rate_of_interact_phone']).'.png"/>';
										echo '<br><b>Direct Visit: </b><img src="'.base_url().'assets/images/'.intval($row['rate_of_interact_direct']).'.png"/>';
									}else if(strtolower($row['interected_to_office']) == 'no'){
										echo '<strong>Not Interacted</strong>';
									}
								?>
							</td>
							<td>
								<?php 
									echo '<b>Receive SMS/Email: </b><em>'.$row['receive_sms_email'].'</em>';
									echo '<br><b>Service Rating: </b><img src="'.base_url().'assets/images/'.intval($row['service_rating']).'.png"/>';
									echo '<br><b>Overall Rating: </b><img src="'.base_url().'assets/images/'.intval($row['overall_service_rating']).'.png"/>';
								?>
							</td>
							<td><?php echo date('d-m-Y',strtotime($row['feed_date']))?></td>
							<td><?php echo $row['status'] ?></td>
							<td style = "width: 7%; text-align: right">
								<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['feed_id'] ?>')"><i class="icon-pencil icon-white"></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;</button><br>
								<button class="btn btn-mini btn-warning" onclick="goClose('<?php echo $row['feed_id'] ?>')"><i class="icon-pencil icon-white"></i>Close&nbsp;</button></br>
								<button class="btn btn-mini btn-danger" onclick="goDelete('<?php echo $row['feed_id'] ?>')"><i class="icon-remove icon-white"></i>Delete</button>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="9">No data found!</td></tr>';
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
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
function goClose(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>feedback/admin_feedback_close/' + id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>feedback/delete/'+id;
		}
		
	}
}

function goEdit(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	type = $('#visit_for_'+id).html();
	var html = '<div class="control-form">';
	html += '<label class="control-label" style="font-weight:bold">Purpose of Visit :</label>';
	html += '<div class="controls">';
	html += '<label><input type="radio" name="visit_for" '+ (type == 'General' ? 'checked' : '') +' value="General" style="margin: 0 5px;">General</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Administrative' ? 'checked' : '') +' value="Administrative" style="margin: 0 5px;">Administrative</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Provident Fund' ? 'checked' : '') +' value="Provident Fund" style="margin: 0 5px;">Provident Fund</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Pension' ? 'checked' : '') +' value="Pension" style="margin: 0 5px;">Pension</label>';
    html += '<label><input type="radio" name="visit_for" '+ (type == 'Accounts' ? 'checked' : '') +' value="Accounts" style="margin: 0 5px;">Accounts</label>';
	html += '</div>';
	html += '</div>';
	html += '<br/>';
	html += '<div class="control-form">';
	html += '<div class="controls">';
	html += '<input type="submit" value="Update" onclick="updateFeedback('+id+')" />';
	html += '</div>';
	html += '</div>';
	$('#row_details').html(html);
	$("#myModal").modal("toggle");
}
function updateFeedback(id){
	var visit_for = $('input[name=visit_for]:checked').val();
	$('#visit_for_'+id).html(visit_for);
	$("#myModal").modal("toggle");
	$.post('<?php echo base_url()?>admin/feedback/update/'+id,{'visit_for':visit_for,'<?php echo $csrf['name'];?>':'<?php echo $csrf['hash'];?>'},function(data){
		var obj = $.parseJSON(data);
		alert(obj.msg);
	});
	
}


</script>