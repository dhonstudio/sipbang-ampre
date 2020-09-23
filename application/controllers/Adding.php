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
			'accept' => 'accept_'.$accept,
			'jenis' => $accept,
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$this->admin->insertAccept($data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Dokumen berhasil diterima</div>');
		redirect('pegawai/'.$accept);
	}

	public function acceptBongkar($accept)
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'accept' => 'accept_'.$accept,
			'jenis' => 'manifes',
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$this->admin->insertAcceptBongkar($data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Dokumen berhasil diterima</div>');
		redirect('pegawai/'.$accept);
	}

	public function acceptPIB()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'accept' => $this->input->post('respon'),
			'jenis' => 'accept_pib',
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$this->admin->insertAcceptBongkar($data);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">PIB berhasil direspon</div>');
		redirect('pegawai/pib');
	}

	public function manifes()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'id' => $this->input->post('idManifes'),
			'nomor' => $this->input->post('nomor'),
			'doc_date' => strtotime($this->input->post('doc_date')),
			'eta' => strtotime($this->input->post('eta')),
			'pos' => $this->input->post('pos'),
			'action' => $this->input->post('action')
		];
		$alert = $this->user->insertManifes($data);

		$this->session->set_flashdata('message',$alert);
		redirect('pengangkut/manifes');
	}

	public function bongkar()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'nomor' => $this->user->getManifes($this->input->post('ref'))['nomor'],
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$alert = $this->user->insertBongkar($data);

		$this->session->set_flashdata('message',$alert);
		redirect('pengangkut/bongkar');
	}

	public function timbun()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'nomor' => $this->user->getManifes($this->input->post('ref'))['nomor'],
			'doc_date' => strtotime($this->input->post('doc_date')),
			'pos' => $this->input->post('pos')
		];
		$alert = $this->user->insertTimbun($data);

		$this->session->set_flashdata('message',$alert);
		redirect('tps/timbun');
	}

	public function pib()
	{
		$data = [
			'ref' => $this->input->post('ref'),
			'no_manifes' => $this->user->getManifes($this->input->post('ref'))['nomor'],
			'pos' => $this->input->post('pos'),
			'nomor' => $this->input->post('nomor'),
			'doc_date' => strtotime($this->input->post('doc_date'))
		];
		$alert = $this->user->insertPIB($data);

		$this->session->set_flashdata('message',$alert);
		redirect('importir/pib');
	}

	public function uploaddoc()
	{
		$user = $this->input->post('user');
		$doc = $this->input->post('doc');

		if ($_FILES['image']['name']) {
			$config = [
				'allowed_types'	=> 'pdf|gif|jpg|png|jpeg',
				'max_size'		=> '2048',
				'upload_path'	=> './assets/img/doc/',
				'max_filename'	=> '50',
				'encrypt_name' 	=> TRUE
			];

			$this->load->library('upload', $config);

			if($this->upload->do_upload('image')){
				$data = [
					'id_tracking' => $this->input->post('id_tracking'),
					'filename' => $this->upload->data('file_name'),
				];
				$this->user->uploadDoc($data);

				redirect($user.'/'.$doc);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				redirect($user.'/'.$doc);
			}
		}
	}

	public function gettracking($id)
	{
		echo json_encode($this->user->getTracking($id));
	}
}