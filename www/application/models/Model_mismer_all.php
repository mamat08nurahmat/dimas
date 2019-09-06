<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mismer_all extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'mismer_all';
	private $field_search 	= ['ORG', 'MID', 'MERCHANT_DBA_NAME', 'STATUS_EDC', 'OPENDATE', 'CITY', 'STATE', 'DATE_LAST_MAINTAIN', 'CONTACT_PERSON', 'TELP1', 'TELP2', 'MSO', 'MMO', 'DDA', 'MERCHANT_TYPE', 'CHAIN_STORE', 'SOURCE_CODE', 'MERCHANT_NAME', 'ALAMAT1', 'ALAMAT2', 'KOTA1', 'KOTA2', 'ZIPCODE', 'kolom24', 'MCC1', 'MCC2', 'kolom27', 'kolom28', 'kolom29', 'POS1', 'POS2', 'POS3', 'PLAN1', 'PLAN2', 'PLAN3', 'DATE_LAST_STATEMENT', 'kolom37', 'kolom38', 'kolom39', 'kolom40', 'kolom41', 'kolom42', 'kolom43', 'kolom44', 'kolom45', 'kolom46', 'kolom47', 'NPWP', 'ACCOUNT_NO', 'BANK_NAME', 'kolom51', 'kolom52', 'kolom53', 'kolom54', 'kolom55', 'kolom56', 'kolom57', 'kolom58', 'MDR_VISA_BNI', 'kolom60', 'kolom61', 'kolom62', 'kolom63', 'kolom64', 'kolom65', 'MDR_VISA_OTHER'];

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
	                $where .= "mismer_all.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "mismer_all.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "mismer_all.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "mismer_all.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "mismer_all.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "mismer_all.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('mismer_all.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_mismer_all.php */
/* Location: ./application/models/Model_mismer_all.php */