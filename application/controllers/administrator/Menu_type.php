<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Menu type Controller
*| --------------------------------------------------------------------------
*| menu_type site
*|
*/
class Menu_type extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_menu_type');
	}

	/**
	* show all menu_types
	*
	*/
	public function add()
	{
		$this->is_allowed('menu_type_add');

		$this->template->title('Menu Type New');
		$this->render('backend/standart/administrator/menu_type/menu_type_add', $this->data);
	}

	/**
	* Add New menu_types
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('menu_type_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[menu_type.name]|alpha_numeric_spaces');

		if ($this->form_validation->run()) {
			
			$save_data = [
				'name' 			=> $this->input->post('name'),
				'definition' 	=> $this->input->post('definition'),
			];

			$save_menu_type = $this->model_menu_type->store($save_data);

			if ($this->input->post('save_type') == 'stay') {
				$this->response['success'] = true;
				$this->response['message'] = cclang('success_save_data_stay', [
						anchor('administrator/menu', 'View All'),
					]);
			} else {
				set_message(cclang('success_save_data_stay', [
						anchor('administrator/menu', 'View All'),
					]), 'success');
        		$this->response['success'] = true;
				$this->response['redirect'] = site_url('administrator/menu');
			}

		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return $this->response($this->response);
	}

	/**
	* delete menu_types
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('menu_type_delete');

		$remove = $this->model_menu_type->remove($id);
		$this->db->delete('menu', ['menu_type_id' => $id]);

		if ($remove) {
            set_message(cclang('has_been_deleted', 'Menu'), 'success');
        } else {
            set_message(cclang('error_delete', 'Menu'), 'error');
        }

		redirect_back();
	}
}

/* End of file Menu_type.php */
/* Location: ./application/controllers/administrator/Menu_type.php */