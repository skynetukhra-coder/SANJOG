<style>
.table1 td{
	text-align:left;
	font-size:14px;
	font-weight: ; 
	line-height: 3.5;
	letter-spacing:1.2px;
}
</style>
<?php
$d = new DateTime(); 
//echo get_datepicker_date($d->format('Y-m-t' ));
?>
<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; <?php echo $this->lang->line('employee'); ?> &raquo; <?php echo $this->lang->line('circular_office_'); ?> Search Employee</div>
			<div class="login-box">
					<div>
						<div class="col-md-1 col-sm-12" align= "center" style="padding-top: 15px; float: right">
							<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> BACK </button>
						</div>
					</div>
					<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 20px; letter-spacing:6px; color: #fff" >&nbsp;</div>							
					<div class = "row " >	
				<h4><strong><?php echo $this->lang->line('circular_office_orde'); ?></strong></h4>
				<hr/>
					<div style="width:100%; height:150px;">
						<img width="100%" height="150" src="<?php echo base_url()?>assets/images/notice_header.jpg" alt="not_loaded.png">
					</div>
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 3px; letter-spacing:3px; color: #fff" >&nbsp;</div>
					<div style="width:100%; height:300px;">
						<img width="100%" height="300" src="<?php echo base_url()?>assets/images/quotation1.jpg" alt="not_loaded.png">
					</div>	
					<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 22px; letter-spacing:1.5px; color: #fff" >Special Achievement</div>
					<div align = "center" >
						<a target = "_blank" href="<?php echo base_url()?>assets/images/news.pdf" >
						<img style="width:100%; height: 700px;"  src="<?php echo SITE_BASE_URL?>assets/images/news-papers.jpg" alt="" />
						</a>
					</div>
					
					<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 14px; letter-spacing:6px; color: #fff" >&nbsp;</div>							
					<div class = "row " >	

			<div class="col-md-7 col-sm-12">
				<div id="ag" class="tab-pane fade in active" style="width:100%; height: 250px; background-color:  #fff;" >
					<!------------Banner Display---------->
					<div class="banner img-container ">
						<a target="_blank" href = "https://agwb.cag.gov.in/userfiles/files/A&EWB/Administration/C_V_RAMAN_PDF.pdf"><img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/cv_raman.jpg" alt="" /></a>
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/cv_raman1.jpg" alt="" />
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/office.png" alt="" />
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/banner.jpg" alt="" />
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/banner_3.jpg" alt="" />
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/banner_4.jpg" alt="" />
						<img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/banner_5.jpg" alt="" />
						 <div class="img-text">
							<h4></h4>
							<p>&nbsp;</p>
						 </div>
					</div>
				</div>
			</div>
		
			<div class="col-md-5 col-sm-12">
			<div id="ag" class="tab-pane fade in active" style="width:100%; background-color: #fff " >
				<marquee direction="up" scrolldelay="200" style="width:100%; height:250px; color: #000000; padding-left:5px" onMouseOver="this.stop()" onMouseOut="this.start()">
					<ul>
						<?php
							if(!empty($results)){
								foreach($results as $feed){
									?>
									<li>
										<?php
										echo '</br>';
										?>
											<img width="20" height="20" src="<?php echo base_url()?>assets/images/arrow_img.png" alt="arrow_img.png">
										<?php 
											if(trim($feed['url_link']) != ''){
												echo '<a target="_blank" href="'.$feed['url_link'].'" target="_blank">';
												 
												if($language_id == 1){
														
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
													echo '</a>';
											}
											else if(trim($feed['link_file']) != ''){
												echo '<a target="_blank" href="'.(($feed['link_file']) != '' ? base_url().'files/agae/tender_whatsnew/'.$feed['link_file']: 'javascript:void(0)').'">';
												if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												echo '</a>';
											}
											else { 
												if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												echo '</a>';
											}
											
										if(date('Y-m-d',strtotime($feed['create_dt'])) > date('Y-m-d',strtotime('-30 days'))){
										?>
									</li>
										<?php
										}
								}
							}
						?>
					  </ul>
				</marquee>
			</div>
		  </div>
		</div>
				
		</div>
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
	 </div>
   </div>
</div>

<script>
function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/notice_board/';
}
</script>
