<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Security extends CI_Security {

	private $ci;

    public function __construct() 
    {
        parent::__construct();
    }

	public function csrf_verify()
	{
		$uri = load_class('URI');

		if ($uri->segment(1) != 'api') {
			return parent::csrf_verify();
		}
	}
}

/* End of file My_Security.php */
/* Location: ./application/core/My_Security.php */