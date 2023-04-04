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
            'cabang' => $this->db->get('cabang')->result()
        ];
        $this->load->view('template', $data);
    }

    public function get_kabupaten(){
        validation_ajax_request();
        $prov = $_POST['id'];
        $data = $this->db->select('wilayah_kabupaten.*')->from('wilayah_kabupaten')->join('wilayah_provinsi', 'wilayah_kabupaten.provinsi_id = wilayah_provinsi.id')->where('wilayah_provinsi.id', $prov)->get()->result();
        echo json_encode($data);
    }

    public function get_kecamatan(){
        validation_ajax_request();
        $req = $_POST['id'];
        $this->db->select('wilayah_kecamatan.*')
        ->from('wilayah_kecamatan')
        ->join('wilayah_kabupaten', 'wilayah_kecamatan.kabupaten_id = wilayah_kabupaten.id')
        ->where('wilayah_kabupaten.id', $req);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    public function get_kelurahan(){
        validation_ajax_request();
        $req = $_POST['id'];
        $this->db->select('wilayah_desa.*')
        ->from('wilayah_desa')
        ->join('wilayah_kecamatan', 'wilayah_kecamatan.id = wilayah_desa.kecamatan_id')
        ->where('wilayah_kecamatan.id', $req);
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

        // $get_prov = $this->db->where('id', $prov)->get('wilayah_provinsi')->row();
        // $get_kab = $this->db->where('id', $kab)->get('wilayah_kabupaten')->row();
        // $get_kec = $this->db->where('id', $kec)->get('wilayah_kecamatan')->row();
        // $get_desa = $this->db->where('id', $desa)->get('wilayah_desa')->row();

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

                    $insert_data = [
                        'nama'              => $t[2],
                        'email'             => $t[19],
                        'password'          => md5(sha1($t[20])),
                        'status'            => 1,
                        'img'               => 'default.png',
                        'id_role'           => $t[17],
                        'nik'               => $t[1],
                        'tanggal_lahir'     => date_format($date, 'Y-m-d'),
                        'tempat_lahir'      => $t[3],
                        'jenis_kelamin'     => $t[5],
                        'provinsi'          => $prov->id,
                        'kabupaten'         => $kab->id,
                        'kecamatan'         => $kec->id,
                        'desa'              => $desa->id,
                        'dusun'             => $t[10],
                        'rw'                => $t[11],
                        'rt'                        => $t[12],
                        'alamat_lengkap'            => $t[13],
                        'file_ktp'                  => '',
                        'no_telp'                   => $t[18],
                        'status_organisasi'         => $organisasi,
                        'status_kepengurusan'       => $t[15],
                        'nama_kelompok_pengajian'   => $t[16]
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


}
