<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function authenticate($type = 'abstract') {

        $this->form_validation->set_rules('repname', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');

        if ($this->form_validation->run() === TRUE) {
            $conditions = array(
                'password' => $this->input->post('password'),
                'repname' => $this->input->post('repname'),
                'status' => $this->input->post('Active'),
            );
            $query = $this->db->get_where($type, $conditions);
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

}
