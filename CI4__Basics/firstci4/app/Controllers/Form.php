<?php

namespace App\Controllers;


class Form extends BaseController
{
    public function index()
    {
        # load the validatio tools
        helper(['form']);

        $data = [];
        $data['categories'] = [
            'Student',
            'Teacher',
            'Principle'
        ];
        
        

        if($this->request->getMethod() == 'post'){
            # define the validation rules
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
                'category' => 'in_list[Student, Teacher]',
                'date' => [
                    'rules' => 'required|check_date',
                    'label' => 'Date',
                    'errors' => [
                        'required' => 'The Date is required.',
                        'check_date' => 'You can not add a date before Today.'
                    ]
                ]

            ];

            if($this->validate($rules)){
                return redirect()->to('/form/success');
                // then do db insertion
                // login user
            }else{
                $data['validation'] = $this->validator;

            }
        }

        return view('form', $data);
    }

    function success(){
        return 'Hey, you have passed the validation. Congrats!';
    }

}
