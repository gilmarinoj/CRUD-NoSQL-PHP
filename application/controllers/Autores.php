<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class Autores extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('authors_model');
	}
	public function index()
	{
		$autores = [];

		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('authors');

			$cursor = $collection->find([]);
			foreach ($cursor as $autor) {
				$autores[] = [
					'id' => $autor['_id'],
					'name' => $autor['name'],
					'email' => $autor['email'],
				];
			};
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}

		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'autores'));
		$this->load->view('dashboard/autores/autores', array('autores' => $autores));
		$this->load->view('dashboard/base/footer');
	}

	public function edit($_id = null)
	{
		if (!$_id) {
			redirect('autores');
		}

		$cursor = [];

		try {
			// Create a MongoDB client
			$client = new Client($this->config->item('mongo_db'));

			// Select a database
			$db = $client->selectDatabase('Node-API');

			$collection = $db->selectCollection('authors');

			$cursor = $collection->findOne(['_id' => new ObjectId($_id)]);

			if (!$cursor) {
				redirect('authors');
			}
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}

		$this->load->view('dashboard/base/header');
		$this->load->view('dashboard/base/menu', array('current_page' => 'autores'));
		$this->load->view('dashboard/autores/editar', array('autorId' => $cursor));
		$this->load->view('dashboard/base/footer');
	}
}
