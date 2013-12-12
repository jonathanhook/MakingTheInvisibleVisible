<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_Words extends CI_Controller 
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

		$title = '';
		$text = '';
		$error = '';
		$document_id = '';
		
		if($this->input->post())
		{
			$title = $this->input->post('title');
			$text = $this->input->post('text');

			if($title != '' && $text != '')
			{
				if(isset($_POST['author']))
				{
					$user_id = $this->input->post('author');
					echo $user_id;
				}
				else
				{
					$user_id = $this->ion_auth->user()->row()->id;
				}

				$document_id = $this->input->post('id');

				if($document_id == '')
				{
					$this->load->model('words_model');
					$this->words_model->create($user_id, $title, $text);

					$document_id = $this->words_model->get_from_user_and_title($user_id, $title)->id;
				}
				else
				{
					$this->load->model('words_model');
					$this->words_model->update($document_id, $title, $text);
				}
			}
			else
			{
				$error = "Please enter a title and some words before you save.";
			}
		}

		$this->load->model('user_model');
		$user_data = $this->user_model->get_all_users();

		foreach ($user_data as $u)
		{
			$users[$u->id] = $u->first_name . ' ' . $u->last_name; 
		}

		$header_data = array('selected' => 'words',
				     		 'logged_in' => true);

		$hidden = array('id' => $document_id);

		$data = array('title' => $title,
					  'text' => $text,
					  'error' => $error,
					  'admin' => $this->ion_auth->is_admin(),
					  'users' => $users,
					  'hidden' => $hidden);

		$this->load->view('header', $header_data);
		$this->load->view('add_words', $data);
		$this->load->view('footer');
	}
}