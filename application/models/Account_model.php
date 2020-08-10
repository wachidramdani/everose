<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model
{
    private $_table = "usercustomer";

    // public $namadepan;
    // public $namabelakang;
    // public $email;
    // public $nohandphone;
    // public $password;
    // public $alamat;
    // public $provinsi;
    // public $kota;
    // public $kecamatan;
    // public $kelurahan;
    // public $kodepos;

    // public function rules()
    // {
    //     return [
    //         ['field' => 'namadepan',
    //         'label' => 'Nama Depan',
    //         'rules' => 'required'],

    //         ['field' => 'namabelakang',
    //         'label' => 'Nama Belakang',
    //         'rules' => 'required'],
            
    //         ['field' => 'email',
    //         'label' => 'Email',
    //         'rules' => 'required'],

    //         ['field' => 'nohandphone',
    //         'label' => 'No. Handphone',
    //         'rules' => 'required'],

    //         ['field' => 'alamat',
    //         'label' => 'Alamat Lengkap',
    //         'rules' => 'required'],

    //         ['field' => 'provinsi',
    //         'label' => 'Provinsi',
    //         'rules' => 'required'],

    //         ['field' => 'kota',
    //         'label' => 'Kabupaten/Kota',
    //         'rules' => 'required'],

    //         ['field' => 'kecamatan',
    //         'label' => 'Kecamatan',
    //         'rules' => 'required'],

    //         ['field' => 'kelurahan',
    //         'label' => 'Kelurahan',
    //         'rules' => 'required'],

    //         ['field' => 'kodepos',
    //         'label' => 'Description',
    //         'rules' => 'required']
    //     ];
    // }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    function getphone_number($handphone) {
        return $this->db->get_where('usercustomer',array("nohandphone" => $handphone));
    }

    function profile_cust($handphone) {
        $this->db->select("concat(namadepan, ' ', namabelakang) namalengkap, email, nohandphone, alamat");
        $this->db->from("usercustomer");
        $this->db->where('nohandphone',$handphone);
        return $this->db->get();
    }

    public function save($datatopost)
    {
        $data =  $datatopost;
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->namadepan = $post["namadepan"];
        $this->namabelakang = $post["namabelakang"];
        $this->email = $post["email"];
        $this->nohandphone = $post["nohandphone"];
        $this->password = $post["password"];
        $this->alamat = $post["alamat"];
        $this->provinsi = $post["provinsi"];
        $this->kota = $post["kota"];
        $this->kecamatan = $post["kecamatan"];
        //$this->kelurahan = $post["kelurahan"];
        $this->kodepos = $post["kodepos"];
        return $this->db->update($this->_table, $this, array('user_iduser' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("user_id" => $id));
    }
}