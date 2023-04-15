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


}