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

    public function get_data_cabang(){
        validation_ajax_request();
        $data = [
            'data' => $this->m->get_cabang()->result()
        ];
        $this->load->view('ajax/master/cabang', $data);
    }

    public function load_data_member(){
        validation_ajax_request();

        if(isset($_POST['provinsi'])){
            $prov = $_POST['provinsi'];
        } else {
            $prov = null;
        }
        if(isset($_POST['kabupaten'])){
            $kab = $_POST['kabupaten'];
        } else {
            $kab = null;
        }
        if(isset($_POST['kecamatan'])){
            $kec = $_POST['kecamatan'];
        } else {
            $kec = null;
        }
        if(isset($_POST['desa'])){
            $desa = $_POST['desa'];
        } else {
            $desa = null;
        }
        if(isset($_POST['organisasi'])){
            $organisasi = $_POST['organisasi'];
        } else {
            $organisasi = null;
        }

        $data = [
            'data' => $this->m->get_member(null, $prov, $kab, $kec, $desa, $organisasi)->result()
        ];
        $this->load->view('ajax/master/member', $data);
    }

    public function load_data_anggota(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = [
            'data' => $this->m->get_member($id)->row()
        ];
        $this->load->view('ajax/master/member_detail', $data);
    }

    public function coba(){
        $word = "jawa timur";
        echo ucwords($word);

    }

    public function get_data_pendukung(){
        validation_ajax_request();
        $data = [
            'data' => $this->m->get_pendukung()->result()
        ];
        $this->load->view('ajax/caleg/load_pendukung', $data);
    }

    public function get_data_member(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = $this->m->get_member($id)->row();

        $output = [
            'id_user' => md5(sha1($data->id_user)),
            'role' => $data->id_role
        ];

        echo json_encode($output);
    }

    public function load_data_relawan(){
        validation_ajax_request();

        $data = [
            'data' => $this->m->get_relawan()->result()
        ];
        $this->load->view('ajax/caleg/load_relawan', $data);

    }

    public function load_data_penempatan_relawan(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data['data'] = $this->m->get_penempatan_relawan($id)->result();
        $this->load->view('ajax/caleg/load_penempatan_relawan', $data);

    }

    public function get_data_pendukung_relawan()
    {
        validation_ajax_request();
        $data['data'] = $this->m->get_data_pendukung_relawan()->result();
        $this->load->view('ajax/caleg/load_pendukung_relawan', $data);
    }

}