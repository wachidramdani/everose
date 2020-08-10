<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_slider extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }
        
        $this->load->model("slider_model");

    }
    
    public function get($id) {
        $callback = $this->slider_model->get_slider($id)->row_array();
        if(isset($callback['img_slider'])) {
            $callback['img_slider'] = base_url("slider/1920x800/".$callback['img_slider']);
        }

        echo json_encode($callback);
    }
	
	public function index()
	{
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Kelola Slider";

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/slider/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function add() {
        $data = $this->input->post();
        $this->proccess($data,"add");
    }

    function edit($id) {
        $data = $this->input->post();
        $this->proccess($data,"edit",$id);
    }

    function delete($id) {
        $callback['status'] = 1;
        $callback['msg'] = "Slider telah dihapus";
        $query = $this->slider_model->get_slider($id);
        if($query->num_rows() < 1) {
            $callback['status'] = 0;
            $callback['msg'] = "Gagal menghapus slider";
        }

        $getname = $query->row_array();
        $filebefore = '././upload/slider/'.$getname['img_slider'];
        if(is_readable($filebefore)) {
            unlink($filebefore);
        }

        $this->slider_model->delete_slider($id);

        echo json_encode($callback);
    }

    private function proccess($data,$action,$id="") {
		$rules = [
			[
				"field" => "title_slider",
				"label" => "title_slider",
				"rules" => "required"
            ],
            [
                "field" => "desk_slider",
                "label" => "desk_slider",
                "rules" => "required"
            ]
		];
		$this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);

        if($action == "edit") {
            $query = $this->slider_model->get_slider($id);
            if($query->num_rows() < 1) {
                $callback['status'] = 0;
            } else {
                $oldname = $query->row_array();
                $oldname = $oldname['img_slider'];
            }
        }

        if($callback['status']) {

            
            $name = str_replace(" ","_",$data['title_slider']);    
            
            $this->load->helper("string");
            $this->load->helper("file");
            $name = preg_replace('/[^\w-]/', '', $name);
            if($action == "edit") {
                $name = $oldname;
            }

                $config['upload_path']          = '././upload/slider';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;
                $config['file_name']            = $name;

                if($action == "edit") {
                    $config['overwrite'] = TRUE;
                }
    
                $this->load->library('upload',$config);
                
                if($action == "add") {

                    if($this->upload->do_upload('img_slider')){
                        $result = $this->upload->data();
                        $fotoup = $result['file_name'];
                        $data['id_slider'] = "";
                        $data['img_slider'] = $fotoup;

                        $this->slider_model->post_slider($data);
                    } else {
                        $callback['status'] = 0;
                        $callback['error'][] = [
                            "field" => "img_slider",
                            "msg" => "Foto tak terupload"
                        ];
                    }
                } else {
                    if($this->upload->do_upload('img_slider')){
                        $result = $this->upload->data();
                        $fotoup = $result['file_name'];
                    }
                    if($callback['status']) {
                        $this->slider_model->put_slider($id,$data);
                    }
                }

        }
        
        echo json_encode($callback);
    }
    
    public function index_json() {
        $this->load->library("datatables");
        $this->datatables->from("slider");
        $this->datatables->set_search_field("title_slider");
        $this->datatables->set_column(['id_slider','name_slider']);
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img style="max-width:150px" src="'.base_url("slider/1920x800/$field->img_slider").'"/>';
            $row[] = $field->title_slider;
            $row[] = $field->desk_slider;
            $row[] = $field->link_slider;
            $row[] = '<button type="button" class="btn btn-dark btn-sm btnedit" data-id="'.$field->id_slider.'" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-danger btn-sm btndelete" data-id="'.$field->id_slider.'"><i class="fas fa-trash"></i></button>';
 
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

}
