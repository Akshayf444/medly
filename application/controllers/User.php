<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        $data = array();
        if ($this->input->post()) {
            $result = $this->User_model->authenticate('tm');
            // var_dump($result);
            if (!empty($result)) {
                $this->session->set_userdata("repname", $result['repname']);
                $this->session->set_userdata("repcode", $result['repcode']);
                $this->session->set_userdata("level", '5');
                $this->session->set_userdata("user_id", $result['tm_id']);
                $this->session->set_userdata("div_id", $result['div_id']);
                $this->session->set_userdata("user_type", 'tm');
                redirect('User/dashboard', 'refresh');
            } else {
                $result = $this->User_model->authenticate('dtm');
                if (!empty($result)) {
                    $this->session->set_userdata("repname", $result['repname']);
                    $this->session->set_userdata("repcode", $result['repcode']);
                    $this->session->set_userdata("level", '4');
                    $this->session->set_userdata("user_id", $result['dtm_id']);
                    $this->session->set_userdata("user_type", 'dtm');
                    $this->session->set_userdata("div_id", $result['div_id']);
                    redirect('User/dashboard', 'refresh');
                } else {
                    $result = $this->User_model->authenticate('rsm');
                    if (!empty($result)) {
                        $this->session->set_userdata("repname", $result['repname']);
                        $this->session->set_userdata("repcode", $result['repcode']);
                        $this->session->set_userdata("level", '3');
                        $this->session->set_userdata("user_id", $result['rsm_id']);
                        $this->session->set_userdata("user_type", 'rsm');
                        $this->session->set_userdata("div_id", $result['div_id']);
                        redirect('User/dashboard', 'refresh');
                    } else {
                        $result = $this->User_model->authenticate('zsm');
                        if (!empty($result)) {
                            $this->session->set_userdata("repname", $result['repname']);
                            $this->session->set_userdata("repcode", $result['repcode']);
                            $this->session->set_userdata("level", '2');
                            $this->session->set_userdata("user_id", $result['zsm_id']);
                            $this->session->set_userdata("user_type", 'zsm');
                            $this->session->set_userdata("div_id", $result['div_id']);
                            redirect('User/dashboard', 'refresh');
                        } else {
                            $data['error'] = 'Invalid username Or Password';
                        }
                    }
                }
            }
        }

        $view = array('title' => 'Login', 'content' => 'User/login', 'view_data' => $data);
        $this->load->view('template2', $view);
    }

    function dashboard() {
        if ($this->is_logged_in()) {
            $data['sessiondump'] = $this->session->all_userdata();
            $view = array('title' => 'Home', 'content' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template1', $view);
        } else {
            $this->logout();
        }
    }

}
