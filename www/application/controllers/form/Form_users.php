<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Users Controller
*| --------------------------------------------------------------------------
*| Form Users site
*|
*/
class Form_users extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_users');
	}

	/**
	* Submit Form Userss
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama' => $this->input->post('nama'),
				'kontak' => $this->input->post('kontak'),
				'kelompok' => $this->input->post('kelompok'),
				'level' => $this->input->post('level'),
			];

			
			$save_form_users = $this->model_form_users->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_users;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_users.php */
/* Location: ./application/controllers/administrator/Form Users.php */