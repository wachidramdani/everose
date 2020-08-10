<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_category extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

		$this->load->model('category_model');

	}
	
	public function index()
	{
		$pushdata['admin_info'] = $this->profile_info;
		$pushdata['pagetitle'] = "Kelola Kategori";
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/category/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
	}

	function edit($id) {
		$data = $this->input->post();
		$rules = [
			[
				"field" => "name_category",
				"label" => "name_category",
				"rules" => "required"
			]
		];
		$this->load->library("json_validate");
		$callback = $this->json_validate->validate($data,$rules);

		if($this->category_model->get_category($id)->num_rows() < 1) {
			$callback['status'] = 0;
		}

		if($callback['status']) {
			$this->category_model->put_category($id,$data);
		}
		
		echo json_encode($callback);
	}

	function add() {
		$data = $this->input->post();
		$rules = [
			[
				"field" => "name_category",
				"label" => "name_category",
				"rules" => "required"
			]
		];
		$this->load->library("json_validate");
		$callback = $this->json_validate->validate($data,$rules);

		if($callback['status']) {
			$data['id_category'] = "";
			$this->category_model->post_category($data);
		}
		
		echo json_encode($callback);
	}

	function delete($id) {
		if($this->category_model->get_category($id)->num_rows() < 1) {
			$callback['status'] = 0;
			$callback['msg'] = "Kategory gagal dihapus";
		} else {
			$this->category_model->delete_category($id);
			$callback['status'] = 1;
			$callback['msg'] = "Kategory berhasil dihapus";
		}

		echo json_encode($callback);
	}

	function index_json() {
        $this->load->library("datatables");
        $this->datatables->from("category");
        $this->datatables->set_column(['id_category','name_category']);
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name_category;
            $row[] = '<button type="button" class="btn btn-sm btn-dark btnedit" data-toggle="modal" data-target="#editModal" data-name="'.$field->name_category.'" data-id="'.$field->id_category.'"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="'.$field->name_category.'" data-id="'.$field->id_category.'"><i class="fas fa-trash"></i></button>';
 
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
