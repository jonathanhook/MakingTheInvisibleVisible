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

		$this->load->model('diary_model');
		$user_id = $this->ion_auth->user()->row()->id;
		$videos = $this->diary_model->get_all_from_user($user_id);

		$data = array ('videos' => $videos);

		$this->load->view('header', $header_data);
		$this->load->view('diary', $data);
		$this->load->view('footer');	
	}
}