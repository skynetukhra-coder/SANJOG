<style>
@page{margin:1}
td{padding:2.5px;}
tr.transaction td{padding:0px}
</style>
<?php
include_once APPPATH.'/third_party/qrcode/phpqrcode/qrlib.php';
	$yr = str_replace('/','-',$f_year);
	$f_yr = date('Y',strtotime($yr));
	$fin_yr = ($f_yr-1).'-'.$f_yr;
	$tempDir = 'sus/temp/'; 
	$name = $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme'];
	$gpfno =  $subscribers_data['series'].'/WB/'.$subscribers_data['ac_code'];
	$amt = 'Financial Year:'.$fin_yr.'; Opening Balance:'.$part_3['ob'].'; Deposit Amount:'.$part_3['deposits'].'; Withdrawal Amount:'.$part_3['debit'].'; Interest:'.$part_3['interest'].'; Closing Balance:'.$part_3['cb'];
	$filename = $subscribers_data['series'].'_WB_'.$subscribers_data['ac_code'].'_'.$f_yr;
	$codeContents = 'Name : '.$name.'; GPF Account No : '.$gpfno.'; Information : '.$amt; 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
	//urlencode($gpfno)
?>
<div style="width:100%;background:#fff;color:#275e93;margin:10px auto;">
	<div style="width:100%; padding:5px 5px 0 5px;font-family:arial">
		<div style="width:60px; float:left"><img src="<?php echo FCPATH; ?>assets/images/ashok-charka.png" style="height:100px;" /></div> 
<!--		<div style="width:60px; float:left"><img src="http://localhost/assets/images/ashok-charka.png" style="height:100px;" /></div>	-->
		<div style="width:82%;float:left;text-align:center;font-weight:bold">
			<div style="font-size:14px; font-family:arial;letter-spacing:1px;">OFFICE OF THE PRINCIPAL ACCOUNTANT GENERAL (A & E ), WEST BENGAL</div>
			<div lang="hi" style="font-size:13px; font-weight:bold;font-family:arial;letter-spacing:1px;">कार्यालय प्रधान महालेखाकार ( लेखा एवं हक ) पश्चिम बंगाल</div>
			<div style="font-size:12px; font-family:arial;letter-spacing:1px;">8, KIRAN SANKAR ROY ROAD, G.I. PRESS BUILDING, KOLKATA - 700 001</div>
			<div lang="hi" style="font-size:13px;font-weight:normal;letter-spacing:1px;">८, किरण शंकर रॉय रोड, जी.आई. प्रेस बिल्डिंग, कोलकता -  ७०० ००१</div>
			<div style="font-size:13px; font-family:arial;letter-spacing:1px;">STATEMENTS OF GENERAL / A.I.S.P.F ACCOUTS FOR THE YEAR ENDED <?php echo $f_year ?></div>
			<div lang="hi" style="font-size:13px; font-weight:normal;letter-spacing:1px;"><?php echo $f_year ?> को समाप्त वर्ष के लिए सामान्य / ए.आई.एस. भविष्या निधि लेखा विवरण:</div>
		</div>
		<div style="width:80px; float:right"><img style="width:80px; height:80px;" src="<?php echo FCPATH; ?>sus/temp/<?php echo $filename ?>.png" alt="not_loaded.png"></div>  
