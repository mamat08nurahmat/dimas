<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tes extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('model_form_kode_grab');
		}
		public function time(){$this->load->view('tes');}
		public function getdata()
		{
			echo $this->db->get_where('vw_report_sudah_terpakai',['order_voucher_at'=>'2019-10-01'])->num_rows();
		}
		public function button()
		{
			$this->load->view('tes_button');
		}
		public function pindahdata()
		{
			//sudiro_temp -> sudiro
			// $this->db->query("INSERT INTO sudiro SELECT * FROM sudiro_temp");
			// $this->db->query("TRUNCATE TABLE sudiro_temp");
			//sudiro -> sudiro_temp

			$this->db->query("INSERT INTO sudiro_temp SELECT * FROM sudiro");
			$this->db->query("TRUNCATE TABLE sudiro");
			$data=[
				'id'=>'5755',
				'nama'=>'zeni rahma',
				'pekerjaan'=>'pengusaha',
				'kelahiran'=>'purworejo'
			]; $this->db->insert('sudiro',$data);
					var_dump($this->db->get('sudiro_temp')->result_array());//isi
					echo "<br><br><br>";
					var_dump($this->db->get('sudiro')->result_array());//kosong
		}
	}
		