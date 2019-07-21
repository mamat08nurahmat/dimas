<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Menu Controller
*| --------------------------------------------------------------------------
*| menu site
*|
*/
class Menu extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_menu');
		$this->load->model('model_permission');
	}

	/**
	* show all menus
	*
	* @var $offset String
	*/
	public function index($type = null)
	{
		$this->is_allowed('menu_list');

		if (!$this->model_menu->get_id_menu_type_by_flag($type)) {
			redirect('administrator/menu/index/side-menu');
		}

		$this->template->title('Menu List');
		$this->render('backend/standart/administrator/menu/menu_list', $this->data);
	}

	/**
	* show all menus
	*
	*/
	public function add($menu_type ='')
	{
		$this->is_allowed('menu_add');

		$menu_type = $this->uri->segment(4);
		$menu_type_id = $this->model_menu->get_id_menu_type_by_flag($menu_type);

		if (!$menu_type_id) {
			$this->session->set_flashdata('f_message', 'Menu type '.$menu_type.' does not exist');
			$this->session->set_flashdata('f_type', 'warning');
			redirect('administrator/menu');
		}

		$this->data = [
			'menu_type_id' 		=> $menu_type_id,
			'color_icon'		=> $this->model_menu->get_color_icon()
		];

		$this->template->title('Menu New');
		$this->render('backend/standart/administrator/menu/menu_add', $this->data);
	}

	/**
	* Add New menus
	*
	* @return JSON
	*/
	public function add_save($menu_type = 'side menu')
	{
		if (!$this->is_allowed('menu_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('label', 'Label', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('menu_type_id', 'Menu Type', 'trim|required');

		if ($this->form_validation->run()) {
			
			$save_data = [
				'label' 		=> $this->input->post('label'),
				'link' 			=> $this->input->post('link'),
				'icon' 			=> $this->input->post('icon'),
				'parent' 		=> $this->input->post('parent'),
				'menu_type_id' 	=> $this->input->post('menu_type_id'),
				'type' 			=> $this->input->post('type'),
				'icon_color' 	=> $this->input->post('icon_color'),
				'sort' 			=> $this->model_menu->count_all(),
				'active' 	    => 1
			];

			$permission_menu_name = 'menu_'.strtolower(str_replace(' ', '_', $this->input->post('label')));
			$find_permission = $this->model_permission->get_single(['name' => $permission_menu_name]);

			if (!$find_permission) {
				$perm_id = $this->aauth->create_perm($permission_menu_name);
			} else {
				$perm_id = $find_permission->id;
			}

			$perm_to_group = [];

			if (count($this->input->post('group'))) {
				foreach ($this->input->post('group') as $group_id) {
					 $perm_to_group[] = [
					 	'perm_id' => $perm_id,
					 	'group_id' => $group_id
					 ];
				}
			}

			if (count($perm_to_group)) {
				$this->db->insert_batch('aauth_perm_to_group', $perm_to_group);
			}
			$save_menu = $this->model_menu->store($save_data);

			if ($save_menu) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_menu;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/menu/edit/' . $save_menu, 'Edit Blog'),
						anchor('administrator/menu', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/blog/edit/' . $save_menu, 'Edit Blog'),
						anchor('administrator/menu', ' Go back to list'),
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/menu');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message(cclang('data_not_change'), 'error');

            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/menu');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}

	/**
	* Update view menus
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('menu_update');

		$this->data = 
		[
			'menu' 			=> $this->model_menu->find($id),
			'color_icon'	=> $this->model_menu->get_color_icon(),
			'group_menu' 	=> $this->model_menu->get_group_menu($id)
		];

		$this->template->title('Menu Update');
		$this->render('backend/standart/administrator/menu/menu_update', $this->data);
	}

	/**
	* Update menus
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('menu_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}
		
		$this->form_validation->set_rules('label', 'Label', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('menu_type_id', 'Menu Type', 'trim|required');

		if ($this->form_validation->run()) {
			$save_data = [
				'label' 		=> $this->input->post('label'),
				'link' 			=> $this->input->post('link'),
				'icon' 			=> $this->input->post('icon'),
				'parent' 		=> $this->input->post('parent'),
				'menu_type_id' 	=> $this->input->post('menu_type_id'),
				'type' 			=> $this->input->post('type'),
				'icon_color' 	=> $this->input->post('icon_color'),
			];

			$menu = $this->model_menu->find($id);
			$permission = $this->model_menu->get_permission_by_name('menu_'.$menu->label);
			if ($permission) {
				$this->db->delete('aauth_perm_to_group', ['perm_id' => $permission->id]);
			}
			$permission_menu_name = 'menu_'.strtolower(str_replace(' ', '_', $this->input->post('label')));
			$find_permission = $this->model_permission->get_single(['name' => $permission_menu_name]);

			if (!$find_permission) {
				$perm_id = $this->aauth->create_perm($permission_menu_name);
			} else {
				$perm_id = $find_permission->id;
			}

			$perm_to_group = [];

			if (count($this->input->post('group'))) {
				foreach ($this->input->post('group') as $group_id) {
					 $perm_to_group[] = [
					 	'perm_id' => $perm_id,
					 	'group_id' => $group_id
					 ];
				}
			}

			if (count($perm_to_group)) {
				$this->db->insert_batch('aauth_perm_to_group', $perm_to_group);
			}

			$save_menu = $this->model_menu->change($id, $save_data);

			if ($save_menu) {
				$this->data['success'] = true;
				$this->data['id'] 	   = $id;
				$this->data['message'] = cclang('success_save_data_stay', [
					anchor('administrator/menu', ' Go back to list')
				]);
				
			} else {
				$this->data['success'] = false;
				$this->data['message'] = cclang('data_not_change');
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}
	
	/**
	* save ordering menus
	*
	* @var $id String
	*/
	public function save_ordering()
	{
		if (!$this->is_allowed('menu_save_ordering', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->menus = [];
		$this->sort = 0;
		$this->_parse_menu($_POST['menu']);
		$save_ordering = $this->db->update_batch('menu', $this->menus, 'id');
		if ($save_ordering) {
			$this->data = [
				'success' => true,
				'message' => cclang('success_save_data_stay'),
				'menu' 	  => display_menu_admin(0, 1)
			];
		} else {
			$this->data = [
				'success' => false,
				'message' => cclang('data_not_change')
			];
		}

		return $this->response($this->data);
	}

	/**
	* parse menu
	*
	* @var $menu array
	*/
	private function _parse_menu($menus, $parent = '')
	{
		$data = [];
		foreach ($menus as $menu) {
			$this->sort++;
			$this->menus[] = [
				'id' => $menu['id'],
				'sort' => $this->sort,
				'parent' => $parent
			];
			if (isset($menu['children'])) {
				$this->_parse_menu($menu['children'], $menu['id']);
			}
		}
	}

	/**
	* delete menus
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('menu_delete');

		$remove = $this->model_menu->remove($id);
		$this->model_menu->update_child_menu_by_parent($id);
		
		if ($remove) {
            set_message(cclang('has_been_deleted', 'Menu'), 'success');
        } else {
            set_message(cclang('error_delete', 'Menu'), 'error');
        }

		redirect('administrator/menu');
	}

	/**
	* Set status user
	*
	* @return JSON
	*/
	public function set_status()
	{
		if (!$this->is_allowed('menu_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}
		$status = $this->input->post('status');
		$id = $this->input->post('id');

		$update_status = $this->model_menu->change($id, [
			'active' => $status
		]);
		
		if ($update_status) {
			$this->response = [
				'success' => true,
				'message' => 'Menu status updated to '.($status == 1 ? 'active' : 'inactive'),
			];
		} else {
			$this->response = [
				'success' => false,
				'message' => cclang('data_not_change')
			];
		}

		return $this->response($this->response);
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/administrator/Menu.php */