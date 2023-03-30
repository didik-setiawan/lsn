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

    public function get_member($id = null){
        $this->db->select('
            user.*,
            role_user.nama_role
        ')->from('user')
        ->join('role_user', 'user.id_role = role_user.id_role');
        if($id){
            $this->db->where('md5(sha1(id_user))', $id);
        }
        $data = $this->db->get();
        return $data;
    }

    public function get_member_relation_all($id = null){
        $this->db->select('
            user.*,
            role_user.nama_role,
            wilayah_provinsi.id as id_provinsi,
            wilayah_kabupaten.id as id_kabupaten,
            wilayah_kecamatan.id as id_kecamatan,
            wilayah_desa.id as id_desa
        ')
        ->from('user')
        ->join('role_user', 'user.id_role = role_user.id_role')
        ->join('wilayah_provinsi', 'user.provinsi = wilayah_provinsi.nama')
        ->join('wilayah_kabupaten', 'user.kabupaten = wilayah_kabupaten.nama')
        ->join('wilayah_kecamatan', 'user.kecamatan = wilayah_kecamatan.nama')
        ->join('wilayah_desa', 'user.desa = wilayah_desa.nama');
        if($id){
            $this->db->where('md5(sha1(id_user))', $id);
        }
        $data = $this->db->get();
        return $data;
    }


}