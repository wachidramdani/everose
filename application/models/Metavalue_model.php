<?php

class Metavalue_model extends CI_Model {
    function get_metavalue($id) {
        return $this->db->get_where("meta_value",["name_meta_value" => $id]);
    }

    function get_all() {
        return $this->db->get("meta_value");
    }

    function put_metavalue($id,$data) {
        $this->db->where('name_meta_value',$id);
        $this->db->update('meta_value',$data);
    }

    function delete_metavalue($id) {
        return $this->db->delete("meta_value",["name_meta_value" => $id]);
    }

    function post_metavalue($data) {
        $this->db->insert("meta_value",$data);
    }
}