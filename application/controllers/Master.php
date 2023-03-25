<?php
defined('BASEPATH') or exit('No direct script access allowed');
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



    //master user

    public function user()
    {
        access_menu();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[5]|matches[password1]');


        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'User',
                'user' => get_user(),
                'role' => $this->db->get('role_user')->result_array(),
                'all_user' => $this->user_model->getAllUser(),
                'view' => 'master/user'
            ];
            $this->load->view('template', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => md5(sha1($this->input->post('password1'))),
                'status' => $this->input->post('status'),
                'img' => 'default.png',
                'id_role' => $this->input->post('id_role'),
            ];
            $this->db->insert('user', $data);
            redirect('master/user');
        }
    }
   
    public function delete_user($id_user = NULL)
    {
        $data = [
            'id_user'   => $id_user,
        ];
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('user', $data);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message_scs', 'Berhasil Menghapus Data');
        } else {
            $this->session->set_flashdata('message_err', 'Data Tidak Berhasil Dihapus');
        }
        redirect('master/user');
    }

    public function edit_user($id_user)
    {
        $this->form_validation->set_rules(
            'nama',
            'nama',
            'required',
            array('required' => '%s Harus Diisi !')
        );
        $this->form_validation->set_rules(
            'email',
            'email',
            'required',
            array('required' => '%s Harus Diisi !')
        );
        $this->form_validation->set_rules(
            'status',
            'status',
            'required',
            array('required' => '%s Harus Diisi !')
        );
        $this->form_validation->set_rules(
            'id_role',
            'role',
            'required',
            array('required' => '%s Harus Diisi !')
        );

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']      = './assets/img/user/';
            $config['allowed_types']    = 'jpg|png|gif|jpeg';
            $this->upload->initialize($config);
            $field_name   = 'img';
            if (!$this->upload->do_upload($field_name)) {
                $data = [
                    'title' => 'User',
                    'user' => get_user(),
                    'role' => $this->db->get('role_user')->result_array(),
                    'all_user' => $this->user_model->getAllUser(),
                    'edit_user' => $this->user_model->getAllUserById($id_user),
                    'view' => 'user/edit_user'
                ];
                $this->load->view('template', $data);
            } else {
                //HAPUS GAMBAR
                $user = $this->user_model->getAllUserById($id_user);
                if ($user->img != 'default.png') {
                    unlink('./assets/img/user/' . $user->img);
                }

                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/user/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_user' => $id_user,
                    'nama' => $this->input->post('nama'),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'status' => $this->input->post('status'),
                    'id_role' => $this->input->post('id_role'),
                    'img' => $upload_data['uploads']['file_name'],
                );
                $this->user_model->edit($data);

                $this->session->set_flashdata('pesan', 'Berhasil Mengedit Data !');
                redirect('master/user');
            }
            //JIKA TANPA GANTI GAMBAR
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/user/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_user' => $id_user,
                'nama' => $this->input->post('nama'),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'status' => $this->input->post('status'),
                'id_role' => $this->input->post('id_role'),
            );
            $this->user_model->edit($data);
            $this->session->set_flashdata('pesan', 'Berhasil Mengedit Data !');
            redirect('master/user');
        }

        $data = [
            'title' => 'User',
            'user' => get_user(),
            'role' => $this->db->get('role_user')->result_array(),
            'all_user' => $this->user_model->getAllUser(),
            'edit_user' => $this->user_model->getAllUserById($id_user),
            'view' => 'master/edit_user'
        ];
        $this->load->view('template', $data);
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


}
