<?php
class Rajaongkir_model extends CI_Model {
    private $data;

    function __construct() {
        parent::__construct();

        $this->data = $this->db->get_where("rajaongkir_api",['id_api' => 1])->row();
    }

    function get_key() {
        return $this->data->key_api;
    }

    function get_type() {
        return $this->data->type_api;
    }
    function get_province() {
        return $this->data->province_api;
    }
    function get_city() {
        return $this->data->city_api;
    }

    function get_courier() {
        $this->db->select("GROUP_CONCAT(id_courier SEPARATOR ',') AS id,name_courier,GROUP_CONCAT(type_courier SEPARATOR ',') AS type");
        $this->db->from("rajaongkir_courier");
        $this->db->group_by("name_courier");
        return $this->db->get();
    }

    function post_courier($data) {
        $this->db->insert("rajaongkir_courier",$data);
    }

    function get_courier_service($id) {
        return $this->db->get_where("rajaongkir_courier",["id_courier" => $id]);
    }

    function put_courier($id,$data) {
        $this->db->where("id_courier",$id);
        $this->db->update("rajaongkir_courier",$data);
    }

    function delete_courier($id) {
        $this->db->delete("rajaongkir_courier",['id_courier' => $id]);
    }

    function save($data) {
        $this->db->where("id_api",1);
        $this->db->update("rajaongkir_api",$data);
    }
}