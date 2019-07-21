<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Kontak Controller
*| --------------------------------------------------------------------------
*| Form Kontak site
*|
*/
class Form_kontak extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_kontak');
	}

	/**
	* Submit Form Kontaks
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('no_kontak', 'No Kontak', 'trim|required');
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'trim|required');
		$this->form_validation->set_rules('pemimpin', 'Pemimpin', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama' => $this->input->post('nama'),
				'no_kontak' => $this->input->post('no_kontak'),
				'kelompok' => $this->input->post('kelompok'),
				'pemimpin' => $this->input->post('pemimpin'),
			];

			
			$save_form_kontak = $this->model_form_kontak->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_kontak;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_kontak.php */
/* Location: ./application/controllers/administrator/Form Kontak.php */