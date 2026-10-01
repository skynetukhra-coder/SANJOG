  <?php 
$empid = isset($emp_data['empid']) ? $emp_data['empid']: '';
$level_pay = isset($emp_data['level_pay']) ? $emp_data['level_pay']: '';
?>
<style>
 @keyframes animate { 
            0% { 
                opacity: .01;
				color : #062f4f;
            } 
			25% { 
                opacity: 0.6; 
				color : #062f4f;
            } 
            50% { 
                opacity: 1; 
				color : #ffffff;
            } 
			75% { 
                opacity: 1; 
				color : #ffffff;
            } 
            100% { 
                opacity: 0; 
				color : #ffffff;
            } 
        } 

.banner img {
  max-width: 100%;
  height: 255px;
  width: auto;
  margin:auto;
  display:block
}
</style>
<link href="<?php echo SITE_BASE_URL ?>assets/admin/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">

<div class="row">
	<div class="col-md-3 col-sm-4">
		<div class="left-panel">
			<?php $this->load->view('layout/emp_left_panel',$header);  ?>
		</div>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="right-panel">
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
							if(!empty($mesg)){
									foreach($mesg as $mesg){
								}
							}
						?>
				<div class = "row">
					<div class="col-md-7 col-sm-12">	
						<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; Employee &raquo; Notice Board </div>
					</div>
					<div class="col-md-2 col-sm-12" align= "center">
						<a href="<?php echo SITE_BASE_URL ?>emp/message_box"><div class="notification"><span style = "color: red; animation: animate 1.5s linear infinite;">Message</span><span class="badge"><?php echo $mesg['mesg_tot']?></span></div></a>
					</div>	
					<?php if($level_pay >= 8 ){ ?>
					<div class="col-md-3 col-sm-12" align= "center">
						<a href="<?php echo SITE_BASE_URL ?>emp/pending_works"><div class="notification"><span style = "color: red; animation: animate 1.5s linear infinite;">Pending Work</span><span class="badge"><?php echo $reco['reco_tot']+ $check['check_tot'] + $sanc['sanc_tot']+$joining['join_tot']+$clrh['clhr_tot']+$appli['appli_tot']+$nondr['nondr_tot']+$nondp['nondp_tot']+$ppr['ppr_tot']+$ppp['ppp_tot']+$release['relea_tot']+$join['join_trans']?></span></div></a>
					</div>	
					<?php } ?>
				</div>
				<div class = "row">
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
				</div>
				<div class="muted pull-left" style = " background-color: #97a9bc; color: #513c96; font-size:18px;">
<!--
					<marquee direction="left" scrollamount = "10" onMouseOver="this.stop()" onMouseOut="this.start()">
						<span style = "color: red; font-size:22px; animation: animate 1.5s linear infinite;">Your Pending Work Report !!! </span> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_recommendation_all"> Other Leave for Recommendation - <span class="w3-badge w3-red"><?php echo $reco['reco_tot']?></span></a> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_sanction_all" >  Other Leave for Sanction - <span class="w3-badge w3-red"><?php echo $sanc['sanc_tot']?></span></a> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/leave_joining_report_all" >  Joining Report for Approval - <span class="w3-badge w3-red"><?php echo $joining['join_tot']?></span></a> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/leave_pending_clrh">  CL / RH for Sanction - <span class="w3-badge w3-red"><?php echo $clrh['clhr_tot']?> </a> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/application_pending_recommendation">  Examination Application for Recommendation - <span class="w3-badge w3-red"><?php echo $appli['appli_tot']?></span></a> || 
						<a href="<?php echo SITE_BASE_URL ?>emp/transfer_release"> Release on Transfer - <span class="w3-badge w3-red"><?php echo $release['relea_tot']?></span></a> ||
						<a href="<?php echo SITE_BASE_URL ?>emp/transfer_joining"> Joining on Transfer - <span class="w3-badge w3-red"><?php echo $join['join_trans']?></span></a> ||		
					</marquee>
-->				
				</div>
			<div style="width:100%; height:165px;">
				<img  width="100%" height="165" src="<?php echo base_url()?>assets/images/notice_header.jpg" alt="not_loaded.png">
			</div>	

			<div style="width:100%; height: 100px;" >
				<img width="100%" height="120" src="<?php echo base_url()?>assets/images/notice_banner.jpg" alt="not_loaded.png">	
			</div>
		
				
			<div align = "center" style ="height: 25px; background-color:  #275e93; font-weight: bold; font-size:4px; letter-spacing:2px; color: #fff" >&nbsp;</div>	
			<div align= "center" style="width:100%; height:40px; background-color: #d8ebf0; font-weight: bold; font-size: 12px; " >
				<span  style="color:#513c96; font-weight: bold; font-size: 28px; padding-top: 5px; padding-bottom: 8px;" >OFFICE NOTICE BOARD</span>
				<!--
				<marquee direction="down" scrollamount = "2" behavior="alternate" height="52" >
						<marquee direction="right" scrolldelay="200" scrollamount="8" behavior="alternate"><font size="6" face = "Comic Sans" color = "#513c96" >OFFICE NOTICE BOARD</font></marquee>
				</marquee>
				-->
			</div> 
			
