<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
	public function getUser()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `users`
					WHERE `user` = '$user'
					";
		return $this->db->query($query)->row_array();
	}

	public function getTracking($id)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `id_tracking` = '$id'
					";
		return $this->db->query($query)->row_array();
	}

	public function getTrackingsPegawai($jenis, $offset, $limit)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = '$jenis'
					ORDER BY `id_tracking` DESC
					LIMIT $offset, $limit
					";
		return $this->db->query($query)->result_array();
	}

	public function getRKSPs1Pegawai()
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = 'rksp'
					";
		return $this->db->query($query)->result_array();
	}

	public function numTrackingsPegawai($jenis)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = '$jenis'
					";
		return $this->db->query($query)->num_rows();
	}

	public function numAccept($ref, $jenis)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `ref` = '$ref'
					AND `jenis` = '$jenis'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertAcceptRKSP($data)
	{
		$ref = $data['ref'];
		$jenis = 'accept_rksp';
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