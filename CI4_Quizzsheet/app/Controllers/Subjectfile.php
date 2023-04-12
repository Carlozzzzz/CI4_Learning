<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\SubjectFile_Model;
use App\Models\DefaultCI_Model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Subjectfile extends BaseController
{
    protected $ModelClass;
    protected $DefaultCI_Model;

    public function __construct(){
        $this->ModelClass = new SubjectFile_Model();
        $this->DefaultCI_Model = new DefaultCI_Model();
        $this->TeacherFile_Model = model('TeacherFile_Model');
    }

    public function index($isactive = 1)
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = "subjectfile";
    
            if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
    
            $data['data_isactive'] = $isactive;
            $data['data_activepage'] = "subjectfile";
            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            
            // echo "<pre>";
            // var_dump($data);
            // die();
            return view('pages/'.$page, $data);
        }
        else
        {
            return view ('template/errorfile');
        }

    }
    public function addnew()
    {
        $page = "subjectfile_addedit";

        if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $data['data_activepage'] = "subjectfile";

        return view('pages/'. $page, $data);
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();
        $xdata = $this->ModelClass->set_data_insert_file1($xpostdata);
        echo json_encode($xdata);
    }

    public function edit($idno)
    {
        $page = 'subjectfile_addedit';

        if(! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $xarr_param['subjectid'] = $this->DefaultCI_Model->decode_url($idno);
        $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
        $data['data_activepage'] = 'subjectfile';

        return view('pages/' . $page, $data);
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

    public function generatelisttemplate()
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $spreadsheet = new Spreadsheet();

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setCellValue('A1', 'Subject');
            $worksheet->setCellValue('B1', 'Description');

            $writer = new Csv($spreadsheet);
            $filename = 'Upload_Subject_Template.csv';
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
                            $xarr_param['txtfld']['subject'] = $xfilesop[0]; 
                            $xarr_param['txtfld']['description'] = $xfilesop[1]; 

                            $xdata = $this->ModelClass->set_data_insert_file1($xarr_param);
                            if($xdata['bool'] == FALSE)
                            {
                                if($xmsg != "")
                                {
                                    $xmsg .= "<br>";
                                }
                                $xmsg .= "{$xfilesop[0]} not added. (".$xdata['msg'].")";
                            }
                            if($xdata['bool'] == TRUE)
                            {
                                if($xmsg != "")
                                {
                                    $xmsg .= "<br>";
                                }
                                $xmsg .= "{$xfilesop[0]} successfully added.";
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
}
