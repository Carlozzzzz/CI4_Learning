<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        echo '<h2>This is an User area</h2>';
    }

    public function getAllUsers(){

        echo '<h2>Show All users</h2>';
    }

   
}


## whenever we change folder stucture, we have to change the namespace