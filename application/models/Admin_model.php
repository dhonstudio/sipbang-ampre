<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
	public function getRKSPsPegawai($offset, $limit)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = 'rksp'
					ORDER BY `id_tracking` DESC
					LIMIT $offset, $limit
					";
		return $this->db->query($query)->result_array();
	}

	public function getRKSPs1Pegawai()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = 'rksp'
					";
		return $this->db->query($query)->result_array();
	}

	public function numRKSPsPegawai()
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = 'rksp'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertAcceptRKSP($data)
	{
		$ref = $data['ref'];
		$jenis = $data['jenis'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','$jenis','$nomor',$doc_date,'$user','$name',$stamp)
					";
		$this->db->query($query);

		$query = "UPDATE `tracking` 
					SET `next`='Y'
					WHERE `ref`='$ref'
					AND `jenis`='rksp'
					";
		$this->db->query($query);
	}
}