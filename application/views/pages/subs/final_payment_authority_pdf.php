<style>
@page{margin:1}
.st{font-weight:bold}
.gray_bg{background:gray;}
.pad_5{padding:5px;}
.full_wid{width:100%}
.center{text-align:center}
</style>
<div style="width:100%; color:#000; font-size:11px; font-family:arial; margin:0 auto; padding:17px 15px; line-height:13px">
	<div style="width:100%; padding:5px 5px 0 5px;">
		<div lang="hi" style="float:left; margin-bottom:-55px">
			सा. भ. नि. फॉर्म - 11<br />
			G.P.F. Form - 11<br/>
			<span class="st">Request No &nbsp;&nbsp; <?php echo $fpa1['request_no'] ?></span><br/>
			<span class="st">Request Date &nbsp;&nbsp; <?php echo date('d/m/Y',strtotime($fpa1['request_date'])) ?></span>
		</div>
		<div style=" float:left;text-align:center">
			<div lang="hi" style="font-size:12px; font-weight:bold;font-family:arial; margin-bottom:1px">प्रधान महालेखाकार ( लेखा एवं हक. ) पश्चिम बंगाल का कार्यालय </div>
			<div lang="hi" style="font-size:9px;font-weight:normal; margin-bottom:1px">भारत सरकार प्रेस बिल्डिंग, 8, किरण शंकर राय रोड, कोलकाता -  700 001</div>
			<div style="font-size:10px; font-family:arial; font-weight:bold; margin-bottom:1px">OFFICE OF THE PRINCIPAL ACCOUNTANT GENERAL (A & E ), WEST BENGAL</div>
			<div style="font-size:8px; font-family:arial; font-weight:lighter">Govt. of India Press Building, 8, Kiran Shankar Ray Road, Kolkata - 700 001</div>
		</div>
	</div>
	<div style="width:100%; margin:7px 0 0">
		<div style="width:50%; float:left;">
			<div lang="hi" style="margin-bottom:1px">सं / No &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo $fpa1['authority_no']?></span></div>
			<div lang="hi" style="margin-bottom:1px">प्रेषक / From</div>
			<div style="margin-bottom:3px; margin-left:55px; margin-bottom:9px">The &nbsp;&nbsp;&nbsp;&nbsp; <span class="st">Sr. Accounts Officer</span></div>
			<div lang="hi" style="margin-bottom:3px">सेवा मे / To</div>
			<div style="margin-left:55px; margin-bottom:2px"><span class="st full_wid"><?php echo $fpa1['ddo_address']?></span></div>
		</div>
		<div style="width:50%; float:left; text-align:right">
			<div lang="hi" style="margin-bottom:3px;margin-bottom:4px">तारीख ................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="margin-bottom:3px; margin-left:55px; margin-bottom:12px">Date &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo date('d/m/Y',strtotime($fpa1['authority_gen_date'])) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
			<?php
			//if(trim($fpa1['not_payablebefore_date']) != ''){
			//if(trim($fpa1['nominee_name']) != '.'){
			if ($fpa1['not_payablebefore_date'] <> '0000-00-00 00:00:00' ) {
				echo '<div style="margin-bottom:3px; margin-left:55px; margin-bottom:12px; width:100%; text-align:center; padding:5px;background:#CCCCCC"><span class="st">Not Payable Before : '.get_datepicker_date($fpa1['not_payablebefore_date']).'</span></div>';
			}
				$number = $fpa1['final_amt'] + 1;
				$number_in_words =  ucwords(number_to_word($number));
				$hirani = ucwords(number_to_word($fpa1['final_amt']));
			?>
			<div style="margin-bottom:3px; margin-left:55px; margin-bottom:12px; width:100%; text-align:center; padding:5px;background:#CCCCCC"><span class="st">Under Rs. <?php echo $number.'.00';?> ( <?php echo $number_in_words.' only';?> )</span></div>
		</div>
	</div>
	<div style="width:100%; margin:5px 0 0">
		<div lang="hi">महोदय/Sir</div>
		<p lang="hi" style="text-indent:60px; margin-bottom:5px; line-height:15px"> श्री/श्रीमती/कुमारी ...................................................................................................................  के नाम सा. भ. नि. (खाता संख्या ......................................  ) मे जमा राशि के अंतिम प्रत्याहरण का आवेदन पत्र प्रेषित करते हुए आपको पत्र संख्या ....................................................................................... तारीख .............................................के संदर्भ मे; मैं आपको ...................................................................................................................... खजाना/इस कार्यालय के रोकड़ काउंटर पर ख. नि. 50- क के फार्म में एक बिल प्रस्तुत करके समस्त/प्राप्त/अबशिष्ट जमा .................................................................................................................................................. तक निकाले गए ब्याज सहित ......................................... रुपये ( .......................................................................................................................................................... रुपये ) की राशि को निकालने के लिये प्राधिकृत करता हुं | अबशिष्ट शेष की अदायगी के लिए प्राधिकार पत्र ............................................................................ के क्रेडिटों का पता लगने तथा उसके ख़ाता-लेखा में समायोजित होने पर तुरन्त जारी कर दिया जाएगा | </p>
		<p style="text-indent:60px; line-height:15px">I am to invite a reference to your letter No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo $fpa1['letter_no']?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dated &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo date('d/m/Y',strtotime($fpa1['letter_date']))?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; forwarding the application of Shri/Shrimati/Kumari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo strtoupper((trim(strtolower($fpa1['retirement_type'])) ==  'death' ? 'Late ' : ''). $fpa1['subscriber_name'])?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for the final withdrawal of sums at the credit of his/her G. P. F. (Account No. &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo $fpa1['series'].'/WB/'.$fpa1['ac_code']?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) and to authorise you to draw a sum of Rs.  &nbsp;&nbsp;<span class="st"><?php echo $fpa1['final_amt'].'.00';?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			(Rupees &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo $hirani;?></span>&nbsp;&nbsp;&nbsp;&nbsp; ) only representing the entire/available/residual deposits with interest calculated thereon up to    <span class="st"> as admissible </span> by presenting a bill in form T.R. -50 at  &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo $fpa1['try_name']?></span>&nbsp;&nbsp;&nbsp;&nbsp; Treasury/Cash counter of this office. Authority for payment of the residual balance will issue as soon as the credits for    ............................................................................................................are traced and adjusted in his/her ledger account. </p>
		<p lang="hi" style="margin-top:1px; text-indent:50; margin:0px; padding:0">(2) &nbsp; &nbsp; यह रकम सामान्य भविष्य निधि नियमाबली के नियम ........................................................................................के शर्तो के अनुसार ही अदा की जानी चाहिए तथा रकम के संबितरण का एक प्रमाणपत्र इस कार्यालय को प्रस्तुत किया जाना चाहिए |</p>
		<p style="margin:0; padding:0 0 10px 0;text-indent:75;">The disbursement should be made in terms of Rule &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="st"><?php echo $fpa1['rule_no']; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; of the G.P.F. Rules and a certificate of disbursement of the amount furnished to this office.</p>
		<p lang="hi" style="text-indent:50; margin:0px; padding:0">(3)&nbsp; &nbsp;निम्नलिखित व्यक्तियों को उनके नाम के सामने लिखित अनुपात में राशि अदा की जानी चाहिए : </p>
		<p style="text-indent:50;margin-left:70px; margin:0px; padding:0">The amount should be paid to the person(s) named below in the proportion mentioned against each :</p>
		<?php
			if(!empty($nominees)){
				$sl = 1;
				echo '<br>';
				foreach($nominees as $nomi){
					if(trim($fpa1['nominee_name']) != '.'){
						echo '<div style="margin-left:70px;padding-bottom:1px;">
						('. number_to_roman($sl++) .')&nbsp;&nbsp;&nbsp; &nbsp;<span class="st">'.$nomi['nominee_name']. ' ('.$nomi['nominee_guardian_name'].') Rs.'.$nomi['amt_topay'].' Only'.'</span>
						</div>';
					}	
				}
				for($i = $sl; $i < 6; $i++){
					echo '<br>';
				}
				echo '<br>';
			}else{
				echo '<div style="margin-left:70px; margin-bottom:4px">(i)&nbsp;&nbsp;&nbsp; &nbsp;........................................................................................................................................................................................................................</div>
          
          <div style="margin-left:70px; margin-bottom:4px">(ii)&nbsp;&nbsp;&nbsp; ........................................................................................................................................................................................................................</div>
          
          <div style="margin-left:70px; margin-bottom:4px">(iii)&nbsp;&nbsp;&nbsp;........................................................................................................................................................................................................................</div>
          
          <div style="margin-left:70px; margin-bottom:4px">(iv)&nbsp;&nbsp; ........................................................................................................................................................................................................................</div>
          
          <div style="margin-left:70px; margin-bottom:4px">(v)&nbsp;&nbsp; .........................................................................................................................................................................................................................</div>
          
          <div style="margin-left:70px; margin-bottom:4px">(vi)&nbsp;&nbsp;.........................................................................................................................................................................................................................</div>';
			}
		?>
		
		<p lang="hi" style="margin-top:1px; text-indent:50; margin:0px; padding:0">(4)&nbsp; &nbsp;प्राप्तकर्ता (कर्ताओ) को यह सूचित कर दिया जाए की जब उसे / उन्हें राशि पेश की जाए तो बह उसी समय उसे / उन्हें स्वीकार करनी होगी और उसके बाद कोई ब्याज़ नही दिया जाएगा |</p>
		<p style="text-indent:68; margin:0px;  padding:0 0 10px 0;">The payee(s) should be informed that he/she/they shall have to accept the amount when tendered and that no further interest will be allowed.</p>
		<p lang="hi" style="text-indent:50; margin:0px; padding:0">(5)&nbsp; &nbsp;अदा किए जाने पर राशि .............................................................................................................................................................................. को डेबिट योगी योग्य है |</p>
		<p style="margin-bottom:1px; text-indent:70; margin:0px; padding:0 0 10px 0;">The amount when paid is debitable to &nbsp;&nbsp;<span class="st"><?php echo $fpa1['drcr_head'] ?></span></p>
		<p lang="hi" style="margin:0; text-indent:50">(6)&nbsp;&nbsp; ................................................................................................................................................................ खजाना अधिकारी को इसके अनुसार सूचित कर दिया गया हैं |</p>
		<p style="margin:0px; text-indent:72; padding:0 0 10px 0;">The T.O. &nbsp;&nbsp;<span class="st"><?php echo $fpa1['try_name'] ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;has been advised accordingly.</p>
		<div lang="hi" style="margin-bottom:1px; margin-top:1px; text-indent:50">(7)&nbsp; &nbsp; कृपया इस प्राधिकार पत्र की पाबती भेजें |</div>
		<div style="margin-bottom:1px; text-indent:73">The receipt of this authority may please be acknowledged.</div>
		<p style="text-indent:50"><span class="st">Before drawal the DDO is requested to ensure himself  that no other NR/TA/90% has been drawn during the period of 12 months immediately precceding the date of the subscriber's quitting service/retirement/death/proceeding on leave preparatory tn retirement, except those which have been certified by DDO/HOD at the time of preferring claim.</span></p>
		<?php 
			if (strlen(trim($fpa1['alias_name']))==0) {
				$fpa1['alias_name']=$fpa1['subscriber_name'];
			} 
			if ($fpa1['subscriber_name']<>$fpa1['alias_name']) {
			echo '<p style="text-indent:50"><span class="st">Before payment it should ensure that Shri/smt &nbsp;&nbsp;'. $fpa1['subscriber_name'] .'  and Shri/smt '. $fpa1['alias_name'] .' is one and same person and holder of GPF A/C No. '.$fpa1['series'].'/WB/'.$fpa1['ac_code'].'</span>
			</p>';
		}	
		?>		
		<div style="width:100%; float:left">
			<div style="width:70%; float:left">
				<!--<div lang="hi" style="margin-bottom:1px; margin-top:20px">सं./No. &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo isset($fpa2['authority_no']) ? $fpa2['authority_no'] : '' ?></span><br />-->
				<div lang="hi" style="margin-bottom:1px; margin-top:20px">सं./No. &nbsp;&nbsp;&nbsp;&nbsp;<span class="st"><?php echo isset($fpa1['authority_no']) ? substr_replace($fpa1['authority_no'] ,"/2",-2) : '' ?></span><br />
				
					सूचना और आबश्यक कारेबाई के .............................. <br />
					खजाना अधिकारी को एक प्रति प्रेषित |
					<div style="margin-bottom:1px; margin-top:20px; line-height:15px">Copy to the Treasury Officer &nbsp;&nbsp; <span class="st"><?php echo $fpa1['try_name'] ?><br /><?php echo $fpa1['try_address'] ?></span> <br />for
						infirmation ans necessary action.</div>
				</div>
				<p style="margin:20px 0 0 0">* See condition overleaf<br />&nbsp;&nbsp;P.T.O</p>
			</div>
			<div style="width:20%; float:right; text-align:center; margin-top:5px;">
				<div lang="hi" style="margin-bottom:1px">भबदीय<br />
					Yours faithfully,</div>
				<div lang="hi" style="margin-bottom:1px; margin-top:20px;"><br /><br /><br /><br />
					Sr. Accounts Officer</div>
				<div lang="hi" style="margin-bottom:1px; margin-top:20px;"><br /><br /><br /><br /><br /><br />
					Sr. Accounts Officer</div>
			</div>
		</div>
		<div lang="hi" style="width:100%; float:left; text-align:right"></div>
	</div>
	<br /><br />
	<p></p>
	<p></p>
	<div lang="hi" style="font-size:13px; padding-top:50px; line-height:20px">
	<div lang="hi" style="width:12%; float:left;">
		<p>
			टिप्पणियां  &nbsp;&nbsp; (1)<br />
			Notes :-
		</p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p style="text-align:right; padding-top:10px;">(2)&nbsp;&nbsp;&nbsp;&nbsp;</p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p style="text-align:right; padding-top:4px">(3)&nbsp;&nbsp;&nbsp;&nbsp;</p>
	</div>
	<div lang="hi" style="width:88%; float:left; text-align:justify;">
		<p>यह फार्म ऐसे अराजपत्रित अभिदाताओं के मामले में प्रयोग किया जाएगा जिन्होंने अदायगी उस कार्यालायाधक्ष के माध्यम मे प्राप्‍त करनी पत्र चाही ही जहां बे अंतिम बार सेवारत भे| ऐसे मामलें मैं जहां अराजपत्रित अभिदाता खजानों पर ही अदायगी लेने के लिए एच्छुक हीं प्राधिकार सा. भ. नि. फॉर्म 11-क में जारी किए जाएंगे|</p>
		<p style="font-size:14px">The form shall be used in the case of non-gazetted subscribers desiring payment through the heads of the offices in which they served last. In cases where non-gazetted subscribers desire payment at treasuries direct, authorities shall be issued in form G.P.F. 11-A.</p>
		<p>यह प्राधिकार पत्र चैकौ की भांति ही लिखे जाने चहिएं देखें ले. ख. नि. खण्ड 1 का नियम 156 अर्थात जिस राशि के लिए यह प्राधिकार पत्र जारी किया जाता है उससे कुछ अधिक राशि शब्दीं में तिरछी अौर लिखी जानी चाहिए|</p>
		<p style="font-size:14px">This authority must be written in the manner of cheque vide rule 156 of C.T. Rs. Vol. 1 <em>i.e.</em>, it should have written across it in words a sum little in excess for which it is issued.</p>
		<p>यह प्राधिकार पत्र हसके जारी हीने की तारीख से छः महीने की अबधि के लिए मान्य होगा अौर यहि किसी दाबे की अदायगी हस अबधि के पशचात् की जानी हो तो जरीकर्ता लेखा अधिकारी द्वारा यह प्राधिकार पत्र पुर्नमान्य किया जाना चहिए। इस प्राधिकार पत्र की संबितरण अाधिकारि तथा खजाना अधिकारि  द्वारा दिए गए गैर अदायगी के एक प्रमान-पत्र सहित लेखा अधिकारी की लौटा दिया जाना चाहिए|</p>
		<p style="font-size:14px">This authority shall remain current for a period of six months from the date of its issue and will have to be re-validated by the Issuing Accounts Officer if any claim is required to be paid after this period. For this purpose, this authority should be returned to the Accounts Officer with a certificate of non-payment by the Disbursing Officer and the Treasury Officer.</p>
	</div>
	</div>
	<p style="margin-left:70px; margin-bottom:1px">
		<?php
			if(!empty($nominees)){
				$sl = 1;
				if(trim($fpa1['nominee_name']) != '.'){ 
					$share= '<span style="text-decoration:underline; line-height:18px">N.B.</span><br />
					  <span>The Share of</span>
					  <br />';
				}	  
				$nomi_1 = '';
				$nom1 = '';
				$nom2 = '';
				$pnom = '';
				foreach($nominees as $nomi){
					
					if (strpos($nomi['nominee_guardian_name'], 'Minor') !== false){
						//if ($pnom<>$nomi['nominee_name']) {
							$nom1 = $nom1.$sl.'.  '.$nomi['nominee_name']. ' ('.$nomi['nominee_guardian_name'].')'.'<br/>';
							//$pnom = $nomi['nominee_name'];
							//continue;
							$sl = $sl + 1;	
								
						//}	
						//echo $nomi['nominee_guardian_name'];
						continue;	
					} elseif ((strpos($nomi['nominee_guardian_name'], 'Wife') !== false) || (strpos($nomi['nominee_guardian_name'], 'Husband') !== false)){
						$nom2 = $nomi['nominee_name'];
						continue;
					}
					//unset($nomi);//  8697335691
				}	
				?>
				<span class="st">
				<?php 
					//if(trim($fpa1['nominee_name']) != '.'){
					//	echo $nom1;
					//}	
				?></span><br/>
		<?php			
				if(strlen(trim($nom1))>0){
					echo $share;
					echo '<span class="st">'.$nom1.'</span>';
					echo 'may be paid to his/ her/ their father/ mother/ Sri/ Smt <span class="st">'.$nom2.'</span>  as natural guardian.';
				}	
			}
		?>
	</p>
	<p style="text-align:right; margin-right:80px; margin-top:50px; font-size:14px;"> Sr. Accounts Officer	</p>
</div>

<?php
function number_to_word( $number = '' ){
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return $result;
}
function number_to_roman($num = 1){ 
     // Make sure that we only use the integer portion of the value 
     $n = intval($num); 
     $result = ''; 
  
     // Declare a lookup array that we will use to traverse the number: 
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1); 
  
     foreach ($lookup as $roman => $value)  
     { 
         // Determine the number of matches 
         $matches = intval($n / $value); 
  
         // Store that many characters 
         $result .= str_repeat($roman, $matches); 
  
         // Substract that from the number 
         $n = $n % $value; 
     } 
  
     // The Roman numeral should be built, return it 
     return $result; 
 } 
?>