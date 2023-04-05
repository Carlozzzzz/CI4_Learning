<?php
namespace App\Libraries;

// Include the TCPDF library using require_once
require_once APPPATH.'/libraries/tcpdf/tcpdf.php';

use TCPDF;

class Pdf extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}