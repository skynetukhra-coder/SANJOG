	
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$AGAE_menu = $this->menu_model->getOfficeMenu('AGAE');
$AGGSSA_menu = $this->menu_model->getOfficeMenu('AGGSSA');
$AGERSA_menu = $this->menu_model->getOfficeMenu('AGERSA');
$tender_notice_menu = $this->menu_model->getTenderNoticeMenu();
$contact_us_menu = $this->menu_model->getContactUsMenu();
$href = 'javascript:void(0)';
$AGAE_menu_details = array();
$AGGSSA_menu_details = array();
$AGERSA_menu_details = array();
$AGAE_menu_sub = array();
$AGGSSA_menu_sub = array();
$AGERSA_menu_sub = array();

$tender_notice_menu_details = array();
$tender_notice_menu_sub = array();

$contact_us_menu_details = array();
$contact_us_menu_sub = array();
foreach($AGAE_menu as $row){
	if($row['sub_menu_id'] > 0){
		$AGAE_menu_sub[$row['sub_menu_id']][] = $row;
	}else{
		$AGAE_menu_details[$row['office_menu_id']] = $row;
	}
}
foreach($AGGSSA_menu as $row){
	if($row['sub_menu_id'] > 0){
		$AGGSSA_menu_sub[$row['sub_menu_id']][] = $row;
	}else{
		$AGGSSA_menu_details[$row['office_menu_id']] = $row;
	}
}
foreach($AGERSA_menu as $row){
	if($row['sub_menu_id'] > 0){
		$AGERSA_menu_sub[$row['sub_menu_id']][] = $row;
	}else{
		$AGERSA_menu_details[$row['office_menu_id']] = $row;
	}
}
foreach($tender_notice_menu as $row){
	if($row['sub_menu_id'] > 0){
		$tender_notice_menu_sub[$row['sub_menu_id']][] = $row;
	}else{
		$tender_notice_menu_details[$row['menu_id']] = $row;
	}
}

