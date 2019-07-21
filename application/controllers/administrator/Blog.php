<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Blog Controller
*| --------------------------------------------------------------------------
*| Blog site
*|
*/
class Blog extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_blog');
	}

	/**
	* show all Blogs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('blog_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['blogs'] = $this->model_blog->get($filter, $field, $this->limit_page, $offset);
		$this->data['blog_counts'] = $this->model_blog->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/blog/index/',
			'total_rows'   => $this->model_blog->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Blog List');
		$this->render('backend/standart/administrator/blog/blog_list', $this->data);
	}
	
	/**
	* Add new blogs
	*
	*/
	public function add()
	{
		$this->is_allowed('blog_add');

		$this->template->title('Blog New');
		$this->render('backend/standart/administrator/blog/blog_add', $this->data);
	}

	/**
	* Add New Blogs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('blog_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('blog_image_name[]', 'Image', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[10]');
		

		if ($this->form_validation->run()) {
			$slug = url_title(substr($this->input->post('title'), 0, 100));
			$save_data = [
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'content' => $this->input->post('content'),
				'tags' => $this->input->post('tags'),
				'category' => $this->input->post('category'),
				'author' => get_user_data('username'),
				'status' => $this->input->post('status'),
				'created_at' => date('Y-m-d H:i:s'),
			];


			if (!is_dir(FCPATH . '/uploads/blog/')) {
				mkdir(FCPATH . '/uploads/blog/');
			}

			if (count((array) $this->input->post('blog_image_name'))) {
				foreach ((array) $_POST['blog_image_name'] as $idx => $file_name) {
					$blog_image_name_copy = date('YmdHis') . '-' . $file_name;

					rename(FCPATH . 'uploads/tmp/' . $_POST['blog_image_uuid'][$idx] . '/' .  $file_name, 
							FCPATH . 'uploads/blog/' . $blog_image_name_copy);

					$listed_image[] = $blog_image_name_copy;

					if (!is_file(FCPATH . '/uploads/blog/' . $blog_image_name_copy)) {
						echo json_encode([
							'success' => false,
							'message' => 'Error uploading file'
							]);
						exit;
					}
				}

				$save_data['image'] = implode($listed_image, ',');
			}
		
			
			$save_blog = $this->model_blog->store($save_data);

			if ($save_blog) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_blog;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/blog/edit/' . $save_blog, 'Edit Blog'),
						anchor('administrator/blog', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/blog/edit/' . $save_blog, 'Edit Blog')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/blog');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/blog');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Blogs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('blog_update');

		$this->data['blog'] = $this->model_blog->find($id);

		$this->template->title('Blog Update');
		$this->render('backend/standart/administrator/blog/blog_update', $this->data);
	}

	/**
	* Update Blogs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('blog_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('blog_image_name[]', 'Image', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[10]');
		
		if ($this->form_validation->run()) {
		
			$slug = url_title(substr($this->input->post('slug'), 0, 100));
			$save_data = [
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'content' => $this->input->post('content'),
				'tags' => $this->input->post('tags'),
				'category' => $this->input->post('category'),
				'author' => get_user_data('username'),
				'status' => $this->input->post('status'),
				'updated_at' => date('Y-m-d H:i:s'),
			];

			$listed_image = [];
			if (count((array) $this->input->post('blog_image_name'))) {
				foreach ((array) $_POST['blog_image_name'] as $idx => $file_name) {
					if (isset($_POST['blog_image_uuid'][$idx]) AND !empty($_POST['blog_image_uuid'][$idx])) {
						$blog_image_name_copy = date('YmdHis') . '-' . $file_name;

						rename(FCPATH . 'uploads/tmp/' . $_POST['blog_image_uuid'][$idx] . '/' .  $file_name, 
								FCPATH . 'uploads/blog/' . $blog_image_name_copy);

						$listed_image[] = $blog_image_name_copy;

						if (!is_file(FCPATH . '/uploads/blog/' . $blog_image_name_copy)) {
							echo json_encode([
								'success' => false,
								'message' => 'Error uploading file'
								]);
							exit;
						}
					} else {
						$listed_image[] = $file_name;
					}
				}
			}
			
			$save_data['image'] = implode($listed_image, ',');
		
			
			$save_blog = $this->model_blog->change($id, $save_data);

			if ($save_blog) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/blog', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/blog');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/blog');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Blogs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('blog_delete');

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
            set_message(cclang('has_been_deleted', 'blog'), 'success');
        } else {
            set_message(cclang('error_delete', 'blog'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Blogs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('blog_view');

		$this->data['blog'] = $this->model_blog->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Blog Detail');
		$this->render('backend/standart/administrator/blog/blog_view', $this->data);
	}
	
	/**
	* delete Blogs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$blog = $this->model_blog->find($id);

		
		if (!empty($blog->image)) {
			foreach ((array) explode(',', $blog->image) as $filename) {
				$path = FCPATH . '/uploads/blog/' . $filename;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}
		}
		
		return $this->model_blog->remove($id);
	}
	
	
	/**
	* Upload Image Blog	* 
	* @return JSON
	*/
	public function upload_image_file()
	{
		if (!$this->is_allowed('blog_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'blog',
			'allowed_types' => 'jpg|jpeg|png',
		]);
	}

	/**
	* Delete Image Blog	* 
	* @return JSON
	*/
	public function delete_image_file($uuid)
	{
		if (!$this->is_allowed('blog_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'blog',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/'
        ]);
	}

	/**
	* Get Image Blog	* 
	* @return JSON
	*/
	public function get_image_file($id)
	{
		if (!$this->is_allowed('blog_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$blog = $this->model_blog->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'image', 
            'table_name'        => 'blog',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/',
            'delete_endpoint'   => 'administrator/blog/delete_image_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('blog_export');

		$this->model_blog->export('blog', 'blog');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('blog_export');

		$this->model_blog->pdf('blog', 'blog');
	}
}


/* End of file blog.php */
/* Location: ./application/controllers/administrator/Blog.php */