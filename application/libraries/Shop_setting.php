<?php
class Shop_setting {
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('setting_model');
        $this->CI->load->model('rajaongkir_model');
    }

    function sitename() {
        return $this->CI->setting_model->get_setting('sitename');
    }
    function logo() {
        return $this->CI->setting_model->get_setting('logo');
    }
    function description() {
        return $this->CI->setting_model->get_setting('description');
    }

    function rajaongkir_key() {
        return $this->CI->rajaongkir_model->get_key(); 
    }

    function rajaongkir_type() {
        return $this->CI->rajaongkir_model->get_type();
    }

    function rajaongkir_province() {
        return $this->CI->rajaongkir_model->get_province();
    }
    function rajaongkir_city() {
        return $this->CI->rajaongkir_model->get_city();
    }
}