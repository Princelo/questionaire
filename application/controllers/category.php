<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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

    public function categories_management()
    {
        $this->load->model('MCategories', 'MCategories');
        $categories = $this->MCategories->getCategories();
        $roots = array();
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
        $data = array();
        $data['roots'] = $roots;
        $this->load->view('backend/base');
        $this->load->view('category/categories_management', $data);
        $this->load->view('backend/base_footer');
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
                        'value' => $value,
                        'message' => '修改类别成功'
                    )
                ));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(
                    array(
                        'state' => 'error',
                        'message' => '修改类别失败'
                    )
                ));
        }
    }

    public function category_add()
    {
        $pid = filter_var($this->input->post('pid'), FILTER_VALIDATE_INT);
        $data = array();
        $data['name'] = $this->input->post('name');
        if (intval($pid) > 0) {
            $data['pid'] = $pid;
        } else {
        }
        $this->load->model('MCategories', 'MCategories');
        if ($this->MCategories->add($data)) {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'success',
                    'message' => '添加类别成功',
                )
            );
        } else {
            $this->session->set_flashdata('flashdata',
                array(
                    'state' => 'error',
                    'message' => '添加类别失败',
                )
            );
        }
        redirect('category/categories_management');
    }

    public function category_delete()
    {
        $id = filter_var($this->input->get('id', TRUE), FILTER_VALIDATE_INT);
        $result = $this->db->delete('categories', array('id'=>$id));
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
        redirect('category/categories_management');
    }
}

