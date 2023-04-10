<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Studentfile extends BaseController
{
    public function __construct()
    {
        $this->ModelClass = model('StudentFile_Model');
        $this->DefaultCI_Model = model('DefaultCI_Model');

    }

    public function index($isactive = 1)
    {
        if(session()->has('ci4_userid'))
        {
            $page = "studentfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'studentfile';
            $data['data_isactive']= $isactive;
            if(count($data['data_recordfile']) > 0)
            {
                foreach($data['data_recordfile'] as $key => $value)
                {
                    $data['data_recordfile'][$key]['studentno'] = $this->DefaultCI_Model->encode_url($value['studentno']);
    
                }
            }
           
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function addnew()
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = "studentfile_addedit";

            if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage'] = "studentfile";
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();
        $xdata = $this->ModelClass->set_data_insert_file1($xpostdata);
        echo json_encode($xdata);
    }

    public function edit($idno)
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = 'studentfile_addedit';
            
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['studentid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'studentfile';

            // echo "<pre>";
            // var_dump($data['data_recordfile']);
            // die();

            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');

    }

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

    public function submitreset()
    {
        $xpostdata = $this->request->getPost();
        $xpostdata['idno'] = $this->DefaultCI_Model->decode_url($xpostdata['idno']);
        $xdata = $this->ModelClass->set_data_reset_file1($xpostdata);
        // echo "<pre>";
        // var_dump($xpostdata);
        // die();
        echo json_encode($xdata);
    }

    public function generatelisttemplate()
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $spreadsheet = new Spreadsheet();

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setCellValue('A1', 'Last Name');
            $worksheet->setCellValue('B1', 'First Name');
            $worksheet->setCellValue('C1', 'Middle Name');
            $worksheet->setCellValue('D1', 'Suffix');
            $worksheet->setCellValue('E1', 'Email');

            $writer = new Csv($spreadsheet);
            $filename = 'Upload_Student_List_Template.csv';
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

    public function uploadlist()
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
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
        else
        {
            return view('template/errorfile');
        }
    }

    public function downloadlist()
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $spreadsheet = new Spreadsheet();

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setCellValue('A1', 'Last Name');
            $worksheet->setCellValue('B1', 'First Name');
            $worksheet->setCellValue('C1', 'Middle Name');
            $worksheet->setCellValue('D1', 'Suffix');
            $worksheet->setCellValue('E1', 'Email');

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

                $xctr++;
            }

            $writer = new Csv($spreadsheet);
            $filename = 'Download_Student_List.csv';
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
            $data['data_datatablefile1'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            return view('reports/studentpdffile', $data);
        }
        else
        {
            return view('template/errorfile');
        }

    }
}
