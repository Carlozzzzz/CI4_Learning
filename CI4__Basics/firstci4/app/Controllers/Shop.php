<?php

namespace App\Controllers;

class Shop extends BaseController
{
    public function index()
    {
        return view('shop_view');
    }

    public function product($type = "asus", $product_id = "001"){

        echo '<h2>This is a product: '.$type.' with an id: '.$product_id.'</h2>';
        // return view('product');
    }

   
}
