<?php

class Slider_model extends CI_Model {

    function post_slider($data) {
        $this->db->insert("slider",$data);
    }

    function get_slider($id) {
        return $this->db->get_where("slider",["id_slider" => $id]);
    }

    function put_slider($id,$data) {
        $this->db->where("id_slider",$id);
        $this->db->update("slider",$data);
    }

    function delete_slider($id) {
        $this->db->delete("slider",['id_slider' => $id]);
    }

    function all_slider() {
        return $this->db->get("slider");
    }
}