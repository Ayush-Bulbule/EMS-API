<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); //important to call parent constructor
        $this->load->model('Admin_model');
    }


    public function show_verifications()
    {
        $principle_for_verification_from_admin = $this->Admin_model->get_roles_for_verification();



        sendSuccess($principle_for_verification_from_admin);
    }

    public function accept_principle_request()
    {
        $employee_id = $this->input->post('employee_id');
        $this->Admin_model->accept_role_request($employee_id);

        sendSuccess(array('status' => "true"));
    }
    public function decline_principle_request()
    {
        $employee_id = $this->input->post('employee_id');
        $this->Admin_model->decline_role_request($employee_id);

        sendSuccess(array('status' => "true"));
    }

    public function delete_employee()
    {
        $employee_id = $this->input->post('employee_id');

        $this->Admin_model->delete($employee_id);
        sendSuccess(array('status' => "true"));
    }

    public function show_employees()
    {
        $sevarth_id = $this->session->userdata('user_id');
        $employees = $this->Admin_model->get_employees($sevarth_id);

        sendSuccess($employees);
    }
}
