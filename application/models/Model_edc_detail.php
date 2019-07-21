<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_edc_detail extends MY_Model {

	private $primary_key 	= 'MID';
	private $table_name 	= 'edc_detail';
	private $field_search 	= ['MERCHANT_DBA_NAME', 'STATUS_EDC', 'CITY', 'ID_NUMBER', 'MSO', 'SOURCE_CODE', 'POS_1', 'WILAYAH', 'CHANNEL', 'TYPE_MID', 'OPEN_DATE', 'TAHUN', 'BULAN', 'generate_at', 'update_at'];

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
	                $where .= "edc_detail.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "edc_detail.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "edc_detail.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "edc_detail.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "edc_detail.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "edc_detail.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('edc_detail.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

//===============
public function getResult1($bulan,$tahun,$type){




$edc='
(SELECT 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
GROUP BY 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN

)

UNION

(SELECT 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
GROUP BY 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN
)


';


$yap='


(SELECT 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM yap_detail 
GROUP BY 
 TYPE_MID,
WILAYAH,
TAHUN,BULAN
)

';


$ebk='
	

	(SELECT 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM ebk_detail 
	GROUP BY 
	 TYPE_MID,
	WILAYAH,

	TAHUN,BULAN
	)

';



if($type=='ALL'){
	
	$mis="	
	$edc
	UNION
	$yap
	UNION
	$ebk
	";

}elseif($type=='SLN'){

	$mis="	
	$edc
	UNION
	$yap
	";


}elseif($type=='EDC'){
	$mis="	
	$edc
	";

	
}elseif($type=='YAP'){
	$mis="	
	$yap
	";

	
}elseif($type=='EBK'){

	$mis="	
	$ebk
	";
	
}	




	return $this->db->query("
	SELECT 
WILAYAH,
TYPE_MID,
TAHUN,
BULAN,
SUM(JUMLAH) as JUM_TOT
	from
	(

$mis


ORDER BY -- TYPE_MID,
WILAYAH,TAHUN,BULAN,JUMLAH DESC
) x
WHERE TAHUN='$tahun' AND BULAN='$bulan'
GROUP BY TYPE_MID,WILAYAH,TAHUN,BULAN
ORDER BY TYPE_MID,WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
	")->result();




}

//dev 09072019

public function getModalResult1($tahun,$bulan,$wilayah,$TYPE_MID,$type){





	$edc='
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
	 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	
	)
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
	 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	)
	
	
	';
	
	
	$yap='
	
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM yap_detail 
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	)
	
	';
	
	
	$ebk='
		
	
		(SELECT 
		 TYPE_MID,
		WILAYAH,
		CHANNEL,
		TAHUN,BULAN
		,SUM(POS_1) as JUMLAH
		
		FROM ebk_detail 
		GROUP BY 
		 TYPE_MID,
		WILAYAH,
		CHANNEL,	
		TAHUN,BULAN
		)
	
	';
	
	
	
	if($type=='ALL'){
		
		$mis="	
		$edc
		UNION
		$yap
		UNION
		$ebk
		";
	
	}elseif($type=='SLN'){
	
		$mis="	
		$edc
		UNION
		$yap
		";
	
	
	}elseif($type=='EDC'){
		$mis="	
		$edc
		";
	
		
	}elseif($type=='YAP'){
		$mis="	
		$yap
		";
	
		
	}elseif($type=='EBK'){
	
		$mis="	
		$ebk
		";
		
	}	
	
	
	
	
		return $this->db->query("
		SELECT 
	WILAYAH,
	CHANNEL,
	TYPE_MID,
	TAHUN,
	BULAN,
	SUM(JUMLAH) as JUM_TOT
		from
		(
	
	$mis
	
	
	ORDER BY -- TYPE_MID,
	WILAYAH,CHANNEL,TAHUN,BULAN,JUMLAH DESC
	) x
	WHERE TAHUN='$tahun' AND BULAN='$bulan'
	AND TYPE_MID='$TYPE_MID' AND WILAYAH='$wilayah'
	GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
	ORDER BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN,JUM_TOT DESC	
		")->result();
	
	
	


}
	

//versi lama 09072019
// public function getModalResult1($tahun,$bulan,$wilayah,$TYPE_MID){

// 	return $this->db->query("

// 	SELECT 
// 	WILAYAH,
// 	CHANNEL,
// 	TYPE_MID,
// 	TAHUN,
// 	BULAN,
// 	SUM(JUMLAH) as JUM_TOT
// 		from
// 		(
	
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
// 	-- AND BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
	
// 	)
	
// 	UNION
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL
// 	-- AND BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	)
	
	
// 	UNION
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM yap_detail 
// 	-- where BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	)
	
// 	UNION
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM ebk_detail 
// 	-- where BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	 CHANNEL,
// 	TAHUN,BULAN
// 	)
	
	
// 	ORDER BY -- TYPE_MID,
// 	WILAYAH,TAHUN,BULAN,JUMLAH DESC
// 	) x
// 	WHERE TAHUN='$tahun' AND BULAN='$bulan'
// 	AND TYPE_MID='$TYPE_MID'
// 	AND WILAYAH = '$wilayah'
// 	GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
// 	ORDER BY WILAYAH,TAHUN,BULAN,JUM_TOT DESC
// 	;	
// 	")->result();

// }


//versi lama
//get export 1
// public function getExport1($bulan,$tahun){


// 	return $this->db->query("

// 	SELECT 
// TYPE_MID,
// WILAYAH,
// CHANNEL,
// TAHUN,
// BULAN,
// SUM(JUMLAH) as JUM_TOT
// 	from
// 	(


// (SELECT 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// ,SUM(POS_1) as JUMLAH

// FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
// -- AND BULAN=12 AND TAHUN=2018
// GROUP BY 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN

// )

// UNION

// (SELECT 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// ,SUM(POS_1) as JUMLAH

// FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL
// -- AND BULAN=12 AND TAHUN=2018
// GROUP BY 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// )


// UNION

// (SELECT 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// ,SUM(POS_1) as JUMLAH

// FROM yap_detail 
// -- where BULAN=12 AND TAHUN=2018
// GROUP BY 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// )

// UNION

// (SELECT 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// ,SUM(POS_1) as JUMLAH

// FROM ebk_detail 
// -- where BULAN=12 AND TAHUN=2018
// GROUP BY 
//  TYPE_MID,
// WILAYAH,
//  CHANNEL,
// TAHUN,BULAN
// )


// ORDER BY -- TYPE_MID,
// WILAYAH,TAHUN,BULAN,JUMLAH DESC
// ) x
// WHERE TAHUN='$tahun' AND BULAN='$bulan'
// GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
// ORDER BY WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
	
// 	")->result();


// }


// dev 09072019
public function getExport1($bulan,$tahun,$type){




	$edc='
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
	 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	
	)
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
	 AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" -- AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	)
	
	
	';
	
	
	$yap='
	
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,BULAN
	,SUM(POS_1) as JUMLAH
	
	FROM yap_detail 
	GROUP BY 
	 TYPE_MID,
	WILAYAH,CHANNEL,
	TAHUN,BULAN
	)
	
	';
	
	
	$ebk='
		
	
		(SELECT 
		 TYPE_MID,
		WILAYAH,
		CHANNEL,
		TAHUN,BULAN
		,SUM(POS_1) as JUMLAH
		
		FROM ebk_detail 
		GROUP BY 
		 TYPE_MID,
		WILAYAH,
		CHANNEL,
		TAHUN,BULAN
		)
	
	';
	
	
	
	if($type=='ALL'){
		
		$mis="	
		$edc
		UNION
		$yap
		UNION
		$ebk
		";
	
	}elseif($type=='SLN'){
	
		$mis="	
		$edc
		UNION
		$yap
		";
	
	
	}elseif($type=='EDC'){
		$mis="	
		$edc
		";
	
		
	}elseif($type=='YAP'){
		$mis="	
		$yap
		";
	
		
	}elseif($type=='EBK'){
	
		$mis="	
		$ebk
		";
		
	}	
	
	
	
	
		return $this->db->query("
		SELECT 
	WILAYAH,
	CHANNEL,
	TYPE_MID,
	TAHUN,
	BULAN,
	SUM(JUMLAH) as JUM_TOT
		from
		(
	
	$mis
	
	
	ORDER BY -- TYPE_MID,
	WILAYAH,CHANNEL,TAHUN,BULAN,JUMLAH DESC
	) x
	WHERE TAHUN='$tahun' AND BULAN='$bulan'
	GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
	ORDER BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN,JUM_TOT DESC	
		")->result();
	
	
	
	
	}


