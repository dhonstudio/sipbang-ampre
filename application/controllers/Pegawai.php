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
		$this->load->view('modals/accept');
		$this->load->view('modals/track');
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
			'documents' => $this->user->getTrackingsPegawai('rksp', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
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
			'documents' => $this->user->getTrackingsPegawai('manifes', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
		$this->load->view('templates/footer');
	}

	public function bongkar()
	{
		$config = [
			'base_url' => base_url('pegawai/bongkar'),
			'total_rows' => $this->user->numTrackingsPegawai('bongkar'),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Pembongkaran",
			'maintitle' => "Data Pembongkaran",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'documents' => $this->user->getTrackingsPegawai('bongkar', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
		$this->load->view('templates/footer');
	}

	public function timbun()
	{
		$config = [
			'base_url' => base_url('pegawai/timbun'),
			'total_rows' => $this->user->numTrackingsPegawai('timbun'),
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
			'documents' => $this->user->getTrackingsPegawai('timbun', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
		$this->load->view('templates/footer');
	}

	public function pib()
	{
		$config = [
			'base_url' => base_url('pegawai/pib'),
			'total_rows' => $this->user->numTrackingsPegawai('pib'),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "PIB",
			'maintitle' => "Data PIB",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'documents' => $this->user->getTrackingsPegawai('pib', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
		$this->load->view('templates/footer');
	}

	public function sppb()
	{
		$config = [
			'base_url' => base_url('pegawai/sppb'),
			'total_rows' => $this->user->numTrackingsPegawai('sppb'),
			'per_page' => 10
		];

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "SPPB",
			'maintitle' => "Data SPPB",
			'page' => $page,
			'pagination' => $this->pagination->create_links(),
			'user' => $this->user->getUser(),
			'documents' => $this->user->getTrackingsPegawai('sppb', $page, $config['per_page'])
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents_pegawai', $data);
		$this->load->view('modals/accept');
		$this->load->view('modals/file');
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
		$this->load->view('templates/footer');
	}

	public function gettracking($id)
	{
		echo json_encode($this->user->getTracking($id));
	}
}