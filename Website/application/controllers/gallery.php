<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller 
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

				if($type == 'image')
				{
					$this->load->model('media_model');
					$type_id = $this->media_model->get_type($type);
					$type_id = $type_id->id;

					$this->media_model->create($name, $user_id, $type_id);
				}
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}

		$this->load->model('media_model');
		$images = $this->media_model->get_images();
		$videos = $this->media_model->get_videos();
		$audio = $this->media_model->get_audio();

		$data = array('images' => $images,
					  'videos' => $videos,
					  'audio' => $audio);

		$header_data = array('selected' => 'gallery',
						     'logged_in' => true);

		$this->load->view('header', $header_data);
		$this->load->view('gallery', $data);
		$this->load->view('footer');
	}

}
