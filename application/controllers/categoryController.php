<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {

	public function index()
	{
		
	}


	public function newCategory(){

		$this->form_validation->set_rules('name', 'Username', 'required');


		if ($this->form_validation->run()) {
			
			if (!$_FILES['userfile']['name']==''){
			$config['upload_path']          = './imgs/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = '100000';
			$extensao = pathinfo($_FILES['userfile']['name']);
			$extensao = ".".$extensao['extension'];
			$_FILES['userfile']['name'] = time().uniqid(md5(9999999)).$extensao;

			$this->load->library('upload', $config);

			$this->upload->initialize($config);		

				if($this->upload->do_upload('userfile')){
					$this->upload->initialize($config);		
					$data =  array( 
						'category_name' 			=> $this->input->post('name'),
						'category_description'		=> $this->input->post('desc'),
						'category_icon_path'		=> $_FILES['userfile']['name']
						);
					$this->CategoriaModel->addCategory($data);
					redirect('','refresh');
				}
			}else{
				$data =  array( 
						'category_name' 			=> $this->input->post('name'),
						'category_description'		=> $this->input->post('desc')
						);
					$this->CategoriaModel->addCategory($data);
					redirect('','refresh');
			}	
		}else{
			$this->template->load('template/template','categoria/newCategoryView');
		}
	}

	public function deletCategory($id,$img){

		$categoriaTemp = $this->CategoriaModel->getCategoryByID($id);
		$itensCategory = $this->ItensModel->getItensByCategory($id);
		
		foreach ($itensCategory as $item) {
			$this->ItensModel->deletItem($item['item_id']);
			$path_to_file = "imgs/".$item['item_image_path'];
			unlink($path_to_file);
		}
		
		if ($categoriaTemp[0]['category_icon_path']!="logo.png") {
			$path_to_file = "imgs/".$img;
			unlink($path_to_file);
		}
		$this->CategoriaModel->deletCategory($id);
		redirect('','refresh');
	}	

	public function updateCategory($id){

		$this->form_validation->set_rules('name', 'Username', 'required');	
		$imgForm = $this->input->post('image');

		if ($this->form_validation->run()) {
			if ($_FILES['userfile']['name']==''){
				$data =  array( 
					'category_name' 			=> $this->input->post('name'),
					'category_description'		=> $this->input->post('desc')
					);
				$this->CategoriaModel->updateCategory($id,$data);
				redirect('','refresh');
			}
			else{
				$config['upload_path']          = './imgs/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = '100000';
				$extensao = pathinfo($_FILES['userfile']['name']);
				$extensao = ".".$extensao['extension'];
				$_FILES['userfile']['name'] = time().uniqid(md5(9999999)).$extensao;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);		

				if($this->upload->do_upload('userfile')){
					$this->upload->initialize($config);		
					$data =  array( 
						'category_name' 			=> $this->input->post('name'),
						'category_description'		=> $this->input->post('desc'),
						'category_icon_path'		=> $_FILES['userfile']['name']
						);
					$this->CategoriaModel->updateCategory($id,$data);
					$path_to_file = "imgs/".$imgForm;
					unlink($path_to_file);
					redirect('','refresh');
				}
			}
		}else{
			$data['dados'] = $this->CategoriaModel->getCategoryByID($id);
			$this->template->load('template/template','categoria/updateCategoryView',$data);
		}
			
	}

}

/* End of file categoryController.php */
/* Location: ./application/controllers/categoryController.php */