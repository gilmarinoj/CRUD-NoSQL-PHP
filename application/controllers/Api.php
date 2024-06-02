<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("api_model");
	}
	public function agregar_autores()
	{


		try {
			$nombre = $this->input->post('nombre', true);
			$email = $this->input->post('email', true);
			$biografia = $this->input->post('biografia', true);

			if (empty($nombre)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El nombre es obligatorio!</div>');
				redirect("autores");
			}

			if (empty($email)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El email es obligatorio!</div>');
				redirect("autores");
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El email es invalido!</div>');
				redirect("autores");
			}

			if (empty($biografia)) {
				$biografia = null;
			}



			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('authors');

			$cursorEmail = $collection->findOne(['email' => $email]);

			if ($cursorEmail) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El email ya existe!</div>');
				redirect("autores");
			}

			$cursorAuthors = $collection->insertOne(['_id' => new ObjectId($id), 'name' => $nombre, 'email' => $email, 'biography' => $biografia]);

			if ($cursorAuthors) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Autor agregado correctamente!</div>');
				redirect("autores");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor no fue agregado!</div>');
				redirect("autores");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function agregar_categorias()
	{
		try {
			$nombre = $this->input->post('nombre', true);
			$descripcion = $this->input->post('descripcion', true);

			if (empty($nombre)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El nombre de la categoria es obligatorio!</div>');
				redirect("categorias");
			}

			if (empty($descripcion)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La descripción de la categoria es obligatoria!</div>');
				redirect("categorias");
			}

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('categories');


			$cursorCategories = $collection->insertOne(['_id' => new ObjectId($id), 'name' => $nombre, 'description' => $descripcion]);

			if ($cursorCategories) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Categoría agregada correctamente!</div>');
				redirect("categorias");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoría no fue agregada!</div>');
				redirect("categorias");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function agregar_articulos()
	{
		try {
			$titulo = $this->input->post('titulo', true);
			$fecha_publicacion = $this->input->post('fecha_publicacion', true);
			$contenido = $this->input->post('contenido', true);
			$autor_id = $this->input->post('autor_id', true);
			$categoria_id = $this->input->post('categoria_id', true);


			if (empty($titulo)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El título es obligatorio!</div>');
				redirect("articulos");
			}

			if (empty($fecha_publicacion)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La fecha de publicación es obligatoria!</div>');
				redirect("articulos");
			}

			if (empty($contenido)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El contenido es obligatorio!</div>');
				redirect("articulos");
			}

			if (empty($autor_id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor es obligatorio!</div>');
				redirect("articulos");
			}

			if (empty($categoria_id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoría es obligatoria!</div>');
				redirect("articulos");
			}


			$contenido = htmlentities($contenido);

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('articles');

			$collectionAuthors = $db->selectCollection('authors');

			$collectionCategories = $db->selectCollection('categories');

			$cursorAuthor = $collectionAuthors->findOne(['_id' => new ObjectId($autor_id)]);

			$cursorCategory = $collectionCategories->findOne(['_id' => new ObjectId($categoria_id)]);

			if (!$cursorAuthor) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor no existe!</div>');
				redirect("articulos");
			}

			if (!$cursorCategory) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoria no existe!</div>');
				redirect("articulos");
			}

			$fecha_publicacion = DateTime::createFromFormat('Y-m-d', $fecha_publicacion, new DateTimeZone('UTC'));
			$fecha_publicacion_mongo = new UTCDateTime($fecha_publicacion->getTimestamp() * 1000);

			$cursorArticles = $collection->insertOne(['title' => $titulo, 'date_publication' => $fecha_publicacion_mongo, 'content' => $contenido, 'author_id' => $autor_id, 'category_id' => $categoria_id]);


			if ($cursorArticles) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Articulo agregado correctamente!</div>');
				redirect("articulos");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El Articulo no fue agregado!</div>');
				redirect("articulos");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function eliminar_articulos()
	{
		try {

			$id = $this->input->post('id', true);

			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El ID es obligatorio!</div>');
				redirect("articulos");
			}

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('articles');


			$cursorArticles = $collection->deleteOne(['_id' => new ObjectId($id)]);

			if ($cursorArticles) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Articulo eliminado correctamente!</div>');
				redirect("articulos");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El Articulo no fue eliminado!</div>');
				redirect("articulos");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function eliminar_categorias()
	{
		try {
			$id = $this->input->post('id', true);

			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El ID es obligatorio!</div>');
				redirect("categorias");
			}

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('categories');

			$cursorCategories = $collection->deleteOne(['_id' => new ObjectId($id)]);

			if ($cursorCategories) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Categoria eliminada correctamente!</div>');
				redirect("categorias");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoria no fue eliminada!</div>');
				redirect("categorias");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function eliminar_autores()
	{
		try {
			$id = $this->input->post('id', true);

			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El ID es obligatorio!</div>');
				redirect("autores");
			}

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('authors');

			$cursorAuthors = $collection->deleteOne(['_id' => new ObjectId($id)]);

			if ($cursorAuthors) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Autor eliminado correctamente!</div>');
				redirect("autores");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor no fue eliminado!</div>');
				redirect("autores");
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function editar_articulos()
	{

		try {
			$id = $this->input->post('id', true);
			$titulo = $this->input->post('titulo', true);
			$contenido = $this->input->post('contenido', true);
			$autor_id = $this->input->post('autor_id', true);
			$categoria_id = $this->input->post('categoria_id', true);


			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El articulo es obligatorio!</div>');
				redirect("articulos");
			}

			if (empty($titulo)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El título es obligatorio!</div>');
				redirect("articulos/edit/" . $id);
			}

			if (empty($contenido)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El contenido es obligatorio!</div>');
				redirect("articulos/edit/" . $id);
			}

			if (empty($autor_id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor es obligatorio!</div>');
				redirect("articulos/edit/" . $id);
			}

			if (empty($categoria_id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoría es obligatoria!</div>');
				redirect("articulos/edit/" . $id);
			}


			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('articles');

			$collectionAuthors = $db->selectCollection('authors');

			$collectionCategories = $db->selectCollection('categories');

			$cursorAuthor = $collectionAuthors->findOne(['_id' => new ObjectId($autor_id)]);

			$cursorCategory = $collectionCategories->findOne(['_id' => new ObjectId($categoria_id)]);

			if (!$cursorAuthor) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor no existe!</div>');
				redirect("articulos");
			}

			if (!$cursorCategory) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoria no existe!</div>');
				redirect("articulos");
			}

			$contenido = htmlentities($contenido);

			$cursorArticles = $collection->updateOne(['_id' => new ObjectId($id)], ['$set' => ['title' => $titulo, 'content' => $contenido, 'author_id' => $autor_id, 'category_id' => $categoria_id]]);


			if ($cursorArticles->getModifiedCount() > 0) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Articulo actualizado correctamente!</div>');
				redirect("articulos");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El Articulo no fue actualizado!</div>');
				redirect("articulos/edit/" . $id);
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function editar_categorias()
	{
		try {
			$id = $this->input->post('id', true);
			$nombre = $this->input->post('nombre', true);
			$descripcion = $this->input->post('descripcion', true);


			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La Categoria es obligatoria!</div>');
				redirect("categorias");
			}

			if (empty($nombre)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El nombre es obligatorio!</div>');
				redirect("categorias/edit/" . $id);
			}

			if (empty($descripcion)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La descripción es obligatoria!</div>');
				redirect("categorias/edit/" . $id);
			}

			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('categories');

			$cursorCategories = $collection->updateOne(['_id' => new ObjectId($id)], ['$set' => ['name' => $nombre, 'description' => $descripcion]]);


			if ($cursorCategories->getModifiedCount() > 0) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Categoría actualizada correctamente!</div>');
				redirect("categorias");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">La categoría no fue actualizada!</div>');
				redirect("categorias/edit/" . $id);
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	public function editar_autores()
	{
		try {
			$id = $this->input->post('id', true);
			$nombre = $this->input->post('nombre', true);
			$email = $this->input->post('email', true);
			$biografia = $this->input->post('biografia', true);

			if (empty($id)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor es obligatorio!</div>');
				redirect("autores");
			}

			if (empty($nombre)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El nombre es obligatorio!</div>');
				redirect("autores/edit/" . $id);
			}

			if (empty($email)) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El email es obligatorio!</div>');
				redirect("autores/edit/" . $id);
			}


			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('authors');

			$cursorAuthors = $collection->updateOne(['_id' => new ObjectId($id)], ['$set' => ['name' => $nombre, 'email' => $email, 'biography' => $biografia]]);

			if ($cursorAuthors->getModifiedCount() > 0) {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-success" role="alert">Autor actualizado correctamente!</div>');
				redirect("autores");
			} else {
				$this->session->set_flashdata('msg_formulario', '<div class="alert alert-danger" role="alert">El autor no fue actualizado!</div>');
				redirect("autores/edit/" . $id);
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
