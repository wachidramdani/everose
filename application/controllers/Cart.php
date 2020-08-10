<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("slider_model");
        $this->load->model("category_model");
        $this->load->model("page_model");
        $this->load->library("cart_session");
        $this->load->model('product_list');

        $this->load->model("account_model");
        if(!$this->session->loginstatus) {
            redirect(base_url('account'));
        } else {
            $this->profile_info = $this->account_model->profile_cust($this->session->handphone)->row_array();
        }

    }

    function index() {
        if(!$this->session->loginstatus) {
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['pagetitle'] = "Keranjang Belanja";
        } else {
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['total'] = $this->cart_session->get_cart($this->session->cart);
            $push['pagetitle'] = "Keranjang Belanja";
            $push['user_info'] = $this->account_model->profile_cust($this->session->handphone)->row_array();
        }
        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/cart',$push);
        $this->load->view('sepatoe/footer',$push);
    }

    function wishlist() {
        if(!$this->session->loginstatus) {
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['wishlist'] = $this->product_list->getWishlist($this->session->handphone)->result();
            $push['pagetitle'] = "Daftar Favorit";
        } else {
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['pagetitle'] = "Daftar Favorit";
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['wishlist'] = $this->product_list->getWishlist($this->session->handphone)->result_array();
            $push['user_info'] = $this->account_model->profile_cust($this->session->handphone)->row_array();
        }
        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/wishlist',$push);
        $this->load->view('sepatoe/footer',$push);
    }

    function myorder(){
        if(!$this->session->loginstatus) {
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['pagetitle'] = "Pesananku";
        }else{
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['order'] = $this->cart_session->get_order($this->session->handphone);
            $push['pagetitle'] = "Pesananku";
            $push['user_info'] = $this->account_model->profile_cust($this->session->handphone)->row_array();
            $push['myorder'] = $this->product_model->myorder($this->session->handphone)->result_array();
        }

        //print_r($this->session);exit();
        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/myorder',$push);
        //$this->load->view('sepatoe/footer',$push);
    }

    function AddWishlist(){
        $data = $this->input->post();
        $datatopost = [
            "wish_id" => uniqid(),
            "produk_id" => $data['id'],
            "user_id" => $this->session->handphone,
            "created_date" => date('Y-m-d H:i:s'),
        ];
        $result = $this->product_list->saveWishlist($datatopost);
        if($result>="1"){
            redirect('account/success');
        }else{
            $this->session->set_flashdata("gagal", "<div class='alert alert-danger'><strong>Pengguna gagal disimpan</strong></div>");
            header('location:'.base_url().'account/register');
        }
    } 

    function delete() {
        $callback['status'] = 1;
        $callback['msg'] = "Berhasil menghapus item";
        $callback['csrf_regenerate'] = $this->security->get_csrf_hash();

        $id = $this->input->post("id");

        $getcart = $this->session->cart;

        unset($getcart[$id]);

        $this->session->set_userdata(["cart" => $getcart]);

        echo json_encode($callback);
    }

    function add() {
        $callback['status'] = 1;
        $callback['msg'] = "Item ditambahkan ke keranjang";
        $callback['csrf_regenerate'] = $this->security->get_csrf_hash();

        $id = $this->input->post("id");
        $qty = $this->input->post("qty");
        if(empty($qty)) {
            $qty = 1;
        }
        if(empty($this->input->post("update"))) {
            $update = FALSE;
        } else {
            $update = TRUE;
        }

        $query = $this->product_model->get_product($id);

        if($query->num_rows() < 1 OR $qty < 1 OR !is_numeric($qty)) {
            redirect(base_url("404"));
        } else {
            $stok = $query->row_array();
            if($stok['stock_product'] < $qty) {
                $callback['status'] = 0;
                $callback['msg'] = "Stok tidak tersedia";   
            } else {
                if(empty($this->session->cart)) {
                    $row = [$id => [$id,$qty]];
                    $this->session->set_userdata(["cart" => $row]);
                } else {
                    $rowbefore = $this->session->cart;
                    if(isset($rowbefore[$id])) {
                        if(!$update) {
                            $qty = $rowbefore[$id][1] + $qty;  
                        }
                    }
                    if($stok['stock_product'] < $qty) {
                        $callback['status'] = 0;
                        $callback['msg'] = "Stok tidak tersedia";   
                    } else {
                        $rowbefore[$id] = [$id,$qty];
                        $this->session->set_userdata(["cart" => $rowbefore]);
                    }
                }
            }
        }
        echo json_encode($callback);
    }

}