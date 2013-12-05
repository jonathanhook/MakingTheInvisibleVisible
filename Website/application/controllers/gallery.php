<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	private function createThumbnail($src, $dest, $desired_width) 
	{
		$source_image = imagecreatefromjpeg($src);

		if($source_image)
		{
			$width = imagesx($source_image);
			$height = imagesy($source_image);

			$desired_height = floor($height * ($desired_width / $width));
			$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
			imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
			imagejpeg($virtual_image, $dest);
		}

		imagedestroy($source_image);
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('login');
		}

		$uploadErrors = '';
		if($this->input->post() && $_FILES['userfile']['size'] > 0)
		{
			$config['upload_path'] = './media/';
			$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|mp4|mp3';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload())
			{
				$data = $this->upload->data();
				$name = $data['file_name'];
				$user_id = $this->ion_auth->user()->row()->id;

				$type = explode('/', $data['file_type']);
				$type = $type[0];

				if($type == 'image' && $data['file_size'] <= 1000)
				{
					$this->load->model('media_model');
					$type_id = $this->media_model->get_type($type);
					$type_id = $type_id->id;

					$thumbnail = 't_' . $name;
					$name_path = './media/' . $name;
					$thumbnail_path = './media/' . $thumbnail;

					$this->createThumbnail($name_path, $thumbnail_path, '320');
					$this->media_model->create($name, $thumbnail, $user_id, $type_id);
				}
				else if($type == 'video' || $type == 'audio')
				{
					$this->load->model('media_model');
					$type_id = $this->media_model->get_type($type);
					$type_id = $type_id->id;

					$this->media_model->create($name, '', $user_id, $type_id);
				}
			}
			else
			{
				$uploadErrors = $this->upload->display_errors();
			}
		}

		$this->load->model('comments_model');
		$this->load->model('media_model');

		$images = $this->media_model->get_media_from_type('image');
		$videos = $this->media_model->get_media_from_type('video');
		$audio = $this->media_model->get_media_from_type('audio');

		$data = array('images' => $images,
					  'videos' => $videos,
					  'audio' => $audio,
					  'uploadErrors' => $uploadErrors);

		$header_data = array('selected' => 'gallery',
						     'logged_in' => true);

		$this->load->view('header', $header_data);
		$this->load->view('gallery', $data);
		$this->load->view('footer');
	}
}
