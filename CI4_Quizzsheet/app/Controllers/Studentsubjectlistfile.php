<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Studentsubjectlistfile extends BaseController
{
    public function __construct(){
        $this->ModelClass = model('StudentsubjectlistFile_Model');
        $this->SubjectFile_Model = model('SubjectFile_Model');
        $this->StudentFile_Model = model('StudentFile_Model');
        $this->TeacherFile_Model = model('TeacherFile_Model');
        $this->DefaultCI_Model = model('DefaultCI_Model');
    }

    public function index($isactive = 1)
    {
        if(session()->has('ci4_userid'))
        {
            $page = "studentsubjectlistfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $data['data_recordfile'] = $this->StudentFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'studentsubjectlistlistfile';
            $data['data_isactive']= $isactive;
           
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function viewstudents($isactive = 1)
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
            $data['data_recordfile'] = $this->StudentFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'studentsubjectlistfile';
            $data['data_managesubject'] = 'Yes';
            $data['data_isactive']= $isactive;
           
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function assignsubject($idno)
    {
        if(session()->has('ci4_userid'))
        {
            $page = "studentsubjectlistfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $xarr_param['studentid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $data['data_studentid'] = $idno;
            $data['data_activepage']= 'studentsubjectlistfile';
            $data['data_isactive']= 1;
           
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function addnew($idno) 
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = "studentsubjectlistfile_addedit";

            if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage'] = "studentsubjectlistfile";
            $data['data_studentid'] = $idno;
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_teacherfile'] = $this->TeacherFile_Model->go_fetch_file1_data($xarr_param);
            // echo "<pre>";
            // var_dump($data['data_teacherfile'] );
            // die();
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_subjectfile'] = $this->SubjectFile_Model->go_fetch_file1_data($xarr_param);

            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();

        // echo "<pre>";
        // var_dump($xpostdata);
        // die();

        if(isset($xpostdata['txtfld']['studentid']) && $xpostdata['txtfld']['studentid'] != "")
        {
            $xpostdata['txtfld']['studentid'] = $this->DefaultCI_Model->decode_url($xpostdata['txtfld']['studentid']);
        }
        if(isset($xpostdata['txtfld']['teacherid']) && $xpostdata['txtfld']['teacherid'] != "")
        {
            $xpostdata['txtfld']['teacherid'] = $this->DefaultCI_Model->decode_url($xpostdata['txtfld']['teacherid']);
        }
        if(isset($xpostdata['txtfld']['subjectid']) && $xpostdata['txtfld']['subjectid'] != "")
        {
            $xpostdata['txtfld']['subjectid'] = $this->DefaultCI_Model->decode_url($xpostdata['txtfld']['subjectid']);
        }

        // echo "<pre>";
        // var_dump($xpostdata);
        // die();

        $xdata = $this->ModelClass->set_data_insert_file1($xpostdata);
        echo json_encode($xdata);
    }
}
