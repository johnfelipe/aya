<?php
require('fpdf.php');

class PDF extends FPDF
 {

var $tablewidths;
var $footerset;

//Cabecera de página
	function Header()
	{
		/*//Logo
		$this->Image('../img/logo1.gif',19,8,25);
		$this->Image('../img/logo2.gif',170,8,30);
		//Arial bold 15
		$this->SetFont('Arial','B',12);
		//Movernos a la derecha
		$this->Ln(5);*/
		
		//Logo
		/*$this->Image('../img/logo1.gif',19,8,25);
		$this->Image('../img/logo2.gif',170,10,30);
		$this->Image('../img/bandera.jpg',19,42,180,3);
		//Arial bold 15
		//Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
	$this->Ln(20);
    $this->Cell(40);
    //Título
  		$this->Cell(80,5,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTÁN'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(40);
		$this->Cell(80,5,utf8_decode('UNIDOS POR EL DESARROLLO'),0,0,'C');
		$this->Ln();
		$this->Cell(40);
		$this->SetFont('Arial','B',6);
		$this->Cell(80,3,utf8_decode('CALLE GRIMALDI N. 3 USULUTÁN, EL SALVADOR, C.A'),0,0,'C');
		$this->Ln();
		$this->Cell(40);
		$this->SetFont('Arial','B',6);
		$this->Cell(80,3,'TEL: 2662-0142, 2662-0103, FAX: 2662-3112',0,0,'C');
    //Salto de línea
    $this->Ln(2);
		
		//Título
		/*
		$this->Cell(200,5,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTAN'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(80);
		$this->Cell(33,5,utf8_decode('UNIDOS POR EL DESARROLLO'),0,0,'C');
		$this->Ln();;
		$this->Cell(80);
		$this->SetFont('Arial','B',6);
		$this->Cell(36,3,utf8_decode('CALLE GRIMALDI N. 3 USULTÁN, EL SALVADOR, C.A'),0,0,'C');
		$this->Ln();;
		$this->Cell(80);
		$this->SetFont('Arial','B',6);
		$this->Cell(36,3,'TEL: 2662-0142, 2662-0103, FAX: 2662-3112',0,0,'C');
*/
	
		//Salto de línea
		$this->Ln(30);
	}
	
	


function _beginpage($orientation, $format) {
    @$this->page++;
    if(@(!$this->pages[@$this->page])) // solves the problem of overwriting a page if it already exists
        @$this->pages[@$this->page]='';
    $this->state=2;
    $this->x=$this->lMargin;
    $this->y=$this->tMargin;
    $this->FontFamily='';
    //Check page size
    if($orientation=='')
        $orientation=$this->DefOrientation;
    else
        $orientation=strtoupper($orientation[0]);
    if($format=='')
        $format=$this->DefPageFormat;
    else
    {
        if(is_string($format))
            $format=$this->_getpageformat($format);
    }
    if($orientation!=$this->CurOrientation || $format[0]!=$this->CurPageFormat[0] || $format[1]!=$this->CurPageFormat[1])
    {
        //New size
        if($orientation=='P')
        {
            $this->w=$format[0];
            $this->h=$format[1];
        }
        else
        {
            $this->w=$format[1];
            $this->h=$format[0];
        }
        $this->wPt=$this->w*$this->k;
        $this->hPt=$this->h*$this->k;
        $this->PageBreakTrigger=$this->h-$this->bMargin;
        $this->CurOrientation=$orientation;
        $this->CurPageFormat=$format;
    }
    if($orientation!=$this->DefOrientation || $format[0]!=$this->DefPageFormat[0] || $format[1]!=$this->DefPageFormat[1])
        $this->PageSizes[$this->page]=array($this->wPt, $this->hPt);
}

//Pie de página
		/*function Footer(){
		{
			//Posición: a 1,5 cm del final
			$this->SetY(-20);
			//Arial italic 8
			$this->SetFont('Arial','I',8);
			//Número de página
			//$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
}*/

function morepagestable($datas, $lineheight=7) 
{
		// some things to set and 'remember'
		//titulo de la tabla
		$l = $this->lMargin=30;
		$startheight = $h = $this->GetY();
		$startpage = $currpage = $this->page;

		// calculate the whole width
		foreach($this->tablewidths AS $width) {
			@$fullwidth += $width;
		}

		// Now let's start to write the table
			foreach($datas AS $row => $data) 
			{
				$this->page = $currpage;
				// write the horizontal borders
				
				$this->Line($l,$h,$fullwidth+$l,$h);	
			
			
				
			
			
				
				
			
			
			// write the content and remember the height of the highest col
			$aa=1;
			//  foreach($data AS $col => $txt) 
			foreach($data AS $col => $ppe) 
			{
				
					$this->page = $currpage;
					$this->SetXY($l,$h);
					
					$arrp= array();
					
					
					$this->MultiCell(@$this->tablewidths[$col],@$lineheight,@$ppe,0,'C');
					
						@$l += $this->tablewidths[$col];
				
						
						
						//
						  if(@$tmpheight[$row.'-'.$this->page] < $this->GetY()) 
							{
								$tmpheight[$row.'-'.$this->page] = $this->GetY();
							}
							
							if($this->page > @$maxpage)
								$maxpage = $this->page;
				
					
			
			}

			// get the height we were in the last used page
			@$h = @$tmpheight[@$row.'-'.@$maxpage];
			// set the "pointer" to the left margin
			$l = $this->lMargin=30;
			// set the $currpage to the last page
			$currpage = $maxpage;
		}
		// draw the borders
		// we start adding a horizontal line on the last page
		$this->page = $maxpage;
		
		
			$this->Line($l,$h,$fullwidth+$l,$h);
		
		
		
		// now we start at the top of the document and walk down
	for($i = $startpage; $i <= $maxpage; $i++) 
		{

			$this->page = $i;
			$l = $this->lMargin;
			$t  = ($i == $startpage) ? $startheight : $this->tMargin;
			$lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
			
			//$this->Line($l,$t,$l,$lh);
			
			foreach($this->tablewidths AS $width) 
			{
				$l += $width;
				
					
			   //$this->Line($l,$t,$l,$lh);
				
				
			}
		}
		// set it to the last page, if not it'll cause some problems
		$this->page = $maxpage;
	}
}
?>