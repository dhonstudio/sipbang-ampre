<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Tps extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');

		$this->cont = "tps";
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

	public function tracking()
	{
		$nomor = $this->input->post('nomor');
		$jenis = $this->input->post('jenis');

		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Tracking",
			'maintitle' => "Result for ".$jenis." nomor ".$nomor,
			'user' => $this->user->getUser(),
			'tracking' => $this->user->getTrackingsByNomor($nomor, $jenis)
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/tracking', $data);
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function timbun()
	{
		$config = [
			'base_url' => base_url('tps/timbun'),
			'total_rows' => $this->user->numTrackings('bongkar'),
			'per_page' => 10
		];
		$this->config->load('pagination');
		$this->pagination->initialize($config);

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
			'documents' => $this->user->getTrackings('timbun', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents', $data);
		$this->load->view('modals/timbun');
		$this->load->view('modals/upload');
		$this->load->view('templates/footer');
	}
}