<!--			
			<div class="banner" style="width:100%; height:350;" >
			  <img  width="100%" height="350" src="<?php echo SITE_BASE_URL?>assets/images/notice_header.png" alt="" />
			  <img width="100%" height="350" src="<?php echo base_url()?>assets/images/notice_banner1.jpg" alt=""  />
			  <img width="100%" height="300" src="<?php echo SITE_BASE_URL?>assets/images/notice_banner.png" alt=""  />
			  <img width="100%" height="300" src="<?php echo SITE_BASE_URL?>assets/images/notice_header.png" alt="" />
		   </div>
-->		   
		   <div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size:2px; letter-spacing:2px; color: #fff" >&nbsp;</div>
		
			<div class = "col-sm-12" >
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >					
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--	<span><a href="<?php echo SITE_BASE_URL ?>emp/achievement">Achievement</a></span> -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/achievement"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Achievement </button></a></span>	
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--	<span><a href="<?php echo SITE_BASE_URL ?>emp/performance">Performance</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/performance"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Performance </button></a></span>								
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/epabx">EPABX Direcory</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/epabx"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Telephone </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/circular">Circular</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/circular"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Circular </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/gradation">Gradation</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/gradation"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Gradation </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/kms_document">Books</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/kms_document"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Documents </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/employee_search">Employees</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/employee_search"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Employees </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0">
							<!-- <span><a href="<?php echo SITE_BASE_URL ?>emp/appointment">Joining</a></span>		--->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/appointment"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Appointment </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;"  >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/promotion">Promotion</a></span>   -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/promotion"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Promotion </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--   <span><a href="<?php echo SITE_BASE_URL ?>emp/transfer">Transfer</a></span>   -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/transfer"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Transfer </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/birthday_list">Birthday</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/birthday_list"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Birthday </button></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-12" style = "padding-top: 7px; padding-bottom: 5px;" >
						<div align= "center" style="color: red; font-weight: bold; font-size: 16px; padding-right: 0px">
							<!--  <span><a href="<?php echo SITE_BASE_URL ?>emp/retirement_list">Retirement</a></span>  -->
							<span><a href="<?php echo SITE_BASE_URL ?>emp/retirement_list"><button type="button" class="btn-warning btn-xm" style="padding-top: 5px"> Retirement </button></a></span>
						</div>
					</div>
					
				</div>
			<div align = "center" style ="background-color:  #ffffb3; font-weight: bold; font-size:2px; letter-spacing:2px; color: #fff" >&nbsp;</div>
	<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size:2px; letter-spacing:2px; color: #fff" >&nbsp;</div>
	<div class="login-box">
				<div class = "col-sm-12" >
					<div class="col-md-4 col-sm-12" align= "center" style="color:#800000; font-weight: bold; font-size: 17px; padding-right: 30px; padding-top: 5px;">
						<div class="clock-area" >
							<div id="siteClockArea"></div>
							<div id="siteDateArea"></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-12" align= "center" style =padding-right: 50px">
						<a href="<?php echo SITE_BASE_URL ?>emp/clock"><canvas id="canvas" width="65" height="65"style="background-color:#333"></canvas></a>
					</div>
					<div class="col-md-3 col-sm-12" align= "center" style =padding-right: 50px">
						<a target = "blank" href="/assets/images/cag_calendar-2025.pdf"><img  width="60px" height="60px" src="<?php echo base_url()?>assets/images/calendar-icon-25.png" alt=""  /></a>	
					</div>
					<div class="col-md-1 col-sm-12" align= "center" >
						<?php
							if(!empty($results)){
									foreach($results as $row){
								}
							}
						?>
						<div align= "center" style="color:#005c99; font-weight: bold; font-size: 18px; padding-top: 15px"><a href="<?php echo SITE_BASE_URL ?>emp/login_emp"><span class="badge-green"><?php echo $row['emp_usr']?></span></a></div> <!-- w3-badge w3-green -->	
					</div>
					<div>
						<div class="col-md-1 col-sm-12" align= "center" style="padding-top: 15px">
							<button type="button" class="btn-primary btn-xm" onclick="myFunction()" style="padding-top: 5px"> CLOSE </button>
						</div>
					</div>
				</div>
				<div class = "col-sm-12" style ="background-color:  #c2c2a3; font-weight: bold; font-size:1px; letter-spacing:1px; color: #fff">&nbsp;</div>
		<div class = "row col-sm-12" >		   
			<marquee direction="left" scrolldelay="200" style="background-color: ; width:100%; height:70px; color: #e68a00; font-weight: bold; padding-left:5px" onMouseOver="this.stop()" onMouseOut="this.start()">
					<ul>			
						<?php
							if(!empty($flash_word)){
								foreach($flash_word as $feed){
									?>
									<li>
											<img width="35" height="40" src="<?php echo base_url()?>assets/images/new_arrow.gif" alt="arrow_img.png">
										<?php 
											if(trim($feed['url_link']) != ''){
												echo '<a target="_blank" href="'.$feed['url_link'].'" target="_blank">';
												 
												if($language_id == 1){
														
														echo  $feed['title_hindi'];
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
														echo  $feed['title_hindi'];
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
														echo  $feed['title_hindi'];
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
										<!--	<img width="60" height="40" src="<?php echo base_url()?>assets/images/new.gif" alt="not_loaded.png"></li>		-->
										<?php
										}
								}
							}
						?>
					  </ul>			
				</marquee>
			</div>
	<div class = "row " >	
	  <div class="col-md-5 col-sm-12">
	  <div class = "" align = "center" style=" background-color:  #000000; font-weight: bold; font-size: 16px; letter-spacing: 3px; color: #fff" > FLASH </div>
		<div id="ag" class="tab-pane fade in active" style="width:100%; height: 38%; background-color:  #fff;" >
<!------------Video Display---------->
<!--
			<div style="text-align:center"> 
				<video width="320" height="250" controls>
					<source src="<?php echo SITE_BASE_URL?>assets/movie.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div> 
-->
<!------------Banner Display---------->
		  <div class="banner">
			  <img style="width:100%; height: 250px;"  src="<?php echo SITE_BASE_URL?>assets/images/cv_raman1.jpg" alt="" />
				<!------------Audit Week---------->
<!--
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/logo75.jpg" alt="" />
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/Audit_Awareness_Banner.jpg" alt="" />
-->
				 <!------------vigilance---------->
<!--
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann1a.jpg" alt="" />
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann1.png" alt="" />
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann2.png" alt="" />
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann3.png" alt="" />
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann4.png" alt="" />
				 <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/bann5.png" alt="" />
-->			
			<?php
				$dy = date('d');
				$mth = date('m');
			if(($dy == 1 || $dy == 2 || $dy == 3 || $dy == 4 || $dy == 5 || $dy == 6) && $mth == 1){ ?>
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/poster_newyear.jpg" alt="" />
			<?php } 
			if($dy == 26 && $mth == 1){ ?>
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/poster_republicday.jpg" alt="" />
			<?php } 
			if($dy == 15 && $mth == 8){ ?>
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/poster_indpday.jpg" alt="" />
			<?php }
			if(($dy == 24 || $dy == 25 || $dy == 26 || $dy == 27 || $dy == 28)&& $mth == 10){ ?>
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/poster_greeting_bijaya.jpg" alt="" />
			<?php }
			if(($dy == 24 || $dy == 25)&& $mth == 12){ ?>
				<img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/poster_christmas.jpg" alt="" />
			<?php } ?>
<!--
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/covid.png" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/covid_mask.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/covid_distance.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/covid_hand_wash.jpg" alt="" />
-->
			   <!------------retirement---------->
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/digilocker.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/ag1.jpeg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/ag2.jpeg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec.png" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec1.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec2.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec3.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec4.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec5.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec6.jpg" alt="" />
			   <img id = "myImg2" src="<?php echo SITE_BASE_URL?>assets/images/retirement_dec7.jpg" alt="" />
		   </div>

<!------------Marquee Display---------->
<!--
		   <marquee direction="up" scrolldelay="200" style="width:100%; height:250px; color: red; padding-left:5px" onMouseOver="this.stop()" onMouseOut="this.start()">
					<ul>
						<?php
							if(!empty($flashes)){
								foreach($flashes as $feed){
									?>
									<li>
										<?php
										echo '</br>';
										?>
											<img width="15" height="16" src="<?php echo base_url()?>assets/images/new_btn.png" alt="arrow_img.png">
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
									<?php	/*	<img width="30" height="20" src="<?php echo base_url()?>assets/images/new.gif" alt="not_loaded.png"></li>		*/	?>
										<?php
										}
								}
							}
						?>
					  </ul>
