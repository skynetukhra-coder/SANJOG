
<style>
table, th{
	text-align:center;
    border: 1px solid black;
}
</style>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('my_documents'); ?></div>
			<div class="login-box">
				<h4><strong>Pending Works Report</strong></h4>
				<hr />
				<table class="table" border="1" style="width:100%">
						<thead>
							<tr>
								<th style = "border: 1px solid black;" >Sl No</th>
								<th style = "border: 1px solid black;" >Description</th>
								<th style = "border: 1px solid black;" >Nos</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(!empty($reco_pendings)){
									foreach($reco_pendings as $reco){
								}
							}
							if(!empty($check_pendings)){
									foreach($check_pendings as $check){
								}
							}
							if(!empty($sanc_pendings)){
									foreach($sanc_pendings as $sanc){
								}
							}
							if(!empty($join_pendings)){
									foreach($join_pendings as $joining){
								}
							}
							if(!empty($clrh_pendings)){
									foreach($clrh_pendings as $clrh){
								}
							}
							if(!empty($appli_pendings)){
									foreach($appli_pendings as $appli){
								}
							}
							if(!empty($non_dept_recds)){
									foreach($non_dept_recds as $nondr){
								}
							}
							if(!empty($non_dept_procs)){
									foreach($non_dept_procs as $nondp){
								}
							}
							if(!empty($pp_recds)){
									foreach($pp_recds as $ppr){
								}
							}
							if(!empty($pp_procs)){
									foreach($pp_procs as $ppp){
								}
							}
							if(!empty($release_pendings)){
									foreach($release_pendings as $release){
								}
							}
							if(!empty($join_trnasfer)){
									foreach($join_trnasfer as $join){
								}
							}
							?>
							<tr>
								<td style = "width: 20%">1. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_recommendation_all" >Other Leave for Recommendation</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_recommendation_all" ><span class="badge-red"><?php echo $reco['reco_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">2. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_check_all" >Other Leave for Checking</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_check_all" ><span class="badge-red"><?php echo $check['check_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">2. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_sanction_all" >Other Leave for Sanction</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_sanction_all" ><span class="badge-red"><?php echo $sanc['sanc_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">3. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/leave_joining_report_all" >Joining Report for Approval</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/leave_joining_report_all" ><span class="badge-red"><?php echo $joining['join_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">4. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_clrh" >CL / RH for Sanction</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_clrh" ><span class="badge-red"><?php echo $clrh['clhr_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">5. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_recommendation" >Examination Application for Recommendation</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_recommendation" ><span class="badge-red"><?php echo $appli['appli_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">6. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_recomd" >Recommendation for non-Depatmental Examination</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_recomd" ><span class="badge-red"><?php echo $nondr['nondr_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">7. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_permission" >Processing for non-Depatmental Examination</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_permission" ><span class="badge-red"><?php echo $nondp['nondp_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">8. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_pr" >Recommendation for Passort / VISA</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_pr" ><span class="badge-red"><?php echo $ppr['ppr_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">9. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_pp" >Processing for Passort / VISA</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/application_pending_pp" ><span class="badge-red"><?php echo $ppp['ppp_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">10. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/transfer_release" >Release on Transfer</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/transfer_release" ><span class="badge-red"><?php echo $release['relea_tot']?></span></a></td>
							</tr>
							<tr>
								<td style = "width: 20%">11. </td>
								<td><a href="<?php echo SITE_BASE_URL ?>emp/transfer_joining" >Joining on Transfer</a></td>
								<td style = "width: 20%"><a href="<?php echo SITE_BASE_URL ?>emp/transfer_joining" ><span class="badge-red"><?php echo $join['join_trans']?></span></a></td>
							</tr>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>

</script>