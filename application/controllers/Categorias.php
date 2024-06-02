<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class Categorias extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categories_model');
	}
	public function index()
	{
		$categorias = [];

		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('categories');

			$cursor = $collection->find([]);
			foreach ($cursor as $categoria) {
				$categorias[] = [
					'id' => $categoria['_id'],
					'name' => $categoria['name'],
					'description' => $categoria['description'],
				];
			};
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}

		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'categorias'));
		$this->load->view('dashboard/categorias/categorias', array('categorias' => $categorias));
		$this->load->view('dashboard/base/footer');
	}

	public function edit($_id = null)
	{
		if (!$_id) {
			redirect('categorias');
		}

		$cursor = [];
		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('categories');

			$cursor = $collection->findOne(['_id' => new ObjectId($_id)]);

			if (!$cursor) {
				redirect('categories');
			}

		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}


		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'categorias'));
		$this->load->view('dashboard/categorias/editar', array('categoriaId' => $cursor));
		$this->load->view('dashboard/base/footer');
	}
}
