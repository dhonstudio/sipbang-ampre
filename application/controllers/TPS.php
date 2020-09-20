<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class TPS extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');

		$this->status = "development";
	}

	public function index()
	{
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Dashboard",
			'maintitle' => "Dashboard",
			'user' => $this->user->getUser(),
			'refmanifes' => $this->user->getTrackings2('manifes')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/index', $data);
		$this->load->view('modals/timbun');
		$this->load->view('templates/footer');
	}

	public function timbun()
	{
		$config = [
			'base_url' => base_url('tps/timbun'),
			'total_rows' => $this->user->numTrackings('bongkar'),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Penimbunan",
			'maintitle' => "Data Penimbunan",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'refmanifes' => $this->user->getTrackings2('manifes'),
			'timbun' => $this->user->getTrackings('timbun', $page, $config['per_page'])
		];

		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/timbun', $data);
		$this->load->view('modals/timbun');
		$this->load->view('templates/footer');
	}
}