<!--		<div style="width:80px; float:right"><img style="width:80px; height:80px;" src="http://localhost/userfiles/temp/<?php echo $filename ?>.png" alt="not_loaded.png"></div>	-->
	</div>
	<div id="page_body">
		<div style="padding:2px 5px 0 5px">
			<table style="width:800px;font-family:arial;background-color:#f1afaf; border:1px solid #275e93; border-bottom:0;border-right:0; margin:0px auto;border-collapse: collapse;" cellpadding="0" cellspacing="0">
				<tbody>
					<tr class="row-label" style="background-color:#f1afaf;border-bottom:1px solid #275e93">
						<td colspan="2" style="width:58%;border-bottom:1px solid #275e93;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;"><span class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">Name of Subscriber:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;"><span>&nbsp;&nbsp;<?php echo $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme']?></span></span><br />
							<span lang="hi" class="label_text_hindi">आंशदाता का नाम:</span> </span> </td>
						<td style="width:42%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93"><span class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">GPF A/c No:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;&nbsp;<?php echo strtoupper($subscribers_data['series']).'/WB/'.$subscribers_data['ac_code']?></span><br />
							<span lang="hi" class="label_text_hindi">जी पी एफ खाता संख्या:</span> </span> </td>
					</tr>
					<tr class="row-label" style="background-color:#f1afaf;border-bottom:1px solid #275e93">
						<td style="width:22%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93"><span class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">DOB:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;&nbsp;<?php echo get_date($subscribers_data['dob'])?></span><br />
							<span lang="hi" class="label_text_hindi">जन्मा की तारीख:</span> </span> </td>
						<td style="width:36%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93"><span class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">Treasury:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;&nbsp;<?php echo $part_1['try']?></span></span><br />
							<span lang="hi" class="label_text_hindi">खजाना:</span> </span> </td>
						<td style="width:42%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93"><span class="label_text" style="font-size:12px; float:left; line-height:18px;">Int Rate:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo trim($part_1['int_rate']) != '' ? $part_1['int_rate']: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span> <span>&nbsp;&nbsp;</span> <span class="label_text" style="font-size:12px; float:left; line-height:18px;">Basic Pay:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo trim($part_1['basic_pay']) != '' ? $part_1['basic_pay']: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class="label_text" style="font-size:12px; float:left; line-height:18px;">Nomination:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo ($part_1['nomination']) == 'N' ? 'No': 'Yes' ?></span> <br />
							<span lang="hi" class="label_text_hindi" style="font-size:12px; float:left; line-height:18px;">व्याज दर:</span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span lang="hi" class="label_text_hindi" style="font-size:12px; float:left; line-height:18px;">मूल वेटन:</span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span lang="hi" class="label_text_hindi" style="font-size:12px; float:left; line-height:18px;">नामांकन:</span> </td>
					</tr>
					<tr class="row-label" style="background-color:#f1afaf;">
						<td colspan="3" style="width:100%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93border-top:1px solid #275e93"><div class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">DDO:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_1['ddo_name']?></span><br />
								<span lang="hi" class="label_text_hindi">डी.डी.ओ:</span> </div>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
			$total_records = count($part_2);
			$tot_page = 1;
			$page_records[0] = 15;
			$summary_break = false;
			$trans_table_break = false;
			$summary_table_break = false;
			$information_table_break = false;
			$table_bottom_border = false;
			if(($total_records / 15) <= 1){
				// All in single page
			}else if(($total_records / 30) <= 1){
				// transaction and summary
				$information_table_break = true;
				$page_records[0] = 30;
			}else if(($total_records / 45) <= 1){
				// transaction
				$page_records[0] = 45;
				$summary_table_break = true;
				$table_bottom_border = true;
			}else if(($total_records / 65) <= 1){
				// page 2 transaction and summary
				$page_records[0] = 45;
				$page_records[1] = 65;
				$tot_page = 2;
				$trans_table_break = true;
			}else if(($total_records / 82) <= 1){
				// page 2 transaction and summary
				$page_records[0] = 45;
				$page_records[1] = 82;
				$tot_page = 2;
				$trans_table_break = true;
				$information_table_break = true;
			}else if(($total_records / 95) <= 1){
				// page 2 transaction
				$page_records[0] = 45;
				$page_records[1] = 96;
				$tot_page = 2;
				$trans_table_break = true;
				$summary_table_break = true;
				$table_bottom_border = true;
			}
