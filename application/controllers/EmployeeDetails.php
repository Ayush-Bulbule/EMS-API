<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeDetails extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function get_details()
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



    public function edit_details()
    {

        $formArray = array();

        $formArray['first_name'] = $this->input->post('first_name');
        $formArray['middle_name'] = $this->input->post('middle_name');
        $formArray['last_name'] = $this->input->post('last_name');
        $formArray['dob'] = $this->input->post('dob');
        //get id from session

        $sevarth_id = $this->input->post('sevarth_id');
        $formArray['qualification'] = $this->input->post('qualification');
        $formArray['cast'] = $this->input->post('cast');
        $formArray['subcast'] = $this->input->post('subcast');

        $designation_id = $this->input->post('designation');
        $formArray['designation'] = $designation_id;
        $formArray['retirement_date'] = $this->input->post('retirement_date');
        $formArray['experience'] = $this->input->post('experience');
        $formArray['aadhar_no'] = $this->input->post('aadhar_no');
        $formArray['pan_no'] = $this->input->post('pan_no');
        $formArray['blood_grp'] = $this->input->post('blood_grp');
        $formArray['identification_mark'] = $this->input->post('identification_mark');
        $formArray['photo'] = $this->input->post('photo');

        $formArray['contact_no'] = $this->input->post('contact_no');
        $formArray['alternative_contact_no'] = $this->input->post('alternative_contact_no');
        $formArray['address'] = $this->input->post('address');
        $formArray['city'] = $this->input->post('city');
        $formArray['pin_code'] = $this->input->post('pin_code');
        $formArray['state'] = $this->input->post('state');
        $formArray['country'] = $this->input->post('country');
        $formArray['gender'] = $this->input->post('gender');



        $insert_id =  $this->Auth_model->editDetails($formArray, $sevarth_id);
        // if data of employees is edited
        if ($insert_id > 0) {
            sendSuccess(array("status" => "true"));
        } else {
            sendSuccess((array("status" => "false")));
        }
    }
}
