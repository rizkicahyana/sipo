<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	/*menambah fungsi publik untuk me-load lihat_info.php*/
	public function lihat_info(){
		echo "<head><title>Pelatihan Code Igniter 2015</title></head>";
		echo "
			<h1>Pelatihan CI 2015</h1><br/>
			<h3>Pelatihan by Lab Basis Data Ilmu Komputer UPI</h3></br>
		";
		echo "CodeIgniter merupakan salah satu <i>web framework</i> PHP yang sangat mudah dan menarik.";
		echo "Saya menghadiri ini untuk mulai mengenal dan mempelajari CodeIgniter";
	}
	
	/*menambah fungsi publik untuk me-load biodata.php*/
	public function biodata(){
		$this->load->view('biodata');
	}
	
	/*deklarasi fungsi publik jumlah_angka secara tanpa pelemparan ke view*/
	public function jumlah_angka($angka1, $angka2){
		if(isset($angka1)||isset($angka2)){
			echo "Angka ke-1: $angka1<br/>";
			echo "Angka ke-2: $angka2<br/>";
			$hasil=$angka1+$angka2;
			echo "Hasil Penjumlahan dari $angka1 + $angka2 = $hasil<br/>";
		}
		else{
			echo "Anda tidak memasukkan argumen ke dalam function jumlah angka";
		}
	}
	
	//deklarasi fungsi publik jumlah_angka dengan pelemparan ke view menggunakan array; array data yang dilemparkan, mulai dari data['angka1'], data['angka2'], dan data['hasil']
	public function jumlah_angka2($angka1, $angka2){
		if(isset($angka1)&&isset($angka2)){
			$data['angka1']=$angka1;
			$data['angka2']=$angka2;
			$hasil=$angka1+$angka2;
			$data['hasil']=$hasil;
			$this->load->view('hasil_jumlah',$data);
		}
		else{
			echo "Anda tidak memasukkan argumen ke dalam function jumlah angka";
		}
	}
}

/*
http://localhost/pelatihanbasdat/index.php/welcome/lihat_info
controller utama: index.php
fungsi: lihat_info

*/

/*
http://localhost/pelatihanbasdat/index.php/welcome/jumlah_angka/100/56666
*/

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */