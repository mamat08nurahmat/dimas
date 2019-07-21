<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Extension Controller
*| --------------------------------------------------------------------------
*| Extension site
*|
*/
class Extension extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* show all Extensions
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('extension_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$extensions = $this->cc_extension->getExtensions();
		$this->data['extensions'] = $extensions;
		$this->template->title('Extension List');

		$this->render('backend/standart/administrator/extension/extension_list', $this->data);
	}
	
	public function add()
	{
		$this->is_allowed('extension_add');

		$extensions = $this->cc_extension->getExtensions();
		$this->data['extensions'] = $this->_external_extension();

		$this->data['extension_installed'] = get_installed_extension();
		$this->template->title('Extension List');

		
		$this->render('backend/standart/administrator/extension/extension_add', $this->data);
	}
	

	/**
	* delete Extensions
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('extension_delete');

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
            set_message(cclang('has_been_deleted', 'extension'), 'success');
        } else {
            set_message(cclang('error_delete', 'extension'), 'error');
        }

		redirect_back();
	}

	
	/**
	* delete Extensions
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$extension = $this->model_extension->find($id);
		
		return $this->model_extension->remove($id);
	}

	public function activation()
	{
		$this->is_allowed('extension_activate');
		$this->load->helper('file');
		$extension = $this->input->get('ex');
		$ext_path = FCPATH . 'cc-content/extensions/'.$extension. '/actived' ;
		file_put_contents($ext_path, '');
        set_message(cclang('has_been_actived', 'extension'), 'success');
		redirect_back();
	}

	public function deactivation()
	{
		$this->is_allowed('extension_deactivate');
		$this->load->helper('file');
		$extension = $this->input->get('ex');
		$ext_path = FCPATH . 'cc-content/extensions/'.$extension. '/actived';
		@unlink($ext_path);
        set_message(cclang('has_been_inactived', 'extension'), 'success');
		redirect_back();
	}

	public function _external_extension()
	{
	    $extensionListUrl = 'https://raw.githubusercontent.com/cicoolbuilder/cc-extension/master/extensions.json';
		$this->load->library('Ccurl/Curl');


		$result = file_get_contents($extensionListUrl);
		$extensions = [];

		if ($result) {
			$extensions = json_decode($result);
		}

		return $extensions;
	}

	public function list_external_extension()
	{
		$this->response($this->_external_extension());
	}

	public function install()
	{
		$this->_install();
	}

	public function update()
	{
		$this->_install();
	}

	public function _install()
	{
		if (!$this->is_allowed('extension_install', false)) {
            return $this->response([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access'),
            ]);
        }

		$this->load->helper('file');
		$zip = new ZipArchive;
		$ex = $this->input->get('ex');
        list($cicool, $regid) = explode('/', $ex);

		$path = 'https://github.com/'.$ex.'/archive/master.zip';
		$destination = APPPATH. 'cache/'.$regid.'.zip';

		file_put_contents($destination, fopen($path, 'r'));

		if ($zip->open($destination) === TRUE) {
		    $zip->extractTo(APPPATH.'/cache/');
		    recurse_copy(APPPATH.'/cache/'.$regid.'-master', 'cc-content/extensions/'.$regid);
		    $zip->close();
		    sleep(1);
		    @unlink($destination);
		    delete_files(APPPATH.'/cache/'.$regid.'-master', true);
		    @rmdir(APPPATH.'/cache/'.$regid.'-master');
		    $this->response([
                'success' => true,
                'message' => 'Extension installed',
            ]);
		} else {
			$this->response([
                'success' => true,
                'message' => 'Extension can\'t installed',
            ]);
		}
	}
}


/* End of file extension.php */
/* Location: ./application/controllers/administrator/Extension.php */