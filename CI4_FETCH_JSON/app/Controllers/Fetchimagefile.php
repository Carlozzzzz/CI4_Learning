<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Fetchimagefile extends BaseController
{
    public function index($isactive = 1){
        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == 'admin')
        {
            $page = "fetchimagefile";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                return view ('template/errorfile');
            }
            $data['data_activepage']= 'fetchimagefile';
            return view ('pages/fetchimagefile', $data);
        }
        return view('template/errorfile');
    }
}
