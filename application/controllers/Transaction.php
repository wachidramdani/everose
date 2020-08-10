<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("slider_model");
        $this->load->model("category_model");
        $this->load->model("rajaongkir_model");
        $this->load->model("page_model");
        $this->load->library("cart_session");
        $this->load->library("rajaongkir");
        $this->load->model("midtrans");
        $this->load->model("invoice_model");
        $this->load->model("account_model");

        if(!$this->session->loginstatus) {
            redirect(base_url('account'));
        } else {
            $this->profile_info = $this->account_model->profile_cust($this->session->handphone)->row_array();
        }
    }
    
    function checkout() {
        if(!$this->session->loginstatus) {
            $push['pagetitle'] = "Checkout";
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['province'] = $this->rajaongkir->all_province($this->shop_setting->rajaongkir_key(),$this->shop_setting->rajaongkir_type());
        }else{
            $push['pagetitle'] = "Checkout";
            $push['productlist'] = $this->product_model->all_product()->result();
            $push['sliders'] = $this->slider_model->all_slider()->result();
            $push['categories'] = $this->category_model->get_all()->result();
            $push['pages'] = $this->page_model->all_page()->result();
            $push['cart'] = $this->cart_session->get_cart($this->session->cart);
            $push['province'] = $this->rajaongkir->all_province($this->shop_setting->rajaongkir_key(),$this->shop_setting->rajaongkir_type());
            $push['total'] = $this->cart_session->get_cart($this->session->cart);
            $push['order'] = $this->cart_session->get_order($this->session->handphone);
            $push['user_info'] = $this->account_model->profile_cust($this->session->handphone)->result();
        }

        //print_r($push['user_info'] = $this->account_model->profile_cust($this->session->handphone)->row_array());exit();

        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/checkout',$push);
        $this->load->view('sepatoe/footer',$push);
    }

    private function verif_pro() {
        $data = $this->input->post();
        $rules = [
            [
                "field" => "hp_invoice",
                "label" => "Nomor Handphone",
                "rules" => "required|numeric|min_length[11]|max_length[12]",
            ],
            [
                "field" => "email_invoice",
                "label" => "Email",
                "rules" => "required|valid_email"
            ],
            [
                "field" => "name_invoice",
                "label" => "Nama",
                "rules" => "required"
            ],
            [
                "field" => "provinsi",
                "label" => "Provinsi",
                "rules" => "required|numeric"
            ],
            [
                "field" => "kota",
                "label" => "Kabupaten atau Kota",
                "rules" => "required|numeric"
            ],
            [
                "field" => "kecamatan",
                "label" => "Kecamatan",
                "rules" => "required"
            ],
            [
                "field" => "alamat",
                "label" => "Alamat",
                "rules" => "required"
            ],
            [
                "field" => "pos",
                "label" => "Kode POS",
                "rules" => "required|numeric"
            ],
            [
                "field" => "courier_invoice",
                "label" => "Kurir",
                "rules" => "required"
            ]
        ];

        $this->load->library("json_validate");
        $callback = $this->json_validate->validate($data,$rules);
        $cart = $this->cart_session->get_cart($this->session->cart);
        if(!isset($cart['weight'])) {
            $callback['status'] = 0;
            $callback['error'] = [
                [
                    "field" => "Keranjang",
                    "msg" => "anda masih kosong"
                ]
            ];
        }

        return $callback;
    }

    function verification() {
        $callback = $this->verif_pro();
        $callback['csrf_regenerate'] = $this->security->get_csrf_hash();

        echo json_encode($callback);
    }

    function payment() {
        $push['pagetitle'] = "Pembayaran";
        $data = $this->input->post();
        $push['productlist'] = $this->product_model->all_product()->result();
        $push['sliders'] = $this->slider_model->all_slider()->result();
        $push['categories'] = $this->category_model->get_all()->result();
        $push['pages'] = $this->page_model->all_page()->result();
        $push['cart'] = $this->cart_session->get_cart($this->session->cart);
        $push['clientkey'] = $this->midtrans->get_access("clientkey");

        $response = $this->verif_pro();

        if(!$response['status']) {
            $error = TRUE;
        }

        if(!isset($push['cart']['weight'])) {
            $error = TRUE;
        }

        if(!isset($error)) {
            $query = $this->rajaongkir_model->get_courier_service($data['courier_invoice']);
            if($query->num_rows() < 1) {
                $error = TRUE;
            }
        }



        if(isset($error)) {
            redirect(base_url("404"));
            die();
        } else {
            $fetch = $query->row();

            $datasend = [
                "origin" => $this->shop_setting->rajaongkir_city(),
                "destination" => $data['kota'],
                "weight" => $push['cart']['weight'],
                "courier" => strtolower($fetch->name_courier)
            ];
            $result = $this->rajaongkir->cost($this->shop_setting->rajaongkir_key(),$datasend,$this->shop_setting->rajaongkir_type());

            $statuscode = "";

            if(isset($result['rajaongkir']['status']['code'])) {
                $statuscode = $result['rajaongkir']['status']['code'];
            }

            if($statuscode == 200) {
                $shipping = "";
                $noinvoice = $this->invoice_model->generate_invoice();
    
                foreach($result['rajaongkir']['results'][0]['costs'] as $service) {
                    if($service['service'] == $fetch->type_courier) {
                        $shipping = $service['cost'][0]['value'];
                    }
                }

                $pushitem1 = array();

                foreach($push['cart']['data'] as $crt) {
                    $row = array();
                    $row['price'] = $crt['price'];
                    $row['quantity'] = $crt['qty'];
                    $row['name'] = $crt['name'];
                    $pushitem1[] = $row;
                }
                $pushitem1[] = [
                    "price" => $shipping,
                    "quantity" => 1,
                    "name" => "Ongkos Kirim"
                ];
    
                $address =$data['alamat'].", Kec. ".$data['kecamatan'].", ".$result['rajaongkir']['destination_details']['type']." ".$result['rajaongkir']['destination_details']['city_name'].", ".$result['rajaongkir']['destination_details']['province']." - ".$data['pos'];

                $tokenorder = [
                    "order_id" => $noinvoice,
                    "gross_amount" => $push['cart']['total'] + $shipping
                ];
                $tokencustomer = [
                    "first_name" => $data['name_invoice'],
                    "email" => $data['email_invoice']
                ];

                $responsegettoken = json_decode($this->midtrans->get_token($this->midtrans->get_access("serverkey"),$tokenorder,$pushitem1,$tokencustomer),TRUE);

                if(isset($responsegettoken['token'])) {
                    $push['dataorder'] = [
                        "id_invoice" => NULL,
                        "no_invoice" => $noinvoice,
                        "name_invoice" => $data['name_invoice'],
                        "hp_invoice" => $data['hp_invoice'],
                        "email_invoice" => $data['email_invoice'],
                        "address_invoice" => $address,
                        "courier_invoice" => $fetch->name_courier." ".$fetch->type_courier,
                        "total_invoice" => $push['cart']['total'],
                        "shipping_invoice" => $shipping,
                        "status_invoice" => 1,
                        "date_invoice" => date("Y-m-d H:i:s"),
                        "token_invoice" => $responsegettoken['token']
                    ];

                    $lastid = $this->invoice_model->post_invoice($push['dataorder']);

                    $push['dataorder']['link'] = $responsegettoken['redirect_url'];
                    $pushitem2 = array();
                    $countstock = array();

                    foreach($push['cart']['data'] as $crt) {
                        $row = array();
                        $row['id_detail'] = NULL;
                        $row['id_invoice'] = $lastid;
                        $row['id_product'] = $crt['id'];
                        $row['product_detail'] = $crt['name'];
                        $row['price_detail'] = $crt['price'];
                        $row['qty_detail'] = $crt['qty'];
                        $pushitem2[] = $row;

                        $row2 = array();
                        $row2['id_product'] = $crt['id'];
                        $row2['stock_product'] = $crt['stock'] - $crt['qty'];
                        $countstock[] = $row2;
                    }

                    $this->invoice_model->post_detail_batch($pushitem2);
                    $this->invoice_model->update_stock($countstock);
                    $this->session->unset_userdata('cart');
                    $sessionstore = [
                        "order_id" => $noinvoice,
                        "email_invoice" => $data['email_invoice']
                    ];

                    $this->session->set_userdata($sessionstore);
                    $this->sendEmail($push['dataorder'], $pushitem2);
                } else {
                    die();
                }
    
            } else {
                die();
            }

        }

        $this->load->view('sepatoe/header',$push);
        $this->load->view('sepatoe/payment',$push);
        //$this->load->view('sepatoe/footer',$push);
    }

    public function sendEmail($dataEmail, $produk){
        $this->load->library('mailer');
        $html = "<html>
                    <body>
                        <table style='width: 95%; margin: 30px; border: 1px solid'>
                            <tr>
                                <td style='background-color: #e6e6e6;'>
                                    <img style='margin: 20px; width: 150px' src='https://sepatoe.id/assets/cover.png'>
                                </td>
                            </tr>
                            <tr style='background-color: #FEFEFE'>
                                <td colspan='2'>
                                    <div style='height: 250px; color: #313131'>
                                        <p style='margin: 20px'>
                                            Halo '".$dataEmail['name_invoice']."', <br>
                                            Terima kasih sudah berbelanja di <b>sepatoe.id</b> <br>
                                            Silahkan lakukan pembayaran untuk nomor pembayaran <b>'".$dataEmail['no_invoice']."'</b> sejumlah <b>'".$this->toolset->rupiah($dataEmail['total_invoice'])."'</b>. <br>
                                            Nomor Resi pengiriman akan kami kirim ke email setelah proses Pembayaran & <i>Packing</i> Selesai.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
        ";

        $sendmail = array(
          'email_penerima'=> $dataEmail['email_invoice'],
          'subjek'=>'Pesanan No. Order : '.$dataEmail['no_invoice'],
          'content'=>$html
          //'attachment'=>$attachment
        );
        if(empty($attachment['name'])){ // Jika tanpa attachment
          $send = $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer
        }else{ // Jika dengan attachment
          $send = $this->mailer->send_with_attachment($sendmail); // Panggil fungsi send_with_attachment yang ada di librari Mailer
        }
    }
}