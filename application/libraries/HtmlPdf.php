<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library html pdf for codeigniter 
* @author muhamad ridwan
* @since 2014
*/

require_once(APPPATH . "libraries/htmlpdf/html2pdf.class.php");

class HtmlPdf extends HTML2PDF
{

	var $orientation 	= 'p';
	var $format 		= 'A4';
	var $langue 		= 'fr';
	var $unicode 		= TRUE;
	var $encoding 		= 'UTF-8';
	var $marges 		= array(5, 5, 5, 5);

	public function __construct($config = array())
	{
		
		$this->initialize($config);

		parent::__construct($this->orientation, $this->format, $this->langue, $this->unicode, $this->encoding, $this->marges);

	}

	public function initialize($config = array())
	{
		foreach ($config as $key => $value) {
			if(isset($this->$key))
			{
				$this->$key = $value;
			}
		}
	}

	/**
	*load html dan simpan ke dalam variable
	* @param file string
	* @param data array
	*/
    public function loadHtmlPdf($file = NULL, $data = array())
    {
    	$CI =& get_instance();
        $file = $CI->load->view($file, $data, TRUE);

        for ($i=0; $i < 50; $i++) { 
            $file = str_replace("[space_{$i}]", $this->_parseChars($i), $file);
        }
        return $file;
    }

    /**
    *jumlah space
    * @param jml integer
    * @param chars string
    */

    public function _parseChars($jml = 1, $chars = "&nbsp;")
    {
        $htmlChars = NULL;
        for ($i=0; $i < $jml; $i++) { 
            $htmlChars .= $chars;
        }

        return $htmlChars;
    }


}

/* End of file HtmlPdf.php */
/* Location: ./application/libraries/HtmlPdf.php */