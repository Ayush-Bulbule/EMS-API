<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }


    public function login()
    {
        $data = $this->Auth_model->loginUser(
            $this->input->post('email'),
            $this->input->post('password'),
        );

        if ($data['result']) {
            sendSuccess(array($data['data']));
        } else {
            sendError(array($data['message']));
        }
    }

    //To check if email exists in database
    public function check_mail_exists()
    {
        $email = $this->input->post('email');
        $response = $this->Auth_model->checkEmailAlreadyExist($email);
        if ($response) {
            sendSuccess($response);
        } else {
            sendError($response);
        }
    }

    //To get forgot password question
    public function get_fp_question()
    {
        $email = $this->input->post('email');
        $response = $this->Auth_model->get_fp_question($email);
        if ($response) {
            sendSuccess(array("question" => $response));
        } else {
            //Email Does Not Exists
            sendError($response);
        }
    }

    public function validate_answer()
    {
        $answer = $this->input->post("answer");
        $email = $this->input->post("email");

        // echo "answer: " . $answer . " email: " . $email;

        $validation = $this->Auth_model->check_answer($email, $answer);

        if ($validation) {
            sendSuccess($validation);
        } else {
            //not validate
            sendError($validation);
        }
    }


    public function register()
    {


        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role_id = $this->input->post('role_id');
        $org_id = $this->input->post('org_id');
        $dept_id = $this->input->post('dept_id');
        $name = $this->input->post('name');
        $sevarth_id = $this->input->post('sevarth_id');
        $hint_question = $this->input->post('hint_question');
        $hint_answer = $this->input->post('hint_answer');
        $hod_response = $this->Auth_model->get_hod($org_id, $dept_id);
        $principle_response = $this->Auth_model->get_principle($org_id);
        $director_response = $this->Auth_model->get_director($org_id);

        $loginArray = array(
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'sevarth_id' => $sevarth_id,
            'role_id' => $role_id,
            'org_id' => $org_id,
            'dept_id' => $dept_id,
            'hint_question' => $hint_question,
            'hint_answer' => $hint_answer,
        );
    }
}
