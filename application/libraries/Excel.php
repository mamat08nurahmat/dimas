<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/libraries/Excel/PHPExcel.php"; 
require_once APPPATH."/libraries/Excel/PHPExcel/IOFactory.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 
}