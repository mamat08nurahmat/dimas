<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Permission Controller
*| --------------------------------------------------------------------------
*| permission site
*|
*/
class Permission extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_permission');
	}

	/**
	* show all permissions
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('permission_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['permissions'] = $this->model_permission->get($filter, $field, $this->limit_page, $offset);
		$this->data['permission_counts'] = $this->model_permission->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/permission/index/',
			'total_rows'   => $this->model_permission->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Permission List');
		$this->render('backend/standart/administrator/permission/permission_list', $this->data);
	}

	/**
	* show all permissions
	*
	*/
	public function add()
	{
		$this->is_allowed('permission_add');

		$this->template->title('Permission New');
		$this->render('backend/standart/administrator/permission/permission_add', $this->data);
	}

	/**
	* Add New permissions
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('permission_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[aauth_perms.name]');

		if ($this->form_validation->run()) {
			
			$save_data = [
				'name' 			=> $this->input->post('name'),
				'definition' 	=> $this->input->post('definition'),
			];

			$save_permission = $this->model_permission->store($save_data);

			if ($save_permission) {
				if ($this->input->post('save_type') == 'stay') {
					$this->response['success'] = true;
					$this->response['message'] = cclang('success_save_data_stay', [
						anchor('administrator/permission/edit/' . $save_permission, 'Edit Permission'),
						anchor('administrator/permission', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/permission/edit/' . $save_permission, 'Edit Permission')
					]), 'success');

	        		$this->response['success'] = true;
					$this->response['redirect'] = site_url('administrator/permission');
				}
			} else {
				$this->response['success'] = false;
				$this->response['message'] = $this->aauth->print_errors();
			}

		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return $this->response($this->response);
	}

	/**
	* Update view permissions
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('permission_edit');

		$this->data['permission'] = $this->model_permission->find($id);

		$this->template->title('Permission Update');
		$this->render('backend/standart/administrator/permission/permission_update', $this->data);
	}

	/**
	* Update permissions
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('permission_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		if ($this->form_validation->run()) {
			
			$save_data = [
				'name' 			=> $this->input->post('name'),
				'definition' 	=> $this->input->post('definition'),
			];

			$save_permission = $this->model_permission->change($id, $save_data);

			if ($save_permission) {
				if ($this->input->post('save_type') == 'stay') {
					$this->response['success'] = true;
					$this->response['message'] = cclang('success_update_data_stay', [
						anchor('administrator/permission', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

	        		$this->response['success'] = true;
					$this->response['redirect'] = site_url('administrator/permission');
				}
			} else {
				$this->response['success'] = false;
				$this->response['message'] = cclang('data_not_change');
			}
		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return $this->response($this->response);
	}

	/**
	* delete permissions
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('permission_delete');

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
            set_message(cclang('has_been_deleted', 'Permission'), 'success');
        } else {
            set_message(cclang('error_delete', 'Permission'), 'error');
        }

		redirect_back();
	}

	/**
	* View view permissions
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('permission_view');
		
		$this->data['permission'] = $this->model_permission->find($id);

		$this->template->title('Permission Detail');
		$this->render('backend/standart/administrator/permission/permission_view', $this->data);
	}

	/**
	* delete permissions
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		return $this->model_permission->remove($id);
	}

	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('permission_export');

		$this->model_permission->export('aauth_perms', 'permission');
	}
}

/* End of file Permission.php */
/* Location: ./application/controllers/administrator/Permission.php */