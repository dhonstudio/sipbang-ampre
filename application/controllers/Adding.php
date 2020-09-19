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
		$this->load->model('User_model', 'user');
		$this->load->model('Admin_model', 'admin');
	}

	public function index()
	{

	}

	public function rksp()
	{
		$data = [
			'ref' => 'rksp'.$this->session->userdata('user').'_'.$this->input->post('nomor'),
			'nomor' => $this->input->post('nomor'),
			'doc_date' => strtotime($this->input->post('doc_date')),
			'eta' => strtotime($this->input->post('eta'))
		];
		$alert = $this->user->insertRKSP($data);

		$this->session->set_flashdata('message',$alert);
		redirect('pengangkut/rksp');
	}

	public function rksp_accept()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'jenis'	=> 'accept_rksp',
			'nomor' => date('Ymd-His', time()),
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$this->manage->insertAcceptRKSP($data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">RKSP berhasil diterima</div>');
		redirect('pegawai/rksp');
	}
}