<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index($type = 'username', $username = '')
	{
		if ($this->session->userdata('user')) {
			if($this->session->userdata('sebagai') == 'pegawai') redirect('pegawai');
			if($this->session->userdata('sebagai') == 'pengangkut') redirect('pengangkut');
			if($this->session->userdata('sebagai') == 'tps') redirect('tps');
			if($this->session->userdata('sebagai') == 'importir') redirect('importir');
		}

		$data['type'] = $type;

		if ($username != '') {
			$data['user'] = $this->db->get_where('users', ['user' => $username])->row_array();
		}

		if ($type == 'username') $this->form_validation->set_rules('user', 'Username', 'required|trim', ['required' => 'Username belum diisi']);
		if ($type == 'password') {
			if ($username == '') redirect('auth');

			$data['username'] = $username;

			$this->form_validation->set_rules('pass', 'Kata Sandi', 'required|trim', ['required' => 'Kata Sandi belum diisi']);
		}
		if ($type == 'reset') {
			if ($username == '') {
				redirect('auth');
			} else {
				$data['user'] = $this->db->get_where('users', ['user' => $username])->row_array();

				if ($data['user']['pass'] !== null) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak diizinkan mengatur ulang kata sandi akun ini</div>');
					redirect('auth');
				}
			}

			$data['username'] = $username;

			$this->form_validation->set_rules('pass', 'Password', 'required|trim|min_length[3]', [
				'required' => 'Kata sandi belum diisi',
				'min_length' => 'Kata sandi terlalu pendek'
			]);
			$this->form_validation->set_rules('pass2', 'Password', 'trim|matches[pass]', [
				'matches' => 'Kata sandi tidak cocok'
			]);
		}
		
		if($this->form_validation->run() == false){
			$data['title'] = 'SIP Bang: Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			if ($type == 'username') $this->_login(); 
			if ($type == 'password') $this->_pass($username);
			if ($type == 'reset') $this->_reset($username);
		}
	}

	private function _login()
	{
		$user = $this->db->get_where('users', ['user' => $this->input->post('user')])->row_array();
		
		if($user) {
			if ($user['pass'] !== null) {
				redirect('auth/index/password/'.$this->input->post('user'));
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Silahkan masukkan password baru</div>');
				redirect('auth/index/reset/'.$this->input->post('user'));
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Tidak dapat menemukan akun Anda</div>');
			redirect('auth');
		}
	}

	private function _pass($username = '')
	{
		$user = $this->db->get_where('users', ['user' => $username])->row_array();

		if(password_verify($this->input->post('pass'), $user['pass'])){
		    $session = array(
		       'user'   => $user['user'],
		       'name'   => $user['name'],
		       'sebagai'  => $user['sebagai']
		    );
	        $this->session->set_userdata($session);

			if($user['sebagai'] == 'pegawai') redirect('pegawai');
			if($user['sebagai'] == 'pengangkut') redirect('pengangkut');
			if($user['sebagai'] == 'tps') redirect('tps');
			if($user['sebagai'] == 'importir') redirect('importir');
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah</div>');
			redirect('auth/index/password/'.$username);
		}
	}

	private function _reset($username = '')
	{
		$user = $this->db->get_where('users', ['user' => $username])->row_array();

		$this->db->set('pass', password_hash($this->input->post('pass'), PASSWORD_DEFAULT));
		$this->db->where('user', $user['user']);
		$this->db->update('users');

		$session = array(
	       'user'   => $user['user'],
	       'name'   => $user['name'],
	       'sebagai'  => $user['sebagai']
	    );
        $this->session->set_userdata($session);

		if($user['sebagai'] == 'pegawai') redirect('pegawai');
		if($user['sebagai'] == 'pengangkut') redirect('pengangkut');
		if($user['sebagai'] == 'tps') redirect('tps');
		if($user['sebagai'] == 'importir') redirect('importir');
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('sebagai');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Sesi berakhir</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
