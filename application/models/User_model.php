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

    public function getTM($tm_id = 0, $div_id = 0, $zone_id = 0, $region_id = 0, $area_id = 0, $ter_id = 0) {
        $this->db->select('*');

        if (isset($div_id) && $div_id > 0) {
            $this->db->from('tm');
            $this->db->join('division d', 'd.div_id = tm.div_id');
            $this->db->where('d.div_id', $div_id);
        } elseif (isset($zone_id) && $zone_id > 0) {
            $this->db->from('zone z');
            $this->db->join('region r', 'r.zone_id = z.zone_id');
            $this->db->join('area a', 'a.region_id = r.region_id');
            $this->db->join('territory t', 't.area_id = a.area_id');
            $this->db->join('tm', 'tm.ter_id = t.ter_id');
            $this->db->where('z.zone_id', $zone_id);
        } elseif (isset($region_id) && $region_id > 0) {
            $this->db->from('region r');
            $this->db->join('area a', 'a.region_id = r.region_id');
            $this->db->join('territory t', 't.area_id = a.area_id');
            $this->db->join('tm', 'tm.ter_id = t.ter_id');
            $this->db->where('r.region_id', $region_id);
        } elseif (isset($area_id) && $area_id > 0) {
            $this->db->from('area a');
            $this->db->join('territory t', 't.area_id = a.area_id');
            $this->db->join('tm', 'tm.ter_id = t.ter_id');
            $this->db->where('a.area_id', $area_id);
        } elseif (isset($ter_id) && $ter_id > 0) {
            $this->db->from('territory t');
            $this->db->join('tm', 'tm.ter_id = t.ter_id');
            $this->db->where('t.ter_id', $ter_id);
        } elseif (isset($tm_id) && $tm_id > 0) {
            $this->db->from('tm');
            $this->db->where('tm.tm_id', $tm_id);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getDTM($dtm_id = 0, $div_id = 0, $zone_id = 0, $area_id = 0) {
        $this->db->select('*');
        if (isset($div_id) && $div_id > 0) {
            $this->db->from('dtm');
            $this->db->join('division d', 'd.div_id = dtm.div_id');
            $this->db->where('d.div_id', $div_id);
        } elseif (isset($zone_id) && $zone_id > 0) {
            $this->db->from('zone z');
            $this->db->join('region r', 'r.zone_id = z.zone_id');
            $this->db->join('area a', 'a.region_id = r.region_id');
            $this->db->join('dtm', 'dtm.area_id = a.area_id');
            $this->db->where('z.zone_id', $zone_id);
        } elseif (isset($region_id) && $region_id > 0) {
            $this->db->from('region r');
            $this->db->join('area a', 'a.region_id = r.region_id');
            $this->db->join('dtm', 'dtm.area_id = a.area_id');
            $this->db->where('r.region_id', $region_id);
        } elseif (isset($area_id) && $area_id > 0) {
            $this->db->from('area a');
            $this->db->join('dtm', 'dtm.area_id = a.area_id');
            $this->db->where('a.area_id', $area_id);
        } elseif (isset($dtm_id) && $tm_id > 0) {
            $this->db->from('dtm');
            $this->db->where('dtm.dtm_id', $dtm_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getRSM($rsm_id = 0, $div_id = 0, $zone_id = 0, $region_id = 0) {
        $this->db->select('*');
        if (isset($div_id) && $div_id > 0) {
            $this->db->from('rsm');
            $this->db->join('division d', 'd.div_id = rsm.div_id');
            $this->db->where('d.div_id', $div_id);
        } elseif (isset($zone_id) && $zone_id > 0) {
            $this->db->from('zone z');
            $this->db->join('region r', 'r.zone_id = z.zone_id');
            $this->db->join('rsm', 'rsm.region_id = r.region_id');
            $this->db->where('z.zone_id', $zone_id);
        } elseif (isset($region_id) && $region_id > 0) {
            $this->db->from('region r');
            $this->db->join('rsm', 'rsm.region_id = r.region_id');
            $this->db->where('r.region_id', $region_id);
        } elseif (isset($zsm_id) && $zsm_id > 0) {
            $this->db->from('rsm');
            $this->db->where('rsm.rsm_id', $rsm_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getZSM($zsm_id = 0, $div_id = 0, $zone_id = 0) {
        $this->db->select('*');
        if (isset($div_id) && $div_id > 0) {
            $this->db->from('zsm');
            $this->db->join('division d', 'd.div_id = zsm.div_id');
            $this->db->where('d.div_id', $div_id);
        } elseif (isset($zone_id) && $zone_id > 0) {
            $this->db->from('zone z');
            $this->db->join('zsm', 'zsm.zone_id = z.zone_id');
            $this->db->where('z.zone_id', $zone_id);
        } elseif (isset($zsm_id) && $zsm_id > 0) {
            $this->db->from('zsm');
            $this->db->where('zsm.rsm_id', $zsm_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

}
