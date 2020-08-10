<?php

class Visitor {
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
    }

    function hit() {
        $datenow = date("Y-m-d")." 00:00:00";
        if($this->CI->db->get_where("visitor",['date_visitor' => $datenow])->num_rows() > 0) {
            $gethit = $this->CI->db->get_where("visitor",['date_visitor' => $datenow])->row();
            $gethit = $gethit->hit + 1;

            $this->CI->db->where("date_visitor",$datenow);
            $this->CI->db->update("visitor",['hit' => $gethit]);
        } else {
            $this->CI->db->insert("visitor",['id_visitor' => NULL,'date_visitor' => $datenow,'hit' => 1]);
        }
    }
}