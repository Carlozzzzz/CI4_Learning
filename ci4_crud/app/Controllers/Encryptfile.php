<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DefaultCI_Model;

class Encryptfile extends BaseController
{

    protected $DefaultCI_Model;

    public function __construct(){
        $this->DefaultCI_Model = new DefaultCI_Model();
    }

    public function index($isactive = 1)
    {
        $page = 'encryptfile';
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $xarr_param['isactive'] = $isactive;
        $data['data_activepage']= 'encryptfile';
        $data['data_isactive']= $isactive;
       
        return view('pages/' . $page, $data);
    }

    public function encryptstring()
    {

        $page = 'encryptfile';
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $data['data_activepage']= 'encryptfile';
        $data['data_encrypt'] = $this->DefaultCI_Model->encode_url("carlos");
        return view('pages/' . $page, $data);
    }

    public function decodestring($idno)
    {
        $page = 'encryptfile';
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
        {
            throw new PageNotFoundException($page);
        }

        $xarr_param = array();
        $data['data_activepage']= 'encryptfile';
        $data['data_encrypt'] = $this->DefaultCI_Model->decode_url($idno);

        return view('pages/' . $page, $data);
    }
}
