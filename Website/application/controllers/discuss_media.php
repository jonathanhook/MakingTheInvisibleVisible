<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discuss_Media extends CI_Controller 
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

		$media = '';
		$id = 0;

		if($this->input->get() && isset($_GET['id']))
		{
			$id = $_GET['id'];
		}
		else if($this->input->post() && isset($_POST['id']) && isset($_POST['comment']))
		{
			$id = $_POST['id'];
			$comment = $_POST['comment'];

			if($comment != '')
			{
				$user_id = $this->ion_auth->user()->row()->id;

				$this->load->model('comments_model');
				$this->comments_model->create($user_id, $id, $comment);
			}
		}

		if($id)
		{
			$this->load->model('media_model');
			$media = $this->media_model->get_media_from_id($id);

			$this->load->model('comments_model');
			$comments = $this->comments_model->get_comments_form_media_id($id);			

			$header_data = array('selected' => 'gallery',
								 'logged_in'=> true);

			$hidden = array('id' => $id);

			$data = array('media' => $media, 
						  'hidden' => $hidden,
						  'comments' => $comments);

			$this->load->view('header', $header_data);
			$this->load->view('discuss_media', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect('gallery');
		}
	}
}