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
            $this->db->select('wilayah_provinsi.*')
            ->from('wilayah_provinsi')
            ->join('dapil_wilayah', 'wilayah_provinsi.id = dapil_wilayah.id_provinsi')
            ->where('dapil_wilayah.id_dapil', $user->dapil_id)
            ->group_by('wilayah_provinsi.id');

            $prov = $this->db->get()->result();
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
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|numeric|is_unique[user.no_telp]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]');
        $this->form_validation->set_rules('dusun', 'Dusun', 'trim');
        $this->form_validation->set_rules('rw', 'Rw', 'trim|numeric');
        $this->form_validation->set_rules('rt', 'Rt', 'trim|numeric');
       
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

        if($telp != null && $get_telp > 1 || $telp != 0 && $get_telp > 1){
            $params = [
                'type' => 'validation',
                'err_tlp' => 'No telp sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        if($nik != null && $get_nik > 1 || $nik != 0 && $get_nik > 1){
            $params = [
                'type' => 'validation',
                'err_nik' => 'NIK sudah terdaftar'
            ];
            echo json_encode($params);die;
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIk', 'trim|numeric');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|numeric');
        $this->form_validation->set_rules('dusun', 'Dusun', 'trim');
        $this->form_validation->set_rules('rw', 'Rw', 'trim|numeric');
        $this->form_validation->set_rules('rt', 'Rt', 'trim|numeric');
       
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

    private function validation_kegiatan(){
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('loc', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('jml', 'Jumlah Peserta', 'required|trim|numeric');
        if($this->form_validation->run() == false){
            $params = [
                'type' => 'validation',
                'err_ket' =>form_error('ket'),
                'err_loc' => form_error('loc'),
                'err_jml' => form_error('jml')
            ];
            echo json_encode($params);
            die;
        } else {
            return true;
        }     
    }

    public function add_kegiatan(){
        validation_ajax_request();
        $this->validation_kegiatan();
        $time_foto = time();
        //upload foto kegiatan
        
        $count = count($_FILES['foto']['name']);

        for($i=0; $i<$count; $i++){
            if(!empty($_FILES['foto']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['foto']['name'][$i];  
                $_FILES['file']['type'] = $_FILES['foto']['type'][$i];  
                $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];  
                $_FILES['file']['error'] = $_FILES['foto']['error'][$i];  
                $_FILES['file']['size'] = $_FILES['foto']['size'][$i]; 


                $config['upload_path'] = './assets/img/kegiatan/';   
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['foto']['name'][$i]; 

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){  
                    $file_name = $this->upload->data('file_name');
                } else {
                    $params = [
                        'type' => 'result',
                        'status' => false,
                        'msg' => 'Foto Gagal di upload'
                    ];
                    echo json_encode($params);
                    die;
                }

                $data = [
                    'kegiatan' => $time_foto,
                    'file' => $file_name
                ];

                $this->db->insert('kegiatan_foto', $data);

            } else {
                $params = [
                    'type' => 'result',
                    'status' => false,
                    'msg' => 'No media to upload'
                ];
                echo json_encode($params);
                die;
            }
        }

        $user = get_user();
        $data = [
            'id_relawan' => $user->id_user,
            'tgl' => htmlspecialchars($this->input->post('tgl')),
            'keterangan' => htmlspecialchars($this->input->post('ket')),
            'tempat' => htmlspecialchars($this->input->post('loc')),
            'jml_peserta' => htmlspecialchars($this->input->post('jml')),
            'foto_kegiatan' => $time_foto
        ];
        $this->db->insert('kegiatan', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Kegiatan baru berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Kegiatan baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function delete_photo_kegiatan(){
        validation_ajax_request();
        $id = $_POST['id'];
        $file = $this->db->where('md5(sha1(id_foto))', $id)->get('kegiatan_foto')->row()->file;
        unlink(FCPATH .'assets/img/kegiatan/'.$file);

        $this->db->where('md5(sha1(id_foto))', $id)->delete('kegiatan_foto');
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Foto berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Foto gagal di hapus'
            ];
        }
        echo json_encode($params);
    }

    public function add_new_photo_kegiatan(){
        validation_ajax_request();
        $count = count($_FILES['foto']['name']);
        $time_foto = $this->input->post('kegiatan');

        for($i=0; $i<$count; $i++){
            if(!empty($_FILES['foto']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['foto']['name'][$i];  
                $_FILES['file']['type'] = $_FILES['foto']['type'][$i];  
                $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];  
                $_FILES['file']['error'] = $_FILES['foto']['error'][$i];  
                $_FILES['file']['size'] = $_FILES['foto']['size'][$i]; 


                $config['upload_path'] = './assets/img/kegiatan/';   
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['foto']['name'][$i]; 

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){  
                    $file_name = $this->upload->data('file_name');
                } else {
                    $params = [
                        'type' => 'result',
                        'status' => false,
                        'msg' => 'Foto Gagal di upload'
                    ];
                    echo json_encode($params);
                    die;
                }

                $data = [
                    'kegiatan' => $time_foto,
                    'file' => $file_name
                ];

                $this->db->insert('kegiatan_foto', $data);

            } else {
                $params = [
                    'type' => 'result',
                    'status' => false,
                    'msg' => 'No media to upload'
                ];
                echo json_encode($params);
                die;
            }
        }

        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Foto Baru Berhasil di tambahkan'
            ];
        } else {
            $params = [
                'type' => 'result',
                'status' => false,
                'msg' => 'Foto Baru gagal di tambahkan'
            ];
        }
        echo json_encode($params);
    }

    public function get_data_kegiatan_row(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = $this->db->where('md5(sha1(id_kegiatan))', $id)->get('kegiatan')->row();
        echo json_encode($data);
    }

    public function edit_kegiatan(){
        validation_ajax_request();
        $this->validation_kegiatan();

        $user = get_user();
        $id = $this->input->post('kegiatan');

        $data = [
            'tgl' => htmlspecialchars($this->input->post('tgl')),
            'keterangan' => htmlspecialchars($this->input->post('ket')),
            'tempat' => htmlspecialchars($this->input->post('loc')),
            'jml_peserta' => htmlspecialchars($this->input->post('jml'))
        ];
        $this->db->where('md5(sha1(id_kegiatan))', $id)->update('kegiatan', $data);
        if($this->db->affected_rows() > 0){
            $params = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Kegiatan baru berhasil di edit'
            ];
        } else {
            $params = [
                'type' => 'result',
                'status' => true,
                'msg' => 'Kegiatan baru gagal di edit'
            ];
        }
        echo json_encode($params);

    }

    public function delete_data_kegiatan(){
        validation_ajax_request();
        $id = $_POST['id'];
        $data = $this->db->where('md5(sha1(id_kegiatan))', $id)->get('kegiatan')->row();
        $this->db->delete('kegiatan_foto', ['kegiatan' => $data->foto_kegiatan]);
        $this->db->where('md5(sha1(id_kegiatan))', $id)->delete('kegiatan');
        
        if($this->db->affected_rows() > 0){
            $params = [
                'success' => true,
                'msg' => 'Data kegiatan berhasil di hapus'
            ];
        } else {
            $params = [
                'success' => false,
                'msg' => 'Data kegiatan gagal di hapus'
            ];
        }
        echo json_encode($params);
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

    public function statistik(){
        access_menu();
        $pendukung = 3;
        $relawan = 2;
        $month = date('m');
        $gender_l = ['l', 'laki-laki'];
        $gender_p = ['p', 'perempuan'];

        if(get_user()->dapil_id){
            $data = [
                'title' => 'Statistik',
                'user' => get_user(),
                'view' => 'welcome/statistik',
                'data' => $this->m->get_dapil(),
    
                'total_pendukung' => $this->m->get_data_statistik($pendukung, null, null)->num_rows(),
                'total_relawan' => $this->m->get_data_statistik($relawan, null, null)->num_rows(),
    
                'pendukung_bulan' => $this->m->get_data_statistik($pendukung, null, $month)->num_rows(),
                'relawan_bulan' => $this->m->get_data_statistik($relawan, null, $month)->num_rows(),
    
                'pendukung_l' => $this->m->get_data_statistik($pendukung, $gender_l, null)->num_rows(),
                'pendukung_p' => $this->m->get_data_statistik($pendukung, $gender_p, null)->num_rows(),
    
                'relawan_l' => $this->m->get_data_statistik($relawan, $gender_l, null)->num_rows(),
                'relawan_p' => $this->m->get_data_statistik($relawan, $gender_p, null)->num_rows()
            ];
        } else {
            $data = [
                'title' => 'Statistik',
                'user' => get_user(),
                'view' => 'welcome/statistik',
            ];
        }

        
        $this->load->view('template', $data);
    }

}
