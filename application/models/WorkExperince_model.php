<?php
class WorkExperince_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function add($id)
    {
        $data=array(
            'emp_name'=>$this->input->post('employer_name'),
            'auth_id'=>$id,
            'type'=>$this->input->post('employer_type'),
            'from'=>$this->input->post('from'),
            'to'=>$this->input->post('to'),
            'designation'=>$this->input->post('designation'),
            'job_profile'=>$this->input->post('job_profile'),
            'notice_period'=>$this->input->post('notice_period'),
        );
        return $this->db->insert('work_exp',$data);
    }
    
    
}