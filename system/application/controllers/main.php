<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/index
	 *	- or -  
	 * 		http://example.com/index.php/index/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/survey/header');
		$this->load->view('templates/survey/nav');
		$this->load->view('templates/survey/survey');
		$this->load->view('templates/survey/footer');
	}
}

/* End of file */