foreach($contact_us_menu as $row){
	if($row['sub_menu_id'] > 0){
		$contact_us_menu_sub[$row['sub_menu_id']][] = $row;
	}else{
		$contact_us_menu_details[$row['menu_id']] = $row;
	}
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
<meta charset="utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="referrer" content="origin">
<link rel="icon" href="<?php echo SITE_BASE_URL ?>assets/images/favicon.png" type="image/png" sizes="16x16">
<title><?php echo $this->lang->line('site_title'); ?></title>
<!-- Bootstrap Css -->
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/bootstrap-theme.css"/>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/font-awesome.css"/>
<!-- Main Css -->
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/style.css" />
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/menu.css"/>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/blue.css"/>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/responsive.css"/>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL?>assets/css/treemenu.css">
<?php
if(($this->session->userdata('site_theme') && $this->session->userdata('site_theme') == 'black')){
	echo '<link rel="stylesheet" href="'.SITE_BASE_URL.'assets/css/theme.css">';
}
?>

<script>
var BASEPATH = '<?php echo SITE_BASE_URL?>';
</script>

</head>
<body >
<div class="wrapper" id="wrapper">
<header>

   <div class="header-top medium">
	<div class="container">
		<div class="header-top-flex">
			<div class="header-top-left-nav">
				<ul class="quick-service-links">
					<li><a href="https://cag.gov.in" target="_blank"><?php echo $this->lang->line('cag'); ?></a></li>
					<li><a href="https://cag.eoffice.gov.in" target="_blank"><?php echo $this->lang->line('e_office'); ?></a></li>
					<li><a href="https://email.gov.in" target="_blank"><?php echo $this->lang->line('mail_srvr'); ?></a></li>
					<li><a href="https://saccess.nic.in/" target="_blank"><?php echo $this->lang->line('vpn'); ?></a></li>
					<li><a href="https://pfms.nic.in/Users/LoginDetails/NewLayoutLogin.aspx" target="_blank"><?php echo $this->lang->line('pfms'); ?></a></li>
					<li><a href="<?php echo base_url('emp/login_page'); ?>" target="_blank"><?php echo $this->lang->line('employee'); ?></a></li>
					<li><a href="<?php echo base_url('admin'); ?>" target="_blank"><?php echo $this->lang->line('login'); ?></a></li>
				</ul>
			</div>
			<div class="header-top-right-tools">
				<div class="selecttheme-box"><a href="<?php echo SITE_BASE_URL; ?>home/screen_reader_access"><?php echo $this->lang->line('screen_reader'); ?></a></div>
				<div class="selecttheme-box theme-switch-box">
					<span class="theme-text"><?php echo $this->lang->line('select_theme'); ?></span>
					<button type="button" class="colorbox blue" onclick="selectTheam('blue')" title="Standard Blue Theme" aria-label="Blue Theme"></button>
					<button type="button" class="colorbox black" onclick="selectTheam('black')" title="High Contrast Dark Theme" aria-label="Dark Theme"></button>
				</div>
				<ul class="font-controls" aria-label="Font Resizer">
					<li onclick="increseFont();"><a href="javascript:void(0)" title="Increase Font">A+</a></li>
					<li onclick="defaultFont();"><a href="javascript:void(0)" title="Default Font">A</a></li>
					<li onclick="decreseFont();"><a href="javascript:void(0)" title="Decrease Font">A-</a></li>
				</ul>
				<form class="search-field lang-form" onsubmit="return false;">
					<div class="form-group">
						<select class="form-control lang-selector" onchange="change_site_lang(this.value)" aria-label="Select Language">
							<option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?> >English</option>
							<option value="hindi" <?php if($this->session->userdata('site_lang') == 'hindi') echo 'selected="selected"'; ?> >हिंदी</option>
							<option value="bengali" <?php if($this->session->userdata('site_lang') == 'bengali') echo 'selected="selected"'; ?> >বাংলা</option>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>
  </div>

  <div class="header-bottom medium1">
    <div class="container">
		<div class="header-brand-flex">
			<div class="brand-emblem-left flag">
				<a href="https://www.india.gov.in/" target="_blank" title="National Portal of India">
					<img src="<?php echo SITE_BASE_URL?>assets/images/logo1.png" alt="National Emblem of India" class="emblem-img" />
				</a>
			</div>
			<div class="brand-titles-center">
				<h1 class="brand-main-title"><?php echo $this->lang->line('main_title'); ?></h1>
				<p class="brand-sub-title"><?php echo $this->lang->line('iaad'); ?></p>
			</div>
			<div class="brand-logo-right">
				<a href="https://cag.gov.in/" target="_blank" title="Comptroller and Auditor General of India">
					<img src="<?php echo SITE_BASE_URL?>assets/images/logo2.png" alt="CAG of India Logo" class="cag-logo-img" />
				</a>
			</div>
		</div>
		<div class="mobile-menu-bar">
			<a class="toggleMenu" href="javascript:void(0)" aria-label="Toggle Navigation Menu">
				<i class="fa fa-bars" aria-hidden="true"></i> <span><?php echo $this->lang->line('menu'); ?></span>
			</a>
		</div>
	</div>
  </div>
  <div class="menupart charcoal">
    <nav>
     <ul class="navi">
		<li><a class="parent" href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a></li><font color="white"><b>|</b></font>			
<!--		<li><a class="parent"  href="https://cag.gov.in/ae/west-bengal/en"><?php echo $this->lang->line('home'); ?></a></li><font color="white"><b>&nbsp;</b></font>		-->


<!--   Toggle navigation for office Menus ----> 

<?php /*------ Here is the staring-point for closing of all menu items -----

   
		<li><a class="parent" href="javascript:void(0)"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></i></a>
          <?php

		  	function call_office_sub($sub,$parent_id = 0,$mnu_nm = ''){
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
						if(trim($r['page_office_code']) == 'AGAE'){
							$href = trim($r['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($r['page_url']).'?c='.$mnu_nm : 'javascript:void(0)';
						}else if(trim($r['page_office_code']) == 'AGGSSA'){
							$href = trim($r['page_url']) != '' ? AGGSSA_BASE_URL.'page/'.trim($r['page_url']).'?c='.$mnu_nm : 'javascript:void(0)';
						}else if(trim($r['page_office_code']) == 'AGERSA'){
							$href = trim($r['page_url']) != '' ? AGERSA_BASE_URL.'page/'.trim($r['page_url']).'?c='.$mnu_nm : 'javascript:void(0)';
						}else{
							$href = 'javascript:void(0)';
						}
					}
				?>
					<li>
						<a class="<?php echo isset($sub[$r['office_menu_id']]) ? 'parent' : '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
						<?php 
		
						$m_nm = trim($r['display_name']) != '' ? $r['display_name'] : $r['menu_name'] ;
						echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($sub[$r['office_menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?>
						</a>
						<?php
						$mnu_nm_sub = '';
						if(isset($sub[$r['office_menu_id']])){
							$mnu_nm_sub = $mnu_nm.'@'.str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
							call_office_sub($sub,$r['office_menu_id'],$mnu_nm_sub);
						}?>
					</li>
			<?php 
				}
				echo '</ul>';
			}
		  	if(count($AGAE_menu_details) > 0){
				echo '<ul>';
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
								$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							//}else{
							//	$href = 'javascript:void(0)';
							//}
						}
						$m_nm = trim($row['display_name']) != '' ? $row['display_name'] : $row['menu_name'];
						$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
					?>
						<li>
							<a class="<?php echo isset($AGAE_menu_sub[$row['office_menu_id']]) ? 'parent' : '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
							<?php 
							
							echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGAE_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?>
							</a>
								<?php 
									if(isset($AGAE_menu_sub[$row['office_menu_id']])){
										call_office_sub($AGAE_menu_sub,$row['office_menu_id'],$mnu_nm);
									}
								?>
						</li>
				<?php
					}
				echo '</ul>';
			}
		  ?>
        </li><font color="white"><b>&nbsp;</b></font>
       <li><a class="parent" href="javascript:void(0)"><?php echo $this->lang->line('principal_accountant_general_g_ssa'); ?></i></a>
		<?php
				if(count($AGGSSA_menu_details) > 0){
				echo '<ul>';
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
								$href = trim($row['page_url']) != '' ? AGGSSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
						}
						$m_nm = trim($row['display_name']) != '' ? $row['display_name'] : $row['menu_name'];
						$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
					?>
						<li>
							<a class="<?php echo isset($AGGSSA_menu_sub[$row['office_menu_id']]) ? 'parent' : '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
							<?php 
							
							echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGGSSA_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?>
							</a>
								<?php 
									if(isset($AGGSSA_menu_sub[$row['office_menu_id']])){
										call_office_sub($AGGSSA_menu_sub,$row['office_menu_id'],$mnu_nm);
									}
								?>
						</li>
				<?php
					}
				echo '</ul>';
			}
		?>
		</li><font color="white"><b>&nbsp;</b></font>
       <li><a class="parent" href="javascript:void(0)"><?php echo $this->lang->line('principal_accountant_general_e_rsa'); ?></i></a>
		<?php
				if(count($AGERSA_menu_details) > 0){
				echo '<ul>';
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
							//if(trim($row['page_office_code']) == 'AGERSA'){
								$href = trim($row['page_url']) != '' ? AGERSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							//}else{
							//	$href = 'javascript:void(0)';
							//}
						}
						$m_nm = trim($row['display_name']) != '' ? $row['display_name'] : $row['menu_name'];
						$mnu_nm = str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm);
					?>
						<li>
							<a class="<?php echo isset($AGERSA_menu_sub[$row['office_menu_id']]) ? 'parent' : '' ?>" target="<?php echo $target ?>" href="<?php echo $href ?>">
							<?php 
							
							echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($AGERSA_menu_sub[$row['office_menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?>
							</a>
								<?php 
									if(isset($AGERSA_menu_sub[$row['office_menu_id']])){
										call_office_sub($AGERSA_menu_sub,$row['office_menu_id'],$mnu_nm);
									}
								?>
						</li>
				<?php
					}
				echo '</ul>';
			}
		?>
		</li><font color="white"><b>&nbsp;</b></font>
        <li><a class="parent" href="javascript:void(0)"><?php echo $this->lang->line('tender_notice'); ?></a>
           <?php
		  	function callsub($sub,$parent_id = 0){
				$submenu = $sub[$parent_id];
				$href = 'javascript:void(0)';
				echo '<ul>';
				foreach($submenu as $r){
					$href = '';
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
						if(trim($r['page_office_code']) == 'AGAE'){
							$href = trim($r['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($r['page_url']) : 'javascript:void(0)';
						}else if(trim($r['page_office_code']) == 'AGGSSA'){
							$href = trim($r['page_url']) != '' ? AGGSSA_BASE_URL.'page/'.trim($r['page_url']) : 'javascript:void(0)';
						}else if(trim($r['page_office_code']) == 'AGERSA'){
							$href = trim($r['page_url']) != '' ? AGERSA_BASE_URL.'page/'.trim($r['page_url']) : 'javascript:void(0)';
						}else{
							$href = 'javascript:void(0)';
						}
					}
				?>
					<li>
						<a class="" target="<?php echo $target ?>" href="<?php echo $href ?>">
						<?php 
						$m_nm = trim($r['display_name']) != '' ? $r['display_name'] : $r['menu_name'];
						echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($sub[$r['menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?>
						</a>
						<?php
						if(isset($sub[$r['menu_id']])){
							callsub($sub,$r['menu_id']);
						}?>
					</li>
			<?php 
				}
				echo '</ul>';
			}
		    if(count($tender_notice_menu_details) > 0){
				echo '<ul>';
					foreach($tender_notice_menu_details as $row){
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
							if(trim($row['page_office_code']) == 'AGAE'){
								$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else if(trim($row['page_office_code']) == 'AGGSSA'){
								$href = trim($row['page_url']) != '' ? AGGSSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else if(trim($row['page_office_code']) == 'AGERSA'){
								$href = trim($row['page_url']) != '' ? AGERSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else{
								$href = 'javascript:void(0)';
							}
						}
					?>
						<li>
							<a class="" target="<?php echo $target ?>" href="<?php echo $href ?>">
							<?php 
							$m_nm = trim($row['display_name']) != '' ? $row['display_name'] : $row['menu_name'];
							echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($tender_notice_menu_sub[$row['menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?></a>
								<?php 
									if(isset($tender_notice_menu_sub[$row['menu_id']])){
										callsub($tender_notice_menu_sub,$row['menu_id']);
									}
								?>
						</li>
				<?php
					}
				echo '</ul>';
			}
		  ?>
        </li><font color="white"><b>&nbsp;</b></font>  
		 <li><a class="parent" href="javascript:void(0)"><?php echo $this->lang->line('contact_us'); ?></i></a>
          <?php
		  if(count($contact_us_menu_details) > 0){
				echo '<ul>';
					foreach($contact_us_menu_details as $row){
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
							if(trim($row['page_office_code']) == 'AGAE'){
								$href = trim($row['page_url']) != '' ? AGAE_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else if(trim($row['page_office_code']) == 'AGGSSA'){
								$href = trim($row['page_url']) != '' ? AGGSSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else if(trim($row['page_office_code']) == 'AGERSA'){
								$href = trim($row['page_url']) != '' ? AGERSA_BASE_URL.'page/'.trim($row['page_url']) : 'javascript:void(0)';
							}else{
								$href = 'javascript:void(0)';
							}
						}
					?>
						<li>
							<a class="" target="<?php echo $target ?>" href="<?php echo $href ?>">
							<?php 
							$m_nm = trim($row['display_name']) != '' ? $row['display_name'] : $row['menu_name'];
							echo str_replace(array(' ','–'),array('&nbsp;','&ndash;'),$m_nm); echo isset($contact_us_menu_sub[$row['menu_id']]) ? '<i class="menu-right-arrow"></i>' : ''?></a>
								<?php 
									if(isset($contact_us_menu_sub[$row['menu_id']])){
										callsub($contact_us_menu_sub,$row['menu_id']);
									}
								?>
						</li>
				<?php
					}
				echo '</ul>';
			}
		  ?>


		  
<!-- / Toggle navigation for office Menus -->		  
		  
        </li>
		
 ----- Here is the ending point of closing of all menu items -----      */ ?>		
		
		
		
      </ul>
    </nav>
	<div style="clear:both"></div>
  </div>
</header>

<section class="bodysec ">
<div class="container">

	