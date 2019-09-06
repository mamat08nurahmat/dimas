<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form System Upload Controller
*| --------------------------------------------------------------------------
*| Form System Upload site
*|
*/
class Form_System_upload extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_system_upload');
	}

	/**
	* show all Form System Uploads
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_system_upload_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_system_uploads'] = $this->model_form_system_upload->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_system_upload_counts'] = $this->model_form_system_upload->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_system_upload/index/',
			'total_rows'   => $this->model_form_system_upload->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('System Upload List');
		$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_list', $this->data);
	}


// incoming
public function incoming($offset = 0)
{
	$this->is_allowed('form_system_upload_list');

	$filter = $this->input->get('INCOMING');
	$field 	= $this->input->get('application_source');

	$this->data['form_system_uploads'] = $this->model_form_system_upload->get($filter, $field, $this->limit_page, $offset);
	$this->data['form_system_upload_counts'] = $this->model_form_system_upload->count_all($filter, $field);

	$config = [
		'base_url'     => 'administrator/form_system_upload/index/',
		'total_rows'   => $this->model_form_system_upload->count_all($filter, $field),
		'per_page'     => $this->limit_page,
		'uri_segment'  => 4,
	];

	$this->data['pagination'] = $this->pagination($config);

	$this->template->title('System Upload List');
	$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_list', $this->data);
}





	/**
	* Update view Form System Uploads
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_system_upload_update');

		$this->data['form_system_upload'] = $this->model_form_system_upload->find($id);

		$this->template->title('System Upload Update');
		$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_update', $this->data);
	}

	/**
	* Update Form System Uploads
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_system_upload_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('form_system_upload_file_name_name', 'File Name', 'trim|required');
		$this->form_validation->set_rules('application_source', 'Application Source', 'trim|required');
		$this->form_validation->set_rules('batch_id', 'Batch Id', 'trim|required');
		$this->form_validation->set_rules('process_month', 'Process Month', 'trim|required');
		$this->form_validation->set_rules('process_year', 'Process Year', 'trim|required');
		// $this->form_validation->set_rules('upload_at', 'Upload At', 'trim|required');
		
		if ($this->form_validation->run()) {
			$form_system_upload_file_name_uuid = $this->input->post('form_system_upload_file_name_uuid');
			$form_system_upload_file_name_name = $this->input->post('form_system_upload_file_name_name');
		
			$save_data = [
				'application_source' => $this->input->post('application_source'),
				'batch_id' => $this->input->post('batch_id'),
				'process_month' => $this->input->post('process_month'),
				'process_year' => $this->input->post('process_year'),
				// 'uploader' => $this->input->post('uploader'),
				'uploader' => get_user_data('id'),
				
				//'upload_at' => $this->input->post('upload_at'),
				'update_at' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/form_system_upload/')) {
				mkdir(FCPATH . '/uploads/form_system_upload/');
			}

			if (!empty($form_system_upload_file_name_uuid)) {
				$form_system_upload_file_name_name_copy = date('YmdHis') . '-' . $form_system_upload_file_name_name;

				rename(FCPATH . 'uploads/tmp/' . $form_system_upload_file_name_uuid . '/' . $form_system_upload_file_name_name, 
						FCPATH . 'uploads/form_system_upload/' . $form_system_upload_file_name_name_copy);

				if (!is_file(FCPATH . '/uploads/form_system_upload/' . $form_system_upload_file_name_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file_name'] = $form_system_upload_file_name_name_copy;
			}
		
			
			$save_form_system_upload = $this->model_form_system_upload->change($id, $save_data);

			if ($save_form_system_upload) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_system_upload', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_system_upload');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_system_upload');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form System Uploads
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_system_upload_delete');

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
            set_message(cclang('has_been_deleted', 'Form System Upload'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form System Upload'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form System Uploads
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_system_upload_view');

		$this->data['form_system_upload'] = $this->model_form_system_upload->find($id);

		$this->template->title('System Upload Detail');
		$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_view', $this->data);
	}


	public function viewx($id)
	{
		$this->is_allowed('form_system_upload_view');

		$this->data['form_system_upload'] = $this->model_form_system_upload->find($id);

		$this->template->title('System Upload Detail');
		$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_view', $this->data);
	}


	/**
	* delete Form System Uploads
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_system_upload = $this->model_form_system_upload->find($id);

		if (!empty($form_system_upload->file_name)) {
			$path = FCPATH . '/uploads/form_system_upload/' . $form_system_upload->file_name;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		
		return $this->model_form_system_upload->remove($id);
	}
	
	/**
	* Upload Image Form System Upload	* 
	* @return JSON
	*/
	public function upload_file_name_file()
	{
		if (!$this->is_allowed('form_system_upload_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'form_system_upload',
		]);
	}

	/**
	* Delete Image Form System Upload	* 
	* @return JSON
	*/
	public function delete_file_name_file($uuid)
	{
		if (!$this->is_allowed('form_system_upload_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file_name', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'form_system_upload',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_system_upload/'
        ]);
	}

	/**
	* Get Image Form System Upload	* 
	* @return JSON
	*/
	public function get_file_name_file($id)
	{
		if (!$this->is_allowed('form_system_upload_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$form_system_upload = $this->model_form_system_upload->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file_name', 
            'table_name'        => 'form_system_upload',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_system_upload/',
            'delete_endpoint'   => 'administrator/form_system_upload/delete_file_name_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_system_upload_export');

		$this->model_form_system_upload->export('form_system_upload', 'form_system_upload');
	}

//===============================
public function system_upload($id)
{
	$this->is_allowed('form_system_upload_view');

	$this->data['form_system_upload'] = $this->model_form_system_upload->find($id);

	$this->template->title('System Upload Detail');
	$this->render('backend/standart/administrator/form_builder/form_system_upload/form_system_upload_view', $this->data);
}





}



/* End of file form_system_upload.php */
/* Location: ./application/controllers/administrator/Form System Upload.php */