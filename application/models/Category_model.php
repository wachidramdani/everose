<?php

class Category_model extends CI_Model {
    function get_category($id) {
        return $this->db->get_where("category",["id_category" => $id]);
    }

    function get_all() {
        return $this->db->get("category");
    }

    function put_category($id,$data) {
        $this->db->where('id_category',$id);
        $this->db->update('category',$data);
    }

    function delete_category($id) {
        return $this->db->delete("category",["id_category" => $id]);
    }

    function post_category($data) {
        $this->db->insert("category",$data);
    }
}