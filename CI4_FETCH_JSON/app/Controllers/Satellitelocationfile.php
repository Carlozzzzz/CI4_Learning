<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Satellitelocationfile extends BaseController
{
    public function index($isactive = 1){
        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == 'admin')
        {
            $page = "satellitelocationfile";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                return view ('template/errorfile');
            }
            $data['data_activepage']= 'satellitelocationfile';
            return view ('pages/satellitelocationfile', $data);
        }
        return view('template/errorfile');
    }
}
