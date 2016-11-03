<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	public function index()
	{
		$data['categorys'] = $this->CategoriaModel->getCategories();
		$this->template->load('template/template','main/mainView',$data);		
	}


	public function rotaryData(){
		$categories = $this->CategoriaModel->getCategories();
		foreach ($categories as $category) {
			$category['itens'] = $this->ItensModel->getItensByCategory($category['category_id']);
			echo json_encode($category);
		}
	}
}

/* End of file mainController.php */
/* Location: ./application/controllers/mainController.php */