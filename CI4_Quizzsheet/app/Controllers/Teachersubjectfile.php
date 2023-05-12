<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Teachersubjectfile extends BaseController
{
    public function __construct(){
        $this->ModelClass = model('TeachersubjectlistFile_Model');
        $this->TeacherFile_Model = model('TeacherFile_Model');
        $this->SubjectFile_Model = model('SubjectFile_Model');
        $this->DefaultCI_Model = model('DefaultCI_Model');
    }

    public function index($isactive = 1)
    {
        if(session()->has('ci4_userid'))
        {
            $page = "teachersubjectfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $xarr_param['employeeno'] = session()->get('ci4_username');
            $xrow = $this->TeacherFile_Model->go_fetch_file1_data($xarr_param);
            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $xarr_param['teacherid'] = $xrow[0]['teacherid'];
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'teachersubjectfile';
            $data['data_teacherid'] = "";
            $data['data_isactive']= $isactive;
           
            // echo "<pre>";
            // var_dump($xrow);
            // die();
            
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function viewteachers($isactive = 1)
    {
        if(session()->has('ci4_userid'))
        {
            $page = "teacherfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = $isactive;
            $data['data_recordfile'] = $this->TeacherFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_activepage']= 'teachersubjectfile';
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
            $page = "teachersubjectfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $xarr_param['teacherid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $data['data_teacherid'] = $idno;
            $data['data_activepage']= 'teachersubjectfile';
            $data['data_isactive']= 1;
           
            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function addnew($idno) 
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = "teachersubjectfile_addedit";

            if( ! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage'] = "teachersubjectfile";
            $data['data_teacherid'] = $idno;
            $xarr_param['isactive'] = 1;
            $data['data_subjectfile'] = $this->SubjectFile_Model->go_fetch_file1_data($xarr_param);

            return view('pages/' . $page, $data);
        }
        return view('template/errorfile');
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();
        $xarr_param = array();
        $xarr_param = $xpostdata;
        $xarr_param['txtfld']['teacherid'] = $this->DefaultCI_Model->decode_url($xpostdata['txtfld']['teacherid']);

        // echo "<pre>";
        // var_dump($xarr_param);
        // die();

        $xdata = $this->ModelClass->set_data_insert_file1($xarr_param);
        echo json_encode($xdata);
    }

    public function edit($idno)
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "admin")
        {
            $page = 'teachersubjectfile_addedit';

            if(! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            
            $data['data_activepage'] = 'teachersubjectfile';
            $xarr_param = array();
            $xarr_param['teachersfid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_subjectfile'] = $this->SubjectFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_teacherid'] = $this->DefaultCI_Model->encode_url($data['data_recordfile'][0]['teacherid']);
            return view('pages/' . $page, $data);
        }
        else if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "teacher")
        {
            $page = 'teachersubjectfile_managesub';

            if(! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            
            $data['data_activepage'] = 'teachersubjectfile';
            $xarr_param = array();
            $xarr_param['teachersfid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_subjectfile'] = $this->SubjectFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_teacherid'] = $this->DefaultCI_Model->encode_url($data['data_recordfile'][0]['teacherid']);
            return view('pages/' . $page, $data);
        }
        else
        {
            return view('template/errorfile');
        }

    }

    public function view($idno)
    {
        if(session()->has('ci4_userid') && session()->get('ci4_usertype') == "teacher")
        {
            $page = 'teachersubjectfile_managesub';

            if(! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            
            $data['data_activepage'] = 'teachersubjectfile';
            $xarr_param = array();
            $xarr_param['teachersfid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_recordfile'] = $this->ModelClass->go_fetch_file1_data($xarr_param);
            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $xarr_param['subjectid'] = $this->DefaultCI_Model->decode_url($idno);
            $data['data_subjectfile'] = $this->SubjectFile_Model->go_fetch_file1_data($xarr_param);
            $data['data_teacherid'] = $this->DefaultCI_Model->encode_url($data['data_recordfile'][0]['teacherid']);

            // echo "<pre>";
            // var_dump($data['data_recordfile']);
            // die();

            
            return view('pages/' . $page, $data);
        }
        else
        {
            return view('template/errorfile');
        }
    }

    public function editteachersubject($idno)
    {

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

    public function viewlistpdf()
    {
        if(session()->has('ci4_username'))
        {

            $xarr_param = array();
            $xarr_param['isactive'] = 1;
            $data['data_datatablefile1'] = $this->TeacherFile_Model->go_fetch_file1_data($xarr_param);
            return view('reports/teacherpdffile', $data);
        }
        else
        {
            return view('template/errorfile');
        }

    }
}
