<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


  /**
   * index for the main function
   * renders an error if a survey parameter is not passed
   * as a parameter in the url
   */
  public function index($survey = "")
  {

    $surveyPrefix = "";
    $data["valid_survey"] = true;
    $data["show_questions"] = true;
    $data["survey_errors"] = false;

    switch($survey) {
      // add all of your surveys & configurations here
      case "survey_one":
        $surveyPrefix = "s1";
        $data["survey_title"] = "Basic Survey";
        $data["survey_subtitle"] = "Please provide all basic information";
        break;
      case "survey_two":
        $surveyPrefix = "s2";
        $data["survey_title"] = "Advanced Survey";
        $data["survey_subtitle"] = "Please provide all advanced information";
        break;
      default:
        // default to an error, can change to default to a survey 
        $data["valid_survey"] = false;
        break;
    }

    $this->load->model("survey_model");

    // check if the survey was submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $data["valid_survey"]) {

      $result = $this->survey_model->validateSubmission($surveyPrefix);
      if(array_key_exists("errors", $result)) {
        $data["errors"] = $result["errors"];
        $data["survey_errors"] = true;
      }
      else {
        $data["show_questions"] = false;
      }
    }

    // check if the user specified a valid survey
    if(!empty($surveyPrefix)) {

      $data["questions"] = $this->survey_model->getSurveyData($surveyPrefix);
      ($data["questions"] === null) ? $data["valid_survey"] = false: "";
    }

    $this->load->helper('url');
    $this->load->view('templates/survey/header', $data);
    $this->load->view('templates/survey/nav');
    $this->load->view('templates/survey/survey', $data);
    $this->load->view('templates/survey/footer');
  }
}