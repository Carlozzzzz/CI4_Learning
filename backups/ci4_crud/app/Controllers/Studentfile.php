<?php

namespace App\Controllers;
use App\Models\StudentFile_Model;
use Config\Services;

use App\Controllers\BaseController;

class Studentfile extends BaseController
{
    protected $studentmodel;
    protected $session;


    public function __construct()
    {
        helper(['form', 'url']);
        $this->ModelClass = new StudentFile_Model();
        $this->session = \Config\Services::session();
    }
   
    public function index($page = "studentfile")
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $studentModel = new StudentFile_Model();

        $data = [
            'title' => 'Student list',
            'students' => $studentModel->orderBy('recid', 'DESC')->findAll(),
        ];

        $data['data_activepage']= 'studentfile';
        return view ('pages/' . $page, $data);
    }

    public function addnew($page = "add_student")
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data = [
            'title' => 'Add Student',
        ];
        $data['data_activepage']= 'studentfile';
        return view ('pages/' . $page, $data);
    }

    public function submitsave($page = "add_student")
    {
        $error = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric',
            'studentimage' => 'if_exist|uploaded[studentimage]|max_size[studentimage,1024]|ext_in[studentimage,png,jpg,jpeg]',
        ]);

        if(!$error)
        {
            return view('pages/add_student',[
                'error' => $this->validator
            ]);
        }
        else
        {
            $xpostdata = $this->request->getPost();

            // image upload
            $imageFile = "";
            $file = $this->request->getFile('studentimage');
            if($file->isValid() && $file->hasMoved())
            {
                $imageFile = $file->getRandomName();
                $file->move('uploads', $imageFile);
            }

            $xpostdata['studenimage'] = $imageFile;
            $xpostdata['status'] = isset($xpostdata['status']) ? 1 : 0;

            $this->ModelClass->insert($xpostdata);

            $this->session->setFlashData('success', 'User Data Added');
            $data['data_activepage']= 'studentfile';
            return redirect('students');
        }
    }

    public function edit($idno)
    {
        $data['title'] = "Edit Student";
        $data['data_recordfile'] = $this->ModelClass->where('recid', $idno)->first();
        $data['data_activepage']= 'studentfile';
        return view('pages/edit_student', $data);
    }

    public function submitupdate()
    {
        $error = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric',
            'studentimage' => 'if_exist|uploaded[studentimage]|max_size[studentimage,1024]|ext_in[studentimage,png,jpg,jpeg]',
        ]);

        if(!$error)
        {
            return view('pages/edit_student',[
                'error' => $this->validator
            ]);
        }
        else
        {
            $xpostdata = $this->request->getPost();
            $idno = $xpostdata['idno'];

            // imageupload
            $imageFile = "";
            $file = $this->request->getFile('studentimage');
            if($file->isValid() && $file->hasMoved())
            {
                $imageFile = $file->getRandomName();
                $file->move('uploads', $imageFile);
            }

            $xpostdata['studentimage'] = $imageFile;
            $xpostdata['status'] = isset($xpostdata['status']) && $xpostdata['status'] == "on" ? "1" : "0";

            $this->ModelClass->update($idno, $xpostdata);

            $this->session->setFlashData('success', 'User Data Updated.');

            return redirect('students');
        }
    }

    public function delete($idno)
    {
        $this->ModelClass->delete($idno);

        $this->session->setFlasHData('success', 'User Data Deleted.');

        return redirect('students');
    }
}
