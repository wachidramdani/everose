<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_metavalue extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

		$this->load->model('metavalue_model');

	}
	
	public function index()
	{
		$pushdata['admin_info'] = $this->profile_info;
		$pushdata['pagetitle'] = "Kelola Kategori";
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/metavalue/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
	}

	function edit($id) {
		$data = $this->input->post();
		$rules = [
			[
				"field" => "name_deskripsi",
				"label" => "name_deskripsi",
				"rules" => "required"
			]
		];
		$this->load->library("json_validate");
		$callback = $this->json_validate->validate($data,$rules);

		if($this->metavalue_model->get_metavalue($id)->num_rows() < 1) {
			$callback['status'] = 0;
		}

		if($callback['status']) {
			$this->metavalue_model->put_metavalue($id,$data);
		}
		
		echo json_encode($callback);
	}

	function add() {
		$data = $this->input->post();
		$rules = [
			[
				"field" => "name_deskripsi",
				"label" => "name_deskripsi",
				"rules" => "required"
			]
		];
		$this->load->library("json_validate");
		$callback = $this->json_validate->validate($data,$rules);

		if($callback['status']) {
			$data['name_meta_value'] = "";
			$this->metavalue_model->post_metavalue($data);
		}
		
		echo json_encode($callback);
	}

	function delete($id) {
		if($this->metavalue_model->get_metavalue($id)->num_rows() < 1) {
			$callback['status'] = 0;
			$callback['msg'] = "Warna gagal dihapus";
		} else {
			$this->metavalue_model->delete_metavalue($id);
			$callback['status'] = 1;
			$callback['msg'] = "Warna berhasil dihapus";
		}

		echo json_encode($callback);
	}

	function index_json() {
        $this->load->library("datatables");
        $this->datatables->from("meta_value");
        $this->datatables->set_column(['meta_value','name_deskripsi']);
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name_deskripsi;
            $row[] = '<button type="button" class="btn btn-sm btn-dark btnedit" data-toggle="modal" data-target="#editModal" data-name="'.$field->name_deskripsi.'" data-id="'.$field->name_meta_value.'"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="'.$field->name_deskripsi.'" data-id="'.$field->name_meta_value.'"><i class="fas fa-trash"></i></button>';
 
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
