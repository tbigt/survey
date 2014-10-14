<?php

class Survey_Model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  get all survey data for the provided survey prefix
  param - surveyPrefix of table - example 's1'
  return - null if invalid survey prefix or all question 
  data for provided survey prefix
  */
  function getSurveyData($surveyPrefix) {

    if($this->db->table_exists($surveyPrefix . "_questions") &&
      $this->db->table_exists($surveyPrefix . "_options")) {

      $this->db->select("*")->from($surveyPrefix . "_questions")->order_by("question_type", "asc");
      $question_query = $this->db->get();

      // determine if any questions have options
      foreach($question_query->result() as $question) {

        if($question->question_type == 0) {

          // get all options for this question
          $this->db->select("*")->from($surveyPrefix . "_options")->where("question_id", $question->id);
          $option_query = $this->db->get();

          // add all options to this questions contents
          $question->options = array();
          foreach($option_query->result() as $option) {
            array_push($question->options, $option);
          }
        }
      } // end foreach - all questions

      return $question_query->result();
    } // end if - valid table

    return null;
  } // end function - get survey data

  /*
  validate the survery submission
  param - surveyPrefix of table - example 's1'
  */
  function validateSubmission($surveyPrefix) {

    // get the survey questions/answers and ensure the survey is valid
    $surveyData = $this->getSurveyData($surveyPrefix);
    $errors = array();
    if($surveyData != null) {

      $responses = array();
      foreach($surveyData as $question) {

        if(isset($_POST["question_" . $question->id]) && !empty($_POST["question_" . $question->id])) {

          // question has a response
          $responses[($question->id)] = $_POST["question_" . $question->id];
        }
        else {

          // check if the question is required
          if($question->required == 1) {

            // error - question is required but is blank/does not exist
            array_push($errors, "'" . $question->question_text . "' is required.");
          }
        }
      }

      if(sizeof($errors) > 0) 
        return array("errors" => $errors);
      else
        return array("responses" => $responses);
    }

    return null;
  } // end function - validate submission
}

?>