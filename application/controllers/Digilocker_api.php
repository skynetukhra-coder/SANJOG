<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Digilocker_api extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->lang->load('main','english');
		////$this->load->database(); //extra - used for local only
		$this->load->model('gpf_model');
		/*if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{*/
			$this->language_id = 1;
		/*}*/

		$baseKey = getenv('DIGILOCKER_SECRET_KEY') ?: 'M2RmMjBhYjMxMjJjNzBhNWRlOWVhOTY0';
		$this->apiKey = $baseKey . date('Y-m-d h:i');
	}

	public function index() {
		return $this->output->set_content_type('application/json')
			    ->set_status_header(200)
			    ->set_output(json_encode([
			        'message' => 'Service is running.'
			    ]));
	}

	public function get_gpf_details() { 
		try {
			if ($this->input->method() != 'get') {
				return $this->output->set_content_type('application/json')
					    ->set_status_header(405)
					    ->set_output(json_encode([
					    	'status' => 405,
					        'message' => 'Method not allowed.'
					    ]));
			}
			
			$this->load->library('m_pdf');
			$data = $_GET;
			$requestBody = json_encode($data, true);
		    $hmac = base64_encode(hash_hmac('sha256', $requestBody, $this->apiKey));
	        $headers = getallheaders();

	        if ($hmac != @$headers['wb-dl-hmac']) {
	        	return $this->output->set_content_type('application/json')
						->set_status_header(401)
						->set_output(json_encode([
							'status' => 401,
						    'message' => 'Unauthorized access.'
						]));
	        }

			$ac_code = isset($data['ac_code']) ? $data['ac_code'] : "";
			$series = isset($data['series']) ? $data['series'] : "";
			$data['subscribers_data']['ac_code'] = $ac_code;
			$data['subscribers_data']['series'] = $series;
			$year = isset($data['year']) ? date('Y-m-d',strtotime($data['year'])) : "";

			$data['subscribers_data']['ac_code'] = $ac_code;
			$data['subscribers_data']['series'] = $series;
							
			$data['f_year'] = date('d/m/Y',strtotime($year));
			$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
			$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
			$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
			$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);

			$data['subscribers_data']['dob'] = isset($data['part_1']['dob']) ? date('d/m/Y',strtotime($data['part_1']['dob'])) : "";
			$data['subscribers_data']['fst_nme'] = isset($data['part_1']['sub_name']) ? $data['part_1']['sub_name'] : "";
			$data['subscribers_data']['mid_nme'] = '';
			$data['subscribers_data']['lst_nme'] = '';
			$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
			$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);
			
			if (!isset($data['part_1']) && count($data['part_2']) == 0 && !isset($data['part_3']) && !isset($data['part_4']) ) {
				return $this->output->set_content_type('application/json')
						->set_status_header(404)
						->set_output(json_encode([
							'status' => 404,
						    'message' => 'Document not found.',
						    'data' => [
					        	'docContent' => "",
					        	'dataContent' => $data
						    ] 
						]));
			}

			$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
			$pdf = $this->m_pdf->generate();
			$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			//$pdf->showWatermarkText = true;
			$pdf->WriteHTML($html,0);
			//$pdf->Output($pdfFilePath, "D");
			//$pdf->Output();
		
			return $this->output->set_content_type('application/json')
					->set_status_header(200)
				    ->set_output(json_encode([
				        'status' => 200,
				        'message' => 'Successfully.',
				        'data' => [
				        	'docContent' => base64_encode($pdf->Output($pdfFilePath, 'S')),
				        	'dataContent' => $data
				        ] 
				    ]));

		} catch (Exception $e) {
			return $this->output->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode([
						'status' => 500,
					    'message' => 'Something went wrong, please try again.'
					]));
        }
	}

	public function get_ppo_gpo_cpo_details() { 
		try {
			if ($this->input->method() != 'get') {
				return $this->output->set_content_type('application/json')
					    ->set_status_header(405)
					    ->set_output(json_encode([
					    	'status' => 405,
					        'message' => 'Method not allowed.'
					    ]));
			}
						
			$data = $_GET;
			$requestBody = json_encode($data, true);
		    $hmac = base64_encode(hash_hmac('sha256', $requestBody, $this->apiKey));
	        $headers = getallheaders();

	        if ($hmac != @$headers['wb-dl-hmac']) {
	        	return $this->output->set_content_type('application/json')
						->set_status_header(401)
						->set_output(json_encode([
							'status' => 401,
						    'message' => 'Unauthorized access.'
						]));
	        }

			$application_no = isset($data['application_no']) ? $data['application_no'] : "";
			$document_type = isset($data['document_type']) ? $data['document_type'] : "";
			
			$doc_type = '';
			if ($document_type == 'PCPYO') {
				$doc_type = 'CPO';
			} else if ($document_type == 'GRPYO') {
				$doc_type = 'GPO';
			} else if ($document_type == 'PECER') {
				$doc_type = 'PPO';
			} else {
				return $this->output->set_content_type('application/json')
						->set_status_header(400)
						->set_output(json_encode([
							'status' => 400,
						    'message' => 'Invalid Document type.'
						]));
			}

			$certificatePath = $doc_type. '_' . $application_no . '.pdf';
			$data['file_path'] = 'https://agwb.cag.gov.in/pension/ppo/'. $certificatePath;
			$data['get_certificate'] = $this->gpf_model->get_ppo_gpo_cpo_certificate($application_no);
		
			if (isset($data['get_certificate'])) {
				return $this->output->set_content_type('application/json')
						->set_status_header(200)
					    ->set_output(json_encode([
					        'status' => 200,
					        'message' => 'Successfully.',
					        'data' => [
					        	'docContent' => "",
					        	'dataContent' => $data
					        ] 
					    ]));	    
			} else {
				return $this->output->set_content_type('application/json')
						->set_status_header(404)
						->set_output(json_encode([
							'status' => 404,
						    'message' => 'Document not found.',
						    'data' => [
					        	'docContent' => "",
					        	'dataContent' => $data
						    ] 
						]));
			}
		} catch (Exception $e) {
			return $this->output->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode([
						'status' => 500,
					    'message' => 'Something went wrong, please try again.'
					]));
        }
	}

}