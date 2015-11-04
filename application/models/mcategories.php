<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/4/15
 * Time: 19:41
 */
class MCategories extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getCategories()
    {
        $sql = "";
        $sql .= "
            select
            *
            from
                categories
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

    public function update($data, $where)
    {
        $update_sql = $this->db->update_string("categories", $data, $where);

        $result = $this->db->query($update_sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }

    public function add($data)
    {
        $sql = $this->db->insert_string('categories', $data);
        $result = $this->db->query($sql);

        if($result === true) {
            return true;
        }else {
            return false;
        }
    }
}