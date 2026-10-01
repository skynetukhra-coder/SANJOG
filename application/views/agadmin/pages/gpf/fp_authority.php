<div class="row-fluid">
  <div class="span12" id="content">
  	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Name,GPF A/C no,Authority no,Letter no"/>
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
		</div>
	</div>
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Final payment authority</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/fp_authority_upload'"><i class="icon-upload icon-white"></i> Upload FP Authority</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>&nbsp;</th>
				<th>#</th>
                <th>Authority no</th>
                <th>GPF no</th>
				<th>Name</th>
                <th>Amount</th>
				<th>Letter no</th>
				<th>Treasury</th>
				<th>Nominee</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<td style="width:10px"><button class="btn btn-small btn-primary" onclick="get_details('<?php echo $row['request_no'] ?>')"><i class="icon-plus icon-white"></i></button></td>
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['authority_no'] ?></td>
							<td><?php echo $row['series'].'/WB/'.$row['ac_code'] ?></td>
							<td><?php echo $row['subscriber_name'] ?></td>
							<td><?php echo $row['amt_topay'] ?></td>
							<td><?php echo $row['letter_no'] ?></td>
							<td><?php echo $row['try_name'] ?></td>
							<td>
								<?php 
								if(trim($row['nominee_name']) != ''){
									echo get_gpf_fp_authority_nominee($row['authority_no']);
								}else{
									echo $row['nominee_guardian_name'];
								}?>
							</td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="7">No data found!</td></tr>';
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
<script>
function get_details(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	$.get('<?php echo base_url()?>admin/gpf/fp_authority_details/'+id,function(data){
		 var obj = $.parseJSON(data);
		 if(obj.success == false){
		 	alert(obj.msg);
		 }
		 var details = obj.details;
		 var html = '<table>';
		 var i = 0;
		 for(row in details[0]){
		 	if(row != 'fp_a_id'){
				var value = details[0][row];
				if(row == 'authority_no'){
					if(details[1][row] != undefined){
						value += '<br/>'+details[1][row];
					}
					if(details[2][row] != undefined){
						value += '<br/>'+details[2][row];
					}
				}else if(row == 'nominee_name'){
					if(details[1][row] != undefined){
						value += '<br/>'+details[1][row];
					}
					if(details[2][row] != undefined){
						value += '<br/>'+details[2][row];
					}
				}else if(row == 'nominee_guardian_name'){
					if(details[1][row] != undefined){
						value += '<br/>'+details[1][row];
					}
					if(details[2][row] != undefined){
						value += '<br/>'+details[2][row];
					}
				}
		 	 	html += '<tr><td>'+row.toUpperCase()+'</td><td>'+value+'</td><tr>';
			}
		 }
		 html += '</table>';
		 $('#row_details').html(html);
		 $("#myModal").modal("toggle");
	});
}
</script>