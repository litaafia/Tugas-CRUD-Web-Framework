<?php 

class M_data extends CI_Model{

	// method ini berfungsi untuk menampilkan data tabel user dari database
	function tampil_data(){
		return $this->db->get('user');
	}

	// method ini berfungsi untuk menginputkan data
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	// method ini berfungsi untuk menghapus data
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	// method ini berfungsi untuk mengedit data
	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}

	// method ini berfungsi untuk memunculkan data yang telah diedit
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
}