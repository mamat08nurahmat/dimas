<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Auth Controller
*| --------------------------------------------------------------------------
*| For authentication
*|
*/
class Auth extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Login user
	*
	*/
	public function login()
	{
		if ($this->aauth->is_loggedin()) {
			redirect('administrator/user/profile','refresh');
		}
		$data = [];
		$this->config->load('site');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run()) {
			if ($this->aauth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember'))) {
				redirect('/administrator/user/profile','refresh');
			} else {
				$data['error'] = $this->aauth->print_errors(TRUE);
			}
		} else {
			$data['error'] = validation_errors();
		}
		$this->template->build('backend/standart/administrator/login', $data);
	}

	/**
	* Register user member
	*
	*/
	public function register()
	{
		$data = [];

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[aauth_users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[aauth_users.email]');
		$this->form_validation->set_rules('agree', 'Agree', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');

		$this->form_validation->set_message('is_unique', 'User already used');

		if ($this->form_validation->run()) {
			$save_data = [
				'full_name' => $this->input->post('full_name')
			];
			$save_user = $this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $this->input->post('username'), $save_data);

			if ($save_user) {
				set_message('Your account sucessfully created');
				$this->aauth->add_member($save_user, 4);
				redirect('administrator/login', 'refresh');
			} else {
				$data['error'] = $this->aauth->print_errors();
			}
		} else {
			$data['error'] = validation_errors();
		}

		$this->template->build('backend/standart/administrator/register_member', $data);
	}

	/**
	* User forgot password
	*
	* @var String $id 
	*/
	public function forgot_password()
	{
		$data = [];

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[aauth_users.email]');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');

		$this->form_validation->set_message('is_unique', 'User already used');

		if ($this->form_validation->run()) {
			//custom your action
			$reset = $this->aauth->remind_password($this->input->post('email'));
			if ($reset) {
				set_message('Your password reset link send to your mail');
			} else {
				set_message('Failed to send password reminder', 'danger');
			}
			redirect('administrator/login', 'refresh');
		} else {
			$data['error'] = validation_errors();
		}

		$this->template->build('backend/standart/administrator/forgot_password', $data);
	}

	/**
	* User session logout
	*
	*/
	public function logout()
	{
		$this->aauth->logout();
		redirect('/');
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/administrator/Auth.php */