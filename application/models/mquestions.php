<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/4/15
 * Time: 19:41
 */
class MQuestions extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getQuestions($paper_id)
    {
        $sql = "";
        $sql .= "
            select
            *
            from
                questions
            where paper_id = ?
            ;
        ";
        $query = $this->db->query($sql, array($paper_id));
        $data = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $val) {
                $val->options = array();
                $val->options = $this->getOptions($val->id);
                $data[] = $val;
            }
        }
        $query->free_result();

        return $data;
    }

    public function getOptions($question_id)
    {
        $sql = "";
        $sql = "
            select
            *
            from
                options
                where
                question_id = ?
        ";
        $query = $this->db->query($sql, array($question_id));
        $data = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $val) {
                $data[] = $val;
            }
        }
        $query->free_result();

        return $data;
    }


    public function update($data, $where)
    {
        $update_sql = $this->db->update_string("questions", $data, $where);

        $result = $this->db->query($update_sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }

    public function add($data)
    {
        $sql = $this->db->insert_string('questions', $data);
        $result = $this->db->query($sql);

        if($result === true) {
            return $this->db->insert_id();
        }else {
            return 0;
        }
    }

    public function update_option($data, $where)
    {
        $update_sql = $this->db->update_string("options", $data, $where);

        $result = $this->db->query($update_sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }

    public function add_option($data)
    {
        $sql = $this->db->insert_string('options', $data);
        $result = $this->db->query($sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }
}