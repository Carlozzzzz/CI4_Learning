<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DefaultCI_Model;
use App\Models\UserFile_Model;
use Config\Services;


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

    
}

