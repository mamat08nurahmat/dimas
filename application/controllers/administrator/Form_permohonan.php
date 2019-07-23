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
	* show all Form Permohonans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_permohonan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_permohonans'] = $this->model_form_permohonan->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_permohonan_counts'] = $this->model_form_permohonan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_permohonan/index/',
			'total_rows'   => $this->model_form_permohonan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Permohonan List');
		$this->render('backend/standart/administrator/form_builder/form_permohonan/form_permohonan_list', $this->data);
	}

	/**
	* Update view Form Permohonans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_permohonan_update');

		$this->data['form_permohonan'] = $this->model_form_permohonan->find($id);

		$this->template->title('Permohonan Update');
		$this->render('backend/standart/administrator/form_builder/form_permohonan/form_permohonan_update', $this->data);
	}

	/**
	* Update Form Permohonans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_permohonan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
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

			
			$save_form_permohonan = $this->model_form_permohonan->change($id, $save_data);

			if ($save_form_permohonan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_permohonan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_permohonan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_permohonan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Permohonans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_permohonan_delete');

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
            set_message(cclang('has_been_deleted', 'Form Permohonan'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Permohonan'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Permohonans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_permohonan_view');

		$this->data['form_permohonan'] = $this->model_form_permohonan->find($id);

		$this->template->title('Permohonan Detail');
		$this->render('backend/standart/administrator/form_builder/form_permohonan/form_permohonan_view', $this->data);
	}

	/**
	* delete Form Permohonans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_permohonan = $this->model_form_permohonan->find($id);

		
		return $this->model_form_permohonan->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_permohonan_export');

		$this->model_form_permohonan->export('form_permohonan', 'form_permohonan');
	}
}


/* End of file form_permohonan.php */
/* Location: ./application/controllers/administrator/Form Permohonan.php */