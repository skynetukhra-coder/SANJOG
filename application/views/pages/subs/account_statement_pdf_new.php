<style>
@page{margin:1}
td{padding:2.5px;}
tr.transaction td{padding:0px}
</style>
<div style="width:100%;background:#fff;color:#275e93;margin:10px auto;">
	<div style="width:100%; padding:5px 5px 0 5px;font-family:arial">
		<div style="width:60px; float:left"><img src="<?php echo FCPATH; ?>assets/images/ashok-charka.png" style="height:100px;" /></div>
		<div style=" float:left;text-align:center;font-weight:bold">
			<div style="font-size:14px; font-family:arial;letter-spacing:1.5px;">OFFICE OF THE PRINCIPAL ACCOUNTANT GENERAL (A & E ), WEST BENGAL</div>
			<div lang="hi" style="font-size:13px; font-weight:bold;font-family:arial;letter-spacing:1.3px;">कार्यालय प्रधान महालेखाकार ( लेखा एवं हक ) पश्चिम बंगाल</div>
			<div style="font-size:12px; font-family:arial;letter-spacing:1.5px;">8, KIRAN SANKAR ROY ROAD, G.I. PRESS BUILDING, KOLKATA - 700 001</div>
			<div lang="hi" style="font-size:13px;font-weight:normal;letter-spacing:1.3px;">८, किरण शंकर रॉय रोड, जी.आई. प्रेस बिल्डिंग, कोलकता -  ७०० ००१</div>
			<div style="font-size:13px; font-family:arial;letter-spacing:1.5px;">STATEMENTS OF GENERAL / A.I.S.P.F ACCOUTS FOR THE YEAR ENDED <?php echo $f_year ?></div>
			<div lang="hi" style="font-size:13px; font-weight:normal;letter-spacing:1.3px;"><?php echo $f_year ?> को समाप्त वर्ष के लिए सामान्य / ए.आई.एस. भविष्या निधि लेखा विवरण:</div>
		</div>
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
						<td style="width:42%;color:#275e93; border-right:1px solid #275e93;background-color:#f1afaf;border-bottom:1px solid #275e93"><span class="label_text" style="font-size:12px; float:left; line-height:18px;">Int Rate:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo trim($part_1['int_rate']) != '' ? $part_1['int_rate']: '0.00' ?></span> <span>&nbsp;&nbsp;</span> <span class="label_text" style="font-size:12px; float:left; line-height:18px;">Basic Pay:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo trim($part_1['basic_pay']) != '' ? $part_1['basic_pay']: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class="label_text" style="font-size:12px; float:left; line-height:18px;">Nomination:</span><span class="data_text" style="font-size:12px; float:left; line-height:18px;font-family:serif;color:black;font-weight:600;">&nbsp;<?php echo ($part_1['nomination']) == 'N' ? 'No': 'Yes' ?></span> <br />
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
		<div style="width:780px; margin:5px; border:2px solid #275e93;text-align:center">
			<span style="font-family:arial;font-size:13px;">PLEASE SUBMIT NOMINATION, IF NOT DONE EARLIER</span>
		</div>
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