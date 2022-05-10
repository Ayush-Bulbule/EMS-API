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

    public function add_details()
    {

        $sevarth_id = $this->input->post('sevarth_id');
        $first_name = $this->input->post('first_name');
        $middle_name = $this->input->post('middle_name');
        $last_name = $this->input->post('last_name');
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $qualification = $this->input->post('qualification');
        $cast = $this->input->post('cast');
        $subcast = $this->input->post('subcast');
        $designation = $this->input->post('designation');
        $retirement_date = $this->input->post('retirement_date');
        $experience = $this->input->post('experience');
        $aadhar_no = $this->input->post('aadhar_no');
        $pan_no = $this->input->post('pan_no');
        $blood_grp = $this->input->post('blood_grp');
        $identification_mark = $this->input->post('identification_mark');
        $contact_no = $this->input->post('contact_no');
        $address = $this->input->post('address');
        $alternative_contact_no = $this->input->post('alternative_contact_no');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $pin_code = $this->input->post('pin_code');
        $state = $this->input->post('state');
        $country = $this->input->post('country');

        $detailsArray = array(
            'sevarth_id' => $sevarth_id,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'dob' => $dob,
            'qualification' => $qualification,
            'cast' => $cast,
            'subcast' => $subcast,
            'designation' => $designation,
            'retirement_date' => $retirement_date,
            'experience' => $experience,
            'aadhar_no' => $aadhar_no,
            'pan_no' => $pan_no,
            'blood_grp' => $blood_grp,
            'identification_mark' => $identification_mark,
            'contact_no' => $contact_no,
            'address' => $address,
            'alternative_contact_no' => $alternative_contact_no,
            'city' => $city,
            'pin_code' => $pin_code,
            'state' => $state,
            'country' => $country,
            'gender' => $gender

        );


        $this->Employee_model->addEmployeeDetails($detailsArray);
        sendSuccess(array("status" => "true"));
    }
}
