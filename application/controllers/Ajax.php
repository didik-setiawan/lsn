<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax extends CI_Controller {
    public function get_data_role_user(){
        validation_ajax_request();
        $data = [
            'data' => $this->m->get_role_user()->result()
        ];
        $this->load->view('ajax/master/role_user', $data);
    }

    public function get_data_menu(){
        validation_ajax_request();
        $data = [
            'data' => $this->m->get_menu()->result()
        ];
        $this->load->view('ajax/master/menu', $data);
    }
}