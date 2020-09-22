<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
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

	public function getTrackings($jenis, $offset, $limit)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = '$jenis'
					ORDER BY `id_tracking` DESC
					LIMIT $offset, $limit
					";
		return $this->db->query($query)->result_array();
	}

	public function getTrackings1($jenis)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = '$jenis'
					AND `next` = 1
					";
		return $this->db->query($query)->result_array();
	}

	public function getTrackings2($jenis)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = '$jenis'
					AND `next` = 3
					";
		return $this->db->query($query)->result_array();
	}

	public function getTrackings3($jenis)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `jenis` = '$jenis'
					AND `next` = 5
					";
		return $this->db->query($query)->result_array();
	}

	public function getManifes($ref)
	{
		$query = "SELECT *
					FROM `tracking`
					WHERE `ref` = '$ref'
					AND `jenis` = 'manifes'
					";
		return $this->db->query($query)->row_array();
	}

	public function numTrackings($jenis)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = '$jenis'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertRKSP($data)
	{
		$ref = $data['ref'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$eta = $data['eta'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query1 = "SELECT *
					FROM `tracking`
					WHERE `nomor` = '$nomor'
					AND `jenis` = 'rksp'
					";
		$result1 = $this->db->query($query1)->num_rows();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`eta`,`user`,`name`,`stamp`)
					VALUES ('$ref','rksp','$nomor',$doc_date,$eta,'$user','$name',$stamp)
					";
		
		if ($result1 == 0) {
			$this->db->query($query2);
			return "<div class='alert alert-success' role='alert'>RKSP berhasil ditambahkan</div>";
		} else {
			return "<div class='alert alert-danger' role='alert'>RKSP gagal ditambahkan, RKSP sudah pernah diinput</div>";
		}
	}

	public function insertManifes($data)
	{
		$ref = $data['ref'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$eta = $data['eta'];
		$pos = $data['pos'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query1 = "SELECT *
					FROM `tracking`
					WHERE `nomor` = '$nomor'
					AND `jenis` = 'manifes'
					";
		$result1 = $this->db->query($query1)->num_rows();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`eta`,`pos`,`user`,`name`,`stamp`)
					VALUES ('$ref','manifes','$nomor',$doc_date,$eta,'$pos','$user','$name',$stamp)
					";

		$query3 = "UPDATE `tracking` 
					SET `next`=2
					WHERE `ref`='$ref'
					AND `jenis`='rksp'
					";
		
		if ($result1 == 0) {
			$this->db->query($query2);
			$this->db->query($query3);
			return "<div class='alert alert-success' role='alert'>Manifes berhasil ditambahkan</div>";
		} else {
			return "<div class='alert alert-danger' role='alert'>Manifes gagal ditambahkan, Manifes sudah pernah diinput</div>";
		}
	}

	public function insertBongkar($data)
	{
		$ref = $data['ref'];
		$nomor = date('Ymd-', time()).$data['nomor'].date('-His', time());
		$no_manifes = $data['nomor'];
		$doc_date = $data['doc_date'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`no_manifes`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','bongkar','$nomor','$no_manifes',$doc_date,'$user','$name',$stamp)
					";

		$query3 = "UPDATE `tracking` 
					SET `next`=2
					WHERE `ref`='$ref'
					AND `jenis`='manifes'
					";
		
		$this->db->query($query2);
		$this->db->query($query3);
		return "<div class='alert alert-success' role='alert'>Pembongkaran berhasil ditambahkan</div>";
	}

	public function insertTimbun($data)
	{
		$ref = $data['ref'];
		$nomor = date('Ymd-', time()).$data['nomor'].date('-His', time());
		$no_manifes = $data['nomor'];
		$doc_date = $data['doc_date'];
		$pos = $data['pos'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`no_manifes`,`pos`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','timbun','$nomor','$no_manifes','$pos',$doc_date,'$user','$name',$stamp)
					";

		$query3 = "UPDATE `tracking` 
					SET `next`=4
					WHERE `ref`='$ref'
					AND `jenis`='manifes'
					";
		
		$this->db->query($query2);
		$this->db->query($query3);
		return "<div class='alert alert-success' role='alert'>Penimbunan berhasil ditambahkan</div>";
	}

	public function insertPIB($data)
	{
		$ref = $data['ref'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$no_manifes = $data['no_manifes'];
		$pos = $data['pos'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`no_manifes`,`pos`,`doc_date`,`user`,`name`,`stamp`)
					VALUES ('$ref','pib','$nomor','$no_manifes','$pos',$doc_date,'$user','$name',$stamp)
					";

		$query3 = "UPDATE `tracking` 
					SET `next`=6
					WHERE `ref`='$ref'
					AND `jenis`='manifes'
					";
		
		$this->db->query($query2);
		$this->db->query($query3);
		return "<div class='alert alert-success' role='alert'>PIB berhasil ditambahkan</div>";
	}

	public function uploadDoc($data)
	{
		$id_tracking = $data['id_tracking'];
		$filename = $data['filename'];

		$query = "UPDATE `tracking` 
					SET `filename`='$filename'
					WHERE `id_tracking`=$id_tracking
					";
		$this->db->query($query);
	}
}