-->
				</marquee>
			</div>
		</div>
		
		 <div class="col-md-7 col-sm-12">
		 <div class = "" align = "center" style ="background-color:  #000000; font-weight: bold; font-size: 16px; letter-spacing:4px; color: #fff"  > NOTICE</div>
		<div id="ag" class="tab-pane fade in active" style="width:100%; background-color: #fff " >
		  <marquee direction="up" scrolldelay="200" style="width:100%; height:250px; color: #000000; padding-left:5px" onMouseOver="this.stop()" onMouseOut="this.start()">
					<ul>
						<?php
							if(!empty($notices)){
								foreach($notices as $feed){
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
											<img width="60" height="40" src="<?php echo base_url()?>assets/images/new1.gif" alt="not_loaded.png">
										<?php } ?>
									</li> 
						<?php	}
							}
						?>
					  </ul>
				</marquee>
			</div>
		</div>
	</div>

	<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 14px; letter-spacing:6px; color: #fff" >&nbsp;</div>			
	<div align = "center" style ="background-color:  #275e93; font-weight: bold; font-size: 16px; letter-spacing:1.5px; color: #fff" >MESSAGE FROM PR. ACCOUNTANT GENERAL </div>
	<div align = "center" style ="background-color:  ; font-weight: bold; font-size: 14px; letter-spacing:6px; color: #fff" >&nbsp;</div>	
	
