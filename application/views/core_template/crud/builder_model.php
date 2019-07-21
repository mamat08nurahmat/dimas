{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_{table_name} extends MY_Model {

	<?php $field_in_column = $this->crud_builder->getFieldShowInColumn(); ?>
private $primary_key 	= '{primary_key}';
	private $table_name 	= '{table_name}';
	private $field_search 	= ['<?= implode("', '", $field_in_column); ?>'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "{table_name}.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "{table_name}.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "{table_name}.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "{table_name}.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "{table_name}.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "{table_name}.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('{table_name}.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        <?php
        $tables = [];
        $i= ''; 
        foreach ($this->crud_builder->getFieldRelation() as $field => $join): 
            $tables[] = $join['relation_table'];
            $count = array_count_values($tables);
            if (in_array($join['relation_table'], $tables)) {
                $i = $count[$join['relation_table']]-1;
                if ($i<=0) {
                    $i = '';
                }
            }

        ?>$this->db->join('<?= $join['relation_table'] ; ?><?= $i > 0 ? ' '.$join['relation_table'].$i : '' ; ?>', '<?= $join['relation_table'].$i ; ?>.<?= $join['relation_value']; ?> = {table_name}.<?= $field; ?>', 'LEFT');
        <?php endforeach; ?>

        return $this;
    }

    public function filter_avaiable() {
        <?php
        foreach ($this->crud_builder->getFieldByType('current_user_id') as $field): 
        ?>$this->db->where('<?= $field ?>', get_user_data('id'));
        <?php endforeach; ?>

        return $this;
    }

}

/* End of file Model_{table_name}.php */
/* Location: ./application/models/Model_{table_name}.php */