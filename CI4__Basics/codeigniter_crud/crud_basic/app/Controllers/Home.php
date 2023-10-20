<?php

namespace App\Controllers;
use App\Models\CrudModel;
class Home extends BaseController
{
    public function index()
    {
        # create model
        $crudModel = new CrudModel();

        $data ['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);
        
        # return pagination link
        $data['pagination_link'] = $crudModel->pager;

        return view('crud_view', $data);
    }
}
