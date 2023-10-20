<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ajaxstudent;

class AjaxstudentController extends BaseController
{
    public function index()
    {
        return view('ajaxstudent/index');
    }

    public function store()
    {
        # create Model
        $students = new Ajaxstudent();

        # save data to msql table
        $students->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course')
        ]);


        $data = ['status' => 'Student Inserted Successfully'];
        return $this->response->setJSON($data);

        // echo 'sample store';

    }

    public function fetch()
    {
        $studentModel = new Ajaxstudent();
        $data['students'] = $studentModel->findAll();
        return $this->response->setJSON($data); 
    }

    public function view()
    {
        $studentModel = new Ajaxstudent();

        $student_id =  $this->request->getPost('stud_id');

        $data['students'] = $studentModel->find($student_id);

        return $this->response->setJSON($data);
    }

    public function edit()
    {
        $studentModel = new Ajaxstudent();

        $student_id =  $this->request->getPost('stud_id');

        $data['students'] = $studentModel->find($student_id);

        return $this->response->setJSON($data);
    }

    public function update()
    {
        $studentModel = new Ajaxstudent();
        $student_id = $this->request->getPost('stud_id');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'course' => $this->request->getPost('course')

            // 'name' => "",
            // 'email' => "",
            // 'phone' => "",
            // 'course' => ""
        ];

        $studentModel->update($student_id, $data);

        $message = ['status' => "Student Data updated successfully."];

        return $this->response->setJSON($message);

    }

    public function delete()
    {
        $studentModel = new Ajaxstudent();
        $studentModel->delete($this->request->getPost('stud_id'));

        $message = ['status' => "Student Data deleted successfully."];

        return $this->response->setJSON($message);

    }
}
