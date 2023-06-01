<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Datafetchfile extends BaseController
{
    public function index($isactive = 1){
        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == 'admin')
        {
            $page = "datafetchfile";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                return view ('template/errorfile');
            }
            $data['data_activepage']= 'datafetchfile';
            return view ('pages/datafetchfile', $data);
        }
        return view('template/errorfile');
    }

    public function datafetch_file2(){
        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == 'admin')
        {
            $page = "datafetchfile2";
            if(! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                return view ('template');
            }
            $data['data_activepage'] = 'datafetchfile';
            return view('pages/' . $page, $data);
        }
    }
}
