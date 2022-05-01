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

    //return true if phone number exist in database
    private function checkEmailAlreadyExist($email)
    {

        //return the row of which have same email id
        $emailCountsInDatabase = $this->db->where("email", $email)->get("employees")->num_rows();

        if ($emailCountsInDatabase == 1) {
            return true;
        }

        return false;
    }
    //returns user on basis of email
    public function getEmployeeByEmail($email)
    {
        return $this->db->where("email", $email)->get('employees')->result()[0];
    }

    public function forgot_password($data)
    {
        $res = $this->db->insert('forgot_password', $data);
        if ($res) {
            return array(
                "result" => true,
                "message" => "Question Set Successfully!",
            );
        } else {
            return array(
                "result" => false,
                "message" => "ERROR",
            );
        }

        // return true;
    }
}
