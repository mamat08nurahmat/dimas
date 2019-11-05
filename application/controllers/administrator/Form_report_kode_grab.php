<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Report Kode Grab Controller
*| --------------------------------------------------------------------------
*| Form Report Kode Grab site
*|
*/
class Form_report_kode_grab extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('model_form_kode_grab');
    }
 
public function index(){echo'salah link gan';}

public function all()
{
    $data['data'] = $this->db->get('vw_report_daily_dimas')->result_array();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_all_kode',$data);
}

public function alldetail($kode)
{
    $this->db->join('vw_report_sudah_terpakai k','k.kode_grab = vw_report_daily_dimas.kode_grab' ,'left');
    $data['data'] = $this->db->get_where('vw_report_daily_dimas',['vw_report_daily_dimas.kode_grab'=>$kode])->row_array();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/alldetail_kode_grab', $data);
}

public function allsort()
{
    $stardate = $this->input->post('_stardate',true);
    $enddate = $this->input->post('_enddate',true);
    $data['data'] = $this->db->get_where('vw_report_daily_dimas',['used_at >='=>$stardate,'used_at <='=>$enddate])->result_array();
    $data['count'] = $this->db->get_where('vw_report_daily_dimas',['used_at >='=>$stardate,'used_at <='=>$enddate])->num_rows();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_all_kode', $data);
}
public function exp_sort($start,$end)
{
    echo $start."    ".$end;
}    
// REPORT KODE TERPAKAI------------------------------------------------------------------------------------
public function terpakai()
{ 
    $data['data'] = $this->db->get('vw_report_sudah_terpakai')->result_array();
    
    // for($i=1;$i<=31;$i++){$dt[]=json_encode($this->db->get_where('vw_report_sudah_terpakai',['order_voucher_at'=>'2019-10-'.$i])->num_rows());}
    
    // $data['oktober']=json_encode($dt);

    // var_dump($data['oktober']);die();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_kode_grab_tpk',$data);
}
public function sortterpakai()
{
    $stardate = $this->input->post('_stardate',true);
    $enddate = $this->input->post('_enddate',true);

    $this->db->join('vw_report_daily_dimas k','k.kode_grab = vw_report_sudah_terpakai.kode_grab' ,'left');
    $data['data'] = $this->db->get_where('vw_report_sudah_terpakai',['vw_report_sudah_terpakai.order_voucher_at >='=>$stardate,'vw_report_sudah_terpakai.order_voucher_at <='=>$enddate])->result_array();
    $data['count'] = $this->db->get_where('vw_report_sudah_terpakai',['vw_report_sudah_terpakai.order_voucher_at >='=>$stardate,'vw_report_sudah_terpakai.order_voucher_at <='=>$enddate])->num_rows();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_kode_grab_tpk', $data);
}

public function detailtpk($kode)
{
    $this->db->join('vw_report_daily_dimas k','k.kode_grab = vw_report_sudah_terpakai.kode_grab' ,'left');
    $data['data'] = $this->db->get_where('vw_report_sudah_terpakai',['vw_report_sudah_terpakai.kode_grab'=>$kode])->row_array();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/alldetail_kode_grab', $data);
}
// End REPORT KODE TERPAKAI--------------------------------------------------------------------------------

// REPORT KODE Tidak TERPAKAI------------------------------------------------------------------------------
public function tdkterpakai()
{
    $data['terpakai']='0';

    // for($i=1;$i<=31;$i++){$dt[]=$this->db->get_where('vw_report_sudah_terpakai',['order_voucher_at'=>'2019-10-'.$i])->num_rows();}
    // $data['oktober']=json_encode($dt);

    $data['data'] = $this->db->get('vw_report_belum_terpakai')->result_array();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_kode_grab_tdktpk',$data);
}
public function sortbelumterpakai()
{
    $stardate = $this->input->post('_stardate',true);
    $enddate = $this->input->post('_enddate',true);

    $data['data'] = $this->db->get_where('vw_report_belum_terpakai',['used_at >='=>$stardate,'used_at <='=>$enddate])->result_array();
    $data['count'] = $this->db->get_where('vw_report_belum_terpakai',['used_at >='=>$stardate,'used_at <='=>$enddate])->num_rows();
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/report_kode_grab_tdktpk', $data);
}

// End REPORT Kode Tidak TERPAKAI--------------------------------------------------------------------------

// CHART--------------------------------------------------------------------------
public function chart()
{
    for($i=1;$i<=12;$i++){$dt[]=
        $this->db->get_where('form_order_grab',[
                                                'month(timestamp)'=>$i,
                                                'year(timestamp)'=>'2019',
                                                'is_approved'=>'1'
                                                ])->num_rows();
                                            }
    $data['terpakai'] = json_encode($dt);

    for($i=1;$i<=12;$i++){$dta[]=
        $this->db->get_where('form_order_grab',[
                                                'month(timestamp)'=>$i,
                                                'year(timestamp)'=>'2019',
                                                'is_approved'=>'0'
                                                ])->num_rows();
                                            }
    $data['tidakterpakai'] = json_encode($dta);

    $this->render('backend/standart/administrator/form_builder/form_kode_grab/view_chart_kode_grab',$data);
}

public function getchart(){
   $month = $this->input->post('month',true);
   $year  = $this->input->post('year',true);
    for($a=1;$a<=31;$a++){$dt[]=
        $this->db->get_where('form_order_grab',[
                                                'month(timestamp)'=>$month,
                                                'year(timestamp)'=>$year,
                                                'day(timestamp)'=>$a,
                                                'is_approved'=>'1'
                                                ])->num_rows();}
    $data['terpakai'] = json_encode($dt);
    for($i=1;$i<=31;$i++){$dta[]=
        $this->db->get_where('form_order_grab',[
                                                'month(timestamp)'=>$month,
                                                'year(timestamp)'=>$year,
                                                'day(timestamp)'=>$i,
                                                'is_approved'=>'0'
                                                ])->num_rows();}
    $data['tidakterpakai'] = json_encode($dta);
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/view_chart_short',$data);
}

public function chartshort()
{
    for($bln=7;$bln<=12;$bln++){
    for($i=1;$i<=31;$i++){$dta[]=
        $this->db->get_where('form_order_grab',[
                                                'month(timestamp)'=>$bln,
                                                'year(timestamp)'=>'2019',
                                                'day(timestamp)'=>$i,
                                                'is_approved'=>'1'
                                                ])->num_rows();
                                            }
                                        }
    $data['terpakai'] = json_encode($dta);

    for($bln=7;$bln<=12;$bln++){
        for($i=1;$i<=31;$i++){$dt[]=
            $this->db->get_where('form_order_grab',[
                                                    'month(timestamp)'=>$bln,
                                                    'year(timestamp)'=>'2019',
                                                    'day(timestamp)'=>$i,
                                                    'is_approved'=>'0'
                                                    ])->num_rows();
                                                }
                                            }
    $data['tidakterpakai'] = json_encode($dt);
    $this->render('backend/standart/administrator/form_builder/form_kode_grab/view_chart_kode_grab',$data);
}
public function generate()
{
  echo '<button>Generate now</button>';
}
// END CHART--------------------------------------------------------------------------

}