public function getResult2($tgl_awal,$tgl_akhir,$type){




	$edc='
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
	-- AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	
	)
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
	-- AND WILAYAH!="GABUNGAN" AND WILAYAH!="EBK" AND CHANNEL!="EBK"
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	)
	
	
	';
	
	
	$yap='
	
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM yap_detail 
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	TAHUN,BULAN
	)
	
	';
	
	
	$ebk='
		
	
		(SELECT 
		 TYPE_MID,
		WILAYAH,
		TAHUN,BULAN
		,OPEN_DATE
		,SUM(POS_1) as JUMLAH
		
		FROM ebk_detail 
		GROUP BY 
		 TYPE_MID,
		WILAYAH,
	
		TAHUN,BULAN
		)
	
	';
	
	
	
	if($type=='ALL'){
		
		$mis="	
		$edc
		UNION
		$yap
		UNION
		$ebk
		";
	
	}elseif($type=='SLN'){
	
		$mis="	
		$edc
		UNION
		$yap
		";
	
	
	}elseif($type=='EDC'){
		$mis="	
		$edc
		";
	
		
	}elseif($type=='YAP'){
		$mis="	
		$yap
		";
	
		
	}elseif($type=='EBK'){
	
		$mis="	
		$ebk
		";
		
	}	
	
	
	
	
		return $this->db->query("
		SELECT 
	WILAYAH,
	TYPE_MID,
	TAHUN,
	BULAN,
	SUM(JUMLAH) as JUM_TOT
		from
		(
	
	$mis
	
	
	ORDER BY -- TYPE_MID,
	WILAYAH,TAHUN,BULAN,JUMLAH DESC
	) x
	 	WHERE 
	 	OPEN_DATE >= '$tgl_awal' AND OPEN_DATE <= '$tgl_akhir'
	 	GROUP BY WILAYAH,TYPE_MID
	 	,TAHUN,BULAN
	 	ORDER BY TYPE_MID,WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
		")->result();
	
	
	
	
	}


