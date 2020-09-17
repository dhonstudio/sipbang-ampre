<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model 
{
	public function getUser($user)
	{
		$query = "SELECT *
					FROM `users`
					WHERE `user` = '$user'
					";
		return $this->db->query($query)->row_array();
	}

	public function getCookies($ip_address)
	{
		$query = "SELECT *
					FROM `cookies`
					WHERE `ip_address` = '$ip_address'
					";
		return $this->db->query($query)->result_array();
	}

	public function numCookies($ip_address)
	{
		$query = "SELECT *
					FROM `cookies`
					WHERE `ip_address` = '$ip_address'
					";
		return $this->db->query($query)->num_rows();
	}

	public function numCookiesByUser($ip_address, $user)
	{
		$query = "SELECT *
					FROM `cookies`
					WHERE `ip_address` = '$ip_address'
					AND `user` = '$user'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertCookie($data)
	{
		$user = $data['user'];
		$ip_address = $data['ip_address'];
		$timestamp = time();

		$query = "INSERT INTO `cookies`
					(`user`,`ip_address`,`timestamp`)
					VALUES ('$user','$ip_address',$timestamp)
					";
		$this->db->query($query);
	}

	public function updateCookie($data)
	{
		$user = $data['user'];
		$ip_address = $data['ip_address'];
		$timestamp = time();

		$query = "UPDATE `cookies` 
					SET `timestamp` = $timestamp
					WHERE `user`='$user'
					AND `ip_address`='$ip_address'
					";
		$this->db->query($query);
	}

	public function updateUser($data)
	{
		$pass = $data['pass'];
		$user = $data['user'];

		$query = "UPDATE `users` 
					SET `pass` = '$pass'
					WHERE `user`='$user'
					";
		$this->db->query($query);
	}
}