//			echo '$tot_page '.$tot_page;
//			echo '<br>';
//			echo '$page_records '.print_r($page_records);
//			echo '<br>';
//			echo '$summary_break '.var_dump($summary_break);
//			echo '<br>';
//			echo '$trans_table_break '.var_dump($trans_table_break);
//			echo '<br>';
//			echo '$summary_table_break '.var_dump($summary_table_break);
//			echo '<br>';
//			echo '$information_table_break '.var_dump($information_table_break);
		?>		
		<?php
			for($pg = 0; $pg < $tot_page; $pg++){
				if($pg > 0){
					echo '<pagebreak></pagebreak>'; // page break for pdf
				}
				echo '<div style="padding:'. ( $pg > 0  ? '5px': '0px' ) .' 5px 0 5px">'; // For new page top space required
				echo start_table($table_bottom_border);
				echo get_transaction_header();
				$indx = ($pg == 0) ? 0: $page_records[$pg - 1];
				$tot_empty_cell = 0;
				for($rec =  $indx; $rec < $page_records[$pg]; $rec++){
					if(isset($part_2[$rec])){
						$part2 = $part_2[$rec];
						echo get_transaction($part2);
					}else{
						if($rec >= 15 && $tot_empty_cell > 1 && !$summary_table_break){
							break;
						}

							if($rec <1 ){
							echo get_empty_transaction_info();							
								}
							
						$tot_empty_cell++;
						echo get_empty_transaction();
					}
				}
				echo end_table();
				echo '</div>';
			}	
		?>
		
		<?php
		if($summary_table_break){
			echo '<pagebreak></pagebreak>';
		}?>
		<div style="padding:<?php echo $summary_table_break == true ? '5px': '0px'?> 5px 0 5px">
			<table style="width:800px;font-family:arial; background-color:#f1afaf; border:1px solid #275e93;border-right:0; margin:0px auto;border-collapse: collapse;word-wrap:break-word;table-layout: fixed;" cellpadding="0" cellspacing="0">
				<tbody>
					<tr class="row-label border-top" style="background-color:#f1afaf;border-top:1px solid #275e93">
						<td class="center" style="width:22%;border-right:none;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"></td>
						<td class="center" colspan="4" style="text-align:center;color:#275e93;border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;font-size:12px;line-height:18px; font-weight:bold;">Summary<span lang="hi" style="font-size:11px; font-weight:normal"> जमा विवरण</span> </td>
						<td class="center" rowspan="2" style="width:25%;color:#275e93;text-align:center; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;font-size:12px;line-height:18px; font-weight:bold;"> Missing Credits *</span><br />
							<span lang="hi" style="font-size:11px; font-weight:normal">निकासी विवरण</span> </td>
					</tr>
					<tr class="row-label" style="background-color:#f1afaf;">
						<td style="border-bottom:0; border-right:1px solid #275e93;background-color:#f1afaf;"></td>
						<td class="center" style="width:12.5%;color:#275e93;text-align:center; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;font-weight:bold;font-size:12px;"> Balance - I<br />
							<span lang="hi" style="font-weight:normal;">शेष - १</span> </td>
						<td class="center" style="width:12.5%;color:#275e93;text-align:center; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;font-weight:bold;font-size:12px;"> Balance - II<br />
							<span lang="hi" style="font-weight:normal;">शेष - २</span> </td>
						<td class="center" style="width:15.5%;color:#275e93;text-align:center; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;font-weight:bold;font-size:12px;"> Total<br />
							<span lang="hi" style="font-weight:normal;">कुल</span> </td>
						<td class="center" style="width:12.5%;color:#275e93;text-align:center; border-right:1px solid #275e93;border-bottom:1px solid #275e93;font-weight:bold;font-size:12px;"> Balance - III<br />
							<span lang="hi" style="font-weight:normal;">शेष - ३</span> </td>
					</tr>
					<tr style="line-height:20px">
						<td class="col-label" style="width:22%;color:#275e93;background-color:#f1afaf; border-right:1px solid #275e93; line-height:20px;font-weight:bold;font-size:12px;"> Opening Balance<span lang="hi" style="font-weight:normal;"> / आदि शेष</span> </td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['ob'] ?></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['obua'] ?></td>
						<!-- missing credits -->
						<!--part 4 -->
						<td class="col-label" rowspan="5" style="background-color:#f1afaf;vertical-align:top; border-right:1px solid #275e93;color:#000;width:25%;word-wrap:break-word;overflow-wrap: break-word;font-weight:600;font-size:13px"><?php echo str_replace(',',', ',$part_4['month']) ?></td>
						<!-- missing credits -->
					</tr>
					<tr style="line-height:20px">
						<td class="col-label" style="background-color:#f1afaf;color:#275e93;border-right:1px solid #275e93; line-height:20px;font-weight:bold;font-size:12px;"> Deposits<span lang="hi" style="font-weight:normal;"> / जमा</span></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['deposits'] ?></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['uadeposit'] ?></td>
					</tr>
					<tr style="line-height:20px">
						<td class="col-label" style="background-color:#f1afaf;color:#275e93;border-right:1px solid #275e93; line-height:20px;font-weight:bold;font-size:12px;"> Withdrawls<span lang="hi" style="font-weight:normal;"> / निकासी</span></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['debit'] ?></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
					</tr>
					<tr style="line-height:20px">
						<td class="col-label" style="background-color:#f1afaf;color:#275e93;border-right:1px solid #275e93;line-height:20px;font-weight:bold;font-size:12px;"> Interest<span lang="hi" style="font-weight:normal;"> / व्याज</span></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['interest'] ?></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;"></td>
					</tr>
					<tr class="border-top" style="2line-height:20px">
						<td class="col-label" style="background-color:#f1afaf;color:#275e93;border-right:1px solid #275e93;border-top:1px solid #275e93;border-bottom:1px solid #275e93;line-height:20px;font-weight:bold;font-size:12px;"> Closing Balance **<span lang="hi" style="font-weight:normal;"> / आंतशेष</span></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000;border-top:1px solid #275e93; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['cb'] ?></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000;border-top:1px solid #275e93;"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000;border-top:1px solid #275e93;"></td>
						<td class="whitebg right" style="background-color:#ccdff1;text-align:right; border-right:1px solid #275e93;color:#000;border-top:1px solid #275e93; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px"><?php echo $part_3['cbua'] ?></td>
					</tr>
					<tr class="border-top" style="border-top:1px solid #275e93; height:80px;line-height:100px;">
						<td class="col-label" style="color:#275e93;background-color:#f1afaf; border-right:1px solid #275e93"><span class="label_head bold" style="line-height: 80px;font-size:12px;font-weight:bold">In Words:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="label_head bold" style="font-size:12px;line-height: 80px;font-weight:bold">Rupees</span></td>
						<td class="whitebg" colspan="5" style="background-color:#ccdff1; border-right:1px solid #275e93;color:#000;border-top:1px solid #275e93;font-family:serif;font-weight:600;font-size:13px">
						<?php echo $part_3['cb_in_word'] ?><br />
						<?php echo $part_3['obua_in_word'] ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
		if($information_table_break){
			echo '<pagebreak></pagebreak>';
		}?>
		<div style="padding:<?php echo $information_table_break == true ? '5px': '0px'?> 5px 0 5px">
			<table style="width:800px; border:1px solid #275e93; margin:0px auto;border-collapse: collapse;" cellpadding="0" cellspacing="0">
				<tbody>
					<?php	$sign_tag = isset($row['sign_tag']) ? $row['sign_tag'] : '';
							$officer_name = isset($row['officer_name']) ? $row['officer_name'] : '';
							$officer_name_hindi = isset($row['officer_name_hindi']) ? $row['officer_name_hindi'] : '';
					?>
					<tr class="whitebg border-top" style="border-top:1px solid #275e93">
						<td class="bottom_guide_details" colspan="3" style="color:#275e93;background-color: #ccdff1;font-size: 11px;line-height: 15px;letter-spacing: .3px;border-top:1px solid #275e93"><div>&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;This missing credits and debits pertain to previous years.</div>
							<div>&nbsp;&nbsp;**&nbsp;&nbsp;This also includes Rs............ received / withdrawn in earlier years as detailled below and brought to the account of the subscribers during this year.</div>
							<div lang="hi" style="font-size:9px">&nbsp;खोया हुआ क्रेडिट और डेबिट गत बर्ष संबधित है</div>
							<div lang="hi" style="font-size:9px">&nbsp;पिछले वर्षो में प्राप्ति / निकाशी रुपये ............... जैसा की नीचे विबरन गया है और जिसे इस वर्ष के दौरान अंशदाता के हीसाव मेी लाया गया है, इसमे शामिल है|</div></td>
					</tr>
					<tr style="border-top:1px solid #275e93;background-color: #ccdff1;">
						<td class="bottom_guide_details" colspan="3" style="color:#275e93;font-size: 11px;line-height: 15px;letter-spacing: .3px;border-top:1px solid #275e93;border-bottom:1px solid #275e93"><div>&nbsp;We hereby declare that the above mentioned information based on the records received in this office is accurate and verified to the best of our knowledge. However these balance are subject to verification at the samne time of final payment and liable to revision after ab-initio rechecking of account due to either excess credits, excess interest or any other discrepancies.</div>
							<div lang="hi" style="font-size:9px">&nbsp;एतदद्वारा मै घोषणा करता / करती हूँ की इस कार्यालय मे प्राप्त अभिलेक के आधार पर उक्त सूचना हमारी जानकारी मे सही हैं ओर सत्यापित, किया गया है| तथापि इन शोधों का अंतिम भुगतान के समय सत्यापन किया जाता हैं ओर या तो ओधिक क्रेडिट, ओधिक व्याज ओतोबा अन्य बिसंगगीतियों के कारण ख़ाता के प्रारंभिक पुनः जाँच के पश्चात पुनरीक्षण आवशक हे|</div></td>
					</tr>
					<tr style="background-color: #ccdff1">
						<td class="bottom_guide_details"style="width:20%;color:#275e93;border-right:none;padding-bottom:5px; line-height: 18px;background-color: #ccdff1;font-size: 12px;letter-spacing: .3px;border-top:1px solid #275e93;border-bottom:1px solid #275e93"><div>
								<span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px"><?php //echo $f_year ?></span><br />
								<span>Date <span lang="hi" style="font-size:10px">दिनांक :</span><span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px"> <?php echo $f_year ?></span></span><br />
								<span>Place <span lang="hi" style="font-size:10px">स्थान :</span></span><span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px"> Kolkata</span></div></td>
						<td class="bottom_guide_details center"style="width:55%;color:#275e93;border-right:none;padding-bottom:1px;text-align:center;background-color: #ccdff1;font-size: 12px;line-height: 15px;letter-spacing: .3px;border-bottom:1px solid #275e93;font-family:arial"><div>
								<span>&nbsp;</span><br />
								<span>&nbsp;</span><br />
								<span>&nbsp;</span><span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px"> <?php echo $sign['officer_name']?> </span><span lang="hi" style="color:#000;font-size:13px">/ <?php echo $sign['officer_name_hindi']?> </span><br />
								<span>Accounts Officer / Sr. Accounts Officer <span lang="hi" style="font-size:10px;">लौखा अधिकारी / वरिष्ट लेखा अधिकारी</span></span> </div></td>
						<td class="bottom_guide_details"style="width:25%;color:#275e93;padding-bottom:1px;background-color: #ccdff1;font-size: 12px;line-height: 15px;letter-spacing: .3px;border-bottom:1px solid #275e93;font-family:arial; text-align:center"><div>
								<span><img src="<?php echo FCPATH; ?>files/agae/signature/<?php echo $sign['sign_tag']?>" /></span><br />		
