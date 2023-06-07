<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // DIRECT LINK SESUAI ROLE //
        // check_admin();
        check_login();
        // END DIRECT LINK SESUAI ROLE //
    }
    public function index()
    {
        $user = get_user();
        $month = date('m');
        $data = [
            'title' => 'Dashboard',
            'user' => get_user(),
            'total_user' => $this->db->get('user')->num_rows(),
            'role' => $this->db->get('role_user')->result(),
        ];

        if($user->id_role == 1){
            //dashboard super admin
            $data['view'] = 'dashboard/index';
            $data['cabang'] = $this->m->get_jml_user_per_group();
        } else if($user->id_role == 2){
            //dashboard relawan
            $data['view'] = 'dashboard/relawan';
            $data['pendukung_bulan'] = $this->db->where('add_by', $user->id_user)->where('month(date_create)', $month)->get('user')->num_rows();
            $data['pendukung_total'] = $this->db->where('add_by', $user->id_user)->get('user')->num_rows();
        } else if($user->id_role == 3){
            //dashboard anggota
            $data['view'] = 'dashboard/anggota';
        } else if($user->id_role == 4){
            //dashboard caleg
            $data['view'] = 'dashboard/caleg';
            $data['dukungan'] = $this->m->get_pendukung()->num_rows();
            $data['relawan'] = $this->m->get_relawan()->num_rows();

            if($user->dapil_id != null || $user->dapil_id != 0){
                $data['persentase'] = $this->m->get_progres_pemenangan();
            }
        } else if($user->id_role == 5){
            //dashboard admin anak cabang
            $data['view'] = 'dashboard/admin_anak_cabang';
        }

        $this->load->view('template', $data);

    }

    public function coba(){
        $date = get_date();
        var_dump($date);
    }
}
