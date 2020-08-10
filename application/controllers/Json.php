<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("rajaongkir");
    }

    function get_city() {
        $key = $this->input->post("key");

        $response = $this->rajaongkir->all_city($this->shop_setting->rajaongkir_key(),$key,$this->shop_setting->rajaongkir_type());
        $response['csrf_regenerate'] = $this->security->get_csrf_hash();
        $response['key'] = $key;

        echo json_encode($response);
    }

    function sum_shipping() {
        $this->load->library("cart_session");
        $this->load->model("rajaongkir_model");
        $cart = $this->cart_session->get_cart($this->session->cart);

        if(isset($cart['weight'])) {

        $data = [
            "origin" => $this->shop_setting->rajaongkir_city(),
            "destination" => $this->input->post("destination"),
            "weight" => $cart['weight']
        ];

        $response = array();
        $response['results'] = array();

        $this->load->library("rajaongkir");
        $getcourier = $this->rajaongkir_model->get_courier()->result_array();
        foreach($getcourier as $courier) {
            $arraylist = explode(",",$courier['type']);
            $arraylist = array_map("trim",$arraylist);
            $arraylist = array_map("strtolower",$arraylist);

            $arrayid = explode(",",$courier['id']);
            $arrayid = array_map("trim",$arrayid);

            $data['courier'] = strtolower($courier['name_courier']);

            $result = $this->rajaongkir->cost($this->shop_setting->rajaongkir_key(),$data,$this->shop_setting->rajaongkir_type());

            foreach($result['rajaongkir']['results'][0]['costs'] as $service) {
                if(in_array(strtolower($service['service']),$arraylist)) {
                    $keyid = array_search(strtolower($service['service']),$arraylist);

                    $row['id'] = $arrayid[$keyid];

                    $row['courier'] = $courier['name_courier'];
                    $row['service'] = $service['service'];
                    $row['shipping'] = $this->toolset->rupiah($service['cost'][0]['value']);
                    $row['etd'] = $service['cost'][0]['etd'];
                    $row['total'] = $this->toolset->rupiah($cart['total'] + $service['cost'][0]['value']);
                    $response['results'][] = $row;
                }
            }
        }
        }

        $response['csrf_regenerate'] = $this->security->get_csrf_hash();

        echo json_encode($response);
    }
}