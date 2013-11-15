<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary extends CI_Controller 
{
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('./login');
		}

		$header_data = array('selected' => 'diary',
							 'logged_in'=> true);

		$this->load->view('header', $header_data);
		$this->load->view('diary');
		$this->load->view('footer');	
	}
}