<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| File Controller
*| --------------------------------------------------------------------------
*| user site
*|
*/
class File extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user');
	}

	/**
	* download file
	*
	* @var $file_path String
	* @var $file_name String
	*/
	public function download($file_path = null, $file_name = null)
	{
		$this->load->helper('download');
		$path = FCPATH . '/uploads/siswa/' . $file_name;
		
		force_download($file_name, $path);
	}
}