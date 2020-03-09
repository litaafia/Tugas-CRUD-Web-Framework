<!-- controller untuk mengatur CRUD pada database -->
<?php 

class Crud extends CI_Controller{
	// code construct akan berjalan otomatis saat controller diakses
	function __construct(){
		parent::__construct();	
		// untuk me load models yaitu m_data	
		$this->load->model('m_data');
				// untuk me load helper yaitu url
                $this->load->helper('url');
	}

	// fungsi ini akan berjalan pertama kali ketika controller di akses tanpa method
	function index(){
		$data['user'] = $this->m_data->tampil_data()->result();
		$this->load->view('v_tampil',$data);
	}

	// menginputkan data baru
	function tambah(){
		$this->load->view('v_input');
	}

	// method yang berjalan ketika button submit ditekan
	// merekam data dar view, meyimpan ke database dan mengembalikan ke index
	function tambah_aksi(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
		// array yang menjadikan ketiga data diatas menjadi 1 variabel
		// query ini akan disertakan ke dalam query insert pada m_data
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
			);
		$this->m_data->input_data($data,'user');
		redirect('crud/index');
	}

	// method hapus berfungsi untuk menghapus data dari database
	// parameter yang dibutuhka adalah $id yg berasal dari id user
	function hapus($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'user');
		redirect('crud/index');
	}

	// method edit berfungsi untuk mengarahkan user ke v_edit yang merupakan form view edit
	// dan mengedit data dari database
	function edit($id){
		$where = array('id' => $id);
		$data['user'] = $this->m_data->edit_data($where,'user')->result();
		$this->load->view('v_edit',$data);
	}

	// method update dapat dijalankan ketika tombol submit pada v_edit
	// method ini berfungsi untuk merekam data, memperbarui data yang dituju
	// dan mengarahkan user menuju crud method index
	function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
	
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
		);
	
		// berfungsi untuk menyimpan id user ke array $where
		$where = array(
			'id' => $id
		);

		// merupakan method untuk menjalankan query update
		// $where merupakan id yang diperlukan
		// $data merupakan ketiga values yg terdefinisi tadi
		// user merupakan nama tabel pada database
		$this->m_data->update_data($where,$data,'user');
		
		//method untuk kembali pada crud/index 
		redirect('crud/index');
	}
}