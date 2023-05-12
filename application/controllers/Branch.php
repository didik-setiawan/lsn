<?php 
defined('BASEPATH')or exit('No dirext script access allowed');
class Branch extends CI_Controller {
    public function index(){
        redirect('branch/member');
    }

    public function member(){
        access_menu();
        $data = [
            'title' => 'Anggota',
            'user' => get_user(),
            'view' => 'branch/member'
        ];
        $this->load->view('template', $data);
    }

    public function get_anggota_cabang(){
        validation_ajax_request();
        $id_cabang = get_user()->status_organisasi;
        $id_user = get_user()->id_user;
        $id_role = ['5','6'];

        $data['data'] = $this->db->select('
        user.*,role_user.nama_role
        ')->from('user')
        ->join('role_user', 'user.id_role = role_user.id_role')
        ->where('user.status_organisasi', $id_cabang)
        ->where('user.id_user !=', $id_user)
        ->where_in('user.id_role', $id_role)
        ->get()->result();

        $this->load->view('ajax/branch/member', $data);
    }

}
