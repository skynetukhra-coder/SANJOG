<div class="row">
	
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb"><a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; GPF Final payment cases</div>
			<div>
				<h1 class="title">Status of GPF Final Payment Cases</h1>
				<div class="page-details">
				 
                             <div class="filter-form">
								<div class="form-group row">
									<div class="col-md-2 col-sm-4"><label class="name-label">GPF No :</label></div>
									<div class="col-md-3 col-sm-8"><input id="gpf_no" type="text" name="gpf_account" class="form-control" placeholder=""></div>
                                    <div class="col-md-2 col-sm-4"><label class="name-label">GPF No :</label></div>
									<div class="col-md-3 col-sm-8">
                                      <select class="form-control">
                                        <option>1</option>
                                      </select>
                                    </div>
                                    <div class="col-md-offset-0 col-md-2 col-sm-offset-4 col-sm-8"><input type="submit" class="submit-btn" value="Submit" /></div>
								</div>
                                </div>
                                
                                
                                <div class="filter-form1">
									<div class="form-group row">
										<div class="col-sm-4">
										 <label class="name-label">GPF No :</label>
										 <input id="gpf_no" type="text" name="gpf_account" class="form-control" placeholder="">
										</div>
										
										<div class="col-sm-4">
										 <label class="name-label">GPF No :</label>
										 <input id="gpf_no" type="text" name="gpf_account" class="form-control" placeholder="">
										</div>
										
										<div class="col-sm-4">
										<label class="name-label">GPF No :</label>
										  <select class="form-control">
											<option>1</option>
										  </select>
										</div>
										
										<div class="col-sm-4">
										 <label class="name-label">GPF No :</label>
										 <input id="gpf_no" type="text" name="gpf_account" class="form-control" placeholder="">
										</div>
										
										<div class="col-sm-4">
										 <label class="name-label">GPF No :</label>
										 <input id="gpf_no" type="text" name="gpf_account" class="form-control" placeholder="">
										</div>
										
										
										<div class="col-sm-4"><input type="submit" class="submit-btn" value="Submit" /></div>
									</div>
                                </div>
											
					<table border="1" style="width:100%">
						<thead>
							<tr style="text-align:center">
								<th style="text-align:center">GPF A/c no.</th>
								<th style="text-align:center">Name</th>
								<th style="text-align:center">Designation</th>
								<th style="text-align:center">Remarks</th>
							</tr>
						</thead>
						<tbody>
					<?php
					if(!empty($results)){
						$sl = 1;
						foreach($results as $row){?>
								<tr>
									<td style="text-align:center"><?php echo $sl++ ?></td>
									<td style="text-align:center"><?php echo get_date($row['intrst_from'])?></td>
									<td style="text-align:center"><?php echo get_date($row['intrst_to'])?></td>
									<td style="text-align:center"><?php echo $row['intrst_rate'] ?></td>
								</tr>
					<?php
						}
					}else{?>
							<tr>
								<td colspan="4" style="font-size:12px">No data found!</td>
							</tr>
					<?php
					}?>					
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
	  <?php $this->load->view('layout/left_panel');?>
	   </div>
	</div>
</div>