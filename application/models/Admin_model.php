<?php

class Admin_model extends CI_Model {
    function get_username($username) {
        return $this->db->get_where('admin',array("usn_admin" => $username));
    }

    function get_id($id) {
        $this->db->select("*");
        $this->db->from("admin");
        $this->db->join("profile","profile.id_admin = admin.id_admin","right");
        $this->db->where('profile.id_admin',$id);
        return $this->db->get();
    }

    function profile_usn($username) {
        $this->db->select("admin.usn_admin,admin.id_level,profile.*");
        $this->db->from("admin");
        $this->db->join("profile","profile.id_admin = admin.id_admin","right");
        $this->db->where('usn_admin',$username);
        return $this->db->get();
    }

    function set_profile($arraypost,$id) {
        $this->db->where("id_admin",$id);
        $this->db->update("profile",$arraypost);
    }

    function set_admin($arraypost,$id) {
        $this->db->where("id_admin",$id);
        $this->db->update("admin",$arraypost);
    }

    function post_admin($array) {
        $this->db->insert("admin",$array);

        return $this->db->insert_id();
    }
    function post_profile($array) {
        $this->db->insert("profile",$array);
    }

    function delete_admin($id) {
        $this->db->delete('admin',['id_admin' => $id]);
        $this->db->delete('profile',['id_admin' => $id]);
    }
}