<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DefaultCI extends BaseController
{
    public function index($isactive = 1)
    {
        $page = "dashboard";
        $data['data_activepage'] = "dashboard";

        return view('pages/' . $page, $data);
    }
}
