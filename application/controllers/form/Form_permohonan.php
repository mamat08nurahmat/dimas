<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Permohonan Controller
*| --------------------------------------------------------------------------
*| Form Permohonan site
*|
*/
class Form_permohonan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_permohonan');
	}

	/**
	* Submit Form Permohonans
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('no_pemohon', 'No Pemohon', 'trim|required');
		$this->form_validation->set_rules('no_pemimpin', 'No Pemimpin', 'trim|required');
		$this->form_validation->set_rules('hal', 'Hal', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_pemohon' => $this->input->post('no_pemohon'),
				'no_pemimpin' => $this->input->post('no_pemimpin'),
				'hal' => $this->input->post('hal'),
				'is_approved' => $this->input->post('is_approved'),
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_permohonan = $this->model_form_permohonan->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_permohonan;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_permohonan.php */
/* Location: ./application/controllers/administrator/Form Permohonan.php */