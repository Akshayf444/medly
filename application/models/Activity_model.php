<?php

class Activity_model extends CI_Model {

    function add($type) {
        $field_array = array(
            'tm_id' => $this->input->post('tm_id'),
            'act_type' => $type,
            'doc_id' => $this->input->post('doc_id'),
            'date_met' => date('Y-m-d', strtotime($this->input->post('date_met'))),
            'session' => $this->input->post('session'),
            'patch_id' => $this->input->post('patch_id'),
            'category' => $this->input->post('category'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'synced_at' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('daily_activity', $field_array);
        return $this->db->insert_id();
    }

    function addProductActivity() {
        $act_id = $this->add('DRPP');
        for ($i = 0; $i < count($this->input->post('brand_id')); $i++) {
            $field_array = array(
                'brand_id' => $this->input->post('brand_id')[$i],
                'activity_type' => $this->input->post('activity_type')[$i],
                'act_id' => $act_id,
                'status' => $this->input->post('status')[$i],
                'sq' => $this->input->post('sq')[$i],
                'pob' => $this->input->post('pob')[$i],
            );

            $this->db->insert('product_activity', $field_array);
        }

        return $this->db->insert_id();
    }

    function addGpiDistribution() {
        $act_id = $this->add('DRGP');
        for ($i = 0; $i < count($this->input->post('input_id')); $i++) {
            $field_array = array(
                'input_id' => $this->input->post('input_id')[$i],
                'quantity' => $this->input->post('quantity')[$i],
                'act_id' => $act_id,
            );
            $this->db->insert('gpi_distribution', $field_array);
        }

        return $this->db->insert_id();
    }

    function addJointWork() {
        $act_id = $this->add('JJW');
        for ($i = 0; $i < count($this->input->post('name')); $i++) {
            $field_array = array(
                'name' => $this->input->post('name')[$i],
                'person_type' => $this->input->post('person_type')[$i],
                'act_id' => $act_id,
            );
            $this->db->insert('joint_working', $field_array);
        }

        return $this->db->insert_id();
    }

    function addNonCallAct() {
        $act_id = $this->add('NCA');
        for ($i = 0; $i < count($this->input->post('name')); $i++) {
            $field_array = array(
                'nca_type' => $this->input->post('nca_type'),
                'act_date' => $this->input->post('act_date'),
                'half_day' => $this->input->post('half_day'),
                'remark' => $this->input->post('remark'),
                'act_id' => $act_id,
            );
            $this->db->insert('non_call_activity', $field_array);
        }

        return $this->db->insert_id();
    }

}