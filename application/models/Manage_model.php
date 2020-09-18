<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_model extends CI_Model 
{
	public function getUserBySession()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `users`
					WHERE `user` = '$user'
					";
		return $this->db->query($query)->row_array();
	}

	public function getUsers()
	{
		$query = "SELECT *
					FROM `users`
					";
		return $this->db->query($query)->result_array();
	}

	public function getRKSPs($offset, $limit)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = 'rksp'
					ORDER BY `id_tracking` DESC
					LIMIT $offset, $limit
					";
		return $this->db->query($query)->result_array();
	}

	public function getRKSPs1()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = 'rksp'
					AND `next` = 'Y'
					";
		return $this->db->query($query)->result_array();
	}

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

	public function numRKSPs()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = 'rksp'
					";
		return $this->db->query($query)->num_rows();
	}

	public function numRKSPsPegawai()
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = 'rksp'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertRKSP($data)
	{
		$ref = $data['ref'];
		$jenis = $data['jenis'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$eta = $data['eta'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`eta`,`user`,`name`,`stamp`)
					VALUES ('$ref','$jenis','$nomor',$doc_date,$eta,'$user','$name',$stamp)
					";
		$this->db->query($query);
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