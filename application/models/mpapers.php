<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/4/15
 * Time: 19:41
 */
class MPapers extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getPapers()
    {
        $sql = "";
        $sql .= "
            select
                p.id   id,
                p.name title,
                p.answer_minutes answer_minutes,
                p.pass_score pass_score,
                p.create_time create_time,
                p.is_effect is_effect,
                (select name from categories where id = p.category_id) category,
                p.category_id category_id,
                sum(q.score) total_score,
                count(q.id) total_questions,
                count(s.id) sessions_count
            from
                papers p
                left join questions q
                on q.paper_id = p.id
                left join sessions s
                on s.paper_id = p.id
            ;
        ";
        $query = $this->db->query($sql);
        $data = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $val) {
                $data[] = $val;
            }
        }
        $query->free_result();

        return $data;
    }

    public function getPapersByCategory($cid)
    {
        $sql = "";
        $sql .= "
            select
                p.id   id,
                p.name title,
                p.answer_minutes answer_minutes,
                p.pass_score pass_score,
                p.create_time create_time,
                p.is_effect is_effect,
                (select name from categories where id = p.category_id) category,
                p.category_id category_id,
                sum(q.score) total_score,
                count(q.id) total_questions,
                count(s.id) sessions_count
            from
                papers p
                left join questions q
                on q.paper_id = p.id
                left join sessions s
                on s.paper_id = p.id
            where p.category_id = ?
        ";
        $query = $this->db->query($sql, array($cid));
        $data = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $val) {
                $data[] = $val;
            }
        }
        $query->free_result();

        return $data;
    }

    public function getPaperById($id)
    {
        $sql = "";
        $sql .= "
            select
                p.id   id,
                p.name title,
                p.answer_minutes answer_minutes,
                p.pass_score pass_score,
                p.create_time create_time,
                p.is_effect is_effect,
                (select name from categories where id = p.category_id) category,
                p.category_id category_id,
                sum(q.score) total_score,
                count(q.id) total_questions,
                count(s.id) sessions_count
            from
                papers p
                left join questions q
                on q.paper_id = p.id
                left join sessions s
                on s.paper_id = p.id
            where
                p.id = ?
        ";
        $query = $this->db->query($sql, $id);
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
        $update_sql = $this->db->update_string("papers", $data, $where);

        $result = $this->db->query($update_sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }

    public function add($data)
    {
        $sql = $this->db->insert_string('papers', $data);
        $result = $this->db->query($sql);

        if($result === true) {
            return $this->db->insert_id();
        }else {
            return 0;
        }
    }
}