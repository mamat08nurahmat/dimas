<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Oauth Controller
*| --------------------------------------------------------------------------
*| Oauth site
*|
*/
class Oauth extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
	}

	public function v($provider_type)
	{
		$this->load->helper('url_helper');
		
		$this->load->library('OAuth2');

		$this->load->config('oauth');

		if (!in_array($provider_type, ['google'])) {
			show_404();
		}

		if(!get_option('google_id') or !get_option('google_secret')) {
			set_message('Setup google id and google secret first', 'danger');
			redirect('administrator/login');
		}

		$provider = $this->oauth2->provider($provider_type, [
			'id' => get_option($provider_type.'_id'),
			'secret' => get_option($provider_type.'_secret')
		]);

		if ( ! $this->input->get('code'))
		{
			$provider->authorize();
		}
		else
		{
			try
			{
				$token = $provider->access($_GET['code']);
			
				$user = $provider->get_user_info($token);

				$userdb = $this->model_user->get_user_oauth($user['email'], $provider_type);

				if ($userdb) {
					$this->aauth->login($user['email'], $user['uid']);
				} else {
					@file_put_contents('uploads/user/'.$user['uid'].'.jpg', @file_get_contents($user['image']));
					$save_data = [
						'full_name' => $user['name'],
						'oauth_uid' => $user['uid'],
						'oauth_provider' => $provider_type,
						'avatar' => $user['uid'].'.jpg'
					];

					$username = explode('@', $user['email'])[0];
					$username = str_replace('-', '', url_title($username));

					$save_user = $this->aauth->create_user($user['email'], $user['uid'], $username, $save_data);
					$login = $this->aauth->login($user['email'], $user['uid']);

				}
				
				redirect('administrator/dashboard');
			}
		
			catch (OAuth2_Exception $e)
			{
				show_error('That didnt work: '.$e);
			}
		
		}
	}
}