<!--							<span><img src="http://localhost/assets/images/<?php echo $sign['sign_tag']?>" /></span><br />			
								<span>Section's Name .....................</span><br />
								<span lang="hi" style="font-size:10px">अनुमाग का नाम  ...................................</span> </div></td>		 -->
					</tr>
					<tr style="background-color: #ccdff1">
						<td>&nbsp;</td>
						<td style="text-align:center"><div class="center bold" style="color:#275e93;font-size:13px;"><span style="text-align:center;">Confirmation Slip <span lang="hi" style="font-size:10px">पुष्टिकरण पर्चा</span></span></div></td>
						<td>&nbsp;</td>
					</tr>
					<tr style="background-color: #ccdff1">
						<td colspan="3" style="color:#275e93;background-color: #ccdff1;font-size: 12px;line-height: 18px;letter-spacing: .3px;font-family:arial"><div>&nbsp;I <span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px">&nbsp;<?php echo $subscribers_data['fst_nme'].' '.$subscribers_data['mid_nme'].' '.$subscribers_data['lst_nme']?>&nbsp;</span> holder of GPF A/c No. <span class="print_txt" style="color:#000;font-family:serif;font-weight:600;font-size:13px">&nbsp;<?php echo strtoupper($subscribers_data['series']).'/WB/'.$subscribers_data['ac_code']?>&nbsp;</span> hereby confirm the correctness of the Statement of Accounts</div>
							<div lang="hi" style="font-size:10px">मैं ........................... घारक जी.पे.एफ ख्ता संख्या ...................... एतद्वारा ख़ाता की पुष्टि करना / करती हूँ</div></td>
					</tr>
					<tr style="background-color: #ccdff1;">
						<td class="bottom_guide_details" style="color:#275e93;background-color: #ccdff1;font-size: 12px;line-height: 14px;letter-spacing: .3px;font-family:arial"><div> <span>Date <span lang="hi" style="font-size:10px">दिनांक</span></span><br />
								<span>Place <span lang="hi" style="font-size:10px">स्थान</span></span> </div></td>
						<td class="bottom_guide_details" style="color:#275e93;border-right:none;background-color: #ccdff1;font-size: 12px;line-height: 14px;letter-spacing: .3px;">&nbsp;&nbsp;</td>
						<td class="bottom_guide_details" style="color:#275e93;background-color: #ccdff1;font-size: 12px;line-height: 14px;letter-spacing: .3px;"><span></span><br />
							<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature <span lang="hi" style="font-size:10px">हस्ताक्षर</span></span> </td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="width:780px; margin:2px; border:2px solid #275e93;">	
			<span style="font-family:arial;font-size:10px; text-align:center;">&nbsp;&nbsp;Printed on <?php echo date("d-m-Y") ?> at <?php echo date("h:i:s") ?></span>
			<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<span style="font-family:arial;font-size:12px; text-align:right;">PLEASE SUBMIT NOMINATION, IF NOT DONE EARLIER</span>
		</div>
	</div>
	<div style="width:100%;background:#fff;color:#275e93;margin:10px auto;padding:5px 5px 5px 5px;">
			<table style="width:800px; border:1px solid #275e93; margin:0px auto;border-collapse: collapse;" cellpadding="0" cellspacing="0">
				<tbody>
					<tr style="border-top:1px solid #275e93;background-color: #ccdff1;">
						<td class="bottom_guide_details" colspan="3" style="color:#275e93;font-size: 11px;line-height: 15px;letter-spacing: .3px;border-top:1px solid #275e93;border-bottom:1px solid #275e93">
							<div lang="hi" style="font-size:9px">&nbsp;1.
								अंशदाता से निवेदन है कि वह विवरणी की सत्यता की जांच कर लें और यदि कोई त्रुटि पाई जाए तो विवरणी की प्राप्ति की तिथि से तीन माह के भीतर इसकी सूचना लेखा अधिकारी को दें ।
							</div>
							<div>&nbsp;&nbsp;
								The subscriber is requested to satisfy himself/herself as to the correctness of the statement and to bring errors, if any, to the notice of the Accounts Officer within three months from the date of its receipt.
							</div><div lang="hi" style="font-size:9px">&nbsp;2.
								खोये हुए क्रेडिट/डेबिट के विवरण दिए गए हैं। यदि किसी अंशदान/आहरणों की वापसी वास्तव में हुई थी तो अंशदाता प्रत्येक वाउचर की संख्या, उसके नकदीकरण की तिथि, ट्रेजरी का नाम, लेखा का शीर्ष तथा वाउचर की सकल/निवल राशि को दर्शाते हुए उन वाउचरों के विवरण प्रदान करें जिनमें कटौती हुई है/ राशि आहृत की गई है। यह विवरण कार्यालय के प्रमुख के माध्यम से प्रेषित किए जाने चाहिए । 
							</div>
							<div>&nbsp;&nbsp;
								Details of missing credits/debits are given.  In case those subscriptions/refunds of withdrawals which were actually made, the subscribers may give particulars of the vouchers in which the deductions were made/amount withdrawn, indicating the number of each voucher, date of its encashment, name of the treasury, head of accounts and the gross/net amount of the voucher.  These particulars may be furnished through the Head of the office.
							</div>
							<div lang="hi" style="font-size:9px">&nbsp;3.
								यदि कोई अभिदाता अपने किए गए नामांकन में कोई परिवर्तन करना चाहता है तो वह निधि के नियमों के अनुसार एक संशोधित नामांकन प्रेषित कर सकते हैं ।
							</div>
							<div>&nbsp;&nbsp;
								If the subscriber desires to make any alteration in the nomination already made, a revised nomination may be sent forthwith in accordance with the Rules of the Fund.
							</div>
							<div lang="hi" style="font-size:9px">&nbsp;4.
								ऐसे अभिदाता जिन्होनें अपने परिवार के सदस्य/सदस्यों के स्थान पर किसी अन्य व्यक्ति/व्यक्तियों का नामांकन किया हुआ है और बाद में उनका स्वयं का परिवार बन गया है, वह अपने परिवार के सदस्य/सदस्यों के हित में नामांकन जमा करें ।
							</div>
							<div>&nbsp;&nbsp;
								Subscriber who nominated a person/persons other than a member/members of his/her family, and has subsequently acquired a family, should submit a nomination in favour of a member/members of his/her family.
							</div>
							<div lang="hi" style="font-size:9px">&nbsp;5.
								कॉलम शेष-I,शेष-II एवं शेष-III क्रमशः “आहरण योग्य”  “आहरण अयोग्य” एवं "अप्राधिकृत" राशि को दर्शाते हैं । जहां भी कर्मचारियों के जी.पी.एफ. में महंगाई भत्ता/वेतन आयोग की बकाया राशि की किश्त क्रेडिट होने योग्य होती है परंतु उसका भुगतान किसी निर्दिष्ट अवधि के पश्चात किया जाना होता है वहाँ कथित राशि को "शेष-II" में जब तक दर्शाया जाएगा तब तक कि उस राशि को अभिदाता के सामान्य जी.पी.एफ. शेष में विलय करने की अनुमति नहीं मिलती और इस मामले में "शेष-II" में पड़ी हुई समान राशि को "शेष-II" में से घटाकर "शेष-I" में ले लिया जाएगा जोकि अभिदाताओं के निधि खाते में प्रतिदाय एवं अभिदान को अभिलिखित करने के लिए सामान्य कॉलम है । जब भी अभिदाता के वेतन में से ऐसी कोई राशि/अभिदान की कटौती होती है जो नियम के प्रावधानों के अनुसार नहीं है तो उसे कॉलम "शेष-III" में डाल दिया जाता है ।
							</div>
							<div>&nbsp;&nbsp;
								Columns Balance-I, Balance-II and Balance-III indicate the “Withdrawable”  “Non-Withdrawable” and “Un-authorised” amounts respectively.  Whenever there may be any instalment of DA/Pay commission Arrears creditable to the GPF of the employees but payable after certain specified period, the said amount will be indicated in column “Balance-II” till the same is allowed to be merged with the general GPF balance of the subscriber and in that case the amount lying in column  “Balance-II” will be to that extent reduced from “Balance-II” and taken to column “Balance-I” being normal column for recording subscriptions and refunds to the fund account of the subscribers.  Whenever any amount/subscription deducted from the salary of the subscriber is not in accordance with the provisions of the Rule shall be kept in the column “Balance-III”.
							</div>
							<div lang="hi" style="font-size:9px">&nbsp;6.
								जी.पी.एफ. की स्थिति एवं वार्षिक जी.पी.एफ. विवरणी के लिए :(i)“ https://agwb.cag.gov.in/subs/login” पर जाएँ।
							</div>
							<div>&nbsp;&nbsp;
								For G.P.F. Status and Annual GPF Statement (i)   Visit-“https://agwb.cag.gov.in/subs/login”
							</div>
						</td>
					</tr>
					<tr style="border-top:1px solid #275e93;background-color: #ccdff1;">
						<td class="bottom_guide_details" colspan="3" style="text-align: left; color:#275e93;font-size: 11px;line-height: 15px;letter-spacing: .3px;border-top:1px solid #275e93;border-bottom:1px solid #275e93">
							<div>&nbsp;</div>
							<div lang="hi" style="font-size:14px; "><b>नागरिक घोषणापत्र </b></div>
							<div lang="hi" style="font-size:9px;">&nbsp;	हम कार्यालय प्रधान महालेखाकार (लेखा एवं हक़॰), पश्चिम बंगाल के अधिकारीगण/ कर्मचारीगण    </div>
							<div style="font-size:11px;"><b>CITIZENS’ CHARTER </b></div>
							<div style="font-size:9px; ">&nbsp;	We the staff of the office of the Principal Accountant General (A&E), West Bengal  </div>
							<div lang="hi" style="font-size:9px"><b> मानते हैं  </b></div>
							<div lang="hi" style="font-size:9px">&nbsp;	भविष्य निधि के अंशदाताओं को उनकी भविष्य निधि के शेष/बकाया राशि का शीघ्र भुगतान किए जाने के अधिकार को ।  </div>
							<div lang="hi" style="font-size:9px"><b>Recognising</b></div>
							<div>&nbsp;	The right of the Provident Fund subscribers to receive prompt settlement of their provident fund balance/dues </div>
							<div lang="hi" style="font-size:9px"><b>सचेत हैं  </b></div>
							<div lang="hi" style="font-size:9px">&nbsp;	संवीक्षक एवं प्राधिकरण प्राधिकारी के रूप में अपने उत्तरदायित्व के प्रति  </div>
							<div lang="hi" style="font-size:9px"><b>Conscious of </b></div>
							<div>&nbsp;	Our responsibility as scrutinising and authorising authority  </div>
							<div lang="hi" style="font-size:9px"><b>साक्षी हैं  </b></div>
							<div lang="hi" style="font-size:9px">&nbsp;	सेवा की सर्वश्रेष्ठ गुणवत्ता उपलब्ध कराने एवं बनाए रखने की अपनी वचनबद्धता के प्रति  </div>
							<div lang="hi" style="font-size:9px"><b>In Evidence </b></div>
							<div>&nbsp;	Of our commitment to provide and maintain the highest quality of service  </div>
							<div lang="hi" style="font-size:9px"><b>संकल्प लेते हैं </b></div>
							<div lang="hi" style="text-align: right;font-size:9px>&nbsp;">	
								<p >•	सभी संदर्भों में पूर्ण मामलों की प्राप्ति से दो माह के अंदर पेंशन हितलाभों एवं भविष्य निधि देयकों को प्राधिकृत करने का। </p>
								<p lang="hi" style="text-align: right;font-size:9px">•	कमियों एवं त्रुटियों के संदर्भ में, संबन्धित प्राधिकारियों को एक माह के अंदर ही संबोधित करने का ; तथा लाभार्थियों को ऐसी कार्रवाई से अवगत कराने का। </p>
								<p lang="hi" style="text-align: right;font-size:9px">•	शिकायत के सभी मामलों की पावती एक सप्ताह के अंदर देने का। </p>
								<p lang="hi" style="text-align: right;font-size:9px">•	सेवानिवृत्ति लाभों से संबन्धित शिकायतों के प्राप्त होने के दो माह के अंदर ही शिकायतों का अंतिम उत्तर प्रस्तुत करने का।</p>
								<p lang="hi" style="text-align: right;font-size:9px">•	सामान्य भविष्य निधि खातों में विसंगतियों से संबन्धित पत्राचारों की प्राप्ति के तीन माह के अंदर ही अंतिम उत्तर प्रस्तुत करने का। </p>
							</div>
							<div style="font-size:9px"><b>We Resolve </b></div>
							<div>
								<p >•	To authorise pensionary benefits and provident fund dues within two months of receipt of the cases complete in all respect.</p>
								<p >•	To address the concerned authorities, in respect of deficiencies and defects within one month, and to keep the beneficiaries informed of such action.</p>
								<p >•	To acknowledge receipt of all complaints cases within one week.</p>
								<p >•	To furnish final replies to complaints relating to retirement benefits within two months of their receipt.</p>
								<p >•	To furnish final replies to correspondence relating to discrepancies in general provident fund accounts within three months of receipts.</p>
							</div>	
								
							<div lang="hi" style="font-size:9px"><b>हम फिर संकल्प लेते है </b>
							<p>सभी "लाभार्थियों" को कार्यविधि एवं प्रक्रिया पर सभी हितधारकों को उपयुक्त रूप से इस ..............................(दिनांक, माह एवं वर्ष) में. द्वारा ज्ञान एवं सूचना प्रसारित करने का । </p>
							<p>उपर्युक्त संकल्पों को पूरा न किए जाने की स्थिति में इन मामलों के निपटान हेतु एक माह के भीतर वरिष्ठ उप महालेखाकार/उप महालेखाकार (निधि), कार्यालय प्रधान महालेखाकार(लेखा एवं हक.), पश्चिम बंगाल को प्रेषित किया जाना चाहिए ।  </p>
							<p><b>** कृपया मासिक जमा, आहरण तथा अंतशेष आंकड़ों से संबन्धित एसएमएस अलर्ट सुविधा पाने के लिए अपना नाम,एआईएसपीएफ/जीपीएफ खाता संख्या,मोबाइल नंबर,कर्मचारी आई.डी.,जन्मतिथि प्रदान करें। इस सूचना को डाक द्वारा "वरिष्ठ लेखा अधिकारी,एफ.एम., कार्यालय प्रधान महालेखाकार (लेखा एवं हक़.), पश्चिम बंगाल, जी.आई.प्रैस बिल्डिंग, 8, किरण शंकर रॉय रोड, कोलकाता-700001” या ई-मेल edpfnd-agae-wb@nic.in पर भेजें ।</b></p>
							</div>
							<div style="font-size:9px"><b>We Further Resolve </b>
							<p>To suitably disseminate knowledge and information on the procedures and processes to all ‘stake holders’ Given on this ................ (date, month and year). </p>
							<p>Instances of non-fulfilment of any of these resolutions may be brought to the attention of the Sr. Deputy Accountant General/Deputy Accountant General (Fund), office of the Pr. Accountant General (A&E), West Bengal for redressal within a month.</p>
							<p><b>** Please provide your Name, AISPF/GPF Account No., Mobile No., Employee ID, Date of Birth for availing SMS alert facility regarding monthly deposits, Withdrawals and closing balance figures. This information may be sent by post to “Senior A.O./FM, O/o the Pr. AG (A&E), West Bengal, G.I. Press Bldg., 8, Kiran Shankar Roy Road, Kolkata – 700001” or by e-mail to edpfnd-agae-wb@nic.in </b></p>
							</div>
							
							
						</td>
					</tr>
					<tr style="text-align: right;border-top:1px solid #275e93;background-color: #ccdff1;">
						<td class="bottom_guide_details" colspan="3" style="text-align: right; color:#275e93;font-size: 11px;line-height: 15px;letter-spacing: .3px;border-top:1px solid #275e93;border-bottom:1px solid #275e93">
							<div style="text-align: right; font-size:9px">
							<p lang="hi" style="text-align: right;font-size:9px"> हस्ताक्षरित/-</p>
							<p style="text-align: right; font-size:9px">Sd/-</p>
							<p lang="hi" style="text-align: right;font-size:9px">प्रधान महालेखाकार (लेखा एवं हक़.), पश्चिम बंगाल </p>
							<p style="text-align: right; font-size:9px;">Pr. Accountant General (A&E),W.B.</p>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
