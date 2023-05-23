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

}