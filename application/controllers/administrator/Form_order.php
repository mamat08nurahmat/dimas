<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Order Controller
*| --------------------------------------------------------------------------
*| Form Order site
*|
*/
class Form_order extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_order');
	}

	/**
	* show all Form Orders
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_order_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_orders'] = $this->model_form_order->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_order_counts'] = $this->model_form_order->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_order/index/',
			'total_rows'   => $this->model_form_order->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Order List');
		$this->render('backend/standart/administrator/form_builder/form_order/form_order_list', $this->data);
	}

	/**
	* Update view Form Orders
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_order_update');

		$this->data['form_order'] = $this->model_form_order->find($id);

		$this->template->title('Order Update');
		$this->render('backend/standart/administrator/form_builder/form_order/form_order_update', $this->data);
	}

	/**
	* Update Form Orders
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_order_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no_pemimpin', 'No Pemimpin', 'trim|required');
		$this->form_validation->set_rules('no_pemesan', 'No Pemesan', 'trim|required');
		$this->form_validation->set_rules('kode_grab', 'Kode Grab', 'trim|required');
		$this->form_validation->set_rules('is_approved', 'Is Approved', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_pemimpin' => $this->input->post('no_pemimpin'),
				'no_pemesan' => $this->input->post('no_pemesan'),
				'kode_grab' => $this->input->post('kode_grab'),
				'is_approved' => $this->input->post('is_approved'),
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_order = $this->model_form_order->change($id, $save_data);

			if ($save_form_order) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_order', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_order');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_order');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Orders
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_order_delete');

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
            set_message(cclang('has_been_deleted', 'Form Order'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Order'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Orders
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_order_view');

		$this->data['form_order'] = $this->model_form_order->find($id);

		$this->template->title('Order Detail');
		$this->render('backend/standart/administrator/form_builder/form_order/form_order_view', $this->data);
	}

	/**
	* delete Form Orders
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_order = $this->model_form_order->find($id);

		
		return $this->model_form_order->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_order_export');

		$this->model_form_order->export('form_order', 'form_order');
	}
}


/* End of file form_order.php */
/* Location: ./application/controllers/administrator/Form Order.php */