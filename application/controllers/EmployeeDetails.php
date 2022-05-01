<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeDetails extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }


    public function getDetails()
    {
        $response = $this->Employee_model->getEmployeeDetails(
            $this->input->get('sevarth_id'),
        );

        if ($response['result']) {
            sendSuccess($response['data']);
        } else {
            sendError($response['message']);
        }
    }

    public function postDetails()
    {
        $response = $this->Employee_model->addEmployeeDetails(
            $this->input->post('name')
        );
        if ($response['result']) {
            sendSuccess($response['data']);
        } else {
            sendError($response['message']);
        }
    }
}
