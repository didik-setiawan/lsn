<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function validation_login()
    {
        validation_ajax_request();
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harap di isi',
            'trim' => 'Tidak boleh ada spasi di awal',
            'valid_email' => 'Email harus valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harap di isi',
            'trim' => 'Tidak boleh ada spasi di awal'
        ]);
        if ($this->form_validation->run() == false) {
            $params = [
                'type' => 'validation',
                'err_email' => form_error('email'),
                'err_pass' => form_error('password')
            ];
            echo json_encode($params);
            die;
        } else {
            $this->process_login();
        }
    }

    private function process_login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = md5(sha1($this->input->post('password')));
        $user = $this->db->where(['email' => $email, 'password' => $password])->get('user')->row();

        if ($user) {

            if ($user->status == 1) {

                $data = [
                    'email' => $user->email,
                    'id_role' => $user->id_role,
                    'status' => $user->status,
                ];

                $this->session->set_userdata($data);
                $params = [
                    'type' => 'result',
                    'success' => true,
                    'msg' => 'Login Success',
                    'redirect' => base_url('dashboard')
                ];
            } else {
                $params = [
                    'type' => 'result',
                    'success' => false,
                    'msg' => 'Account is not active'
                ];
            }
        } else {
            $params = [
                'type' => 'result',
                'success' => false,
                'msg' => 'Invalid username or password'
            ];
        }
        echo json_encode($params);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
