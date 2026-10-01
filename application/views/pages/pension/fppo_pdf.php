<style>
.data{color:#000;font-size:13px;}
@page{margin:10}
</style>
<?php
if(isset($dispatched[0]['inout_out_type']) && strtolower($dispatched[0]['inout_out_type']) == 'x'){
	$T3X = $dispatched[0];
	$T3A = $dispatched[1];
}else{
	$T3X = $dispatched[1];
	$T3A = $dispatched[0];
}
?>
<div style="width:800px;background:#fff;color:#e97900;margin:0px auto; padding:5px 5px 0 5px;border:3px solid #e97900; font-size:13px; font-family:Georgia, "Times New Roman", Times, serif">
	<div style="width:100%;float:left;text-align:center;font-weight:bold; padding:10px 0 0">
		<div style="font-size:11px; font-family:serif; text-decoration:underline; margin-bottom:11px">BY SPECOAL MESSENGER / REGISTERED POST / SPEED POST</div>
		<div style="font-size:14px; font-family:serif; margin-bottom:3px">OFFICE OF THE PR. ACCOUNTANT GENERAL (A & E), WEST BENGAL</div>
		<div style="font-size:14px; font-family:serif; margin-bottom:3px">TREASURY BUILDINGS, KOLKATA - 700 001</div>
		<div style="font-size:14px; font-family:serif;">(INTIMATION LETTER REGARDING ISSUANCE OF FPPO)</div>
		<div style="clear:both;"></div>
	</div>
	<div style="width:94%; float:left; padding:0 20px; font-weight:bold">
		<div style="width:100%; float:left; margin-top:30px">
			<div style="width:70%; display:block; float:left">No &nbsp;&nbsp;<span class="data"><?php echo $case[0]['section'] .'/'. $case[0]['file_no'] .'/'. $case[0]['appln_chg_no'] .'/'. $case[0]['application_no'] .'/'. $T3X['inout_no']?></span></div>
			<div style="font-weight:bold;  width:24%; display:block; float:left">DATED: <span class="data"><?php echo  get_date($T3X['inout_dspch_date'])?></span></div>
		</div>
		<div style="width:100%; float:left; margin-top:25px">To<br />
			The <span class="data" style=""><?php echo  $T3X['inout_sndr_name']?>
			<?php 
			$addr=$addr1 = array();
			$address = $T3X['inout_sndr_name'];
			if(trim($T3X['inout_out_address']) != ''){ $addr[] = $T3X['inout_out_address'];}
			if(trim($T3X['address_1']) != ''){ $addr[] = $T3X['address_1'];}
			if(trim($T3X['address_2']) != ''){ $addr[] = $T3X['address_2'];}
			if(trim($T3X['address_3']) != ''){ $addr[] = $T3X['address_3'];}
			if(trim($T3X['city']) != ''){ $addr1[] = $T3X['city'];}
			if(trim($T3X['pin']) != ''){ $addr1[] = $T3X['pin'];}
			if(!empty($addr)){echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.implode(', ',$addr);}
			if(!empty($addr1)){echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.implode(' - ',$addr1);}
			
			$addr_A=$addr1_A = array();
			$address_A = $T3A['inout_sndr_name'];
			if(trim($T3A['inout_out_address']) != ''){ $addr_A[] = $T3A['inout_out_address'];}
			if(trim($T3A['address_1']) != ''){ $addr_A[] = $T3A['address_1'];}
			if(trim($T3A['address_2']) != ''){ $addr_A[] = $T3A['address_2'];}
			if(trim($T3A['address_3']) != ''){ $addr_A[] = $T3A['address_3'];}
			if(trim($T3A['city']) != ''){ $addr1_A[] = $T3A['city'];}
			if(trim($T3A['pin']) != ''){ $addr1_A[] = $T3A['pin'];}
			if(!empty($addr)){$address_A .= ', '.implode(', ',$addr_A);}
			if(!empty($addr1)){$address_A .= ', '.implode(' - ',$addr1_A);}
			?>
			</span> </div>
		<div class="data" style="width:100%; float:right; margin-right:100px; text-align:right">
			<?php if(strtolower($T3X['f_get_lov_name_inout_dispatch_mode']) == 'bank'){
				  	echo 'Branch: '.$case[0]['apen_branch'];
				  }
			?>
		</div>
		<div style="width:100%; float:left; margin-top:10px">Sir,</div>
		<div style="width:100%; float:left; margin-top:5px">
			<p style="line-height:30px; font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am forwarding herewith the F.P.P.O. No. &nbsp;&nbsp;<span class="data"><?php echo $case[0]['ppo_no']?></span>&nbsp;&nbsp;
				issued in favour of Sri/Smt. &nbsp;&nbsp;<span class="data"><?php echo isset($spouce[0]['spouse_name']) ? $spouce[0]['spouse_name']: '' ?>, <?php echo isset($spouce[0]['relationship']) ? $spouce[0]['relationship']: '' ?> of <?php echo $case[0]['pnsr_name'] ?></span>&nbsp;&nbsp; with the request to arrange Payment of FAMILY PENSION w.e.f &nbsp;&nbsp; <span class="data"><?php echo (isset($pension[0]['efp_date']) && trim($pension[0]['efp_date']) != '0000-00-00 00:00:00') ? get_date($pension[0]['efp_date']): '' ?> </span> &nbsp;&nbsp; subject to observance of instructions overleaf as well as fulfillment of conditions</b> specified in the F.P.P.O. and West Bengal Treasury Rules.</p>
			<p style="line-height:20px; font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receipt of the Letter along with enclosures may please be acknowledged.</p>
		</div>
		<div style="width:96%; float:left;">
			<div style="width:95%; float:right; display:block; padding-right:25px; text-align:right">Yours faithfully</div>
			<div style="width:95%; float:right; display:block;padding-right:35px; text-align:right"><span>Sd/-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
			<div style="width:100%; float:right; display:block; text-align:right"><strong>Assistant Accounts Officer</strong></div>
		</div>
		<div style="width:100%; float:left; margin-top:10px">
			<div style="width:100%; float:left;">Enclosures:</div>
			<div style="width:100%; float:left; line-height:15px; margin-left:40px"> i)&nbsp;&nbsp;&nbsp;&nbsp;Both Halves of the aforesaid FPPO<br />
				ii)&nbsp;&nbsp;&nbsp;Passport Size Photograph<br />
				iii)&nbsp;&nbsp;Descriptive Rolls, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; May be obtained locally before payment<br />
				iv)&nbsp;&nbsp;Specimen Signature / Left Thumb Impression, </div>
		</div>
		<div style="width:100%; float:left; margin-top:16px">N.B.:&nbsp;&nbsp;&nbsp; <span style="text-decoration:underline">For Instructions See Overleaf</span></div>
		<div style="width:100%; float:left; height:3px; margin:20px 0; border-bottom:1px dashed #e97900"></div>
		<div style="width:100%; float:left; display:block; text-align:center">
			<div style="display:inline-block; padding:0; margin:0; font-size:12px; text-decoration:underline">BY SPECIAL MESSANGER / REGISTERED POST / SPEED POST</div>
		</div>
		<div style="width:100%; float:left; padding:0">
			<div style="width:100%; float:left; margin-top:13px">
				<div style="width:70%; float:left;">No. &nbsp;&nbsp;<span class="data"><?php echo $case[0]['section'] .'/'. $case[0]['file_no'] .'/'. $case[0]['appln_chg_no'] .'/'. $case[0]['application_no'] .'/'. $T3X['inout_no']?></span></div>
				<div style="width:30%; float:right;">DATED:&nbsp;<span class="data"><?php echo  get_date($T3X['inout_dspch_date'])?></span></div>
			</div>
			<p style="line-height:30px;"> Copy forwarded to the &nbsp;&nbsp;<span class="data"><?php echo $address_A?></span> &nbsp;&nbsp; with reference to his letter no.&nbsp;&nbsp;<span class="data"><?php echo $case[0]['memo_no']?></span> &nbsp;&nbsp;  dt &nbsp;&nbsp;<span class="data"><?php echo get_date($case[0]['memo_date'])?></span> &nbsp;&nbsp;He is requested to hand over the enclosed copy of this letter to the above noted FAMILY PENSIONER along with the certificates as mentioned overleaf.</p>
			<div style="width:100%; float:left; margin-top:10px">
				<div style="width:100%; float:left;"> Enclosures:<br />
					<br />
					i)&nbsp; &nbsp;Family Pensioner's copy of the intimation letter<br />
					ii)&nbsp;&nbsp;DGPO-I & II and </div>
			</div>
			<div style="width:100%; float:left; margin-top:10px">
				<div style="width:60%; float:left;">N.B&nbsp;&nbsp;&nbsp;: <span style="text-decoration:underline">For Instructions See Overleaf</span></div>
				<div style="width:40%; float:left; margin-top:0; text-align:right"><strong>Assistant Accounts Officer</strong></div>
			</div>
			<div style="width:100%; float:left; margin:24px 0 0; padding-bottom:3px; font-size:10px; text-align:center">In all Correspondence please quote File Id / Application No.</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</div>