// public function getResult2($tgl_awal,$tgl_akhir,$type){


// 	if($type=='ALL'){
// 		$ebk='
// 		UNION
			
// 		(SELECT 
// 		 TYPE_MID,
// 		WILAYAH,
// 		-- CHANNEL,
// 		TAHUN,BULAN
// 		,OPEN_DATE
// 		,SUM(POS_1) as JUMLAH
		
// 		FROM ebk_detail 
// 		-- where BULAN=12 AND TAHUN=2018
// 		GROUP BY 
// 		 TYPE_MID,
// 		WILAYAH,
// 		-- CHANNEL,
// 		-- OPEN_DATE,
// 		TAHUN,BULAN
// 		)
		
// 		';	
		
// 	}else{
// $ebk='';		
// 	}


// 	return $this->db->query("
// 	SELECT 
// 	TYPE_MID,
// 	WILAYAH,
// 	TAHUN,
// 	BULAN,
// 	-- OPEN_DATE,
// 	SUM(JUMLAH) as JUM_TOT
// 		from
// 		(
	
	
// 	(SELECT 
// 	TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	TAHUN,BULAN
// 	 ,OPEN_DATE
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
// 	AND WILAYAH!='EBK' AND CHANNEL!='EBK'
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	-- OPEN_DATE,
// 	TAHUN,BULAN
	
// 	)
	