<!------------Reader Display---------->		
			<div style="width:100%; height:400px;">
				<object data="https://agwb.cag.gov.in/files/agae/circular_order/Appreciation_msgs1.PDF" type="application/pdf" width="100%" height="100%"></object>
			</div>
	
		</div>
		</div>
	</div>
</div>
<style>
.empmodal {
  background: #dfdbdb ;
  position: absolute;
  float: left;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>

<!-- Modal -->
<!--
<div id="myModal" class="empmodal fade" tabindex="-1" role="dialog" style="width: 50%; height: 42%;">
	<div class="modal-dialog" >
		<div class="modal-content" style="width: 100%;">
			<div class="modal-header">
				<button type="button" class="close"  data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h5 class="modal-title" id="UpdateModal">NOTICE</h5>
			</div>
			<div>&nbsp;</div>
			<div class="modal-body">
				<form class="control-form" id="updmiss" name="updmiss" method="post" class="was-validated">
						<div >
							<div class="form-group">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Attention !!!</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><p style = "color:red; font-size:18px;">Always keep your information updated in "My Information" page, whenever there is any change.</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
-->
<script type="text/javascript" src="<?php echo SITE_BASE_URL?>assets/js/jquery.min.js"></script>
<script>
    $(window).load(function()
    {
    $('#myModal').modal('show');});

    $(window).load(function()
    {
    setTimeout(function(){
    $('#myModal').modal('hide')
    }, 4500);});

	$("#myBtn").click(function() {
        $("#myModal").modal("hide");
    });
</script>


<script>
function myFunction() {
  window.location.href = '<?php echo SITE_BASE_URL ?>emp/information/';
}
</script>


<script src="<?php echo SITE_BASE_URL ?>assets/admin/vendors/fullcalendar/fullcalendar.js"></script>
<script>
        $(function() {
            // Easy pie charts
            var calendar = $('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title',
				right: 'prev,next'
			},
            selectable: true,
            selectHelper: true,
           /* select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },*/
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
            
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
                
            },
			editable: true,
			// US Holidays
			events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic'
			
			});
        });

        $('#external-events div.external-event').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999999999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
</script>

<script type="text/javascript">
	function showTime(){
		var date = new Date();
		var h = date.getHours(); // 0 - 23
		var m = date.getMinutes(); // 0 - 59
		var s = date.getSeconds(); // 0 - 59
		var session = "AM";
		
		if(h == 0){
			h = 12;
		}
		
		if(h > 12){
			h = h - 12;
			session = "PM";
		}
		
		h = (h < 10) ? "0" + h : h;
		m = (m < 10) ? "0" + m : m;
		s = (s < 10) ? "0" + s : s;
		
		var time = h + ":" + m + ":" + s + " " + session;
		document.getElementById("siteClockArea").innerText = time;
		//document.getElementById("MyClockDisplay").textContent = time;
		 var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		var curWeekDay = days[date.getDay()];
		var curDay = date.getDate();
		var curMonth = months[date.getMonth()];
		var curYear = date.getFullYear();
		var dt = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
		document.getElementById("siteDateArea").innerHTML = dt;
		setTimeout(showTime, 1000);
		
	}
	
	showTime();
</script>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>