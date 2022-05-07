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
}
