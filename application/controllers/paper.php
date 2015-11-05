<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin') != 1) {
            redirect('login/login');
        }
    }

    public function index()
    {
        redirect('paper/papers_list');
    }

    public function papers_list()
    {
        $cid = filter_var($this->input->get('cid', true), FILTER_VALIDATE_INT);
        $this->load->model('MPapers', 'MPapers');
        if ($cid > 0) {
            $papers = $this->MPapers->getPapersByCategory($cid);
        } else {
            $papers = $this->MPapers->getPapers();
        }
        $data = array();
        $data['papers'] = $papers;
        $this->load->view('backend/base');
        $this->load->view('paper/papers_list', $data);
        $this->load->view('backend/base_footer');
    }


    public function paper_add()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field'   => 'name',
                'label'   => '试题名称',
                //'rules'   => 'trim|required|xss_clean|is_unique[products.title]'
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'category_id',
                'label'   => '试题类别',
                'rules'   => 'trim|xss_clean|numeric|required'
            ),
            array(
                'field'   => 'answer_minutes',
                'label'   => '答题限时',
                'rules'   => 'trim|xss_clean|numeric|required'
            ),
            array(
                'field'   => 'pass_score',
                'label'   => '及格分数',
                'rules'   => 'trim|xss_clean|numeric|required'
            ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('MCategories', 'MCategories');
            $data = array();
            $data['categories'] = $this->MCategories->getCategories();
            if (empty($data['categories'])) {
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'error',
                        'message' => '没有分类! 请先添加分类',
                    )
                );
                redirect('category/categories_management');
                exit;
            }
            $this->load->view('backend/base');
            $this->load->view('paper/paper_add', $data);
            $this->load->view('backend/base_footer');
        } else {
            $this->load->model('MCategories', 'MCategories');
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['category_id'] = $this->input->post('category_id');
            $data['answer_minutes'] = $this->input->post('answer_minutes');
            $data['pass_score'] = $this->input->post('pass_score');
            $data['category_id'] = $this->input->post('category_id');
            $this->load->model('MPapers', 'MPapers');
            $paper_id = $this->MPapers->add($data);
            if ($paper_id > 0) {
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'success',
                        'message' => '添加试题成功',
                    )
                );
                redirect('paper/paper_details/'.$paper_id);
            } else {
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'error',
                        'message' => '添加试题失败',
                    )
                );
                redirect('paper/paper_list/');
            }
        }
    }

    public function paper_details($paper_id)
    {
        $this->load->model('MPapers', 'MPapers');
        $this->load->model('MQuestions', 'MQuestions');
        $this->load->model('MCategories', 'MCategories');
        $details = $this->MPapers->getPaperById($paper_id);
        $questions = $this->MQuestions->getQuestions($paper_id);
        $data = array();
        $data['paper'] = $details[0];
        $data['questions'] = $questions;
        $data['categories'] = $this->MCategories->getCategories();
        $this->load->view('backend/base');
        $this->load->view('paper/paper_details', $data);
        $this->load->view('backend/base_footer');
    }

    public function paper_delete()
    {
        $id = filter_var($this->input->get('id', TRUE), FILTER_VALIDATE_INT);
        $result = $this->db->delete('papers', array('id'=>$id));
        if ($result === true) {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'success',
                    'message' => '删除类别成功'
                ));
        } else {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'error',
                    'message' => '删除类别失败'
                ));
        }
        redirect('paper/paper_list');
    }

    public function ajax_paper_update()
    {
        $id = filter_var($this->input->post('id'), FILTER_VALIDATE_INT);
        $name = $this->input->post('name');
        $category_id = filter_var($this->input->post('category_id'), FILTER_VALIDATE_INT);
        $answer_minutes = filter_var($this->input->post('answer_minutes'), FILTER_VALIDATE_INT);
        $pass_score = filter_var($this->input->post('pass_score'), FILTER_VALIDATE_INT);
        $is_effect = $this->input->post('is_effect');
        $value = '';
        if ($id > 0)
            $where = array('id' => $id);

        if($name != ''){
            $data = array('name'=>$name);
            $value = $name;
        }
        if($category_id > 0)
            $data = array('category_id'=>$category_id);
        if($answer_minutes > 0) {
            $data = array('answer_minutes'=>$answer_minutes);
            $value = $answer_minutes;
        }
        if($pass_score > 0) {
            $data = array('pass_score'=>$pass_score);
            $value = $pass_score;
        }
        if($is_effect === '0' || $is_effect === '1')
            $data = array('is_effect'=>$is_effect);
        $this->load->model('MPapers', 'MPapers');
        if($this->MPapers->update($data, $where)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(
                    array(
                        'state' => 'success',
                        'value' => $value,
                        'message' => '修改成功'
                    )
                ));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(
                    array(
                        'state' => 'error',
                        'message' => '修改失败'
                    )
                ));
        }
    }
}

