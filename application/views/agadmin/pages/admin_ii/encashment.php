<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
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
                <form method="post" action="<?php echo ADMIN_BASE_URL ?>admin_ii/all_employees_encashment">
                    <div class="control-form">
                        <label class="control-label">Encashment Application </label>
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
                        <label class="control-label">Loan</label>
                        <div class="controls">
                            <select name="ltc_htc" style="height:34px;">
								<option value=""> -- Select --</option>
								<?php
								if(isset($encashments) && !empty($encashments)){
									foreach($encashments as $encashment){
										echo '<option value="'.$encashment['ltc_htc'].'">'.$encashment['ltc_htc'].'</option>';
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="control-form">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <input type="submit" value="Download Application" />
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
                <div class="muted pull-left">List of Encashment</div>
                <div class="header-btn-wrap">
                    <button class="btn btn-success"
                        onclick="window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/encashment_upload'">
                        
						 <i class="icon-plus icon-white"></i> Add or Update Encashment</button>
                </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <div class="table-scroll">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Sl no.</th>
                                    <th style="text-align:center;">Employee PAN</th>
									<th style="text-align:center;">Description</th>
                                    <th style="text-align:center;">Order Date</th>
									<th style="text-align:center;">Days Encashed</th>
                                    <th style="text-align:center;">DA Rate</th>
                                    <th style="text-align:center;">Amount</th>
                                    <th style="text-align:center;">Bill No</th>
									<th style="text-align:center;">Bill Date</th>
									<th style="text-align:center;">Status</th>
                                    <th class="action" style="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
					if(count($results) > 0){
						$sl = intval($this->input->get('per_page',true)) + 1;
						foreach($results as $row){			
								?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $sl++ ?></td>
                                    <td style="text-align:center;"><?php echo $row['empid'] ?></td>
									<td><?php echo $row['description'] ?></td>
									<td style="text-align:center;"><?php echo date('d-m-Y',strtotime($row['encash_order_date']))?></td>
                                    <td style="text-align:center;"><?php echo $row['no_days_encash'] ?></td>
                                    <td style="text-align:center;"><?php echo $row['da_rate'] ?></td>
                                    <td style="text-align:center;"><?php echo $row['encash_amount'] ?></td>
                                    <td style="text-align:center;"><?php echo $row['bill_no'] ?></td>
									<td style="text-align:center;"><?php echo $row['bill_date'] ?></td>
                                    <td style="text-align:center;"><?php echo $row['status'] ?></td>
									<td style="text-align:center;"><button class="btn btn-mini btn-primary"
                                            onclick="goEdit('<?php echo $row['encash_id'] ?>')"><i
                                                class="icon-pencil icon-white"></i> Edit</button></td>
                                </tr>
                                <?php
						}    
					}			
					else{
						echo '<tr><td colspan="10">No data found!</td></tr>';
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
function goEdit(id, type) {
    if (id != undefined) {
        window.location.href = '<?php echo ADMIN_BASE_URL ?>admin_ii/encashment_edit/' + id;
    }
}
</script>