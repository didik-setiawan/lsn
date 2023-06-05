<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Ajax extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        check_login();
        $this->load->model('Member_model', 'member');
    }


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


    public function load_data_anggota(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = [
            'data' => $this->m->get_member($id)->row()
        ];
        $this->load->view('ajax/master/member_detail', $data);
    }

    public function get_data_pendukung(){
        validation_ajax_request();
        $role = 3;
        $dukungan = get_user()->id_user;

        $list = $this->member->get_datatables(null, null, null, null, null, $role, $dukungan);
        $data = array();
        $no = $_POST['start'];

        foreach($list as $l){
            $q_org = $this->db->where('id_cabang', $l->status_organisasi)->get('cabang')->row();

            $prov = $this->db->where('id', $l->provinsi)->get('wilayah_provinsi')->row();
            $kab = $this->db->where('id', $l->kabupaten)->get('wilayah_kabupaten')->row();
            $kec = $this->db->where('id', $l->kecamatan)->get('wilayah_kecamatan')->row();

            if($prov){
                $prov_nama = $prov->nama;
            } else {
                $prov_nama = '-';
            }

            if($kab){
                $kab_nama = $kab->nama;
            } else {
                $kab_nama = '-';
            }

            if($kec){
                $kec_nama = $kec->nama;
            } else {
                $kec_nama = '-';
            }

            if($q_org){
                $org = $q_org->nama_cabang;
            } else {
                $org = '-';
            }

            if($l->img){
                $img = '<img width="100px" src="'.base_url('assets/img/user/').$l->img.'" alt="img" loading="lazy">';
            } else {
                $img = 'Unavailable';
            }

            if($l->id_role == 1){
                $action = 'disabled';
            } else {
                $action = '';
            }

            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $img;
            $row[] = $l->nama .' / ' . $l->nik;
            $row[] = $prov_nama .' / '. $kab_nama .' / '. $kec_nama;
            $row[] = $org;
            $row[] = '<button class="btn btn-sm btn-success detail-pendukung" data-id="'.md5(sha1($l->id_user)).'"><i class="fa fa-search"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->member->count_all(),
            "recordsFiltered" => $this->member->count_filtered(null, null, null, null, null, $role, $dukungan),
            "data" => $data,
        );
            //output to json format
        echo json_encode($output);
        
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

        $role = 2;
        $dukungan = get_user()->id_user;

        $list = $this->member->get_datatables(null, null, null, null, null, $role, $dukungan);
        $data = array();
        $no = $_POST['start'];

        foreach($list as $l){
            $q_org = $this->db->where('id_cabang', $l->status_organisasi)->get('cabang')->row();

            $prov = $this->db->where('id', $l->provinsi)->get('wilayah_provinsi')->row();
            $kab = $this->db->where('id', $l->kabupaten)->get('wilayah_kabupaten')->row();
            $kec = $this->db->where('id', $l->kecamatan)->get('wilayah_kecamatan')->row();

            if($prov){
                $prov_nama = $prov->nama;
            } else {
                $prov_nama = '-';
            }

            if($kab){
                $kab_nama = $kab->nama;
            } else {
                $kab_nama = '-';
            }

            if($kec){
                $kec_nama = $kec->nama;
            } else {
                $kec_nama = '-';
            }

            if($q_org){
                $org = $q_org->nama_cabang;
            } else {
                $org = '-';
            }

            if($l->img){
                $img = '<img width="100px" src="'.base_url('assets/img/user/').$l->img.'" alt="img" loading="lazy">';
            } else {
                $img = 'Unavailable';
            }

            if($l->id_role == 1){
                $action = 'disabled';
            } else {
                $action = '';
            }

            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $img;
            $row[] = $l->nama .' / ' . $l->nik;
            $row[] = $prov_nama .' / '. $kab_nama .' / '. $kec_nama;
            $row[] = $org;
            $row[] = '<button class="btn btn-sm btn-success detail-pendukung" data-id="'.md5(sha1($l->id_user)).'"><i class="fa fa-search"></i></button>

            <button class="btn btn-sm btn-primary tempat_relawan" data-id="'.md5(sha1($l->id_user)).'"><i class="fas fa-map-marker-alt"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->member->count_all(),
            "recordsFiltered" => $this->member->count_filtered(null, null, null, null, null, $role, $dukungan),
            "data" => $data,
        );
            //output to json format
        echo json_encode($output);
        

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
        $role = 3;
        $add_by = get_user()->id_user;

        $list = $this->member->get_datatables(null, null, null, null, null, $role, null, $add_by);
        $data = array();
        $no = $_POST['start'];

        foreach($list as $l){
            $q_org = $this->db->where('id_cabang', $l->status_organisasi)->get('cabang')->row();

            $prov = $this->db->where('id', $l->provinsi)->get('wilayah_provinsi')->row();
            $kab = $this->db->where('id', $l->kabupaten)->get('wilayah_kabupaten')->row();
            $kec = $this->db->where('id', $l->kecamatan)->get('wilayah_kecamatan')->row();

            if($prov){
                $prov_nama = $prov->nama;
            } else {
                $prov_nama = '-';
            }

            if($kab){
                $kab_nama = $kab->nama;
            } else {
                $kab_nama = '-';
            }

            if($kec){
                $kec_nama = $kec->nama;
            } else {
                $kec_nama = '-';
            }

            if($q_org){
                $org = $q_org->nama_cabang;
            } else {
                $org = '-';
            }

            if($l->img){
                $img = '<img width="100px" src="'.base_url('assets/img/user/').$l->img.'" alt="img" loading="lazy">';
            } else {
                $img = 'Unavailable';
            }

            if($l->id_role == 1){
                $action = 'disabled';
            } else {
                $action = '';
            }

            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $img;
            $row[] = $l->nama .' / ' . $l->nik;
            $row[] = $prov_nama .' / '. $kab_nama .' / '. $kec_nama;
            $row[] = $org;
            $row[] = '<button class="btn btn-sm btn-success detail-pendukung" data-id="'.md5(sha1($l->id_user)).'"><i class="fa fa-search"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->member->count_all(),
            "recordsFiltered" => $this->member->count_filtered(null, null, null, null, null, $role, null, $add_by),
            "data" => $data,
        );
            //output to json format
        echo json_encode($output);
    }

    public function load_data_kegiatan(){
        validation_ajax_request();
        $user = get_user();

        if($user->id_role == 2){
            $data['kegiatan'] = $this->db->get_where('kegiatan', ['id_relawan'=> $user->id_user])->result();
        } else if($user->id_role == 4) {
            $data['kegiatan'] = $this->m->get_data_kegiatan_for_caleg()->result();
        }
        $data['user'] = $user;

        $this->load->view('ajax/caleg/load_kegiatan', $data);

    }

    public function load_list_foto_kegiatan(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data['data'] = $this->db->get_where('kegiatan_foto', ['md5(sha1(kegiatan))' => $id])->result();
        $data['user'] = get_user();
        
        $this->load->view('ajax/caleg/load_list_foto', $data);
    }

    public function load_list_dapil(){
        validation_ajax_request();
        $id = $_POST['id'];
        
        $data['data'] = $this->m->get_data_dapil($id)->result();
        $data['id'] = $id;
        $this->load->view('ajax/master/list_dapil', $data);

    }

    public function check_data_dapil(){
        validation_ajax_request();

        //destroy all cart content
        $this->cart->destroy();

        $id = $_POST['id'];
        $data = $this->db->where('id_dapil', $id)->get('dapil')->row();
        if($data->id_caleg == 1){
            $data_dapil = $this->m->get_data_dapil($data->id_caleg, null, null, $id)->row();
            $data_prov = $this->db->get('wilayah_provinsi')->result();
            $params = [
                'id_caleg' => $data_dapil->id_caleg,
                'nama_dapil' => $data_dapil->nama_dapil,
                'data_prov' => $data_prov
            ];

        } else if($data->id_caleg == 2){
            $data_dapil = $this->m->get_data_dapil($data->id_caleg, null, null, $id)->row();
            $data_kab = $this->db->where('provinsi_id', $data_dapil->wilayah_provinsi)->get('wilayah_kabupaten')->result();
            $params = [
                'id_caleg' => $data_dapil->id_caleg,
                'nama_dapil' => $data_dapil->nama_dapil,
                'id_provinsi' => $data_dapil->wilayah_provinsi,
                'provinsi' => $data_dapil->provinsi,
                'data_kab' => $data_kab
            ];
        } else if($data->id_caleg == 3){
            $data_dapil = $this->m->get_data_dapil($data->id_caleg, null, null, $id)->row();
            $data_kec = $this->db->where('kabupaten_id', $data_dapil->wilayah_kabupaten)->get('wilayah_kecamatan')->result();
            $params = [
                'id_caleg' => $data_dapil->id_caleg,
                'nama_dapil' => $data_dapil->nama_dapil,
                'id_provinsi' => $data_dapil->wilayah_provinsi,
                'provinsi' => $data_dapil->provinsi,
                'id_kabupaten' => $data_dapil->wilayah_kabupaten,
                'kabupaten' => $data_dapil->kabupaten,
                'data_kec' => $data_kec
            ];
        }

        echo json_encode($params);
    }

    public function load_wilayah_dapil(){
        validation_ajax_request();
        $id_dapil = $_POST['id'];
        $data_wilayah = $this->db->where('id_dapil', $id_dapil)->get('dapil_wilayah')->result();
        $list = '';

        if($data_wilayah){

            foreach($data_wilayah as $d){
                if($d->id_kecamatan == 0 || $d->id_wilayah == null){
                    $data_prov = $this->db->where('id', $d->id_provinsi)->get('wilayah_provinsi')->row();
                    $data_kab = $this->db->where('id', $d->id_kabupaten)->get('wilayah_kabupaten')->row();

                    $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama.'
                        <div class="float-right">
                            <button class="btn btn-sm btn-danger delete_list_wilayah" data-id="'.md5(sha1($d->id_wilayah)).'" data-dapil="'.$d->id_dapil.'">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </li>';
                } else {
                    $data_prov = $this->db->where('id', $d->id_provinsi)->get('wilayah_provinsi')->row();
                    $data_kab = $this->db->where('id', $d->id_kabupaten)->get('wilayah_kabupaten')->row();
                    $data_kec = $this->db->where('id', $d->id_kecamatan)->get('wilayah_kecamatan')->row();

                    $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama. ' / '.$data_kec->nama.'
                        <div class="float-right">
                            <button class="btn btn-sm btn-danger delete_list_wilayah" data-id="'.md5(sha1($d->id_wilayah)).'" data-dapil="'.$d->id_dapil.'">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </li>';
                }
            }

        } else {
            $list = '<li class="list-group-item list-group-item-danger">No data result</li>';
        }

        echo $list;

    }

    public function load_all_data_member(){
        validation_ajax_request();

        if(!empty($this->input->post('prov'))){
            $prov = $this->input->post('prov');
        } else {
            $prov = '';
        }

        if(!empty($this->input->post('kab'))){
            $kab = $this->input->post('kab');
        } else {
            $kab = '';
        }

        if(!empty($this->input->post('kec'))){
            $kec = $this->input->post('kec');
        } else {
            $kec = '';
        }

        if(!empty($this->input->post('desa'))){
            $desa = $this->input->post('desa');
        } else {
            $desa = '';
        }

        if(!empty($this->input->post('org'))){
            $org = $this->input->post('org');
        } else {
            $org = '';
        }

        $list = $this->member->get_datatables($prov, $kab, $kec, $desa, $org, null, null, null);
        $data = array();
        $no = $_POST['start'];
        $a = 0;
        $b = 0;

        foreach($list as $l){
            $q_org = $this->db->where('id_cabang', $l->status_organisasi)->get('cabang')->row();

            $prov = $this->db->where('id', $l->provinsi)->get('wilayah_provinsi')->row();
            $kab = $this->db->where('id', $l->kabupaten)->get('wilayah_kabupaten')->row();
            $kec = $this->db->where('id', $l->kecamatan)->get('wilayah_kecamatan')->row();

            if($prov){
                $prov_nama = $prov->nama;
            } else {
                $prov_nama = '-';
            }

            if($kab){
                $kab_nama = $kab->nama;
            } else {
                $kab_nama = '-';
            }

            if($kec){
                $kec_nama = $kec->nama;
            } else {
                $kec_nama = '-';
            }

            if($q_org){
                $org = $q_org->nama_cabang;
            } else {
                $org = '-';
            }

            if($l->img){
                $img = '<img width="100px" src="'.base_url('assets/img/user/').$l->img.'" alt="img" loading="lazy">';
            } else {
                $img = 'Unavailable';
            }

            if($l->id_role == 1){
                $action = 'disabled';
            } else {
                $action = '';
            }

            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $img;
            $row[] = $l->nama .' / ' . $l->nik;
            $row[] = $prov_nama .' / '. $kab_nama .' / '. $kec_nama;
            $row[] = $org;
            $row[] = '<div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle" '.$action.' type="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item detail" data-id="'. md5(sha1($l->id_user)).'" href="#">Detail</a>
                                <a class="dropdown-item delete" data-id="'. md5(sha1($l->id_user)).'" href="#">Hapus</a>
                                <a class="dropdown-item edit" data-id="'. md5(sha1($l->id_user)).'" href="#">Edit Data</a>
                                <a class="dropdown-item edit-img" data-id="'. md5(sha1($l->id_user)).'" href="#">Edit Foto</a>
                                <a class="dropdown-item edit-ktp" data-id="'. md5(sha1($l->id_user)).'" href="#">Edit Ktp</a>
                                
                            </div>
                        </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->member->count_all(),
            "recordsFiltered" => $this->member->count_filtered(),
            "data" => $data,
        );
            //output to json format
        echo json_encode($output);

    }

    public function get_data_statistik(){
        validation_ajax_request();
        $data = $this->m->get_dapil();
        echo json_encode($data);
    }

    public function get_data_chart_dashboard_admin(){
        validation_ajax_request();
        $role = $this->db->get('role_user')->result();
        
        $list_all[0] = [
            'role' => 'Semua User',
            'jumlah' => $this->db->get('user')->num_rows()
        ];

        $list_role = [];

        foreach($role as $r){
            $jml = $this->m->get_total_user_role($r->id_role);

            $list_role[] = [
                'role' => $r->nama_role,
                'jumlah' => $jml
            ];
        
        }
        $list = array_merge($list_role, $list_all);
        
        
        echo json_encode($list);
    }

    public function get_data_user_by_group(){
        validation_ajax_request();
        $data_by_group = $this->m->get_jml_user_per_group();
        echo json_encode($data_by_group);
    }

    public function get_data_user_per_month(){
        validation_ajax_request();
        $data = $this->m->get_jml_user_per_bulan();
        echo json_encode($data);
    }

}