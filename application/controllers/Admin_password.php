<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_password extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

    }
    
    private function redirect() {
        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }
    }
	
	public function index()
	{
        $this->redirect();
        
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Ganti Password";
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/setting/change_password',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function change() {
        $this->redirect();

        $data = $this->input->post();

        $rules = [
            [
                "field" => "oldpw",
                "label" => "oldpw",
                "rules" => "required"
            ],
            [
                "field" => "newpw",
                "label" => "newpw",
                "rules" => "required"
            ],
            [
                "field" => "confpw",
                "label" => "confpw",
                "rules" => "required|matches[newpw]"
            ]
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);
        $getpw = $this->admin_model->get_username($this->profile_info['usn_admin'])->row_array();

        if(!password_verify($data['oldpw'],$getpw['pass_admin'])) {
            $callback['status'] = 0;
            $callback['error'] = [['field' => 'oldpw','msg' => "Password salah"]];
        } else {
            if($callback['status']) {
                $arraypost = ['pass_admin' => password_hash($data['newpw'],PASSWORD_BCRYPT)];
                $this->admin_model->set_admin($arraypost,$this->profile_info['id_admin']);
            }
        }

        echo json_encode($callback);
    }
    
}
