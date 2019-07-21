<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Grab Controller
*| --------------------------------------------------------------------------
*| Form Grab site
*|
*/
class Form_grab extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_grab');
	}

	/**
	* Submit Form Grabs
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('kode_grab', 'Kode Grab', 'trim|required');
		$this->form_validation->set_rules('expired', 'Expired', 'trim|required');
		$this->form_validation->set_rules('is_used', 'Is Used', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_grab' => $this->input->post('kode_grab'),
				'expired' => $this->input->post('expired'),
				'id_order' => $this->input->post('id_order'),
				'is_used' => $this->input->post('is_used'),
				'used_at' => $this->input->post('used_at'),
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_grab = $this->model_form_grab->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_grab;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_grab.php */
/* Location: ./application/controllers/administrator/Form Grab.php */