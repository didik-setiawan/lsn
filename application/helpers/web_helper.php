<?php


function get_user()
{
    $t = get_instance();
    $sess_user = $t->session->userdata('email');
    $t->db->select('
        user.*,
        role_user.nama_role
    ')->from('user')
    ->join('role_user', 'user.id_role = role_user.id_role')
    ->where('user.email', $sess_user);

    $user = $t->db->get()->row();
    return $user;
}

function validation_ajax_request()
{
    $t = get_instance();
    if (!$t->input->is_ajax_request()) {
        exit('No direct script access allowed');
    }
}

function access_menu(){
    $t = get_instance();

    $id_role = $t->session->userdata('id_role');
    $url1 = $t->uri->segment('1');
    $url2 = $t->uri->segment('2');

    $full_url = $url1 .'/'. $url2;
    $get_access = $t->db->select('
        menu.*
    ')->from('menu')->join('access_menu', 'menu.id_menu = access_menu.id_menu')->where('access_menu.id_role', $id_role)->where('menu.url', $full_url)->get()->row();

    if($t->db->affected_rows() < 1){
        exit('Error 403. Access denied');
    }

}

function get_menu(){
    $t = get_instance();
    $role = $t->session->userdata('id_role');

    $t->db->select('
        menu.*,
    ')->from('menu')
    ->join('access_menu', 'menu.id_menu = access_menu.id_menu')
    ->where('menu.status', 1)
    ->where('access_menu.id_role', $role);

    return $t->db->get()->result();
    
}

function check_login(){
    $t = get_instance();
    if(!$t->session->userdata('email') || !$t->session->userdata('id_role') || !$t->session->userdata('status')) {
        redirect('auth');
    }
}


function check_logout(){
    $t = get_instance();

    if($t->session->userdata('email') || $t->session->userdata('id_role') || $t->session->userdata('status')) {
        redirect('dashboard');
    }

}

// DIRECT LINK SESUAI ROLE //
function check_admin()
{
    $t = get_instance();
    $sess_user = $t->session->userdata('email');
    $user = $t->db->where('email', $sess_user)->get('user')->row();
    if ($user->id_role != 1) {
        redirect('user');
    }
}
// END DIRECT LINK SESUAI ROLE //_

function get_all_month(){
    $data = [
        [
            'no' => '01',
            'name' => 'Januari'
        ],
        [
            'no' => '02',
            'name' => 'Februari'
        ],
        [
            'no' => '03',
            'name' => 'Maret'
        ],
        [
            'no' => '04',
            'name' => 'April'
        ],
        [
            'no' => '05',
            'name' => 'Mei'
        ],
        [
            'no' => '06',
            'name' => 'Juni'
        ],
        [
            'no' => '07',
            'name' => 'Juli'
        ],
        [
            'no' => '08',
            'name' => 'Agustus'
        ],
        [
            'no' => '09',
            'name' => 'September'
        ],
        [
            'no' => '10',
            'name' => 'Oktober'
        ],
        [
            'no' => '11',
            'name' => 'November'
        ],
        [
            'no' => '12',
            'name' => 'Desember'
        ],
    ];
    return $data;
}

function get_date(){
    $list = array();
    $month = date('m');
    $year = date('Y');

    for($d=1; $d<=31; $d++)
    {
        $time=mktime(12, 0, 0, $month, $d, $year);          
        if (date('m', $time)==$month)       
            $list[]=date('d', $time);
    }
    return $list;
}
