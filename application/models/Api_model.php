<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function guardar_nuevo_autor($nombre = null, $email = null, $biografia = null)
    {
        if($nombre == null || $email == null){
            return false;
        }

        return $this->db->insert('authors', ['name' => $nombre, 'email' => $email, 'biography' => $biografia]);
    }
    public function verificar_email_autor($email = null)
    {
        if($email == null){
            return false;
        }

        return $this->db->get_where('authors', array('email' => $email))->row_array();
    }
    public function guardar_nueva_categoria($nombre = null, $descripcion = null)
    {
        if($nombre == null || $descripcion == null){
            return false;
        }

        return $this->db->insert('categories', ['name' => $nombre, 'description' => $descripcion]);
    }
    public function guardar_nuevo_articulo($titulo = null, $fecha_publicacion = null, $contenido = null, $autor_id = null,  $categoria_id = null)
    {
        if($titulo == null || $fecha_publicacion == null || $contenido == null || $categoria_id == null || $autor_id == null){
            return false;
        }

        return $this->db->insert('articles', ['title' => $titulo, 'date_publication' => $fecha_publicacion, 'content' => $contenido, 'author_id' => $autor_id, 'category_id' => $categoria_id]);
    }
    public function verificar_autor($autor_id = null)
    {
        if($autor_id == null){
            return false;
        }

        return $this->db->get_where('authors', array('is_deleted' => false, 'id' => $autor_id))->row_array();
    }
    public function verificar_categoria($categoria_id = null)
    {
        if($categoria_id == null){
            return false;
        }

        return $this->db->get_where('authors', array('is_deleted' => false, 'id' => $categoria_id))->row_array();
    }
    public function eliminarArticulo($id = null)
    {
        if($id == null){
            return false;
        }

        return $this->db->update('articles', ['is_deleted' => true], ['id' => $id]);
    }
    public function eliminarCategorias($id = null)
    {
        if($id == null){
            return false;
        }

        return $this->db->update('categories', ['is_deleted' => true], ['id' => $id]);
    }
    public function eliminarAutor($id = null)
    {
        if($id == null){
            return false;
        }
        
        return $this->db->update('authors', ['is_deleted' => true], ['id' => $id]);
    }
    public function actualizar_articulo($id = null, $titulo = null, $contenido = null, $autor_id = null,  $categoria_id = null)
    {
        if($id == null || $titulo == null || $contenido == null || $categoria_id == null || $autor_id == null){
            return false;
        }

        return $this->db->update('articles', ['title' => $titulo, 'content' => $contenido, 'author_id' => $autor_id, 'category_id' => $categoria_id], array('id' => $id));     
    }
    public function actualizar_categoria($id = null, $nombre = null, $descripcion = null)
    {
        if($id == null || $nombre == null || $descripcion == null){
            return false;
        }

        return $this->db->update('categories', ['name' => $nombre, 'description' => $descripcion], array('id' => $id));
    }

    public function actualizar_autor($id = null, $nombre = null, $email = null, $biografia = null)
    {
        if($id == null || $nombre == null || $email == null || $biografia == null){
            return false;
        }

        return $this->db->update('authors', ['name' => $nombre, 'email' => $email, 'biography' => $biografia], array('id' => $id));
    }

}

