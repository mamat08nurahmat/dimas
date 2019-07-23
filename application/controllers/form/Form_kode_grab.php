<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Kode Grab Controller
*| --------------------------------------------------------------------------
*| Form Kode Grab site
*|
*/
class Form_kode_grab extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_kode_grab');
	}

	/**
	* Submit Form Kode Grabs
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('kode_grab', 'Kode Grab', 'trim|required');
		$this->form_validation->set_rules('expired', 'Expired', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_grab' => $this->input->post('kode_grab'),
				'expired' => $this->input->post('expired'),
				'is_used' => 0,
				'used_at' => '0000-00-00',
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_kode_grab = $this->model_form_kode_grab->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_kode_grab;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_kode_grab.php */
/* Location: ./application/controllers/administrator/Form Kode Grab.php */