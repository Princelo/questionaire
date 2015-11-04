<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

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


    public function question_add()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field'   => 'title',
                'label'   => '题目名称',
                //'rules'   => 'trim|required|xss_clean|is_unique[products.title]'
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'paper_id',
                'label'   => 'Paper ID',
                'rules'   => 'trim|xss_clean|numeric|required'
            ),
            array(
                'field'   => 'score',
                'label'   => '分值',
                'rules'   => 'trim|xss_clean|numeric|required'
            ),
        );
        $paper_id = filter_var($this->input->post('paper_id'), FILTER_VALIDATE_INT);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('paper/paper_add');
        } else {
            $data = array();
            if ($this->input->post('image') != '') {
                $config['upload_path'] = './uploads/';
                $config['file_name'] = uniqid();
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']	= '500000';

                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('images'))
                {
                    $error = $this->upload->display_errors();
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'error',
                        'message' => $error,
                    )
                );
                redirect('paper/paper_details/'.$paper_id);
            }
                else
                {
                    $upload_data = array('upload_data' => $this->upload->data());
                    //$data['avatardir'] = $upload_data['upload_data']['full_path'];
                    $path = $upload_data['upload_data']['file_path'];
                    $fname = $upload_data['upload_data']['file_name'];
                    $fname = '/uploads/'.$fname;
                    $data['image'] = $fname;
                }
            }
            $data['name'] = $this->input->post('name');
            $data['paper_id'] = $paper_id;
            $data['score'] = $this->input->post('score');
            $this->load->model('MQuestions', 'MQuestions');
            $question_id = $this->MQuestions->add($data);
            if ($question_id > 0) {
                if ($this->input->post('option1')) {
                    $data = array();
                    $data['option_no'] = '1';
                    $data['content'] = $this->input->post('option1');
                    if ($this->input->post('correct') == 1)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option2')) {
                    $data = array();
                    $data['option_no'] = '2';
                    $data['content'] = $this->input->post('option2');
                    if ($this->input->post('correct') == 2)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option3')) {
                    $data = array();
                    $data['option_no'] = '3';
                    $data['content'] = $this->input->post('option3');
                    if ($this->input->post('correct') == 3)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option4')) {
                    $data = array();
                    $data['option_no'] = '4';
                    $data['content'] = $this->input->post('option4');
                    if ($this->input->post('correct') == 4)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option5')) {
                    $data = array();
                    $data['option_no'] = '5';
                    $data['content'] = $this->input->post('option5');
                    if ($this->input->post('correct') == 5)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option6')) {
                    $data = array();
                    $data['option_no'] = '6';
                    $data['content'] = $this->input->post('option6');
                    if ($this->input->post('correct') == 6)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                if ($this->input->post('option7')) {
                    $data = array();
                    $data['option_no'] = '7';
                    $data['content'] = $this->input->post('option7');
                    if ($this->input->post('correct') == 7)
                        $data['is_correct'] = 1;
                    else
                        $data['is_correct'] = 0;
                    $data['question_id'] = $question_id;
                    $this->MQuestions->add_option($data);
                }
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'success',
                        'message' => '添加成功',
                    )
                );
            } else {
                $this->session->set_flashdata('flashdata',
                    array(
                        'state' => 'error',
                        'message' => '添加失败',
                    )
                );
            }
            redirect('paper/paper_details/'.$paper_id);
        }
    }


    public function question_delete()
    {
        $id = filter_var($this->input->get('id', TRUE), FILTER_VALIDATE_INT);
        $pid = filter_var($this->input->get('pid', TRUE), FILTER_VALIDATE_INT);
        $result = $this->db->delete('questions', array('id'=>$id));
        if ($result === true) {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'success',
                    'message' => '删除成功'
                ));
        } else {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'error',
                    'message' => '删除失败'
                ));
        }
        redirect('paper/paper_details/'.$pid);
    }

    public function ajax_question_update()
    {
        $id = filter_var($this->input->post('id'), FILTER_VALIDATE_INT);
        $title = $this->input->post('title');
        $score = filter_var($this->input->post('score'), FILTER_VALIDATE_INT);
        $question_no = filter_var($this->input->post('question_no'), FILTER_VALIDATE_INT);
        $option_no = filter_var($this->input->post('option_no'), FILTER_VALIDATE_INT);
        $option = $this->input->post('option');
        $correct_option_no = filter_var($this->input->post('correct_option_no'), FILTER_VALIDATE_INT);
        $question_id = filter_var($this->input->post('question_id'), FILTER_VALIDATE_INT);
        $value = '';
        $table = 'question';
        if ($id > 0)
            $where = array('id' => $id);

        if($title != ''){
            $data = array('title'=>$title);
            $value = $title;
        }
        if($score > 0)
            $data = array('score'=>$score);
        if($question_no > 0) {
            $data = array('question_no'=>$question_no);
            $value = $question_no;
        }
        if($option_no > 0) {
            $data = array('$option_no'=>$option_no);
            $table = 'option';
        }
        if($option != '') {
            $table = 'option';
            $data = array('content'=>$option);
        }
        $this->load->model('MQuestions', 'MQuestions');
        if ($table == 'question') {
            if($this->MQuestion->update($data, $where)) {
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
            exit;
        } else if ($table == 'option') {
            if ($option != '') {
                if($this->MQuestion->update_option($data, $where)) {
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
                exit;
            }
            if ($correct_option_no > 0 && $question_id > 0) {
                $this->db->query('update options set is_effect = 0 where question_id = ?', array($question_id));
                $this->db->query('update options set is_effect = 1 where question_id = ? and option_no = ? limit 1',
                    array(
                       $question_id,
                        $correct_option_no,
                    ));
            }
        }
    }
}

