<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("product_list");
        $this->load->model("slider_model");
        $this->load->model("category_model");
        $this->load->model("page_model");
        $this->load->library("cart_session");

    }

    function index($id,$slug,$page = 0) {

        $query = $this->category_model->get_category($id);

        if($query->num_rows() < 1) {
            redirect(base_url('404'));
        }
        
        $fetching = $query->row();
        
        if($this->toolset->tourl($fetching->name_category) != $slug) {
            redirect(base_url('404'));
        }

        $sort = $this->input->get('sort');

        $price = $this->input->get("price");
        
        
        $push['sliders'] = $this->slider_model->all_slider()->result();
        $push['categories'] = $this->category_model->get_all()->result();
        $push['pages'] = $this->page_model->all_page()->result();
        $push['cart'] = $this->cart_session->get_cart($this->session->cart);
        
        $push['sort'] = $sort;
        $expfilter = explode("-",$price);
        $push['min'] = $expfilter[0];
        if(count($expfilter) > 1) { $push['max'] = $expfilter[1]; }
        $push['sorturl'] = base_url("index.php/category/$id-$slug/$page?price=$price&sort=");
        $push['pagetitle'] = $fetching->name_category;
        $push['filterurl'] = base_url("index.php/category/$id-$slug/$page?sort=$sort&price=");
        
        $push['breadcrumb'] = ['<li><a href="'.base_url().'">Home</a></li>','<li>'.$fetching->name_category.'</li>'];
        
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("index.php/category/$id-$slug");
        $config['total_rows'] = $this->product_list->category_list($sort,$id,$price)->num_rows();;
        $config['per_page'] = 8;
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = '|&lt;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = '&gt;|';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        
        $this->pagination->initialize($config);
        $push['paging'] = $this->pagination->create_links();
        $push['productlist'] = $this->product_list->category_list($sort,$id,$price,[$page,$config['per_page']])->result();
        $push['pageinfo'] = [
            "numpage" => ceil($config['total_rows'] / $config['per_page']),
            "from" => ($page + 1),
            "to" => ($page + $config['per_page']),
            "total" => $config['total_rows']
        ];
        
        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/category',$push);
        //$this->load->view('sepatoe/footer',$push);
    }
}