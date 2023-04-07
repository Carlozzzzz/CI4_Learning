<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Scoreboardfile extends BaseController
{
    public function index()
    {
        $page = "scoreboardfile";
        $data['data_activepage'] = "scoreboardfile";

        return view('pages/' . $page, $data);
    }
}
