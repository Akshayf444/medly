<?php

class Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Master_model');
    }

    function index() {
        redirect(site_url('Master/viewLocation'), 'refresh');
        $this->viewLocation();
    }

    function viewLocation() {
        $data = array();
        $data['BU'] = $this->Master_model->getBU();
        $data['parent_level'] = $this->Master_model->getParentLevel();

        $view = array('title' => 'View Location', 'content' => 'Master/viewLocation', 'view_data' => $data);
        $this->load->view('template1', $view);
    }

    function processRequest() {
        $result = '';
        $level = $this->input->get("level");
        $level_up_id = $this->input->get("level_up");
        $result = '';
        if (isset($level) && $level != '') {
            $result = $this->Master_model->getParentLocation($level, $level_up_id);
        }

        echo $result;
    }

    function processLocationViewRequest() {
        $level = $this->input->get("level");
        $level_up_id = $this->input->get("level_up");
        $level_up_up = $this->input->get("level_up_up");
        $table = '<a onclick="">Back</a>';
        ?>
        <table cellpadding="0" cellspacing="0" border="0"><tr class="HeadingRow"><td class="SelectorCell">
                <td>Level</td><td>Location</td><td>Parent Location</td><td>User</td><td>BU</td></tr> <?php
            if ($level != '' && $level_up_id != '' && $level_up_up != '') {
                if ($level == 1) {
                    $result = $this->Master_model->listZone($level_up_id);
                    if (!empty($result)) {
                        foreach ($result as $item) {
                            $nextPageUrl = site_url() . '/Master/processLocationViewRequest';
                            ?>
                            <tr>
                                <td class="SelectorCell">
                                <td>Zone</td><td>
                                    <a href="#" onclick="sendRequest('level=<?php echo $level + 1; ?>&level_up=<?php echo $level_up_id; ?>&level_up_up=<?php echo $item->zonal_id; ?>', '#loadingarea', '<?php echo $nextPageUrl; ?>')"><?php echo $item->zone_name ?></a>
                                </td>
                                <td></td>
                                <td><?php echo $item->repname ?></td>
                                <td><?php echo $item->div_name ?></td>
                            </tr>
                            <?php
                        }
                    }
                } elseif ($level == 2) {
                    $result = $this->Master_model->listRegion($level_up_up, 0);
                    if (!empty($result)) {
                        foreach ($result as $item) {
                            $nextPageUrl = site_url() . '/Master/processLocationViewRequest';
                            ?>
                            <tr>
                                <td class="SelectorCell">
                                <td>Zone</td><td>
                                    <a href="#" onclick="sendRequest('level=<?php echo $level + 1; ?>&level_up=<?php echo $level_up_id; ?>&level_up_up=<?php echo $item->regional_id; ?>', '#loadingarea', '<?php echo $nextPageUrl; ?>')"><?php echo $item->region_name ?></a>
                                </td>
                                <td></td>
                                <td><?php echo $item->repname ?></td>
                                <td><?php echo $item->div_name ?></td>
                            </tr>
                            <?php
                        }
                    }
                } elseif ($level == 3) {
                    $result = $this->Master_model->listArea($level_up_up, 0);
                    if (!empty($result)) {
                        foreach ($result as $item) {
                            $nextPageUrl = site_url() . '/Master/processLocationViewRequest';
                            ?>
                            <tr>
                                <td class="SelectorCell">
                                <td>Zone</td><td>
                                    <a href="#" onclick="sendRequest('level=<?php echo $level + 1; ?>&level_up=<?php echo $level_up_id; ?>&level_up_up=<?php echo $item->arial_id; ?>', '#loadingarea', '<?php echo $nextPageUrl; ?>')"><?php echo $item->area_name ?></a>
                                </td>
                                <td></td>
                                <td><?php echo $item->repname ?></td>
                                <td><?php echo $item->div_name ?></td>
                            </tr>
                            <?php
                        }
                    }
                } elseif ($level == 4) {
                    $result = $this->Master_model->listTerritory($level_up_up, 0);
                    if (!empty($result)) {
                        foreach ($result as $item) {
                            $nextPageUrl = site_url() . '/Master/processLocationViewRequest';
                            ?>
                            <tr>
                                <td class="SelectorCell">
                                <td>Zone</td><td>
                                    <a href="#" onclick="sendRequest('level=<?php echo $level + 1; ?>&level_up=<?php echo $level_up_id; ?>&level_up_up=<?php echo $item->ter_id; ?>', '#loadingarea', '<?php echo $nextPageUrl; ?>')"><?php echo $item->ter_name ?></a>
                                </td>
                                <td></td>
                                <td><?php echo $item->repname ?></td>
                                <td><?php echo $item->div_name ?></td>
                            </tr>
                            <?php
                        }
                    }
                } elseif ($level == 5) {
                    $result = $this->Master_model->listTown($level_up_up, 0);
                }

                $table .='<tr><td class="GridFooter" colspan="6"></td></tr></table>';
                echo $table;
            }
        }

        function getLevel() {
            if ($this->level > 5) {
                
            }
        }

    }
    