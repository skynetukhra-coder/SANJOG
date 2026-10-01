<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<div>
	<div class="row-fluid">
		<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
			<div class="block-content">
				<form method="get">
				  <div class="row-fluid">
				  <div class="control-form" style="padding-right:40px;">
					 <label class="control-label">Reply Date *</label>
						<div class="controls">
							 <input type="text" name="date_filter" value="<?php echo date('Y-m-d')?>" data-required="1" class="datepicker" data-provide="datepicker" autocomplete="off" placeholder="DD-MM-YYYY" />
						</div>
				  </div>
				  <div class="control-form" style="padding-right:40px;">
					 <label class="control-label">Status </label>
						<div class="controls">
							<select class="form-control" name="vstatus" id="vstatus" >
								<option value="">-----Select  Type----</option>
								<option value="A" >All</option>
								<option value="P" >Pending</option>
								<option value="I" >In-Progress</option>
								<option value="R" >Returned</option>
								<option value="C" >Cleared</option>
							</select>						
						</div>
				  </div>
				  <div class="control-form">
					<label class="control-label">Search</label>
					<div class="controls">
					 <input type="text" name="search" value="<?php echo $this->input->get('search',true)?>" placeholder="Search ......."/>
					</div>
				  </div>
				  </div>
				  <div class="row-fluid">
					<div class="control-form">
						<label class="control-label">&nbsp;</label>
						<div class="controls">
							<input type="submit" value="Filter" />
						</div>
					 </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
				  </div>
				</form>
			</div>
		</div>	
		<div class="block" style="padding:10px 0; border-top:1px solid #ccc">
			<div class="block-content">
			   <form id="downReport" method="post" action="<?php echo ADMIN_BASE_URL ?>gpf/missing_reports_download" >
			   <div class="row-fluid">
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
                        <label class="control-label">Status </label>
                        <div class="controls">
                            <select class="form-control" name="rstatus" id="rstatus" >
								<option value="">-----Select  Type----</option>
								<option value="" >All</option>
								<option value="Pending" >Pending</option>
								<option value="In-Progress" >In-Progress</option>
								<option value="Returned" >Returned</option>
								<option value="Cleared" >Cleared</option>
<!--							
								<option value="P" >Pending</option>
								<option value="I" >In-Progress</option>
								<option value="R" >Returned</option>
								<option value="C" >Cleared</option>
-->
							 </select>
                        </div>
                    </div>
				</div>
				<div class="row-fluid">
					<div class="control-form">
						<label class="control-label">&nbsp;</label>
						<div class="controls">
							<input type="submit" value="Download Report" />
						</div>
					 </div>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="clearfix"></div>
				</div>
               </form>
			</div>
		</div>
	</div>	
