<?php

Class Province_model extends CI_Model
{

	function __construct(){

	parent::__construct();

	}


	function provinsi(){
		$this->db->order_by('name','ASC');
		$provinces= $this->db->get('provinces');

		return $provinces->result_array();
	}

	function kabupaten($provId){
		$kabupaten="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kab= $this->db->get_where('regencies',array('province_id'=>$provId));

		foreach ($kab->result_array() as $push ){
			$kabupaten.= "<option value='$push[id]'>$push[name]</option>";
		}
	}


	function kecamatan($kabId){
		$kecamatan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kec= $this->db->get_where('districts',array('regency_id'=>$kabId));

		foreach ($kec->result_array() as $push ){
			$kecamatan.= "<option value='$push[id]'>$push[name]</option>";
		}
		return $kecamatan;
	}

	function kelurahan($kecId){
		$kelurahan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('name','ASC');
		$kel= $this->db->get_where('villages',array('district_id'=>$kecId));

		foreach ($kel->result_array() as $push ){
			$kelurahan.= "<option value='$push[id]'>$push[name]</option>";
		}
		return $kelurahan;
	}


} 