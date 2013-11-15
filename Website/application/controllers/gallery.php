<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller 
{
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('login');
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
