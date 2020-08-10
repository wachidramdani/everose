<?php

class Resi_model extends CI_Model {
    function post_resi($data) {
        $this->db->insert("resi",$data);
    }

    function put_resi($id_invoice,$data) {
        $this->db->where("id_invoice",$id_invoice);
        $this->db->update("resi",$data);
    }

    function get_resi($idinvoice) {
        return $this->db->get_where("resi",['id_invoice' => $idinvoice]);
    }
} 