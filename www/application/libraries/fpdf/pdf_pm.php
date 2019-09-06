

<?php
class Pdf_Pm extends FPDF
{
	// Current column
	var $col = 0;
	// Ordinate of column start
	var $y0;
	var $B;
	var $I;
	var $U;
	var $HREF;
	var $data = array();

	function Header()
	{
	    // Page header
	   
		$title = 'CHECKLIST PREVENTIVE MAINTENANCE ';

	    $this->SetFont('Arial','B',11);


	    $this->SetX(0);
	    $this->SetY(10);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(44,20,"LOGO",1,0,'C',FALSE);
	    /*$this->Image('logo.png',10,6,30);*/

	    $this->SetDrawColor(100,100,100);
	    $this->SetFillColor(150,150,150);
	    $this->SetTextColor(225,225,225);

	    $this->Cell(100,20,$title,1,0,'C',true);

	    $this->SetTextColor(0,0,0);
	    $this->Cell(44,20,"Base Service",1,0,'C',FALSE);
	    $this->ln(25);
	}

	function dataContent()
	{

	    $this->addPage();

	    $this->SetFont('Arial','',9);

	    $this->SetDrawColor(0,0,0);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(60,9,"Protelindo Site ID",0,0,'LR',FALSE);
	    $this->Cell(2,9,":",0,0,'LR',FALSE);
	    $this->Cell(70,9,$this->data['row']->site_name,0,1,'LR',FALSE);

	    $this->Cell(60,9,"Protelindo Site Name",0,0,'LR',FALSE);
	    $this->Cell(2,9,":",0,0,'LR',FALSE);
	    $this->Cell(70,9,$this->data['row']->site_name,0,1,'LFT',FALSE);

	    $this->Cell(60,9,"Date",0,0,'LR',FALSE);
	    $this->Cell(2,9,":",0,0,'LR',FALSE);
	    $this->Cell(70,9,date("d F Y", strtotime($this->data['row']->plan_date)),0,1,'LR',FALSE);

	    $this->Cell(60,9,"Time",0,0,'LR',FALSE);
	    $this->Cell(2,9,":",0,0,'LR',FALSE);
	    $this->Cell(70,9,date("H:i", strtotime($this->data['row']->plan_date)) . "   WIB",0,1,'LR',FALSE);

	    $this->ln();
	    $this->Cell(190,7,"GROUNDING",0,0,'C',TRUE);

	    $this->ln(10);
	    $this->Cell(60,7,"Grounding Measurement",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(60,7,"Ohm       			(<Ohm)",0,0,'R',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->SetX(20);
	    $this->Cell(50,7,"Grounding Well",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(60,7,"Ohm       			(<Ohm)",0,0,'R',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->SetX(20);
	    $this->Cell(50,7,"Grounding Well",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(60,7,"Ohm       			(<Ohm)",0,0,'R',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->SetX(20);
	    $this->Cell(50,7,"Fence",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(60,7,"Ohm       			(<Ohm)",0,0,'R',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->SetX(20);
	    $this->Cell(50,7,"Genset Tank",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(60,7,"Ohm       			(<Ohm)",0,0,'R',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");


	    $this->ln(1);
	    $this->Cell(60,7,"Grounding Status",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Lightening Rod",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Bar Grounding Tower",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Bar Grounding Well",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Own Conductor Cable",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Bolt Connection",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");


	    $this->SetFillColor(150,150,150);
	    $this->ln();
	    $this->Cell(190,7,"TOWER",0,0,'C',TRUE);

	    $this->ln(10);
	    $this->Cell(60,7,"Tower Type",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] SST                  [] Monopole                [] Trialngle         [] Pole          [] Mini Tower ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Painting Condition",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Construction Condition",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Tower Cleaning",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Tower Lamp / OBL",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Photo Sensor",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(190,7,"LIGHTING",0,0,'C',TRUE);

	    $this->ln(10);
	    $this->Cell(60,7,"Tower Lamp (OBL) Amount",0,0,'L',FALSE);
	    $this->Cell(2,7,": ............. Unit ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Yard Lamp Amount (Mercury & TL)",0,0,'L',FALSE);
	    $this->Cell(2,7,": ............. Unit ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Tower Lamp (OBL) Condition",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Yard Lamp Condition",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Site Photo Sensor",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Yard Lamp Shild",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");


	    $this->ln(1);
	    $this->Cell(190,7,"FENCE",0,0,'C',TRUE);

	    $this->ln(10);
	    $this->Cell(60,7,"Fence Condition",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                [] N/A                   Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Site Cleaning",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                                           Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Flume Cleaning",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                                           Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Paving Block Or Gravel",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                                           Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"barbared Wire",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                                           Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	    $this->ln(1);
	    $this->Cell(60,7,"Feence Door (Swing/Sliding)",0,0,'L',FALSE);
	    $this->Cell(2,7,":",0,0,'LR',FALSE);
	    $this->Cell(100,7,"[] OK                    [] NOK                                           Remark : ........................  ",0,0,'LR',FALSE);
	    $this->ln();
	    $this->Cell(188,1,"","T");

	}

	function setData($data)
	{
		$this->data = $data;
	}



	function Footer()
	{
	    // Page footer
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->SetTextColor(128);
	    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}

	function SetCol($col)
	{
	    // Set position at a given column
	    $this->col = $col;
	    $x = 10+$col*65;
	    $this->SetLeftMargin($x);
	    $this->SetX($x);
	}
	
}
