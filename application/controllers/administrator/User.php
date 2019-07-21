<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| User Controller
*| --------------------------------------------------------------------------
*| user site
*|
*/
class User extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user');
	}

	/**
	* show all users
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('user_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['users'] = $this->model_user->get($filter, $field, $this->limit_page, $offset);
		$this->data['user_counts'] = $this->model_user->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/user/index/',
			'total_rows'   => $this->model_user->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('User List');
		$this->render('backend/standart/administrator/user/user_list', $this->data);
	}

	/**
	* show all users
	*
	*/
	public function add()
	{
		$this->is_allowed('user_add');

		$this->template->title('User New');
		$this->render('backend/standart/administrator/user/user_add', $this->data);
	}

	/**
	* Add New users
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('user_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[aauth_users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[aauth_users.email]|valid_email');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('full_name'),
				'avatar' 		=> 'default.png',
				'date_created'	=> date('Y-m-d H:i:s')
			];

			if (!empty($user_avatar_name)) {

				$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

				if (!is_dir(FCPATH . '/uploads/user')) {
					mkdir(FCPATH . '/uploads/user');
				}

				@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
						FCPATH . 'uploads/user/' . $user_avatar_name_copy);

				$save_data['avatar'] = $user_avatar_name_copy;
			}

			$save_user = $this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $this->input->post('username'), $save_data);

			if ($save_user) {
				//add user to group
				if (count($this->input->post('group'))) {
					$user_id = $save_user;
					foreach ($this->input->post('group') as $group_id) {
						$this->aauth->add_member($user_id, $group_id);				
					}
				}
				if ($this->input->post('save_type') == 'stay') {
					$this->response['success'] = true;
					$this->response['message'] = cclang('success_save_data_stay', [
						anchor('administrator/user/edit/' . $save_user, 'Edit User'),
						anchor('administrator/user', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/user/edit/' . $save_user, 'Edit User')
					]), 'success');

	        		$this->response['success'] = true;
					$this->response['redirect'] = site_url('administrator/user');
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
	* Update view users
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('user_update');

		$this->data = [
			'user' 			=> $this->model_user->find($id),
			'group_user' 	=> $this->model_user->get_group_user($id)
		];

		$this->template->title('User Update');
		$this->render('backend/standart/administrator/user/user_update', $this->data);
	}

	/**
	* Update users
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('user_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('full_name'),
			];

			if (!empty($user_avatar_name)) {
				if (!empty($user_avatar_uuid)) {
					$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;
		
					rename(FCPATH . '/uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
							FCPATH . '/uploads/user/' . $user_avatar_name_copy);

					if (!is_file(FCPATH . '/uploads/user/' . $user_avatar_name_copy)) {
						return $this->response([
							'success' => false,
							'message' => 'Error uploading avatar'
							]);
						exit;
					}

					$save_data['avatar'] = $user_avatar_name_copy;
				}
			}

			if ($pass = $this->input->post('password')) {
				$password = $pass;
			} else {
				$password = false;
			}

			$save_user = $this->aauth->update_user($id, $this->input->post('email'), $password, $this->input->post('username'), $save_data);

			if ($save_user) {
				//update user to group
				$this->db->delete('aauth_user_to_group', ['user_id' => $id]);
				if (count($this->input->post('group'))) {
					foreach ($this->input->post('group') as $group_id) {
						$this->aauth->add_member($id, $group_id);				
					}
				}

				if ($this->input->post('save_type') == 'stay') {
					$this->response['success'] = true;
					$this->response['message'] = cclang('success_update_data_stay', [
						anchor('administrator/user', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

	        		$this->response['success'] = true;
					$this->response['redirect'] = site_url('administrator/user');
				}
			} else {
				$this->response['success'] = false;
				$this->response['message'] = cclang('data_not_change').$this->aauth->print_errors();
			}

		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return $this->response($this->response);
	}

	/**
	* delete users
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('user_delete');

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
            set_message(cclang('has_been_deleted', 'User'), 'success');
        } else {
            set_message(cclang('error_delete', 'User'), 'error');
        }

		redirect_back();
	}

	/**
	* View view users
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('user_view');

		$this->data['user'] = $this->model_user->find($id);

		$this->template->title('User Detail');
		$this->render('backend/standart/administrator/user/user_view', $this->data);
	}

	/**
	* Profile user
	*
	*/
	public function profile()
	{
		$this->is_allowed('user_profile');

		$this->data['user'] = $this->model_user->find($this->aauth->get_user()->id);

		$this->template->title('User Profile');
		$this->render('backend/standart/administrator/user/user_profile', $this->data);
	}

	/**
	* Update view profile
	*
	*/
	public function edit_profile()
	{
		$this->is_allowed('user_update_profile');
		$id_user = $this->aauth->get_user()->id;
		$this->data = [
			'user' 			=> $this->model_user->find($id_user),
			'group_user' 	=> $this->model_user->get_group_user($id_user)
		];

		$this->template->title('Update Profile');
		$this->render('backend/standart/administrator/user/user_update_profile', $this->data);
	}

	/**
	* Update profile
	*
	* @var $id String
	*/
	public function edit_profile_save($id)
	{
		if (!$this->is_allowed('user_update_profile', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('full_name'),
			];

			if (!empty($user_avatar_name)) {
				if (!empty($user_avatar_uuid)) {
					$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;
		
					rename(FCPATH . '/uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
							FCPATH . '/uploads/user/' . $user_avatar_name_copy);

					if (!is_file(FCPATH . '/uploads/user/' . $user_avatar_name_copy)) {
						return $this->response([
							'success' => false,
							'message' => 'Error uploading avatar'
							]);
						exit;
					}

					$save_data['avatar'] = $user_avatar_name_copy;
				}
			}

			if ($pass = $this->input->post('password')) {
				$password = $pass;
			} else {
				$password = false;
			}

			$save_user = $this->aauth->update_user($id, $this->input->post('email'), $password, $this->input->post('username'), $save_data);

			if ($save_user) {
				$this->data['success'] = true;
				$this->data['id'] 	   = $id;
				$this->data['message'] = 'Your data has been successfully updated into the database. '.anchor('administrator/user', ' Go back to list');
			} else {
				$this->data['success'] = false;
				$this->data['message'] = cclang('data_not_change').$this->aauth->print_errors();
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}

	/**
	* delete users
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$user = $this->model_user->find($id);

		if (!empty($user->image)) {
			$path = FCPATH . '/uploads/user/' . $user->image;

			if (is_file($path)) {
				$delete_file = delete_files($path);
			}
		}

		return $this->model_user->remove($id);
	}

	/**
	* Upload Image User
	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		if (!$this->is_allowed('user_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$uuid = $this->input->post('qquuid');

		mkdir(FCPATH . '/uploads/tmp/' . $uuid);

		$config = [
			'upload_path' 		=> './uploads/tmp/' . $uuid . '/',
			'allowed_types' 	=> 'png|jpeg|jpg|gif',
			'max_size'  		=> '1000'
		];
		
		$this->load->library('upload', $config);
		$this->load->helper('file');

		if ( ! $this->upload->do_upload('qqfile')){
			$result = [
				'success' 	=> false,
				'error' 	=>  $this->upload->display_errors()
			];

    		return $this->response($result);
		}
		else{
			$upload_data = $this->upload->data();

			$result = [
				'uploadName' 	=> $upload_data['file_name'],
				'success' 		=> true,
			];

    		return $this->response($result);
		}
	}

	/**
	* Delete Image User
	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		if (!$this->is_allowed('user_delete', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		if (!empty($uuid)) {
			$this->load->helper('file');

			$delete_by = $this->input->get('by');
			$delete_file = false;

			if ($delete_by == 'id') {
				$user = $this->model_user->find($uuid);
				$path = FCPATH . 'uploads/user/'.$user->avatar;

				if (isset($uuid)) {
					if (is_file($path)) {
						$delete_file = unlink($path);
						$this->model_user->change($uuid, ['avatar' => '']);
					}
				}
			} else {
				$path = FCPATH . '/uploads/tmp/' . $uuid . '/';
				$delete_file = delete_files($path, true);
			}

			if (isset($uuid)) {
				if (is_dir($path)) {
					rmdir($path);
				}
			}

			if (!$delete_file) {
				$result = [
					'error' =>  'Error delete file'
				];

	    		return $this->response($result);
			} else {
				$result = [
					'success' => true,
				];

	    		return $this->response($result);
			}
		}
	}

	/**
	* Get Image User
	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{
		if (!$this->is_allowed('user_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}
		$this->load->helper('file');
		
		$user = $this->model_user->find($id);

		if (!$user) {
			$result = [
				'error' =>  'Error getting file'
			];

    		return $this->response($result);
		} else {
			if (!empty($user->avatar)) {
				$result[] = [
					'success' 				=> true,
					'thumbnailUrl' 			=> base_url('uploads/user/'.$user->avatar),
					'id' 					=> 0,
					'name' 					=> $user->avatar,
					'uuid' 					=> $user->id,
					'deleteFileEndpoint' 	=> base_url('administrator/user/delete_avatar_file'),
					'deleteFileParams'		=> ['by' => 'id']
				];

	    		return $this->response($result);
			}
		}
	}

	/**
	* Set status user
	*
	* @return JSON
	*/
	public function set_status()
	{
		if (!$this->is_allowed('user_update_status', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}
		$status = $this->input->post('status');
		$id = $this->input->post('id');

		$update_status = $this->model_user->change($id, [
			'banned' => $status == 'inactive' ? 1 : 0
		]);
		
		if ($update_status) {
			$this->response = [
				'success' => true,
				'message' => 'User status updated',
			];
		} else {
			$this->response = [
				'success' => false,
				'message' => cclang('data_not_change')
			];
		}

		return $this->response($this->response);
	}

	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('user_export');
		$this->model_user->export('aauth_users', 'user');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('user_export');

		$this->model_user->pdf('aauth_users', 'User');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/administrator/User.php */