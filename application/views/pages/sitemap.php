<?php
function office_sub($sub,$parent_id = 0,$mnu_nm = ''){
				$submenu = $sub[$parent_id];
				$href = 'javascript:void(0)';
				echo '<ul>';
				foreach($submenu as $r){
					$target = '_parent';
					if(trim($r['url_link']) != ''){
						$href = $r['url_link'];
					}else if($r['type'] == 'LINK'){
						if(trim($r['filename'] != '')){
							$href = $r['filename'];
							$target = '_blank';
						}else{
							$href = 'javascript:void(0)';
						}						
					}else{
						//if(trim($r['page_office_code']) == 'AGAE'){
							$href = trim($r['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($r['page_url']).'?c='.$mnu_nm: 'javascript:void(0)';
						//}else{
							//$href = 'javascript:void(0)';
						//}
					}
				?>
					<li>
						<a class="<?php echo isset($sub[$r['office_menu_id']]) ? 'parent': '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
						<?php 
						$m_nm = trim($r['display_name']) != '' ? $r['display_name']: $r['menu_name'] ;
						echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($sub[$r['office_menu_id']]) ? '<i class="menu-right-arrow"></i>': ''?>
						</a>
						<?php
						$mnu_nm_sub = '';
						if(isset($sub[$r['office_menu_id']])){
							$mnu_nm_sub = $mnu_nm.'@'.str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
							office_sub($sub,$r['office_menu_id'],$mnu_nm_sub);
						}?>
					</li>
			<?php 
				}
				echo '</ul>';
			}
?>
<style>
.page-details ul li::before {
    font-family: 'FontAwesome';
    content: "";
    margin: 0px 0px 0px 0px !important;
    color: #062f4f;
    font-size: 11px;
}
.page-details ul li{
	margin:0;
}
.page-details ul li a{
	font-size:12px;
}
.page-details ul li a.parent{
	font-size:15px;
	text-decoration:underline;
}
</style>
<div class="row">
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb">
				<a href="javascript:void(0)" role="link"><?php echo $this->lang->line('sitemap'); ?></a> &raquo; 
			</div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('sitemap'); ?></h1>
				<div class="page-details">
					<h4><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></h4>
					<hr />
						<div class="row">
							<?php
								if(count($AGAE_menu_details) > 0){
								
									foreach($AGAE_menu_details as $row){
										$href = '';
										$target = '_parent';
										if(trim($row['url_link']) != ''){
											$href = $row['url_link'];
										}else if($row['type'] == 'LINK'){
											if(trim($row['filename'] != '')){
												$href = $row['filename'];
												$target = '_blank';
											}else{
												$href = 'javascript:void(0)';
											}						
										}else{
											//if(trim($row['page_office_code']) == 'AGAE'){
												$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']): 'javascript:void(0)';
											//}else{
											//	$href = 'javascript:void(0)';
											//}
										}
										$m_nm = trim($row['display_name']) != '' ? $row['display_name']: $row['menu_name'];
										$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
									?>
									<div class="col-md-4">
										<ul>
											<li>
												<a class="<?php echo isset($AGAE_menu_sub[$row['office_menu_id']]) ? 'parent': '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
												<?php 
												
												echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGAE_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>': ''?>
												</a>
												<?php 
													if(isset($AGAE_menu_sub[$row['office_menu_id']])){
														office_sub($AGAE_menu_sub,$row['office_menu_id'],$mnu_nm);
													}
												?>
											</li>
										</ul>
									</div>
								<?php
									}
							}
							?>
						</div>
					<br />
					
					<h4><?php echo $this->lang->line('principal_accountant_general_g_ssa'); ?></h4>
					<hr />
					<div class="row">
							<?php
								if(count($AGGSSA_menu_details) > 0){
								
									foreach($AGGSSA_menu_details as $row){
										$href = '';
										$target = '_parent';
										if(trim($row['url_link']) != ''){
											$href = $row['url_link'];
										}else if($row['type'] == 'LINK'){
											if(trim($row['filename'] != '')){
												$href = $row['filename'];
												$target = '_blank';
											}else{
												$href = 'javascript:void(0)';
											}						
										}else{
											//if(trim($row['page_office_code']) == 'AGAE'){
												$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']): 'javascript:void(0)';
											//}else{
											//	$href = 'javascript:void(0)';
											//}
										}
										$m_nm = trim($row['display_name']) != '' ? $row['display_name']: $row['menu_name'];
										$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
									?>
									<div class="col-md-4">
										<ul>
											<li>
												<a class="<?php echo isset($AGGSSA_menu_sub[$row['office_menu_id']]) ? 'parent': '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
												<?php 
												
												echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGGSSA_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>': ''?>
												</a>
												<?php 
													if(isset($AGGSSA_menu_sub[$row['office_menu_id']])){
														office_sub($AGGSSA_menu_sub,$row['office_menu_id'],$mnu_nm);
													}
												?>
											</li>
										</ul>
									</div>
								<?php
									}
							}
							?>
						</div>
					<br />
					
					<h4><?php echo $this->lang->line('principal_accountant_general_e_rsa'); ?></h4>
					<hr />
					<div class="row">
							<?php
								if(count($AGERSA_menu_details) > 0){
								
									foreach($AGERSA_menu_details as $row){
										$href = '';
										$target = '_parent';
										if(trim($row['url_link']) != ''){
											$href = $row['url_link'];
										}else if($row['type'] == 'LINK'){
											if(trim($row['filename'] != '')){
												$href = $row['filename'];
												$target = '_blank';
											}else{
												$href = 'javascript:void(0)';
											}						
										}else{
											//if(trim($row['page_office_code']) == 'AGAE'){
												$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']): 'javascript:void(0)';
											//}else{
											//	$href = 'javascript:void(0)';
											//}
										}
										$m_nm = trim($row['display_name']) != '' ? $row['display_name']: $row['menu_name'];
										$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
									?>
									<div class="col-md-4">
										<ul>
											<li>
												<a class="<?php echo isset($AGERSA_menu_sub[$row['office_menu_id']]) ? 'parent': '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
												<?php 
												
												echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGERSA_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>': ''?>
												</a>
												<?php 
													if(isset($AGERSA_menu_sub[$row['office_menu_id']])){
														office_sub($AGERSA_menu_sub,$row['office_menu_id'],$mnu_nm);
													}
												?>
											</li>
										</ul>
									</div>
								<?php
									}
							}
							?>
						</div>
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