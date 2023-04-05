<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UserFile_Model;
use App\Models\DefaultCI_Model;
use App\Models\StudentFile_Model;

use TCPDF;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Userfile extends BaseController
{
    protected $ModelClass;
    protected $DefaultCI_Model;
    protected $StudentFile_Model;

    public function __construct(){
        $this->ModelClass = new UserFile_Model();
        $this->DefaultCI_Model = new DefaultCI_Model();
        $this->StudentFile_Model = new StudentFile_Model();
    }

    public function index($isactive = 1)
    {
        $page = 'userfile';
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $xarr_param['isactive'] = $isactive;
        $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
        $data['data_activepage']= 'userfile';
        $data['data_isactive']= $isactive;
        
        return view('pages/' . $page, $data);
    }

    public function addnew()
    {
        if(session()->has('ci4_username'))
        {
            $page = "userfile_addedit";

            if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage'] = "userfile";
            return view('pages/' . $page, $data);

        }
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();
        $xdata = $this->ModelClass->set_data_insert_file1($xpostdata);
        echo json_encode($xdata);
    }

    public function edit($idno)
    {
        $page = 'userfile_addedit';
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $xarr_param['userid'] = $this->DefaultCI_Model->decode_url($idno);
        $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
        $data['data_activepage']= 'userfile';

        return view('pages/' . $page, $data);
    }

    // echo "<pre>";
    //     var_dump($xpostdata);
    //     die();

    public function submitupdate($idno)
    {
        $xpostdata = $this->request->getPost();
       
        $xpostdata['idno'] = $this->DefaultCI_Model->decode_url($idno);
        $xdata = $this->ModelClass->set_data_update_file1($xpostdata);
        echo json_encode($xdata);
    }

    public function submitdelete()
    {
        $xpostdata = $this->request->getPost();
        $xpostdata['idno'] = $this->DefaultCI_Model->decode_url($xpostdata['idno']);
        $xdata = $this->ModelClass->set_data_delete_file1($xpostdata);
        echo json_encode($xdata);
       
    }

    public function generatelisttemplate()
    {
        if(session()->has('ci4_username'))
        {
            $spreadsheet = new Spreadsheet();

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setCellValue('A1', 'Last Name');
            $worksheet->setCellValue('B1', 'First Name');
            $worksheet->setCellValue('C1', 'Middle Name');
            $worksheet->setCellValue('D1', 'Suffix');
            $worksheet->setCellValue('E1', 'Email');
            $worksheet->setCellValue('F1', 'Username');
            $worksheet->setCellValue('G1', 'Usertype');

            $writer = new Csv($spreadsheet);
            $filename = 'Upload_User_List_Template.csv';
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=' . $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output');

        }
        else
        {
            return view('template/errorfile');
        }
    }

    // echo "<pre>";
    // var_dump($xpostdata);
    // die();

    public function uploadlist()
    {
        if(session()->has("ci4_username"))
        {
            $xdata = array();
            $xarr_param = array();

            $xmypath = WRITEPATH . 'uploads/Files/User_CSV';
            if (!is_dir($xmypath)) {
                mkdir($xmypath, 0777, TRUE);
            }

            $rules = [
                'txtfileimport' => [
                    'rules' => 'uploaded[txtfileimport]|max_size[txtfileimport,9999999999]|ext_in[txtfileimport,csv]',
                    'label' => 'File',
                    'errors' => [
                        'ext_in' => '{field} must be a CSV file.',
                    ],
                ],
            ];
            
            if (!$this->validate($rules)) {
                $errors = $this->validator->getErrors();
                $xdata['bool'] = FALSE;
                $xdata['msg'] = $errors['txtfileimport'];
            }
            else
            {
                if(isset($_FILES['txtfileimport']))
                {
                    
                    $xfile = $_FILES['txtfileimport']['tmp_name'];
                    $xhandle = fopen($xfile, "r");
                    $xmsg = "";
                    $xctr = -1;
                    while($xfilesop = fgetcsv($xhandle, 1000, ","))
                    {
                        if($xctr >= 0)
                        {
                            $xarr_param['txtfld']['lastname'] = $xfilesop[0]; 
                            $xarr_param['txtfld']['firstname'] = $xfilesop[1]; 
                            $xarr_param['txtfld']['middlename'] = $xfilesop[2]; 
                            $xarr_param['txtfld']['suffix'] = $xfilesop[3]; 
                            $xarr_param['txtfld']['email'] = $xfilesop[4]; 
                            $xarr_param['txtfld']['username'] = $xfilesop[5]; 
                            $xarr_param['txtfld']['usertype'] = $xfilesop[6]; 

                            $xdata = $this->ModelClass->set_data_insert_file1($xarr_param);
                            if($xdata['bool'] == FALSE)
                            {
                                if($xmsg != "")
                                {
                                    $xmsg .= "<br>";
                                }
                                $xmsg .= "{$xfilesop[0]} {$xfilesop[1]} not added. (".$xdata['msg'].")";
                            }
                            if($xdata['bool'] == TRUE)
                            {
                                if($xmsg != "")
                                {
                                    $xmsg .= "<br>";
                                }
                                $xmsg .= "{$xfilesop[0]} {$xfilesop[1]} successfully added.";
                            }
                        }
                        $xctr++;
                    }

                    $xdata['bool'] = TRUE;
                    $xdata['msg'] = "<small>{$xmsg}</small>";
                }
                else
                {
                    $xdata['bool'] = FALSE;
                    $xdata['msg'] = "Theres nothing to show";
                }
            }
            echo json_encode($xdata);
        }
    }

    public function downloadlist()
    {
        if(session()->has('ci4_username'))
        {
            $spreadsheet = new Spreadsheet();

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setCellValue('A1', 'Last Name');
            $worksheet->setCellValue('B1', 'First Name');
            $worksheet->setCellValue('C1', 'Middle Name');
            $worksheet->setCellValue('D1', 'Suffix');
            $worksheet->setCellValue('E1', 'Email');
            $worksheet->setCellValue('F1', 'Username');
            $worksheet->setCellValue('G1', 'Usertype');

            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data_datatablefile = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $xctr = 2;
            foreach ($data_datatablefile as $key => $value)
            {
                $worksheet->setCellValue("A{$xctr}", $value['lastname']);
                $worksheet->setCellValue("B{$xctr}", $value['firstname']);
                $worksheet->setCellValue("C{$xctr}", $value['middlename']);
                $worksheet->setCellValue("D{$xctr}", $value['suffix']);
                $worksheet->setCellValue("E{$xctr}", $value['email']);
                $worksheet->setCellValue("F{$xctr}", $value['username']);
                $worksheet->setCellValue("G{$xctr}", $value['usertype']);

                $xctr++;
            }

            $writer = new Csv($spreadsheet);
            $filename = 'Download_User_List.csv';
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=' . $filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }
        else
        {
            return view('template/errorfile');
        }
    }

    public function viewlistpdf()
    {
        if(session()->has('ci4_username'))
        {
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            return view('reports/usertcpdf', $data);
        }
        else
        {
            return view ('template/errorfile');
        }

    }

    public function viewlistdompdf()
    {
        if(session()->has('ci4_username'))
        {
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            return view('reports/userpdffile', $data);
        }
        else
        {
            return view ('template/errorfile');
        }

    }

    public function insert()
    {
        // Define the CSV data
        $data = array(
            array('Name', 'Age', 'City'),
            array('John Doe', 25, 'New York'),
            array('Jane Smith', 30, 'London'),
            array('Bob Johnson', 40, 'Paris')
        );

        // Set the HTTP headers to force download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="example.csv"');

        // Open a PHP output stream for writing the CSV data
        $output = fopen('php://output', 'w');

        // Loop over the data and write each row to the CSV stream
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Close the CSV stream
        fclose($output);
    }


}
