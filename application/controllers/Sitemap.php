<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function index(){
		$data['AGAE_menu'] = $this->menu_model->getOfficeMenu('AGAE');
		$data['AGGSSA_menu'] = $this->menu_model->getOfficeMenu('AGGSSA');
		$data['AGERSA_menu'] = $this->menu_model->getOfficeMenu('AGERSA');
		$data['tender_notice_menu'] = $this->menu_model->getTenderNoticeMenu();
		$data['contact_us_menu'] = $this->menu_model->getContactUsMenu();
		$data['AGAE_menu_sub'] = array();
		$data['AGAE_menu_details'] = array();
		$data['AGGSSA_menu_sub'] = array();
		$data['AGGSSA_menu_details'] = array();
		$data['AGERSA_menu_sub'] = array();
		$data['AGERSA_menu_details'] = array();
		foreach($data['AGAE_menu'] as $row){
			if($row['sub_menu_id'] > 0){
				$data['AGAE_menu_sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['AGAE_menu_details'][$row['office_menu_id']] = $row;
			}
		}
		foreach($data['AGGSSA_menu'] as $row){
			if($row['sub_menu_id'] > 0){
				$data['AGGSSA_menu_sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['AGGSSA_menu_details'][$row['office_menu_id']] = $row;
			}
		}
		foreach($data['AGERSA_menu'] as $row){
			if($row['sub_menu_id'] > 0){
				$data['AGERSA_menu_sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['AGERSA_menu_details'][$row['office_menu_id']] = $row;
			}
		}
		foreach($data['tender_notice_menu'] as $row){
			if($row['sub_menu_id'] > 0){
				$data['tender_notice_menu_sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['tender_notice_menu_details'][$row['menu_id']] = $row;
			}
		}
		
		foreach($data['contact_us_menu'] as $row){
			if($row['sub_menu_id'] > 0){
				$data['contact_us_menu_sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['contact_us_menu_details'][$row['menu_id']] = $row;
			}
		}
		$this->load->view('layout/header');
		$this->load->view('pages/sitemap',$data);
		$this->load->view('layout/footer');
	}
}
