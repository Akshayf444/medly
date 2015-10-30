<?php

class Doctor_model extends CI_Model {

    /**
     * getDoctor Selects doctor from database
     * @param int $patch_id : town id
     * @param int $ter_id : territory id
     * @param int $tm_id 
     * @param int $div_id : division id
     * @return array of object
     * 
     */
    function getDoctor($tm_id = 0, $ter_id = 0, $patch_id = 0, $div_id = 0) {
        $this->db->select('d.*');
        $this->db->from('doctor d');

        if (isset($patch_id) && $patch_id > 0) {
            $this->db->join('town t', 'd.patch_id = t.town_id', 'left');
            $this->db->where('d.patch_id ', $patch_id);
        }
        if (isset($ter_id) && $ter_id > 0) {
            $this->db->join('territory ter', 'ter.ter_id = d.ter_id', 'left');
            $this->db->where('d.ter_id ', $ter_id);
        }
        if (isset($tm_id) && $tm_id > 0) {
            $this->db->join('tm', 'tm.tm_id = d.tm_id');
            $this->db->where('d.tm_id ', $tm_id);
        }
        if (isset($div_id) && $div_id > 0) {
            $this->db->join('division dv', 'dv.div_id = d.div_id', 'left');
            $this->db->where('d.div_id ', $div_id);
        }


        $query = $this->db->get();
        return $query->result();
    }

}