</div>
<div class="row-fluid">
	<div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Missing Credits Action</div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
         <div class="table-scroll">
          <table class="table table-bordered">
            <thead>
              <tr>
        		<th>#</th>
				<th>Reply Date</th>
                <th>Series</th>
                <th>Account No</th>
				<th>Missing Month/Year</th>
                <th>File</th>				
				<th>Major Head</th>
				<th>Description</th>
				<th>Trea. Code</th>
				<th>Treasury</th>
				<th>DDO</th>
				<th>DDO Code</th>
				<th>Subs Amt</th>
				<th>T.V. No.</th>
				<th>T.V. Dt.</th>
				<th>Remarks</th>
				<th>Status</th>
				<th>Action Date</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			  	<?php
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){
							$id = $row['id'];
							$missing_id = $row['missing_id'];
							$series = $row['series'];
							$accno = $row['accno'];
							$misscrdr = $row['misscrdr'];
							$misscdmnth = $row['misscdmnth'];
							$samt = $row['samt'];
							$ramt = $row['ramt'];
							$remarks = $row['remarks'];
							$reply_date = $row['reply_date'];
							$clear_date = $row['clear_date'];
							$mc = $row['mcode'];
							$ph = $row['payhead'];
							$tc = $row['tcode'];
							$tr = $row['treasury'];
							$dc = $row['dcode'];
							$dd = $row['ddo'];
							$sa = $row['samt'];
							$tn = $row['tvno'];
							$td = $row['tvdt'];
							$ppath= $row['file_location'];
							$inu=strpos($ppath,'/');
							$ppath=substr($ppath,$inu + 1,strlen($ppath));
							$rsts = $row['reply_sts'];
							$udt = Date('d-m-Y',strtotime($row['datetime']));
							if ($rsts=='C') {$st='Cleared';}
							if ($rsts=='R') {$st='Returned';}
							if ($rsts=='P') {$st='Pending';}
							if ($rsts=='I') {$st='In-Progress';}
							$fl=BASE_URL().$row['file_location'];
							
							?>
						 <tr>
						 	<!--<td style="width:10px"><button class="btn btn-small btn-primary" onclick="get_details('<?php echo $row['request_no'] ?>')"><i class="icon-plus icon-white"></i></button></td>-->
						 	<td><?php echo $sl++ ?></td>
							<td><?php echo get_datepicker_date($row['reply_date']) ?></td>
							<td><?php echo $row['series'] ?></td>
							<td><?php echo $row['accno'] ?></td>
							<td><?php //echo $row['misscdmnth'] ?><?php echo $row['misscrdr'] ?></td>
							<td><a href="<?php echo $fl; ?>" target="_blank"><i class="glyphicon glyphicon-zoom-in text-green"></i><?php //echo $ppath ?><img src="https://agwb.cag.gov.in/assets/images/PDF.png" style="max-height:35px;"/></a></td>
							<td><?php echo $row['mcode'] ?></td>
							<td><?php echo $row['payhead'] ?></td>
							<td><?php echo $row['tcode'] ?></td>
							<td><?php echo $row['treasury'] ?></td>
							<td><?php echo $row['dcode'] ?></td>
							<td><?php echo $row['ddo'] ?></td>
							<td><?php echo $row['samt'] ?></td>
							<td><?php echo $row['tvno'] ?></td>
							<td><?php echo $row['tvdt'] ?></td>
							<td><?php echo $row['remarks'] ?></td>
							<td><?php echo $st ?></td>
							<td><?php echo get_datepicker_date($row['clear_date']) ?></td>
<!--						<td><?php echo $udt ?></td>		-->
							<td style="text-align:right"><button style="font-size:24px" onclick="get_details('<?php echo $id ?>,<?php echo $missing_id ?>,<?php echo $series ?>,<?php echo $accno ?>,<?php echo $misscrdr ?>,<?php echo $misscdmnth ?>,<?php echo $samt ?>,<?php echo $ramt ?>,<?php echo $reply_date ?>')"><i class="fa fa-edit" style="font-size:18px;color:#275E93" aria-hidden="true"></i></button></td>
						</tr>
				<?php
						}
					}else{
						echo '<tr><td colspan="17">No data found!</td></tr>';
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

<!-- Modal -->
<div id="Updt_Rec" class="modal fade" tabindex="-1" role="dialog" style="width: 35%; height: 50%;">
	<div class="modal-dialog" >
		<div class="modal-content" style="width: 100%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h5 class="modal-title" id="UpdateModal">Update Information for Missing Credit</h5>
			</div>
			<div class="modal-body">
				<form class="control-form" id="updmiss" name="updmiss" method="post" class="was-validated">
						<div >
							<div class="form-group">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Series</th>
											<th>Account No</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" class="form-control pull-left"  max="6" name="ser"	id="ser" tabindex="1" placeholder="Series"  readonly> </td>
											<td><input type="text" class="form-control pull-left"  max="6" name="acc"	id="acc" tabindex="2" placeholder="Account No" readonly> </td>
											<td><input type="hidden" class="form-control pull-left"  max="6" name="reply_date"	id="reply_date" readonly> </td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Missing Year</th>
											<th>Missing Month</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" class="form-control pull-left"  max="6" name="misscrdr"	id="misscrdr" tabindex="3" placeholder="misscrdr" readonly> </td>
											<td><input type="text" class="form-control pull-left"  max="6" name="misscdmnth"	id="misscdmnth" tabindex="3" placeholder="misscdmnth" readonly> </td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Subscription Amount</th>
											<th>Recovery Amount</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" class="form-control pull-left"  max="6" name="samt"	id="samt" tabindex="3" placeholder="Subscription" readonly> </td>
											<td><input type="text" class="form-control pull-left"  max="6" name="ramt"	id="ramt" tabindex="3" placeholder="Recovery" readonly> </td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<input type="hidden" class="form-control pull-right"  name="id"	id="id" tabindex="1" placeholder="id" readonly>
							<input type="hidden" class="form-control pull-right"  name="mid"	id="mid" tabindex="1" placeholder="mid" readonly>
							
							<div class="form-group">
									<label for="missmonth">Missing Month</label>
									<select  class="form-control  " name="sts" required tabindex="4">
										<option value="I">In-Progress</option>
										<option value="C">Clear</option>
										<option value="R">Return</option>
									</select>
							</div><!-- /.form group -->
							<div style ="form-group">
								<label for = "replyremarks">Reply Remarks</label>
								<textarea class="form-group" tabindex="5" cols="100" rows="3" name="remarks" id="remarks"></textarea>
							</div>	
						</div>
						
						<div class="modal-footer">
							<div class="form-group" align="center" >
								<div class="input-group" >
									<div class="col-md-12 col-xs-12 text-center"><input type="submit" class="btn btn-primary" data-toggle="modal" name="Update" value="Update" onclick="submitReplyForm(); ReLoadWindow()"></div>
								</div>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'}); 
});
function get_details(id){
	if(id == undefined){
		alert('Wrong input!');
	}
	var fields = id.split(',');
	var id = fields[0];
	var mid = fields[1];
	var series = fields[2];
	var accno = fields[3];
	var misscrdr = fields[4];
	var misscdmnth = fields[5];
	var samt = fields[6];
	var ramt = fields[7];
	var reply_date = fields[8];
	var uid =(id);
	var sess = "<?php $_SESSION['unid']="+id+"; ?>";
	$("#id").val(id);
	$("#unid").val(id);
	$("#mid").val(mid);
	$("#ser").val(series);
	$("#acc").val(accno);
	$("#misscrdr").val(misscrdr);
	$("#misscdmnth").val(misscdmnth);
	$("#samt").val(samt);
	$("#ramt").val(ramt);
	$("#reply_date").val(reply_date);
	$("#Updt_Rec").modal("toggle");
}

function submitReplyForm(){
	$.ajax({
			type: "POST",
			//url: "<?php echo base_url()?>application/views/agadmin/pages/gpf/missreplyqry.php" ,
			url: "<?php echo base_url()?>sus/admin/gpf/missreplyqry.php" ,
			cache:false,
			data: $('form#updmiss').serialize(),
			success: function(response){
				$("#Updt_Rec").html(response)
				$("#Updt_Rec").modal('hide');
			},
			error: function(){
				$("#Updt_Rec").modal('hide');
			}
		});
	}	

function ReLoadWindow() {
    var dt = document.getElementById('reply_date').value;
        window.location.href = '<?php echo base_url()?>admin/gpf/missingcract/' + dt;
}
/*
function ReLoadWindow1(){
     window.location.href = '<?php echo base_url()?>admin/gpf/missingcract' ;
}
*/
$(function () {
   $('#modal').modal('toggle');
});

</script>