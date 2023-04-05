<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UserFile_Model;
use App\Models\UserFileModel;
use App\Models\DefaultCI_Model;
use App\Models\StudentFile_Model;

class Userfile extends BaseController
{
    protected $ModelClass;
    protected $DefaultCI_Model;
    protected $StudentFile_Model;

    public function __construct(){
        $this->ModelClass = new UserFile_Model();
        $this->ModelClass2 = new UserFileModel();
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

    public function generatetemplate()
    {
        if(session()->has('ci4_usernsame'))
        {
            
        }
        else
        {
            return view('template/errorfile');
        }
    }


    /**
     * Debugging purpose
     */
    #region -> tester
    public function update($idno)
    {
        $data = [
            "name" => "carlos",
        ];
        $this->StudentFile_Model->where('recid', 1)->update($data);

        die();
    }
    #endregion

    
}
