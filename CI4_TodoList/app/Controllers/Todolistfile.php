<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\TodolistFile_Model;

class Todolistfile extends BaseController
{
    protected $ModelClass;
    protected $validation;
    protected $session;
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->ModelClass = new TodolistFile_Model();

    }
    public function index($status = 1)
    {
        $page = "todolistfile";

        if(! file_exists(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }
        
        $data['data_activepage'] = "todolistfile";
        $data['data_recordfile'] = $this->ModelClass->where('status', $status)->findall();
        // $data['data_recordfile'] = $this->ModelClass->where('status', $status)->get()->getResultArray();

        return view('pages/' . $page, $data);
    }

    public function add()
    {
        $xpostdata = $this->request->getPost();
        $xarr_param = array();
        $xarr_param = $xpostdata;
        $xarr_param['status'] = 1;
        $page = "todolistfile_addedit";

        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $data['data_activepage'] = "todolistfile";

        $error = $this->validate([
            'title' => 'min_length[3]',
        ]);

        if (! $error)
        {
            $this->session->setFlashdata('error', 'Failed add Todo.');
        }
        else
        {
            $this->ModelClass->insert($xarr_param);
            $this->session->setFlashdata('success', 'Todo has been added.');
        }

        return redirect()->to(base_url('todolistfile'))->with('data', $data);
    }

    public function checkofftask($idno)
    {
        $xdata = array();
        $xpostdata = $this->request->getPost('txtfld');
        
        if($this->ModelClass->update($idno, $xpostdata))
        {
            $xdata['bool'] = TRUE;
        }
        else
        {
            $xdata['bool'] = FALSE;
        }
        echo json_encode($xdata);

    }

}
