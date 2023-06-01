<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class SurveyApi extends BaseController
{
    public function __construct(){
        $this->db = \Config\Database::connect(); // get database connection
        $this->uri = service('uri');
        $this->session = \Config\Services::session();
        $this->msessions = model('madmin/m_sessions');
        $this->mdboard = model('madmin/m_msurveyapi');
    }

    public function index() {
     
        $data['uri_segment'] = $this->uri->getSegment(2);
        return view('admin/surveryapi', $data);
    }

}
