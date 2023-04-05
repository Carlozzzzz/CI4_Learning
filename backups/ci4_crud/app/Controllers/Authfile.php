<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthFile_Model;

class Authfile extends BaseController
{
    private $ModelClass;

    public function __construct(){
        $this->ModelClass = new UserFile_Model();
    }

    public function index()
    {
        return view ('index');
    }

    public function login()
    {
        return view ('index');
    }

    public function attemptlogin()
    {

    }

    public function logout()
    {

    }
}
