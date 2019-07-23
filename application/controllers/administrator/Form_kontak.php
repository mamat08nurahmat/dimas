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
	* show all Form Kontaks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_kontak_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_kontaks'] = $this->model_form_kontak->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_kontak_counts'] = $this->model_form_kontak->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_kontak/index/',
			'total_rows'   => $this->model_form_kontak->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kontak List');
		$this->render('backend/standart/administrator/form_builder/form_kontak/form_kontak_list', $this->data);
	}

	/**
	* Update view Form Kontaks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_kontak_update');

		$this->data['form_kontak'] = $this->model_form_kontak->find($id);

		$this->template->title('Kontak Update');
		$this->render('backend/standart/administrator/form_builder/form_kontak/form_kontak_update', $this->data);
	}

	/**
	* Update Form Kontaks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_kontak_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
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

			
			$save_form_kontak = $this->model_form_kontak->change($id, $save_data);

			if ($save_form_kontak) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_kontak', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_kontak');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_kontak');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Kontaks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_kontak_delete');

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
            set_message(cclang('has_been_deleted', 'Form Kontak'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Kontak'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Kontaks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_kontak_view');

		$this->data['form_kontak'] = $this->model_form_kontak->find($id);

		$this->template->title('Kontak Detail');
		$this->render('backend/standart/administrator/form_builder/form_kontak/form_kontak_view', $this->data);
	}

	/**
	* delete Form Kontaks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_kontak = $this->model_form_kontak->find($id);

		
		return $this->model_form_kontak->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_kontak_export');

		$this->model_form_kontak->export('form_kontak', 'form_kontak');
	}
}


/* End of file form_kontak.php */
/* Location: ./application/controllers/administrator/Form Kontak.php */