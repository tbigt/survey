<?php

class User_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  attempt to log in a user
  */
  function login() {

    $errors = array();
    // validate email & password
    if(isset($_POST["login-password"]) && !empty($_POST["login-password"])
      && isset($_POST["login-email"]) && !empty($_POST["login-email"])) {

      $email = $_POST["login-email"];
      $password = $_POST["login-password"];

      $this->db->select("*")->from("admin_users")->where(array("email" => $email, "password" => md5($password)));
      $query = $this->db->get();
      if($query->num_rows() > 0) {

        $user = $query->row();
        //add all data to session
        $userdata = array(
          'id'  => $user->id,
          'email'    => $user->email,
          'logged_in'  => TRUE,
        );
        $this->session->set_userdata($userdata);
      }
      else {
        array_push($errors, "Invalid email and/or password.");
      }
    }
    else {
      array_push($errors, "All fields are required.");
    }

    return array("errors" => $errors, "success" => (empty($errors)));
  }

  /*
  check if there is currently a user logged in
  */
  function isLoggedIn() {

    return ($this->session->userdata("logged_in") !== FALSE);
  }

  /*
  log out the current user
  */
  function logout() {
    $userdata = array(
      'id'   =>'',
      'email'     => '',
      'logged_in' => FALSE,
    );
    $this->session->unset_userdata($userdata);
    $this->session->sess_destroy();
  }

  /*
  add a user after a user submission form is submitted
  */
  function addUser() {

    $errors = array();
    // validate email & password
    if(isset($_POST["signup-password"]) && !empty($_POST["signup-password"])
      && isset($_POST["signup-email"]) && !empty($_POST["signup-email"])) {

      $email = $_POST["signup-email"];
      $password = $_POST["signup-password"];
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // ensure the email is unique
        $this->db->select("*")->from("admin_users")->where("email", $email);
        $query = $this->db->get();
        if($query->num_rows() == 0) {

          if(strlen($password) >= 6) {

            // create the user
            $password = md5($password);
            $this->db->insert("admin_users", array("email" => $email, "password" => $password));
          }
          else {
            array_push($errors, "Password must be at least 6 characters long.");
          }
        }
        else {
          array_push($errors, "Email address is already in use.");
        }
      }
      else {
        array_push($errors, "Invalid email address.");
      }
    }
    else {
      array_push($errors, "All fields are required.");
    }

    return array("errors" => $errors, "success" => (empty($errors)));
  }

  /*
  count total users in admin users table
  */
  function getUserCount() {

    $this->db->select("*")->from("admin_users");
    return $this->db->get()->num_rows();
  }
}