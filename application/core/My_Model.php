<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model {

    private $primary_key = 'id';
    private $table_name = 'table';
    private $field_search;

    public function __construct($config = array())
    {
        parent::__construct();

        foreach ($config as $key => $val)
        {
            if(isset($this->$key))
                $this->$key = $val;
        }

        $this->load->database();
    }

    public function remove($id = NULL)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table_name);
    }

    public function change($id = NULL, $data = array())
    {        
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    public function find($id = NULL, $select_field = [])
    {
        if (is_array($select_field) AND count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where("".$this->table_name.'.'.$this->primary_key,$id);
        $query = $this->db->get($this->table_name);

        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function find_all()
    {
        $this->db->order_by($this->primary_key, 'DESC');
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function store($data = array())
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function get_all_data($table = '')
    {
        $query = $this->db->get($table);

        return $query->result();
    }


    public function get_single($where)
    {
        $query = $this->db->get_where($this->table_name, $where);

        return $query->row();
    }

    public function scurity($input)
    {
        return mysqli_real_escape_string($this->db->conn_id, $input);
    }

    public function export($table, $subject = 'file')
    {
        $this->load->library('excel');

        $result = $this->db->get($table);

        $this->excel->setActiveSheetIndex(0);

        $fields = $result->list_fields();

        $alphabet = 'ABCDEFGHIJKLMOPQRSTUVWXYZ';
        $alphabet_arr = str_split($alphabet);
        $column = [];

        foreach ($alphabet_arr as $alpha) {
            $column[] =  $alpha;
        }

        foreach ($alphabet_arr as $alpha) {
            foreach ($alphabet_arr as $alpha2) {
                $column[] =  $alpha.$alpha2;
            }
        }
        foreach ($alphabet_arr as $alpha) {
            foreach ($alphabet_arr as $alpha2) {
                foreach ($alphabet_arr as $alpha3) {
                    $column[] =  $alpha.$alpha2.$alpha3;
                }
            }
        }

        foreach($column as $col)
        {
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(20);
        }

        $col_total = $column[count($fields)-1];

        //styling
        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'DA3232')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                )
            )
        );

        $phpColor = new PHPExcel_Style_Color();
        $phpColor->setRGB('FFFFFF');  

        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->getFont()->setColor($phpColor);

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);

        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')
        ->getAlignment()->setWrapText(true); 

        $col = 0;
        foreach ($fields as $field)
        {
            
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords(str_replace('_', ' ', $field)));
            $col++;
        }
 
        $row = 2;
        foreach($result->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }

        //set border
        $styleArray = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          );
        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.''.$row)->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->setTitle(ucwords($subject));

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.ucwords($subject).'-'.date('Y-m-d').'.xls');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function pdf($table, $title)
    {
        $this->load->library('HtmlPdf');
      
        $config = array(
            'orientation' => 'p',
            'format' => 'a4',
            'marges' => array(5, 5, 5, 5)
        );

        $this->pdf = new HtmlPdf($config);

        $result = $this->db->get($table);
        $fields = $result->list_fields();

        $content = $this->pdf->loadHtmlPdf('core_template/pdf/pdf', [
            'results' => $result->result(),
            'fields' => $fields,
            'title' => $title
        ], TRUE);

        $this->pdf->initialize($config);
        $this->pdf->pdf->SetDisplayMode('fullpage');
        $this->pdf->writeHTML($content);
        $this->pdf->Output($table.'.pdf', 'H');
    }
}

/* End of file My_Model.php */
/* Location: ./application/core/My_Model.php */