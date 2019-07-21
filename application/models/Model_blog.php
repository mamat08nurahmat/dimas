<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_blog extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'blog';
	private $field_search 	= ['title', 'slug', 'image', 'category', 'status', 'author', 'created_at'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null,$category = null, $tag = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "blog.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "blog.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "blog.".$field . " LIKE '%" . $q . "%' )";
        }

        if ($tag) {
        	$this->db->where('tags LIKE "%'.$tag.'%"');
        }
		
		if ($category) {
			$this->db->where('category', $category);
		}
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $category = null, $tag = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "blog.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "blog.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "blog.".$field . " LIKE '%" . $q . "%' )";
        }
        if ($tag) {
        	$this->db->where('tags LIKE "%'.$tag.'%"');
        }
				
		if ($category) {
			$this->db->where('category', $category);
		}
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('blog.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('blog_category', 'blog_category.category_id = blog.category', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
      	$this->db->where('status', 'publish');  
        return $this;
    }

    public function find_by_slug($slug = null)
    {
    	$this->join_avaiable()->filter_avaiable();
    	return $this->db->get_where($this->table_name, ['slug' => $slug])->row();
    }

    public function add_viewers($blog_id, $current_view)
    {
    	$viewers = $current_view+=1;
    	$this->db->update($this->table_name, ['viewers' => $viewers], ['id' => $blog_id]);
    	return $viewers;
    }

}

/* End of file Model_blog.php */
/* Location: ./application/models/Model_blog.php */