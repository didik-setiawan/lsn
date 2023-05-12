<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();
    }

	public function index()
	{
		redirect('welcome/pendukung');
	}

	public function pendukung(){
		access_menu();

        $user = get_user();

        if($user->id_role == 2){
            
            $this->db->select('
            wilayah_provinsi.*,
            ')
            ->from('wilayah_provinsi')
            ->join('penempatan_relawan', 'wilayah_provinsi.id = penempatan_relawan.id_provinsi')
            ->where('penempatan_relawan.id_relawan', $user->id_user)
            ->group_by('wilayah_provinsi.id')
            ;
            $prov = $this->db->get()->result();

        } else if($user->id_role == 4){
            $prov = $this->db->get('wilayah_provinsi')->result();
        }


		$data = [
            'title' => 'Pendukung',
            'user' => get_user(),
            'view' => 'welcome/pendukung',
			'provinsi' => $prov,
            'cabang' => $this->db->get('cabang')->result()
        ];
        $this->load->view('template', $data);
	}

	private function validation_member(){
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|is_unique[user.nik]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|numeric|is_unique[user.no_telp]');
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

	public function add_pendukung(){
        validation_ajax_request();
		$this->validation_member();
        date_default_timezone_set('Asia/Jakarta');

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
            'id_role' => 3,
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
            'dukungan' => get_user()->id_user,
            'target_suara' => 0,
            'add_by' => get_user()->id_user,
            'date_create' => date('Y-m-d')
        ];

        $this->db->insert('user', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'type' => 'result',
                'msg' => 'Pendukung baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'success' => false,
                'type' => 'result',
                'msg' => 'Pendukung baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
	}

    public function change_role_member($id = null){
        validation_ajax_request();

        $this->db->set('id_role', 2)->where('md5(sha1(id_user))', $id)->update('user');
        if($this->db->affected_rows() > 0) {
            $output = [
                'success' => true,
                'msg' => 'Relawan baru berhasil di tambahkan'
            ];
        } else {
            $output = [
                'success' => false,
                'msg' => 'Relawan baru gagal di tambahkan'
            ];
        }
        echo json_encode($output);

    }

    public function hapus_member($id = null){
        validation_ajax_request();

        $this->db->where('md5(sha1(id_user))', $id)->delete('user');
        if($this->db->affected_rows() > 0){
            $output = [
                'success' => true, 
                'msg' => 'Member berhasil di hapus'
            ];
        } else {
            $output = [
                'success' => false, 
                'msg' => 'Member gagal di hapus'
            ];
        }
        echo json_encode($output);
    }

    public function edit_pendukung(){
        validation_ajax_request();
        $telp = $this->input->post('no_telp');
        $nik = $this->input->post('nik');

        $get_telp = $this->db->where('no_telp', $telp)->get('user')->num_rows();
        $get_nik = $this->db->where('nik', $nik)->get('user')->num_rows();

        if($telp != null && $get_telp > 1){
            $params = [
                'type' => 'validation',
                'err_tlp' => 'No telp sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        if($nik != null && $get_nik > 1){
            $params = [
                'type' => 'validation',
                'err_nik' => 'NIK sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIk', 'trim|numeric');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|numeric');
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

    public function check_status_penempatan_relawan(){
        validation_ajax_request();

        $id = $_POST['id'];
        $data = $this->m->get_penempatan_relawan($id)->num_rows();
        $user = $this->db->where('md5(sha1(id_user))', $id)->get('user')->row();


        if($data == 0){
            $output = [
                'type' => false,
                'id' => $user->id_user,
            ];
        } else if($data > 0) {
            $get_data = $this->m->get_penempatan_relawan($id)->row();
            $output = [
                'type' => true,
                'id' => $user->id_user,
            ];
        } 
        echo json_encode($output);
    }

    public function add_penempatan_relawan(){
        validation_ajax_request();

        $id = $this->input->post('id_relawan');
        $provinsi = htmlspecialchars($this->input->post('provinsi', true));
        $kabupaten = htmlspecialchars($this->input->post('kabupaten', true));
        $kecamatan = htmlspecialchars($this->input->post('kecamatan', true));
        $desa = $this->input->post('desa');
        $tps = htmlspecialchars($this->input->post('tps', true));

        $data = [
            'id_relawan' => $id,
            'id_provinsi' => $provinsi,
            'id_kabupaten' => $kabupaten,
            'id_kecamatan' => $kecamatan,
            'id_desa' => $desa,
            'no_tps' => $tps
        ];
        $this->db->insert('penempatan_relawan', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Data berhasil di tambahkan'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Data gagal di tambahkan'
            ];
        }
        echo json_encode($params);

    }

    public function get_penempatan_relawan_row(){
        validation_ajax_request();

        $id = $_POST['id'];
        $data = $this->db->where('md5(sha1(id_penempatan))', $id)->get('penempatan_relawan')->row();
        
        echo json_encode($data);
    }

    public function edit_penempatan_relawan(){
        validation_ajax_request();

        $id = $this->input->post('id_relawan');
        $provinsi = htmlspecialchars($this->input->post('provinsi', true));
        $kabupaten = htmlspecialchars($this->input->post('kabupaten', true));
        $kecamatan = htmlspecialchars($this->input->post('kecamatan', true));
        $desa = $this->input->post('desa');
        $tps = htmlspecialchars($this->input->post('tps', true));

        $data = [
            'id_provinsi' => $provinsi,
            'id_kabupaten' => $kabupaten,
            'id_kecamatan' => $kecamatan,
            'id_desa' => $desa,
            'no_tps' => $tps
        ];

        $this->db->where('md5(sha1(id_penempatan))', $id)->update('penempatan_relawan', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Data berhasil di edit'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Data gagal di edit'
            ];
        }
        echo json_encode($params);
    }

    public function delete_penempatan_relawan(){
        validation_ajax_request();

        $id = $_POST['id'];
        $this->db->where('md5(sha1(id_penempatan))', $id)->delete('penempatan_relawan');
        if($this->db->affected_rows() > 0){
            $params = [
                'success' =>true,
                'msg' => 'Penempatan relawan berhasil di hapus'
            ];
        } else {
            $params = [
                'success' =>false,
                'msg' => 'Penempatan relawan gagal di hapus'
            ];
        }
        echo json_encode($params);
        
    }

    public function add_pendukung_by_relawan(){
        validation_ajax_request();
		$this->validation_member();
        date_default_timezone_set('Asia/Jakarta');

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
            'id_role' => 3,
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
            'dukungan' => get_user()->dukungan,
            'target_suara' => 0,
            'add_by' => get_user()->id_user,
            'date_create' => date('Y-m-d')
        ];

        $this->db->insert('user', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'type' => 'result',
                'msg' => 'Pendukung baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'success' => false,
                'type' => 'result',
                'msg' => 'Pendukung baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function kegiatan(){
		access_menu();
        $data = [
            'title' => 'Kegiatan',
            'user' => get_user(),
            'view' => 'welcome/kegiatan'
        ];
        $this->load->view('template', $data);
    }

    public function add_kegiatan(){
        $data = [
            'tgl' => htmlspecialchars($this->input->post('tgl')),
            'ket' => htmlspecialchars($this->input->post('ket')),
            'loc' => htmlspecialchars($this->input->post('loc')),
            'jml' => htmlspecialchars($this->input->post('jml')),
        ];
    }

    public function get_prov(){
        $user = get_user();
        $req = '3509140';

        $this->db->select('wilayah_desa.*')
            ->from('wilayah_desa')
            ->join('wilayah_kecamatan', 'wilayah_kecamatan.id = wilayah_desa.kecamatan_id')
            ->join('penempatan_relawan', 'wilayah_desa.id = penempatan_relawan.id_desa')
            ->where('penempatan_relawan.id_relawan', $user->id_user)
            ->where('wilayah_kecamatan.id', $req)
            ->group_by('wilayah_desa.id');

        $data = $this->db->get()->result();

        var_dump($data);
    }

}
