<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth_model extends CI_Model
{
    //employee login
    public function loginUser(
        $email,
        $password
    ) {
        $isEmailExists = $this->checkEmailAlreadyExist($email);

        //email-id exists in database
        if ($isEmailExists) {

            $user = $this->getEmployeeByEmail($email);

            //if user password is correct
            if ($password == $user->password) {
                return array(
                    "result" => true,
                    "data" => $user,
                );
            }
            //user password  is incorrect
            else {
                return array(
                    "result" => false,
                    "message" => "Incorrect Password",
                );
            }
        }
        //Email-id Does not exist in Database
        else {
            return array(
                "result" => false,
                "message" => "email-id does not exist",
            );
        }
    }


    //Register Api
    public function register()
    {
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');
    }

    //return true if phone number exist in database
    public function checkEmailAlreadyExist($email)
    {
        //return the row of which have same email id
        $emailCountsInDatabase = $this->db->where("email", $email)->get("employees")->num_rows();

        if ($emailCountsInDatabase == 1) {
            return true;
        }

        return false;
    }

    public function get_fp_question($email)
    {
        $isEmailExists = $this->checkEmailAlreadyExist($email);

        if ($isEmailExists) {
            $user = $this->getEmployeeByEmail($email);
            return $user->hint_question;
        } else {
            return false;
        }
    }
    public function check_answer($email, $answer)
    {
        $user = $this->getEmployeeByEmail($email);
        if ($user->hint_answer == $answer) {
            return "true";
        } else {
            return "false";
        }
    }

    public function reset_pass($email, $pass)
    {
        $query = "UPDATE employees SET password='$pass' WHERE email='$email'";
        $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

        // return $this->db->where("email", $email)->update("employees", array("password" => $pass));
    }
    //returns user on basis of email
    public function getEmployeeByEmail($email)
    {
        return $this->db->where("email", $email)->get('employees')->result()[0];
    }


    public function getOrganization()
    {
        $query = "SELECT * FROM organization";
        $events = $this->db->query($query)->result_array();
        return $events;
    }

    public function get_hod($org_id, $dept_id)
    {
        $cond_hod = array(
            'org_id' => $org_id,
            'dept_id' => $dept_id,
            'is_verified' => 1,
            'role_id' => 2, // role_id 2 is id for hod
        );

        //if hod is exists and verified
        if ($this->db->where($cond_hod)->get('employees')->num_rows() > 0) {
            $hod = $this->db->where($cond_hod)->get('employees')->result()[0];
            return array(
                'result' => true,
                'id' => $hod->sevarth_id,
            );
        } else {
            //if hod and principle are not register then show error msg
            return array(
                'result' => false,
                'error' => "Contact your Hod to register",
            );
        }
    }

    public function get_principle($org_id)
    {
        $cond_principle = array(
            'org_id' => $org_id,
            'is_verified' => 1,
            'role_id' => 3, // role_id 2 is id for principle
        );

        if ($this->db->where($cond_principle)->get('employees')->num_rows() > 0) {
            $principle = $this->db->where($cond_principle)->get('employees')->result()[0];
            return array(
                'result' => true,
                'id' => $principle->sevarth_id,
            );
        } else {
            //if hod and principle are not register then show error msg
            return array(
                'result' => true,
                'id' => "-1",
            );
        }
    }
    public function get_director($org_id)
    {
        $cond_director = array(
            'org_id' => $org_id,
            'is_verified' => 1,
            'role_id' => 6, // role_id 6 is id for director
        );

        if ($this->db->where($cond_director)->get('employees')->num_rows() > 0) {
            $director = $this->db->where($cond_director)->get('employees')->result()[0];
            return array(
                'result' => true,
                'id' => $director->sevarth_id,
            );
        } else {
            //if hod and director are not register then show error msg
            return array(
                'result' => true,
                'id' => "-1",
            );
        }
    }

    public function getDepartment()
    {
        $query = "SELECT * FROM departments";
        $dept = $this->db->query($query)->result_array();
        return $dept;
    }

    public function getRole()
    {
        $query = "SELECT * FROM role";
        $role = $this->db->query($query)->result_array();
        return $role;
    }

    public function addDetails($formArray, $role_id)
    {

        $this->db->insert('employees_details', $formArray, $role_id);

        if ($role_id == 1) {
            redirect('home/HomeController/employee');
        } else if ($role_id == 2) {
            redirect('home/HomeController/hod');
        } else if ($role_id == 3) {
            redirect('home/HomeController/principal');
        }

        // if a user created account successfully
        return $this->db->insert_id();
    }

    public function check_auth_key($auth_key)
    {
        return $this->db->where('value', $auth_key)->get('auth_key')->num_rows() > 0;
    }
    public function create($loginArray)
    {

        $this->db->insert('employees', $loginArray);

        // if a user created account successfully
        return $this->db->insert_id();
    }
    public function editDetails($formArray, $sevarth_id)
    {

        $this->db->where("sevarth_id", $sevarth_id)->update('employees_details', $formArray);
        return $this->db->affected_rows();
    }
}
