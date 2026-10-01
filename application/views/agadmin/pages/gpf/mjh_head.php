<div class="row-fluid">
  <div class="span12" id="content">
  	<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="GPF A/C no,Month,Remarks"/>
				</div>
			  </div>
			  <div class="control-form">
				<label class="control-label">Series</label>
				<div class="controls">
				 <input type="text" name="series" id="series" value="<?php echo $this->input->get('series',true)?>" placeholder="Series"/>
				</div>
			  </div>
			  <div class="control-form">
				<label class="control-label">AC Code</label>
				<div class="controls">
				 <input type="text" name="accno" id="accno" value="<?php echo $this->input->get('accno',true)?>" placeholder="Ac code"/>
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
        <div class="muted pull-left">Major Heads</div>
		<div class="header-btn-wrap"><button class="btn btn-success" onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/mjh_head_upload'"><i class="icon-upload icon-white"></i> Upload CSV</button></div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
        		<th>#</th>
                <th>Major Head</th>
                <th>Description</th>
				<!--<th>Action</th>-->
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
						 <tr>
						 	<!--<td style="width:10px"><button class="btn btn-small btn-primary" onclick="get_details( echo $row['request_no'] ?>')"><i class="icon-plus icon-white"></i></button></td>-->
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo $row['mjrhd'] ?></td>
							<td><?php echo $row['mjrhddesc'] ?></td>
							<!--<td>ACTION</td>-->
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