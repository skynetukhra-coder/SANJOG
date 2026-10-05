
	<div class="row" id="main-content">
		<div class="col-xs-12">
			<div class="home-portal-notice-card">
				<div class="notice-badge"><i class="fa fa-info-circle"></i> Official Portal Notice</div>
				<h2 class="notice-title">
					The composite website ‘<span class="portal-highlight">www.agwb.cag.gov.in</span>’ is presently with new sub-sites for the offices.
				</h2>
				<p class="notice-subtitle">
					Office-wise links for the new sub-sites are as mentioned below:
				</p>
				<div class="table-responsive office-links-wrap">
					<table class="table table-bordered office-links-table">
						<thead>
							<tr>
								<th><i class="fa fa-building-o"></i> Office Description</th>
								<th><i class="fa fa-external-link"></i> Official Portal Link</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<strong>Principal Accountant General (A&amp;E), West Bengal, Kolkata</strong>
								</td>
								<td>
									<a href="https://cag.gov.in/ae/west-bengal/en" target="_blank" class="office-link-btn" rel="noopener noreferrer">
										<span>https://cag.gov.in/ae/west-bengal/en</span> <i class="fa fa-external-link"></i>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Principal Accountant General (Audit-I), West Bengal, Kolkata</strong>
								</td>
								<td>
									<a href="https://cag.gov.in/ag1/west-bengal/en" target="_blank" class="office-link-btn" rel="noopener noreferrer">
										<span>https://cag.gov.in/ag1/west-bengal/en</span> <i class="fa fa-external-link"></i>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Principal Accountant General (Audit-II), West Bengal, Kolkata</strong>
								</td>
								<td>
									<a href="https://cag.gov.in/ag2/west-bengal/en" target="_blank" class="office-link-btn" rel="noopener noreferrer">
										<span>https://cag.gov.in/ag2/west-bengal/en</span> <i class="fa fa-external-link"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="notice-footer-msg">
					<i class="fa fa-arrow-circle-right"></i> Please visit the respective office website for Online Applications, Audit Reports, etc.
				</div>
			</div>
		</div>		
	</div>
<!--	

<div  align= "center"  >
	<p style="; color:red; font-size: 16px">The Websites of the Pr. Accountant General (A&E), West Bengal, the Pr. Accountant General (Audit-I), West Bengal and the Pr. Accountant General (Audit-II), West Bengal <br> are available under "Our Offices" of the website of the O/o the Comptroller and Auditor General of India. </br></p>
	<p>&nbsp;</P>
	<p>&nbsp;</P>
	<p>&nbsp;</P>
	<p style="; color:blue; font-size: 36px">Please click on 'GO' to visit our website.</p>
	<p>&nbsp;</P>
	<button class="btn btn-info btn-lg" onclick="myFunction()"> &nbsp;&nbsp; G O &nbsp;&nbsp;</button>

	<script>
	function myFunction() {
	  window.location.href = 'https://cag.gov.in/en'; /*    'https://cag.gov.in/ae/west-bengal/en';		*/
	}
	</script>
</div>	

-->

<!--



