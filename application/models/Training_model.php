<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Training_model extends CI_Model
{

    public function get_hod_by_department_organization($department_id, $organization_id)
    {
        $condition = array(
            'dept_id' => $department_id,
            'org_id' => $organization_id,
            'role_id' => 2, // role id of hod
        );

        $hod_id = (array) $this->db->where($condition)->get('employees')->result()[0];

        return $hod_id['sevarth_id'];
    }

    public function get_principal_by_organization($department_id, $organization_id)
    {
        $condition = array(
            'dept_id' => $department_id,
            'org_id' => $organization_id,
            'role_id' => 3, // role id of principal
        );

        $hod_id = (array) $this->db->where($condition)->get('employees')->result()[0];

        return $hod_id['sevarth_id'];
    }

    public function save_details(
        $sevarth_id,
        $training_name,
        $duration,
        $start_date,
        $end_date,
        $org_name,
        $organized_by,
        $training_status,
        $hod_id,
        $principal_id) {
        $data = array(
            'sevarth_id' => $sevarth_id,
            'name' => $training_name,
            'duration' => $duration,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'org_name' => $org_name,
            'organized_by' => $organized_by,
            'training_status_id' => $training_status,
            'hod_id' => $hod_id,
            'principal_id' => $principal_id,
        );

        $this->db->insert('training', $data);

        return $this->db->insert_id();
    }

    public function get_training_status($training_id){
        return $this->db->where('id', $training_id)->get('training')->result()[0]->training_status_id;
    }

    public function update_training_status($training_id, $current_training_status){
        $data = array(
            'training_status_id' => $current_training_status + 1,
        );

        $this->db->where('id', $training_id)->update('training', $data);
    }

    public function update_training_application($training_id, $file_name){
        $data = array(
            'apply_letter' => $file_name,
        );

        $this->db->where('id', $training_id)->update('training', $data);
    }
    
    public function update_training_certification($training_id, $file_name){
        $data = array(
            'comp_certificate' => $file_name,
        );

        $this->db->where('id', $training_id)->update('training', $data);
    }
}