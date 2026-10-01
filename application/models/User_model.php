<?php
class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function getAdminByUsername($username = ''){
        return $this->db->select('a.*,at.admin_type_name')
                        ->from('admin a')
                        ->join('admin_type at','at.admin_type_id = a.admin_type_id')
                        ->where('a.admin_username', $username)
                        ->get()
                        ->row_array();
    }

    public function getAdminByUsernameOrEmail($uname_or_email = ''){
        return $this->db->select('a.*,at.admin_type_name')
                        ->from('admin a')
                        ->join('admin_type at','at.admin_type_id = a.admin_type_id')
                        ->where('a.admin_username', $uname_or_email)
                        ->or_where('a.admin_email', $uname_or_email)
                        ->get()
                        ->row_array();
    }

    public function getAdminById($id = ''){
        return $this->db->select('a.*,at.admin_type_name')
                        ->from('admin a')
                        ->join('admin_type at','at.admin_type_id = a.admin_type_id')
                        ->where('a.admin_id', $id)
                        ->get()
                        ->row_array();
    }

    public function generatePasswordHash($password = ''){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkPasswordHashMatched($password = '', $hash = ''){
        return password_verify($password, $hash);
    }

    public function getAllOtherAdmins($admin_id = ''){
        return $this->db->select('a.*,at.admin_type_name')
                        ->from('admin a')
                        ->join('admin_type at','at.admin_type_id = a.admin_type_id')
                        ->where('a.base_super_admin !=', 1)
                        ->get()
                        ->result_array();
    }

    public function addAdmin($admin_data = array()){
        if (!empty($admin_data)) {
            return $this->db->insert('admin', $admin_data);
        }
        return false;
    }

    public function updateAdmin($id = '', $admin_data = array()){
        if (!empty($admin_data)) {
            return $this->db->where('admin_id', $id)->update('admin', $admin_data);
        }
        return false;
    }
public function updateAdminLogin($id = '') {
    $token = hash('sha256', uniqid(random_bytes(16), true)); // generate secure token

    $update_data = array(
        'admin_login_time' => date('Y-m-d H:i:s'),
        'admin_login_ip'   => $_SERVER['REMOTE_ADDR'],
        'login_token'      => $token
    );

    $this->db->where('admin_id', $id)->update('admin', $update_data);

    // Also update session with token
    $admin_data = $this->session->userdata('admin_details');
    $admin_data['login_token'] = $token;
    $this->session->set_userdata('admin_details', $admin_data);
}

    public function getAllWings(){
        return $this->db->get('admin_type')->result_array();
    }

    public function is_base_super_admin($admin_id = ''){
        $res = $this->db->select('*')
                       ->from('admin')
                       ->where('admin_id', $admin_id)
                       ->where('base_super_admin', 1)
                       ->get();
        return $res->num_rows() > 0;
    }

    public function deleteAdmin($admin_id = ''){
        $this->db->where('admin_id', $admin_id)
                 ->where('base_super_admin', 0)
                 ->delete('admin');
    }

    //  New: Set login token to prevent session hijacking & multiple logins
    public function setLoginToken($admin_id, $token){
        return $this->db->where('admin_id', $admin_id)->update('admin', ['login_token' => $token]);
    }

    //  New: Get login token for session verification
    public function getLoginToken($admin_id){
        $row = $this->db->select('login_token')->from('admin')->where('admin_id', $admin_id)->get()->row_array();
        return $row ? $row['login_token'] : null;
    }

    //  New: Clear login token on logout
    public function clearLoginToken($admin_id){
        return $this->db->where('admin_id', $admin_id)->update('admin', ['login_token' => null]);
    }

    // Optional helper: Example of inserting user
    public function insert_user($name, $email) {
        $data = [
            'name' => $name,
            'email' => $email
        ];
        return $this->db->insert('users', $data);
    }
}