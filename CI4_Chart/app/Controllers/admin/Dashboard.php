<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct(){
        // $this->db = \Config\Database::connect(); // get database connection
        // $this->session = \Config\Services::session();
        $this->uri = service('uri');
        $this->msessions = model('madmin/m_sessions');
        $this->mdboard = model('madmin/m_dashboard');
    }

    public function index() {
        $data['sessions'] = $this->msessions->getAllSessions() ;
        $data['flash_report_list'] = isset($data['sessions'][0]['sessions_id']) ? $this->msessions->get_flash_report($data['sessions'][0]['sessions_id']) : "";
        $data['poll_list'] = isset($data['sessions'][0]['sessions_id']) ? $this->msessions->get_poll($data['sessions'][0]['sessions_id']) : "";
        $data['polling_report_list'] = isset($data['sessions'][0]['sessions_id']) ? $this->msessions->get_polling_report($data['sessions'][0]['sessions_id'],$data['poll_list']) : "";
        
        $data['uri_segment'] = $this->uri->getSegment(2);

        return view('admin/dashboard', $data);
    }

    public function get_new_flashreport() {
        $xdata = $this->request->getPost();
        $response = [
            'chartData' => $this->msessions->get_flash_report($xdata["selectedValue"])
        ];
        echo json_encode($response);
    }

    public function get_new_pollreport() {
        $xdata = $this->request->getPost();
        $xpoll_list = $this->msessions->get_poll($xdata["selectedValue"]);
        $xpolling_report_list = $this->msessions->get_polling_report($xdata["selectedValue"],  $xpoll_list);
        
        $response = [
            'poll_list' =>  $xpoll_list,
            'polling_report_list' => $xpolling_report_list
        ];

        echo json_encode($response);
    }
}
