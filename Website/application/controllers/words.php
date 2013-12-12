<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Words extends CI_Controller 
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

		$user_id = $this->ion_auth->user()->row()->id;

		$this->load->model('words_model');
		$user_words = $this->words_model->get_all_words_from_user($user_id);
		$other_user_words = $this->words_model->get_all_words_from_other_users($user_id);

		$data = array('user_words' => $user_words,
					  'other_user_words' => $other_user_words);

		$header_data = array('selected' => 'words',
				     		 'logged_in' => true);

		$this->load->view('header', $header_data);
		$this->load->view('words', $data);
		$this->load->view('footer');
	}
}