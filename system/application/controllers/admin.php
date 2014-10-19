<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct() {
    parent::__construct();

    // load common helpers/models
    $this->load->helper('url');
    $this->load->model("user_model");
    $this->load->library("session");
    $this->load->model("survey_model");
  }

  private function requiresLogin() {

    if(!$this->user_model->isLoggedIn()) {
      redirect("admin/login", "redirect");
    }
  }

  public function login()
  {
    // check if an admin user exists
    if($this->user_model->getUserCount() == 0) {
       redirect("/admin/signup", "refresh");
    }

    $data = "";
    // if the form was submitted, validate all data
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

      $loginResult = $this->user_model->login();
      if($loginResult["success"]) {
        redirect("/admin/dashboard", "refresh"); // user successfully created
      }
      else {
        $data["errors"] = $loginResult["errors"];
      }
    }

    $this->load->view('templates/admin/header');
    $this->load->view('templates/admin/login', $data);
    $this->load->view('templates/admin/footer');
  }

  public function logout() {
    $this->user_model->logout();
    redirect("admin/login", "refresh");
  }

  public function signup() {

    // check if a user exists (only allow one user, for now)
    if($this->user_model->getUserCount() > 0) {
       redirect("/admin/login", "refresh");
    }

    $data = "";
    // if the form was submitted, validate all data
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

      $addUserResult = $this->user_model->addUser();
      if($addUserResult["success"]) {
        redirect("/admin/login", "refresh"); // user successfully created
      }
      else {
        $data["errors"] = $addUserResult["errors"];
      }
    }

    $this->load->view('templates/admin/header');
    $this->load->view('templates/admin/signup', $data);
    $this->load->view('templates/admin/footer');
  }

  public function dashboard() {

    $this->requiresLogin();

    $data["user"] = array("email" => $this->session->userdata("email"));
    $data["active_surveys"] = $this->survey_model->getActiveSurveys();
    $this->load->view('templates/admin/header');
    $this->load->view('templates/admin/nav', $data);
    $this->load->view('templates/admin/dashboard', $data);
    $this->load->view('templates/admin/footer');
  }
}