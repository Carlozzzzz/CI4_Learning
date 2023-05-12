<?php

namespace App\Controllers;

use TCPDF;
use App\Controllers\BaseController;
use App\Models\DefaultCI_Model;
use App\Models\UserFile_Model;
use Config\Services;
use App\Libraries\Pdf;
use App\Libraries\PdfLibrary;
use App\Libraries\MYPDF;
use App\Libraries\Pdf2;

class DefaultCI extends BaseController
{
    private $db;
    protected $UserFile_Model;
    protected $ModelClass;
    protected $session;
    
    public function __construct(){
        $this->db = \Config\Database::connect(); // get database connection
        $this->session = \Config\Services::session();
        $this->ModelClass = new DefaultCI_Model();
        $this->UserFile_Model = new UserFile_Model(); 
        $this->TeachersubjectlistFile_Model = model('TeachersubjectlistFile_Model');
        $this->SubjectFile_Model = model('SubjectFile_Model');
    }

    public function index($isactive = 1){
        
            $page = "index";
            if (! is_file(APPPATH . 'Views/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                return view ('template/errorfile');
            }
            if(session()->has('ci4_username'))
            {
                $data['data_activepage']= 'dashboard';
                return view('pages/dashboard', $data);
            }
            else
            {
                $data['data_activepage']= 'index';
                return view ('index');

            }
    }

    public function dashboard($page = "dashboard"){
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            return view ('template/errorfile');
        }

        $data['data_activepage']= 'dashboard';
        return view('pages/dashboard', $data);
    }

    public function changeselect() {
        $xpostdata = $this->request->getPost();
        
        // echo "<pre>";
        // var_dump($xpostdata);
        // die();

        $xretobj = array();

        $xarr_params = array();
        $xdata = array();
        $xissec = 0;
        $xissub = 0;

        if(isset($xpostdata['selecttype']) && $xpostdata['selecttype'] == "teacher")
        {
            if(isset($xpostdata['showsubject']) && $xpostdata['showsubject'] != "no")
            {
                $xarr_params['teacherid'] = $this->ModelClass->decode_url($xpostdata['teacherid']);
                $xdata = $this->SubjectFile_Model->go_fetch_file1_data($xarr_params);
            }

        }

        // echo "<pre>";
        // var_dump($xarr_params['teacherid']);
        // var_dump($xdata);
        // die();
        $xretobj['bool'] = TRUE;
        $xobj = "";
        $test = 0;

        if(count($xdata) > 0)
        {
            if(isset($xpostdata['selecttype']) && $xpostdata['selecttype'] == "teacher")
            {
               
                if(isset($xpostdata['showsubject']) && $xpostdata['showsubject'] == "yes")
                {
                    $xobj .= "<div class=\"form-floating\">";
                        $xobj .= "<select name=\"txtfld[subjectid]\" id=\"txtsubjectid\" class=\"form-control form-control-sm\" placeholder=\"Subject\" required>";
                            $xobj .= "<option value=\"\">Select here...</option>";
                            foreach ($xdata as $key => $value) 
                            {
                                $xobj .= "<option value=\"{$value['encryptid']}\">{$value['subject']}</option>";
                            }
                        $xobj .= "</select>";
                        $xobj .= "<label for=\"txtsectionid\"><small>Subject</small></label>";
                        $xobj .= "<div class=\"invalid-tooltip\">";
                          $xobj .= "Please provide Subject.";
                        $xobj .= "</div>";
                    $xobj .= "</div>";
                }
                else
                {

                }
            }
        }

        // echo "<pre>";
        // var_dump($test);
        // var_dump($xpostdata);
        // var_dump($xobj);
        // die();

        $xretobj['obj'] = $xobj;

        echo json_encode($xretobj);

    }

    public function submitsigninuser(){
        $postdata = $this->request->getPost();

        $xretobj['bool'] = FALSE;
        $xarr_param = $postdata['txtfld'];
        $xarr_param['isactive'] = 1;

        $xpass = $xarr_param['password'];
        unset($xarr_param['password']);

        $row = $this->UserFile_Model->go_fetch_file1_data($xarr_param);

        // echo "<pre>";
        // var_dump($row);
        // die();

        if(count($row) > 0)
        {
            // create a decoding method for password
            $xmypass = $this->ModelClass->decode_url($row[0]['password']);
            // $xmypass = $row[0]['password'];

            $xretobj['bool'] = FALSE;
            $xretobj['msg'] = "Invalid Password";

            if($xpass == $xmypass)
            {
                $this->session->set('ci4_userid', $row[0]['userid']); 
                $this->session->set('ci4_username', $row[0]['username']);
                $this->session->set('ci4_usertype', $row[0]['usertype']);

                $xretobj['bool'] = TRUE;
                $xretobj['msg'] = "Success.";
            }
        }
        else
        {
            $xretobj['bool'] = FALSE;
            $xretobj['msg'] = "Account not found.";
        }
        
        echo json_encode($xretobj);
        
    }

