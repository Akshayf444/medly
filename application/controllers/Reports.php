<?php

class Reports extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function doctorList() {
        if ($this->is_logged_in()) {
            $this->load->model('Master_model');
            $data = array();
            $data['BU'] = $this->getCurrentBU();
            $data['level'] = $this->getCurrentLevel();
            $view = array('title' => 'Doctor List', 'content' => 'Reports/doctorlist', 'view_data' => $data);
            $this->load->view('template1', $view);
        } else {
            $this->logout();
        }
    }

    function getArea() {
        
    }

    function getZone() {
        
    }

    function getRegion() {
        
    }

    function getTerritory() {
        
    }

    function processLocationRequest() {
        if ($this->input->get('level') && $this->input->get('level_up')) {
            if ($this->input->get('level') == 5) {
                $this->load->model('Master_model');
                echo $this->Master_model->generateDropdown($this->Master_model->listTerritory(0, $this->input->get('level_up')), 'ter_id', 'ter_name');
            }
        }
    }

    function getCurrentLevel() {
        return $this->Master_model->generateDropdown($this->Master_model->listLevel($this->level), 'id', 'level');
    }

    function getCurrentBU() {
        $level = (int) $this->session->userdata('level');
        if ($level > 5) {
            return $this->Master_model->generateDropdown($this->Master_model->listDivision(), 'div_id', 'div_name');
        } else {
            return $this->Master_model->generateDropdown($this->Master_model->listDivision($this->div_id), 'div_id', 'div_name');
        }
    }

    function getTM() {
        $this->load->model('User_model');
        $this->load->model('Master_model');
        if ($this->input->get('ter_id') > 0) {
            echo $this->Master_model->generateDropdown($this->User_model->getTM(0, 0, 0, 0, 0, $this->input->get('ter_id')), 'tm_id', 'repname');
        }
    }

    function getDoctor() {
        $this->load->model('Doctor_model');
        if ($this->input->get('tm_id') > 0) {
            var_dump($this->Doctor_model->getDoctor($this->input->get('tm_id')));
        }
    }

}
