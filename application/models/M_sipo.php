<?php 
	  
	if(!defined('BASEPATH')) exit('No direct script access allowed!');

	class M_sipo extends CI_Model{

		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function select_all_siswa(){
			$this->db->select('*');
			$this->db->from('siswa');
			return $this->db->get();
		}

		public function select_all_guru(){
			$this->db->select('*');
			$this->db->from('guru');
			return $this->db->get();
		}

		public function select_all_jurusan(){
			$this->db->select('*');
			$this->db->from('jurusan');
			return $this->db->get();
		}

		public function select_all_semester(){
			$this->db->select('*');
			$this->db->from('semester');
			return $this->db->get();
		}

		public function select_all_kelas(){
			$this->db->select('*');
			$this->db->from('kelas');
			return $this->db->get();	
		}

		public function select_all_mapel(){
			$this->db->select('*');
			$this->db->from('mapel');
			return $this->db->get();
		}

		public function select_guru_by_id($nip){
			$this->db->select('*');
			$this->db->from('guru');
			$this->db->where('nip', $nip);
			return $this->db->get();
		}

		public function select_spesialisasi_siswa_by_id($nis){
			$this->db->select('spesialisasi_siswa.id_spesialisasi_siswa as id_spesialisasi_siswa, guru.nip as nip, guru.nama as nama_guru, guru.gelar as gelar, mapel.id_mapel as id_mapel, mapel.nama as nama_mapel');
			$this->db->from('spesialisasi_siswa');
			$this->db->join('guru', 'spesialisasi_siswa.nis = guru.nis');
			$this->db->join('mapel', 'spesialisasi_siswa.id_mapel = mapel.id_mapel');
			$this->db->where(array('guru.nip' => $nip));
			return $this->db->get();
		}

		public function select_all(){
			$this->db->select('*');
			$this->db->from('buku');
			$this->db->join('kategori', 'kategori.id_kategori=buku.id_kategori');
			$this->db->join('penerbit', 'penerbit.id_penerbit=buku.id_penerbit');
			$this->db->join('penulis', 'penulis.id_penulis=buku.id_penulis');			
			return $this->db->get();
		}

		public function select_guru_exists(){
			$this->db->select('*');
			$this->db->from('guru');
			$this->db->join('akun', 'akun.nip = guru.nip');
			return $this->db->get();
		}

		public function select_all_guru_mapel_spes_join(){
			$this->db->select('guru.nama as nama1, guru.gelar as gelar, mapel.nama as nama2');
			$this->db->from('spesialisasi');
			$this->db->join('guru', 'spesialisasi.nip = guru.nip');
			$this->db->join('mapel', 'spesialisasi.id_mapel = mapel.id_mapel');
			return $this->db->get();
		}

		public function select_all_siswa_spes_join(){
			$this->db->select('*, kelas.nama as nama_kelas, semester.keterangan as semester, siswa.nama as nama_siswa, kelas.nama as nama_kelas');
			$this->db->from('spesialisasi_siswa');
			$this->db->join('kelas', 'kelas.id_kelas = spesialisasi_siswa.id_kelas');
			$this->db->join('siswa', 'spesialisasi_siswa.nis = siswa.nis');
			$this->db->join('semester', 'semester.id_semester = spesialisasi_siswa.id_semester');
			return $this->db->get();
		}

		public function select_siswa_by_id($nis){
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('nis', $nis);
			return $this->db->get();
		}

		public function update_guru($nip, $data){
			$this->db->where('nip', $nip);
			$this->db->update('guru', $data);
		}

		public function update_siswa($nis, $data){
			$this->db->where('nis', $nis);
			$this->db->update('siswa', $data);
		}

		public function select_siswa_by_email($email){
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('email', $email);
			return $this->db->get();
		}

		public function select_all_load_guru_by_id($email){
			$this->db->select('*, guru.nip as nip, spesialisasi.id_spesialisasi as spes');
			$this->db->from('guru');
			$this->db->join('akun', 'akun.email = guru.email');
			$this->db->join('spesialisasi', 'guru.nip = spesialisasi.nip');
			$this->db->where(array('akun.email' => $email));
			return $this->db->get();
		}

		public function select_all_load_siswa_by_id($email){
			$this->db->select('*, siswa.nis as nis');
			$this->db->from('siswa');
			$this->db->join('akun', 'akun.email = siswa.email');
			//$this->db->join('spesialisasi_siswa', 'siswa.nis = spesialisasi_siswa.nis');
			$this->db->where(array('akun.email' => $email));
			return $this->db->get();
		}

		public function select_guru_by_email($email){
			$this->db->select('*');
			$this->db->from('guru');
			$this->db->where('email', $email);
			return $this->db->get();
		}

		public function select_all_akun(){
			$this->db->select('*');
			$this->db->from('akun');
			return $this->db->get();
		}

		public function select_akun_by_id($id_akun){
			$this->db->select('*');
			$this->db->from('akun');
			$this->db->where('id_akun', $id_akun);
			return $this->db->get();
		}

		public function insert_guru($data){
			$this->db->insert('guru', $data);
		}

		public function insert_siswa($data){
			$this->db->insert('siswa', $data);
		}

		public function insert_akun($data_tambah){
			$this->db->insert('akun', $data_tambah);
		}

		public function update_akun($id_akun, $data){
			$this->db->where('id_akun', $id_akun);
			$this->db->update('akun', $data);
		}

		public function delete_akun($id_akun){
			$this->db->where('id_akun', $id_akun);
			$this->db->delete('akun');
		}

		public function cek_akun($username, $password){
			$this->db->select('*');
			$this->db->from('akun');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			return $this->db->get();
		}

		public function cek_akun2($data){
			$query = $this->db->get_where('akun', $data);
			return $query;
		}

		public function hitung_akun_by_param($username, $password){
			$this->db->select('*');
			$this->db->from('akun');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			return $this->db->count_all_results();
		}

		public function insert_spesialisasi($data){
			$this->db->insert('spesialisasi', $data);
		}

		public function insert_spesialisasi_siswa($data){
			$this->db->insert('spesialisasi_siswa', $data);
		}

		public function select_spesialisasi_by_id($nip){
			$this->db->select('spesialisasi.id_spesialisasi as id_spesialisasi, guru.nip as nip, guru.nama as nama_guru, guru.gelar as gelar, mapel.id_mapel as id_mapel, mapel.nama as nama_mapel');
			$this->db->from('spesialisasi');
			$this->db->join('guru', 'spesialisasi.nip = guru.nip');
			$this->db->join('mapel', 'spesialisasi.id_mapel = mapel.id_mapel');
			$this->db->where(array('guru.nip' => $nip));
			return $this->db->get();
		}

		public function insert_bahan_ajar($data){
			$this->db->insert('bahan_ajar', $data);
		}

		public function select_bahan_ajar_group_by_id($id_spesialisasi){
			$this->db->select('*');
			$this->db->from('bahan_ajar');
			$this->db->where('id_spesialisasi', $id_spesialisasi);
			return $this->db->get();
		}

		public function select_bahan_ajar_group_by_id_spes_sis($id_spesialisasi_siswa){
			$this->db->select('*');
			$this->db->from('bahan_ajar');
			$this->db->where('id_spesialisasi_siswa', $id_spesialisasi_siswa);
			return $this->db->get();
		}		

		public function select_bahan_ajar_by_id_bahan_ajar($id_bahan_ajar){
			$this->db->select('*');
			$this->db->from('bahan_ajar');
			$this->db->where('id_bahan_ajar', $id_bahan_ajar);
			return $this->db->get();
		}

		public function select_all_bahan_ajar(){
			$this->db->select('*');
			$this->db->from('bahan_ajar');
			return $this->db->get();
		}

		public function update_bahan_ajar($id_bahan_ajar, $data){
			$this->db->where('id_bahan_ajar', $id_bahan_ajar);
			$this->db->update('bahan_ajar', $data);
		}

		public function delete_bahan_ajar($id_bahan_ajar){
			$this->db->where('id_bahan_ajar', $id_bahan_ajar);
			$this->db->delete('bahan_ajar');
		}


	}

?>