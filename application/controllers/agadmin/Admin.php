<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('admin_details')) {
			redirect(ADMIN_BASE_URL.'adminlogin');
		}
	}

	public function index()
	{
		$this->load->view('admin');
	}
}
