<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;


class Articulos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$search = $this->input->get('search', true);
		$articulos = [];
		$autores = [];
		$categorias = [];

		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('articles');
			$collectionAuthor = $db->selectCollection('authors'); 
			$collectionCategory = $db->selectCollection('categories');

			$cursor = $collection->find([]);
			foreach ($cursor as $articulo) {
				$cursorAuthor = $collectionAuthor->findOne(['_id' => new ObjectId($articulo['author_id'])]);
				$cursorCategory = $collectionCategory->findOne(['_id' => new ObjectId($articulo['category_id'])]);
				$datePublication = $articulo['date_publication'] instanceof UTCDateTime 
                    ? $articulo['date_publication']->toDateTime()->format('Y-m-d H:i:s') 
                    : null;
				$articulos[] = [
					'id' => $articulo['_id'],
					'title' => $articulo['title'],
					'date_publication' => $datePublication,
					'authorname' => ( $cursorAuthor ) ? $cursorAuthor['name'] : null, 
					'categoryname' => ( $cursorCategory ) ? $cursorCategory['name'] : null

				];
			 };

			$autores = $collectionAuthor->find([]);

			$categorias = $collectionCategory->find([]);


		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}

		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'articulos'));
		$this->load->view('dashboard/articulos/articulos', array('articulos' => $articulos, 'autores' => $autores, 'categorias' => $categorias));
		$this->load->view('dashboard/base/footer');
	}

	public function edit($_id = null)
	{
		if (!$_id) {
			redirect('articulos');
		}

		$cursor = [];
		$autores = [];
		$categorias = [];


		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('articles');
			$collectionAuthor = $db->selectCollection('authors'); 
			$collectionCategory = $db->selectCollection('categories');

			$cursor = $collection->findOne(['_id' => new ObjectId($_id)]);

			if(!$cursor){
				redirect('articulos');
			}

			$autores = $collectionAuthor->find([]);

			$categorias = $collectionCategory->find([]);


		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}


		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'articulos'));
		$this->load->view('dashboard/articulos/editar', array('articuloId' => $cursor, 'autores' => $autores, 'categorias' => $categorias));
		$this->load->view('dashboard/base/footer');
	}

	public function view($id = null)
	{
		if ($id == null) {
			redirect('articulos');
		}

		$articuloid = $this->articles_model->getArticleId($id);

		if (!$articuloid) {
			redirect('articulos');
		}

		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'articulos'));
		$this->load->view('dashboard/articulos/ver', array('articuloId' => $articuloid));
		$this->load->view('dashboard/base/footer');
	}
}
