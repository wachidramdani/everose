<?php

class Page_model extends CI_Model {
    function all_page() {
        return $this->db->get("page");
    }

    function get_page($page) {
        return $this->db->get_where("page",['url_page'=>$page]);
    }
    function get_pageid($page) {
        return $this->db->get_where("page",['id_page'=>$page]);
    }
    function search_page($from,$page) {
        $this->db->like($from,$page);
        return $this->db->get("page");
    }

    function post_page($data) {
        $this->db->insert("page",$data);
    }
    function put_page($id,$data) {
        $this->db->where("id_page",$id);
        $this->db->update("page",$data);
    }

    function delete_page($id) {
        $this->db->delete("page",['id_page' => $id]);
    }
}