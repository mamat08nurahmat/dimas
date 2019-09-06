<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Order Grab Controller
*| --------------------------------------------------------------------------
*| Form Order Grab site
*|
*/
class Form_order_grab extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_order_grab');
	}

	/**
	* Submit Form Order Grabs
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('no_pemesan', 'No Pemesan', 'trim|required');
		$this->form_validation->set_rules('no_pemimpin', 'No Pemimpin', 'trim|required');
		$this->form_validation->set_rules('id_kode_grab', 'Id Kode Grab', 'trim|required');
		$this->form_validation->set_rules('is_approved', 'Is Approved', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_pemesan' => $this->input->post('no_pemesan'),
				'no_pemimpin' => $this->input->post('no_pemimpin'),
				'id_kode_grab' => $this->input->post('id_kode_grab'),
				'is_approved' => $this->input->post('is_approved'),
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_order_grab = $this->model_form_order_grab->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_order_grab;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_order_grab.php */
/* Location: ./application/controllers/administrator/Form Order Grab.php */