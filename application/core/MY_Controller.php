<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Enforce token match for logged-in admins
        if ($this->session->userdata('admin_details')) {
            $admin = $this->session->userdata('admin_details');
            $stored_token = $this->user_model->getLoginToken($admin['id']);
            if ($stored_token !== $admin['login_token']) {
                $this->session->sess_destroy();
                redirect(ADMIN_BASE_URL);
            }
        }
    }
}