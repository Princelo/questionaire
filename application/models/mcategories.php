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
            *
            from
                papers
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
            *
            from
                papers
                where category_id = ?
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
            return true;
        }else {
            return false;
        }
    }
}