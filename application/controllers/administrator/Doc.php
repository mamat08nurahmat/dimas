<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Doc Controller
*| --------------------------------------------------------------------------
*| For see your board
*|
*/
class Doc extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* See api documentation
	*
	* @return String
	*/
	public function api()
	{
		$this->render('backend/standart/api_doc');
	}

	/**
	* See web documentation
	*
	* @return String
	*/
	public function web()
	{
		$this->render('backend/standart/web_doc');
	}
}

/* End of file Doc.php */
/* Location: ./application/controllers/administrator/Doc.php */