<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => get_user(),
            'view' => 'user/index'
        ];
        $this->load->view('template', $data);
    }

    public function setting(){
        $data = [
            'title' => 'User Settings',
            'user' => get_user(),
            'view' => 'user/setting'
        ];
        $this->load->view('template', $data);
    }

    private function crop_image($file = null){
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/img/user/' . $file;
        $config['maintain_ratio'] = false;
        $config['width']         = 512;
        $config['height']       = 512;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
    }

    public function change_setting(){
        
        $name = htmlspecialchars($this->input->post('nama', true));
        $img = $_FILES['foto'];
        $user = get_user();

        if($img){
            $file_name = 'lsn_user_' . time();
            $config['upload_path'] = './assets/img/user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = $file_name;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('foto')){
                $file = $this->upload->data('file_name');
                $this->crop_image($file);

                if($user->img != 'default.png'){
                    unlink('./assets/img/user/' . $user->img);
                }
            } else {
               $file = $user->img;
            }

            $data = [
                'nama' => $name,
                'img' => $file
            ];
            $this->db->where('email', $this->session->userdata('email'))->update('user', $data);
            redirect('user/setting');

        }
    }


}
