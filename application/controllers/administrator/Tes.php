<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| User Controller
*| --------------------------------------------------------------------------
*| user site
*|
*/
class Tes extends Admin	
{
    // public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->model('model_user');
	// }
    public function index()
    {
        
        $kode    = $this->input->post('_kode_grab',true);
        $expired = $this->input->post('_expired_date',true);
        $active  = $this->input->post('_active_date',true);
        var_dump($kode);

    //    $data=[
    //        'kode_grab'  = $this->input->post('_kode_grab',true);
    //        'expired'    = $this->input->post('_expired_date',true);
    //        'is_used'    = 0;
    //        'used_at'    = '2999-12-31';
    //        'timestamp'  = '0000-00-00';
    //        'active'     = $this->input->post('_active_date',true);
    //    ];
    //    $this->insert('kode_grab_tes',$data);
    }

}
