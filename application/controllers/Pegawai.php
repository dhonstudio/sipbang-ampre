<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pegawai extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Admin_model', 'user');

		$this->status = "development";
	}

	public function index()
	{
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Dashboard",
			'maintitle' => "Dashboard",
			'user' => $this->user->getUser()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/index', $data);
		$this->load->view('modals/accept_rksp');
		$this->load->view('modals/accept_manifes');
		$this->load->view('templates/footer');
	}

	public function rksp()
	{
		$config = [
			'base_url' => base_url('pegawai/rksp'),
			'total_rows' => $this->user->numTrackingsPegawai('rksp'),
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
			'user' => $this->user->getUser(),
			'ref' => $this->user->getRKSPs1Pegawai(),
			'rksp' => $this->user->getTrackingsPegawai('rksp', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/rksp_pegawai', $data);
		$this->load->view('modals/accept_rksp');
		$this->load->view('modals/accept_manifes');
		$this->load->view('templates/footer');
	}

	public function manifes()
	{
		$config = [
			'base_url' => base_url('pegawai/manifes'),
			'total_rows' => $this->user->numTrackingsPegawai('manifes'),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Manifes",
			'maintitle' => "Data Manifes",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'ref' => $this->user->getRKSPs1Pegawai(),
			'manifes' => $this->user->getTrackingsPegawai('manifes', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/manifes_pegawai', $data);
		$this->load->view('modals/accept_rksp');
		$this->load->view('modals/accept_manifes');
		$this->load->view('templates/footer');
	}

	public function gettracking($id)
	{
		echo json_encode($this->user->getTracking($id));
	}
}