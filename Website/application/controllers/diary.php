<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('login');
		}

		$header_data = array('selected' => 'diary',
							 'logged_in'=> true);

		$user_id = $this->ion_auth->user()->row()->id;

		$this->load->model('diary_model');
		$videos = $this->diary_model->get_all_from_user($user_id);

		$data = array ('videos' => $videos);

		$this->load->view('header', $header_data);
		$this->load->view('diary', $data);
		$this->load->view('footer');	
	}
}