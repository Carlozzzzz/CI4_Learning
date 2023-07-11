<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index($isactive = 1)
    {
        
        $page = "dashboard";
        if(!file_exists(APPPATH . 'views/pages/' . $page . '.php')){
            throw new PageNotFoundException($page);
        }

        $data['data_activepage'] = "dashboard";
        $xarr_param = array();
        $xarr_param['isactive'] = $isactive;
        $data['data_datatablefiles'] = null;
        $data['data_isactive'] = $isactive;
        return view('pages/' . $page, $data);
        
    }
}
