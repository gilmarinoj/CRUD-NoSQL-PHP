<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function getArticles($search = null)
    {   
        if($search){
            $this->db->where('a.id', $search);
        }

        $this->db->select('a.id, a.title, a.date_publication, a.content, au.name authorname, ca.name categoryname');
        $this->db->from('articles a');
        $this->db->join('authors au', 'a.author_id = au.id', 'inner');
        $this->db->join('categories ca', 'a.category_id = ca.id', 'inner');
        $this->db->where('a.is_deleted', false);
        return $this->db->get()->result_array();
    }

    public function getCategories()
    {
        return $this->db->get_where('categories', array('is_deleted' => false))->result_array();
    }

    public function getAuthors()
    {
        return $this->db->get_where('authors', array('is_deleted' => false))->result_array();
    }
    
    public function getArticleId($id = null)
    {
        if($id == null){
            return false;
        }

        return $this->db->get_where('articles', array('is_deleted' => false, 'id' => $id))->row_array();
    }

}

