<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_product extends CI_Controller {

    private $profile_info;

    function __construct() {
        parent::__construct();

        $this->load->model('admin_model');
        $this->load->model("category_model");
        $this->load->model("product_model");

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
        } else {
            $this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }

    }

    function del_photo($id) {
        $callback['status'] = 0;
        $detail = $this->product_model->get_photo($id)->row_array();
        $filebefore = '././upload/product/'.$detail['url_photo'];
        if(is_readable($filebefore)) {
            unlink($filebefore);
            $this->product_model->del_photo($id);
            $callback['status'] = 1;
        }

        echo json_encode($callback);
    }

    function add() {
        $callback['admin_info'] = $this->profile_info;
        $callback['pagetitle'] = "Tambah Produk";
        $callback['data_category'] = $this->category_model->get_all()->result_array();

        $this->load->view("admin/header",$callback);
        $this->load->view("admin/product/compose",$callback);
        $this->load->view("admin/footer",$callback);
    }

    function edit($id) {
        $query = $this->product_model->get_product($id);
        if($query->num_rows() < 1) {
            redirect(base_url("404"));
            die("404");
        }
        $callback['product_value'] = $query->row();
        $callback['admin_info'] = $this->profile_info;
        $callback['pagetitle'] = "Edit Produk";
        $callback['data_category'] = $this->category_model->get_all()->result_array();

        $this->load->view("admin/header",$callback);
        $this->load->view("admin/product/compose",$callback);
        $this->load->view("admin/footer",$callback);
    }

    function add_proccess() {
        $data = $this->input->post();
        //print_r($data);exit();
        $files = $_FILES['foto'];
        $action = "add";
        $this->proccess($data,$files,$action);
    }

    function edit_proccess($id) {
        $data = $this->input->post();
        $files = $_FILES['foto'];
        $action = "edit";
        $this->proccess($data,$files,$action,$id);
    }

    private function proccess($data,$files,$action,$id = "0") {

        $rules = [
            [
                "field" => "name_product",
                "label" => "name_product",
                "rules" => "required|min_length[5]|max_length[100]"
            ],
            [
                "field" => "description_product",
                "label" => "description_product",
                "rules" => "required|min_length[20]"
            ],
            [
                "field" => "price_product",
                "label" => "price_product",
                "rules" => "required|numeric"
            ],
            [
                "field" => "weight_product",
                "label" => "weight_product",
                "rules" => "required|numeric"
            ],
            [
                "field" => "id_category",
                "label" => "id_category",
                "rules" => "required"
            ],
            [
                "field" => "warna",
                "label" => "warna",
                "rules" => "required"
            ],
            [
                "field" => "size",
                "label" => "size",
                "rules" => "required"
            ],
            [
                "field" => "stock_product",
                "label" => "stock_product",
                "rules" => "required"
            ],
            [
                "field" => "hargabeli",
                "label" => "hargabeli",
                "rules" => "required"
            ],
            [
                "field" => "hargainvestor",
                "label" => "hargainvestor",
                "rules" => "required"
            ],
            [
                "field" => "namainvestor",
                "label" => "namainvestor",
                "rules" => "required"
            ]
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);

        if($this->category_model->get_category($data['id_category'])->num_rows() < 1) {
            $callback['status'] = 0;
            $callback['error'][] = [
                "field" => "id_category",
                "msg" => "Kategori tidak ditemukan"
            ];
        }

        if($callback['status']) {
            if($action == "add") {
                $data['id_product'] = "";
                $data['updated_product'] = date("Y-m-d H:i:s");
                $data['id_admin'] = $this->profile_info['id_admin'];
                $insert_id = $this->product_model->post_product($data);
            } else {
                $querycek = $query = $this->product_model->get_product($id);
                if($query->num_rows() < 1) {
                    redirect(base_url("404"));
                    die("404");
                }
                $data['updated_product'] = date("Y-m-d H:i:s");
                $data['id_admin'] = $this->profile_info['id_admin'];
                $insert_id = $this->product_model->put_product($data,$id);
            }
        }

        if($callback['status']) {

            $name = str_replace(" ","_",$data['name_product']);

            $count = count($files['name']);
    
            for($i=0;$i<$count;$i++){
    
            if(!empty($files['name'][$i])){
    
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];

                $this->load->helper("string");
                $this->load->helper("file");
                $name = preg_replace('/[^\w-]/', '', $name);

                $config['upload_path']          = '././upload/product';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;
                $config['file_name']            = $name;
    
                $this->load->library('upload',$config); 

                if($this->upload->do_upload('file')){
                    $result = $this->upload->data();
                    $fotoup = $result['file_name'];

                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/'.$result['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '50%';
                    $config['width']= 400;
                    $config['height']= 400;
                    $config['new_image']= './assets/images/'.$result['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $dataphoto = [
                        "id_photo" => "",
                        "id_product" => $insert_id,
                        "url_photo" => $fotoup
                    ];
                    $this->product_model->post_photo($dataphoto);
                } else {
                    $callback['status'] = 0;
                    $callback['error'][] = [
                        "field" => "id_category",
                        "msg" => "Foto tak terupload"
                    ];
                }
    
            }
    
            }
        }

        echo json_encode($callback);
    }

    function index() {
        $callback['admin_info'] = $this->profile_info;
        $callback['pagetitle'] = "Kelola Produk";
        $callback['product'] = $this->product_model->all_product()->result();

        $this->load->view("admin/header",$callback);
        $this->load->view("admin/product/index",$callback);
        $this->load->view("admin/footer",$callback);
    }

    function delete($id) {
        $querycek = $query = $this->product_model->get_product($id);
        if($query->num_rows() < 1) {
            redirect(base_url("404"));
            die("404");
        }

        $callback['status'] = 0;
        $callback['msg'] = "Gagal menghapus";

        if($this->product_model->delete_product($id)) {
            $deletephoto = FALSE;
            $geturl = $this->product_model->get_allurlpic($id)->row_array();
            $geturl = explode(",",$geturl['url']);

            if(!empty($geturl[0])) {

                foreach($geturl as $url) {
                    $url = trim($url);
                    $filebefore = '././upload/product/'.$url;
                    if(is_readable($filebefore)) {
                        unlink($filebefore);
                    }

                }

                $deletephoto = TRUE;

            }

            $callback['status'] = 1;
            $callback['msg'] = "Berhasil dihapus";
        }

        if($callback['status'] AND $deletephoto) {
            $this->product_model->del_allphoto($id);
        }

        echo json_encode($callback);
    }

    function index_json() {
        $this->load->library("datatables");
        $this->datatables->select("product.*,photo_product.id_photo,photo_product.url_photo,category.name_category");
        $this->datatables->from("product");
        $this->datatables->join("photo_product","photo_product.id_product=product.id_product","left");
        $this->datatables->join("category","category.id_category=product.id_category","left");
        $this->datatables->group_by("id_product");
        $this->datatables->set_column(['id_product','name_product','price_product','weight_product','name_category','updated_product']);
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name_product;
            $row[] = $this->toolset->rupiah($field->price_product);
            $row[] = $field->stock_product;
            $row[] = $field->weight_product;
            $row[] = $field->name_category;
            $row[] = $field->updated_product;
            $row[] = '<a class="btn btn-sm btn-dark" href="'.base_url().'index.php/admin/product/edit/'.$field->id_product.'"><i class="fas fa-pen"></i></a> <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="'.$field->name_product.'" data-id="'.$field->id_product.'"><i class="fas fa-trash"></i></button>';
 
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