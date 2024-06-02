<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function getAuthors()
    {
        return $this->db->get_where('authors', array('is_deleted' => false))->result_array();
    }

    public function getAuthorId($id = null)
    {
        if($id == null){
            return false;
        }

        return $this->db->get_where('authors', array('id' => $id, 'is_deleted' => false))->row_array();
    }
}

