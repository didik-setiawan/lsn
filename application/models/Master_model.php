<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Master_model extends CI_Model{
    public function get_role_user(){
        $data = $this->db->get('role_user');
        return $data;
    }

    public function get_menu($id = null){
        if($id){
            $this->db->where('md5(sha1(id_menu))', $id);
        }
        return $this->db->get('menu');
    }

    public function get_access_menu($id = null){
        $this->db->select('
            menu.nama_menu,
            menu.icon,
        ')->from('menu')
        ->join('access_menu', 'menu.id_menu = access_menu.id_menu')
        ->where('access_menu.id_role', $id);

        return $this->db->get()->result();
    }

    public function get_cabang(){
        $data = $this->db->get('cabang');
        return $data;
    }

    public function get_member($id = null, $prov = null, $kab = null, $kec = null, $desa = null, $org = null){
        $this->db->select('
            user.*,
            role_user.nama_role
        ')->from('user')
        ->join('role_user', 'user.id_role = role_user.id_role');
        if($id){
            $this->db->where('md5(sha1(id_user))', $id);
        }

        if($prov){
            $this->db->where('provinsi', $prov);
        }

        if($kab){
            $this->db->where('kabupaten', $kab);
        }

        if($kec){
            $this->db->where('kecamatan', $kec);
        }

        if($desa){
            $this->db->where('desa', $desa);
        }

        if($org){
            $this->db->where('status_organisasi', $org);
        }

        $data = $this->db->get();
        return $data;
    }

    public function get_member_relation_all($id = null){
        $this->db->select('
            user.*,
            role_user.nama_role
        ')
        ->from('user')
        ->join('role_user', 'user.id_role = role_user.id_role');

    
        $this->db->where('md5(sha1(id_user))', $id);
    
        return $this->db->get();
    }

    public function get_all_member_for_export($prov = null, $kab = null, $kec = null, $desa = null, $org = null){
        $this->db->select('*')->from('user');
        if($prov){
            $this->db->where('user.provinsi', $prov);
        }
        if($kab){
            $this->db->where('user.kabupaten', $kab);
        }
        if($kec){
            $this->db->where('user.kecamatan', $kec);
        }
        if($desa){
            $this->db->where('user.desa', $desa);
        }
        if($org){
            $this->db->where('user.status_organisasi', $org);
        }
        return $this->db->get();

    }

    public function get_total_user_role($id_role){
        $data = $this->db->where('id_role', $id_role)->get('user')->num_rows();
        return $data;
    }

    public function get_pendukung(){
        $user = get_user();
        $data = $this->db->select('
                    user.*,
                    role_user.nama_role
                ')->from('user')
                ->join('role_user', 'user.id_role = role_user.id_role')
                ->where('user.dukungan', $user->id_user)
                ->where('user.id_role', 3)
                ->get();
        return $data;
    }

    public function get_relawan(){
        $user = get_user();
        $data = $this->db->select('
                    user.*,
                    role_user.nama_role
                ')->from('user')
                ->join('role_user', 'user.id_role = role_user.id_role')
                ->where('user.dukungan', $user->id_user)
                ->where('user.id_role', 2)
                ->get();
        return $data;
    }

    public function get_progres_pemenangan(){
        $pendukung = $this->get_pendukung()->num_rows();
        $target_suara = get_user()->target_suara;

        $persentase = $pendukung / $target_suara * 100;
        return $persentase;
    }

    public function get_penempatan_relawan($id_relawan = null, $id_penempatan = null){
        $this->db->select('
            penempatan_relawan.*,
            user.*,
            wilayah_provinsi.nama as prov,
            wilayah_kabupaten.nama as kab,
            wilayah_kecamatan.nama as kec,
            wilayah_desa.nama as desa
        ')
        ->from('penempatan_relawan')
        ->join('user', 'user.id_user = penempatan_relawan.id_relawan')
        ->join('wilayah_provinsi', 'penempatan_relawan.id_provinsi = wilayah_provinsi.id')
        ->join('wilayah_kabupaten', 'penempatan_relawan.id_kabupaten = wilayah_kabupaten.id')
        ->join('wilayah_kecamatan', 'penempatan_relawan.id_kecamatan = wilayah_kecamatan.id')
        ->join('wilayah_desa', 'penempatan_relawan.id_desa = wilayah_desa.id')
        ->where('md5(sha1(user.id_user))', $id_relawan);

        if($id_penempatan){
            $this->db->where('md5(sha1(penempatan_relawan.id_penempatan))', $id_penempatan);
        }

        return $this->db->get();
    }

    public function get_data_pendukung_relawan(){
        $user = get_user();

        $data = $this->db->select('
                    user.*,
                    role_user.nama_role
                ')->from('user')
                ->join('role_user', 'user.id_role = role_user.id_role')
                ->where('user.dukungan', $user->dukungan)
                ->where('user.add_by', $user->id_user)
                ->where('user.id_role', 3)
                ->get();
        return $data;

    }

    public function check_penempatan_relawan(){
        $user = get_user();
        $data = $this->db->get_where('penempatan_relawan', ['id_relawan' => $user->id_user])->num_rows();
        return $data;
    }
    
    public function get_data_kegiatan_for_caleg(){
        $user = get_user();
        $this->db->select('
            kegiatan.*,
            user.nama,
        ')
        ->from('kegiatan')
        ->join('user', 'kegiatan.id_relawan = user.id_user')
        ->where('user.dukungan', $user->id_user)
        ;

        return $this->db->get();
    }

    public function get_jml_pendukung_by_gender($gender = null){
        $user = get_user();
        $this->db->where('dukungan', $user->id_user);
        $this->db->where('id_role', 3);
        if($gender == 'L'){
            $l = ['l', 'L', 'Laki-laki', 'laki-laki'];
            $this->db->where_in('jenis_kelamin', $l);
        } else if($gender == 'P'){
            $p = ['p', 'P', 'Perempuan', 'perempuan'];
            $this->db->where_in('jenis_kelamin', $p);
        }
        return $this->db->get('user');
    }

    public function get_persentase_gender($gender = null){
        $pendukung = $this->get_pendukung()->num_rows();
        $jml_gender = $this->get_jml_pendukung_by_gender($gender)->num_rows();

        if($pendukung == '' || $pendukung == 0 || $jml_gender == 0 || $jml_gender == ''){
            $persentase = 0;
        } else {
            $persentase = $pendukung / $jml_gender * 100;
        }

        return $persentase;
    }


    public function get_data_dapil($id = null, $prov = null, $kab = null, $id_dapil = null){
        if($id == 1){
            $this->db->select('
                dapil.*,
                caleg.ketegori_caleg
            ')
            ->from('dapil')
            ->join('caleg', 'dapil.id_caleg = caleg.id_caleg')
            ->where('dapil.id_caleg', $id);
        } else if($id == 2){
            $this->db->select('
                dapil.*,
                caleg.ketegori_caleg,
                wilayah_provinsi.nama as provinsi
            ')
            ->from('dapil')
            ->join('caleg', 'dapil.id_caleg = caleg.id_caleg')
            ->join('wilayah_provinsi', 'dapil.wilayah_provinsi = wilayah_provinsi.id')
            ->where('dapil.id_caleg', $id);
        } else if($id == 3){
            $this->db->select('
                dapil.*,
                caleg.ketegori_caleg,
                wilayah_provinsi.nama as provinsi,
                wilayah_kabupaten.nama as kabupaten
            ')
            ->from('dapil')
            ->join('caleg', 'dapil.id_caleg = caleg.id_caleg')
            ->join('wilayah_provinsi', 'dapil.wilayah_provinsi = wilayah_provinsi.id')
            ->join('wilayah_kabupaten', 'dapil.wilayah_kabupaten = wilayah_kabupaten.id')
            ->where('dapil.id_caleg', $id);
        }

        if($id_dapil){
            $this->db->where('id_dapil', $id_dapil);
        }

        return $this->db->get();
    }


}