// 	UNION
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	TAHUN,BULAN
// 	 ,OPEN_DATE
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
// 	AND WILAYAH!='EBK' AND CHANNEL!='EBK'
// 	-- AND BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	 TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	-- OPEN_DATE,
// 	TAHUN,BULAN
// 	)
	
	
// 	UNION
	
// 	(SELECT 
// 	 TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	TAHUN,BULAN
// 	,OPEN_DATE
// 	,SUM(POS_1) as JUMLAH
	
// 	FROM yap_detail 
// 	-- where BULAN=12 AND TAHUN=2018
// 	GROUP BY 
// 	TYPE_MID,
// 	WILAYAH,
// 	-- CHANNEL,
// 	-- OPEN_DATE,
// 	TAHUN,BULAN
// 	)
	
// $ebk
	
// 	ORDER BY  
// 	WILAYAH,TYPE_MID,TAHUN,BULAN,JUMLAH DESC
// 	) x
// 	WHERE -- TAHUN=2018 AND BULAN=12
// 	OPEN_DATE >= '$tgl_awal' AND OPEN_DATE <= '$tgl_akhir'
// 	-- AND WILAYAH='WMO'
// 	GROUP BY WILAYAH,TYPE_MID
// 	,TAHUN,BULAN
// 	ORDER BY TYPE_MID,WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
// 	")->result();
// }


