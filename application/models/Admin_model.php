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
}
