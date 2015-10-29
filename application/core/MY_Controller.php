<?php

class MY_Controller extends CI_Controller {

    protected $user_id;
    protected $user_type;
    protected $level;
    protected $repname;
    protected $repcode;
    protected $div_id;

    function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->level = $this->session->userdata('level');
        $this->repname = $this->session->userdata('repname');
        $this->repcode = $this->session->userdata('repcode');
        $this->div_id = $this->session->userdata('div_id');
    }

    function is_logged_in() {
        if (!is_null($this->user_id) && $this->user_id > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('repname');
        $this->session->unset_userdata('repcode');
        $this->session->unset_userdata('div_id');
        redirect('User/login', 'refresh');
    }

}