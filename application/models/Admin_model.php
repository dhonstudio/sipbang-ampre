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
					WHERE `id_tracking` = $id
					";
		return $this->db->query($query)->row_array();
	}

	public function getTrackingsPegawai($jenis, $offset, $limit)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = '$jenis'
					ORDER BY `next` ASC, `id_tracking` DESC
					LIMIT $offset, $limit
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

	public function insertAccept($data)
	{
		$ref = $data['ref'];
		$accept = $data['accept'];
		$jenis = $data['jenis'];
		$nomor = date('Ymd-His', time());
		$doc_date = $data['doc_date'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query1 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','$accept','$nomor',$doc_date,'$user','$name',$stamp)
					";
		$this->db->query($query1);

		$query2 = "UPDATE `tracking` 
					SET `next`=1
					WHERE `ref`='$ref'
					AND `jenis`='$jenis'
					";
		$this->db->query($query2);
	}

	public function insertAcceptBongkar($data)
	{
		$ref = $data['ref'];
		$accept = $data['accept'];
		$jenis = $data['jenis'];
		$nomor = date('Ymd-His', time());
		$doc_date = $data['doc_date'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();
		if ($accept == 'accept_bongkar') $next = 3;
		if ($accept == 'accept_timbun') $next = 5;

		$query1 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','$accept','$nomor',$doc_date,'$user','$name',$stamp)
					";
		$this->db->query($query1);

		$query2 = "UPDATE `tracking` 
					SET `next`=$next
					WHERE `ref`='$ref'
					AND `jenis`='$jenis'
					";
		if ($jenis != 'accept_pib') $this->db->query($query2);
	}
}