<?php
function get_transaction($part2){
	$tr = '<tr class="whitebg transaction" style="text-align:center;background-color:#ccdff1;">
				<td style="border-right:1px solid #275e93;color:#000; text-align:right; padding-right:15px;font-family:serif;font-weight:600;font-size:13px">'.$part2['month'].'/'.$part2['sub_year'].'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.$part2['sub'].'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.$part2['ref'].'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.($part2['usub']=="0" ? $part2['oth'] :  $part2['usub']).'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.($part2['oth']=="0" && $part2['usub']!="0" ? "UASUB" : $part2['oth_cat'] ).'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">&nbsp;</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.$part2['dr'].'</td>
				<td style="border-right:1px solid #275e93;color:#000; text-align:center;font-family:serif;font-weight:600;font-size:13px">'.$part2['dr_cat'].'</td>
			</tr>';
	return $tr;
}
function get_empty_transaction(){
	$tr = '<tr class="whitebg transaction" style="text-align:center; font-size:13px; background-color:#ccdff1">
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
				<td style="border-right:1px solid #275e93">&nbsp;</td>
			</tr>';
	return $tr;
}
function get_empty_transaction_info(){
	$tr = '<tr class="row-label" style=" background-color:#ccdff1">
				<td colspan="3" style="width:100%;color:#275e93; border-bottom:1px solid #275e93, border-top:1px solid #275e93"><div class="label_text" style="font-size:12px; float:left; line-height:18px;"> <span class="label_text_eng">Note :</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">Details for this year can not be viewed.</span></div></td>
			</tr>';
	return $tr;
}
function get_transaction_header(){
	$tr = '<tr class="border-top row-label" style="border-bottom:1px solid #275e93; background-color:#f1afaf; text-align:center;border-top:1px solid #275e93">
				<td lang="hi" class="center" colspan="6" style="width:75%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93;line-height:18px;font-size:12px">Credit Details  जमा विवरण</td>
				<td lang="hi" class="center" colspan="2" style="width:25%;color:#275e93;text-align:center; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93;line-height:18px;font-size:12px;">Debit Details  निकासी विवरण</td>
			</tr>
			<tr class="row-label" style="border-bottom:1px solid #275e93; background-color:#f1afaf; text-align:center">
				<td class="center" style="width:11%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Month</span><br />
						<span lang="hi" class="label_text_hindi">मास</span> </div></td>
				<td class="center" style="width:11%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Subs</span><br />
						<span lang="hi" class="label_text_hindi">अंशदान</span> </div></td>
				<td class="center" style="width:12.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Refund</span><br />
						<span lang="hi" class="label_text_hindi">वापसी</span> </div></td>
				<td class="center" style="width:12.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Other</span><br />
						<span lang="hi" class="label_text_hindi">अन्य</span> </div></td>
				<td class="center" style="width:15.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Category</span><br />
						<span lang="hi" class="label_text_hindi">अन्य</span> </div></td>
				<td class="center" style="width:12.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Total</span><br />
						<span lang="hi" class="label_text_hindi">कुल</span> </div></td>
				<td class="center" style="width:12.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Debit</span><br />
						<span lang="hi" class="label_text_hindi">निकासी</span> </div></td>
				<td class="center" style="width:12.5%;color:#275e93;border-right:1px solid #275e93;text-align:center;background-color:#f1afaf;border-bottom:1px solid #275e93"><div class="label_head" style="font-size:12px; line-height:18px;"> <span class="label_text_eng bold" style="font-weight:bold">Type</span><br />
						<span lang="hi" class="label_text_hindi">प्रकार</span> </div></td>
			</tr>';
	return $tr;
}
function start_table($table_bottom_border){
	$table = '<table style="width:800px;font-family:arial; background-color:#f1afaf; border:1px solid #275e93; '.($table_bottom_border ? '': 'border-bottom:0;').'border-right:0; margin:0px auto;border-collapse: collapse;" cellpadding="0" cellspacing="0">
				<tbody>';
	return $table;
}
function end_table(){
	$table = '</tbody>
			</table>';
	return $table;
}
?>