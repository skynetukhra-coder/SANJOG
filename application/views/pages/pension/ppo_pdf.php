<style>
@page{margin:10}
.data{color:#000;font-size:13px;}
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
<div style="width:800px;background:#fff;color:#018401;margin:0px auto; padding:5px 5px 0 5px;border:3px solid #018401; font-size:13px; font-family:Georgia, "Times New Roman", Times, serif">
	<div style="width:100%;">
		<div style="width:60px; float:left"><img src="<?php echo FCPATH; ?>assets/images/ashok-charka-green.png" style="height:80px;" /></div>
		<div style=" float:left;text-align:center;font-weight:bold">
			<div style="font-size:15px; font-family:serif;">OFFICE OF THE PRINCIPAL ACCOUNTANT GENERAL (A & E ), WEST BENGAL</div>
			<div style="font-size:15px; font-family:serif;">TREASURY BUILDINGS, 2, GOVT PLACE (WEST), KOLKATA - 700 001</div>
			<div style="font-size:13px; font-family:arial;">(INTIMATION LETTER REGARDING ISSUE OF P.P.O.)</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="width:100%; display:block; text-align:right">
		<div style="width:220px; display:inline-block; padding:4px 10px; margin:2% 0% 0 62%; border:1px solid #018401; font-size:12px; font-family:"Times New Roman", Times, serif"><b>By Regd./Speed Post/Express Parcel</b></div>
	</div>
	<div style="width:94%; float:left; padding:0 20px"> <span>No. &nbsp;&nbsp;<span class="data"><?php echo $case[0]['section'] .'/'. $case[0]['file_no'] .'/'. $case[0]['appln_chg_no'] .'/'. $case[0]['application_no'] .'/'. $T3X['inout_no']?></span></span> <br />
		<br />
		<span>To,</span> <br />
		<div style="padding-left:25px; width:70%; display:block; float:left"></div>
		<div style="font-weight:bold;  width:24%; display:block; float:right">DATED: <span class="data"><?php echo  get_date($T3X['inout_dspch_date'])?></span></div>
		<div style="width:75%; float:left; margin-left:20px"> 
		The 
		<span class="data" style=""><?php echo  $T3X['inout_sndr_name']?> 
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
		</span>
		</div>
		<div class="data" style="width:100%; float:right; margin-right:100px; text-align:right">
			<?php if(strtolower($T3X['f_get_lov_name_inout_dispatch_mode']) == 'bank'){
				  	echo 'Branch: '.$case[0]['apen_branch'];
				  }
			?>
		</div>
		<div style="width:100%; float:left; margin-top:10px">Sir,</div>
		<div style="width:100%; float:left; margin-top:5px">
			<p style="line-height:30px; font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am forwarding herewith the P.P.O. No. &nbsp;&nbsp;<span class="data"><?php echo $case[0]['ppo_no']?></span>&nbsp;&nbsp;
				issued in favour of &nbsp;&nbsp;<span class="data"><?php echo $case[0]['pnsr_name'] ?>, <?php echo $case[0]['designation'] ?></span>&nbsp;&nbsp; with request to arrange for payment of pension / provisional pension w.e.f &nbsp;&nbsp; <span class="data"><?php echo isset($pension[0]['pension_date']) ? get_date($pension[0]['pension_date']): '' ?> </span> &nbsp;&nbsp; <b>Subject to observance of instructions overleaf as well as fulfillment of conditions</b> specified in the P.P.O. and West Bengal Treasury Rules. Receipt of the letter alongwith enclosures may please be acknowledged.</p>
		</div>
		<div style="width:100%; float:left;">
			<div style="width:95%; float:right; display:block;padding-right:35px; text-align:right">Yours Faithfully</div>
			<div style="width:95%; float:right; display:block;padding-right:35px; text-align:right"><span>Sd/-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
			<div style="width:100%; float:right; display:block;text-align:right"><strong>Assistant Accounts Officer</strong></div>
		</div>
		<div style="width:100%; float:left; margin-top:20px"> Enclosures:<br />
			i) Both halves of the aforesaid PPO, ii) Joint/Single Photograph<br />
			iii) Descriptive Rolls, iv) Specimen Signature/Left thumb impression, v) Nomination for LTA<br />
			<span style="margin-left:23px;">or may be obtained locally.</span> </div>
		<div style="width:100%; float:left; margin-top:16px">N.B&nbsp;&nbsp;&nbsp;: <span style="border-bottom:1px solid #018401">For Instructions See Overleaf</span></div>
	</div>
	<div style="width:100%; float:left; height:3px; margin:30px 0; border-bottom:1px dashed #018401"></div>
	<div style="width:100%; float:left; display:block; text-align:center">
		<div style="width:220px; padding:5px 10px; margin-left:32%; border:1px solid #07bb07; font-size:12px"><b>By Regd./Speed Post/Express Parcel</b></div>
	</div>
	<div style="width:94%; float:left; padding:0 20px">
		<div style="width:100%; float:left; margin-top:10px">
			<div style="width:75%; float:left;">No. &nbsp;&nbsp;<span class="data"><?php echo $case[0]['section'] .'/'. $case[0]['file_no'] .'/'. $case[0]['appln_chg_no'] .'/'. $case[0]['application_no'] .'/'. $T3X['inout_no']?></span></div>
			<div style="width:20%; float:left;">Dated &nbsp;<span class="data"><?php echo  get_date($T3X['inout_dspch_date'])?></span></div>
		</div>
		<div style=" margin-top:10px">
			<p style="line-height:30px;"> Copy forwarded to the &nbsp;&nbsp;<span class="data"><?php echo $address_A?></span> &nbsp;&nbsp;with reference to his letter no.&nbsp;&nbsp;<span class="data"><?php echo $case[0]['memo_no']?></span> &nbsp;&nbsp; dated &nbsp;&nbsp;<span class="data"><?php echo get_date($case[0]['memo_date'])?></span> &nbsp;&nbsp; He is requested to <span style="font-weight:bold; border-bottom:1px solid #018401; padding-bottom:5px;">handover the enclosed copy of this letter to the above noted Retiring Employee</span> alongwith the certificates as mentioned overleaf on the date of his/her (retiring employee) retirement. </p>
		</div>
		<div style="width:100%; float:left; ">
			<div style="width:50%; float:left;"> Enclosures:<br />
				i)&nbsp; &nbsp;Pensioner's copy of the intimation letter<br />
				ii)&nbsp;&nbsp;Authority for RG<br />
				iii)&nbsp;Authority for CVP<br />
				<div style="margin-top:10px">N.B&nbsp;&nbsp;&nbsp;: <span style="border-bottom:1px solid #018401">For Instructions See Overleaf</span></div>
			</div>
			<div style="width:40%; float:left; margin-top:0; text-align:right"><strong>Assistant Accounts Officer</strong></div>
		</div>
		<div style="width:100%; float:left; margin:20px 0 4px; font-size:13px; font-style:italic; font-weight:bold; text-align:center;">In all Correspondence please quote File Id / Application No.</div>
	</div>
	<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
