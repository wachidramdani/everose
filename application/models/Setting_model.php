<?php
class Setting_model extends CI_Model {
    function get_setting($key) {
        $query = $this->db->get_where('setting',['key_setting' => $key])->row_array();
        return $query['value_setting'];
    }

    function getall() {
        return $this->db->get('setting');
    }
    function set_setting($key,$value) {
        $this->db->where('id_setting',$key);
        $this->db->update('setting',['value_setting' => $value]);
    }
}