    public function submitsignoutuser()
    {
        $xdata = array();
        $xdata['bool'] = TRUE;
        $this->session->destroy();
        echo json_encode($xdata);
    }

    public function hassession(){
        $xarr = array();
        $xarr['bool'] = FALSE;

        if(session()->has('ci4_username'))
        {
            $xarr['bool'] = TRUE;
        }

        echo json_encode($xarr);
    }

    public function pdf2()
    {
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Potato CI4 Tutorial');
        $pdf->SetTitle('User List');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $xotherdata = "San Jose, Batangas\nTel. No. (000) 000 000\nUser List";
        
        $pdf->SetHeaderData(self::MY_PDF_HEADER_LOGO, 16, 'Dr. Juan A. Pastor Integrated National High School', $xotherdata);


        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 9));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('helvetica', '', 8);

        // ---------------------------------------------------------
        // add a page
        $pdf->AddPage();
        
        $xobj = "test";

        // output the HTML content
        $pdf->writeHTML($xobj, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Schedule.pdf', 'I');
        exit();
    }

    function pdfexample(){
        // create new PDF document
        $pdf = new Pdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Carlos Maralit');
        $pdf->SetTitle('PDF SAMPLE');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData("sample_logo.png", 50, 'Test Title', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', 'BI', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print
        $txt = <<<EOD
        
        Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
        EOD;

        // print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('firstpdf.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
        exit();
    }
    
    function pdf4()
    {
        // Create a new TCPDF object
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set the document information
        $pdf->SetCreator('My Application');
        $pdf->SetAuthor('John Doe');
        $pdf->SetTitle('My PDF Document');
        $pdf->SetSubject('Example');

        // Set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Add a page
        $pdf->AddPage();

        // Set the image file path
        $image_file = $_SERVER['DOCUMENT_ROOT'] . '/img/user_logo.png';


        // Get the image dimensions
        list($width, $height) = getimagesize($image_file);

        // Calculate the aspect ratio
        $aspect_ratio = $width / $height;

        // Calculate the width and height of the image to fit within the page
        if ($aspect_ratio > 1) {
            $image_width = 100;
            $image_height = 100 / $aspect_ratio;
        } else {
            $image_height = 100;
            $image_width = 100 * $aspect_ratio;
        }

        // Display the image in the PDF
        $pdf->Image($image_file, 20, 20, $image_width, $image_height, 'PNG');

        // Add some text
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Heloooooo biik!', 0, 1, 'C');

        // Output the PDF
        $pdf->Output('example.pdf', 'I');
        exit();
    }

    public function defaultPDF()
    {
        // get the full path of the image file
        $logoImagePath = realpath(FCPATH . 'assets/img/logo.png');
        // image
        $logoImagePath = base_url() . 'assets/img/logo.png';

        // get image size
        list($width, $height, $type, $attr) = getimagesize($logoImagePath);

        // determine image format
        if ($type == IMAGETYPE_PNG) {
            $imageFormat = 'png';
        } else if ($type == IMAGETYPE_JPEG) {
            $imageFormat = 'jpeg';
        } else if ($type == IMAGETYPE_GIF) {
            $imageFormat = 'gif';
        } else {
            // unsupported image format
            throw new Exception('Unsupported image format: ' . $type);
        }

        // add image to header
        $pdf->Image($logoImagePath, 10, 10, 30, 30, $imageFormat, '', '', true, 150);

        die();

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        

        // set default header data
        $pdf->SetHeaderData($logoImagePath, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
        <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
        <i>This is the first example of TCPDF library.</i>
        <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
        <p>Please check the source code documentation and other examples for further information.</p>
        <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
        exit();
    }

    public function displaydata()
    {
        $page = "dashboard";
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            return view ('template/errorfile');
        }

        $data['data_activepage']= 'dashboard';
        $path = dirname( __FILE__ );
        $path2 = APPPATH;
        $path3 =  $_SERVER['DOCUMENT_ROOT']."/img/user_logo.png";

        $logoImagePath = base_url() . 'assets/img/logo.png';
        $data['my_data'] = $logoImagePath;


        return view('pages/dashboard', $data);
    }
    
}