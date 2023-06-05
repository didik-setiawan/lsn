<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './assets/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Xlsx;

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('user_model');
    }


    //Management Role User

    public function index()
    {
        redirect('master/role_user');
    }

    public function role_user()
    {
        access_menu();
        $data = [
            'title' => 'Master Role User',
            'user' => get_user(),
            'view' => 'master/role_user',
            'list_menu' => $this->m->get_menu()->result()
        ];
        $this->load->view('template', $data);
    }

    private function validation_role()
    {
        $this->form_validation->set_rules('role', 'Nama Role', 'required|trim|is_unique[role_user.nama_role]', [
            'required' => 'Nama Role harap di isi',
            'is_unique' => 'Role sudah terdaftar'
        ]);
        if ($this->form_validation->run() == false) {
            $params = [
                'type' => 'validation',
                'err_role' => form_error('role')
            ];
            echo json_encode($params);
            die;
        } else {
            return true;
        }
    }

    public function add_role()
    {
        validation_ajax_request();
        $this->validation_role();

        $data = [
            'nama_role' => htmlspecialchars($this->input->post('role', true)),
            'status' => 1
        ];
        $this->db->insert('role_user', $data);
        if ($this->db->affected_rows() > 0) {
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Role baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Role baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function edit_role()
    {
        validation_ajax_request();
        $this->validation_role();

        $id = $_POST['id_role'];
        $role = htmlspecialchars($this->input->post('role', true));
        $this->db->set('nama_role', $role)->where('md5(sha1(id_role))', $id)->update('role_user');
        if ($this->db->affected_rows() > 0) {
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Role berhasil di edit'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Role gagal di edit'
            ];
        }
        echo json_encode($params);
    }

    public function change_status_role()
    {
        validation_ajax_request();
        $id = $_POST['id'];
        $type = $_POST['type'];
        if ($type == 1) {
            $this->db->set('status', 1)->where('md5(sha1(id_role))', $id)->update('role_user');
        } else if ($type == 2) {
            $this->db->set('status', 0)->where('md5(sha1(id_role))', $id)->update('role_user');
        }

        if ($this->db->affected_rows() > 0) {
            $params = [
                'success' => true,
                'msg' => 'Status role berhasil di ubah'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Status role gagal di ubah'
            ];
        }
        echo json_encode($params);
    }

    public function delete_role()
    {
        validation_ajax_request();
        $id = $_POST['id'];
        $this->db->where('md5(sha1(id_role))', $id)->delete('role_user');
        if ($this->db->affected_rows() > 0) {
            $params = [
                'success' => true,
                'msg' => 'Role berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Role gagal di hapus'
            ];
        }
        echo json_encode($params);
    }

    public function change_access_menu(){
        validation_ajax_request();

        $id_role = $this->input->post('id_role');

        if(empty($_POST['check'])){
            $this->db->delete('access_menu', ['id_role' => $id_role]);
            if($this->db->affected_rows() > 0){
                $params = [
                    'success' => true,
                    'msg' => 'Akses menu berhasil di perbarui'
                ];
            } else {
                $params = [
                    'success' => false,
                    'msg' => 'Akses menu gagal di perbarui'
                ];
            }

        } else {
            $menu = $_POST['check'];


            $a = count($menu);
            $data = array();

            for($b=0; $b<$a; $b++){
                array_push($data, array(
                    'id_role' => $id_role,
                    'id_menu' => $menu[$b]
                ));
            }
            $this->db->delete('access_menu', ['id_role' => $id_role]);
            $this->db->insert_batch('access_menu', $data);

            if($this->db->affected_rows() > 0){
                $params = [
                    'success' => true,
                    'msg' => 'Akses menu berhasil di perbarui'
                ];
            } else {
                $params = [
                    'success' => false,
                    'msg' => 'Akses menu gagal di perbarui'
                ];
            }
        }

        echo json_encode($params);
    }

    public function load_access_menu(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = $this->m->get_access_menu($id);
        $html = '';
        if(isset($data)){
            foreach($data as $d){
                $html .= '
                    <li><i class="'.$d->icon.'"></i> '.$d->nama_menu.'</li>
                ';
            }
        } else {
            $html = '<li>No Data</li>';
        }

        echo $html;
    }


    //Management Menu

    public function menu(){
        access_menu();
        $data = [
            'title' => 'Master Menu',
            'user' => get_user(),
            'view' => 'master/menu'
        ];
        $this->load->view('template', $data);
    }

    private function validation_menu(){
        $this->form_validation->set_rules('menu', 'Nama menu', 'required|trim|is_unique[menu.nama_menu]',[
            'required' => 'Nama menu harap di isi',
            'is_unique' => 'Menu sudah terdaftar'
        ]);
        $this->form_validation->set_rules('icon', 'Icon menu', 'required|trim',[
            'required' => 'Icon menu harap di isi'
        ]);
        $this->form_validation->set_rules('url', 'Url menu', 'required|trim|is_unique[menu.url]',[
            'required' => 'Url menu harap di isi',
            'is_unique' => 'Url sudah terdaftar'
        ]);

        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_menu' => form_error('menu'),
                'err_icon' => form_error('icon'),
                'err_url' => form_error('url')
            ];
            echo json_encode($params);
            die;
        } else {
            return true;
        }


    }

    public function add_menu(){
        validation_ajax_request();
        $this->validation_menu();

        $data = [
            'nama_menu' => htmlspecialchars($this->input->post('menu', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'status' => 1
        ];
        $this->db->insert('menu', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Menu baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Menu baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);

    }

    public function get_menu_row(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = $this->m->get_menu($id)->row();
        echo json_encode($data);
    }

    public function edit_menu(){
        validation_ajax_request();
        $this->validation_menu();
        $id = $this->input->post('id_menu');

        $data = [
            'nama_menu' => htmlspecialchars($this->input->post('menu', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'url' => htmlspecialchars($this->input->post('url', true))
        ];

        $this->db->where('md5(sha1(id_menu))', $id)->update('menu', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Menu berhasil di edit'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Menu gagal di edit'
            ];
        }
        echo json_encode($params);
    }

    public function delete_menu()
    {
        validation_ajax_request();
        $id = $_POST['id'];
        $this->db->where('md5(sha1(id_menu))', $id)->delete('menu');
        if ($this->db->affected_rows() > 0) {
            $params = [
                'success' => true,
                'msg' => 'Menu berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Menu gagal di hapus'
            ];
        }
        echo json_encode($params);
    }

    public function change_status_menu()
    {
        validation_ajax_request();
        $id = $_POST['id'];
        $type = $_POST['type'];
        if ($type == 1) {
            $this->db->set('status', 1)->where('md5(sha1(id_menu))', $id)->update('menu');
        } else if ($type == 2) {
            $this->db->set('status', 0)->where('md5(sha1(id_menu))', $id)->update('menu');
        }

        if ($this->db->affected_rows() > 0) {
            $params = [
                'success' => true,
                'msg' => 'Status menu berhasil di ubah'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Status menu gagal di ubah'
            ];
        }
        echo json_encode($params);
    }


    //master cabang
    public function cabang(){
        access_menu();
        $data = [
            'title' => 'Master Anak Cabang',
            'user' => get_user(),
            'view' => 'master/cabang'
        ];
        $this->load->view('template', $data);
    }

    private function validation_cabang(){
        $this->form_validation->set_rules('cabang', 'Nama Cabang', 'required|trim|is_unique[cabang.nama_cabang]');
        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_cabang' => form_error('cabang')
            ];
            echo json_encode($params);
            die;
        } else {
            return true;
        }
    }

    public function add_cabang(){
        validation_ajax_request();
        $this->validation_cabang();
        $data = [
            'nama_cabang' => htmlspecialchars($this->input->post('cabang', true))
        ];
        $this->db->insert('cabang', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Anak cabang baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Anak cabang baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function edit_cabang(){
        validation_ajax_request();
        $this->validation_cabang();
        $data = [
            'nama_cabang' => htmlspecialchars($this->input->post('cabang', true))
        ];
        $id = $this->input->post('id_cabang');
        $this->db->where('md5(sha1(id_cabang))', $id)->update('cabang', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Anak cabang berhasil di edit'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Anak cabang gagal di edit'
            ];
        }
        echo json_encode($params);
    }

    public function delete_cabang(){
        validation_ajax_request();
        $id = $this->input->post('id');
        $this->db->where('md5(sha1(id_cabang))', $id)->delete('cabang');
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Anak cabang berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Anak cabang gagal di hapus'
            ];
        }
        echo json_encode($params);
    }



    //master anggota

    public function member(){
        access_menu();

    
        

        $data = [
            'title' => 'Master Anggota',
            'user' => get_user(),
            'view' => 'master/member',
            'provinsi' => $this->db->get('wilayah_provinsi')->result(),
            'role' => $this->db->where('status', 1)->get('role_user')->result(),
            'cabang' => $this->db->get('cabang')->result(),
        ];
        $this->load->view('template', $data);
    }

    public function get_kabupaten(){
        validation_ajax_request();
        $prov = $_POST['id'];
        $user = get_user();
        
        if($user->id_role == 2){
            $data = $this->db->select('wilayah_kabupaten.*')
                ->from('wilayah_kabupaten')
                ->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')
                ->join('penempatan_relawan', 'wilayah_kabupaten.id = penempatan_relawan.id_kabupaten')
                ->where('wilayah_provinsi.id', $prov)
                ->where('penempatan_relawan.id_relawan', $user->id_user)
                ->group_by('wilayah_kabupaten.id')
                ->get()->result();
        } else if($user->id_role == 4 && $user->dapil_id != null || $user->id_role == 4 && $user->dapil_id != 0){
            $data = $this->db->select('wilayah_kabupaten.*')
                    ->from('wilayah_kabupaten')
                    ->join('dapil_wilayah', 'wilayah_kabupaten.id = dapil_wilayah.id_kabupaten')
                    ->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')
                    ->where('dapil_wilayah.id_dapil', $user->dapil_id)
                    ->where('wilayah_provinsi.id', $prov)
                    ->group_by('wilayah_kabupaten.id')
                    ->get()->result();
        } else {
            $data = $this->db->select('wilayah_kabupaten.*')->from('wilayah_kabupaten')->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')->where('wilayah_provinsi.id', $prov)->get()->result();
        }
        

        echo json_encode($data);
    }

    public function get_kecamatan(){
        validation_ajax_request();
        $req = $_POST['id'];
        $user = get_user();

        if($user->id_role == 2){
            $this->db->select('wilayah_kecamatan.*')
            ->from('wilayah_kecamatan')
            ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
            ->join('penempatan_relawan', 'wilayah_kecamatan.id = penempatan_relawan.id_kecamatan')
            ->where('penempatan_relawan.id_relawan', $user->id_user)
            ->where('wilayah_kabupaten.id', $req)
            ->group_by('wilayah_kecamatan.id');

        } else if($user->id_role == 4){
            $dapil = $this->db->get_where('dapil', ['id_dapil' => $user->dapil_id])->row();
            if($dapil){
                if($dapil->id_caleg == 3){

                    $this->db->select('wilayah_kecamatan.*')
                    ->from('wilayah_kecamatan')
                    ->join('dapil_wilayah', 'wilayah_kecamatan.id = dapil_wilayah.id_kecamatan')
                    ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
                    ->where('dapil_wilayah.id_dapil', $user->dapil_id)
                    ->where('wilayah_kabupaten.id', $req)
                    ->group_by('wilayah_kecamatan.id');
    
                } else {
                    $this->db->select('wilayah_kecamatan.*')
                    ->from('wilayah_kecamatan')
                    ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
                    ->where('wilayah_kabupaten.id', $req);
                }
            } else {
                $this->db->select('wilayah_kecamatan.*')
                    ->from('wilayah_kecamatan')
                    ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
                    ->where('wilayah_kabupaten.id', $req);
            }

        } else {
            $this->db->select('wilayah_kecamatan.*')
            ->from('wilayah_kecamatan')
            ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
            ->where('wilayah_kabupaten.id', $req);
        }
        
        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    public function get_kelurahan(){
        validation_ajax_request();
        $req = $_POST['id'];
        $user = get_user();

        if($user->id_role == 2){
            $this->db->select('wilayah_desa.*')
            ->from('wilayah_desa')
            ->join('wilayah_kecamatan', 'wilayah_kecamatan.id = wilayah_desa.kecamatan_id')
            ->join('penempatan_relawan', 'wilayah_desa.id = penempatan_relawan.id_desa')
            ->where('penempatan_relawan.id_relawan', $user->id_user)
            ->where('wilayah_kecamatan.id', $req)
            ->group_by('wilayah_desa.id');

        } else {
            $this->db->select('wilayah_desa.*')
            ->from('wilayah_desa')
            ->join('wilayah_kecamatan', 'wilayah_kecamatan.id = wilayah_desa.kecamatan_id')
            ->where('wilayah_kecamatan.id', $req);
        }

        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    private function validation_member(){
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIk', 'required|trim|numeric|is_unique[user.nik]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim|numeric|is_unique[user.no_telp]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('dusun', 'Dusun', 'required|trim');
        $this->form_validation->set_rules('rw', 'Rw', 'required|trim|numeric');
        $this->form_validation->set_rules('rt', 'Rt', 'required|trim|numeric');
       
        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_nama' => form_error('nama'),
                'err_tl' => form_error('tempat_lahir'),
                'err_tlp' => form_error('no_telp'),
                'err_email' => form_error('email'),
                'err_pass' => form_error('password'),
                'err_dusun' => form_error('dusun'),
                'err_rw' => form_error('rw'),
                'err_rt' => form_error('rt'),
                'err_nik' => form_error('nik'),
            ];
            echo json_encode($params);
            die;
        } else {
            return true;
        }
    }

    public function add_member(){
        validation_ajax_request();
        $this->validation_member();

        $prov = htmlspecialchars($this->input->post('provinsi', true));
        $kab = htmlspecialchars($this->input->post('kabupaten', true));
        $kec = htmlspecialchars($this->input->post('kecamatan', true));
        $desa = htmlspecialchars($this->input->post('desa', true));

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => md5(sha1($this->input->post('password'))),
            'status' => 1,
            'img' => 'default.png',
            'id_role' => htmlspecialchars($this->input->post('role', true)),
            'nik' => htmlspecialchars($this->input->post('nik', true)),
            'tanggal_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
            'provinsi' => $prov,
            'kabupaten' => $kab,
            'kecamatan' => $kec,
            'desa' => $desa,
            'dusun' => htmlspecialchars($this->input->post('dusun', true)),
            'rw' => htmlspecialchars($this->input->post('rw', true)),
            'rt' => htmlspecialchars($this->input->post('rt', true)),
            'alamat_lengkap' => htmlspecialchars($this->input->post('alamat_lengkap', true)),
            'file_ktp' => '',
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
            'status_organisasi' => htmlspecialchars($this->input->post('status_organisasi', true)),
            'status_kepengurusan' => htmlspecialchars($this->input->post('status_kepengurusan', true)),
            'nama_kelompok_pengajian' => htmlspecialchars($this->input->post('kel_pengajian', true)),
            'dukungan' => 0,
            'target_suara' => 0,
            'add_by' => get_user()->id_user,
            'date_create' => date('Y-m-d')
        ];

        $this->db->insert('user', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'type' => 'result',
                'msg' => 'Anggota baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'success' => false,
                'type' => 'result',
                'msg' => 'Anggota baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function change_status_user(){
        validation_ajax_request();
        $id = $_POST['id'];
        $type = $_POST['type'];
        if ($type == 1) {
            $this->db->set('status', 1)->where('md5(sha1(id_user))', $id)->update('user');
        } else if ($type == 2) {
            $this->db->set('status', 0)->where('md5(sha1(id_user))', $id)->update('user');
        }

        if ($this->db->affected_rows() > 0) {
            $params = [
                'success' => true,
                'msg' => 'Status user berhasil di ubah'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Status user gagal di ubah'
            ];
        }
        echo json_encode($params);
    }

    public function delete_member(){
        validation_ajax_request();
        $id = $_POST['id'];
        $user = $this->db->where('md5(sha1(id_user))', $id)->get('user')->row();
        if($user->img != 'default.png'){
            unlink('./assets/img/user/'. $user->img);
        }
        if($user->file_ktp != null){
            unlink('./assets/img/ktp/'. $user->file_ktp);
        }
        $this->db->where('md5(sha1(id_user))', $id)->delete('user');

        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Data member berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Data member gagal di hapus'
            ];
        }
        echo json_encode($params);
    }

    public function get_member(){
        $id = $_POST['id'];
        $user = $this->m->get_member_relation_all($id)->row();
        echo json_encode($user);
    }
     
    public function import_member(){
        validation_ajax_request();
        $file = $_FILES['file'];

        if($file){
            $file_name = 'member_import_' . time();
            $config['upload_path']          = './assets/excel/import/';
            $config['allowed_types']        = 'xls|xlsx';
            $config['file_name']            = $file_name;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('file')){
                $file_path = $this->upload->data('full_path');
    
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);
                $data = $reader->getActiveSheet()->toArray();

              
                
                unset($data[0]);
                unset($data[1]);
                unset($data[2]);
                unset($data[3]);
                unset($data[4]);

                foreach($data as $t){
                    $date = date_create($t[4]);

                    $input_prov = ucwords($t[6]);
                    $input_kab = ucwords($t[7]);
                    $input_kec = ucwords($t[8]);
                    $input_desa = ucwords($t[9]);
                    $input_organisasi = $t[14];

                    $prov   =   $this->db->where('nama', $input_prov)->get('wilayah_provinsi')->row();

                    $kab    =   $this->db->select('wilayah_kabupaten.*')
                                ->from('wilayah_kabupaten')
                                ->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')
                                ->where('wilayah_provinsi.nama', $input_prov)
                                ->where('wilayah_kabupaten.nama', $input_kab)
                                ->get()->row();

                    $kec    =   $this->db->select('wilayah_kecamatan.*')
                                ->from('wilayah_kecamatan')
                                ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
                                ->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')
                                ->where('wilayah_provinsi.nama', $input_prov)
                                ->where('wilayah_kabupaten.nama', $input_kab)
                                ->where('wilayah_kecamatan.nama', ' '.$input_kec)
                                ->get()->row();

                    $desa   =   $this->db->select('wilayah_desa.*')
                                ->from('wilayah_desa')
                                ->join('wilayah_kecamatan', 'wilayah_desa.kecamatan_id = wilayah_kecamatan.id')
                                ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
                                ->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')
                                ->where('wilayah_provinsi.nama', $input_prov)
                                ->where('wilayah_kabupaten.nama', $input_kab)
                                ->where('wilayah_kecamatan.nama', ' '.$input_kec)
                                ->where('wilayah_desa.nama', $input_desa)
                                ->get()->row();

                    $get_organisasi = $this->db->where('nama_cabang', $input_organisasi)->get('cabang')->row();
                    if(isset($get_organisasi)){
                        $organisasi = $get_organisasi->id_cabang;
                    } else {
                        $organisasi = 0;
                    }

                    $nik = "$t[1]";
                    $rw = "$t[11]";
                    $rt = "$t[12]";
                    $telp = "$t[18]";
                    

                    $insert_data = [
                        'nama'              => $t[2],
                        'email'             => $t[19],
                        'password'          => md5(sha1($t[20])),
                        'status'            => 1,
                        'img'               => 'default.png',
                        'id_role'           => $t[17],
                        'nik'               => $nik,
                        'tanggal_lahir'     => date_format($date, 'Y-m-d'),
                        'tempat_lahir'      => $t[3],
                        'jenis_kelamin'     => $t[5],
                        'provinsi'          => $prov->id,
                        'kabupaten'         => $kab->id,
                        'kecamatan'         => $kec->id,
                        'desa'              => $desa->id,
                        'dusun'             => $t[10],
                        'rw'                => $rw,
                        'rt'                        => $rt,
                        'alamat_lengkap'            => $t[13],
                        'file_ktp'                  => '',
                        'no_telp'                   => $telp,
                        'status_organisasi'         => $organisasi,
                        'status_kepengurusan'       => $t[15],
                        'nama_kelompok_pengajian'   => $t[16],
                        'dukungan' => 0,
                        'target_suara' => 0,
                        'add_by' => get_user()->id_user,
                        'date_create' => date('Y-m-d')
                    ];

                    $this->db->insert('user', $insert_data);
                }
                
                if($this->db->affected_rows() > 0){
                    $params = [
                        'success' => true,
                        'msg' => 'File berhasil di import'
                    ];
                } else {
                    $params = [
                        'success' => false,
                        'msg' => 'File gagal di import'
                    ];
                }
           
               

            } else {
                $params = [
                    'success' => false,
                    'msg' => 'Gagal import file'
                ];
            }

        } else {
            $params = [
                'success' => false,
                'msg' => 'No file to upload'
            ];
        }
        echo json_encode($params);

    }

    public function edit_member(){
        validation_ajax_request();
        $telp = $this->input->post('no_telp');
        $nik = $this->input->post('nik');

        $get_telp = $this->db->where('no_telp', $telp)->get('user')->num_rows();
        $get_nik = $this->db->where('nik', $nik)->get('user')->num_rows();

        if($get_telp > 1){
            $params = [
                'type' => 'validation',
                'err_tlp' => 'No telp sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        if($get_nik > 1){
            $params = [
                'type' => 'validation',
                'err_nik' => 'NIK sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIk', 'required|trim|numeric');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim|numeric');
        $this->form_validation->set_rules('dusun', 'Dusun', 'required|trim');
        $this->form_validation->set_rules('rw', 'Rw', 'required|trim|numeric');
        $this->form_validation->set_rules('rt', 'Rt', 'required|trim|numeric');
       
        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_nama' => form_error('nama'),
                'err_tl' => form_error('tempat_lahir'),
                'err_tlp' => form_error('no_telp'),
                'err_dusun' => form_error('dusun'),
                'err_rw' => form_error('rw'),
                'err_rt' => form_error('rt'),
                'err_nik' => form_error('nik'),
            ];
            echo json_encode($params);
            die;
        } else {
            $id = $this->input->post('id_member');
            $prov = htmlspecialchars($this->input->post('provinsi', true));
            $kab = htmlspecialchars($this->input->post('kabupaten', true));
            $kec = htmlspecialchars($this->input->post('kecamatan', true));
            $desa = htmlspecialchars($this->input->post('desa', true));

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'id_role' => htmlspecialchars($this->input->post('role', true)),
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
                'provinsi' => $prov,
                'kabupaten' => $kab,
                'kecamatan' => $kec,
                'desa' => $desa,
                'dusun' => htmlspecialchars($this->input->post('dusun', true)),
                'rw' => htmlspecialchars($this->input->post('rw', true)),
                'rt' => htmlspecialchars($this->input->post('rt', true)),
                'alamat_lengkap' => htmlspecialchars($this->input->post('alamat_lengkap', true)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'status_organisasi' => htmlspecialchars($this->input->post('status_organisasi', true)),
                'status_kepengurusan' => htmlspecialchars($this->input->post('status_kepengurusan', true)),
                'nama_kelompok_pengajian' => htmlspecialchars($this->input->post('kel_pengajian', true)),
            ];
            $this->db->where('md5(sha1(id_user))', $id)->update('user', $data);
            if($this->db->affected_rows() > 0){
                $params = [
                    'success' => true,
                    'type' => 'result',
                    'msg' => 'Data anggota berhasil di edit'
                ];
            } else {
                $params = [
                    'success' => false,
                    'type' => 'result',
                    'msg' => 'Data anggota gagal di edit'
                ];
            }
            echo json_encode($params);
        }

    }    

    public function get_img_member(){
        validation_ajax_request();
        $id = $_POST['id'];
        $member = $this->db->get_where('user', ['md5(sha1(id_user))' => $id])->row();
        if($member->img){
            $output = '<center><img class="img-thumbnail" src="'.base_url('assets/img/user/').$member->img.'" width="50%"></center>';
        } else {
            $output = '<center><i>No image user<i></center>';
        }
        echo $output;
    }

    private function crop_image_user($file = null){
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/img/user/' . $file;
        $config['maintain_ratio'] = false;
        $config['width']         = 512;
        $config['height']       = 512;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
    }

    public function edit_foto_member(){
        validation_ajax_request();
        $id = $_POST['id_member'];
        $user = $this->db->where('md5(sha1(id_user))', $id)->get('user')->row();
        $file  = $_FILES['file_upload'];
        if($file){
            
            $file_name = 'lsn_user_' . time();
            $config['upload_path'] = './assets/img/user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $file_name;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('file_upload')){
                $file_upload = $this->upload->data('file_name');
                $this->crop_image_user($file_upload);

                if($user->img != 'default.png'){
                    unlink('./assets/img/user/' . $user->img);
                }
            } else {
               $file_upload = $user->img;
            }
        }
        $this->db->set('img', $file_upload)->where('md5(sha1(id_user))', $id)->update('user');
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Foto member berhasil di edit'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Foto member gagal di edit'
            ];
        }

        echo json_encode($params);
    }

    public function get_member_ktp(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data_member = $this->db->get_where('user', ['md5(sha1(id_user))' => $id])->row();
        if($data_member->file_ktp){
            $output = '<center><img src="'.base_url('assets/img/ktp/').$data_member->file_ktp.'" width="70%" class="img-thumbnail"></center>';
        } else {
            $output = '<center><i>No image KTP</i></center>';
        }
        echo $output;
    }

    public function edit_member_ktp(){
        validation_ajax_request();
        $id = $_POST['id_member'];
        $img = $_FILES['img_ktp'];
        $user = $this->db->where('md5(sha1(id_user))', $id)->get('user')->row();
        
        if($img){
            $file_name = 'lsn_ktp_' . time();
            $config['upload_path'] = './assets/img/ktp/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $file_name;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('img_ktp')){
                $file_upload = $this->upload->data('file_name');
                if($user->file_ktp){
                    unlink('./assets/img/ktp/' . $user->file_ktp);
                }
                
            } else {
               $file_upload = $user->img;
            }
        }

        $this->db->set('file_ktp', $file_upload)->where('md5(sha1(id_user))', $id)->update('user');

        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'KTP berhasil di edit'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'KTP gagal di edit'
            ];
        }
        echo json_encode($params);
    }

    public function download_template(){
        
            // Set headers for file download
            $file_name = 'template_data.xlsx';
            $file_path = './assets/excel/template/' . $file_name;
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$file_name);
            header("Pragma: no-cache");
            header("Expires: 0");
            
            // Read file and output to browser
            readfile($file_path);
            exit();
          
    }

    public function export_data(){
        // validation_ajax_request();
        $prov = htmlspecialchars($this->input->post('provinsi'));
        $kab = htmlspecialchars($this->input->post('kabupaten'));
        $kec = htmlspecialchars($this->input->post('kecamatan'));
        $desa = htmlspecialchars($this->input->post('desa'));
        $org = htmlspecialchars($this->input->post('organisasi'));

        $data = $this->m->get_all_member_for_export($prov, $kab, $kec, $desa, $org)->result();

        $nik = htmlspecialchars($this->input->post('nik'));
        $nama = htmlspecialchars($this->input->post('nama'));
        $email = htmlspecialchars($this->input->post('email'));
        $telp = htmlspecialchars($this->input->post('telp'));
        $role = htmlspecialchars($this->input->post('role'));
        $tmp_lahir = htmlspecialchars($this->input->post('tmp_lahir'));
        $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $check_prov = htmlspecialchars($this->input->post('prov'));
        $check_kab = htmlspecialchars($this->input->post('kab'));
        $check_kec = htmlspecialchars($this->input->post('kec'));
        $check_desa = htmlspecialchars($this->input->post('des'));
        $dusun = htmlspecialchars($this->input->post('dusun'));
        $rw = htmlspecialchars($this->input->post('rw'));
        $rt = htmlspecialchars($this->input->post('rt'));
        $stat_org = htmlspecialchars($this->input->post('stat_org'));
        $stat_kep = htmlspecialchars($this->input->post('stat_kep'));
        $pengajian = htmlspecialchars($this->input->post('pengajian'));

        $html = '';
        $no = 1;
        foreach($data as $d){

            $get_role = $this->db->where('id_role', $d->id_role)->get('role_user')->row();
            $get_prov = $this->db->where('id', $d->provinsi)->get('wilayah_provinsi')->row();
            $get_kab = $this->db->where('id', $d->kabupaten)->get('wilayah_kabupaten')->row();
            $get_kec = $this->db->where('id', $d->kecamatan)->get('wilayah_kecamatan')->row();
            $get_desa = $this->db->where('id', $d->desa)->get('wilayah_desa')->row();
            $get_organisasi = $this->db->where('id_cabang', $d->status_organisasi)->get('cabang')->row();


            if($get_role){
                $result_role = $get_role->nama_role;
            } else {
                $result_role = "";
            }

            if($get_prov){
                $result_prov = $get_prov->nama;
            } else {
                $result_prov = "";
            }

            if($get_kab){
                $result_kab = $get_kab->nama;
            } else {
                $result_kab = "";
            }

            if($get_kec){
                $result_kec = $get_kec->nama;
            } else {
                $result_kec = "";
            }

            if($get_desa){
                $result_desa = $get_desa->nama;
            } else {
                $result_desa = "";
            }

            if($get_organisasi){
                $result_organisasi = $get_organisasi->nama_cabang;
            } else {
                $result_organisasi = "";
            }


            $row = "<td>".$no++."</td>";

            if($nik){
                $show_nik = "<td>$d->nik</td>";
            } else {
                $show_nik = "";
            }

            if($nama){
                $show_nama = "<td>$d->nama</td>";
            } else {
                $show_nama = "";
            }

            if($email){
                $show_email = "<td>$d->email</td>";
            } else {
                $show_email = "";
            }

            if($telp){
                $show_telp = "<td>$d->no_telp</td>";
            } else {
                $show_telp = "";
            }

            if($role){
                $show_role = "<td>$result_role</td>";
            } else {
                $show_role = "";
            }

            if($tmp_lahir){
                $show_tmp_lahir = "<td>$d->tempat_lahir</td>";
            } else {
                $show_tmp_lahir = "";
            }

            if($tgl_lahir){
                $show_tgl_lahir = "<td>$d->tanggal_lahir</td>";
            } else {
                $show_tgl_lahir = "";
            }

            if($alamat){
                $show_alamat = "<td>$d->alamat_lengkap</td>";
            } else {
                $show_alamat = "";
            }

            if($alamat){
                $show_alamat = "<td>$d->alamat_lengkap</td>";
            } else {
                $show_alamat = "";
            }

            if($check_prov){
                $show_prov = "<td>$result_prov</td>";
            } else {
                $show_prov = "";
            }

            if($check_kab){
                $show_kab = "<td>$result_kab</td>";
            } else {
                $show_kab = "";
            }

            if($check_kec){
                $show_kec = "<td>$result_kec</td>";
            } else {
                $show_kec = "";
            }

            if($check_desa){
                $show_desa = "<td>$result_desa</td>";
            } else {
                $show_desa = "";
            }

            if($dusun){
                $show_dusun = "<td>$d->dusun</td>";
            } else {
                $show_dusun = "";
            }

            if($rw){
                $show_rw = "<td>$d->rw</td>";
            } else {
                $show_rw = "";
            }

            if($rt){
                $show_rt = "<td>$d->rt</td>";
            } else {
                $show_rt = "";
            }

            if($stat_org){
                $show_org = "<td>$result_organisasi</td>";
            } else {
                $show_org = "";
            }

            if($stat_kep){
                $show_kep = "<td>$d->status_kepengurusan</td>";
            } else {
                $show_kep = "";
            }

            if($pengajian){
                $show_pengajian = "<td>$d->nama_kelompok_pengajian</td>";
            } else {
                $show_pengajian = "";
            }


            $html .= "<tr>
                ".
                   $row.
                   $show_nik.
                   $show_nama.
                   $show_email.
                   $show_telp.
                   $show_role.
                   $show_tmp_lahir.
                   $show_tgl_lahir.
                   $show_alamat.
                   $show_prov.
                   $show_kab.
                   $show_kec.
                   $show_desa.
                   $show_dusun.
                   $show_rw.
                   $show_rt.
                   $show_org.
                   $show_kep.
                   $show_pengajian
                ."
            </tr>";
        }
        
        if($nik){
            $cell_nik = "<th>NIK</th>";
        } else {
            $cell_nik = "";
        }

        if($nama){
            $cell_nama = "<th>Nama Lengkap</th>";
        } else {
            $cell_nama = "";
        }

        if($email){
            $cell_email = "<th>Email</th>";
        } else {
            $cell_email = "";
        }

        if($telp){
            $cell_telp = "<th>No. Telp</th>";
        } else {
            $cell_telp = "";
        }

        if($role){
            $cell_role = "<th>Role</th>";
        } else {
            $cell_role = "";
        }

        if($tmp_lahir){
            $cell_temp_lahir = "<th>Tempat Lahir</th>";
        } else {
            $cell_temp_lahir = "";
        }

        if($tgl_lahir){
            $cell_tgl_lahir = "<th>Tanggal Lahir</th>";
        } else {
            $cell_tgl_lahir = "";
        }

        if($alamat){
            $cell_alamat = "<th>Alamat</th>";
        } else {
            $cell_alamat = "";
        }

        if($check_prov){
            $cell_prov = "<th>Provinsi</th>";
        } else {
            $cell_prov = "";
        }

        if($check_kab){
            $cell_kab = "<th>Kabupaten</th>";
        } else {
            $cell_kab = "";
        }

        if($check_kec){
            $cell_kec = "<th>Kecamatan</th>";
        } else {
            $cell_kec = "";
        }

        if($check_desa){
            $cell_desa = "<th>Desa</th>";
        } else {
            $cell_desa = "";
        }

        if($dusun){
            $cell_dusun = "<th>Dusun</th>";
        } else {
            $cell_dusun = "";
        }

        if($rw){
            $cell_rw = "<th>Rw</th>";
        } else {
            $cell_rw = "";
        }

        if($rt){
            $cell_rt = "<th>Rt</th>";
        } else {
            $cell_rt = "";
        }

        if($stat_org){
            $cell_organisasi = "<th>Status Organisasi</th>";
        } else {
            $cell_organisasi = "";
        }

        if($stat_kep){
            $cell_kepengurusan = "<th>Status Kepengurusan</th>";
        } else {
            $cell_kepengurusan = "";
        }

        if($pengajian){
            $cell_pengajian = "<th>Kelompok Pengajian</th>";
        } else {
            $cell_pengajian = "";
        }


        $test="<table>
                    <tr>
                        <th>No</th>
                        ".
                            $cell_nik.
                            $cell_nama.
                            $cell_email.
                            $cell_telp.
                            $cell_role.
                            $cell_temp_lahir.
                            $cell_tgl_lahir.
                            $cell_alamat.
                            $cell_prov.
                            $cell_kab.
                            $cell_kec.
                            $cell_desa.
                            $cell_dusun.
                            $cell_rw.
                            $cell_rt.
                            $cell_organisasi.
                            $cell_kepengurusan.
                            $cell_pengajian
                        ."
                    </tr>
                    ".$html."
                    
                </table>";
        $file="demo.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $test;
    }


    //master dapil

    public function dapil(){
        access_menu();
        $data = [
            'title' => 'Master Dapil',
            'user' => get_user(),
            'view' => 'master/dapil',
            'caleg' => $this->db->get('caleg')->result(),
            'provinsi' => $this->db->get('wilayah_provinsi')->result(),
        ];
        $this->load->view('template', $data);
    }

    public function add_dapil(){
        validation_ajax_request();
        $this->form_validation->set_rules('dapil', 'Nama Dapil', 'required|trim');
        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_dapil' => form_error('dapil')
            ];
            echo json_encode($params);
            die;
        } else {
            $dapil = htmlspecialchars($this->input->post('dapil'));
            $caleg = htmlspecialchars($this->input->post('caleg'));
            $prov = htmlspecialchars($this->input->post('prov'));
            $kab = htmlspecialchars($this->input->post('kab'));

            if($caleg == 1){
                $data_ada = $this->db->where([
                    'nama_dapil' => $dapil,
                    'id_caleg' => $caleg
                ])->get('dapil')->num_rows();

                if($data_ada > 0){
                    $params = [
                        'type' => 'validation',
                        'err_dapil' => 'Dapil sudah terdaftar'
                    ];
                    echo json_encode($params);
                    die;
                } else {
                    $this->insert_data_dapil($dapil, $caleg, $prov, $kab);
                }
            } else if($caleg == 2){
                $data_ada = $this->db->where([
                    'nama_dapil' => $dapil,
                    'id_caleg' => $caleg,
                    'wilayah_provinsi' => $prov
                ])->get('dapil')->num_rows();

                if($data_ada > 0){
                    $params = [
                        'type' => 'validation',
                        'err_dapil' => 'Dapil sudah terdaftar'
                    ];
                    echo json_encode($params);
                    die;
                } else {
                    $this->insert_data_dapil($dapil, $caleg, $prov, $kab);
                }
            } else if($caleg == 3){
                $data_ada = $this->db->where([
                    'nama_dapil' => $dapil,
                    'id_caleg' => $caleg,
                    'wilayah_provinsi' => $prov,
                    'wilayah_kabupaten' => $kab
                ])->get('dapil')->num_rows();

                if($data_ada > 0){
                    $params = [
                        'type' => 'validation',
                        'err_dapil' => 'Dapil sudah terdaftar'
                    ];
                    echo json_encode($params);
                    die;
                } else {
                    $this->insert_data_dapil($dapil, $caleg, $prov, $kab);
                }
            }

        }


    }

    private function insert_data_dapil($dapil = null, $caleg = null, $prov = null, $kab = null){
        $data  = [
            'id_caleg' => $caleg,
            'nama_dapil' => $dapil,
            'wilayah_provinsi' => $prov,
            'wilayah_kabupaten' => $kab
        ];
        $this->db->insert('dapil', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'success' => true,
                'msg' => 'Data dapil baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Data dapil baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function add_list_wilayah(){
        validation_ajax_request();

        $id_dapil = htmlspecialchars($this->input->post('id_dapil'));
        $prov = htmlspecialchars($this->input->post('prov'));
        $kab = htmlspecialchars($this->input->post('kab'));
        $kec = htmlspecialchars($this->input->post('kec'));


        $data = [
            'id' => $id_dapil,
            'qty' => 1,
            'price' => 1,
            'name' => time(),
            'options' => [
                'prov' => $prov,
                'kab' => $kab,
                'kec' => $kec
            ]
        ];

        $this->cart->insert($data);
    }

    public function load_list_wilayah_cart(){
        validation_ajax_request();
        
        $list = '';
        foreach($this->cart->contents() as  $c){
            $prov = $c['options']['prov'];
            $kab = $c['options']['kab'];
            $kec = $c['options']['kec'];

            if($kec == null || $kec == '' || $kec == 0){
                $data_prov = $this->db->where('id', $prov)->get('wilayah_provinsi')->row();
                $data_kab = $this->db->where('id', $kab)->get('wilayah_kabupaten')->row();

                $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama.'
                    <div class="float-right">
                        <button class="btn btn-sm btn-danger delete_list_cart" data-id="'.$c['rowid'].'">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </li>';
            } else {
                $data_prov = $this->db->where('id', $prov)->get('wilayah_provinsi')->row();
                $data_kab = $this->db->where('id', $kab)->get('wilayah_kabupaten')->row();
                $data_kec = $this->db->where('id', $kec)->get('wilayah_kecamatan')->row();

                $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama. ' / '.$data_kec->nama.'
                    <div class="float-right">
                        <button class="btn btn-sm btn-danger delete_list_cart" data-id="'.$c['rowid'].'">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </li>';
            }

            
        }

      echo $list;
    }

    public function delete_list_cart(){
        validation_ajax_request();
        $id = $_POST['id'];
        $this->cart->remove($id);
    }

    public function add_wilayah_dapil(){
        validation_ajax_request();

        $list = $this->cart->contents();

        if($list != null){
            
            foreach($list as $l){
                $prov = $l['options']['prov'];
                $kab = $l['options']['kab'];
                $kec = $l['options']['kec'];
                $id_dapil = $l['id'];

                $data = [
                    'id_dapil' => $id_dapil,
                    'id_provinsi' => $prov,
                    'id_kabupaten' => $kab,
                    'id_kecamatan' => $kec
                ];
                $this->db->insert('dapil_wilayah', $data);
            }   

            if($this->db->affected_rows() > 0){
                $this->cart->destroy();
                $params = [
                    'success' => true,
                    'msg' => 'Data wilayah berhasil di tambahkan'
                ];
            } else {
                $params = [
                    'success' => false,
                    'msg' => 'Data wilayah gagal di tambahkan'
                ];
            }

        } else {
            $params = [
                'success' => false,
                'msg' => 'Tidak ada wilayah untuk di tambahkan'
            ];
        }
        echo json_encode($params);

    }
    
    public function delete_wilayah_dapil(){
        validation_ajax_request();
        $id = $_POST['id'];
        $this->db->where('md5(sha1(id_wilayah))', $id)->delete('dapil_wilayah');
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Wilayah dapil berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Wilayah dapil gagal di hapus'
            ];
        }
        echo json_encode($params);

    }

    public function get_data_dapil(){
        validation_ajax_request();

        $caleg = $_POST['caleg'];

        if($caleg == 1){
            $data = $this->db->where('id_caleg', $caleg)->get('dapil')->result();
        } else if($caleg == 2){
            $prov = $_POST['prov'];
            $data = $this->db->where(['id_caleg' => $caleg, 'wilayah_provinsi' => $prov])->get('dapil')->result();
        } else if($caleg == 3){
            $kab = $_POST['kab'];
            $prov = $_POST['prov'];
            $data = $this->db->where(['id_caleg' => $caleg, 'wilayah_provinsi' => $prov, 'wilayah_kabupaten' => $kab])->get('dapil')->result();
        }
        echo json_encode($data);
    }

    public function add_data_dapil_caleg(){
        validation_ajax_request();

        $dapil = htmlspecialchars($this->input->post('dapil'));

        if($dapil){
            $user = get_user();
            $this->db->set('dapil_id', $dapil)->where('id_user', $user->id_user)->update('user');

            if($this->db->affected_rows() > 0){
                $params = [
                    'success' => true,
                    'msg' => 'Data dapil berhasil di tambahkan'
                ]; 
            } else {
                $params = [
                    'success' => false,
                    'msg' => 'Data dapil gagal di tambahkan'
                ]; 
            }

        } else {
            $params = [
                'success' => false,
                'msg' => 'Tidak data dapil untuk di tambahkan'
            ]; 
        }
        echo json_encode($params);
    }

    public function get_wilayah_dapil(){
        validation_ajax_request();
        $id_dapil = $_POST['id'];
        $data_wilayah = $this->db->where('id_dapil', $id_dapil)->get('dapil_wilayah')->result();
        $list = '';

        if($data_wilayah){

            foreach($data_wilayah as $d){
                if($d->id_kecamatan == 0 || $d->id_wilayah == null){
                    $data_prov = $this->db->where('id', $d->id_provinsi)->get('wilayah_provinsi')->row();
                    $data_kab = $this->db->where('id', $d->id_kabupaten)->get('wilayah_kabupaten')->row();

                    $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama.'</li>';
                } else {
                    $data_prov = $this->db->where('id', $d->id_provinsi)->get('wilayah_provinsi')->row();
                    $data_kab = $this->db->where('id', $d->id_kabupaten)->get('wilayah_kabupaten')->row();
                    $data_kec = $this->db->where('id', $d->id_kecamatan)->get('wilayah_kecamatan')->row();

                    $list .= '<li class="list-group-item">'.$data_prov->nama.' / '.$data_kab->nama. ' / '.$data_kec->nama.'</li>';
                }
            }

        } else {
            $list = '<li class="list-group-item list-group-item-danger">No data result</li>';
        }

        $html = '<p class="text-center mb-3
        "><strong>List Wilayah Dapil</strong></p> <br> '.$list;

        echo $html;
    }

    public function delete_dapil(){
        validation_ajax_request();

        $id = $_POST['id'];
        $this->db->where('md5(sha1(id_dapil))', $id)->delete('dapil');
        $this->db->where('md5(sha1(id_dapil))', $id)->delete('dapil_wilayah');
        
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Data dapil berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Data dapil gagal di hapus'
            ];
        }
        echo json_encode(($params));
    }

}