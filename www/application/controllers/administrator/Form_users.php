<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Users Controller
*| --------------------------------------------------------------------------
*| Form Users site
*|
*/
class Form_users extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_users');
	}

	/**
	* show all Form Userss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_users_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_userss'] = $this->model_form_users->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_users_counts'] = $this->model_form_users->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_users/index/',
			'total_rows'   => $this->model_form_users->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Users List');
		$this->render('backend/standart/administrator/form_builder/form_users/form_users_list', $this->data);
	}

	/**
	* Update view Form Userss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_users_update');

		$this->data['form_users'] = $this->model_form_users->find($id);

		$this->template->title('Users Update');
		$this->render('backend/standart/administrator/form_builder/form_users/form_users_update', $this->data);
	}

	/**
	* Update Form Userss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_users_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
		$this->form_validation->set_rules('kelompok', 'Kelompok', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama' => $this->input->post('nama'),
				'kontak' => $this->input->post('kontak'),
				'kelompok' => $this->input->post('kelompok'),
				'level' => $this->input->post('level'),
			];

			
			$save_form_users = $this->model_form_users->change($id, $save_data);

			if ($save_form_users) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_users', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_users');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_users');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Userss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_users_delete');

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
            set_message(cclang('has_been_deleted', 'Form Users'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Users'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Userss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_users_view');

		$this->data['form_users'] = $this->model_form_users->find($id);

		$this->template->title('Users Detail');
		$this->render('backend/standart/administrator/form_builder/form_users/form_users_view', $this->data);
	}

	/**
	* delete Form Userss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_users = $this->model_form_users->find($id);

		
		return $this->model_form_users->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_users_export');

		$this->model_form_users->export('form_users', 'form_users');
	}
}


/* End of file form_users.php */
/* Location: ./application/controllers/administrator/Form Users.php */