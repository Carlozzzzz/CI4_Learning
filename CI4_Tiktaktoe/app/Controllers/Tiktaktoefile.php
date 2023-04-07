<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tiktaktoefile extends BaseController
{
    public function index($isactive = 1)
    {
        $page = "tiktaktoefile";
        $data['data_activepage'] = "tiktaktoefile";
        
        return view('pages/' . $page, $data);
    }

}
