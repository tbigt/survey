<?php

class Survey_Model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  get all survey data for the provided survey prefix

  param - surveyPrefix - example 's1'
  return - null if invalid survey prefix or all question 
  data for provided survey prefix
  */
  function getSurveyData($surveyPrefix) {

    if($this->db->table_exists($surveyPrefix . "_questions")) {

      $this->db->select("*")->from($surveyPrefix . "_questions");
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
}

?>