<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Assignsubjectfile extends BaseController
{
    public function index($isactive = 1)
    {
        if(session()->has('ci4_username') && session()->get('ci4_usertype') == "admin")
        {
            $page = "assignsubjectfile";

            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php'))
            {
                throw new PageNotFoundException($page);
            }

            $data['data_activepage'] = "assignsubjectfile";
            $data['data_isactive'] = $isactive;

            // echo "<pre>";
            // var_dump($data);
            // die();

            return view('pages/'.$page, $data);
        }
    }
}
