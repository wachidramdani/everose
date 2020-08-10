<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rajaongkir extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}
        $this->load->model("rajaongkir_model");
        $this->load->library("rajaongkir");
	}
	
	public function index()
	{
        if($this->session->level != 1) {
            redirect(base_url('admin'));
        }

        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Pengaturan API Key";
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/rajaongkir/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }
	public function origin()
	{

        if($this->session->level != 1) {
            redirect(base_url('admin'));
        }
        
        $pushdata['pagetitle'] = "Pengaturan Origin";
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['province'] = $this->rajaongkir->all_province($this->shop_setting->rajaongkir_key(),$this->shop_setting->rajaongkir_type());

        if($this->shop_setting->rajaongkir_province() < 1) {
            $pushdata['city'] = array();
        } else {
            $pushdata['city'] = $this->rajaongkir->all_city($this->shop_setting->rajaongkir_key(),$this->shop_setting->rajaongkir_province(),$this->shop_setting->rajaongkir_type());
        }

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/rajaongkir/origin',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function courier() {
        $pushdata['pagetitle'] = "Jasa Ekspedisi";
        $pushdata['admin_info'] = $this->profile_info;

        $this->load->view('admin/header',$pushdata);
		$this->load->view('admin/rajaongkir/courier',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function add_courier() {
        $data = $this->input->post();
        $rules = [
            [
                "field" => "name_courier",
                "label" => "name_courier",
                "rules" => "required"
            ],
            [
                "field" => "type_courier",
                "label" => "type_courier",
                "rules" => "required"
            ]
            
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);

        if($callback['status']) {
            $data['id_courier'] = NULL;
            $this->rajaongkir_model->post_courier($data);
        }

        echo json_encode($callback);
        
    }

    function edit_courier($id) {
        $data = $this->input->post();
        $rules = [
            [
                "field" => "name_courier",
                "label" => "name_courier",
                "rules" => "required"
            ],
            [
                "field" => "type_courier",
                "label" => "type_courier",
                "rules" => "required"
            ]
            
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);

        $query = $this->rajaongkir_model->get_courier_service($id);

        if($query->num_rows() < 1) {
            redirect(base_url('404'));
            die();
        }

        if($callback['status']) {
            $this->rajaongkir_model->put_courier($id,$data);
        }

        echo json_encode($callback);
    }

    function json_courier() {
        $get = $this->rajaongkir_model->get_courier()->result();
        $append = array();
        foreach($get as $fetch) {
            $append[] = $fetch->name_courier;
        }

        echo json_encode($append);
    }

    function upload() {
        $callback['status'] = 1;
        $name = $this->input->post("name");
        $config['upload_path']          = '././upload/ekspedisi';
        $config['allowed_types']        = 'png';
        $config['max_size']             = 3000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1920;
        $config['file_name']            = $name.".png";

        $this->load->library('upload',$config); 

        if($this->upload->do_upload('img')){
        } else {
            $callback['status'] = 0;
            $callback['error'][] = [
                "field" => "img",
                "msg" => "Foto tak terupload"
            ];
        }

        echo json_encode($callback);
    }

    function delete_courier($id) {
        $query = $this->rajaongkir_model->get_courier_service($id);
        if($query->num_rows() < 1) {
            redirect(base_url("404"));
            die();
        } else {
            $this->rajaongkir_model->delete_courier($id);
        }

        $response['status'] = 1;
        $response['msg'] = "Pilihan jasa pengiriman telah dihapus";

        echo json_encode($response);
    }

    function index_json() {
        $this->load->library("datatables");
        $this->datatables->from("rajaongkir_courier");
        $this->datatables->set_column(['id_courier','name_courier','type_courier']);
        $this->datatables->set_search_field("name_courier");
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name_courier;
            $row[] = $field->type_courier;
            $row[] = '<button type="button" data-id="'.$field->id_courier.'" data-name="'.$field->name_courier.'" data-type="'.$field->type_courier.'" data-toggle="modal" data-target="#editCourier" class="btn btn-dark btn-sm toggle-edit"><i class="fas fa-pen"></i></button> <button type="button" data-id="'.$field->id_courier.'" class="btn btn-sm btn-danger toggle-delete" data-name="'.$field->name_courier.' '.$field->type_courier.'"><i class="fas fa-trash"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->datatables->count_all(),
            "recordsFiltered" => $this->datatables->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    
    function save() {
        if(!$this->session->level == 1) {
            redirect(base_url('admin'));
        }
        
        $data = $this->input->post();

        if(isset($data['key_api'])) {
            $rules = [
                [
                    "field" => "key_api",
                    "label" => "key_api",
                    "rules" => "required"
                ],
                [
                    "field" => "type_api",
                    "label" => "type_api",
                    "rules" => "required"
                ]
            ];
        } else {
            $rules = [
                [
                    "field" => "province_api",
                    "label" => "province_api",
                    "rules" => "required"
                ],
                [
                    "field" => "city_api",
                    "label" => "city_api",
                    "rules" => "required"
                ]
            ];
        }

        $this->load->library("json_validate");
        $response = $this->json_validate->validate($data,$rules);

        if($response['status']) {
            $this->rajaongkir_model->save($data);
        }

        echo json_encode($response);
    }
}
