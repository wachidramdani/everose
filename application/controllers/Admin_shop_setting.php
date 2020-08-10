<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_shop_setting extends CI_Controller {

    private $profile_info;

    function __construct() {
        parent::__construct();

        $this->load->model('admin_model');

        $this->load->model('setting_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
        } else {
            $this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }

        if($this->session->level != 1) {
            redirect(base_url('admin'));
        }
    }

	public function index()
	{

        $callback['getall'] = $this->setting_model->getall()->result(); 
        $callback['admin_info'] = $this->profile_info;

        $callback['pagetitle'] = "Pengaturan Toko";
        $this->load->view('admin/header',$callback);
		$this->load->view('admin/setting/shop',$callback);
		$this->load->view('admin/footer',$callback);
    }

    function save() {
        $send = $this->input->post("send");

        $callback['status'] = 1;

        for($i=0;$i<count($send);$i++) {
            $push = $send[$i];

            if(empty($send[$i])) {
                $callback['status'] = 0;
                $callback['error'] = "Terdapat kolom kosong";
            }

            if($callback['status']) {
                $this->setting_model->set_setting(($i+1),$push);
            }

            if($i == 0) {
                $i++;
            }
        }

                $config['upload_path']          = '././assets/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;
                $config['file_name']            = 'logo.png';
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('logo'))
                {

                }

        echo json_encode($callback);
    }
}