<div class="row">
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
	<div class="right-panel">
	
	  <!--<div class="banner"> <img src="<?php echo SITE_BASE_URL?>assets/images/banner.jpg" alt="" /> </div>   	---

	   <div class="banner">
		  <img src="<?php echo SITE_BASE_URL?>assets/images/banner_1.jpg" alt="" />
		  <img src="<?php echo SITE_BASE_URL?>assets/images/banner_2.jpg" alt="" style="display:none" />
		  <img src="<?php echo SITE_BASE_URL?>assets/images/banner_3.jpg" alt="" style="display:none"  />
		  <img src="<?php echo SITE_BASE_URL?>assets/images/banner_4.jpg" alt="" style="display:none"  />
		  <img src="<?php echo SITE_BASE_URL?>assets/images/banner_5.jpg" alt="" style="display:none"  />
	   </div>
	  
  <div class="missionsec">
	<div class="row">	
		  <div class="home col-md-7 col-sm-12">
		  <?php
	  if(!empty($about_us)){?>
		<div class="about-us">
		<h1 class="title"><?php echo $about_us['page_title']?></h1>
		<?php 
		$page_array = explode("\r\n", $about_us['page_desc']);
		foreach($page_array as $page){
			if(trim($page) != ''){
				echo '<p>'.strip_tags($page).' ';
				if(trim($about_us['page_office_code']) == 'AGAE'){
					$href = trim($about_us['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($about_us['page_url']): 'javascript:void(0)';
				}else{
					$href = AGAE_BASE_URL.'page/'.trim($about_us['page_url']);
				}
				echo '<a href="'.$href.'" class="read-more">...'.$this->lang->line('read_more').'</a>';
				echo '</p>';
				
				break;
			}
		}
		?>
		
	  </div>
	  <?php
	  }?>
	  
		  <?php
		   // Block section
		   if(!empty($blocks)){
			foreach($blocks as $block){
				$title = explode(" ", $block['page_title']);
				$block_data = $block['page_desc'];
			?>
				<div class="our-mission">
				  <h3 class="title">
					<?php 
					if(count($title) == 1){
						echo $title[0];
					}else if(count($title) == 2){
						echo $title[0].'<span> '.$title[1].'</span>';
					}else if(count($title) > 2){
						$t_first = $title[0];
						$t = array_shift($title);
						echo $t_first.'<span> '.join(' ',$title).'</span>';
					} ?>
				  </h3>
				  <div class="add-paddi"><?php echo $block_data ?></div>
				</div>
		<?php
			}
		   }?>
		  </div>
		  <div class="col-md-5 col-sm-12">
			<div class="newsec dark">
			  <h4><?php echo $this->lang->line('whats_new'); ?></h4>
			</div>
			<div class="new-cont medium whats-new">
				
			   <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#ag"><?php echo $this->lang->line('whats_new_agae'); ?></a></li>
					<li><a data-toggle="tab" href="#tab2"><?php echo $this->lang->line('whats_new_pr_ag_ssa'); ?></a></li>
					<li><a data-toggle="tab" href="#tab3"><?php echo $this->lang->line('whats_new_age_rsa'); ?></a></li>
				</ul>
			   
			   <div class="tab-content">
		<div id="ag" class="tab-pane fade in active">
		  <marquee direction="up" scrolldelay="200" style="width:100%; height:450px;" onMouseOver="this.stop()" onMouseOut="this.start()">
					<ul>
						<?php
							if(!empty($whats_new)){
								foreach($whats_new as $feed){
									
									?>
									<li>
										<?php
											if(trim($feed['url_link']) != ''){
												echo '<a target="_blank" href="'.$feed['url_link'].'" target="_blank">';
										?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
											<?php echo '</a>';
											}
											else if(trim($feed['link_file']) != ''){
												echo '<a target="_blank" href="'.(($feed['link_file']) != '' ? base_url().'files/agae/tender_whatsnew/'.$feed['link_file']: 'javascript:void(0)').'">';
											?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
										<?php echo '</a>';
											}
											else { ?>
												<?php
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
												<?php
											}
											
										?>
										<?php
										if(date('Y-m-d',strtotime($feed['create_dt'])) > date('Y-m-d',strtotime('-30 days'))){?>
											<img width="42" height="16" src="<?php echo base_url()?>assets/images/new.gif" alt="image008.gif"></li>
										<?php
										}?>
						<?php
								}
							}
						?>
					  </ul>
				</marquee>
		</div>
		<div id="tab2" class="tab-pane fade">
		  <marquee direction="up" scrolldelay="200" style="width:100%; height:450px;" onMouseOver="this.stop()" onMouseOut="this.start()">
				<ul>
						<?php
							if(!empty($gssa_whats_new)){
								foreach($gssa_whats_new as $feed){?>
									<li>
										<?php
											if(trim($feed['url_link']) != ''){
												echo '<a target="_blank" href="'.$feed['url_link'].'" target="_blank">';
										?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
										<?php echo '</a><br/>';
											}
											else if(trim($feed['link_file']) != ''){
												echo '<a target="_blank" href="'.(($feed['link_file']) != '' ? base_url().'files/'.$feed['link_file']: 'javascript:void(0)').'">';
											?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
												<?php echo '</a>';
											}
											else { ?>
												<?php
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
												<?php
											}
												?>	
										<?php
										if(date('Y-m-d',strtotime($feed['create_dt'])) > date('Y-m-d',strtotime('-30 days'))){?>
											<img width="42" height="16" src="<?php echo base_url()?>assets/images/new.gif" alt="image008.gif"></li>
										<?php
										}?>
						<?php
								}
							}
						?>
					  </ul>
			</marquee>
		</div>
		<div id="tab3" class="tab-pane fade">
		  <marquee direction="up" scrolldelay="200" style="width:100%; height:450px;" onMouseOver="this.stop()" onMouseOut="this.start()">
				<ul>
						<?php
							if(!empty($esra_whats_new)){
								foreach($esra_whats_new as $feed){?>
									<li>
										<?php
											if(trim($feed['url_link']) != ''){
												echo '<a target="_blank" href="'.$feed['url_link'].'" target="_blank">';
										?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
										<?php echo '</a><br/>';
											}
											else if(trim($feed['link_file']) != ''){
												echo '<a target="_blank" href="'.(($feed['link_file']) != '' ? base_url().'files/'.$feed['link_file']: 'javascript:void(0)').'">';
											?>
												<?php 
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
										<?php echo '</a>';
											}
											else { ?>
												<?php
													if($language_id == 1){
														echo  $feed['title'];
													} 
													elseif($language_id == 2){
														echo  $feed['title_hindi'];
													}
													else{
														echo  $feed['title_bengali'];
													}
												?>
												<?php
											}
										?>
										<?php
										if(date('Y-m-d',strtotime($feed['create_dt'])) > date('Y-m-d',strtotime('-30 days'))){?>
											<img width="42" height="16" src="<?php echo base_url()?>assets/images/new.gif" alt="image008.gif"></li>
										<?php
										}?>
						<?php
								}
							}
						?>
					  </ul>
			</marquee>
		</div>   
	  </div>  
	  </div>
				
	  <div class="payment-case saffron-bg div-anchor mrgn-top xs-hidden"><a href="https://bhavishya.nic.in/Login.aspx" target="_blank" class="click-white"><?php echo $this->lang->line('bhavishya_login'); ?></a></div>          
	  <div class="payment-case dark  div-anchor mrgn-top xs-hidden"><a href="https://eprocure.gov.in/epublish/app" target="_blank" class="click-white"><?php echo $this->lang->line('cpp_prtl_lgin'); ?></a></div>           
	  <div class="payment-case blue-dark-bg div-anchor mrgn-top xs-hidden"><a href="https://pfms.nic.in/Users/LoginDetails/NewLayoutLogin.aspx" target="_blank" class="click-white"><?php echo $this->lang->line('pfms_lgin'); ?></a></div>           
			  
			</div>
		  </div>
		</div>
	  </div>	  
	  
		
	  
	</div>
	<div class="col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
		 <?php  $this->load->view('layout/left_panel');?>
	   </div>
	</div>
</div>

-->
	