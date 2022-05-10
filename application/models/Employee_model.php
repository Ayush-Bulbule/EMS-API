<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Employee_model extends CI_Model
{


    //employee login
    public function getEmployeeDetails($sevarth_id)
    {
        $isSIdExists = $this->checkSevarthIdExist($sevarth_id);

        //email-id exists in database
        $user = $this->getEmployeeBySid($sevarth_id);
        if ($isSIdExists) {
            // echo $sevarth_id;
            // echo json_encode($user);
            return array(
                "result" => true,
                "message" => "employee fetched",
                "data" => $user,
            );
        }
        //Sevarth-id Does not exist in Database
        else {
            return array(
                "result" => false,
                "message" => "s-id does not exist $sevarth_id",
                "error" => true
            );
        }
    }

    //POST: Adding Employee to the Database
    // public function addEmployeeDetails($sevarth_id, $data)
    // {
    //     $isSIdExists = $this->checkSevarthIdExist($sevarth_id);

    //     //email-id exists in database
    //     if ($isSIdExists) {
    //         return $this->db->where("sevarth_id", $sevarth_id)->insert(3);

    //         return array(
    //             "result" => true,
    //             "message" => "Employee details added!",

    //         );
    //     }
    //     //Sevarth-id Does not exist in Database
    //     else {
    //         return array(
    //             "result" => false,
    //             "message" => "s-id does not exist $sevarth_id",
    //             "error" => true
    //         );
    //     }
    // }

    //return true if phone number exist in database
    private function checkSevarthIdExist($sevarth_id)
    {
        //return the row of which have same email id
        $sevarthIdCountsInDatabase = $this->db->where("sevarth_id", $sevarth_id)->get('employees_details')->num_rows();
        if ($sevarthIdCountsInDatabase == 1) {
            return true;
        }
        return false;
    }

    //returns user on basis of email
    public function getEmployeeBySid($sevarth_id)
    {
        return $this->db->where("sevarth_id", $sevarth_id)->get('employees_details')->result()[0];
    }

    public function addEmployeeDetails($detailsArray)
    {
        $this->db->insert('employees_details', $detailsArray);
        // if a user created account successfully
        return $this->db->insert_id();
    }
}
