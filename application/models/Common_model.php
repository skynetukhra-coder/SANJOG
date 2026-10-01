<?php
class Common_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	
	public function getAllLang(){
		$res = $this->db->select('*')
						->from('language')
						->get()
						->result_array();
		return $res;
	}

	public function upload_file($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_gssa_file($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_GSSA_FOLDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	
	public function upload_ersa_file($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_ERSA_FOLDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	
	public function upload_tender_notice($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_TENDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_documents($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_DOCUMENT;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_leave_documents($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_LEAVE;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_pen_payment_doc($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_PENSION_PAYT;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_circular_order($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_CIRCULAR_ORDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_exam_results($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_RESULT;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	
	public function upload_department_files($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_DEPT;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	
	public function upload_department_files_admin($input_name='up_file',$type="*",$path = ''){
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_DEPT;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	
	public function upload_multiple_file($input_name='up_file',$type="*",$path = ''){
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	public function upload_multiple_order_cicular($input_name='up_file',$type="*",$path = ''){
		$config['upload_path']          = $path != '' ? $path : UPLOAD_CIRCULAR_ORDER;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	
	public function upload_multiple_form_sixteen($input_name='up_file',$type="*",$path = ''){
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FORM_SIXTEEN;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	public function upload_employee_image($input_name='up_file',$type="*",$path = ''){
		//$path = './files/';
		$config['upload_path']          = $path != '' ? $path : UPLOAD_PICTURE;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if ( ! $this->upload->do_upload($input_name)){
			$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
		}else{
			$data = $this->upload->data();
			$return_arr = array(
							'is_success'=> true,
							'message'	=> 'Successfully uploaded',
							'filename'	=> $data['file_name']
						);
		}
		return $return_arr;
	}
	public function upload_service_book($input_name='up_file',$type="*",$path = ''){
		
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_SERVICEBOOK;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	
	public function upload_apar_booklet($input_name='up_file',$type="*",$path = ''){
		
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_APAR;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	
	public function upload_gpf_statement($input_name='up_file',$type="*",$path = ''){
		
		$config['upload_path']          = $path != '' ? $path : UPLOAD_FOLDER_GPF;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}

	public function upload_signature($input_name='up_file',$type="*",$path = ''){
		
		$config['upload_path']          = $path != '' ? $path : UPLOAD_SIGNATURE;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}
	

// ---------------resize images--------------------------------
	public function image_resize_thumb($img_path,$source_image,$resize_paramiters=array()){
			$this->load->library('image_lib');
			if(!isset($resize_paramiters['folder_name'])){
				$resize_paramiters['folder_name'] = $img_path.'/thumb/';
			}
			if(!isset($resize_paramiters['width'])){
				$resize_paramiters['width'] = 100;
			}
			if(!isset($resize_paramiters['height'])){
				$resize_paramiters['height'] = 100;
			}
			if(!is_dir($resize_paramiters['folder_name'])){
				mkdir($resize_paramiters['folder_name']);
			}
			$config['image_library'] = 'gd2';
			$config['source_image'] = $img_path.'/'.$source_image; //'/path/to/image/mypic.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = $resize_paramiters['folder_name'].'/'.$source_image;
			$config['width']     = $resize_paramiters['width'];
			$config['height']    = $resize_paramiters['height'];
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			if ($this->image_lib->display_errors()) {
				//echo $this->image_lib->display_errors();
			}
	}
	public function image_resize_medium($img_path,$source_image,$resize_paramiters=array()){
			$this->load->library('image_lib');
			if(!isset($resize_paramiters['folder_name'])){
				$resize_paramiters['folder_name'] = $img_path.'/medium/';
			}
			if(!isset($resize_paramiters['width'])){
				$resize_paramiters['width'] = 500;
			}
			if(!isset($resize_paramiters['height'])){
				$resize_paramiters['height'] = 500;
			}
			if(!is_dir($resize_paramiters['folder_name'])){
				mkdir($resize_paramiters['folder_name']);
			}
			$config['image_library'] = 'gd2';
			$config['source_image'] = $img_path.'/'.$source_image; //'/path/to/image/mypic.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = $resize_paramiters['folder_name'].'/'.$source_image;
			$config['width']     = $resize_paramiters['width'];
			$config['height']    = $resize_paramiters['height'];
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			if ($this->image_lib->display_errors()) {
				//echo $this->image_lib->display_errors();
			}
	}
	
	public function get_whats_new($office=''){
		$results =  $this->db->select('*')
							 ->from('whats_new')
							 ->order_by('whtn_id','desc');
		if($office!=''){
			$this->db->where('office',$office);
		}
		$results =  $this->db->get()
							 ->result_array();
		return $results;
	}
	public function get_whats_new_display($office=''){
		$results =  $this->db->select('*')
							 ->from('whats_new')
							 ->where('display', 'yes')
							 ->order_by('whtn_id','desc');
		if($office!=''){
			$this->db->where('office',$office);
		}
		$results =  $this->db->get()
							 ->result_array();
		return $results;
	}
	
	public function get_whats_new_by_id($id,$office=''){
		$results =  $this->db->select('*')
							 ->from('whats_new')
							 ->where('whtn_id',$id);
		if($office!=''){
			$this->db->where('office',$office);
		}
		$results =  $this->db->get()
							 ->row_array();
		return $results;
	}
	public function add_whats_new($update_data = array()){
		$res = $this->db->insert('whats_new',$update_data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function update_whats_new($id='', $update_data = array()){
		$res = $this->db->where('whtn_id',$id)->update('whats_new',$update_data);
		return $id;
	}
	public function delete_whats_new($id=''){
		$res = $this->db->where('whtn_id',$id)->delete('whats_new');
		return $id;
	}
	public function delete_feedback($id=''){
		$res = $this->db->where('feed_id',$id)->delete('feedback');
		return $id;
	}
	public function get_all_feeedback($limit_to = 0,$office='AGAE'){
			$get = $this->input->get(array('search'), TRUE);
			$this->db->select('*')
				 ->from('feedback')
				 ->order_by('feed_id','desc');
			if($this->session->has_userdata('admin_details')){
				$wing = $this->session->userdata('admin_details')['admin_type_name'];
				if($wing != 'superadmin'){
					if($office == 'AGAE'){
						if($wing == 'fund'){
							$cat = 'gpf';
						}else if($wing == 'administration'){
							$cat = 'administrative';
						}else if($wing == 'accounts'){
							$cat = 'accounts';
						}
						else if($wing == 'pension'){
							$cat = 'pension';
						}
						if($get['search'] !== ''){
							$this->db->group_start();
								$this->db->where('lower(visit_for)',$cat);
								$this->db->or_where('lower(visit_for)','general');
							$this->db->group_end();
							$this->db->group_start();
								$this->db->like('mobile',$get['search']);
								$this->db->or_like('name',$get['search']);
								$this->db->or_like('gpf_no',$get['search']);
							$this->db->group_end();
						}
						$this->db->where('office','Pr. AG (A&E)');
					}
					else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}else{
					if($office == 'AGAE'){
						if($get['search'] !== ''){
							$this->db->group_start();
								$this->db->like('visit_for',$get['search']);
								$this->db->or_like('mobile',$get['search']);
								$this->db->or_like('name',$get['search']);
								$this->db->or_like('gpf_no',$get['search']);
								$this->db->or_like('status',$get['search']);
							$this->db->group_end();
						}
						$this->db->where('office','Pr. AG (A&E)');
					}
					else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}
			}
			$total_records = $this->db->count_all_results('', FALSE);
			$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
								->get()
								->result_array();
			return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_all_active_feeedback($limit_to = 0,$office='AGAE'){
			$get = $this->input->get(array('search'), TRUE);
			$this->db->select('*')
				 ->from('feedback')
				 ->where('status','Active')
				 ->order_by('feed_id','desc');
			if($this->session->has_userdata('admin_details')){			
				$wing = $this->session->userdata('admin_details')['admin_type_name'];
				if($wing != 'superadmin' ){
					if($office == 'AGAE'){
						if($wing == 'fund'){
							$cat = 'gpf';
						}else if($wing == 'administration'){
							$cat = 'administrative';
						}else if($wing == 'accounts'){
							$cat = 'accounts';
						}
						else if($wing == 'pension'){
							$cat = 'pension';
						}
						if($get['search'] !== ''){
							$this->db->group_start();
								$this->db->where('lower(visit_for)',$cat);
								$this->db->or_where('lower(visit_for)','general');
							$this->db->group_end();	
							$this->db->group_start();
								$this->db->like('mobile',$get['search']);
								$this->db->or_like('name',$get['search']);
								$this->db->or_like('gpf_no',$get['search']);
							$this->db->group_end();
						}
						$this->db->where('office','Pr. AG (A&E)');
					}
					else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}else{
					if($office == 'AGAE'){
						if($get['search'] !== ''){
							$this->db->group_start();
								$this->db->like('visit_for',$get['search']);
								$this->db->or_like('name',$get['search']);
								$this->db->or_like('mobile',$get['search']);
								$this->db->or_like('gpf_no',$get['search']);
								$this->db->or_like('status',$get['search']);
							$this->db->group_end();
						}
						$this->db->where('office','Pr. AG (A&E)');
					}
					else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}
			}
			$total_records = $this->db->count_all_results('', FALSE);
			$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
								->get()
								->result_array();
			return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_feedback_by_id($id = 0,$office = 'AGAE'){
			$res = $this->db->select('*')
				 			->from('feedback')
				 			->where('feed_id',$id);
			if($office == 'AGAE'){
				$this->db->where('office','Pr. AG (A&E)');
			}else if($office == 'AGGSSA'){
				$this->db->where('office','Pr. AG (G&SSA)');
			}
			else if($office == 'AGERSA'){
				$this->db->where('office','AG (E&RSA)');
			}
			$res = $this->db->get()
							->row_array();
			return $res;
	}
	public function submit_feedback(){
		$post = $this->input->post(array('empid','name','email','mobile','visit_for','ppo_no','gpf_no','deptid','tryid','feed','office','service_rating','is_interected','email_rating','phone_rating','direct_rating','mode_of_interection_email','mode_of_interection_phone','mode_of_interection_direct','receive_sms_email','overall_rating'),true);
		
		$update['name'] 		= $post['name'];
		$update['email'] 		= $post['email'];
		$update['mobile'] 		= $post['mobile'];
		$update['visit_for'] = $post['visit_for'];

		$update['ppo_no_file_id_application_no'] = $post['ppo_no'];
		$update['gpf_no'] = $post['gpf_no'];

		$update['office'] 	= 'Pr. AG (A&E)';
		if($update['visit_for'] == 'Pension' || $update['visit_for'] == 'Provident Fund' || $update['visit_for'] == 'Accounts'){
			$update['service_rating'] 	= $post['service_rating'];
			$update['interected_to_office'] 	= $post['is_interected'];
			if($update['interected_to_office'] == 'yes'){
				$update['rate_of_interact_email'] 	= $post['email_rating'];
				$update['rate_of_interact_phone'] 	= $post['phone_rating'];
				$update['rate_of_interact_direct'] 	= $post['direct_rating'];
				$update['mode_of_interact_email'] 	= $post['mode_of_interection_email'];
				$update['mode_of_interact_phone'] 	= $post['mode_of_interection_phone'];
				$update['mode_of_interact_direct'] 	= $post['mode_of_interection_direct'];
			}
			$update['receive_sms_email'] 	= $post['receive_sms_email'];
		}
		$update['overall_service_rating'] 	= $post['overall_rating'];
		$update['details'] 		= $post['feed'];
		$update['feed_date'] 	= date('Y-m-d H:i:s');
		$update['status'] 	= 'Active';
		$update['g_flag'] 	= 'F';
		
		if(!empty($post['gpf_no'])){
			$update['visit_for'] = 'Provident Fund';
		}else if(!empty($post['empid'])){
			$update['empid'] = $post['empid'];
			$update['visit_for'] = 'Administrative';
		}else if(!empty($post['deptid'])){
			$update['empid'] = $post['deptid'];
			$update['visit_for'] = 'Accounts';
		}else if(!empty($post['tryid'])){
			$update['empid'] = $post['tryid'];
			$update['visit_for'] = 'Accounts';
		}else{
			$update['visit_for'] = $post['visit_for'];
		}
		
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$update['ip_address'] 	= $ip_address;
		$res = $this->db->select('*')->from('feedback')
									->where('ip_address',$ip_address)
									->where('year(feed_date)',date('Y'))
									->where('month(feed_date)',date('m'))
									->get()
									->row();
		if(!empty($res)){
			return false;
		}else{
			$this->db->insert('feedback',$update);
		}
		return true;
	}
	public function submit_survey(){
		$post = $this->input->post(array('name','email','mobile','feed','office','overall_rating'),true);
		$update['name'] 		= $post['name'];
		$update['email'] 		= $post['email'];
		$update['mobile'] 		= $post['mobile'];
		$update['office'] 		= $post['office'];
		if($post['office'] == 'Pr. AG (A&E)'){
			$update['visit_for'] 	= 'General';
		}
		$update['overall_service_rating'] 	= $post['overall_rating'];
		$update['details'] 		= $post['feed'];
		$update['feed_date'] 	= date('Y-m-d H:i:s');
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$update['ip_address'] 	= $ip_address;
		$res = $this->db->select('*')->from('feedback')
									->where('ip_address',$ip_address)
									->where('year(feed_date)',date('Y'))
									->where('month(feed_date)',date('m'))
									->get()
									->row();
		if(!empty($res)){
			return false;
		}else{
			$this->db->insert('feedback',$update);
		}
		return true;
	}
	
		
//----feedback	

	
	public function get_all_groups(){
		$res = $this->db->select ('visit_for')
						->from('feedback')
						->order_by('visit_for','desc')
						->group_by('visit_for')
						->get()
						->result_array();
		return $res;
	}
	
	public function all_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->order_by('feed_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_general_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('visit_for','General') 
				 ->where('status','Process')
				 ->order_by('feed_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_administration_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback') 
				 ->where('status','Process')
				 ->group_start()
				 ->where('visit_for','Administrative') 
				 ->or_where('administration','Yes')
				 ->group_end()
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_accounts_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('status','Process')
				 ->group_start()
				 ->where('visit_for','Accounts') 
				 ->or_where('accounts','Yes') 
				 ->group_end()
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_fund_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('status','Process')
				 ->group_start()
				 ->where('visit_for','Provident Fund') 
				 ->or_where('fund','Yes') 
				 ->group_end()
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}	
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_pension_feedback($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('status','Process')
				 ->group_start()
				 ->where('visit_for','Pension') 
				 ->or_where('pension','Yes') 
				 ->group_end()
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_grievance_records($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('g_flag','G') 
				 ->where('status','Active')
				 ->or_where('status','Process')
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('mobile',$get['search']);
				$this->db->or_like('feed_id',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function feedback_details($id=0){
		return  $this->db->select('*')
						 ->from('feedback')
						 ->where('feed_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_all_feedback_action($id=0){
		$post = $this->input->post(array('administration','administration_action_required','administration_action_taken','accounts','accounts_action_required','accounts_action_taken','fund','fund_action_required','fund_action_taken','pension','pension_action_required','pension_action_taken','status'), TRUE);
		$update = array();
		if($post['administration'] != ''){
			$update['administration'] = $post['administration'];
		}
//		$update['administration'] = $post['administration'];
		$update['administration_action_required'] = $post['administration_action_required'];
		$update['administration_action_taken'] = $post['administration_action_taken'];
		if($post['accounts'] != ''){
			$update['accounts'] = $post['accounts'];
		}
		$update['accounts_action_required'] = $post['accounts_action_required'];
		$update['accounts_action_taken'] = $post['accounts_action_taken'];
		if($post['fund'] != ''){
			$update['fund'] = $post['fund'];
		}
		$update['fund_action_required'] = $post['fund_action_required'];
		$update['fund_action_taken'] = $post['fund_action_taken'];
		if($post['pension'] != ''){
			$update['pension'] = $post['pension'];
		}
		$update['pension_action_required'] = $post['pension_action_required'];
		$update['pension_action_taken'] = $post['pension_action_taken'];
		$update['status'] = $post['status'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	public function update_administration_feedback_action($id=0){
		$post = $this->input->post(array('administration_action_taken'), TRUE);
		$update = array();	
		$update['administration_action_taken'] = $post['administration_action_taken'];
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	public function update_accounts_feedback_action($id=0){
		$post = $this->input->post(array('accounts_action_taken'), TRUE);
		$update = array();	
		$update['accounts_action_taken'] = $post['accounts_action_taken'];
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	public function update_fund_feedback_action($id=0){
		$post = $this->input->post(array('fund_action_taken'), TRUE);
		$update = array();	
		$update['fund_action_taken'] = $post['fund_action_taken'];
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	public function update_pension_feedback_action($id=0){
		$post = $this->input->post(array('pension_action_taken'), TRUE);
		$update = array();	
		$update['pension_action_taken'] = $post['pension_action_taken'];
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	
	public function get_file_details_by_id($id,$office=''){
		$results =  $this->db->select('*')
							 ->from('upload_file')
							 ->where('upload_file_id',$id);
		if($office!=''){
			$this->db->where('office',$office);
		}
		$results =  $this->db->get()
							 ->row_array();
		return $results;
	}
	public function add_file_details($update_data = array()){
		$res = $this->db->insert('upload_file',$update_data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function update_file_details($id='', $update_data = array()){
		$res = $this->db->where('upload_file_id',$id)->update('upload_file',$update_data);
		return $id;
	}
	public function delete_file_details($id=''){
		$res = $this->db->where('upload_file_id',$id)->delete('upload_file');
		return $id;
	}
	
	public function get_file_details($limit_to=0,$office='AGAE'){
		$results =  $this->db->select('*')
					->from('upload_file');
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function all_feedback_download($office = 'Pr. AG (A&E)'){
		$post = $this->input->post(array('date_from','date_to', 'status'), TRUE);
		$res = $this->db->select('fb.*')
						->from('feedback fb')
						->where('fb.office',$office);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(fb.feed_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(fb.feed_date) <= ',$t_date);
		}		
		if($post['status'] != ''){
			$this->db->where('fb.status',$post['status']);
		}		
		$res = $this->db->order_by('fb.feed_date','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_feedback_download($office = 'Pr. AG (A&E)'){
		$post = $this->input->post(array('date_from','date_to','visit_for','status'), TRUE);
		$res = $this->db->select('fb.*')
						->from('feedback fb')
						->where('fb.office',$office);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(fb.feed_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(fb.feed_date) <= ',$t_date);
		}
		if($post['visit_for'] != ''){
			$this->db->where('fb.visit_for',$post['visit_for']);
		}
		if($post['status'] != ''){
			$this->db->where('fb.status',$post['status']);
		}							
		$res = $this->db->order_by('fb.feed_date','desc')
						->get()
						->result_array();
		return $res;
	}

	public function upload_multiple_ppogpocpo($input_name='up_file',$type="*",$path = ''){
		$config['upload_path']          = $path != '' ? $path : UPLOAD_PPOGPOCPO;
		$config['allowed_types']        = $type;
		//$config['max_size']             = 4096; // In Kilo bites
		$this->load->library('upload', $config);
		$return_arr = array();
		if(!empty($_FILES)){
			$file = $_FILES;
			$fileArray = array();
			$this->upload->initialize($config);
			for ($i = 0; $i < count($file[$input_name]['name']); $i++) {
				$_FILES[$input_name]['name'] 	= $file[$input_name]['name'][$i];
				$_FILES[$input_name]['type'] 	= $file[$input_name]['type'][$i];
				$_FILES[$input_name]['tmp_name'] = $file[$input_name]['tmp_name'][$i];
				$_FILES[$input_name]['error'] 	= $file[$input_name]['error'][$i];
				$_FILES[$input_name]['size'] 	= $file[$input_name]['size'][$i];
				if($this->upload->do_upload($input_name,true)){
					$fileArray[] = $this->upload->file_name;
				}else{
					$return_arr = array(
							'is_success'=> false,
							'message'	=> $this->upload->display_errors()
						);
				}
			}
		}
		if(isset($return_arr) && !empty($return_arr)){
		
		}else{
			$return_arr = array(
					'is_success'=> true,
					'message'	=> 'Successfully uploaded',
				);
		}
		$return_arr['filenames'] = $fileArray;
		return $return_arr;
	}



}// End of class