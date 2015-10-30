<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    /**
     * returns doctor list
     * 
     * param int
     * param int
     * param int
     * param int
     */
    function doctors_get() {
        $fields = array('tm_id', 'ter_id', 'patch_id', 'div_id');
        foreach ($fields as $item) {
            ${$item} = !$this->get($item) ? 0 : $this->get($item);
        }

        $this->load->model('Doctor_model');

        $doctors = $this->Doctor_model->getDoctor($tm_id, $ter_id, $patch_id, $div_id);

        if ($doctors) {
            $this->response($doctors, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Doctor Details Not Found'), 404);
        }
    }

    function activity_post() {
        $this->load->model('Activity_model');
        $act_id = $this->Activity_model->add();

        if ($act_id) {
            $this->response($act_id, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Something went wrong'), 404);
        }
    }

    function addProductActivity_post() {
        $this->load->model('Activity_model');
        $act_id = $this->Activity_model->addProductActivity();
        if ($act_id) {
            $this->response($act_id, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Something went wrong'), 404);
        }
    }

    function addGpiDistribution_post() {
        $this->load->model('Activity_model');
        $act_id = $this->Activity_model->addGpiDistribution();
        if ($act_id) {
            $this->response($act_id, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Something went wrong'), 404);
        }
    }
    
    function addJointWork_post() {
        $this->load->model('Activity_model');
        $act_id = $this->Activity_model->addJointWork();
        if ($act_id) {
            $this->response($act_id, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Something went wrong'), 404);
        }
    }

    function addNonCallAct_post() {
        $this->load->model('Activity_model');
        $act_id = $this->Activity_model->addNonCallAct();
        if ($act_id) {
            $this->response($act_id, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Something went wrong'), 404);
        }
    }
}
