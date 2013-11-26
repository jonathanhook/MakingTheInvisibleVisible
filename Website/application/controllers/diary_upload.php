<?php

class Diary_Upload extends CI_Controller {

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
			$config['upload_path'] = './media/';
			$config['max_size'] = '524288000';
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload())
			{
				$data = $this->upload->data();
				$name = $data['file_name'];

				$type = explode('/', $data['file_type']);
				$type = $type[0];

				if($type == 'video')
				{
					$this->load->model('media_model');
					$type_id = $this->media_model->get_type($type);
					$type_id = $type_id->id;

					$user_id = $this->input->post('user_name');
					$week = $this->input->post('week');

					$this->load->model('diary_model');
					$this->diary_model->create($name, $user_id, $type_id, $week);
				}
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}

		$this->load->model('user_model');
		$all_user_names = $this->user_model->get_all_user_ids_and_names();

		$options = array();
		foreach ($all_user_names as $u)
		{
			$options[$u->id] = $u->username;
		}

		echo 'post_max_size: ' . ini_get('post_max_size') . '<br />';
		echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . '<br />';
		echo 'memory_limit: ' . ini_get('memory_limit') . '<br />';

		$data = array('options' => $options);
		$this->load->view('diary_upload', $data);
	}
}