public function getModalResult2($tgl_awal,$tgl_akhir,$wilayah,$TYPE_MID){
	return $this->db->query("
	SELECT 
	TYPE_MID,
	WILAYAH,
	CHANNEL,
	TAHUN,
	BULAN,
	-- OPEN_DATE,
	SUM(JUMLAH) as JUM_TOT
		from
		(
	
	
	(SELECT 
	TYPE_MID,
	WILAYAH,
	 CHANNEL,
	TAHUN,BULAN
	 ,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
	-- AND BULAN=12 AND TAHUN=2018
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	-- OPEN_DATE,
	TAHUN,BULAN
	
	)
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	TAHUN,BULAN
	 ,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL
	-- AND BULAN=12 AND TAHUN=2018
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	-- OPEN_DATE,
	TAHUN,BULAN
	)
	
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	TAHUN,BULAN
	,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM yap_detail 
	-- where BULAN=12 AND TAHUN=2018
	GROUP BY 
	TYPE_MID,
	WILAYAH,
	 CHANNEL,
	-- OPEN_DATE,
	TAHUN,BULAN
	)
	
	UNION
	
	(SELECT 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	TAHUN,BULAN
	,OPEN_DATE
	,SUM(POS_1) as JUMLAH
	
	FROM ebk_detail 
	-- where BULAN=12 AND TAHUN=2018
	GROUP BY 
	 TYPE_MID,
	WILAYAH,
	 CHANNEL,
	-- OPEN_DATE,
	TAHUN,BULAN
	)
	
	
	ORDER BY  
	WILAYAH,TYPE_MID,TAHUN,BULAN,JUMLAH DESC
	) x
	WHERE -- TAHUN=2018 AND BULAN=12
	OPEN_DATE >= '$tgl_awal' AND OPEN_DATE <= '$tgl_akhir'
	 AND WILAYAH='$wilayah'
	 AND TYPE_MID='$TYPE_MID'
	GROUP BY WILAYAH,CHANNEL,TYPE_MID
	,TAHUN,BULAN
	ORDER BY WILAYAH,TAHUN,BULAN,JUM_TOT DESC
	
	")->result();
}
//get export 1
public function getExport2($tgl_awal,$tgl_akhir){
	return $this->db->query("
	SELECT 
TYPE_MID,
WILAYAH,
CHANNEL,
TAHUN,
BULAN,
SUM(JUMLAH) as JUM_TOT
	from
	(
(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
,SUM(POS_1) as JUMLAH
FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
-- AND BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
)
UNION
(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
,SUM(POS_1) as JUMLAH
FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL
-- AND BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
)
UNION
(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
,SUM(POS_1) as JUMLAH
FROM yap_detail 
-- where BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
)
UNION
(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
,SUM(POS_1) as JUMLAH
FROM ebk_detail 
-- where BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
 OPEN_DATE,
 TAHUN,BULAN
)
ORDER BY -- TYPE_MID,
WILAYAH,TAHUN,BULAN,JUMLAH DESC
) x
WHERE 
OPEN_DATE >= '$tgl_awal' AND OPEN_DATE <= '$tgl_akhir'
GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
ORDER BY WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
	
	")->result();
}

//---------------------

public function getExportEDCUnmatch($tahun,$bulan){
	return $this->db->query("

	SELECT 
	MID, 
	MERCHANT_DBA_NAME,
	MSO,
	SOURCE_CODE,
	WILAYAH,
	CHANNEL,
	TAHUN,
	BULAN
	FROM edc_unmatch
	WHERE IS_MATCH=0
	AND TAHUN='$tahun'
	AND BULAN='$bulan'
	")->result();


}

// dev 08072019
public function getExportEDC_Detail($tahun,$bulan,$type){
	return $this->db->query("

	SELECT 
	MID, 
	MERCHANT_DBA_NAME,
	MSO,
	SOURCE_CODE,
	WILAYAH,
	CHANNEL,
	TAHUN,
	BULAN
	FROM edc_detail
	WHERE  TAHUN='$tahun'
	AND BULAN='$bulan'
	")->result();


}


//dev 09072019
//===============
//Contrller -> edc_detail/get_generate1_edc_export
// public function getresult1_edc_export(){
	public function getresult1_edc_export($bulan,$tahun,$type){




	$match='
	(SELECT 
	*,1 IS_MATCH   
   FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL    
   )
   
   UNION
   
   (SELECT 
	*
   FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL AND IS_MATCH=1
   ) 
	   
	';
	
	// 	return $this->db->query("
	
	// $match
	
	// 	")->result();


	$unmatch='

	SELECT * FROM edc_unmatch where IS_MATCH=0
	
	';
	

	
	
	
	if($type=='ALL'){
		
		$edc="	
		$match
		UNION
		$unmatch
		";
	
	}elseif($type=='MATCH'){
	
		$edc="	
		$match
		";
	
	
	}elseif($type=='UNMATCH'){
		$edc="	
		$unmatch
		";
	
	}	
	
	
	
	
		return $this->db->query("
		SELECT 
		x.*
		from
		(
	
	$edc
	
	
	ORDER BY 
	TAHUN,BULAN DESC
	) x
	WHERE x.TAHUN='$tahun' AND x.BULAN='$bulan'
	ORDER BY x.TAHUN,x.BULAN DESC	
		")->result();
	
	
	
	
	}
	
// dev 09072019
//get export 1
public function getExport1_edc_export($bulan,$tahun){


	return $this->db->query("

	SELECT 
TYPE_MID,
WILAYAH,
CHANNEL,
TAHUN,
BULAN,
SUM(JUMLAH) as JUM_TOT
	from
	(


(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM edc_detail where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL 
-- AND BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN

)

UNION

(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM edc_unmatch where WILAYAH IS NOT NULL AND CHANNEL IS NOT NULL
-- AND BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
)


UNION

(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM yap_detail 
-- where BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
)

UNION

(SELECT 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
,SUM(POS_1) as JUMLAH

FROM ebk_detail 
-- where BULAN=12 AND TAHUN=2018
GROUP BY 
 TYPE_MID,
WILAYAH,
 CHANNEL,
TAHUN,BULAN
)


ORDER BY -- TYPE_MID,
WILAYAH,TAHUN,BULAN,JUMLAH DESC
) x
WHERE TAHUN='$tahun' AND BULAN='$bulan'
GROUP BY TYPE_MID,WILAYAH,CHANNEL,TAHUN,BULAN
ORDER BY WILAYAH,TAHUN,BULAN,JUM_TOT DESC	
	
	")->result();


}



}

/* End of file Model_edc_detail.php */
/* Location: ./application/models/Model_edc_detail.php */