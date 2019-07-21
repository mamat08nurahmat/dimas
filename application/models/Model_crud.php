<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_crud extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'crud';
	private $field_search 	= array('table_name', 'subject', 'title');

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = '', $field = '')
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = '', $field = '', $limit = 0, $offset = 0)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_input_type()
	{
		$this->db->group_by('validation_group');
		$result = $this->db->get('crud_input_type');

		$validation_group = '';
		foreach ($result->result() as $row) {
			$validation_group .= $row->validation_group. ' ';
		}

		return $validation_group;

	}

	public function crud_exist($table_name = '')
	{
		$result = $this->db->get_where($this->table_name, ['table_name' => $table_name])->row();

		if ($result) {
			return $result->id;
		}

		return false;
	}

	public function get_crud_field($id)
	{
		$this->db->order_by('sort', 'asc');
		$result = $this->db->get_where('crud_field', ['crud_id' => $id])->result();

		return $result;
	}

	public function get_crud_field_validation($id)
	{
		$validations = [];

		$this->db->join('crud_input_validation', 'crud_input_validation.validation = crud_field_validation.validation_name', 'LEFT');
		$result = $this->db->get_where('crud_field_validation', ['crud_id' => $id])->result();

		foreach ($result as $row) {
			$validations[$row->crud_field_id][] = $row; 
		}

		return $validations;
	}

	public function get_crud_field_option($id)
	{
		$validations = [];

		$result = $this->db->get_where('crud_custom_option', ['crud_id' => $id])->result();

		foreach ($result as $row) {
			$validations[$row->crud_field_id][] = $row; 
		}

		return $validations;
	}

	public function get_new_field($id)
	{
		$crud_field = $this->model_crud->get_crud_field($id);
		$crud = $this->model_crud->find($id);
		$all_fields = $this->db->field_data($crud->table_name);

		$all_fields_key = [];
		$current_crud_field_name = [];
		$all_field_data_field_name = [];

		foreach ($crud_field as $field) {
			$current_crud_field_name[] = $field->field_name;
		}
		foreach ($all_fields as $field) {
			$all_field_data_field_name[] = $field->name;
			$all_fields_key[$field->name] = $field;
		}

		$new_diff = array_diff($all_field_data_field_name,$current_crud_field_name);
		$new_fields = [];

		foreach ($new_diff as $field_name) {
			$new_fields[] = 
			(object)[
				
				'id' => 37,
			    'crud_id' => 1,
			    'field_name' => $all_fields_key[$field_name]->name,
			    'field_label' => $all_fields_key[$field_name]->name,
			    'input_type' => 'input',
			    'show_column' => 'yes',
			    'show_add_form' => 'yes',
			    'show_update_form' => 'yes',
			    'show_detail_page' => 'yes',
			    'sort' => 1,
			    'relation_table' => '' ,
			    'relation_value' => '',
			    'relation_label' => '',
			    'new_field' => 'yes',
			];
		}

		return $new_fields;

	}

}

/* End of file Model_crud.php */
/* Location: ./application/models/Model_crud.php */