<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';


class PDF extends TCPDF
{
    private $base_url;

    function __construct($base_url = '') {
        parent::__construct();
        $this->base_url = $base_url;
    }

    public function Header() {
        $image_file = $this->base_url . 'assets/images/alturaslogo.png';
        $image_file = str_replace(array($this->base_url, '/'), array(FCPATH, DIRECTORY_SEPARATOR), $image_file);
        $x = 10;
        $y = 10;
        $w = 37; 
        $h = 10;
    
        if (file_exists($image_file)) {
            $this->Image($image_file, $x, $y, $w, $h, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            
            $this->SetFont('helvetica', 'B', 14);
            
            $page_width = $this->GetPageWidth();
            
            $text = 'IT SYSDEV MODULE | SUBMODULE';
            $text_width = $this->GetStringWidth($text);
        
            $text_x = ($page_width - $text_width) / 2;
            $text_y = $y;

            $this->SetXY($text_x, $text_y);
            $this->Cell($text_width, 10, $text, 0, 1, 'C');

            $line_y = $y + 15;
            $this->Line(10, $line_y, $page_width - 10, $line_y);
        }

    }
    
    public function Footer() {
        $this->SetY(-15);
        $page_width = $this->GetPageWidth();
        $this->Line(10, $this->GetY(), $page_width - 10, $this->GetY());
        $this->SetFont('helvetica', 'I', 8);
    
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
    
}
