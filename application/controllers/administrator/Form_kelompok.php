<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Kelompok Controller
*| --------------------------------------------------------------------------
*| Form Kelompok site
*|
*/
class Form_kelompok extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_kelompok');
	}

	/**
	* show all Form Kelompoks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_kelompok_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_kelompoks'] = $this->model_form_kelompok->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_kelompok_counts'] = $this->model_form_kelompok->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_kelompok/index/',
			'total_rows'   => $this->model_form_kelompok->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kelompok List');
		$this->render('backend/standart/administrator/form_builder/form_kelompok/form_kelompok_list', $this->data);
	}

	/**
	* Update view Form Kelompoks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_kelompok_update');

		$this->data['form_kelompok'] = $this->model_form_kelompok->find($id);

		$this->template->title('Kelompok Update');
		$this->render('backend/standart/administrator/form_builder/form_kelompok/form_kelompok_update', $this->data);
	}

	/**
	* Update Form Kelompoks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_kelompok_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'trim|required');
		$this->form_validation->set_rules('pemimpin', 'Pemimpin', 'trim|required');
		$this->form_validation->set_rules('number', 'Number', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kelompok' => $this->input->post('kelompok'),
				'pemimpin' => $this->input->post('pemimpin'),
				'number' => $this->input->post('number'),
			];

			
			$save_form_kelompok = $this->model_form_kelompok->change($id, $save_data);

			if ($save_form_kelompok) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_kelompok', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_kelompok');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_kelompok');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Kelompoks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_kelompok_delete');

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
            set_message(cclang('has_been_deleted', 'Form Kelompok'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Kelompok'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Kelompoks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_kelompok_view');

		$this->data['form_kelompok'] = $this->model_form_kelompok->find($id);

		$this->template->title('Kelompok Detail');
		$this->render('backend/standart/administrator/form_builder/form_kelompok/form_kelompok_view', $this->data);
	}

	/**
	* delete Form Kelompoks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_kelompok = $this->model_form_kelompok->find($id);

		
		return $this->model_form_kelompok->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_kelompok_export');

		$this->model_form_kelompok->export('form_kelompok', 'form_kelompok');
	}
}


/* End of file form_kelompok.php */
/* Location: ./application/controllers/administrator/Form Kelompok.php */