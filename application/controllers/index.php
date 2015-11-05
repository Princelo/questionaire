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
            $categories[$k]->papers = $this->MPapers->getPapersByCategory($v->id);
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
        if ($count > 1) {
            $rand = rand(0, count($papers) - 1);
            $paper = $papers[$rand];
        }
        elseif ($count == 1)
            $paper = $papers[0];
        $data = array();
        $data['roots'] = $roots;
        $data['paper'] = $paper[0];
        $data['questions'] = $this->MQuestions->getQuestions($paper[0]->id);
        $data['question'] = $data['questions'][0];
        $data['paper_json'] = json_encode($paper[0]);
        $this->load->view('index/index', $data);
    }

    public function paper($id)
    {
        $this->load->model('MCategories', 'MCategories');
        $this->load->model('MPapers', 'MPapers');
        $categories = $this->MCategories->getCategories();
        $roots = array();
        $papers = array();
        foreach($categories as $k => $v) {
            $categories[$k]->papers = $this->MPapers->getPapersByCategory($v->id);
            $papers[] = $categories[$k]->papers;
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
        $data['paper'] = $paper[0];
        $data['questions'] = $this->MQuestions->getQuestions($paper[0]->id);
        $data['question'] = $data['questions'][0];
        $data['paper_json'] = json_encode($paper[0]);
        $this->load->view('index/index', $data);
    }
}
