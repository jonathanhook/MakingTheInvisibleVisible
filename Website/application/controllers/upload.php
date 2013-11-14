<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		if($this->input->post())
		{
			$config['upload_path'] = './media/';
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload())
			{
				$data = $this->upload->data();
				$name = $data['file_name'];
				$user_id = $this->ion_auth->user()->row()->id;

				$type = explode('/', $data['file_type']);
				$type = $type[0];

				$this->load->model('media_model');
				$type_id = $this->media_model->get_type($type);
				$type_id = $type_id->id;

				$this->media_model->create($name, $user_id, $type_id);
			}
		}

		$this->load->view('upload');
	}
}