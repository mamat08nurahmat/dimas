<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Kode Grab Controller
*| --------------------------------------------------------------------------
*| Form Kode Grab site
*|
*/
class Form_kode_grab extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model('model_form_kode_grab');
	}

	/**
	* show all Form Kode Grabs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_kode_grab_list');
 
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_kode_grabs'] = $this->model_form_kode_grab->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_kode_grab_counts'] = $this->model_form_kode_grab->count_all($filter, $field);
 
		$config = [
			'base_url'     => 'administrator/form_kode_grab/index/',
			'total_rows'   => $this->model_form_kode_grab->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];
		
		$month=date("m");
		$this->data['pagination'] = $this->pagination($config);
		$this->data['avaiable']   = $this->db->get_where('form_kode_grab',['is_used'=>0,'month(active)'=>$month])->num_rows();

		$this->template->title('Kode Grab List');
		$this->render('backend/standart/administrator/form_builder/form_kode_grab/form_kode_grab_list', $this->data);
	}

	/**
	* Update view Form Kode Grabs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_kode_grab_update');

		$this->data['form_kode_grab'] = $this->model_form_kode_grab->find($id);

		$this->template->title('Kode Grab Update');
		$this->render('backend/standart/administrator/form_builder/form_kode_grab/form_kode_grab_update', $this->data);
	}

	/**
	* Update Form Kode Grabs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_kode_grab_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kode_grab', 'Kode Grab', 'trim|required');
		$this->form_validation->set_rules('expired', 'Expired', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_grab' => $this->input->post('kode_grab'),
				'expired' => $this->input->post('expired'),
				'is_used' => $this->input->post('is_used'),
				'used_at' => $this->input->post('used_at'),
				'timestamp' => date('Y-m-d H:i:s'),
			];

			
			$save_form_kode_grab = $this->model_form_kode_grab->change($id, $save_data);

			if ($save_form_kode_grab) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_kode_grab', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_kode_grab');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_kode_grab');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Kode Grabs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_kode_grab_delete');

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
            set_message(cclang('has_been_deleted', 'Form Kode Grab'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Kode Grab'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Kode Grabs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_kode_grab_view');

		$this->data['form_kode_grab'] = $this->model_form_kode_grab->find($id);

		$this->template->title('Kode Grab Detail');
		$this->render('backend/standart/administrator/form_builder/form_kode_grab/form_kode_grab_view', $this->data);
	}

	/**
	* delete Form Kode Grabs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_kode_grab = $this->model_form_kode_grab->find($id);

		
		return $this->model_form_kode_grab->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_kode_grab_export');

		$this->model_form_kode_grab->export('form_kode_grab', 'form_kode_grab');
	}

	public function tes()
	{
		echo 'op';
	}
// IMPORT KODE --------------------------------------------------------------------------------------------------------
public function tambahkode()
{
	$this->render('backend/standart/administrator/form_builder/form_kode_grab/vtambahkode');
}
public function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=11; $row<=$highestRow; $row++)
				{
                    $kode_grab  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $expired    = $this->input->post('_expired',true);
                    $active     = $this->input->post('_active',true);
					$data[]     = array(
						'kode_grab'	=>	$kode_grab,
						'expired'	=>	$expired,
						'is_used'	=>	'0',
						'used_at'	=>	'2999-12-31',
                        'timestamp'	=>	'0000-00-00',
                        'active'    =>  $active
					);
				}
			}
			foreach($data as $kode){
				$kode_gr[]=$kode['kode_grab'];
			}
			$kode_cek=['kode'=>$kode_gr];
			foreach($kode_cek as $i){
				$mydata[]=$i;
			}
			foreach($mydata as $a){
				$yourdata[]=$a;
			}
			

			$this->db->where_in('kode_grab',$a);
			$query 		= $this->db->get('form_kode_grab');


			foreach($query->result_array() as $data_sama){
					$abc[] = $data_sama['kode_grab'] ;	
				}

				
				
			if($query->num_rows()>0){
				$same_date=json_encode($abc);
				$this->session->set_flashdata('message','<div class="alert alert-danger text-center">
				<h5>GAGAL ! beberapa kode berikut sama ');
				$this->session->set_flashdata('message2',$same_date);
				$this->session->set_flashdata('message3','</h5></div>');
				redirect(base_url('administrator/form_kode_grab'));
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-info text-center">
				<h5>Data Sukses Ditambahkan</h5>  
				</div>');
				$this->db->insert_batch('form_kode_grab', $data);
				redirect(base_url('administrator/form_kode_grab'));
			}
		}
    }
// IMPORT KODE --------------------------------------------------------------------------------------------------------
}


/* End of file form_kode_grab.php */
/* Location: ./application/controllers/administrator/Form Kode Grab.php */