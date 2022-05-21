<?php
class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_roles_for_verification()
    {

        $this->db->where('is_verified', 0);

        return $this->db->get('employees')->result_array();
    }

    public function accept_role_request($principle_id)
    {
        $condition = array('is_verified' => "1");
        $this->db->where("sevarth_id", $principle_id)->update('employees', $condition);
    }

    public function decline_role_request($principle_id)
    {
        $condition = array('is_verified' => "-1");
        $this->db->where("sevarth_id", $principle_id)->update('employees', $condition);
    }

    public function get_employees($director_id)
    {
        return $this->db->get('employees')->result_array();
    }

    public function delete_employee($emp_id)
    {
        $this->db->where('sevarth_id', $emp_id)->delete('employees');
    }

    //hod

    public function get_hod_employees_for_verification($hod_id)
    {
        $condition = array(
            'is_verified' => 0,
            'hod_id' => $hod_id,
            'role_id' => 1, //role id for employee
        );
        return $this->db->where($condition)->get('employees')->result_array();
    }

    public function get_hod_employees($hod_id)
    {
        // Hod show can only verify employees under his department
        $condition = array(
            'hod_id' => $hod_id,
            'role_id' => 1, //role id for employee
        );

        return $this->db->where($condition)->get('employees')->result_array();
    }

    // public function delete_employee($emp_id)
    // {
    //     $this->db->where('sevarth_id', $emp_id)->delete('employees');
    // }

    // public function get_employee_details($employee_id)
    // {
    //     $condition = array(
    //         'sevarth_id' => $employee_id,
    //     );

    //     //check number of rows of employee
    //     if ($this->db->where($condition)->get('employees_details')->num_rows() > 0) {
    //         return array(
    //             'result' => true,
    //             'data' => $this->db->where($condition)->get('employees_details')->result()[0],
    //         );
    //     } else {
    //         return array(
    //             'result' => false,
    //             'error' => 'Employee Details Does Not Exists',

    //         );
    //     }
    // }

    public function accept_hod_employee_request($employee_id)
    {
        $condition = array('is_verified' => "1");
        $this->db->where("sevarth_id", $employee_id)->update('employees', $condition);
    }

    public function decline_employee_request($employee_id)
    {
        $condition = array('is_verified' => "-1");
        $this->db->where("sevarth_id", $employee_id)->update('employees', $condition);
    }
}
