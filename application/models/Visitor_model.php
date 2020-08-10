<?php
class Visitor_model extends CI_Model {
    function get_today() {
        $datenow = date("Y-m-d")." 00:00:00";
        $query = $this->db->get_where("visitor",['date_visitor' => $datenow]);
        if($query->num_rows() < 1) {
            $data = 0;
        } else {
            $data = $query->row();
            $data = $data->hit;
        }

        return $data;
    }

    function get_month() {
        $datenow = date("Y-m")."-01 00:00:00";
        $this->db->select("SUM(hit) as hit");
        $this->db->from("visitor");
        $this->db->where("date_visitor >=",$datenow);
        $query = $this->db->get();

        if($query->num_rows() < 1) {
            $data = 0;
        } else {
            $data = $query->row();
            $data = $data->hit;
        }

        return $data;
    }
    function get_year() {
        $datenow = date("Y")."-01-01 00:00:00";
        $this->db->select("SUM(hit) as hit");
        $this->db->from("visitor");
        $this->db->where("date_visitor >=",$datenow);
        $query = $this->db->get();

        if($query->num_rows() < 1) {
            $data = 0;
        } else {
            $data = $query->row();
            $data = $data->hit;
        }

        return $data;
    }
    function get_total() {
        $this->db->select("SUM(hit) as hit");
        $this->db->from("visitor");
        $query = $this->db->get();

        if($query->num_rows() < 1) {
            $data = 0;
        } else {
            $data = $query->row();
            $data = $data->hit;
        }

        return $data;
    }
}