<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

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
    }

    public function index($isactive = 1){

        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin")
        {

            $page = "index";
            if (! is_file(APPPATH . 'Views/' . $page . '.php')) {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage']= 'index';
            return view ('index');
        }
        else
        {
            return view ('template/errorfile');
        }
    }

    public function dashboard($page = "dashboard"){
        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin")
        {
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage']= 'dashboard';
            return view('pages/dashboard', $data);
        }
        else
        {
            return view ('template/errorfile');
        }
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

            // echo $xmypass;
            // die();

            $xretobj['bool'] = FALSE;
            $xretobj['msg'] = "Invalid Password";

            if($xpass == $xmypass)
            {
                $this->session->set('ci4_userid', $row[0]['userid']); 
                $this->session->set('ci4_username', $row[0]['username']);

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

