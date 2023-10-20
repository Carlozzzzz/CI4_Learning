<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function student_list(){
        return view('ajaxstudent/index');
    }

    public function test(){
        echo '123';
    }
}
