<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }
        
        $this->load->model("page_model");

	}
	
	public function index()
	{
		$pushdata['admin_info'] = $this->profile_info;
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/page/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }
    
	public function edit($id)
	{
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Edit Halaman";
        $pushdata['page_value'] = $this->page_model->get_pageid($id)->row();

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/page/compose',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    public function add()
	{
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Tambah Halaman";

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/page/compose',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function add_proccess() {
        $this->proccess("add");
    }

    function edit_proccess($id) {
        $this->proccess("edit",$id);
    }

    private function proccess($action,$id=0) {
        $this->load->helper("string");
        $data = $this->input->post();

        $rules = [
            [
                "field" => "title_page",
                "label" => "title_page",
                "rules" => "required"
            ],
            [
                "field" => "body_page",
                "label" => "body_page",
                "rules" => "required"
            ]
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);

        if($callback['status']){
            $rand = random_string("numeric",2);
            if(!empty($data['url_page'])) {
                $name = $data['url_page'];
            } else {
                $name = $data['title_page'];
            }
            $name = strtolower(str_replace(" ","-",$name));
            $name = preg_replace('/[^\w-]/', '', $name);

            if($action == "add") {
                $data['id_page'] = "";

                if($this->page_model->get_page($name)->num_rows() > 0) {
                    $num = $this->page_model->search_page("url_page",$name)->num_rows();
                    $name .= $num;
                    $name .= $rand;
                }

                $data['url_page'] = $name;

                $this->page_model->post_page($data);

                $callback['msg'] = "Halaman telah ditambahkan";

            } else {
                $getbefore = $this->page_model->get_pageid($id)->row_array();

                if($this->page_model->get_page($name)->num_rows() > 0 AND $getbefore['url_page'] != $name) {
                    $num = $this->page_model->search_page("url_page",$name)->num_rows();
                    $name .= $num;
                    $name .= $rand;
                }

                $data['url_page'] = $name;

                $this->page_model->put_page($id,$data);

                $callback['msg'] = "Halaman telah diperbaharui";
            }
        }

        echo json_encode($callback);
    }

    function delete($id) {
        if($this->page_model->get_pageid($id)->num_rows() < 1) {
            $callback['status'] = 0;
            $callback['msg'] = "Gagal menghapus halaman";
        } else {
            $this->page_model->delete_page($id);

            $callback['status'] = 1;
            $callback['msg'] = "Halaman berhasil dihapus";
        }

        echo json_encode($callback);
    }
    
    function index_json() {
        $this->load->library("datatables");
        $this->datatables->from("page");
        $this->datatables->set_column(['id_page','title_page','url_page']);
        $this->datatables->set_search_field("title_page");
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->title_page;
            $row[] = $field->url_page;
            $row[] = '<a href="'.base_url("admin/page/edit/$field->id_page").'" class="btn btn-sm btn-dark"><i class="fas fa-pen"></i></a> <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$field->id_page.'" data-title="'.$field->title_page.'"><i class="fas fa-trash"></i></button>';
 
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
