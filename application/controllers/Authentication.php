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

        //check email
        $email = $this->input->post('email');
        $password = $this->input->post('password');


        $data = $this->Auth_model->loginUser(
            $this->input->post('email'),
            $this->input->post('password'),
        );


        // sendSuccess($data);

        if ($data['result']) {
            sendSuccess($data['data']);
        } else {
            sendError($data['message']);
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
        // echo "Hello";
        if ($response) {
            sendSuccess(array("status" => $response));
        } else {
            //Email Does Not Exists
            sendSuccess(array("status" => $response));
        }
    }

    public function validate_answer()
    {
        $answer = $this->input->post("answer");
        $email = $this->input->post("email");
        // sendSuccess(array("status" => $email));


        $response = $this->Auth_model->check_answer($email, $answer);

        if ($response) {
            sendSuccess(array("status" => $response));
        } else {
            //Email Does Not Exists
            sendSuccess(array("status" => $response));
        }
    }

    public function reset_password()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");


        $response = $this->Auth_model->reset_pass($email, $password);
        if ($response) {
            sendSuccess(array("status" => "true"));
        } else {
            //Email Does Not Exists
            sendSuccess(array("status" => "false"));
        }
    }

    public function get_organization()
    {
        $events = $this->Auth_model->getOrganization();
        sendSuccess($events);
    }
    public function get_department()
    {
        $dept = $this->Auth_model->getDepartment();

        sendSuccess($dept);
    }
    public function get_role()
    {
        $role = $this->Auth_model->getRole();
        sendSuccess($role);
    }


    public function register_user()
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



        //if employee
        if ($role_id == 1 or $role_id == 2) {

            if ($hod_response['result'] == false) {
                sendError("HOD not found");
            } else if ($principle_response['result'] == false) {
                sendError("Principle not found");
            } else if ($director_response['result'] == false) {
                sendError("Director not found");
            } else {
                $loginArray['hod_id'] = $hod_response['id'];

                if ($role_id == 2) {
                    $loginArray['hod_id'] = -1;
                }

                $loginArray['principle_id'] = $principle_response['id'];
                $loginArray['director_id'] = $director_response['id'];

                sendSuccess(array("status" => $this->Auth_model->create($loginArray)));
            }
        } else {

            $loginArray['hod_id'] = -1;
            $loginArray['principle_id'] = -1;

            $this->Auth_model->create($loginArray);
            sendSuccess(array("status" => ""));
        }
    }


    public function check_key()
    {
        $key = $this->input->post('key');
        // sendError($key);
        if ($this->Auth_model->check_auth_key($key) == false) {
            sendSuccess(array('status' => 'false'));
        } else {
            sendSuccess(array('status' => 'true'));
        }
    }
}
