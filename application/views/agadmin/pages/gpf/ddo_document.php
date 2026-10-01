<div class="row-fluid">
	<div class="span12" id="content">
		<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
		<div class="block-content">
			<form method="get">
			  <div class="control-form">
				<label class="control-label">Search</label>
				<div class="controls">
				 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search ......."/>
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
	<div class="row-fluid">
    <div class="span12" id="filter-content">
        <div class="block">
            <div class="block-content">
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/treasury_reports_download">
                    <div class="control-form">
                        <label class="control-label">From </label>
                        <div class="controls">
                            <input type="text" name="date_from" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">To</label>
                        <div class="controls">
                            <input type="text" name="date_to"  data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                    <div class="control-form" style="padding-right:40px;">
                        <label class="control-label">Document Type </label>
                        <div class="controls">
                            <select class="form-control" name="drec_type" required>
								<option value="">-----Select  Type----</option>
								<option value="GPF No Allotment" >New GPF No Allotment</option>
								<option value="Nomination" >Nomination Application</option>
								<option value="Missing Credit" >Adjustment of Missing Credit.</option>
								<option value="Missing Debit" >Adjustment of Missing Debit.</option>
							 </select>
                        </div>
                    </div>
					<div class="control-form" style="padding-right:40px;">
                        <label class="control-label">DDO Code</label>
                        <div class="controls">
							<input  name="ddo_cd" value=""  />
<!--						
                            <select name="ddo_cd" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($ddo_list) && !empty($ddo_list)){
									foreach($ddo_list as $ddos){
										echo '<option value="'.$ddos['ddo_cd'].'">'.$ddos['ddo_cd'].'</option>';
									}
								}
								?>
							</select>
-->
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Reports" />
                        </div>
                    </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
                </form>
            </div>
		  </div>
		</div>
	</div>
	<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">List of DDO Documents</div>

			</div>
			<div class="block-content collapse in">
				<div class="span12">
                  <div class="table-scroll">
					<table class="table table-bordered" >
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">Sl No</th>
								<th style="text-align:center">Submission Date</th>
								<th style="text-align:center">Year</th>
								<th style="text-align:center">GPF A/c No</th>
								<th style="text-align:center">Nature</th>
								<th style="text-align:center">DDO Remarks</th>
								<th style="text-align:center">Document</th>
								<th style="text-align:center">Status</th>
								<th style="text-align:center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){?>
							<tr >
								<td style="text-align:center"><?php echo $sl++ ?></td>
								<td style="text-align:center"><?php echo date('d-m-Y',strtotime($row['upload_dt'])) ?></td>
								<td><?php echo $row['drec_month'] ?>, <?php echo $row['drec_year'] ?></td>
								<td ><?php echo $row['sub_series'] ?> / WB/ <?php echo $row['sub_ac_code'] ?></td>
								<td ><?php echo $row['drec_type'] ?></td>
								<td ><?php echo $row['drec_type'] ?></td>
								<td style="text-align:center">
									<?php 
										if(trim($row['ddo_attachment']) != '')	{
											$attachments = explode(';',$row['ddo_attachment']);
												foreach($attachments as $filename){
													echo '<a target="_blank" href="'.base_url().'files/agae/department/'.$filename.'"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a> &nbsp;';
												}	
											}
										?>
								</td>
								<td style="text-align:center"><?php echo $row['drecd_status'] ?></td>
								<td style="text-align:center">	
										<button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['ddo_rec_id'] ?>')"><i class="icon-pencil icon-white"></i> Update</button>
										<button class="btn btn-mini btn-danger" onclick="goDelete('<?php //echo $row['ddo_rec_id'] ?>')"><i class="icon-remove icon-white"></i> Delete</button>
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
function goEdit(id,type){
	if(id != undefined){
		window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/ddo_document_edit/'+id;
	}
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo ADMIN_BASE_URL ?>gpf/ddo_document_delete/'+id;
		}
		
	}
}
</script>