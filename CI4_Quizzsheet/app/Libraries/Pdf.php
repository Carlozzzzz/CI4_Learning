<?php namespace App\Libraries;

use TCPDF;

// Extend the TCPDF class to create custom Header and Footer
class Pdf extends TCPDF {
    
    const MY_PDF_HEADER_LOGO = 'logo_example.png';

    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES . self::MY_PDF_HEADER_LOGO;
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
}  
