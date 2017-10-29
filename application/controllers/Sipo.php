<?php 
	  
	if(!defined('BASEPATH')) exit('No direct script access allowed!');

	class Sipo extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->helper(array('url', 'form', 'date', 'captcha', 'exportpdf_helper'));
			$this->load->library(array('input', 'form_validation', 'session'));
			$this->load->model('m_sipo');
			$this->form_validation->set_message('required', 'Mohon maaf, silakan isi kolom %s untuk melengkapi data pendaftaran Anda!');
			$this->form_validation->set_message('is_unique', 'Mohon maaf, data %s sudah terdaftar pada sistem kami. Silakan gunakan %s yang lain!');
			$this->form_validation->set_message('min_length', 'Mohon maaf, data %s sekurang-kurangnya terdiri atas %d karakter!');
			$this->form_validation->set_message('max_length', 'Mohon maaf, data %s sebanyak-banyaknya terdiri atas %d karakter!');
			$this->form_validation->set_message('exact_length', 'Mohon maaf, data %s harus berjumlah %d karakter');
			$this->form_validation->set_message('matches', 'Mohon maaf, data %s harus sama dengan %s!');
			$this->form_validation->set_message('valid_email', 'Mohon maaf, data %s harus sesuai dengan format yang telah ditentukan!');
			$this->form_validation->set_message('numeric', 'Mohon maaf, data %s harus terdiri atas angka!');
			$this->form_validation->set_message('alpha', 'Mohon maaf, data %s harus terdiri atas alfabet!');
			$this->form_validation->set_message('valid_email', 'Mohon maaf, data %s harus sesuai dengan format yang telah ditentukan!');
		}

		public function index(){
			$this->load->helper('captcha');
			$config_captcha = array(
					'img_path' => './captcha/',
					'img_url' => base_url().'captcha/',
					'img_width' => 200,
					'img_height' => 30,
					'border' => 0,
					'expiration' => 7200
				);
			$captcha = create_captcha($config_captcha);
			$data['image'] = $captcha['image'];
			$this->session->set_userdata('mycaptcha', $captcha['word']);
			$this->load->view('v_beranda', $data);
		}

		public function form_daftar(){
			$this->load->view('v_daftar');
		}

		public function proses_daftar(){
			$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[akun.email]');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[30]|is_unique[akun.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|alpha_numeric|required|min_length[8]|md5');
			$this->form_validation->set_rules('ulang_password', 'Ulang Password', 'trim|xss_clean|alpha_numeric|required|min_length[8]|matches[password]|md5');
			$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]');
			//$this->form_validation->set_rules('foto', 'Foto', 'required');
			if($this->form_validation->run()==false){
				$this->load->view('v_daftar');
			}
			else{
				
				$config['upload_path'] = './assets/foto/';
				$config['allowed_types'] = 'jpg|gif|png';
				$config['max_size'] = '100000';
				$config['overwrite'] = TRUE;
				$config['encrypt_name'] = TRUE;
				$config['file_name'] = time();
				
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('foto')){
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
					redirect('sipo/form_daftar', 'refresh');
				}
				else{
					$this->load->library('session');
					$email = $this->input->post('email');
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$ulang_password = $this->input->post('ulang_password');
					$nama = $this->input->post('nama');
					$foto = $this->input->post('foto');
					//$nomor_level = 4;
					$hitung_akun_siswa = count($this->m_sipo->select_siswa_by_email($email)->row());
					$hitung_akun_guru = count($this->m_sipo->select_guru_by_email($email)->row());
					$hitung_akun_semua = $hitung_akun_siswa + $hitung_akun_guru;

					if($hitung_akun_semua != 0){
						if($hitung_akun_guru==1){
							$nomor_level = 2;
						}
						else if($hitung_akun_siswa==1){
							$nomor_level = 3;
						}
						$status_akun = "Pending";
						$upload_data = $this->upload->data();
						$data_tambah['email'] = $email;
						$data_tambah['username'] = $username;
						$data_tambah['password'] = $password;
						$data_tambah_temp['ulang_password'] = $ulang_password;
						$data_tambah['nama'] = $nama;
						$data_tambah['foto'] = $upload_data['file_name'];
						$data_tambah['nomor_level'] = $nomor_level;
						$data_tambah['status_akun'] = $status_akun;
						
						$this->m_sipo->insert_akun($data_tambah);
						$this->session->set_flashdata('pesan', '<font color=green>Selamat! Akun Anda telah diusulkan.<br/>Silakan menunggu maksimal 1 x 24 jam setelah permohonan pendaftaran akun.</font>');
						//$this->load->view('v_daftar');
						redirect('sipo/form_daftar', 'refresh');
					}
					else if($hitung_akun_semua==0 && $email=='admin@sipo.com'){
						$nomor_level = 1;
						$status_akun = "Aktif";
						$upload_data = $this->upload->data();
						$data_tambah['email'] = $email;
						$data_tambah['username'] = $username;
						$data_tambah['password'] = $password;
						$data_tambah_temp['ulang_password'] = $ulang_password;
						$data_tambah['nama'] = $nama;
						$data_tambah['foto'] = $upload_data['file_name'];
						$data_tambah['nomor_level'] = $nomor_level;
						$data_tambah['status_akun'] = $status_akun;
						$this->m_sipo->insert_akun($data_tambah);
						$this->session->set_flashdata('pesan', '<font color=green>Selamat! Akun Administrator telah berhasil diaktifkan.</font>');
						//$this->load->view('v_daftar');
						redirect('sipo/form_daftar', 'refresh');
					}
					else{
						$this->session->set_flashdata('pesan', '<font color=red>Mohon maaf, e-mail Anda tidak terdaftar pada database Kami!<br/>Anda tidak dapat bergabung dengan SIPO.</font>');
						//$this->load->view('v_daftar');
						redirect('sipo/form_daftar', 'refresh');
					}
					
				}
				
			}	
		}

		public function form_masuk(){
			$this->load->helper('captcha');
			$config_captcha = array(
					'img_path' => './captcha/',
					'img_url' => base_url().'captcha/',
					'img_width' => 200,
					'img_height' => 30,
					'border' => 0,
					'expiration' => 7200
				);
			$captcha = create_captcha($config_captcha);
			$data['image'] = $captcha['image'];
			$this->session->set_userdata('mycaptcha', $captcha['word']);
			$this->load->view('v_masuk', $data);
		}

		public function proses_login(){
			if(($this->input->post('submit')) && ($this->input->post('security_code')==$this->session->userdata('mycaptcha'))){
				$this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required');
				$this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required');
				if($this->form_validation->run()==FALSE){
					$this->session->set_flashdata('pesan', 'another respon..!<br/><br/>');
					redirect('sipo/index');
				}
				else{ 
					$username = $this->input->post('username');
					$pass = $this->input->post('password');
					$password = md5($pass);
					$hitung_akun = $this->m_sipo->hitung_akun_by_param($username, $password);	
					echo "Sedang diverifikasi, silakan menunggu beberapa saat..";
					if($hitung_akun == 1){

						$dummy['data'] = $this->m_sipo->cek_akun($username, $password)->row();

						foreach($dummy as $data_akun){		
							$status_akun = $data_akun->status_akun;
							$nomor_level = $data_akun->nomor_level;
						}
						if($status_akun=='Aktif'){
							$this->session->set_flashdata('pesan', 'Selamat! Anda berhasil masuk ke Sistem Pembelajaran Online (SIPO).<br/><br/>');
							$data_session = array(
								'id_akun' => $data_akun->id_akun,
								'username' => $data_akun->username,
								'foto' => $data_akun->foto,
								'email' => $data_akun->email,
								'nomor_level' => $data_akun->nomor_level,
								'status_akun' => $data_akun->status_akun,
								'logged_in' => true
							);
							$this->session->set_userdata($data_session);
							if($nomor_level==1){
								redirect('sipo/dashboard_admin/beranda','refresh');
							}
							else if($nomor_level==2){
								redirect('sipo/dashboard_guru/beranda','refresh');
							}
							else if($nomor_level==3){
								redirect('sipo/dashboard_siswa/beranda','refresh');
							}
						}
						else{
							$this->session->set_flashdata('pesan', 'Akun Anda belum diaktifkan oleh Administrator!<br/>');
							redirect('sipo/index');
						}			
					}
					else{
						echo "Sedang diverifikasi, silakan menunggu beberapa saat..";
						$this->session->set_flashdata('pesan', 'Username dan atau Password Anda tidak cocok!<br/><br/>');
						redirect('sipo/index');
						//$this->load->view('v_masuk', $data);
						//redirect('sipo/form_masuk');
					}
				}
			}
			else{
				$this->session->set_flashdata('pesan', 'Captcha yang Anda masukkan salah! Silakan coba kembali!');
				redirect('sipo/index');
				//$this->load->view('v_masuk', $data);
			}
		}

		public function dashboard_admin($mode){
			$logged_in = $this->session->userdata('logged_in');
			$nomor_level = $this->session->userdata('nomor_level');
			if($logged_in==true && $nomor_level==1){
				if($mode=="beranda"){
					$this->load->view('admin/v_dashboard');
				}
				else if($mode=="lihat_akun"){
					$data['akun'] = $this->m_sipo->select_all_akun()->result();
					$this->load->view('admin/v_data_akun', $data);
				}
				else if($mode=="konfirmasi_akun"){
					$id_akun = $this->uri->segment(4);
					echo $id_akun;
					$data = array(
							'status_akun' => 'Aktif'
						);
					$this->m_sipo->update_akun($id_akun, $data);
					redirect('sipo/dashboard_admin/beranda/', 'refresh');
				}
				else if($mode=="tambah_guru"){
					$this->load->view('admin/v_tambah_guru');
				}
				else if($mode=="proses_tambah_guru"){
					$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[guru.email]');
					$this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[18]|is_unique[guru.nip]|numeric');
					if($this->form_validation->run()==false){
						$this->load->view('admin/v_tambah_guru');
					}
					else{
						$data = array(
								'nip' => $this->input->post('nip'),
								'email' => $this->input->post('email')
							);
						$this->session->set_flashdata('pesan', 'Selamat! Data guru telah berhasil ditambahkan!');
						$this->m_sipo->insert_guru($data);
						redirect('sipo/dashboard_admin/tambah_guru', 'refresh');
					}
				}
				else if($mode=="lihat_guru"){
					$data['guru'] = $this->m_sipo->select_all_guru()->result();
					$this->load->view('admin/v_data_guru', $data);
				}
				else if($mode=="ubah_guru"){
					$nip = $this->uri->segment(4);
					$data['guru'] = $this->m_sipo->select_guru_by_id($nip)->row();
					$this->load->view('admin/v_ubah_guru', $data);
				}
				else if($mode=="proses_ubah_guru"){
					$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]|max_length[30]|alpha');
					$this->form_validation->set_rules('tempat', 'Tempat', 'required|min_length[5]|max_length[30]|alpha');
					$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|numeric|min_length[10]|max_length[12]|is_unique[guru.nomor_telepon]');
					if($this->form_validation_run()==false){
						redirect('sipo/dashboard_admin/ubah_guru', 'refresh');
					}
					else{
						$nip = $this->input->post('nip');
						$data = array(
							'nama' => $this->input->post('nama'),
							'gelar' => $this->input->post('gelar'),
							'tempat' => $this->input->post('tempat'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'alamat' => $this->input->post('alamat'),
							'nomor_telepon' => $this->input->post('nomor_telepon')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data guru telah berhasil diperbaharui!');
						$this->m_sipo->update_guru($nip, $data);
						redirect('sipo/dashboard_admin/lihat_guru', 'refresh');
					}
				}

				else if($mode=="tambah_siswa"){
					$this->load->view('admin/v_tambah_siswa');
				}
				else if($mode=="proses_tambah_siswa"){
					$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[siswa.email]');
					$this->form_validation->set_rules('nis', 'NIS', 'required|exact_length[7]|is_unique[siswa.nis]|numeric');
					if($this->form_validation->run()==false){
						$this->load->view('admin/v_tambah_siswa');
					}
					else{
						$data = array(
								'nis' => $this->input->post('nis'),
								'email' => $this->input->post('email')
							);
						$this->session->set_flashdata('pesan', 'Selamat! Data siswa telah berhasil ditambahkan!');
						$this->m_sipo->insert_siswa($data);
						redirect('sipo/dashboard_admin/tambah_siswa', 'refresh');
					}
				}
				else if($mode=="lihat_siswa"){
					$data['siswa'] = $this->m_sipo->select_all_siswa()->result();
					$this->load->view('admin/v_data_siswa', $data);
				}
				else if($mode=="ubah_siswa"){
					$nis = $this->uri->segment(4);
					$data['siswa'] = $this->m_sipo->select_siswa_by_id($nis)->row();
					$this->load->view('admin/v_ubah_siswa', $data);
				}
				else if($mode=="proses_ubah_siswa"){
					$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]|max_length[30]|alpha');
					$this->form_validation->set_rules('tempat', 'Tempat', 'required|min_length[5]|max_length[30]|alpha');
					$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|numeric|min_length[10]|max_length[12]|is_unique[siswa.nomor_telepon]');
					if($this->form_validation_run()==false){
						redirect('sipo/dashboard_admin/ubah_guru', 'refresh');
					}
					else{
						$nis = $this->input->post('nis');
						$data = array(
							'nama' => $this->input->post('nama'),
							'tempat' => $this->input->post('tempat'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'alamat' => $this->input->post('alamat'),
							'nomor_telepon' => $this->input->post('nomor_telepon')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data siswa telah berhasil diperbaharui!');
						$this->m_sipo->update_siswa($nis, $data);
						redirect('sipo/dashboard_admin/lihat_siswa', 'refresh');
					}
				}
			
				else if($mode=="tambah_semester"){
					$this->load->view('admin/v_tambah_semester');
				}
				else if($mode=="proses_tambah_semester"){
					$this->form_validation->set_rules('nama', 'Nama Semester', 'required|exact_length[1]|numeric|is_unique[semester.nama]');
					$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[5]|max_length[6]');
					if($this->form_validation->run()==false){
						$this->load->view('admin/v_tambah_semester');
					}
					else{
						$data = array(
							'id_semester' => null,
							'nama' => $this->input->post('nama'),
							'keterangan' => $this->input->post('keterangan')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data semester telah berhasil ditambahkan!');
						$this->m_sipo->insert_semester($data);
						redirect('sipo/dashboard_admin/tambah_semester', 'refresh');
					}
				}
				else if($mode=="lihat_semester"){
					$data['semester'] = $this->m_sipo->select_all_semester()->result();
					$this->load->view('admin/v_data_semester', $data);
				}

				else if($mode=="tambah_jurusan"){
					$this->load->view('admin/v_tambah_jurusan');
				}
				else if($mode=="proses_tambah_jurusan"){
					$this->form_validation->set_rules('nama', 'Nama Jurusan', 'required|exact_length[3]|alpha|is_unique[jurusan.nama]');
					if($this->form_validation->run()==false){
						$this->load->view('admin/v_tambah_jurusan');
					}
					else{
						$data = array(
							'id_jurusan' => null,
							'nama' => $this->input->post('nama')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data jurusan telah berhasil ditambahkan!');
						$this->m_sipo->insert_jurusan($data);
						redirect('sipo/dashboard_admin/tambah_jurusan', 'refresh');
					}
				}
				else if($mode=="lihat_jurusan"){
					$data['jurusan'] = $this->m_sipo->select_all_jurusan()->result();
					$this->load->view('admin/v_data_jurusan', $data);
				}


				else if($mode=="tambah_kelas"){
					$data['jurusan'] = $this->m_sipo->select_all_jurusan()->result();
					$this->load->view('admin/v_tambah_kelas', $data);
				}
				else if($mode=="proses_tambah_kelas"){
					$this->form_validation->set_rules('nama', 'Nama', 'required');
					if($this->form_validation->run()==false){
						$this->load->view('v_tambah_kelas');
					}
					else{
						$data = array(
							'id_kelas' => null,
							'id_jurusan' => $this->input->post('jurusan'),
							'nama' => $this->input->post('nama')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data kelas telah berhasil ditambahkan!');
						$this->m_sipo->insert_kelas($data);
						redirect('sipo/dashboard_admin/tambah_kelas', 'refresh');
					}
				}
				else if($mode=="lihat_kelas"){
					$data['kelas'] = $this->m_sipo->select_all_kelas()->result();
					$this->load->view('admin/v_data_kelas', $data);
				}

				else if($mode=="tambah_mapel"){
					$this->load->view('admin/v_tambah_mapel');
				}
				else if($mode=="proses_tambah_mapel"){
					$this->form_validation->set_rules('nama', 'Nama Mata Pelajaran', 'required|is_unique[mapel.nama]');
					if($this->form_validation->run()==false){
						$this->load->view('admin/v_tambah_mapel');
					}
					else{
						$data = array(
							'id_mapel' => null,
							'nama' => $this->input->post('nama')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data mata pelajaran telah berhasil ditambahkan!');
						$this->m_sipo->insert_mapel($data);
						redirect('sipo/dashboard_admin/tambah_mapel', 'refresh');
					}
				}
				else if($mode=="lihat_mapel"){
					$data['mapel'] = $this->m_sipo->select_all_mapel()->result();
					$this->load->view('admin/v_data_mapel', $data);
				}
				else if($mode=="tambah_spesialisasi"){
					$data['guru'] = $this->m_sipo->select_all_guru()->result();
					$data['mapel'] = $this->m_sipo->select_all_mapel()->result();
					$this->load->view('admin/v_tambah_spesialisasi', $data);
				}
				else if($mode=="proses_tambah_spesialisasi"){
					$data = array(
						'id_spesialisasi' => null,
						'nip' => $this->input->post('nip'),
						'id_mapel' => $this->input->post('id_mapel')
					);
					$this->session->set_flashdata('pesan', 'Selamat! Data spesialisasi telah berhasil ditambahkan!');
					$this->m_sipo->insert_spesialisasi($data);
					redirect('sipo/dashboard_admin/tambah_spesialisasi', 'refresh');
				}
				else if($mode=="lihat_spesialisasi"){
					$data['spesialisasi'] = $this->m_sipo->select_all_guru_mapel_spes_join()->result();
					$this->load->view('admin/v_data_spesialisasi', $data);
				}
				else if($mode=="tambah_spesialisasi_siswa"){
					$data['siswa'] = $this->m_sipo->select_all_siswa()->result();
					$data['kelas'] = $this->m_sipo->select_all_kelas()->result();
					$data['semester'] = $this->m_sipo->select_all_semester()->result();
					$this->load->view('admin/v_tambah_spesialisasi_siswa', $data);
				}
				else if($mode=="proses_tambah_spesialisasi_siswa"){
					$data = array(
						'id_spesialisasi_siswa' => null,
						'nis' => $this->input->post('nis'),
						'id_kelas' => $this->input->post('id_kelas'),
						'id_semester' => $this->input->post('id_semester')
					);
					$this->session->set_flashdata('pesan', 'Selamat! Data spesialisasi telah berhasil ditambahkan!');
					$this->m_sipo->insert_spesialisasi_siswa($data);
					redirect('sipo/dashboard_admin/tambah_spesialisasi_siswa', 'refresh');
				}
				else if($mode=="lihat_spesialisasi_siswa"){
					$data['spesialisasi_siswa'] = $this->m_sipo->select_all_siswa_spes_join()->result();
					$this->load->view('admin/v_data_spesialisasi_siswa', $data);
				}
				else if($mode=="keluar"){
					$this->session->sess_destroy();
					redirect('sipo/index');
				}
				
				
			}
			else{
				echo "Anda tidak berhak mengakses halaman ini..<br/><br/>";
				redirect('sipo/index','refresh');
			}
		}

		public function dashboard_guru($mode){
			$logged_in = $this->session->userdata('logged_in');
			$nomor_level = $this->session->userdata('nomor_level');
			//$id_akun = $this->session->userdata('id_akun');
			

			//	$email = $ddata->email;
			//}
			
			if($logged_in==true && $nomor_level==2){
				$id_akun = $this->session->userdata('id_akun');
				$email = $this->session->userdata('email');
				$data['guru'] = $this->m_sipo->select_all_load_guru_by_id($email)->result();
				//print_r($data);
				if($mode=="beranda"){
					//$data['guru'] = $this->m_sipo->select_guru_by_email($email)->result();
					$this->load->view('guru/v_dashboard', $data);
				}
				else if($mode=="lihat_guru"){
					//$data['guru'] = $this->m_sipo->select_guru_by_email($email)->result();
					$this->load->view('guru/v_data_akun', $data);
				}
				else if($mode=="ubah_guru"){
					$nip = $this->uri->segment(4);
					//$data['guru'] = $this->m_sipo->select_guru_by_id($nip)->result();
					$this->load->view('guru/v_ubah_guru', $data);
				}
				else if($mode=="proses_ubah_guru"){
					$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]|max_length[30]');
					$this->form_validation->set_rules('tempat', 'Tempat', 'Erequired|min_length[5]|max_length[30]');
					$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|numeric|min_length[10]|max_length[12]|is_unique[guru.nomor_telepon]');
					$nip = $this->input->post('nip');
					if($this->form_validation->run()==false){
						redirect('sipo/dashboard_guru/ubah_guru/'.$nip, 'refresh');
					}
					else{
						$data = array(
							'nama' => $this->input->post('nama'),
							'gelar' => $this->input->post('gelar'),
							'tempat' => $this->input->post('tempat'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'alamat' => $this->input->post('alamat'),
							'nomor_telepon' => $this->input->post('nomor_telepon')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data guru telah berhasil diperbaharui!');
						$this->m_sipo->update_guru($nip, $data);
						redirect('sipo/dashboard_guru/lihat_guru', 'refresh');
					}
				}
				else if($mode=="tambah_bahan_ajar"){
					$nip = $this->uri->segment(4);
					$data['spesialisasi'] = $this->m_sipo->select_spesialisasi_by_id($nip)->result();
					$data['kelas'] = $this->m_sipo->select_all_kelas()->result();
					$data['semester'] = $this->m_sipo->select_all_semester()->result();
					$this->load->view('guru/v_tambah_bahan_ajar', $data);
				}
				else if($mode=="proses_tambah_bahan_ajar"){
					$config['upload_path'] = './assets/bahan_ajar/';
					$config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx|txt|mp4|avi|mkv|jpg|gif|png|rar|zip';
					$config['max_size'] = '10000000';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = TRUE;
					$config['file_name'] = $this->input->post('bahan_ajar');
					
					$this->load->library('upload', $config);

					if(!$this->upload->do_upload('bahan_ajar')){
						$this->session->set_flashdata('pesan', $this->upload->display_errors());
						redirect('sipo/dashboard_guru/tambah_bahan_ajar', 'refresh');
					}
					else{
						$upload_data = $this->upload->data();
						$data = array(
							'id_bahan_ajar' => null,
							'id_spesialisasi' => $this->input->post('id_spesialisasi'),
							'id_kelas' => $this->input->post('id_kelas'),
							'id_semester' => $this->input->post('id_semester'),
							'nama' => $this->input->post('nama'),
							'bahan_ajar' => $upload_data['file_name']
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data bahan ajar Anda telah berhasil ditambahkan!');
						$this->m_sipo->insert_bahan_ajar($data);
						redirect('sipo/dashboard_guru/beranda','refresh');
					}
				}
				else if($mode=="pre_lihat_bahan_ajar"){
					$nip = $this->uri->segment(4);
					$data['spesialisasi'] = $this->m_sipo->select_spesialisasi_by_id($nip)->result();
					$this->load->view('guru/v_pre_lihat_bahan_ajar', $data);
				}
				else if($mode=="lihat_bahan_ajar"){

					$id_spesialisasi = $this->uri->segment(4);
					$data['bahan_ajar'] = $this->m_sipo->select_bahan_ajar_group_by_id($id_spesialisasi)->result();
					$this->load->view('guru/v_data_bahan_ajar', $data);
				}
				else if($mode=="ubah_bahan_ajar"){
					$id_bahan_ajar = $this->uri->segment(4);
					$data['bahan_ajar'] = $this->m_sipo->select_bahan_ajar_by_id_bahan_ajar($id_bahan_ajar)->result();
					$this->load->view('guru/v_ubah_bahan_ajar', $data);
				}
				else if($mode=="proses_ubah_bahan_ajar"){
					$config['upload_path'] = './assets/bahan_ajar/';
					$config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx|txt|mp4|avi|mkv|jpg|gif|png|rar|zip';
					$config['max_size'] = '10000000';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = TRUE;
					$config['file_name'] = $this->input->post('bahan_ajar');
					
					$this->load->library('upload', $config);

					if(!$this->upload->do_upload('bahan_ajar')){
						$this->session->set_flashdata('pesan', $this->upload->display_errors());
						redirect('sipo/dashboard_guru/beranda', 'refresh');
					}
					else{
						$id_bahan_ajar = $this->input->post('id_bahan_ajar');
						$upload_data = $this->upload->data();
						$data = array(
							'nama' => $this->input->post('nama'),
							'bahan_ajar' => $upload_data['file_name']
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data bahan ajar Anda telah berhasil diperbaharui!');
						$this->m_sipo->update_bahan_ajar($id_bahan_ajar, $data);
						redirect('sipo/dashboard_guru/beranda','refresh');
					}

				}
				else if($mode=="hapus_bahan_ajar"){
					$id_bahan_ajar = $this->uri->segment(4);
					$this->m_sipo->delete_bahan_ajar($id_bahan_ajar);

					redirect('sipo/dashboard_guru/beranda');
				}
				
				else if($mode=="keluar"){
					$this->session->sess_destroy();
					redirect('sipo/index');
				}
			}
			else{
				echo "Anda tidak berhak mengakses halaman ini..<br/><br/>";
				redirect('sipo/index','refresh');
			}
		}

		public function dashboard_siswa($mode){
			
			$logged_in = $this->session->userdata('logged_in');
			$nomor_level = $this->session->userdata('nomor_level');
			
			if($logged_in==true && $nomor_level==3){
				$id_akun = $this->session->userdata('id_akun');
				$email = $this->session->userdata('email');
				$data['siswa'] = $this->m_sipo->select_all_load_siswa_by_id($email)->result();
				if($mode=="beranda"){
					$this->load->view('siswa/v_dashboard', $data);
				}
				else if($mode=="lihat_siswa"){
					//$data['siswa'] = $this->m_sipo->select_all_siswa()->result();
					$this->load->view('siswa/v_data_akun', $data);
				}
				else if($mode=="ubah_siswa"){
					$nis = $this->uri->segment(4);
					//$data['siswa'] = $this->m_sipo->select_siswa_by_id($nis)->result();
					$this->load->view('siswa/v_ubah_siswa', $data);
				}
				else if($mode=="proses_ubah_siswa"){
					$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]|max_length[30]');
					$this->form_validation->set_rules('tempat', 'Tempat', 'required|min_length[5]|max_length[30]');
					$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|numeric|min_length[10]|max_length[12]|is_unique[siswa.nomor_telepon]');
					$nis = $this->input->post('nis');
					if($this->form_validation->run()==false){
						redirect('sipo/dashboard_siswa/ubah_siswa/'.$nis, 'refresh');
					}
					else{
						$data = array(
							'nama' => $this->input->post('nama'),
							'tempat' => $this->input->post('tempat'),
							'tanggal_lahir' => $this->input->post('tanggal_lahir'),
							'alamat' => $this->input->post('alamat'),
							'nomor_telepon' => $this->input->post('nomor_telepon')
						);
						$this->session->set_flashdata('pesan', 'Selamat! Data siswa telah berhasil diperbaharui!');
						$this->m_sipo->update_siswa($nis, $data);
						redirect('sipo/dashboard_siswa/lihat_siswa', 'refresh');
					}
				}
				else if($mode=="pre_lihat_bahan_ajar"){
					$nis = $this->uri->segment(4);
					$data['spesialisasi_siswa'] = $this->m_sipo->select_spesialisasi_siswa_by_id($nis)->result();
					$this->load->view('siswa/v_pre_lihat_bahan_ajar', $data);
				}
				else if($mode=="lihat_bahan_ajar"){

					$id_spesialisasi_siswa = $this->uri->segment(4);
					$data['bahan_ajar'] = $this->m_sipo->select_bahan_ajar_group_by_id_spes_sis($id_spesialisasi_siswa)->result();
					$this->load->view('siswa/v_data_bahan_ajar', $data);
				}

				else if($mode=="keluar"){
					$this->session->sess_destroy();
					redirect('sipo/index');
				}
			}
			else{
				echo "Anda tidak berhak mengakses halaman ini..<br/><br/>";
				redirect('sipo/index','refresh');
			}
		}


		public function data_akun_admin(){
			$logged_in = $this->session->userdata('logged_in');
			$nomor_level = $this->session->userdata('nomor_level');
			if($logged_in==true && $nomor_level==1){
				$data['akun'] = $this->m_sipo->select_all_akun()->result();
				$this->load->view('v_data_akun', $data);
			}
			else{
				echo "Anda tidak berhak mengakses halaman ini..<br/><br/>";
				redirect('sipo/index','refresh');
			}
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('sipo/index');
		}

	}

?>