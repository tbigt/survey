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

        if($question->question_type == 0 || $question->question_type == 3) {

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
      if(isset($_POST["email_field"]) && !empty($_POST["email_field"]) && filter_var($_POST["email_field"], FILTER_VALIDATE_EMAIL)) {
        $responses["email"] = $_POST["email_field"];
      }
      else {
        array_push($errors, "'Email Address' is required and must be valid.");
      }

      foreach($surveyData as $question) {

        if(isset($_POST["question_" . $question->id]) && !empty($_POST["question_" . $question->id])) {

          // question has a response, set the response attribute & add object to final responses
          $question->response = $_POST["question_" . $question->id];
          $responses[($question->id)] = $question;
        }
        else {

          // check if the question is required
          if($question->required == 1) {

            // error - question is required but is blank/does not exist
            array_push($errors, "'" . $question->question_text . "' is required.");
          }
          elseif(isset($_POST["question_" . $question->id]) ) {

            // question has no response, but is not required
            $question->response = $_POST["question_" . $question->id];
            $responses[($question->id)] = null;
          }
        }
      }

      if(sizeof($errors) > 0) 
        return array("errors" => $errors);
      else
        return array("success" => $this->submitData($surveyPrefix, $responses));
    }

    return null;
  } // end function - validate submission

  /*
  submit the data to the database
  param - surveyPrefix of table - example 's1'
  param - responses of questions - question object including responses
  */
  private function submitData($surveyPrefix, $responses) {

    // check if user exists
    $this->db->select("*")->from($surveyPrefix . "_users")->where("email", $responses["email"]);
    $emailQuery = $this->db->get();
    $userId = 0;
    if($emailQuery->num_rows() > 0) {

      // get user's id
      $userId = $emailQuery->row()->id;
    }
    else {

      // add user
      $this->db->insert($surveyPrefix . "_users", array("email" => $responses["email"]));

      // get user's id
      $this->db->select("*")->from($surveyPrefix . "_users")->where("email", $responses["email"]);
      $emailQuery = $this->db->get();
      $userId = $emailQuery->row()->id;
    }

    // prepare insert responses
    $insert_data = array();

    foreach ($responses as $response) {
      
      if($response == $responses["email"]) continue;

      // generate response data
      $response_data = array();
      $response_data["user_id"] = $userId;
      $response_data["question_id"] = $response->id;

      // check if the question was multiple choice
      if($response->question_type == 0) {

        // associate proper option id & ignore text field
        $response_data["option_id"] = $response->response;
        $response_data["text"] = null;
      }
      // check if the question was simple input or text input
      elseif($response->question_type == 1 || $response->question_type == 2 ) {

        // set proper text & ignore option id
        $response_data["option_id"] = 0;
        $response_data["text"] = $response->response;
      }

      array_push($insert_data, $response_data);
    }

    $this->db->insert_batch($surveyPrefix . "_responses", $insert_data);

    return null;
  }
}

?>