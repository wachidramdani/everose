<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_edit_profile extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

    }

    function index() {
        $callback['admin_info'] = $this->profile_info;

        $callback['pagetitle'] = "Edit Profile";
        $this->load->view("admin/header",$callback);
        $this->load->view("admin/setting/account",$callback);
        $this->load->view("admin/footer",$callback);
    }

    function save() {
        $getdata = $this->input->post();
        $rules = [
            [
                "field" => "name_profile",
                "label" => "name_profile",
                "rules" => "required"
            ],
            [
                "field" => "gender_profile",
                "label" => "gender_profile",
                "rules" => "required"
            ],
            [
                "field" => "email_profile",
                "label" => "email_profile",
                "rules" => "required|valid_email"
            ],
            [
                "field" => "phone_profile",
                "label" => "phone_profile",
                "rules" => "required|numeric|min_length[11]"
            ],
            [
                "field" => "address_profile",
                "label" => "address_profile",
                "rules" => "required|min_length[50]"
            ]
        ];

        $this->load->library('json_validate');

        $callback = $this->json_validate->validate($getdata,$rules);
        
        if($callback['status']) {
            $arraysend = [
                "name_profile" => $getdata['name_profile'],
                "gender_profile" => $getdata['gender_profile'],
                "email_profile" => $getdata['email_profile'],
                "phone_profile" => $getdata['phone_profile'],
                "address_profile" => $getdata['address_profile']
            ];
            $this->admin_model->set_profile($arraysend,$this->profile_info['id_admin']);
        }
        echo json_encode($callback);
    }

    function save_photo() {
        $this->load->helper("string");
        $this->load->helper("file");
        $name = time().random_string("numeric",8);

        $config['upload_path']          = '././upload/profile_pic';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1920;
        $config['file_name']            = $name;
        $config['overwrite']            = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upload'))
        {
            $callback['status'] = 0;
        } else {
            $result = $this->upload->data();

            $filebefore = '././'.$this->profile_info['photo_profile'];
            if(is_readable($filebefore)) {
                unlink($filebefore);
            }
            $this->admin_model->set_profile(["photo_profile" => "upload/profile_pic/".$result['file_name']],$this->profile_info['id_admin']);
            $callback['status'] = 1;
            $callback['url'] = "upload/profile_pic/".$result['file_name'];
        }

        echo json_encode($callback);
    }
}