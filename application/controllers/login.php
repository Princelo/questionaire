<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function do_login()
    {
        $query = $this->db->query('select id from admin where username = ? and password = ? limit 1',
            array(
                $this->input->post('username'),
                md5($this->input->post('password'))
            ));
        $row = $query->row();
        if ($row > 0) {
            $this->session->set_userdata('is_admin', 1);
            redirect('category/categories_management');
        } else {
            $this->session->set_flashdata('flashdata', array(
                'type' => 'error',
                'message' => '用户名或密码错误'
            ));
            redirect('login/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/login');
    }
}

