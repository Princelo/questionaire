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
        redirect('backend/categories_management');
    }

    public function categories_management()
    {
        $this->load->model('MCategories', 'MCategoires');
        $categories = $this->MCategories->getCategories();
        $roots = array();
        foreach ($categories as $k => $v) {
            if ($v->pid != '') {
                foreach($categories as $i => $r) {
                    if ($r->id == $v->pid) {
                        $categories[$i]->has_sub_categories = true;
                        if (!is_array($categories[$i]->roots)) {
                            $categories[$i]->roots = array();
                        }
                        $categories[$i]->roots[] = $v;
                    }
                }
            }
        }
        foreach ($categories as $k => $v) {
            if ($v->pid == '') {
                $roots[] = $v;
            }
        }
        $data = array();
        $data['roots'] = $roots;
        $this->load->view('backend/categories_management', $data);
    }

    public function update_category()
    {
        $cid = filter_var($this->input->post('cid'), FILTER_VALIDATE_INT);
        $value = $this->input->post('value');
        $this->load->model('MCategories', 'MCategories');
        $data = array();
        $data['name'] = $value;
        $where = array();
        $where['id'] = $cid;
        if($this->MCategories->update($data, $where)){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(
                    array(
                        'state' => 'success',
                        'value' => $value
                    )
                ));
        }
    }

    public function category_add()
    {
        $pid = filter_var($this->input->get('pid', true), FILTER_VALIDATE_INT);
        $data = array();
        $data['name'] = $this->input->post('name');
        if ($pid > 0) {
            $data['pid'] = $pid;
        } else {
        }
        $this->load->model('MCategories', 'MCategories');
        if ($this->MCategories->add($data)) {
            $this->session->set_flashdata('flash_data',
                array(
                    'state' => 'success',
                    'message' => '添加类别成功',
                    )
            );
        } else {
            $this->session->set_flashdata('flash_data',
                array(
                    'state' => 'error',
                    'message' => '添加类别失败',
                )
            );
        }
        redirect('backend/categories_management');
    }
}

