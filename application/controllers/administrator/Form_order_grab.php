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
	* show all Form Order Grabs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_order_grab_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_order_grabs'] = $this->model_form_order_grab->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_order_grab_counts'] = $this->model_form_order_grab->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_order_grab/index/',
			'total_rows'   => $this->model_form_order_grab->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Order Grab List');
		$this->render('backend/standart/administrator/form_builder/form_order_grab/form_order_grab_list', $this->data);
	}

	/**
	* Update view Form Order Grabs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_order_grab_update');

		$this->data['form_order_grab'] = $this->model_form_order_grab->find($id);

		$this->template->title('Order Grab Update');
		$this->render('backend/standart/administrator/form_builder/form_order_grab/form_order_grab_update', $this->data);
	}

	/**
	* Update Form Order Grabs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_order_grab_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
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

			
			$save_form_order_grab = $this->model_form_order_grab->change($id, $save_data);

			if ($save_form_order_grab) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_order_grab', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_order_grab');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_order_grab');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Order Grabs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_order_grab_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'Form Order Grab'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Order Grab'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Order Grabs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_order_grab_view');

		$this->data['form_order_grab'] = $this->model_form_order_grab->find($id);

		$this->template->title('Order Grab Detail');
		$this->render('backend/standart/administrator/form_builder/form_order_grab/form_order_grab_view', $this->data);
	}

	/**
	* delete Form Order Grabs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_order_grab = $this->model_form_order_grab->find($id);

		
		return $this->model_form_order_grab->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_order_grab_export');

		$this->model_form_order_grab->export('form_order_grab', 'form_order_grab');
	}
}


/* End of file form_order_grab.php */
/* Location: ./application/controllers/administrator/Form Order Grab.php */