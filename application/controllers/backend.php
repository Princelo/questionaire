<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin') != 1) {
            redirect('login/login');
        }
    }

    public function index()
    {
        redirect('category/categories_management');
    }

    public function session_delete($id)
    {
        $result = $this->db->query('delete from sessions where id = ?', array($id));
        if ($result === true) {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'success',
                    'message' => '删除纪录成功'
                ));
        } else {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'error',
                    'message' => '删除纪录失败'
                ));
        }
        redirect('backend/report_sessions');
    }

    public function report_sessions()
    {
        $sql = "";
        $sql .= "
            select
                e.name name,
                e.mobile_no mobile,
                e.gender    gender,
                s.id,
                s.start_time,
                s.score,
                ( select name from categories where id = p.category_id ) as category,
                p.name title
            from sessions s
                join examinees e
                on e.id = s.examinee_id
                join papers p
                on p.id = s.paper_id
        ";
        $query = $this->db->query($sql);

        $data = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $val) {
                $data[] = $val;
            }
        }
        $query->free_result();

        $render['records'] = $data;
        $this->load->view('backend/base');
        $this->load->view('backend/report_sessions', $render);
        $this->load->view('backend/base_footer');
    }

}

