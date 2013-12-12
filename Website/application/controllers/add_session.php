<?php

class Add_Session extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('login');
		}

		if (!$this->ion_auth->is_admin())
		{
			redirect('gallery');
		}

		if($this->input->post())
		{
			$title = $this->input->post('title');
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('date'))));;

			if($title != '' && $date != '')
			{
				$this->load->model('session_model');
				$this->session_model->create($title, $date);

				echo 'Session created: ' . $title . ' ' . $date;
			}
		}

		$this->load->view('add_session');
	}
}