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
	}

	public function index()
	{
		$data['title'] = "SIP Bang";  
		$data['subtitle'] = "Dashboard";  
		$data['maintitle'] = "Dashboard"; 
		$data['user'] = $this->db->get_where('users', ['user' => $this->session->userdata('user')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pengangkut/index', $data);
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}

	public function rksp()
	{
		$data['title'] = "SIP Bang";  
		$data['subtitle'] = "RKSP";  
		$data['maintitle'] = "Data RKSP"; 
		$data['user'] = $this->db->get_where('users', ['user' => $this->session->userdata('user')])->row_array();

		$config['base_url'] = base_url('pengangkut/rksp');
		$this->db->where('user', $this->session->userdata('user'));
		$this->db->where('jenis', 'rksp');
		$this->db->from('tracking');
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 10;

		$this->config->load('pagination');
		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['pagination'] = $this->pagination->create_links();

		$data['rksp'] = $this->db->order_by('id_tracking', 'DESC')->get_where('tracking', [
			'user' => $this->session->userdata('user'),
			'jenis' => 'rksp'
		], $config['per_page'], $data['page'])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pengangkut/rksp', $data);
		$this->load->view('modals/track');
		$this->load->view('templates/footer');
	}
}