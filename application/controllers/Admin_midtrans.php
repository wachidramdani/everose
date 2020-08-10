<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_midtrans extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

		if($this->session->level != 1) {
            redirect(base_url('admin'));
        }

		$this->load->model("midtrans");
	}
	
	public function index()
	{
		$pushdata['admin_info'] = $this->profile_info;
		$pushdata['pagetitle'] = "Midtrans API";
		$pushdata['value'] = [
			"serverkey" => $this->midtrans->get_access("serverkey"),
			"clientkey" => $this->midtrans->get_access("clientkey")
		];

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/midtrans/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
	}

	public function save() {
		$data = $this->input->post();
		$rules = [
			[
				'field' => "serverkey_midtrans",
				"label" => "serverkey_midtrans",
				"rules" => "required"
			],
			[
				'field' => "clientkey_midtrans",
				"label" => "clientkey_midtrans",
				"rules" => "required"
			]
		];

		$this->load->library("json_validate");
		$response = $this->json_validate->validate($data,$rules);

		if($response['status']) {
			$this->midtrans->set_key($data);
		}

		echo json_encode($response);
	}

}
