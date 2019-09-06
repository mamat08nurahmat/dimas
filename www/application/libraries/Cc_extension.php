<?php

/**
 * CC extension Class
 *
 * @package			Cicool  
 * @category		Components
 */

class Cc_Extension
{
	protected $item;

	protected $extensionListUrl = 'https://raw.githubusercontent.com/cicoolbuilder/cc-extension/master/extensions.json';

	public function getExtensions()
	{
		$extensions = [];
		foreach (get_extensions() as $type => $items) {
			foreach ($items as $item) {
				$extensions[] = new Cc_Extension_item($item);
			}
		}

		return $extensions;
	}
}

class Cc_Extension_item
{
	public $item;
	public $ci;

	public function __construct($item)
	{
		$this->item = $item;
		$this->ci =& get_instance();
		return $this;
	}

	public function actived()
	{
		if (file_exists($this->item->path . 'actived')) {
			return true;
		}

		return false;
	}

	public function getExtName()
	{
		return str_replace(DIRECTORY_SEPARATOR, '', $this->item->dirname);
	}

	public function getInformationFoot()
	{
		cicool()->eventListen('extension_info_'.$this->getExtName());
	}

	public function render($view, $data, $bool)
	{
		$this->ci->load->view($this->getExtName() . '/' . $view, $data, $bool);
	}

}
