<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Shop extends BaseController
{
    public function index()
    {
        echo '<h2>This is an admin shop area</h2>';
    }

    public function product($type, $product_id){

        echo '<h2>This is a admin product: '.$type.' with an id: '.$product_id.'</h2>';
    }

   
}


## whenever we change folder stucture, we have to change the namespace