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

    public function get_member($id = null, $prov = null, $kab = null, $kec = null, $desa = null, $org = null, $limit = null, $start = null){
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

        if($limit && $start){
            $this->db->limit($limit, $start);
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
            ->join('caleg', 'dapil.id_caleg = caleg.id_caleg');
        } else if($id == 2){
            $this->db->select('
                dapil.*,
                caleg.ketegori_caleg,
                wilayah_provinsi.nama as provinsi
            ')
            ->from('dapil')
            ->join('caleg', 'dapil.id_caleg = caleg.id_caleg')
            ->join('wilayah_provinsi', 'dapil.wilayah_provinsi = wilayah_provinsi.id');
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
            ->join('wilayah_kabupaten', 'dapil.wilayah_kabupaten = wilayah_kabupaten.id');
        }

        if($id){
            $this->db->where('dapil.id_caleg', $id);
        }

        if($id_dapil){
            $this->db->where('id_dapil', $id_dapil);
        }

        return $this->db->get();
    }

    public function get_dapil(){
        $user = get_user();
        $dapil = $this->db->where('id_dapil', $user->dapil_id)->get('dapil')->row();
        if($dapil->id_caleg == 3){
            $this->db->select('
                wilayah_kecamatan.nama,
                dapil_wilayah.*
            ')->from('dapil_wilayah')
            ->join('wilayah_kecamatan', 'dapil_wilayah.id_kecamatan = wilayah_kecamatan.id')
            ->where('dapil_wilayah.id_dapil', $user->dapil_id)
            ;
            $list_wilayah = $this->db->get()->result();
        } else {
            $this->db->select('
                wilayah_kabupaten.nama,
                dapil_wilayah.*
            ')->from('dapil_wilayah')
            ->join('wilayah_kabupaten', 'dapil_wilayah.id_kabupaten = wilayah_kabupaten.id')
            ->where('dapil_wilayah.id_dapil', $user->dapil_id)
            ;
            $list_wilayah = $this->db->get()->result();
        }

        $data = [];
        foreach($list_wilayah as $lw){
            if($lw->id_kecamatan == 0 || $lw->id_kecamatan == ''){
                //get per kabupaten
                $jml_pendukung = $this->db->where(['kabupaten' => $lw->id_kabupaten, 'dukungan' => $user->id_user, 'id_role' => 3])->get('user')->num_rows();

                $jml_relawan = $this->db->where(['kabupaten' => $lw->id_kabupaten, 'dukungan' => $user->id_user, 'id_role' => 2])->get('user')->num_rows();

                $data[] = [
                    'wilayah' => $lw->nama,
                    'pendukung' => $jml_pendukung,
                    'relawan' => $jml_relawan
                ];

            } else {
                //get per kecamatan
                $jml_pendukung = $this->db->where(['kecamatan' => $lw->id_kecamatan, 'dukungan' => $user->id_user, 'id_role' => 3])->get('user')->num_rows();

                $jml_relawan = $this->db->where(['kecamatan' => $lw->id_kecamatan, 'dukungan' => $user->id_user, 'id_role' => 2])->get('user')->num_rows();

                $data[] = [
                    'wilayah' => $lw->nama,
                    'pendukung' => $jml_pendukung,
                    'relawan' => $jml_relawan
                ];
            }
        }

        return $data;
    }

    public function get_data_statistik($role = null, $gender = null, $month = null){
        $user = get_user();

        $this->db->from('user');
        $this->db->where('dukungan', $user->id_user);
        if($role){
            $this->db->where('id_role', $role);
        }

        if($gender){
            $this->db->where_in('jenis_kelamin', $gender);
        }

        if($month){
            $year = date('Y');
            $this->db->where('year(date_create)', $year);
            $this->db->where('month(date_create)', $month);
        }
        $data = $this->db->get();
        return $data;
    }

    public function get_jml_user_per_group(){
        $group = $this->db->get('cabang')->result();
        $no_group = $this->db->where('status_organisasi', null)->or_where('status_organisasi', 0)->get('user')->num_rows();
        $data_no_group[0] = [
            'nama' => 'Tidak berkategori',
            'jml' => $no_group
        ];
        $list = [];

        foreach($group as $g){
            $jml_per_group = $this->db->where('status_organisasi', $g->id_cabang)->get('user')->num_rows();
            $list[] = [
                'nama' => $g->nama_cabang,
                'jml' => $jml_per_group
            ];
        }
        $data = array_merge($data_no_group, $list);
        return $data;
    }

    public function get_jml_user_per_bulan($add_by = null){
        $tgl = get_date();
        $bulan = date('m');
        $tahun = date('Y');

        $list = [];
        foreach($tgl as $date){
            $this->db->from('user')
            ->where('year(date_create)', $tahun)
            ->where('month(date_create)', $bulan)
            ->where('day(date_create)', $date);

            if($add_by){
                $this->db->where('add_by', $add_by);
            }

            $jml = $this->db->get()->num_rows();

            $list[] = [
                'tanggal' => $date,
                'jml' => $jml
            ];
        }
        return $list;
    }



    //get data kegiatan for datatable 

    private function get_kegiatan_datatable($add_by = null, $dukungan = null){
        $column_search = ['tgl', 'tempat', 'keterangan', 'jml_peserta'];
        $column_order = [null, 'tgl', null, 'keterangan', 'tempat', 'jml_peserta', null];
        $order = ['id_kegiatan' => 'DESC'];

        $this->db->select('
            user.nama,
            kegiatan.*
        ')
        ->from('kegiatan')
        ->join('user', 'kegiatan.id_relawan = user.id_user');

        if($add_by){
            $this->db->where('kegiatan.id_relawan', $add_by);
        }
        if($dukungan){
            $this->db->where('user.dukungan', $dukungan);
        }

        $i = 0;
        foreach($column_search as $item){
            if($_POST['search']['value']){
                if($i === 0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if(isset($_POST['order'])){
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($order)){
            $order_data = $order;
            $this->db->order_by(key($order_data), $order_data[key($order_data)]);
        }
    }

    public function get_datatables($add_by = null, $dukungan = null){
        $this->get_kegiatan_datatable($add_by, $dukungan);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered($add_by = null, $dukungan = null){
        $this->get_kegiatan_datatable($add_by, $dukungan);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($add_by = null, $dukungan = null)
    {
        $this->db->select('
            user.nama,
            kegiatan.*
        ')
        ->from('kegiatan')
        ->join('user', 'kegiatan.id_relawan = user.id_user');

        if($add_by){
            $this->db->where('kegiatan.id_relawan', $add_by);
        }
        if($dukungan){
            $this->db->where('user.dukungan', $dukungan);
        }
        return $this->db->count_all_results();
    }

}