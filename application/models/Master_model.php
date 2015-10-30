<?php

class Master_model extends CI_Model {

    function getBU($div_id = 0) {

        $dropdown = '<select id="div_id" class="TextControl"><option value = "" ></option>';
        $result = $this->listDivision();

        if (!empty($result)) {
            foreach ($result as $div) {
                if ($div_id == $div->div_id) {
                    $dropdown .= '<option value="' . $div->div_id . '" selected>' . $div->div_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $div->div_id . '" >' . $div->div_name . '</option>';
                }
            }
        }

        $dropdown .= '</select>';
        return $dropdown;
    }

    function getCountry($con_id = 0, $div_id = 0) {
        $dropdown = '<select id="country" class="TextControl"><option value = "" ></option>';
        $result = $this->listCountry($div_id);
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($con_id == $item->con_id) {
                    $dropdown .= '<option value="' . $item->con_id . '" selected>' . $item->con_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->con_id . '" >' . $item->con_name . '</option>';
                }
            }
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function getZone($zone_id = 0, $con_id = 0, $div_id = 0) {
        $dropdown = '<select id="zone" class="TextControl"><option value = "" ></option>';
        $result = $this->listZone($con_id, $div_id);
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($zone_id == $item->zone_id) {
                    $dropdown .= '<option value="' . $item->zone_id . '" selected>' . $item->zone_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->zone_id . '" >' . $item->zone_name . '</option>';
                }
            }
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function getRegion($region_id = 0, $zone_id = 0, $div_id = 0) {
        $dropdown = '<select id="region" class="TextControl"><option value = "" ></option>';
        $result = $this->listRegion($zone_id, $div_id);
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($region_id == $item->region_id) {
                    $dropdown .= '<option value="' . $item->region_id . '" selected>' . $item->region_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->region_id . '" >' . $item->region_name . '</option>';
                }
            }
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function getArea($area_id = 0, $region_id = 0, $div_id = 0) {
        $dropdown = '<select id="area" class="TextControl"><option value = "" ></option>';

        $result = $this->listArea($region_id, $div_id);
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($area_id == $item->area_id) {
                    $dropdown .= '<option value="' . $item->area_id . '" selected>' . $item->area_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->area_id . '" >' . $item->area_name . '</option>';
                }
            }
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function getTerritory($ter_id = 0, $area_id = 0, $div_id = 0) {
        $dropdown = '<select id="terrtory" class="TextControl"><option value = "" ></option>';
        $result = $this->listTerritory($area_id, $div_id);
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($ter_id == $item->ter_id) {
                    $dropdown .= '<option value="' . $item->ter_id . '" selected>' . $item->ter_name . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->ter_id . '" >' . $item->ter_name . '</option>';
                }
            }
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function getParentLocation($level_type, $level_up_id) {
        $dropdown = '<select id="parentloc" class="TextControl"><option value = "" ></option>';
        if ($level_type == 1) {
            $dropdown = $this->getCountry(0, $level_up_id);
        } elseif ($level_type == 2) {
            $dropdown = $this->getZone(0, 0, $level_up_id);
        } elseif ($level_type == 3) {
            $dropdown = $this->getRegion(0, 0, $level_up_id);
        } elseif ($level_type == 4) {
            $dropdown = $this->getArea(0, 0, $level_up_id);
        } elseif ($level_type == 5) {
            $dropdown = $this->getTerritory(0, 0, $level_up_id);
        }
        return $dropdown;
    }

    function getParentLevel() {
        $dropdown = '<select class="TextControl" id="parent_level">'
                . '<option value = "0" >Select Level</option>'
                . '<option value = "1" >Country</option>'
                . '<option value = "2" >Zone</option>'
                . '<option value = "3" >Region</option>'
                . '<option value = "4" >Area</option>'
                . '<option value = "5" >Territory</option>'
                . '<select>';
        return $dropdown;
    }

    function listDivision($div_id = 0) {
        if (isset($div_id) && $div_id > 0) {
            $this->db->select('*');
            $this->db->from('division');
            $this->db->where('div_id', $div_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get('division');
        }
        return $query->result();
    }

    function listCountry($div_id = 0) {
        if (isset($div_id) && $div_id > 0) {
            $query = $this->db->get_where('country', array('div_id' => $div_id));
        } else {
            $query = $this->db->get('country');
        }

        return $query->result();
    }

    function listZone($con_id = 0, $div_id = 0) {
        $this->db->select('z.*,z.zone_id AS zonal_id,zsm.*');
        $this->db->from('zone z');
        $this->db->join('zsm', 'zsm.zone_id = z.zone_id', 'left');
        if (isset($div_id) && $div_id > 0) {
            $this->db->where('z.div_id', $div_id);
            $query = $this->db->get();
        } elseif (isset($con_id)) {
            $this->db->where('z.country_id', $con_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }
        return $query->result();
    }

    function listRegion($zone_id = 0, $div_id = 0) {
        $this->db->select('rsm.*,r.*,r.region_id AS regional_id');
        $this->db->from('region r');
        $this->db->join('rsm', 'rsm.region_id = r.region_id', 'left');
        if ($div_id > 0) {
            $this->db->where('r.div_id', $div_id);
            $query = $this->db->get();
        } elseif (isset($zone_id) && $zone_id > 0) {
            $this->db->where('r.zone_id', $zone_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }
        return $query->result();
    }

    function listArea($region_id = 0, $div_id = 0) {
        $this->db->select('dtm.*,a.*,a.area_id AS arial_id');
        $this->db->from('area a');
        $this->db->join('dtm', 'dtm.area_id = a.area_id', 'left');
        if ($div_id > 0) {
            $this->db->where('a.div_id', $div_id);
            $query = $this->db->get();
        } elseif (isset($region_id) && $region_id > 0) {
            $this->db->where('a.region_id', $region_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }
        return $query->result();
    }

    function listTerritory($area_id = 0, $div_id = 0) {
        $this->db->select('ter.*,tm.*');
        $this->db->from('territory ter');
        $this->db->join('tm', 'ter.ter_id = tm.ter_id');
        if ($div_id > 0) {
            $this->db->where('ter.div_id', $div_id);
            $query = $this->db->get();
        } elseif (isset($area_id) && $area_id > 0) {
            $this->db->where('ter.area_id', $area_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }
        return $query->result();
    }

    function listTown($ter_id = 0, $div_id = 0) {
        $this->db->select('*');
        $this->db->from('town');
        if ($div_id > 0) {
            $this->db->where('town.div_id', $div_id);
            $query = $this->db->get();
        } elseif (isset($area_id) && $area_id > 0) {
            $this->db->where('town.ter_id', $ter_id);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }
        return $query->result();
    }

    function listLevel($level = 0) {
        $this->db->select('*');
        $this->db->from('level');
        if (isset($level) && $level > 0) {
            $this->db->where('id >=', $level);
        } else {
            $this->db->select('*');
            $this->db->form('level');
        }
        $query = $this->db->get();
        return $query->result();
    }

    function generateDropdown($result, $fieldid, $fieldname, $id = 0) {
        $dropdown = '<select id ="' . $fieldid . '" ><option value="-1" ></option>';
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($id == $item->{$fieldid}) {
                    $dropdown .= '<option value="' . $item->{$fieldid} . '" selected>' . $item->{$fieldname} . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->{$fieldid} . '" >' . $item->{$fieldname} . '</option>';
                }
            }
        }

        $dropdown .= '</select>';
        return $dropdown;
    }

}
