<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('admin_model');

    }

	public function index()
	{
        if($this->session->login_status) {
            redirect(base_url('admin/dashboard'));
        }
        $this->load->view('admin/login');
    }
    
    public function login() {
        $usn = $this->input->post('usn');
        $pass = $this->input->post('pass');

        $query = $this->admin_model->get_username($usn);

        if($query->num_rows() < 1) {
            $callback['status'] = 0;
            $callback['msg'] = "Username tidak ditemukan";
        } else {
            $parse = $query->row_array();

            if(!password_verify($pass,$parse['pass_admin'])) {
                $callback['status'] = 0;
                $callback['msg'] = "Password salah";
            } else {
                $datasession = [
                    "login_status" => 1,
                    "usn" => $usn,
                    "level" => $parse['id_level']
                ];

                $this->session->set_userdata($datasession);
                $callback['status'] = 1;
                $callback['msg'] = "Login berhasil";
            }
        }

        echo json_encode($callback);
    }

    public function logout() {
        if($this->session->login_status) {
            $arrayitem = ["login_status","usn","level"];
            $this->session->unset_userdata($arrayitem);
            redirect(base_url('index.php/admin'));
        }
    }
}
