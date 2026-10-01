<script src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script type="text/javascript">
window.setTimeout(function () {
  window.location.reload();
}, 150000);
</script>

<div id= "show_msg" class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_application'); ?> </div>
			<div class="msg_cont">
				<div class="success">
					<?php if(isset($success) && !empty($success)){
						echo '<div class="msg">'.$success.'</div>';
					  }else if($this->session->flashdata('success')){
					  	echo '<div class="msg">'.$this->session->flashdata('success').'</div>';
					  }
				 ?>
				</div>
				<div class="err">
					<?php if(isset($error) && !empty($error)){
						echo '<div class="msg">'.$error.'</div>';
					  }else if($this->session->flashdata('error')){
					  	echo '<div class="msg">'.$this->session->flashdata('error').'</div>';
					  }
				 ?>
				</div>
			</div>
			<div class="login-box">
				<div class="application-formwrap">
					<form method="post">
						<div class="row">
						<div class="col-sm-12">
							<div class="top-box">
							<h2 style = "text-align:center; color: orange; padding-bottm: 3px; font-family: Georgia;" >OFFICIAL MESSAGES</h2>
								<div class="row">
									<div id="other_exam_name" class="row" style="display:none;">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
											
											</div>
										</div>
									</div>
								</div>
							</div>
					<div class="row">
					<table class="table1" border="0" style="width:100%">
						<tbody>
							<?php
							if(!empty($emp_messages)){?>		
										<?php
											foreach($emp_messages as $row){?>
												<tr>
													<?php 
													if(trim($row['receiver_id']) !== trim($profile['empid'])){ 
													?>
													<td class="chat-box-container darker">
														<span class="time-right"><img width="40" height="40"  style = "border-radius:50%;" src="<?php echo base_url()?>/files/agae/picture/<?php echo $row['picture']?>" /></span>
														<span class="time-right" style = "color: grey; font-size: 12px; padding-right: 5px;" >Sender : <?php echo $row['empname'] ?></span>
														<span style = "color: grey; font-size: 12px">
															<?php  if($row['read_unread'] =='Read'){?>
															<img width="20px" height="20px" src="<?php echo base_url()?>assets/images/read.png" alt=""  />
															<?php }else{} ?>
														</span>
														<span style = "text-align: right;"><br><p style = "padding-right: 90px; font-family: arial;"> <?php echo $row['message'] ?></p></br> </span>
														<p class="time-left">To :<?php echo $row['received_by'] ?> [<?php echo $row['createdAt'] ?>]</p>
													</td>																							
													<?php }else{ ?>
													<td class="chat-box-container">
														<span class="left"><img width="40" height="40"  style = "border-radius:50%;" src="<?php echo base_url()?>/files/agae/picture/<?php echo $row['picture']?>" /></span>
														<span style = "color: grey; font-size: 12px">From : <?php echo $row['sent_by'] ?></span>
														<span class="time-right" style = "color: grey; font-size: 12px">
															<?php  if($row['read_unread'] =='Read'){?>
															<img width="20px" height="20px" src="<?php echo base_url()?>assets/images/read.png" alt=""  />
															<?php }else{} ?>
														</span>
														<span><p style = "font-family: arial;" ><?php echo $row['message'] ?></p></span>
														<p class="time-right">[<?php echo $row['createdAt'] ?>]</p>
													</td>
													<?php } ?>
													
													<td style = "width: 7%">
														<?php 
														if(trim($row['sender_id']) !== trim($profile['empid'])){ 
														?>
														<img onclick="goRead('<?php echo $row['msg_id'] ?>')" width="40px" height="40px"  title="Mark Read" src="<?php echo base_url()?>assets/images/read1_icon.png" alt=""  />
														<?php } ?>
														<img onclick="goDelete('<?php echo $row['msg_id'] ?>')" width="40px" height="40px"  title="Delete Message" src="<?php echo base_url()?>assets/images/del3_icon.jpg" alt=""  />
													</td>
												</tr>
												<tr style = "height: 4px;">
													<td>
														<p>&nbsp;</p>
													</td>
												</tr>
										<?php		
											}
										?>
							<?php
							}else{?>
							<tr>
								<td colspan="2">No data found!</td>
							</tr>
						<?php
							}?>
							</tbody>
					</table>				
	<!--    Message Box  ----->
					<button class="open-button btn-success" onclick="openForm()">W R I T E</button>
					<div class="chat-popup" id="myForm">
					  <form action="/action_page.php" autocomplete = "off" class="chat-container">
						<h1 class = "medium" style = "color: #fff; text-align: center;">Message</h1>
						<hr class = "rounded" />
						<div>
						<span><label  for="msg"><b>To</b></label></span>

<!--This will show employee list with checkbox
						
						<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</span>
						<span>
							<div class="filter" style="display: inline-block; margin: 0px 0px 0px 10px;">
								  <input id="selected-only1" type="checkbox" onclick="checkSelectedOnly1()" /> &nbsp; Selected Only
							</div>
						</span>					
						<span>
							<div class="epmloyees-list" style=" border: 3px solid #ddd; width:100%; max-height: 150px; overflow: auto;" required >
								 <?php
									  foreach($employees as $emp){
										echo '<div class="emp-row" data-designation="'.strtolower($emp['desig']).'"><input type="checkbox" name="receiver_id['.$emp['empid'].']" value="'.$emp['empname'].'" />&nbsp; '.$emp['empname'].'  ['.$emp['empid'].'  ]</div>';
									  }?>
							  </div>
						</span>
 -->							
<!--This will autocomplete list with checkbox 	-->			
						<span>
							<input style="width:100%;" type="text"  name="received_by" id="EpName" autofocus placeholder="Type & Select Name" />
							<input style="width:100%; background: grey;" type="hidden"  name="receiver_id" id="EpId"  readonly />
						</span>

						</div>
						<textarea class  = "chat-textarea" placeholder="Type your message here....." name="message" required></textarea>

						<button type="submit" class="btn btn-success">Send</button>
						<button type="button" class="btn btn-danger" onclick="window.location.reload(); closeForm();">Close</button>
					  </form>
					</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div>
				</form>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type='text/javascript'>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});

function checkSelectedOnly1(){
  let isChecked = $('#selected-only1').is(':checked');
  $('.emp-row').each(function(i){
    if(isChecked){
      if(!$(this).find('input').prop('checked')){
        $(this).css('display','none');
      }
    }else{
      $(this).css('display','block');
    }
  });
}
function goRead(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo SITE_BASE_URL ?>emp/message_read/'+id;
    }
}
function goDelete(id){
	if(id != undefined){
		var conf = confirm('Do you want to delete?');
		if(conf){
			window.location.href = '<?php echo SITE_BASE_URL ?>emp/message_delete/'+id;
		}
		
	}
}

$( "#EpName" ).autocomplete({
        source: function( request, response ) {
          var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = $('.txt_csrfname').val(); // CSRF hash
          $.ajax({
            url: "<?=base_url()?>emp/empList",
            type: 'get',
            dataType: "json",
			data: {elist: request.term},
            success: function( data ) {
//				alert(JSON.stringify(data));
              response( data );
            }
          });
        },
//		appendTo : $('#Updt_Rec'),
        select: function (event, ui) {
			$('#EpName').val(ui.item.label);
			$('#EpId').val(ui.item.value);
			return false;
		},
		focus: function(event, ui){
			$( "#EpName" ).val( ui.item.label );
			$( "#EpId" ).val( ui.item.value );
			return false;
       },
     });

</script>