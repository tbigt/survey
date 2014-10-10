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
	public function index($survey = "")
	{

		$surveyPrefix = "";
		$data["valid_survey"] = true;
		switch($survey) {
			case "survey_one":
				$surveyPrefix = "s1";
				break;
			case "survey_two":
				$surveyPrefix = "s2";
				break;
			default:
				$data["valid_survey"] = false;
				break;
		}

		if(!empty($surveyPrefix)) {

			$this->load->model("survey_model");
			$data["questions"] = $this->survey_model->getSurveyData($surveyPrefix);
			($data["questions"] === null) ? $data["valid_survey"] = false: "";
		}

		$this->load->helper('url');
		$this->load->view('templates/survey/header');
		$this->load->view('templates/survey/nav');
		$this->load->view('templates/survey/survey', $data);
		$this->load->view('templates/survey/footer');
	}
}

/* End of file */