<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Tiktaktoev2File_Model;

class TiktaktoefileV2 extends BaseController
{
    protected $ModelClass;

    public function __construct()
    {
        $this->ModelClass = new Tiktaktoev2File_Model();
    }
    public function index($isactive = 1)
    {
        $page = "tiktaktoefilev2";
        
        $data['data_activepage'] = "tiktaktoefilev2";
        $data['data_recordfile1'] = $this->ModelClass->go_fetch_file1_data();
        $data['data_recordfile2'] = $this->ModelClass->go_fetch_file2_data();
        return view('pages/' . $page, $data);
    }

    public function getdata()
    {
        $xdata = array();
        $xdata['data_recordfile1'] = $this->ModelClass->go_fetch_file1_data();
        $xdata['data_recordfile2'] = $this->ModelClass->go_fetch_file2_data();
        $xdata['bool'] = true;
        return json_encode($xdata);
    }

    public function submitsave()
    {
        $xpostdata = $this->request->getPost();
        $xdata = $this->ModelClass->set_data_insert_file1($xpostdata);
        return json_encode($xdata);

    }
}
