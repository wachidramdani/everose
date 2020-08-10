<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("slider_model");
        $this->load->model("category_model");
        $this->load->model("page_model");
        $this->load->library("cart_session");
        $this->load->database();
        $this->load->model('province_model');
        $this->load->helper('url');
        $this->load->model('account_model');
        $this->load->library("rajaongkir");

        // if(!$this->session->login_status) {
        //     redirect(base_url('home'));
        // } else {
        //     $this->profile_info = $this->account_model->profile_cust($this->session->handphone)->row_array();
        // }
    }

    function index() {
        $push['categories'] = $this->category_model->get_all()->result();
        $push['pages'] = $this->page_model->all_page()->result();
        $push['cart'] = $this->cart_session->get_cart($this->session->cart);
        $this->load->view('sepatoe/header', $push);
        $this->load->view('sepatoe/account', $push);
        $this->load->view('sepatoe/footer', $push);
    }

    function register() {
        $push['categories'] = $this->category_model->get_all()->result();
        $push['pages'] = $this->page_model->all_page()->result();
        $push['cart'] = $this->cart_session->get_cart($this->session->cart);
        $push['provinsi']=$this->province_model->provinsi();
        $push['province'] = $this->rajaongkir->all_province($this->shop_setting->rajaongkir_key(),$this->shop_setting->rajaongkir_type());
        $this->load->view('sepatoe/header', $push);
        $this->load->view('sepatoe/account_register', $push);
        //$this->load->view('sepatoe/footer');
    }

    public function login() {
        $handphone = $this->input->post('handphone');
        $pass = $this->input->post('password_in');

        $query = $this->account_model->getphone_number($handphone);

        if($query->num_rows() < 1) {
            $callback['status'] = 0;
            $callback['msg'] = "Username tidak ditemukan";
        } else {
            $parse = $query->row_array();

            if(!md5($pass,$parse['password'])) {
                $callback['status'] = 0;
                $callback['msg'] = "Password salah";
            } else {
                $datasession = [
                    "loginstatus" => 1,
                    "handphone" => $handphone,
                    "namadepan" => $parse['namadepan'],
                    "namabelakang" => $parse['namabelakang']
                ];

                $this->session->set_usercustomer($datasession);
                $callback['status'] = 1;
                $callback['msg'] = "Login berhasil";
            }
        }

        echo json_encode($callback);
    }

    public function logout() {
        if($this->session->loginstatus) {
            $arrayitem = ["login_status","handphone", "namadepan", "namabelakang", "email"];
            $this->session->unset_usercustomer($arrayitem);
            redirect(base_url('index.php/home'));
        }
    }

    function success() {
        $push['categories'] = $this->category_model->get_all()->result();
        $push['pages'] = $this->page_model->all_page()->result();
        $push['cart'] = $this->cart_session->get_cart($this->session->cart);
        $this->load->view('sepatoe/header', $push);
        $this->load->view('sepatoe/success', $push);
        $this->load->view('sepatoe/footer');
    }

    function adduser(){
        $data = $this->input->post();
        $datatopost = [
            "user_id" => uniqid(),
            "namadepan" => $data['namadepan'],
            "namabelakang" => $data['namabelakang'],
            "email" => $data['email'],
            "nohandphone" => $data['nohandphone'],
            "password" => md5($data['password']),
            "alamat" => $data['alamat'],
            "provinsi" => $data['provinsi'],
            "kota" => $data['kota'],
            "kecamatan" => $data['kecamatan'],
            //"kelurahan" => $data['kelurahan'],
            "kodepos" => $data['kodepos'],
            "created_date" => date('Y-m-d H:i:s'),
        ];
        $result = $this->account_model->save($datatopost);
        if($result>="1"){
            redirect('account/success');
        }else{
            $this->session->set_flashdata("gagal", "<div class='alert alert-danger'><strong>Pengguna gagal disimpan</strong></div>");
            header('location:'.base_url().'account/register');
        }
    } 

    
    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('tb_ro_subdistricts',array('city_id'=>$kabupatenID));
        echo " <div class='form-group'>";
        echo "<select id='kecamatan' onChange='loadDesa()' class='form-control' name='kecamatan'>";
        foreach ($kecamatan->result() as $k)
        {
            echo "<option value='$k->subdistrict_id '>$k->subdistrict_name</option>";
        }
        echo"</select><?php echo form_error('kecamatan') ?></div>";
    }

}