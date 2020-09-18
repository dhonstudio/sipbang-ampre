<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model', 'auth');
	}

	public function index($type = 'username', $username = '')
	{
		$user = $this->auth->getUser($username);

		if ($this->session->userdata('user')) {
			$sebagai = $this->session->userdata('sebagai');

			if($sebagai == 'pegawai') redirect('pegawai');
			if($sebagai == 'pengangkut') redirect('pengangkut');
			if($sebagai == 'tps') redirect('tps');
			if($sebagai == 'importir') redirect('importir');
		}

		if ($type == 'username') $this->form_validation->set_rules('user', 'Username', 'required|trim', ['required' => 'Username belum diisi']);
		if ($type == 'password') {
			if ($username == '') redirect('auth');

			if ($user['pass'] === null) redirect('auth/index/reset/'.$username);

			$this->form_validation->set_rules('pass', 'Kata Sandi', 'required|trim', ['required' => 'Kata Sandi belum diisi']);
		}
		if ($type == 'reset') {
			if ($username == '') redirect('auth');

			if ($user['pass'] !== null) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak diizinkan mengatur ulang kata sandi akun ini</div>');
				redirect('auth');
			}

			$this->form_validation->set_rules('pass', 'Password', 'required|trim|min_length[3]', [
				'required' => 'Kata sandi belum diisi',
				'min_length' => 'Kata sandi terlalu pendek'
			]);
			$this->form_validation->set_rules('pass2', 'Password', 'trim|matches[pass]', [
				'matches' => 'Kata sandi tidak cocok'
			]);
		}
		
		if($this->form_validation->run() == false){
			if (!empty($_SERVER["HTTP_CLIENT_IP"])) $ip_address = $_SERVER["HTTP_CLIENT_IP"];
			else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
			else $ip_address = $_SERVER["REMOTE_ADDR"];

			$data = [
				'ncookies' => $this->auth->numCookies($ip_address),
				'cookies' => $this->auth->getCookies($ip_address),
				'title' => 'SIP Bang: Login',
				'type' => $type,
				'username' => $username,
				'user' => $user
			];
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
		$vuser = $this->input->post('user');
		$user = $this->auth->getUser($vuser);
		
		if($user) {
			if ($user['pass'] !== null) {
				redirect('auth/index/password/'.$vuser);
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Silahkan masukkan password baru</div>');
				redirect('auth/index/reset/'.$vuser);
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Tidak dapat menemukan akun Anda</div>');
			redirect('auth');
		}
	}

	private function _pass($username = '')
	{
		$pass = $this->input->post('pass');
		$user = $this->auth->getUser($username);

		if(password_verify($pass, $user['pass'])){
		    $session = array(
		       'user'   => $user['user'],
		       'name'   => $user['name'],
		       'sebagai'  => $user['sebagai']
		    );
	        $this->session->set_userdata($session);

	        if (!empty($_SERVER["HTTP_CLIENT_IP"])) $ip_address = $_SERVER["HTTP_CLIENT_IP"];
			else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
			else $ip_address = $_SERVER["REMOTE_ADDR"];

			$ips = $this->auth->numCookiesByUser($ip_address, $username);

			if ($ips == 0) {
				$dataInsert = [
					'user' => $username,
					'ip_address' => $ip_address
				];

				$this->auth->insertCookie($dataInsert);
			} else {
				$this->auth->updateCookie($dataInsert);
			}

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
		$user = $this->auth->getUser($username);

		$dataInsert = [
			'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
			'user' => $user['user']
		];

		$this->auth->updateUser($dataInsert);

		$session = array(
	       'user'   => $user['user'],
	       'name'   => $user['name'],
	       'sebagai'  => $user['sebagai']
	    );
        $this->session->set_userdata($session);

        if (!empty($_SERVER["HTTP_CLIENT_IP"])) $ip_address = $_SERVER["HTTP_CLIENT_IP"];
		else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else $ip_address = $_SERVER["REMOTE_ADDR"];

		$ips = $this->auth->numCookiesByUser($ip_address, $username);

		if ($ips == 0) {
			$dataInsert = [
				'user' => $username,
				'ip_address' => $ip_address
			];

			$this->auth->insertCookie($dataInsert);
		} else {
			$this->auth->updateCookie($dataInsert);
		}

		if($user['sebagai'] == 'pegawai') redirect('pegawai');
		if($user['sebagai'] == 'pengangkut') redirect('pengangkut');
		if($user['sebagai'] == 'tps') redirect('tps');
		if($user['sebagai'] == 'importir') redirect('importir');
	}

	public function loginas($username)
	{
		$user = $this->auth->getUser($username);

		$session = array(
	       'user'   => $user['user'],
	       'name'   => $user['name'],
	       'sebagai'  => $user['sebagai']
	    );
        $this->session->set_userdata($session);

        redirect('auth');
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
