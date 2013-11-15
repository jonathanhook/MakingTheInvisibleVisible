<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->ion_auth->logged_in())
		{
			redirect('gallery');
		}

		$this->load->helper('form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('identity', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$header_data = array('logged_in' => false);
		$this->load->view('header', $header_data);

		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$identity = $this->input->post('identity');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');

			if($this->ion_auth->login($identity, $password, $remember))
			{
				redirect('gallery');
			}
			else
			{
				$this->load->view('login/login', array('login_failed' => true));
			}
		}	

		
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */