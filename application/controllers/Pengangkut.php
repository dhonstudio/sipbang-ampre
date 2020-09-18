<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pengangkut extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Manage_model', 'manage');

		$this->status = "development";
	}

	public function index()
	{
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Dashboard",
			'maintitle' => "Dashboard",
			'user' => $this->manage->getUserBySession(),
			'ref' => $this->manage->getRKSPs1()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/index', $data);
		$this->load->view('modals/rksp');
		$this->load->view('templates/footer');
	}

	public function rksp()
	{
		$config = [
			'base_url' => base_url('pengangkut/rksp'),
			'total_rows' => $this->manage->numRKSPs(),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "RKSP",
			'maintitle' => "Data RKSP",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->manage->getUserBySession(),
			'ref' => $this->manage->getRKSPs1(),
			'rksp' => $this->manage->getRKSPs($page, $config['per_page'])
		];

		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/rksp', $data);
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}
}