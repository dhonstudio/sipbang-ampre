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

	public function accept($accept)
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'nomor' => date('Ymd-His', time()),
			'accept' => 'accept_'.$accept,
			'jenis' => $accept,
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$this->admin->insertAccept($data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Dokumen berhasil diterima</div>');
		redirect('pegawai/'.$accept);
	}

	public function manifes()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'nomor' => $this->input->post('nomor'),
			'doc_date' => strtotime($this->input->post('doc_date')),
			'eta' => strtotime($this->input->post('eta')),
			'pos' => $this->input->post('pos')
		];
		$alert = $this->user->insertManifes($data);

		$this->session->set_flashdata('message',$alert);
		redirect('pengangkut/manifes');
	}
}