<?php

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('user')) {
		redirect('auth');
	} else {
		$sebagai = $ci->session->userdata('sebagai');
		$validation = $ci->uri->segment(1);

		if($sebagai != $validation) redirect('auth/blocked');
	}
}