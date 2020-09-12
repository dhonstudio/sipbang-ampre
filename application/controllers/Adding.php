<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Adding extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('encryption');
		$this->load->library('pagination');
		$this->load->library('form_validation');
	}

	public function index()
	{

	}

	public function rksp()
	{
		$data = [
			'ref' => 'rksp'.$this->session->userdata('user').'_'.$this->input->post('nomor'),
			'jenis'	=> 'rksp',
			'nomor' => $this->input->post('nomor'),
			'doc_date' => strtotime($this->input->post('doc_date')),
			'eta' => strtotime($this->input->post('eta')),
			'user' => $this->session->userdata('user'),
			'name' => $this->session->userdata('name'),
			'stamp' => time()
		];
		$this->db->insert('tracking', $data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">RKSP berhasil ditambahkan</div>');
		redirect('pengangkut/rksp');
	}
}