<?php
defined('BASEPATH')or exit('No direct script access allowed');
class Member_model extends CI_Model {
   var $table = 'user';
   var $column_search = ['nama'];
   var $column_order = [null, null, 'nama', null, null, null];
   var $order = ['id_user' => 'asc'];

    private function get_query(
            $prov = null, 
            $kab = null, 
            $kec = null, 
            $desa = null, 
            $org = null, 
            $role = null, 
            $dukungan = null,
            $add_by = null
        ){
        $this->db->from($this->table);
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
        if($role){
            $this->db->where('id_role', $role);
        } 
        if($dukungan){
            $this->db->where('dukungan', $dukungan);
        }
        if($add_by){
            $this->db->where('add_by', $add_by);
        }


        $i = 0;
        foreach($this->column_search as $item){
            if($_POST['search']['value']){
                if($i === 0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function get_datatables($prov = null, $kab = null, $kec = null, $desa = null, $org = null, $role = null, $dukungan = null, $add_by = null)
    {
        $this->get_query($prov, $kab, $kec, $desa, $org, $role, $dukungan, $add_by);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered($prov = null, $kab = null, $kec = null, $desa = null, $org = null, $role = null, $dukungan = null, $add_by = null)
    {
        $this->get_query($prov, $kab, $kec, $desa, $org, $role, $dukungan, $add_by);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}