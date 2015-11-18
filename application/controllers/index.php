<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MQuestions', 'MQuestions');
    }

    public function index()
    {
        $this->load->model('MCategories', 'MCategories');
        $this->load->model('MPapers', 'MPapers');
        $categories = $this->MCategories->getCategories();
        $roots = array();
        $papers = array();
        foreach($categories as $k => $v) {
            $categories[$k]->papers = $this->MPapers->getPapersPublishedByCategory($v->id);
            foreach($categories[$k]->papers as $ip) {
                if( intval($ip->id) >0)
                    $papers[] = $ip;
            }
        }
        foreach ($categories as $k => $v) {
            if ($v->pid != '') {
                foreach($categories as $i => $r) {
                    if ($r->id == $v->pid) {
                        $categories[$i]->has_sub_categories = true;
                        if (!isset($categories[$i]->roots)) {
                            $categories[$i]->roots = array();
                        }
                        $categories[$i]->roots[] = $v;
                    }
                }
            }
        }
        foreach ($categories as $k => $v) {
            if ( !(isset($v->has_sub_categories) && $v->has_sub_categories == true) )
                $v->has_sub_categories = false;
            if ($v->pid == '') {
                $roots[] = $v;
            }
        }
        $count = count($papers);
        if ($count == 0) {
            exit('未有发布的试题');
        }
        /*if ($count > 1) {
            $rand = rand(0, count($papers) - 1);
            $paper = $papers[$rand];
        }
        elseif ($count == 1)
            $paper = $papers[0];*/
        $data = array();
        $data['roots'] = $roots;
        //$data['paper'] = $paper;
        //$data['questions'] = $this->MQuestions->getQuestions($paper->id);
        //$data['question'] = $data['questions'][0];
        //$paper->questions = array();
        //$paper->questions = $data['questions'];
        //$data['paper_json'] = json_encode($paper);
        //$this->load->view('index/index', $data);
        $this->load->view('index/preview', $data);
    }

    public function paper($id)
    {
        $this->load->model('MCategories', 'MCategories');
        $this->load->model('MPapers', 'MPapers');
        $categories = $this->MCategories->getCategories();
        $roots = array();
        $papers = array();
        foreach($categories as $k => $v) {
            $categories[$k]->papers = $this->MPapers->getPapersPublishedByCategory($v->id);
            foreach($categories[$k]->papers as $ip) {
                if( intval($ip->id) >0)
                    $papers[] = $ip;
            }
        }
        foreach ($categories as $k => $v) {
            if ($v->pid != '') {
                foreach($categories as $i => $r) {
                    if ($r->id == $v->pid) {
                        $categories[$i]->has_sub_categories = true;
                        if (!isset($categories[$i]->roots)) {
                            $categories[$i]->roots = array();
                        }
                        $categories[$i]->roots[] = $v;
                    }
                }
            }
        }
        foreach ($categories as $k => $v) {
            if ( !(isset($v->has_sub_categories) && $v->has_sub_categories == true) )
                $v->has_sub_categories = false;
            if ($v->pid == '') {
                $roots[] = $v;
            }
        }
        foreach( $papers as $p ) {
            if($p->id == $id) {
                $paper = $p;
                break;
            }
        }
        $data = array();
        $data['roots'] = $roots;
        $data['paper'] = $paper;
        $data['questions'] = $this->MQuestions->getQuestions($id);
        $data['question'] = $data['questions'][0];
        $paper->questions = array();
        $paper->questions = $data['questions'];
        $data['paper_json'] = json_encode($paper);
        if ($paper->is_test == '0')
            $this->load->view('index/index', $data);
        else
            $this->load->view('index/test', $data);
    }

    public function submit()
    {
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile_no');
        $gender = filter_var($this->input->post('gender'), FILTER_VALIDATE_INT);
        $paper_id = $this->input->post('paper_id');
        $score = filter_var($this->input->post('score'), FILTER_VALIDATE_INT);
        $this->load->library('user_agent');

        if ($this->agent->is_browser())
        {
            $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        $ip = $this->input->ip_address();
        $this->db->query('insert into examinees(name, gender, mobile_no,ip,user_agent) values (?,?,?,?,?)', array($name,$gender,$mobile,$ip,$agent));
        $id = $this->db->insert_id();
        $submit = json_decode($this->input->post('submit'));
        $submit_edit = array();
        foreach($submit as $k => $v) {
            if (is_numeric($v))
                $submit_edit[] = $v;
        }
        $sql = "
        insert into answers (examinee_id, option_id) values
        ";
        for ($i = 1; $i<=count($submit_edit); $i++) {
            $sql .= "($id, ?),";
        }
        $sql = substr($sql, 0, -1);
        $this->db->query($sql, $submit_edit);
        $this->db->query('insert into sessions(examinee_id, paper_id, score) values(?,?,?)', array($id, $paper_id, $score));
    }
}
