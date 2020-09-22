<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Importir extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$data = [
			'status' => $this->status,
			'title' => "SIP Bang",
			'subtitle' => "Dashboard",
			'maintitle' => "Dashboard",
			'user' => $this->user->getUser(),
			'refmanifes' => $this->user->getTrackings3('manifes')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/index', $data);
		$this->load->view('modals/pib', $data);
		$this->load->view('templates/footer');
	}

	public function pib()
	{
		$config = [
			'base_url' => base_url('importir/pib'),
			'total_rows' => $this->user->numTrackings('pib'),
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
			'refmanifes' => $this->user->getTrackings3('manifes'),
			'documents' => $this->user->getTrackings('pib', $page, $config['per_page'])
		];

		$this->config->load('pagination');
		$this->pagination->initialize($config);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('bodies/documents', $data);
		$this->load->view('modals/pib', $data);
		$this->load->view('modals/upload');
		$this->load->view('templates/footer');
	}

	public function gettracking($id)
	{
		foreach(explode(",",$this->user->getManifes($id)['pos']) as $pos) {
			echo '<option value='.$pos.'>'.$pos.'</option>';
		}
	}
}