<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_Words extends CI_Controller 
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

		if($this->input->get() && isset($_GET['id']))
		{
			$id = $_GET['id'];
		}

		if($id)
		{
			$this->load->model('words_model');
			$words = $this->words_model->get($id);

			if(substr($words->text, -strlen('pdf')) === 'pdf')
			{
				redirect(base_url() . 'media/' . $words->text);
			}

			$header_data = array('selected' => 'words',
								 'logged_in'=> true);

			$hidden = array('id' => $id);

			$data = array('words' => $words,
						  'hidden' => $hidden);

			$this->load->view('header', $header_data);
			$this->load->view('view_words', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect('words');
		}
	}
}